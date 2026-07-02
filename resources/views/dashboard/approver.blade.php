<x-layout title="{{ __('ui.approval.pending_list') }}">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">{{ __('ui.approval.pending_list') }}</h1>
        <p class="text-gray-500 mt-1">{{ auth()->user()->role_name }}</p>
    </div>

    @if($pending->isEmpty())
    <div class="bg-white border border-gray-200 rounded-xl p-12 text-center">
        <div class="text-5xl mb-4">✅</div>
        <p class="text-gray-500">{{ __('ui.approval.no_pending') }}</p>
    </div>
    @else
    <div class="space-y-3">
        @foreach($pending as $approval)
        <div class="bg-white border border-gray-200 rounded-xl p-5 hover:border-blue-300 transition hover:shadow-sm">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="font-semibold text-gray-800">{{ $approval->submission->formType->name }}</span>
                        <span class="text-xs bg-yellow-50 text-yellow-700 border border-yellow-200 px-2 py-0.5 rounded-full">
                            {{ __('ui.dashboard.step_label') }}: {{ $approval->workflowStep->step_name }}
                        </span>
                    </div>
                    <p class="text-sm text-gray-600">
                        {{ __('ui.approval.submitter_label') }}: <span class="font-medium text-gray-900">{{ $approval->submission->submitter->name }}</span>
                        <span class="text-gray-400">({{ $approval->submission->submitter->email }})</span>
                    </p>
                    <p class="text-xs text-gray-400 mt-1">
                        {{ __('ui.approval.submitted_at_label') }}: {{ $approval->submission->submitted_at?->format('d/m/Y H:i') }}
                    </p>
                </div>
                <a href="{{ route('approver.show', $approval->submission) }}"
                    class="shrink-0 bg-blue-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium hover:bg-blue-700 transition shadow-sm">
                    {{ __('ui.dashboard.proceed_btn') }}
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    @if($recent->isNotEmpty())
    <section class="mt-10">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">{{ __('ui.dashboard.history') }}</h2>
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden shadow-sm">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">{{ __('ui.submission.form_type_col') }}</th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">{{ __('ui.approval.submitter_label') }}</th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">{{ __('ui.dashboard.action_col') }}</th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium">{{ __('ui.submission.submitted_date_col') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($recent as $act)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-gray-800 font-medium">{{ $act->submission->formType->name }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $act->submission->submitter->name }}</td>
                        <td class="px-4 py-3">
                            @php
                            $statusClass = match($act->action) {
                            'approved' => 'bg-green-100 text-green-700 border border-green-200',
                            'rejected' => 'bg-red-100 text-red-700 border border-red-200',
                            'returned' => 'bg-orange-100 text-orange-700 border border-orange-200',
                            default => 'bg-gray-100 text-gray-600 border border-gray-200',
                            };
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClass }}">
                                {{ $act->action_label }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-400 text-xs">{{ $act->acted_at?->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    @endif
</x-layout>