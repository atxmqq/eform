<?php

namespace App\Http\Controllers;

use App\Models\FormSubmission;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PdfController extends Controller
{
    public function download(FormSubmission $submission)
    {
        $this->authorize('view', $submission);

        $submission->load([
            'formType',
            'fieldValues',
            'approvals.workflowStep',
            'approvals.approver',
            'submitter',
        ]);

        // Student info from external table
        $student = DB::table('form_request_student')
            ->where('std_email', $submission->submitter->email)
            ->first();

        // Map field values keyed by field_key for easy access
        $fields = $submission->fieldValues->pluck('value', 'field_key');

        // Map approvals by approver_role
        $approvalsByRole = [];
        foreach ($submission->approvals as $approval) {
            $role = $approval->workflowStep->approver_role ?? null;
            if ($role) {
                $approvalsByRole[$role] = $approval;
            }
        }

        // Resolve approver signatures (absolute path for DomPDF)
        $signaturesPath = function (?string $relativePath): ?string {
            if (!$relativePath) return null;
            $abs = Storage::disk('public')->path($relativePath);
            return file_exists($abs) ? $abs : null;
        };

        $studentSigPath = $signaturesPath($submission->submitter->signature);

        $approverSigs = [];
        foreach ($approvalsByRole as $role => $approval) {
            if ($approval->approver) {
                $approverSigs[$role] = $signaturesPath($approval->approver->signature);
            }
        }

        $code = $submission->formType->code;

        $viewMap = [
            'leave_study'         => 'pdf.leave-study',
            'thesis_registration' => 'pdf.thesis-registration',
            'special_status'      => 'pdf.special-status',
            'restore_status'      => 'pdf.restore-status',
        ];

        $view = $viewMap[$code] ?? null;

        if (!$view) {
            abort(404, 'ไม่พบ PDF template สำหรับฟอร์มนี้');
        }

        $data = compact('submission', 'student', 'fields', 'approvalsByRole', 'approverSigs', 'studentSigPath');

        $pdf = Pdf::loadView($view, $data)
            ->setPaper('a4', 'portrait');

        $filename = $submission->formType->name . '_' . ($student->std_id_std ?? $submission->id) . '.pdf';

        return $pdf->download($filename);
    }
}
