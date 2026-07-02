<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $now = now();

        // ── leave_study ──────────────────────────────────────────────────────
        $ft = DB::table('form_types')->where('code', 'leave_study')->first();
        if ($ft) {
            // Shift existing fields up by 1
            DB::table('form_fields')->where('form_type_id', $ft->id)
                ->increment('sort_order', 1);

            DB::table('form_fields')->insert([[
                'form_type_id' => $ft->id,
                'label'        => 'อาจารย์ที่ปรึกษา',
                'field_key'    => 'thesis_advisor_id',
                'field_type'   => 'advisor_select',
                'is_required'  => true,
                'options'      => null,
                'placeholder'  => null,
                'help_text'    => null,
                'sort_order'   => 0,
                'created_at'   => $now,
                'updated_at'   => $now,
            ]]);
        }

        // ── thesis_registration ───────────────────────────────────────────────
        $ft = DB::table('form_types')->where('code', 'thesis_registration')->first();
        if ($ft) {
            // Remove old text advisor_name field
            DB::table('form_fields')
                ->where('form_type_id', $ft->id)
                ->where('field_key', 'advisor_name')
                ->delete();

            // Insert advisor_select at the same position (sort_order 3)
            DB::table('form_fields')->insert([[
                'form_type_id' => $ft->id,
                'label'        => 'อาจารย์ที่ปรึกษา',
                'field_key'    => 'thesis_advisor_id',
                'field_type'   => 'advisor_select',
                'is_required'  => true,
                'options'      => null,
                'placeholder'  => null,
                'help_text'    => null,
                'sort_order'   => 3,
                'created_at'   => $now,
                'updated_at'   => $now,
            ]]);
        }

        // ── restore_status ────────────────────────────────────────────────────
        $ft = DB::table('form_types')->where('code', 'restore_status')->first();
        if ($ft) {
            // Shift existing fields up by 1
            DB::table('form_fields')->where('form_type_id', $ft->id)
                ->increment('sort_order', 1);

            DB::table('form_fields')->insert([[
                'form_type_id' => $ft->id,
                'label'        => 'อาจารย์ที่ปรึกษา',
                'field_key'    => 'thesis_advisor_id',
                'field_type'   => 'advisor_select',
                'is_required'  => true,
                'options'      => null,
                'placeholder'  => null,
                'help_text'    => null,
                'sort_order'   => 0,
                'created_at'   => $now,
                'updated_at'   => $now,
            ]]);

            // Add advisor as step 1, shift existing steps by 1
            DB::table('workflow_steps')->where('form_type_id', $ft->id)
                ->increment('step_order', 1);

            DB::table('workflow_steps')->insert([[
                'form_type_id' => $ft->id,
                'step_order'   => 1,
                'step_name'    => 'ผ่านอาจารย์ที่ปรึกษา',
                'approver_role' => 'advisor',
                'can_reject'   => true,
                'can_return'   => true,
                'created_at'   => $now,
                'updated_at'   => $now,
            ]]);
        }

        // ── special_status — remove advisor/chair/dean steps, keep officer path ──
        $ft = DB::table('form_types')->where('code', 'special_status')->first();
        if ($ft) {
            DB::table('workflow_steps')
                ->where('form_type_id', $ft->id)
                ->whereIn('approver_role', ['advisor', 'program_chair', 'faculty_dean'])
                ->delete();

            // Renumber remaining steps starting at 1
            $steps = DB::table('workflow_steps')
                ->where('form_type_id', $ft->id)
                ->orderBy('step_order')
                ->pluck('id');

            foreach ($steps as $i => $id) {
                DB::table('workflow_steps')->where('id', $id)->update(['step_order' => $i + 1]);
            }
        }
    }

    public function down(): void
    {
        // Remove thesis_advisor_id from leave_study, thesis_registration, restore_status
        foreach (['leave_study', 'thesis_registration', 'restore_status'] as $code) {
            $ft = DB::table('form_types')->where('code', $code)->first();
            if (!$ft) continue;
            DB::table('form_fields')
                ->where('form_type_id', $ft->id)
                ->where('field_key', 'thesis_advisor_id')
                ->delete();
        }

        // Restore advisor_name to thesis_registration
        $ft = DB::table('form_types')->where('code', 'thesis_registration')->first();
        if ($ft) {
            DB::table('form_fields')->insert([[
                'form_type_id' => $ft->id,
                'label'        => 'ชื่ออาจารย์ที่ปรึกษา',
                'field_key'    => 'advisor_name',
                'field_type'   => 'text',
                'is_required'  => true,
                'options'      => null,
                'placeholder'  => null,
                'help_text'    => null,
                'sort_order'   => 3,
                'created_at'   => now(),
                'updated_at'   => now(),
            ]]);
        }
    }
};
