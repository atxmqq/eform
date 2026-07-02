<x-layout title="{{ __('ui.approval.pending_list') }}">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">{{ __('ui.approval.pending_list') }}</h1>
        <p class="text-gray-500 text-sm">{{ auth()->user()->role_name }}</p>
    </div>

    @if($pending->isEmpty())
        <div class="bg-white border border-gray-200 rounded-xl p-12 text-center">
            <div class="text-5xl mb-4">✅</div>
            <p class="text-gray-500">{{ __('ui.approval.no_pending') }}</p>
        </div>
    @else
    <div class="space-y-3">
        @foreach($pending as $approval)
        <div class="bg-white border border-yellow-200 rounded-xl p-5 hover:border-blue-300 hover:shadow-sm transition">
            <div class="flex items-start justify-between gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-2 flex-wrap mb-2">
                        <span class="font-semibold text-gray-800 text-base">{{ $approval->submission->formType->name }}</span>
                        <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">{{ $approval->workflowStep->step_name }}</span>
                    </div>
                    <p class="text-sm text-gray-600">
                        {{ __('ui.approval.submitter_label') }}: <span class="font-medium text-gray-800">{{ $approval->submission->submitter->name }}</span>
                        <span class="text-gray-400">({{ $approval->submission->submitter->email }})</span>
                    </p>
                    @if($approval->submission->submitter->student_id)
                        <p class="text-xs text-gray-400">{{ __('ui.approval.student_id_label') }}: {{ $approval->submission->submitter->student_id }}</p>
                    @endif
                    <p class="text-xs text-gray-400 mt-1">{{ __('ui.approval.submitted_at_label') }}: {{ $approval->submission->submitted_at?->format('d/m/Y H:i') }}</p>
                </div>
                <a href="{{ route('approver.show', $approval->submission) }}"
                   class="shrink-0 bg-blue-600 text-white px-5 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                    {{ __('ui.approval.review_btn') }}
                </a>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-4">{{ $pending->links() }}</div>
    @endif
</x-layout>
