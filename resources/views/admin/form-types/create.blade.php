<x-layout title="{{ __('ui.admin.add_form_type') }}">
    <div class="mb-6">
        <a href="{{ route('admin.form-types.index') }}" class="text-gray-500 hover:text-gray-700 text-sm">{{ __('ui.common.back') }}</a>
        <h1 class="text-2xl font-bold text-gray-800 mt-2">{{ __('ui.admin.add_form_type') }}</h1>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl p-6 max-w-lg">
        <form action="{{ route('admin.form-types.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('ui.admin.form_name_label') }} <span class="text-red-500">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required
                       placeholder="{{ __('ui.admin.form_name_placeholder') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-400 @enderror">
                @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('ui.admin.code_label') }} <span class="text-red-500">*</span></label>
                <input type="text" name="code" value="{{ old(   'code') }}" required
                       placeholder="{{ __('ui.admin.code_placeholder') }}"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-blue-500 @error('code') border-red-400 @enderror">
                <p class="text-xs text-gray-400 mt-1">{{ __('ui.admin.code_hint') }}</p>
                @error('code')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('ui.admin.description_label') }}</label>
                <textarea name="description" rows="3" placeholder="{{ __('ui.admin.description_placeholder') }}"
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                    {{ __('ui.common.create') }}
                </button>
                <a href="{{ route('admin.form-types.index') }}" class="px-6 py-2 rounded-lg text-sm text-gray-600 border border-gray-300 hover:bg-gray-50 transition">
                    {{ __('ui.common.cancel') }}
                </a>
            </div>
        </form>
    </div>
</x-layout>
