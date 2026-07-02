<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $formType = DB::table('form_types')->where('code', 'leave_study')->first();
        if (!$formType) return;

        $id = $formType->id;

        // Update existing semester field: label → ปีการศึกษา, placeholder → เช่น 2567
        DB::table('form_fields')
            ->where('form_type_id', $id)
            ->where('field_key', 'semester')
            ->update([
                'label'       => 'ปีการศึกษา',
                'placeholder' => 'เช่น 2567',
                'sort_order'  => 3,
            ]);

        // Shift attachment to sort_order 6
        DB::table('form_fields')
            ->where('form_type_id', $id)
            ->where('field_key', 'attachment')
            ->update(['sort_order' => 6]);

        // Shift reason to sort_order 4
        DB::table('form_fields')
            ->where('form_type_id', $id)
            ->where('field_key', 'reason')
            ->update(['sort_order' => 4]);

        // Insert new fields
        $now = now();

        DB::table('form_fields')->insert([
            [
                'form_type_id' => $id,
                'label'        => 'คำนำหน้าชื่อ',
                'field_key'    => 'title',
                'field_type'   => 'radio',
                'is_required'  => true,
                'options'      => json_encode(['นาย', 'นาง', 'นางสาว']),
                'placeholder'  => null,
                'help_text'    => null,
                'sort_order'   => 0,
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            [
                'form_type_id' => $id,
                'label'        => 'ระบบการศึกษา',
                'field_key'    => 'class_schedule',
                'field_type'   => 'radio',
                'is_required'  => true,
                'options'      => json_encode(['ระบบในเวลาราชการ', 'ระบบนอกเวลาราชการ']),
                'placeholder'  => null,
                'help_text'    => null,
                'sort_order'   => 1,
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            [
                'form_type_id' => $id,
                'label'        => 'ภาคการศึกษาที่ขอลาพัก',
                'field_key'    => 'semester_term',
                'field_type'   => 'radio',
                'is_required'  => true,
                'options'      => json_encode(['ภาคต้น', 'ภาคปลาย', 'ภาคการศึกษาพิเศษ']),
                'placeholder'  => null,
                'help_text'    => null,
                'sort_order'   => 2,
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
        ]);
    }

    public function down(): void
    {
        $formType = DB::table('form_types')->where('code', 'leave_study')->first();
        if (!$formType) return;

        $id = $formType->id;

        DB::table('form_fields')
            ->where('form_type_id', $id)
            ->whereIn('field_key', ['title', 'class_schedule', 'semester_term'])
            ->delete();

        DB::table('form_fields')
            ->where('form_type_id', $id)
            ->where('field_key', 'semester')
            ->update([
                'label'       => 'ภาคการศึกษา/ปีการศึกษาที่ขอลาพัก',
                'placeholder' => 'เช่น 1/2567',
                'sort_order'  => 0,
            ]);

        DB::table('form_fields')
            ->where('form_type_id', $id)
            ->where('field_key', 'reason')
            ->update(['sort_order' => 1]);

        DB::table('form_fields')
            ->where('form_type_id', $id)
            ->where('field_key', 'attachment')
            ->update(['sort_order' => 2]);
    }
};
