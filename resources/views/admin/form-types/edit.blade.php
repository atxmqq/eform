<x-layout title="{{ __('ui.admin.edit_prefix') }}: {{ $formType->name }}">
    <div class="mb-6">
        <a href="{{ route('admin.form-types.index') }}" class="text-gray-500 hover:text-gray-700 text-sm">{{ __('ui.common.back') }}</a>
        <h1 class="text-2xl font-bold text-gray-800 mt-2">{{ $formType->name }}</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Left: Form Info + Fields --}}
        <div class="space-y-6">

            {{-- Basic Info --}}
            <div class="bg-white border border-gray-200 rounded-xl p-6">
                <h2 class="font-semibold text-gray-700 mb-4">{{ __('ui.admin.general_info') }}</h2>
                <form action="{{ route('admin.form-types.update', $formType) }}" method="POST" class="space-y-3">
                    @csrf @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('ui.common.name') }}</label>
                        <input type="text" name="name" value="{{ old('name', $formType->name) }}" required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('ui.admin.description_label') }}</label>
                        <textarea name="description" rows="2"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $formType->description) }}</textarea>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="is_active" value="1" {{ $formType->is_active ? 'checked' : '' }}>
                        <label for="is_active" class="text-sm text-gray-700">{{ __('ui.admin.active_label') }}</label>
                    </div>
                    <div class="grid grid-cols-2 gap-3 pt-1">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('ui.admin.opens_at_label') }}</label>
                            <input type="datetime-local" name="opens_at"
                                   value="{{ old('opens_at', $formType->opens_at?->format('Y-m-d\TH:i')) }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <p class="text-xs text-gray-400 mt-0.5">{{ __('ui.admin.no_limit_hint') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('ui.admin.closes_at_label') }}</label>
                            <input type="datetime-local" name="closes_at"
                                   value="{{ old('closes_at', $formType->closes_at?->format('Y-m-d\TH:i')) }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <p class="text-xs text-gray-400 mt-0.5">{{ __('ui.admin.no_limit_hint') }}</p>
                        </div>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">{{ __('ui.common.save') }}</button>
                </form>
            </div>

            {{-- Form Fields --}}
            <div class="bg-white border border-gray-200 rounded-xl p-6">
                <h2 class="font-semibold text-gray-700 mb-4">{{ __('ui.admin.form_fields') }}</h2>

                @if($formType->fields->isNotEmpty())
                <div class="space-y-2 mb-4">
                    @foreach($formType->fields as $field)
                    <div class="flex items-center justify-between bg-gray-50 border border-gray-200 rounded-lg px-3 py-2">
                        <div>
                            <span class="text-sm font-medium text-gray-800">{{ $field->label }}</span>
                            <span class="text-xs text-gray-400 ml-2">{{ $fieldTypes[$field->field_type] ?? $field->field_type }}</span>
                            @if($field->is_required)
                                <span class="text-xs text-red-500 ml-1">*{{ __('ui.admin.required_badge') }}</span>
                            @endif
                        </div>
                        <form action="{{ route('admin.form-types.fields.destroy', [$formType, $field]) }}" method="POST"
                              onsubmit="return confirm('{{ __('ui.admin.confirm_delete_field') }}')">
                            @csrf @method('DELETE')
                            <button class="text-red-400 hover:text-red-600 text-xs">{{ __('ui.common.delete') }}</button>
                        </form>
                    </div>
                    @endforeach
                </div>
                @endif

                {{-- Add Field Form --}}
                <details class="group">
                    <summary class="cursor-pointer text-sm text-blue-600 font-medium hover:underline list-none">
                        + {{ __('ui.admin.add_field') }}
                    </summary>
                    <form action="{{ route('admin.form-types.fields.store', $formType) }}" method="POST" class="mt-3 space-y-3 border-t border-gray-100 pt-3">
                        @csrf
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">{{ __('ui.admin.field_label') }}</label>
                                <input type="text" name="label" required placeholder="{{ __('ui.admin.field_label_placeholder') }}"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">{{ __('ui.admin.field_key') }}</label>
                                <input type="text" name="field_key" required placeholder="{{ __('ui.admin.field_key_placeholder') }}"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">{{ __('ui.admin.field_type') }}</label>
                                <select name="field_type" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    @foreach($fieldTypes as $val => $label)
                                        <option value="{{ $val }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-end pb-2">
                                <label class="flex items-center gap-2 text-sm text-gray-700">
                                    <input type="checkbox" name="is_required" value="1"> {{ __('ui.admin.field_required') }}
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Placeholder</label>
                            <input type="text" name="placeholder" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">{{ __('ui.admin.field_options_label') }}</label>
                            <textarea name="options" rows="3" placeholder="{{ __('ui.admin.field_options_placeholder') }}"
                                      class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">{{ __('ui.admin.add_field') }}</button>
                    </form>
                </details>
            </div>
        </div>

        {{-- Right: Workflow --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <h2 class="font-semibold text-gray-700 mb-1">{{ __('ui.admin.workflow_title') }}</h2>
            <p class="text-xs text-gray-400 mb-4">{{ __('ui.admin.workflow_subtitle') }}</p>

            @if($formType->workflowSteps->isNotEmpty())
            <div class="space-y-2 mb-4" id="workflow-list">
                @foreach($formType->workflowSteps as $step)
                <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-lg px-3 py-3 cursor-move" draggable="true" data-step-id="{{ $step->id }}">
                    <span class="text-gray-400 text-sm">⠿</span>
                    <div class="flex-1">
                        <div class="text-sm font-medium text-gray-800">{{ $step->step_order }}. {{ $step->step_name }}</div>
                        <div class="text-xs text-gray-400">{{ $step->role_name }}</div>
                        <div class="flex gap-2 mt-1">
                            @if($step->can_reject)
                                <span class="text-xs bg-red-50 text-red-500 px-1.5 py-0.5 rounded">{{ __('ui.admin.can_reject') }}</span>
                            @endif
                            @if($step->can_return)
                                <span class="text-xs bg-orange-50 text-orange-500 px-1.5 py-0.5 rounded">{{ __('ui.admin.can_return') }}</span>
                            @endif
                        </div>
                    </div>
                    <form action="{{ route('admin.workflow.destroy', [$formType, $step]) }}" method="POST"
                          onsubmit="return confirm('{{ __('ui.admin.confirm_delete_step') }}')">
                        @csrf @method('DELETE')
                        <button class="text-red-400 hover:text-red-600 text-sm">{{ __('ui.common.delete') }}</button>
                    </form>
                </div>
                @endforeach
            </div>
            @else
            <div class="border-2 border-dashed border-gray-200 rounded-lg p-6 text-center text-gray-400 text-sm mb-4">
                {{ __('ui.admin.no_workflow_steps') }}
            </div>
            @endif

            {{-- Add Step --}}
            <details class="group">
                <summary class="cursor-pointer text-sm text-blue-600 font-medium hover:underline list-none">
                    + {{ __('ui.admin.add_step') }}
                </summary>
                <form action="{{ route('admin.workflow.store', $formType) }}" method="POST" class="mt-3 space-y-3 border-t border-gray-100 pt-3">
                    @csrf
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">{{ __('ui.admin.step_name') }}</label>
                        <input type="text" name="step_name" required placeholder="{{ __('ui.admin.step_name_placeholder') }}"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">{{ __('ui.admin.approver_role') }}</label>
                        <select name="approver_role" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @foreach($approverRoles as $role => $label)
                                <option value="{{ $role }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 text-sm text-gray-700">
                            <input type="checkbox" name="can_reject" value="1" checked> {{ __('ui.admin.can_reject') }}
                        </label>
                        <label class="flex items-center gap-2 text-sm text-gray-700">
                            <input type="checkbox" name="can_return" value="1" checked> {{ __('ui.admin.can_return') }}
                        </label>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">{{ __('ui.admin.add_step') }}</button>
                </form>
            </details>
        </div>
    </div>
</x-layout>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const list = document.getElementById('workflow-list');
    if (list) {
        sortable(list);
        list.addEventListener('reorder', () => {
            const ids = [...list.querySelectorAll('[data-step-id]')].map(el => el.dataset.stepId);
            fetch('{{ route('admin.workflow.reorder', $formType) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ steps: ids }),
            }).then(() => location.reload());
        });
    }
});
</script>
