<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($title) ? $title . ' - ' : '' }}{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">

{{-- Navbar --}}
<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center gap-4">
                <a href="{{ route('dashboard') }}" class="text-blue-700 font-bold text-lg tracking-tight">
                    📋 {{ config('app.name') }}
                </a>
                @auth
                <div class="hidden md:flex items-center gap-1">
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.form-types.index') }}" class="px-3 py-2 text-sm text-gray-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition">{{ __('ui.nav.form_types') }}</a>
                        <a href="{{ route('admin.users.index') }}" class="px-3 py-2 text-sm text-gray-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition">{{ __('ui.nav.manage_users') }}</a>
                    @elseif(auth()->user()->isStudent())
                        <a href="{{ route('student.submissions.index') }}" class="px-3 py-2 text-sm text-gray-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition">{{ __('ui.nav.my_submissions') }}</a>
                    @elseif(auth()->user()->canApprove())
                        <a href="{{ route('approver.index') }}" class="px-3 py-2 text-sm text-gray-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition">{{ __('ui.nav.pending_approvals') }}</a>
                    @endif
                </div>
                @endauth
            </div>
            @auth
            <div class="flex items-center gap-3">
                {{-- Language Switcher --}}
                <div class="flex items-center gap-0.5 text-xs border border-gray-200 rounded-lg overflow-hidden">
                    <a href="{{ route('lang.switch', 'th') }}"
                       class="px-2.5 py-1.5 transition {{ app()->getLocale() === 'th' ? 'bg-blue-600 text-white font-semibold' : 'text-gray-500 hover:bg-gray-100' }}">TH</a>
                    <a href="{{ route('lang.switch', 'en') }}"
                       class="px-2.5 py-1.5 transition {{ app()->getLocale() === 'en' ? 'bg-blue-600 text-white font-semibold' : 'text-gray-500 hover:bg-gray-100' }}">EN</a>
                </div>

                <div class="flex items-center gap-2">
                    @if(auth()->user()->avatar)
                        <img src="{{ auth()->user()->avatar }}" class="w-8 h-8 rounded-full object-cover">
                    @else
                        <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white text-sm font-bold">
                            {{ mb_substr(auth()->user()->name, 0, 1) }}
                        </div>
                    @endif
                    <div class="hidden sm:block">
                        <p class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-gray-400">{{ auth()->user()->role_name }}</p>
                    </div>
                </div>
                <a href="{{ route('profile.show') }}"
                   class="text-sm text-gray-500 hover:text-blue-600 transition px-2 py-1 rounded flex items-center gap-1">
                    @if(!auth()->user()->signature)
                        <span class="w-2 h-2 rounded-full bg-yellow-400 inline-block"></span>
                    @endif
                    {{ __('ui.nav.profile') }}
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="text-sm text-gray-500 hover:text-red-600 transition px-2 py-1 rounded">{{ __('ui.nav.logout') }}</button>
                </form>
            </div>
            @endauth
        </div>
    </div>
</nav>

{{-- Flash Messages --}}
@if(session('success'))
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center gap-2">
        <span>✅</span> {{ session('success') }}
    </div>
</div>
@endif
@if(session('error'))
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center gap-2">
        <span>❌</span> {{ session('error') }}
    </div>
</div>
@endif

{{-- Content --}}
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{ $slot }}
</main>

<script>
function sortable(el) {
    // Simple drag-and-drop reorder for workflow steps
    let dragSrc = null;
    el.querySelectorAll('[draggable]').forEach(item => {
        item.addEventListener('dragstart', e => { dragSrc = item; item.classList.add('opacity-50'); });
        item.addEventListener('dragend', e => item.classList.remove('opacity-50'));
        item.addEventListener('dragover', e => e.preventDefault());
        item.addEventListener('drop', e => {
            e.preventDefault();
            if (dragSrc !== item) {
                const items = [...el.querySelectorAll('[draggable]')];
                const srcIdx = items.indexOf(dragSrc);
                const dstIdx = items.indexOf(item);
                if (srcIdx < dstIdx) item.after(dragSrc);
                else item.before(dragSrc);
                el.dispatchEvent(new Event('reorder'));
            }
        });
    });
}
</script>
@stack('scripts')
</body>
</html>
