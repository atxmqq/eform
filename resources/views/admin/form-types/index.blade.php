<x-layout title="{{ __('ui.admin.form_types_title') }}">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">{{ __('ui.admin.form_types_title') }}</h1>
            <p class="text-gray-500 text-sm mt-1">{{ __('ui.admin.form_types_subtitle') }}</p>
        </div>
        <a href="{{ route('admin.form-types.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition flex items-center gap-2">
            <span>+</span> {{ __('ui.admin.add_form_type') }}
        </a>
    </div>

    @if($formTypes->isEmpty())
        <div class="bg-white border border-gray-200 rounded-xl p-12 text-center">
            <div class="text-5xl mb-4">📋</div>
            <p class="text-gray-500 mb-4">{{ __('ui.admin.no_form_types') }}</p>
            <a href="{{ route('admin.form-types.create') }}" class="text-blue-600 hover:underline">{{ __('ui.admin.create_first') }}</a>
        </div>
    @else
    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 text-left text-gray-600 font-medium">{{ __('ui.common.name') }}</th>
                    <th class="px-4 py-3 text-left text-gray-600 font-medium">{{ __('ui.admin.code_col') }}</th>
                    <th class="px-4 py-3 text-left text-gray-600 font-medium">{{ __('ui.admin.total_submissions_col') }}</th>
                    <th class="px-4 py-3 text-left text-gray-600 font-medium">{{ __('ui.common.status') }}</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($formTypes as $type)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <div class="font-medium text-gray-800">{{ $type->name }}</div>
                        @if($type->description)
                            <div class="text-xs text-gray-400">{{ Str::limit($type->description, 60) }}</div>
                        @endif
                    </td>
                    <td class="px-4 py-3"><code class="text-xs bg-gray-100 px-2 py-0.5 rounded">{{ $type->code }}</code></td>
                    <td class="px-4 py-3 text-gray-600">{{ $type->submissions_count }}</td>
                    <td class="px-4 py-3">
                        @if($type->is_active)
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">{{ __('ui.admin.active') }}</span>
                        @else
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">{{ __('ui.admin.inactive') }}</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.form-types.edit', $type) }}" class="text-blue-600 hover:underline text-xs">{{ __('ui.admin.edit_workflow') }}</a>
                            <form action="{{ route('admin.form-types.destroy', $type) }}" method="POST"
                                  onsubmit="return confirm('{{ __('ui.admin.confirm_delete') }}')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 hover:underline text-xs">{{ __('ui.common.delete') }}</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</x-layout>
