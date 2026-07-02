<x-layout title="{{ __('ui.submission.submit_title_prefix') }}: {{ $formType->name }}">
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-blue-700 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            {{ __('ui.common.back') }}
        </a>
        <h1 class="text-2xl font-bold text-gray-900 mt-2">{{ $formType->name }}</h1>
        @if($formType->description)
            <p class="text-gray-500 mt-1 text-sm">{{ $formType->description }}</p>
        @endif
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 max-w-2xl">

        {{-- Student Data Card --}}
        @if($studentData ?? null)
        <div class="flex items-start gap-3 p-4 mb-6 bg-blue-50 border border-blue-200 rounded-xl">
            <div class="w-9 h-9 rounded-full bg-blue-600 flex items-center justify-center text-white text-sm font-bold shrink-0 mt-0.5">
                {{ mb_substr($studentData->std_fname_th ?? $studentData->std_fname_en ?? '?', 0, 1) }}
            </div>
            <div class="text-sm text-blue-900 leading-relaxed">
                <p class="font-semibold">{{ $studentData->std_fname_en }} {{ $studentData->std_lname_en }}</p>
                <p class="text-blue-700">{{ $studentData->std_id_std }} &nbsp;·&nbsp; {{ $studentData->std_degree_en }}</p>
                <p class="text-blue-600">{{ $studentData->std_faculty_en }} &nbsp;·&nbsp; {{ $studentData->std_major_en }}</p>
            </div>
        </div>
        @endif

        <form action="{{ route('student.submissions.store', $formType) }}" method="POST" enctype="multipart/form-data" class="space-y-5" id="submission-form">
            @csrf

            {{-- Special Status: 4-case eligibility conditions --}}
            @if($formType->code === 'special_status')
            @php
            $restoreCases = [
                1 => [
                    'label' => 'กรณีที่ 1',
                    'note'  => 'ถ้าตอบใช่ทั้ง 3 ข้อ ลงทะเบียนกรณีพิเศษได้',
                    'noteColor' => 'text-green-700',
                    'questions' => [
                        'ข้าพเจ้าเรียนรายวิชาต่าง ๆ ครบแล้ว',
                        'ข้าพเจ้าส่งวิทยานิพนธ์/การศึกษาค้นคว้าอิสระ 9 เล่ม ให้งานบริหารบัณฑิตศึกษาแล้ว',
                        'ข้าพเจ้ายังสอบประมวลความรู้ไม่ผ่าน หรือยังไม่ได้สอบประมวลความรู้',
                    ],
                ],
                2 => [
                    'label' => 'กรณีที่ 2',
                    'note'  => 'ไม่ใช่ลงทะเบียนกรณีพิเศษ',
                    'noteColor' => 'text-orange-600',
                    'questions' => [
                        'ข้าพเจ้าเรียนรายวิชาต่าง ๆ ครบแล้ว',
                        'ข้าพเจ้าลงหน่วยกิตวิทยานิพนธ์ครบ 12 หน่วยกิต หรือการศึกษาค้นคว้าอิสระครบ 6 หน่วยกิตแล้ว',
                        'ข้าพเจ้าไม่สามารถสอบปากเปล่า หรือสอบรายงานการศึกษาค้นคว้าอิสระได้ทันในภาคเรียนที่แล้ว',
                    ],
                ],
                3 => [
                    'label' => 'กรณีที่ 3',
                    'note'  => 'ถ้าตอบใช่ทั้ง 3 ข้อ ลงทะเบียนกรณีพิเศษได้',
                    'noteColor' => 'text-green-700',
                    'questions' => [
                        'ข้าพเจ้าเรียนรายวิชาต่าง ๆ ครบแล้ว',
                        'ข้าพเจ้าสอบประมวลความรู้แล้ว',
                        'ข้าพเจ้าไม่สามารถส่งวิทยานิพนธ์ 9 เล่ม หรือการศึกษาค้นคว้าอิสระ 9 เล่ม ให้บัณฑิตวิทยาลัยได้ทันตามเวลาที่กำหนดไว้',
                    ],
                ],
                4 => [
                    'label' => 'กรณีที่ 4',
                    'note'  => 'ถ้าตอบใช่ทั้ง 3 ข้อ ลงทะเบียนกรณีพิเศษได้',
                    'noteColor' => 'text-green-700',
                    'questions' => [
                        'ข้าพเจ้าเรียนรายวิชาต่าง ๆ ครบแล้ว',
                        'ข้าพเจ้าส่งวิทยานิพนธ์เล่มสมบูรณ์ให้บัณฑิตวิทยาลัยได้ทันตามเวลาที่กำหนดไว้',
                        'ข้าพเจ้ารอการตีพิมพ์หรือตอบรับการตีพิมพ์ผลงานวิทยานิพนธ์',
                    ],
                ],
            ];
            @endphp

            <div class="space-y-3">
                <div>
                    <p class="text-sm font-semibold text-gray-900">เงื่อนไขการยื่นคำร้อง <span class="text-red-500">*</span></p>
                    <p class="text-xs text-gray-500 mt-0.5">กรุณาตอบคำถามทุกข้อ — นิสิตต้องผ่านเงื่อนไขครบทั้ง 3 ข้อในกรณีใดกรณีหนึ่งจึงจะยื่นคำร้องได้</p>
                </div>

                @error('restore_conditions')
                <div class="p-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-700">{{ $message }}</div>
                @enderror

                @foreach($restoreCases as $caseNum => $case)
                <div class="border border-gray-200 rounded-xl overflow-hidden">
                    <div class="px-4 py-2.5 bg-gray-50 border-b border-gray-200 flex items-center gap-2">
                        <span class="text-sm font-semibold text-gray-800">{{ $case['label'] }}</span>
                        <span class="text-xs {{ $case['noteColor'] }}">({{ $case['note'] }})</span>
                    </div>
                    <div class="p-4 space-y-3">
                        @foreach($case['questions'] as $qIdx => $question)
                        @php $qNum = $qIdx + 1; $inputName = "condition_{$caseNum}_{$qNum}"; @endphp
                        <div class="flex items-start gap-3">
                            <div class="flex-1 text-sm text-gray-700 pt-0.5">
                                {{ $qNum }}. {{ $question }}
                                @if(isset($case['question_notes'][$qNum]))
                                <span class="block text-xs text-orange-600 mt-0.5">{{ $case['question_notes'][$qNum] }}</span>
                                @endif
                            </div>
                            <div class="flex gap-4 shrink-0 pt-0.5">
                                <label class="inline-flex items-center gap-1.5 cursor-pointer">
                                    <input type="radio" name="{{ $inputName }}" value="yes" required
                                           {{ old($inputName) === 'yes' ? 'checked' : '' }}
                                           class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                    <span class="text-sm text-gray-700">ใช่</span>
                                </label>
                                <label class="inline-flex items-center gap-1.5 cursor-pointer">
                                    <input type="radio" name="{{ $inputName }}" value="no"
                                           {{ old($inputName) === 'no' ? 'checked' : '' }}
                                           class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                    <span class="text-sm text-gray-700">ไม่ใช่</span>
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            @endif
            {{-- End special_status conditions --}}

            @if($formType->fields->isEmpty())
                <p class="text-gray-500 text-sm">{{ __('ui.submission.no_fields') }}</p>
            @else
                @foreach($formType->fields as $field)
                @php $inputName = 'field_' . $field->field_key; @endphp

                {{-- ซ่อน budget_resource_other ถ้า budget_resource ไม่ใช่ Other --}}
                <div @if($field->field_key === 'budget_resource_other') id="budget-other-wrap" class="hidden" @endif>

                    @if($field->field_type === 'radio')
                        {{-- Radio group label --}}
                        <p class="block mb-2 text-sm font-medium text-gray-900">
                            {{ $field->label }}
                            @if($field->is_required)<span class="text-red-500 ml-0.5">*</span>@endif
                        </p>
                        <ul class="flex flex-wrap gap-3">
                            @foreach($field->options ?? [] as $opt)
                            <li>
                                <input type="radio" id="{{ $inputName }}_{{ $loop->index }}"
                                       name="{{ $inputName }}" value="{{ $opt }}"
                                       {{ old($inputName) === $opt ? 'checked' : '' }}
                                       {{ $field->is_required ? 'required' : '' }}
                                       class="hidden peer">
                                <label for="{{ $inputName }}_{{ $loop->index }}"
                                       class="cursor-pointer select-none px-4 py-2 text-sm rounded-lg border border-gray-300 text-gray-700
                                              peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600
                                              hover:bg-gray-50 transition">
                                    {{ $opt }}
                                </label>
                            </li>
                            @endforeach
                        </ul>

                    @elseif($field->field_type === 'textarea')
                        <label for="{{ $inputName }}" class="block mb-2 text-sm font-medium text-gray-900">
                            {{ $field->label }}
                            @if($field->is_required)<span class="text-red-500 ml-0.5">*</span>@endif
                        </label>
                        <textarea id="{{ $inputName }}" name="{{ $inputName }}" rows="4"
                                  placeholder="{{ $field->placeholder }}"
                                  {{ $field->is_required ? 'required' : '' }}
                                  class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900
                                         focus:border-blue-500 focus:ring-2 focus:ring-blue-500
                                         @error($inputName) border-red-500 @enderror">{{ old($inputName) }}</textarea>

                    @elseif($field->field_key === 'semester')
                        <label for="{{ $inputName }}" class="block mb-2 text-sm font-medium text-gray-900">
                            {{ $field->label }}
                            @if($field->is_required)<span class="text-red-500 ml-0.5">*</span>@endif
                        </label>
                        <select id="{{ $inputName }}" name="{{ $inputName }}"
                                {{ $field->is_required ? 'required' : '' }}
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900
                                       focus:border-blue-500 focus:ring-2 focus:ring-blue-500
                                       @error($inputName) border-red-500 @enderror">
                            <option value="">-- เลือกภาคการศึกษา --</option>
                            @foreach(['ภาคต้น', 'ภาคปลาย', 'ก่อนปีการศึกษา'] as $opt)
                                <option value="{{ $opt }}" {{ old($inputName) === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                            @endforeach
                        </select>

                    @elseif($field->field_type === 'select')
                        <label for="{{ $inputName }}" class="block mb-2 text-sm font-medium text-gray-900">
                            {{ $field->label }}
                            @if($field->is_required)<span class="text-red-500 ml-0.5">*</span>@endif
                        </label>
                        <select id="{{ $inputName }}" name="{{ $inputName }}"
                                {{ $field->is_required ? 'required' : '' }}
                                @if($field->field_key === 'budget_resource') id="budget-resource-select" @endif
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900
                                       focus:border-blue-500 focus:ring-2 focus:ring-blue-500
                                       @error($inputName) border-red-500 @enderror">
                            <option value="">{{ __('ui.submission.select_prefix') }} {{ $field->label }}</option>
                            @foreach($field->options ?? [] as $opt)
                                <option value="{{ $opt }}" {{ old($inputName) === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                            @endforeach
                        </select>

                    @elseif($field->field_type === 'advisor_select')
                        @php
                            $oldAdv = $oldAdvisors[$field->field_key] ?? null;
                            $oldAdvisorDisplay = $oldAdv
                                ? trim(($oldAdv->prefixname ?? '') . ($oldAdv->advisorname ?? '') . ' ' . ($oldAdv->advisorsurname ?? ''))
                                : '';
                        @endphp
                        <label for="{{ $inputName }}_search" class="block mb-2 text-sm font-medium text-gray-900">
                            {{ $field->label }}
                            @if($field->is_required)<span class="text-red-500 ml-0.5">*</span>@endif
                        </label>
                        <div class="relative" id="{{ $inputName }}_wrapper">
                            <input type="text"
                                   id="{{ $inputName }}_search"
                                   autocomplete="off"
                                   placeholder="{{ __('ui.submission.advisor_placeholder') }}"
                                   value="{{ $oldAdvisorDisplay }}"
                                   class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900
                                          focus:border-blue-500 focus:ring-2 focus:ring-blue-500
                                          @error($inputName) border-red-500 @enderror">
                            <input type="hidden"
                                   name="{{ $inputName }}"
                                   id="{{ $inputName }}"
                                   value="{{ old($inputName) }}"
                                   @if($field->is_required) data-required="1" @endif>
                            <div id="{{ $inputName }}_dropdown"
                                 class="absolute z-50 w-full bg-white border border-gray-200 rounded-lg shadow-lg mt-1 hidden max-h-60 overflow-y-auto">
                            </div>
                        </div>

                    @elseif($field->field_type === 'signature')
                        <label class="block mb-2 text-sm font-medium text-gray-900">
                            {{ $field->label }}
                            @if($field->is_required)<span class="text-red-500 ml-0.5">*</span>@endif
                        </label>
                        <input type="hidden" name="{{ $inputName }}" id="{{ $inputName }}_data">
                        <div class="border border-gray-300 rounded-lg overflow-hidden w-64 bg-white">
                            <canvas id="{{ $inputName }}_canvas" width="256" height="120"
                                    class="block cursor-crosshair touch-none"></canvas>
                        </div>
                        <button type="button" onclick="clearSignature('{{ $inputName }}')"
                                class="mt-2 inline-flex items-center gap-1.5 text-xs text-gray-500 border border-gray-300 rounded-lg px-3 py-1.5 hover:bg-gray-100 transition">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            {{ __('ui.submission.clear_signature') }}
                        </button>

                    @elseif($field->field_type === 'file')
                        <label for="{{ $inputName }}" class="block mb-2 text-sm font-medium text-gray-900">
                            {{ $field->label }}
                            @if($field->is_required)<span class="text-red-500 ml-0.5">*</span>@endif
                        </label>
                        <label for="{{ $inputName }}"
                               class="flex flex-col items-center justify-center w-full h-28 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center">
                                <svg class="w-7 h-7 mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <p class="text-xs text-gray-500">{{ __('ui.submission.click_upload') }}</p>
                                <p class="text-xs text-gray-400 mt-0.5">{{ __('ui.submission.max_size') }}</p>
                            </div>
                            <input id="{{ $inputName }}" type="file" name="{{ $inputName }}"
                                   {{ $field->is_required ? 'required' : '' }} class="hidden">
                        </label>
                        <p id="{{ $inputName }}_name" class="text-xs text-blue-600 mt-1 hidden"></p>

                    @else
                        {{-- text / date / email / tel / number --}}
                        <label for="{{ $inputName }}" class="block mb-2 text-sm font-medium text-gray-900">
                            {{ $field->label }}
                            @if($field->is_required)<span class="text-red-500 ml-0.5">*</span>@endif
                        </label>
                        <input type="{{ $field->field_type === 'date' ? 'date' : ($field->field_type === 'number' ? 'number' : ($field->field_type === 'email' ? 'email' : ($field->field_type === 'tel' ? 'tel' : 'text'))) }}"
                               id="{{ $inputName }}" name="{{ $inputName }}"
                               value="{{ old($inputName) }}" placeholder="{{ $field->placeholder }}"
                               {{ $field->is_required ? 'required' : '' }}
                               class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900
                                      focus:border-blue-500 focus:ring-2 focus:ring-blue-500
                                      @error($inputName) border-red-500 @enderror">
                    @endif

                    @if($field->help_text)
                        <p class="mt-1.5 text-xs text-gray-400">{{ $field->help_text }}</p>
                    @endif
                    @error($inputName)
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                @endforeach
            @endif

            {{-- Remark (Research Data Collection only) --}}
            @if($formType->code === 'research_data_collection')
            <div class="flex items-start gap-3 p-4 bg-yellow-50 border border-yellow-200 rounded-xl">
                <input id="remark-check" type="checkbox" required
                       class="w-4 h-4 mt-0.5 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <label for="remark-check" class="text-xs text-yellow-800 leading-relaxed">
                    Remark: The processing of the document request will take approximately 7–10 business days.
                </label>
            </div>
            @endif

            <div class="flex gap-3 pt-4 border-t border-gray-100">
                <button type="submit"
                        class="px-6 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition">
                    {{ __('ui.submission.save_btn') }}
                </button>
                <a href="{{ route('dashboard') }}"
                   class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 text-sm font-medium hover:bg-gray-50 transition">
                    {{ __('ui.common.cancel') }}
                </a>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
    // Show selected filename for file inputs
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener('change', function () {
            const label = document.getElementById(this.id + '_name');
            if (label && this.files.length) {
                label.textContent = '📎 ' + this.files[0].name;
                label.classList.remove('hidden');
            }
        });
    });

    // Signature pad
    document.querySelectorAll('canvas[id$="_canvas"]').forEach(canvas => {
        const fieldName = canvas.id.replace('_canvas', '');
        const hidden = document.getElementById(fieldName + '_data');
        const ctx = canvas.getContext('2d');
        ctx.strokeStyle = '#1e293b';
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';
        let drawing = false;

        const pos = (e) => {
            const r = canvas.getBoundingClientRect();
            const t = e.touches ? e.touches[0] : e;
            return { x: t.clientX - r.left, y: t.clientY - r.top };
        };
        canvas.addEventListener('mousedown',  e => { drawing = true; const p = pos(e); ctx.beginPath(); ctx.moveTo(p.x, p.y); });
        canvas.addEventListener('mousemove',  e => { if (!drawing) return; const p = pos(e); ctx.lineTo(p.x, p.y); ctx.stroke(); });
        canvas.addEventListener('mouseup',    () => { drawing = false; hidden.value = canvas.toDataURL(); });
        canvas.addEventListener('mouseleave', () => { drawing = false; });
        canvas.addEventListener('touchstart', e => { e.preventDefault(); drawing = true; const p = pos(e); ctx.beginPath(); ctx.moveTo(p.x, p.y); });
        canvas.addEventListener('touchmove',  e => { e.preventDefault(); if (!drawing) return; const p = pos(e); ctx.lineTo(p.x, p.y); ctx.stroke(); });
        canvas.addEventListener('touchend',   () => { drawing = false; hidden.value = canvas.toDataURL(); });
    });

    function clearSignature(fieldName) {
        const canvas = document.getElementById(fieldName + '_canvas');
        canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
        document.getElementById(fieldName + '_data').value = '';
    }

    // Budget Resource conditional
    const budgetSelect = document.getElementById('budget-resource-select');
    const budgetOtherWrap = document.getElementById('budget-other-wrap');
    if (budgetSelect && budgetOtherWrap) {
        budgetSelect.addEventListener('change', function () {
            budgetOtherWrap.classList.toggle('hidden', this.value !== 'Other');
        });
    }

    // Advisor searchable dropdown
    const _advisorNotFound = @json(__('ui.submission.advisor_not_found'));
    const _advisorRequired  = @json(__('ui.submission.advisor_required'));
    (function () {
        document.querySelectorAll('input[id^="field_"][id$="_search"]').forEach(function (input) {
            const baseName = input.id.replace('_search', '');
            const hidden   = document.getElementById(baseName);
            const dropdown = document.getElementById(baseName + '_dropdown');
            if (!hidden || !dropdown) return;

            let timer;

            input.addEventListener('input', function () {
                hidden.value = '';
                clearTimeout(timer);
                const q = this.value.trim();
                if (!q) { dropdown.classList.add('hidden'); return; }

                timer = setTimeout(function () {
                    fetch('/submissions/advisors/search?q=' + encodeURIComponent(q), {
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    })
                    .then(function (r) { return r.json(); })
                    .then(function (data) {
                        dropdown.innerHTML = '';
                        if (!data.length) {
                            const empty = document.createElement('div');
                            empty.className = 'px-4 py-3 text-sm text-gray-400 text-center';
                            empty.textContent = _advisorNotFound;
                            dropdown.appendChild(empty);
                        } else {
                            data.forEach(function (a) {
                                const fullName = (a.prefixname || '') + (a.advisorname || '') + ' ' + (a.advisorsurname || '');
                                const item = document.createElement('div');
                                item.className = 'px-4 py-2.5 cursor-pointer hover:bg-blue-50 border-b border-gray-100 last:border-0';
                                const nameEl = document.createElement('p');
                                nameEl.className = 'text-sm font-medium text-gray-900';
                                nameEl.textContent = fullName;
                                const facEl = document.createElement('p');
                                facEl.className = 'text-xs text-gray-400';
                                facEl.textContent = a.facultyname || '';
                                item.appendChild(nameEl);
                                item.appendChild(facEl);
                                item.addEventListener('click', function () {
                                    input.value  = fullName;
                                    hidden.value = a.advisor_id;
                                    dropdown.classList.add('hidden');
                                    input.classList.remove('border-red-500');
                                });
                                dropdown.appendChild(item);
                            });
                        }
                        dropdown.classList.remove('hidden');
                    });
                }, 300);
            });

            // Close on outside click
            document.addEventListener('click', function (e) {
                const wrapper = document.getElementById(baseName + '_wrapper');
                if (wrapper && !wrapper.contains(e.target)) {
                    dropdown.classList.add('hidden');
                }
            });

            input.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') dropdown.classList.add('hidden');
            });
        });

        // Client-side required validation before submit
        const form = document.getElementById('submission-form');
        if (form) {
            form.addEventListener('submit', function (e) {
                let firstError = null;
                this.querySelectorAll('input[type="hidden"][data-required="1"]').forEach(function (h) {
                    if (!h.value) {
                        e.preventDefault();
                        const searchEl = document.getElementById(h.id + '_search');
                        if (searchEl) {
                            searchEl.classList.add('border-red-500');
                            if (!firstError) firstError = searchEl;
                        }
                    }
                });
                if (firstError) firstError.focus();
            });
        }
    })();
    </script>
    @endpush
</x-layout>
