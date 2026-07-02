<?php

namespace Database\Seeders;

use App\Models\FormType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Users
        User::create([
            'name'     => 'ผู้ดูแลระบบ',
            'email'    => 'admin@eform.local',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'       => 'นายทดสอบ ระบบ',
            'email'      => 'student@eform.local',
            'password'   => Hash::make('password'),
            'role'       => 'student',
            'student_id' => '65010001',
            'department' => 'วิทยาการคอมพิวเตอร์',
        ]);

        User::create([
            'name'       => 'รศ.ดร.อาจารย์ ที่ปรึกษา',
            'email'      => 'advisor@eform.local',
            'password'   => Hash::make('password'),
            'role'       => 'advisor',
            'department' => 'วิทยาการคอมพิวเตอร์',
        ]);

        User::create([
            'name'       => 'ผศ.ดร.ประธาน หลักสูตร',
            'email'      => 'chair@eform.local',
            'password'   => Hash::make('password'),
            'role'       => 'program_chair',
            'department' => 'วิทยาการคอมพิวเตอร์',
        ]);

        User::create([
            'name'  => 'รศ.ดร.คณบดี บัณฑิต',
            'email' => 'graddean@eform.local',
            'password' => Hash::make('password'),
            'role'  => 'grad_dean',
        ]);

        User::create([
            'name'  => 'นาง เจ้าหน้าที่ บัณฑิต',
            'email' => 'officer@eform.local',
            'password' => Hash::make('password'),
            'role'  => 'graduate_officer',
        ]);

        // Form Type 1: ลาพักการศึกษา
        $leave = FormType::create([
            'name'        => 'คำร้องลาพักการศึกษา',
            'code'        => 'leave_study',
            'description' => 'สำหรับนักศึกษาที่ต้องการยื่นคำร้องขอลาพักการศึกษา',
            'is_active'   => true,
        ]);

        foreach ([
            ['label' => 'อาจารย์ที่ปรึกษา',        'field_key' => 'thesis_advisor_id',  'field_type' => 'advisor_select', 'is_required' => true],
            ['label' => 'ภาคการศึกษาที่ขอลาพัก',  'field_key' => 'semester_term',      'field_type' => 'radio',    'is_required' => true,  'options' => ['ภาคต้น', 'ภาคปลาย', 'ภาคการศึกษาพิเศษ']],
            ['label' => 'ปีการศึกษา',              'field_key' => 'semester',           'field_type' => 'text',     'is_required' => true,  'placeholder' => 'เช่น 2567'],
            ['label' => 'เหตุผลในการขอลาพัก',     'field_key' => 'reason',             'field_type' => 'textarea', 'is_required' => true],
            ['label' => 'งานที่ทำแล้วเสร็จ',      'field_key' => 'thesis_finished',    'field_type' => 'text',     'is_required' => false, 'placeholder' => 'ระบุรายละเอียด (ถ้ามี)', 'help_text' => 'กรณีได้รับอนุมัติให้ทำวิทยานิพนธ์/การศึกษาค้นคว้าอิสระ'],
            ['label' => 'งานที่กำลังทำ',           'field_key' => 'thesis_in_progress', 'field_type' => 'text',     'is_required' => false, 'placeholder' => 'ระบุรายละเอียด (ถ้ามี)'],
            ['label' => 'งานที่ยังไม่ทำ',          'field_key' => 'thesis_not_started', 'field_type' => 'text',     'is_required' => false, 'placeholder' => 'ระบุรายละเอียด (ถ้ามี)'],
        ] as $i => $f) {
            $leave->fields()->create(array_merge($f, ['sort_order' => $i]));
        }

        foreach ([
            ['step_order' => 1, 'step_name' => 'ผ่านอาจารย์ที่ปรึกษา', 'approver_role' => 'advisor'],
            ['step_order' => 2, 'step_name' => 'ผ่านประธานหลักสูตร', 'approver_role' => 'program_chair'],
            ['step_order' => 3, 'step_name' => 'ผ่านเจ้าหน้าที่บัณฑิต', 'approver_role' => 'graduate_officer'],
            ['step_order' => 4, 'step_name' => 'ผ่านคณบดีบัณฑิต', 'approver_role' => 'grad_dean'],
        ] as $step) {
            $leave->workflowSteps()->create(array_merge($step, ['can_reject' => true, 'can_return' => true]));
        }

        // Form Type 2: ลงทะเบียน Thesis/IS
        $thesis = FormType::create([
            'name'        => 'คำร้องลงทะเบียน Thesis / IS',
            'code'        => 'thesis_registration',
            'description' => 'สำหรับนักศึกษาที่ต้องการลงทะเบียนทำวิทยานิพนธ์หรือการศึกษาค้นคว้าอิสระ',
            'is_active'   => true,
        ]);

        foreach ([
            ['label' => 'ประเภท', 'field_key' => 'type', 'field_type' => 'radio', 'is_required' => true, 'options' => ['Thesis', 'IS']],
            ['label' => 'หัวข้อ (ภาษาไทย)', 'field_key' => 'title_th', 'field_type' => 'text', 'is_required' => true],
            ['label' => 'หัวข้อ (ภาษาอังกฤษ)', 'field_key' => 'title_en', 'field_type' => 'text', 'is_required' => true],
            ['label' => 'อาจารย์ที่ปรึกษา', 'field_key' => 'thesis_advisor_id', 'field_type' => 'advisor_select', 'is_required' => true],
            ['label' => 'ภาคการศึกษา/ปีที่เริ่ม', 'field_key' => 'start_semester', 'field_type' => 'text', 'is_required' => true],
        ] as $i => $f) {
            $thesis->fields()->create(array_merge($f, ['sort_order' => $i]));
        }

        foreach ([
            ['step_order' => 1, 'step_name' => 'ผ่านอาจารย์ที่ปรึกษา', 'approver_role' => 'advisor'],
            ['step_order' => 2, 'step_name' => 'ผ่านประธานหลักสูตร', 'approver_role' => 'program_chair'],
        ] as $step) {
            $thesis->workflowSteps()->create(array_merge($step, ['can_reject' => true, 'can_return' => true]));
        }

        // Form Type 3: รักษาสภาพกรณีพิเศษ
        $status = FormType::create([
            'name'        => 'คำร้องรักษาสภาพกรณีพิเศษ',
            'code'        => 'special_status',
            'description' => 'สำหรับนักศึกษาที่ต้องการรักษาสภาพนักศึกษาในกรณีพิเศษ',
            'is_active'   => true,
        ]);

        foreach ([
            ['label' => 'เหตุผลที่ขอรักษาสภาพกรณีพิเศษ', 'field_key' => 'reason', 'field_type' => 'textarea', 'is_required' => true],
            ['label' => 'ภาคการศึกษาที่ขอ', 'field_key' => 'semester', 'field_type' => 'text', 'is_required' => true],
        ] as $i => $f) {
            $status->fields()->create(array_merge($f, ['sort_order' => $i]));
        }

        foreach ([
            ['step_order' => 1, 'step_name' => 'ผ่านเจ้าหน้าที่บัณฑิต',  'approver_role' => 'graduate_officer'],
            ['step_order' => 2, 'step_name' => 'ผ่านรองวิชาการบัณฑิต',  'approver_role' => 'grad_vice_dean'],
            ['step_order' => 3, 'step_name' => 'ผ่านคณบดีบัณฑิต',        'approver_role' => 'grad_dean'],
        ] as $step) {
            $status->workflowSteps()->create(array_merge($step, ['can_reject' => true, 'can_return' => true]));
        }

        // Form Type 4: คืนสภาพ
        $restore = FormType::create([
            'name'        => 'คำร้องคืนสภาพนักศึกษา',
            'code'        => 'restore_status',
            'description' => 'สำหรับนักศึกษาที่ต้องการขอคืนสภาพนักศึกษาหลังจากพ้นสภาพ',
            'is_active'   => true,
        ]);

        foreach ([
            ['label' => 'อาจารย์ที่ปรึกษา',              'field_key' => 'thesis_advisor_id', 'field_type' => 'advisor_select', 'is_required' => true],
            ['label' => 'เหตุผลที่พ้นสภาพ',              'field_key' => 'leave_reason',      'field_type' => 'textarea',       'is_required' => true],
            ['label' => 'เหตุผลที่ต้องการคืนสภาพ',       'field_key' => 'restore_reason',    'field_type' => 'textarea',       'is_required' => true],
            ['label' => 'ภาคการศึกษาที่ต้องการคืนสภาพ', 'field_key' => 'semester',          'field_type' => 'text',           'is_required' => true],
        ] as $i => $f) {
            $restore->fields()->create(array_merge($f, ['sort_order' => $i]));
        }

        foreach ([
            ['step_order' => 1, 'step_name' => 'ผ่านอาจารย์ที่ปรึกษา',  'approver_role' => 'advisor'],
            ['step_order' => 2, 'step_name' => 'ผ่านเจ้าหน้าที่บัณฑิต', 'approver_role' => 'graduate_officer'],
            ['step_order' => 3, 'step_name' => 'ผ่านรองวิชาการบัณฑิต',  'approver_role' => 'grad_vice_dean'],
            ['step_order' => 4, 'step_name' => 'ผ่านคณบดีบัณฑิต',        'approver_role' => 'grad_dean'],
        ] as $step) {
            $restore->workflowSteps()->create(array_merge($step, ['can_reject' => true, 'can_return' => true]));
        }

        // Form Type 5: Research Data Collection Form
        $research = FormType::create([
            'name'        => 'Research Data Collection Form',
            'code'        => 'research_data_collection',
            'description' => 'Request form for graduate students to collect research data abroad',
            'is_active'   => true,
        ]);

        foreach ([
            ['label' => 'Title',                          'field_key' => 'title',                  'field_type' => 'radio',    'is_required' => true,  'options' => ['Mr.', 'Ms.', 'Mrs.']],
            ['label' => 'Thesis title',                   'field_key' => 'thesis_title',           'field_type' => 'text',     'is_required' => true,  'placeholder' => 'Enter your thesis title'],
            ['label' => 'Location of data collection country', 'field_key' => 'country',           'field_type' => 'text',     'is_required' => true,  'placeholder' => 'e.g. Japan'],
            ['label' => 'Location of data collection city',    'field_key' => 'city',              'field_type' => 'text',     'is_required' => true,  'placeholder' => 'e.g. Tokyo'],
            ['label' => 'The period of data collection (From)', 'field_key' => 'period_from',      'field_type' => 'date',     'is_required' => true],
            ['label' => 'The period of data collection (To)',   'field_key' => 'period_to',        'field_type' => 'date',     'is_required' => true],
            ['label' => 'Budget Resource',                'field_key' => 'budget_resource',        'field_type' => 'select',   'is_required' => true,  'options' => ['Self', 'Other']],
            ['label' => 'Please specify (if Other)',      'field_key' => 'budget_resource_other',  'field_type' => 'text',     'is_required' => false, 'placeholder' => 'Please specify budget resource'],
            ['label' => 'Thesis Advisor',                 'field_key' => 'thesis_advisor_id',      'field_type' => 'advisor_select', 'is_required' => true],
            ['label' => 'Student\'s signature',           'field_key' => 'student_signature',      'field_type' => 'signature', 'is_required' => true],
        ] as $i => $f) {
            $research->fields()->create(array_merge($f, ['sort_order' => $i]));
        }

        foreach ([
            ['step_order' => 1, 'step_name' => 'Thesis Advisor Approval', 'approver_role' => 'advisor'],
            ['step_order' => 2, 'step_name' => 'Faculty Dean Approval',   'approver_role' => 'faculty_dean'],
        ] as $step) {
            $research->workflowSteps()->create(array_merge($step, ['can_reject' => true, 'can_return' => true]));
        }

        $this->call(FormRequestSeeder::class);
    }
}
