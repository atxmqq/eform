<x-layout title="{{ __('ui.dashboard.admin_title') }}">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">{{ __('ui.dashboard.admin_title') }}</h1>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        @foreach([
            ['label' => __('ui.dashboard.total_submissions'), 'value' => $stats['total_submissions'], 'color' => 'blue',   'icon' => '📋'],
            ['label' => __('ui.dashboard.pending_count'),     'value' => $stats['pending'],           'color' => 'yellow', 'icon' => '⏳'],
            ['label' => __('ui.dashboard.approved_count'),    'value' => $stats['approved'],          'color' => 'green',  'icon' => '✅'],
            ['label' => __('ui.dashboard.rejected_count'),    'value' => $stats['rejected'],          'color' => 'red',    'icon' => '❌'],
        ] as $stat)
        <div class="bg-white border border-gray-200 rounded-xl p-5">
            <div class="text-2xl mb-1">{{ $stat['icon'] }}</div>
            <div class="text-2xl font-bold text-gray-800">{{ $stat['value'] }}</div>
            <div class="text-sm text-gray-500">{{ $stat['label'] }}</div>
        </div>
        @endforeach
    </div>

    {{-- Quick Links --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
        <a href="{{ route('admin.form-types.index') }}" class="bg-blue-600 text-white rounded-xl p-6 hover:bg-blue-700 transition">
            <div class="text-3xl mb-2">📝</div>
            <h3 class="font-bold text-lg">{{ __('ui.dashboard.manage_forms') }}</h3>
            <p class="text-blue-200 text-sm mt-1">{{ __('ui.dashboard.manage_forms_desc') }}</p>
        </a>
        <a href="{{ route('admin.users.index') }}" class="bg-purple-600 text-white rounded-xl p-6 hover:bg-purple-700 transition">
            <div class="text-3xl mb-2">👥</div>
            <h3 class="font-bold text-lg">{{ __('ui.dashboard.manage_users') }}</h3>
            <p class="text-purple-200 text-sm mt-1">{{ __('ui.dashboard.manage_users_desc') }}</p>
        </a>
    </div>

    {{-- Recent Submissions --}}
    <section>
        <h2 class="text-lg font-semibold text-gray-700 mb-4">{{ __('ui.dashboard.recent_all') }}</h2>
        @if($recent->isEmpty())
            <div class="bg-white border border-gray-200 rounded-xl p-8 text-center text-gray-400">{{ __('ui.dashboard.no_data') }}</div>
        @else
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">{{ __('ui.dashboard.submitter_col') }}</th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">{{ __('ui.submission.form_type_col') }}</th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">{{ __('ui.submission.submitted_date_col') }}</th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">{{ __('ui.common.status') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($recent as $sub)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-800">{{ $sub->submitter->name }}</div>
                            <div class="text-xs text-gray-400">{{ $sub->submitter->email }}</div>
                        </td>
                        <td class="px-4 py-3 text-gray-700">{{ $sub->formType->name }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $sub->submitted_at?->format('d/m/Y') ?? '-' }}</td>
                        <td class="px-4 py-3">
                            @include('components.status-badge', ['status' => $sub->status, 'label' => $sub->status_label])
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </section>
</x-layout>
