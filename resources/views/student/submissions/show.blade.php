<x-layout title="{{ __('ui.submission.detail_title') }}">
    <div class="mb-6">
        <a href="{{ route('student.submissions.index') }}" class="text-gray-500 hover:text-gray-700 text-sm">{{ __('ui.common.back') }}</a>
        <div class="flex items-center justify-between mt-2">
            <h1 class="text-2xl font-bold text-gray-800">{{ $submission->formType->name }}</h1>
            <div class="flex items-center gap-3">
                @include('components.status-badge', ['status' => $submission->status, 'label' => $submission->status_label])
                @if(in_array($submission->formType->code, ['leave_study','thesis_registration','special_status','restore_status']))
                <a href="{{ route('submissions.pdf', $submission) }}"
                   target="_blank"
                   class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    {{ __('ui.submission.download_pdf') }}
                </a>
                @endif
            </div>
        </div>
        <p class="text-gray-500 text-sm mt-1">{{ __('ui.submission.submitted_at', ['date' => $submission->submitted_at?->format('d/m/Y H:i')]) }}</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Form Data --}}
        <div class="lg:col-span-2 bg-white border border-gray-200 rounded-xl p-6">
            <h2 class="font-semibold text-gray-700 mb-4">{{ __('ui.submission.form_data') }}</h2>
            <dl class="space-y-4">
                @foreach($submission->formType->fields as $field)
                <div>
                    <dt class="text-sm font-medium text-gray-500">{{ $field->label }}</dt>
                    <dd class="mt-1 text-sm text-gray-800">
                        {{ $submission->getFieldValue($field->field_key) ?? '-' }}
                    </dd>
                </div>
                @endforeach
            </dl>
        </div>

        {{-- Approval Timeline --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <h2 class="font-semibold text-gray-700 mb-4">{{ __('ui.submission.approval_steps') }}</h2>
            @if($submission->approvals->isEmpty())
                <p class="text-sm text-gray-400">{{ __('ui.submission.no_approval_steps') }}</p>
            @else
            <ol class="relative border-l border-gray-200 space-y-4 ml-2">
                @foreach($submission->approvals as $approval)
                @php
                    $colors = ['pending'=>'yellow','approved'=>'green','rejected'=>'red','returned'=>'orange','waiting'=>'gray'];
                    $c = $colors[$approval->action] ?? 'gray';
                    $dots = ['yellow'=>'bg-yellow-400','green'=>'bg-green-500','red'=>'bg-red-500','orange'=>'bg-orange-400','gray'=>'bg-gray-300'];
                @endphp
                <li class="ml-4">
                    <div class="absolute w-3 h-3 rounded-full -left-1.5 border border-white {{ $dots[$c] ?? 'bg-gray-300' }}"></div>
                    <div class="text-sm font-medium text-gray-800">{{ $approval->workflowStep->step_name }}</div>
                    <div class="text-xs text-gray-500">{{ $approval->workflowStep->role_name }}</div>
                    <div class="mt-1">
                        @php $actionColors = ['pending'=>'bg-yellow-100 text-yellow-700','approved'=>'bg-green-100 text-green-700','rejected'=>'bg-red-100 text-red-700','returned'=>'bg-orange-100 text-orange-700','waiting'=>'bg-gray-100 text-gray-500']; @endphp
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $actionColors[$approval->action] ?? 'bg-gray-100 text-gray-500' }}">
                            {{ $approval->action === 'waiting' ? __('ui.approval.action.waiting') : $approval->action_label }}
                        </span>
                    </div>
                    @if($approval->approver)
                        <p class="text-xs text-gray-400 mt-1">{{ __('ui.submission.by_approver', ['name' => $approval->approver->name]) }}</p>
                    @endif
                    @if($approval->comment)
                        <p class="text-xs text-gray-600 mt-1 bg-gray-50 rounded p-2">{{ $approval->comment }}</p>
                    @endif
                    @if($approval->acted_at)
                        <p class="text-xs text-gray-400">{{ $approval->acted_at->format('d/m/Y H:i') }}</p>
                    @endif
                </li>
                @endforeach
            </ol>
            @endif
        </div>
    </div>
</x-layout>
