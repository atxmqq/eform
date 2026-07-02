<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Mail\AdvisorSubmissionNotification;
use App\Models\FormSubmission;
use App\Models\FormType;
use App\Models\SubmissionApproval;
use App\Models\SubmissionFieldValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    public function create(FormType $formType)
    {
        if (!$formType->is_active) {
            abort(404);
        }
        if (!$formType->isOpen()) {
            $msg = $formType->opens_at && now()->lt($formType->opens_at)
                ? 'คำร้องนี้จะเปิดรับในวันที่ ' . $formType->opens_at->format('d/m/Y เวลา H:i น.')
                : 'ปิดรับคำร้องนี้แล้ว';
            return redirect()->route('dashboard')->with('error', $msg);
        }
        $formType->load('fields');

        // Resolve old advisor names for validation-error re-display
        $oldAdvisors = [];
        foreach ($formType->fields as $field) {
            if ($field->field_type === 'advisor_select') {
                $oldId = session()->getOldInput('field_' . $field->field_key);
                if ($oldId) {
                    $adv = DB::table('form_request_advisor')
                        ->where('advisor_id', $oldId)
                        ->first(['advisor_id', 'prefixname', 'advisorname', 'advisorsurname', 'facultyname']);
                    if ($adv) {
                        $oldAdvisors[$field->field_key] = $adv;
                    }
                }
            }
        }

        $studentData = DB::table('form_request_student')
            ->where('std_email', auth()->user()->email)
            ->first();

        return view('student.submissions.create', compact('formType', 'oldAdvisors', 'studentData'));
    }

    public function searchAdvisors(Request $request)
    {
        $q = trim($request->input('q', ''));
        $query = DB::table('form_request_advisor')
            ->select('advisor_id', 'prefixname', 'advisorname', 'advisorsurname', 'facultyname');

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('advisorname', 'like', "%{$q}%")
                    ->orWhere('advisorsurname', 'like', "%{$q}%")
                    ->orWhere('advisornameeng', 'like', "%{$q}%")
                    ->orWhere('advisorsurnameeng', 'like', "%{$q}%");
            });
        }

        return response()->json(
            $query->orderBy('advisorname')->limit(20)->get()
        );
    }

    public function store(Request $request, FormType $formType)
    {
        if (!$formType->is_active) {
            abort(404);
        }

        $formType->load(['fields', 'workflowSteps']);

        $rules = [];
        foreach ($formType->fields as $field) {
            $rule = $field->is_required ? 'required' : 'nullable';
            $rules['field_' . $field->field_key] = match ($field->field_type) {
                'file'   => [$rule, 'file', 'max:10240'],
                'email'  => [$rule, 'email'],
                'number' => [$rule, 'numeric'],
                'date'   => [$rule, 'date'],
                default  => [$rule, 'string', 'max:5000'],
            };
        }
        $request->validate($rules);

        // Reinstatement validation: ตรวจสอบข้อมูลเฉพาะของคำร้องคืนสภาพ
        if ($formType->code === 'reinstatement') {
            $request->validate([
                'loss_reason_type' => 'required|in:not_paid,not_enrolled',
                'missed_semesters_count' => 'required_if:loss_reason_type,not_paid|nullable|numeric|min:1',
                'missed_semester_details' => 'required_if:loss_reason_type,not_paid|nullable|string|max:255',

                // เพิ่ม Validation สำหรับช่องใหม่
                'retain_status_semester' => 'required|in:1,2',
                'retain_status_year' => 'required|string|max:4',
                'leave_from_semester' => 'nullable|in:1,2',
                'leave_from_year' => 'nullable|string|max:4',
                'leave_to_semester' => 'nullable|in:1,2',
                'leave_to_year' => 'nullable|string|max:4',
            ], [
                'loss_reason_type.required' => 'กรุณาเลือกสาเหตุที่พ้นสภาพการเป็นนิสิต',
                'missed_semesters_count.required_if' => 'กรุณาระบุจำนวนภาคเรียนที่ไม่ได้ชำระเงิน',
                'missed_semester_details.required_if' => 'กรุณาระบุว่าคือภาคเรียนที่เท่าไหร่',
                'retain_status_semester.required' => 'กรุณาเลือกภาคการศึกษาที่ต้องการขอคืนสภาพ',
                'retain_status_year.required' => 'กรุณาระบุปีการศึกษาที่ต้องการขอคืนสภาพ',
            ]);
        }
        // Restore status: validate all 12 condition questions and check at least one case passes
        $passedCase = null;
        if ($formType->code === 'special_status') {
            $conditionRules = [];
            for ($c = 1; $c <= 4; $c++) {
                for ($q = 1; $q <= 3; $q++) {
                    $conditionRules["condition_{$c}_{$q}"] = ['required', 'in:yes,no'];
                }
            }
            $request->validate($conditionRules, array_fill_keys(
                array_map(fn($k) => "{$k}.required", array_keys($conditionRules)),
                'กรุณาตอบคำถามทุกข้อ'
            ));

            for ($c = 1; $c <= 4; $c++) {
                $allYes = true;
                for ($q = 1; $q <= 3; $q++) {
                    if ($request->input("condition_{$c}_{$q}") !== 'yes') {
                        $allYes = false;
                        break;
                    }
                }
                if ($allYes) {
                    $passedCase = $c;
                    break;
                }
            }

            if ($passedCase === null) {
                return back()
                    ->withErrors(['restore_conditions' => 'ท่านต้องผ่านเงื่อนไขครบทั้ง 3 ข้อในกรณีใดกรณีหนึ่งจึงจะยื่นคำร้องได้'])
                    ->withInput();
            }
        }

        $submission = null;

        DB::transaction(function () use ($request, $formType, &$submission, $passedCase) {
            $firstStep = $formType->workflowSteps->first();

            $submission = FormSubmission::create([
                'form_type_id'       => $formType->id,
                'submitter_id'       => auth()->id(),
                'status'             => $firstStep ? 'pending' : 'approved',
                'current_step_order' => $firstStep?->step_order,
                'submitted_at'       => now(),
                'completed_at'       => $firstStep ? null : now(),
            ]);

            foreach ($formType->fields as $field) {
                $key   = 'field_' . $field->field_key;
                $value = null;

                if ($field->field_type === 'file' && $request->hasFile($key)) {
                    $value = $request->file($key)->store('submissions/' . $submission->id, 'public');
                } elseif ($field->field_type === 'signature' && $request->filled($key)) {
                    $dataUrl = $request->input($key);
                    if (str_starts_with($dataUrl, 'data:image/png;base64,')) {
                        $imageData = base64_decode(substr($dataUrl, 22));
                        $path = 'submissions/' . $submission->id . '/signature_' . $field->field_key . '.png';
                        Storage::disk('public')->put($path, $imageData);
                        $value = $path;
                    }
                } elseif ($request->filled($key)) {
                    $value = $request->input($key);
                }

                SubmissionFieldValue::create([
                    'submission_id' => $submission->id,
                    'field_key'     => $field->field_key,
                    'value'         => $value,
                ]);
            }

            foreach ($formType->workflowSteps as $step) {
                SubmissionApproval::create([
                    'submission_id'    => $submission->id,
                    'workflow_step_id' => $step->id,
                    'step_order'       => $step->step_order,
                    'action'           => $step->step_order === 1 ? 'pending' : 'waiting',
                ]);
            }

            // Store condition answers and passing case for restore_status
            if ($formType->code === 'special_status' && $passedCase !== null) {
                SubmissionFieldValue::create([
                    'submission_id' => $submission->id,
                    'field_key'     => 'restore_case',
                    'value'         => (string) $passedCase,
                ]);
                for ($c = 1; $c <= 4; $c++) {
                    for ($q = 1; $q <= 3; $q++) {
                        SubmissionFieldValue::create([
                            'submission_id' => $submission->id,
                            'field_key'     => "condition_{$c}_{$q}",
                            'value'         => $request->input("condition_{$c}_{$q}"),
                        ]);
                    }
                }
            }

            // Store custom fields for reinstatement (บันทึกข้อมูลเฉพาะของคำร้องคืนสภาพ)
            // Store custom fields for reinstatement (บันทึกข้อมูลเฉพาะของคำร้องคืนสภาพ)
            if ($formType->code === 'reinstatement') {
                $reinstatementFields = [
                    'loss_reason_type',
                    'missed_semesters_count',
                    'missed_semester_details',

                    // เพิ่มรายชื่อช่องใหม่ตรงนี้
                    'retain_status_semester',
                    'retain_status_year',
                    'leave_from_semester',
                    'leave_from_year',
                    'leave_to_semester',
                    'leave_to_year'
                ];

                foreach ($reinstatementFields as $customKey) {
                    if ($request->has($customKey) && $request->input($customKey) !== null) {
                        SubmissionFieldValue::create([
                            'submission_id' => $submission->id,
                            'field_key'     => $customKey,
                            'value'         => (string) $request->input($customKey),
                        ]);
                    }
                }
            }
        });

        // Send email to advisor if the form has an advisor_select field
        $this->notifyAdvisor($submission, $formType, $request);

        return redirect()->route('student.submissions.index')->with('success', 'ยื่นคำร้องสำเร็จ');
    }

    private function notifyAdvisor(FormSubmission $submission, FormType $formType, Request $request): void
    {
        $advisorField = $formType->fields->firstWhere('field_type', 'advisor_select');
        if (!$advisorField) return;

        $advisorId = $request->input('field_' . $advisorField->field_key);
        if (!$advisorId) return;

        $advisor = DB::table('form_request_advisor')
            ->where('advisor_id', $advisorId)
            ->first();

        if (!$advisor || empty($advisor->advisor_email)) return;

        $student = DB::table('form_request_student')
            ->where('std_email', auth()->user()->email)
            ->first();

        // Fallback student object using auth user if no record in external table
        if (!$student) {
            $student = (object) [
                'std_id_std'    => auth()->user()->student_id ?? '-',
                'std_fname_th'  => auth()->user()->name,
                'std_lname_th'  => '',
                'std_fname_en'  => auth()->user()->name,
                'std_lname_en'  => '',
                'std_major_th'  => auth()->user()->department ?? '-',
                'std_major_en'  => auth()->user()->department ?? '-',
            ];
        }

        $submission->load('formType');

        Mail::to($advisor->advisor_email)
            ->send(new AdvisorSubmissionNotification($submission, $advisor, $student));
    }

    public function index(Request $request)
    {
        $submissions = FormSubmission::with(['formType'])
            ->where('submitter_id', auth()->id())
            ->latest()
            ->paginate(15);
        return view('student.submissions.index', compact('submissions'));
    }
    public function show(FormSubmission $submission)
    {
        if ($submission->submitter_id !== auth()->id()) {
            abort(403, 'คุณไม่มีสิทธิ์เข้าถึงคำร้องนี้');
        }

        $submission->load(['formType.fields', 'fieldValues', 'approvals.workflowStep', 'approvals.approver']);
        return view('student.submissions.show', compact('submission'));
    }
}
