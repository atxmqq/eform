<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $formType = DB::table('form_types')->where('code', 'leave_study')->first();
        if (!$formType) return;

        $id  = $formType->id;
        $now = now();

        // Remove title and class_schedule — those are student data from external DB
        DB::table('form_fields')
            ->where('form_type_id', $id)
            ->whereIn('field_key', ['title', 'class_schedule'])
            ->delete();

        // Re-order remaining fields
        DB::table('form_fields')->where('form_type_id', $id)->where('field_key', 'semester_term')->update(['sort_order' => 0]);
        DB::table('form_fields')->where('form_type_id', $id)->where('field_key', 'semester')     ->update(['sort_order' => 1]);
        DB::table('form_fields')->where('form_type_id', $id)->where('field_key', 'reason')       ->update(['sort_order' => 2]);
        DB::table('form_fields')->where('form_type_id', $id)->where('field_key', 'attachment')   ->update(['sort_order' => 3]);

        // Add thesis assignment fields
        DB::table('form_fields')->insert([
            [
                'form_type_id' => $id,
                'label'        => 'งานที่ทำแล้วเสร็จ',
                'field_key'    => 'thesis_finished',
                'field_type'   => 'text',
                'is_required'  => false,
                'options'      => null,
                'placeholder'  => 'ระบุรายละเอียด (ถ้ามี)',
                'help_text'    => 'กรณีได้รับอนุมัติให้ทำวิทยานิพนธ์/การศึกษาค้นคว้าอิสระ',
                'sort_order'   => 4,
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            [
                'form_type_id' => $id,
                'label'        => 'งานที่กำลังทำ',
                'field_key'    => 'thesis_in_progress',
                'field_type'   => 'text',
                'is_required'  => false,
                'options'      => null,
                'placeholder'  => 'ระบุรายละเอียด (ถ้ามี)',
                'help_text'    => null,
                'sort_order'   => 5,
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
            [
                'form_type_id' => $id,
                'label'        => 'งานที่ยังไม่ทำ',
                'field_key'    => 'thesis_not_started',
                'field_type'   => 'text',
                'is_required'  => false,
                'options'      => null,
                'placeholder'  => 'ระบุรายละเอียด (ถ้ามี)',
                'help_text'    => null,
                'sort_order'   => 6,
                'created_at'   => $now,
                'updated_at'   => $now,
            ],
        ]);
    }

    public function down(): void
    {
        $formType = DB::table('form_types')->where('code', 'leave_study')->first();
        if (!$formType) return;

        $id  = $formType->id;
        $now = now();

        DB::table('form_fields')
            ->where('form_type_id', $id)
            ->whereIn('field_key', ['thesis_finished', 'thesis_in_progress', 'thesis_not_started'])
            ->delete();

        // Restore title and class_schedule
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
        ]);

        DB::table('form_fields')->where('form_type_id', $id)->where('field_key', 'semester_term')->update(['sort_order' => 2]);
        DB::table('form_fields')->where('form_type_id', $id)->where('field_key', 'semester')     ->update(['sort_order' => 3]);
        DB::table('form_fields')->where('form_type_id', $id)->where('field_key', 'reason')       ->update(['sort_order' => 4]);
        DB::table('form_fields')->where('form_type_id', $id)->where('field_key', 'attachment')   ->update(['sort_order' => 6]);
    }
};
