<x-layout title="{{ __('ui.profile.title') }}">
    <div class="max-w-2xl mx-auto">

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">{{ __('ui.profile.title') }}</h1>
            <p class="text-gray-500 mt-1 text-sm">{{ __('ui.profile.signature_hint') }}</p>
        </div>

        {{-- Warning Banner --}}
        @if(!$user->signature)
        <div class="bg-yellow-50 border border-yellow-300 text-yellow-800 rounded-xl px-4 py-3 mb-6 flex items-center gap-3 text-sm">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/></svg>
            <span>{{ __('ui.profile.no_signature_warning') }}</span>
        </div>
        @endif

        {{-- User Info --}}
        <div class="bg-white border border-gray-200 rounded-xl p-5 mb-6">
            <div class="flex items-center gap-4">
                <div class="w-14 h-14 rounded-full bg-blue-600 flex items-center justify-center text-white text-xl font-bold flex-shrink-0">
                    {{ mb_substr($user->name, 0, 1) }}
                </div>
                <div>
                    <p class="font-semibold text-gray-800 text-lg">{{ $user->name }}</p>
                    <p class="text-sm text-gray-500">{{ $user->email }}</p>
                    <span class="inline-block mt-1 text-xs bg-blue-100 text-blue-700 rounded-full px-2 py-0.5">{{ $user->role_name }}</span>
                </div>
            </div>
        </div>

        {{-- Signature Setup --}}
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <h2 class="text-base font-semibold text-gray-800 mb-1">{{ __('ui.profile.signature_section') }}</h2>
            <p class="text-sm text-gray-500 mb-4">{{ __('ui.profile.signature_description') }}</p>

            {{-- Current Signature --}}
            @if($user->signature)
            <div class="mb-5 p-4 bg-gray-50 border border-gray-200 rounded-lg">
                <p class="text-xs text-gray-500 mb-2">{{ __('ui.profile.current_signature') }}</p>
                <img src="{{ Storage::url($user->signature) }}" alt="Signature" class="h-16 object-contain">
            </div>
            @endif

            {{-- Tab Switch --}}
            <div class="flex gap-2 mb-5" id="sig-tabs">
                <button type="button" onclick="switchTab('draw')"
                        id="tab-draw"
                        class="tab-btn px-4 py-2 rounded-lg text-sm font-medium border border-blue-600 bg-blue-600 text-white transition">
                    {{ __('ui.profile.draw_label') }}
                </button>
                <button type="button" onclick="switchTab('upload')"
                        id="tab-upload"
                        class="tab-btn px-4 py-2 rounded-lg text-sm font-medium border border-gray-300 text-gray-600 hover:bg-gray-50 transition">
                    {{ __('ui.profile.upload_label') }}
                </button>
            </div>

            {{-- Draw Tab --}}
            <form action="{{ route('profile.signature') }}" method="POST" enctype="multipart/form-data" id="form-draw">
                @csrf
                <input type="hidden" name="signature_type" value="draw">
                <input type="hidden" name="signature_data" id="draw-data">

                <div id="panel-draw">
                    <div class="border-2 border-gray-300 rounded-xl overflow-hidden bg-white" style="width:100%; max-width:500px;">
                        <canvas id="sig-canvas" height="160" class="block w-full cursor-crosshair touch-none"></canvas>
                    </div>
                    <div class="flex items-center gap-3 mt-3">
                        <button type="button" onclick="clearCanvas()"
                                class="text-sm text-gray-500 border border-gray-300 rounded-lg px-4 py-2 hover:bg-gray-50 flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            {{ __('ui.profile.clear_pad') }}
                        </button>
                        <button type="submit" onclick="prepareDrawSubmit(event)"
                                class="bg-blue-600 text-white text-sm px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                            {{ __('ui.profile.save_btn') }}
                        </button>
                    </div>
                    @error('signature_data')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Upload Tab --}}
                <div id="panel-upload" class="hidden">
                    <input type="hidden" name="signature_type" id="upload-type-field" value="draw">
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center">
                        <svg class="w-10 h-10 mx-auto text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                        <p class="text-sm text-gray-500 mb-3">{{ __('ui.profile.upload_hint') }}</p>
                        <input type="file" name="signature_file" id="sig-file" accept=".png,.jpg,.jpeg"
                               class="hidden" onchange="previewFile(this)">
                        <label for="sig-file"
                               class="cursor-pointer inline-block bg-gray-100 text-gray-700 text-sm px-4 py-2 rounded-lg border border-gray-300 hover:bg-gray-200 transition">
                            {{ __('ui.profile.choose_file') }}
                        </label>
                        <div id="file-preview" class="hidden mt-4">
                            <img id="preview-img" class="h-16 mx-auto object-contain">
                            <p id="file-name" class="text-xs text-gray-400 mt-1"></p>
                        </div>
                    </div>
                    @error('signature_file')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                    @enderror
                    <div class="mt-4">
                        <button type="submit" onclick="document.getElementById('upload-type-field').value='upload'"
                                class="bg-blue-600 text-white text-sm px-6 py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                            {{ __('ui.profile.save_btn') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @if($user->signature)
        <div class="mt-4 text-center">
            <a href="{{ route('dashboard') }}" class="text-sm text-blue-600 hover:underline">{{ __('ui.common.back_home') }}</a>
        </div>
        @endif
    </div>

    @push('scripts')
    <script>
    const _emptyPng = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==';
    const _drawEmptyMsg = @json(__('ui.profile.draw_empty_msg'));

    // Canvas setup
    const canvas = document.getElementById('sig-canvas');
    canvas.width = canvas.offsetWidth || 500;
    const ctx = canvas.getContext('2d');
    ctx.strokeStyle = '#1e293b';
    ctx.lineWidth = 2.5;
    ctx.lineCap = 'round';
    ctx.lineJoin = 'round';
    let drawing = false;

    const getPos = (e) => {
        const r = canvas.getBoundingClientRect();
        const t = e.touches ? e.touches[0] : e;
        return { x: (t.clientX - r.left) * (canvas.width / r.width), y: (t.clientY - r.top) * (canvas.height / r.height) };
    };

    canvas.addEventListener('mousedown',  e => { drawing = true; const p = getPos(e); ctx.beginPath(); ctx.moveTo(p.x, p.y); });
    canvas.addEventListener('mousemove',  e => { if (!drawing) return; const p = getPos(e); ctx.lineTo(p.x, p.y); ctx.stroke(); });
    canvas.addEventListener('mouseup',    () => drawing = false);
    canvas.addEventListener('mouseleave', () => drawing = false);
    canvas.addEventListener('touchstart', e => { e.preventDefault(); drawing = true; const p = getPos(e); ctx.beginPath(); ctx.moveTo(p.x, p.y); }, { passive: false });
    canvas.addEventListener('touchmove',  e => { e.preventDefault(); if (!drawing) return; const p = getPos(e); ctx.lineTo(p.x, p.y); ctx.stroke(); }, { passive: false });
    canvas.addEventListener('touchend',   () => drawing = false);

    function clearCanvas() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
    }

    function prepareDrawSubmit(e) {
        const data = canvas.toDataURL('image/png');
        if (data === _emptyPng) {
            e.preventDefault();
            alert(_drawEmptyMsg);
            return;
        }
        document.getElementById('draw-data').value = data;
    }

    // Tab switching
    function switchTab(tab) {
        document.getElementById('panel-draw').classList.toggle('hidden', tab !== 'draw');
        document.getElementById('panel-upload').classList.toggle('hidden', tab !== 'upload');
        document.getElementById('tab-draw').className = tab === 'draw'
            ? 'tab-btn px-4 py-2 rounded-lg text-sm font-medium border border-blue-600 bg-blue-600 text-white transition'
            : 'tab-btn px-4 py-2 rounded-lg text-sm font-medium border border-gray-300 text-gray-600 hover:bg-gray-50 transition';
        document.getElementById('tab-upload').className = tab === 'upload'
            ? 'tab-btn px-4 py-2 rounded-lg text-sm font-medium border border-blue-600 bg-blue-600 text-white transition'
            : 'tab-btn px-4 py-2 rounded-lg text-sm font-medium border border-gray-300 text-gray-600 hover:bg-gray-50 transition';
    }

    // File preview
    function previewFile(input) {
        if (!input.files[0]) return;
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('file-name').textContent = input.files[0].name;
            document.getElementById('file-preview').classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }

    // Resize canvas on load
    window.addEventListener('resize', () => {
        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        canvas.width = canvas.offsetWidth;
        ctx.putImageData(imageData, 0, 0);
        ctx.strokeStyle = '#1e293b';
        ctx.lineWidth = 2.5;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
    });
    </script>
    @endpush
</x-layout>
