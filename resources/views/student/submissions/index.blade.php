<x-layout title="{{ __('ui.submission.my_submissions') }}">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">{{ __('ui.submission.my_submissions') }}</h1>
        <a href="{{ route('dashboard') }}" class="text-sm text-blue-600 hover:underline">{{ __('ui.submission.new_request') }}</a>
    </div>

    @if($submissions->isEmpty())
        <div class="bg-white border border-gray-200 rounded-xl p-12 text-center">
            <div class="text-5xl mb-4">📋</div>
            <p class="text-gray-500 mb-4">{{ __('ui.submission.empty') }}</p>
            <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">{{ __('ui.submission.first_request') }}</a>
        </div>
    @else
    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 text-left text-gray-600 font-medium">{{ __('ui.submission.form_type_col') }}</th>
                    <th class="px-4 py-3 text-left text-gray-600 font-medium">{{ __('ui.submission.submitted_date_col') }}</th>
                    <th class="px-4 py-3 text-left text-gray-600 font-medium">{{ __('ui.common.status') }}</th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($submissions as $sub)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 font-medium text-gray-800">{{ $sub->formType->name }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $sub->submitted_at?->format('d/m/Y H:i') ?? '-' }}</td>
                    <td class="px-4 py-3">
                        @include('components.status-badge', ['status' => $sub->status, 'label' => $sub->status_label])
                    </td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('student.submissions.show', $sub) }}" class="text-blue-600 hover:underline text-xs">{{ __('ui.common.view_details') }}</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $submissions->links() }}</div>
    @endif
</x-layout>
