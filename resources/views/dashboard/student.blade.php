<x-layout title="{{ __('ui.dashboard.submit_new') }}">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800">{{ __('ui.dashboard.hello') }}, {{ auth()->user()->name }}</h1>
        <p class="text-gray-500 mt-1">{{ __('ui.dashboard.select_form_type') }}</p>
    </div>

    {{-- Form Types --}}
    <section class="mb-10">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">{{ __('ui.dashboard.submit_new') }}</h2>
        @if($formTypes->isEmpty())
            <div class="bg-white border border-gray-200 rounded-xl p-8 text-center text-gray-400">
                {{ __('ui.dashboard.no_forms') }}
            </div>
        @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($formTypes as $type)
            @php
                $open = $type->isOpen();
                $notYet = $type->opens_at && now()->lt($type->opens_at);
            @endphp
            @if($open)
            <a href="{{ route('student.submissions.create', $type) }}"
               class="bg-white border border-gray-200 rounded-xl p-6 hover:border-blue-400 hover:shadow-md transition group">
                <div class="flex items-start justify-between mb-3">
                    <div class="text-3xl">📄</div>
                    @if($type->closes_at)
                        <span class="text-xs bg-green-50 text-green-700 border border-green-200 rounded-full px-2 py-0.5">
                            {{ __('ui.dashboard.closes_badge') }} {{ $type->closes_at->format('d/m/Y') }}
                        </span>
                    @endif
                </div>
                <h3 class="font-semibold text-gray-800 group-hover:text-blue-700">{{ $type->name }}</h3>
                @if($type->description)
                    <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $type->description }}</p>
                @endif
                <div class="mt-4 text-sm text-blue-600 font-medium">{{ __('ui.dashboard.submit_btn') }}</div>
            </a>
            @else
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 opacity-60 cursor-not-allowed">
                <div class="flex items-start justify-between mb-3">
                    <div class="text-3xl grayscale">📄</div>
                    @if($notYet)
                        <span class="text-xs bg-yellow-50 text-yellow-700 border border-yellow-200 rounded-full px-2 py-0.5">
                            {{ __('ui.dashboard.opens_badge') }} {{ $type->opens_at->format('d/m/Y') }}
                        </span>
                    @else
                        <span class="text-xs bg-red-50 text-red-600 border border-red-200 rounded-full px-2 py-0.5">
                            {{ __('ui.dashboard.closed_badge') }}
                        </span>
                    @endif
                </div>
                <h3 class="font-semibold text-gray-700">{{ $type->name }}</h3>
                @if($type->description)
                    <p class="text-sm text-gray-400 mt-1 line-clamp-2">{{ $type->description }}</p>
                @endif
                <div class="mt-4 text-sm text-gray-400">
                    @if($notYet)
                        {{ __('ui.dashboard.opens_on', ['date' => $type->opens_at->format('d/m/Y H:i')]) }}
                    @else
                        {{ __('ui.dashboard.closed_on', ['date' => $type->closes_at?->format('d/m/Y H:i') ?? '']) }}
                    @endif
                </div>
            </div>
            @endif
            @endforeach
        </div>
        @endif
    </section>

    {{-- Recent Submissions --}}
    <section>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700">{{ __('ui.dashboard.recent_submissions') }}</h2>
            <a href="{{ route('student.submissions.index') }}" class="text-sm text-blue-600 hover:underline">{{ __('ui.dashboard.view_all') }}</a>
        </div>

        @if($submissions->isEmpty())
            <div class="bg-white border border-gray-200 rounded-xl p-8 text-center text-gray-400">
                {{ __('ui.dashboard.no_submissions_yet') }}
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
                    @foreach($submissions->take(5) as $sub)
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
        @endif
    </section>
</x-layout>
