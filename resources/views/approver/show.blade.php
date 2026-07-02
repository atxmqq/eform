<x-layout title="{{ __('ui.approval.review_title') }}">
    <div class="mb-6">
        <a href="{{ route('approver.index') }}" class="text-gray-500 hover:text-gray-700 text-sm">{{ __('ui.common.back') }}</a>
        <div class="flex items-start justify-between mt-2">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ __('ui.approval.review_title') }}: {{ $submission->formType->name }}</h1>
                <p class="text-gray-500 text-sm mt-1">
                    {{ __('ui.approval.submitter_label') }}: {{ $submission->submitter->name }} —
                    {{ $approval->workflowStep->step_name }}
                </p>
            </div>
            @if(in_array($submission->formType->code, ['leave_study','thesis_registration','special_status','restore_status']))
            <a href="{{ route('submissions.pdf', $submission) }}"
               target="_blank"
               class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition mt-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                {{ __('ui.submission.download_pdf') }}
            </a>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Form Data --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white border border-gray-200 rounded-xl p-6">
                <h2 class="font-semibold text-gray-700 mb-4">{{ __('ui.approval.submitter_info') }}</h2>
                <dl class="grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <dt class="text-gray-500">{{ __('ui.common.name') }}</dt>
                        <dd class="font-medium text-gray-800">{{ $submission->submitter->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">{{ __('ui.common.email') }}</dt>
                        <dd class="font-medium text-gray-800">{{ $submission->submitter->email }}</dd>
                    </div>
                    @if($submission->submitter->student_id)
                    <div>
                        <dt class="text-gray-500">{{ __('ui.approval.student_id') }}</dt>
                        <dd class="font-medium text-gray-800">{{ $submission->submitter->student_id }}</dd>
                    </div>
                    @endif
                    @if($submission->submitter->department)
                    <div>
                        <dt class="text-gray-500">{{ __('ui.approval.department') }}</dt>
                        <dd class="font-medium text-gray-800">{{ $submission->submitter->department }}</dd>
                    </div>
                    @endif
                </dl>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl p-6">
                <h2 class="font-semibold text-gray-700 mb-4">{{ __('ui.submission.form_data') }}</h2>
                <dl class="space-y-4">
                    @foreach($submission->formType->fields as $field)
                    <div class="border-b border-gray-50 pb-3 last:border-0 last:pb-0">
                        <dt class="text-sm font-medium text-gray-500">{{ $field->label }}</dt>
                        <dd class="mt-1 text-sm text-gray-800">
                            @php $val = $submission->getFieldValue($field->field_key); @endphp
                            @if($field->field_type === 'file' && $val)
                                <a href="{{ asset('storage/' . $val) }}" target="_blank" class="text-blue-600 hover:underline">{{ __('ui.common.download_file') }}</a>
                            @else
                                {{ $val ?? '-' }}
                            @endif
                        </dd>
                    </div>
                    @endforeach
                </dl>
            </div>

            {{-- Action Form --}}
            <div class="bg-white border border-blue-200 rounded-xl p-6">
                <h2 class="font-semibold text-gray-700 mb-4">{{ __('ui.approval.action_section') }}</h2>
                <form action="{{ route('approver.act', $submission) }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('ui.approval.decision') }} <span class="text-red-500">*</span></label>
                        <div class="flex gap-3 flex-wrap">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="action" value="approved" required class="text-green-600">
                                <span class="text-sm font-medium text-green-700 bg-green-50 border border-green-200 px-3 py-1.5 rounded-lg">{{ __('ui.approval.approve') }}</span>
                            </label>
                            @if($approval->workflowStep->can_return)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="action" value="returned" class="text-orange-500">
                                <span class="text-sm font-medium text-orange-700 bg-orange-50 border border-orange-200 px-3 py-1.5 rounded-lg">{{ __('ui.approval.return_edit') }}</span>
                            </label>
                            @endif
                            @if($approval->workflowStep->can_reject)
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="action" value="rejected" class="text-red-500">
                                <span class="text-sm font-medium text-red-700 bg-red-50 border border-red-200 px-3 py-1.5 rounded-lg">{{ __('ui.approval.reject') }}</span>
                            </label>
                            @endif
                        </div>
                        @error('action')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">{{ __('ui.approval.comment') }}</label>
                        <textarea name="comment" rows="3" placeholder="{{ __('ui.approval.comment_placeholder') }}"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('comment') }}</textarea>
                    </div>
                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-blue-700 transition"
                            onclick="return confirm('{{ __('ui.approval.confirm_action') }}')">
                        {{ __('ui.approval.confirm_btn') }}
                    </button>
                </form>
            </div>
        </div>

        {{-- Timeline --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6 h-fit">
            <h2 class="font-semibold text-gray-700 mb-4">{{ __('ui.approval.all_steps') }}</h2>
            <ol class="relative border-l border-gray-200 space-y-4 ml-2">
                @foreach($submission->approvals as $step)
                @php
                    $isCurrent = $step->step_order === $submission->current_step_order;
                    $dots = ['approved'=>'bg-green-500','rejected'=>'bg-red-500','returned'=>'bg-orange-400','pending'=>'bg-yellow-400','waiting'=>'bg-gray-300'];
                @endphp
                <li class="ml-4">
                    <div class="absolute w-3 h-3 rounded-full -left-1.5 border border-white {{ $dots[$step->action] ?? 'bg-gray-300' }} {{ $isCurrent ? 'ring-2 ring-blue-300' : '' }}"></div>
                    <div class="text-sm font-medium {{ $isCurrent ? 'text-blue-700' : 'text-gray-800' }}">
                        {{ $step->workflowStep->step_name }}
                        @if($isCurrent) <span class="text-xs text-blue-500">({{ __('ui.approval.current_step') }})</span> @endif
                    </div>
                    <div class="text-xs text-gray-400">{{ $step->workflowStep->role_name }}</div>
                    @php $actionColors = ['pending'=>'text-yellow-600','approved'=>'text-green-600','rejected'=>'text-red-600','returned'=>'text-orange-600','waiting'=>'text-gray-400']; @endphp
                    <div class="text-xs {{ $actionColors[$step->action] ?? 'text-gray-400' }} mt-0.5">
                        {{ $step->action === 'waiting' ? __('ui.approval.action.waiting') : $step->action_label }}
                    </div>
                </li>
                @endforeach
            </ol>
        </div>
    </div>
</x-layout>
