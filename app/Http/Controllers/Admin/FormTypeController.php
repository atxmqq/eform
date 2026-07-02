<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormField;
use App\Models\FormType;
use Illuminate\Http\Request;

class FormTypeController extends Controller
{
    public function index()
    {
        $formTypes = FormType::withCount('submissions')->latest()->get();
        return view('admin.form-types.index', compact('formTypes'));
    }

    public function create()
    {
        return view('admin.form-types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:50|unique:form_types,code|regex:/^[a-z0-9_]+$/',
            'description' => 'nullable|string',
        ]);

        FormType::create($request->only('name', 'code', 'description'));

        return redirect()->route('admin.form-types.index')->with('success', 'สร้างประเภทคำร้องสำเร็จ');
    }

    public function edit(FormType $formType)
    {
        $formType->load(['fields', 'workflowSteps']);
        $fieldTypes = FormField::FIELD_TYPES;
        $approverRoles = collect(\App\Models\User::ROLES)
            ->except(['admin', 'student']);
        return view('admin.form-types.edit', compact('formType', 'fieldTypes', 'approverRoles'));
    }

    public function update(Request $request, FormType $formType)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'is_active'   => 'boolean',
            'opens_at'    => 'nullable|date',
            'closes_at'   => 'nullable|date|after_or_equal:opens_at',
        ]);

        $formType->update([
            'name'        => $request->name,
            'description' => $request->description,
            'is_active'   => $request->boolean('is_active'),
            'opens_at'    => $request->filled('opens_at') ? $request->opens_at : null,
            'closes_at'   => $request->filled('closes_at') ? $request->closes_at : null,
        ]);

        return redirect()->route('admin.form-types.edit', $formType)->with('success', 'แก้ไขข้อมูลสำเร็จ');
    }

    public function destroy(FormType $formType)
    {
        $formType->delete();
        return redirect()->route('admin.form-types.index')->with('success', 'ลบประเภทคำร้องสำเร็จ');
    }

    public function storeField(Request $request, FormType $formType)
    {
        $request->validate([
            'label'      => 'required|string|max:255',
            'field_key'  => 'required|string|max:100|regex:/^[a-z0-9_]+$/|unique:form_fields,field_key,NULL,id,form_type_id,' . $formType->id,
            'field_type' => 'required|in:' . implode(',', array_keys(FormField::FIELD_TYPES)),
            'options'    => 'nullable|string',
        ]);

        $options = null;
        if ($request->filled('options')) {
            $options = collect(explode("\n", $request->options))
                ->map(fn($o) => trim($o))
                ->filter()
                ->values()
                ->toArray();
        }

        $formType->fields()->create([
            'label'       => $request->label,
            'field_key'   => $request->field_key,
            'field_type'  => $request->field_type,
            'is_required' => $request->boolean('is_required'),
            'options'     => $options,
            'placeholder' => $request->placeholder,
            'help_text'   => $request->help_text,
            'sort_order'  => $formType->fields()->count(),
        ]);

        return back()->with('success', 'เพิ่มช่องข้อมูลสำเร็จ');
    }

    public function destroyField(FormType $formType, FormField $field)
    {
        $field->delete();
        return back()->with('success', 'ลบช่องข้อมูลสำเร็จ');
    }
}
