<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['title' => ''.e(__('ui.submission.submit_title_prefix')).': '.e($formType->name).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('ui.submission.submit_title_prefix')).': '.e($formType->name).'']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="mb-6">
        <a href="<?php echo e(route('dashboard')); ?>" class="inline-flex items-center gap-1 text-sm text-gray-500 hover:text-blue-700 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <?php echo e(__('ui.common.back')); ?>

        </a>
        <h1 class="text-2xl font-bold text-gray-900 mt-2"><?php echo e($formType->name); ?></h1>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($formType->description): ?>
        <p class="text-gray-500 mt-1 text-sm"><?php echo e($formType->description); ?></p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-6 max-w-2xl">

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($studentData ?? null): ?>
        <div class="flex items-start gap-3 p-4 mb-6 bg-blue-50 border border-blue-200 rounded-xl">
            <div class="w-9 h-9 rounded-full bg-blue-600 flex items-center justify-center text-white text-sm font-bold shrink-0 mt-0.5">
                <?php echo e(mb_substr($studentData->std_fname_th ?? $studentData->std_fname_en ?? '?', 0, 1)); ?>

            </div>
            <div class="text-sm text-blue-900 leading-relaxed">
                <p class="font-semibold"><?php echo e($studentData->std_fname_en); ?> <?php echo e($studentData->std_lname_en); ?></p>
                <p class="text-blue-700"><?php echo e($studentData->std_id_std); ?> &nbsp;·&nbsp; <?php echo e($studentData->std_degree_en); ?></p>
                <p class="text-blue-600"><?php echo e($studentData->std_faculty_en); ?> &nbsp;·&nbsp; <?php echo e($studentData->std_major_en); ?></p>
            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <form action="<?php echo e(route('student.submissions.store', $formType)); ?>" method="POST" enctype="multipart/form-data" class="space-y-5" id="submission-form">
            <?php echo csrf_field(); ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($formType->code === 'special_status'): ?>
            <?php
            $restoreCases = [
            1 => [
            'label' => 'กรณีที่ 1',
            'note' => 'ถ้าตอบใช่ทั้ง 3 ข้อ ลงทะเบียนกรณีพิเศษได้',
            'noteColor' => 'text-green-700',
            'questions' => [
            'ข้าพเจ้าเรียนรายวิชาต่าง ๆ ครบแล้ว',
            'ข้าพเจ้าส่งวิทยานิพนธ์/การศึกษาค้นคว้าอิสระ 9 เล่ม ให้งานบริหารบัณฑิตศึกษาแล้ว',
            'ข้าพเจ้ายังสอบประมวลความรู้ไม่ผ่าน หรือยังไม่ได้สอบประมวลความรู้',
            ],
            ],
            2 => [
            'label' => 'กรณีที่ 2',
            'note' => 'ไม่ใช่ลงทะเบียนกรณีพิเศษ',
            'noteColor' => 'text-orange-600',
            'questions' => [
            'ข้าพเจ้าเรียนรายวิชาต่าง ๆ ครบแล้ว',
            'ข้าพเจ้าลงหน่วยกิตวิทยานิพนธ์ครบ 12 หน่วยกิต หรือการศึกษาค้นคว้าอิสระครบ 6 หน่วยกิตแล้ว',
            'ข้าพเจ้าไม่สามารถสอบปากเปล่า หรือสอบรายงานการศึกษาค้นคว้าอิสระได้ทันในภาคเรียนที่แล้ว',
            ],
            ],
            3 => [
            'label' => 'กรณีที่ 3',
            'note' => 'ถ้าตอบใช่ทั้ง 3 ข้อ ลงทะเบียนกรณีพิเศษได้',
            'noteColor' => 'text-green-700',
            'questions' => [
            'ข้าพเจ้าเรียนรายวิชาต่าง ๆ ครบแล้ว',
            'ข้าพเจ้าสอบประมวลความรู้แล้ว',
            'ข้าพเจ้าไม่สามารถส่งวิทยานิพนธ์ 9 เล่ม หรือการศึกษาค้นคว้าอิสระ 9 เล่ม ให้บัณฑิตวิทยาลัยได้ทันตามเวลาที่กำหนดไว้',
            ],
            ],
            4 => [
            'label' => 'กรณีที่ 4',
            'note' => 'ถ้าตอบใช่ทั้ง 3 ข้อ ลงทะเบียนกรณีพิเศษได้',
            'noteColor' => 'text-green-700',
            'questions' => [
            'ข้าพเจ้าเรียนรายวิชาต่าง ๆ ครบแล้ว',
            'ข้าพเจ้าส่งวิทยานิพนธ์เล่มสมบูรณ์ให้บัณฑิตวิทยาลัยได้ทันตามเวลาที่กำหนดไว้',
            'ข้าพเจ้ารอการตีพิมพ์หรือตอบรับการตีพิมพ์ผลงานวิทยานิพนธ์',
            ],
            ],
            ];
            ?>

            <div class="space-y-3">
                <div>
                    <p class="text-sm font-semibold text-gray-900">เงื่อนไขการยื่นคำร้อง <span class="text-red-500">*</span></p>
                    <p class="text-xs text-gray-500 mt-0.5">กรุณาตอบคำถามทุกข้อ — นิสิตต้องผ่านเงื่อนไขครบทั้ง 3 ข้อในกรณีใดกรณีหนึ่งจึงจะยื่นคำร้องได้</p>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['restore_conditions'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="p-3 rounded-lg bg-red-50 border border-red-200 text-sm text-red-700"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $restoreCases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $caseNum => $case): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="border border-gray-200 rounded-xl overflow-hidden">
                    <div class="px-4 py-2.5 bg-gray-50 border-b border-gray-200 flex items-center gap-2">
                        <span class="text-sm font-semibold text-gray-800"><?php echo e($case['label']); ?></span>
                        <span class="text-xs <?php echo e($case['noteColor']); ?>">(<?php echo e($case['note']); ?>)</span>
                    </div>
                    <div class="p-4 space-y-3">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $case['questions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qIdx => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php $qNum = $qIdx + 1; $inputName = "condition_{$caseNum}_{$qNum}"; ?>
                        <div class="flex items-start gap-3">
                            <div class="flex-1 text-sm text-gray-700 pt-0.5">
                                <?php echo e($qNum); ?>. <?php echo e($question); ?>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($case['question_notes'][$qNum])): ?>
                                <span class="block text-xs text-orange-600 mt-0.5"><?php echo e($case['question_notes'][$qNum]); ?></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="flex gap-4 shrink-0 pt-0.5">
                                <label class="inline-flex items-center gap-1.5 cursor-pointer">
                                    <input type="radio" name="<?php echo e($inputName); ?>" value="yes" required
                                        <?php echo e(old($inputName) === 'yes' ? 'checked' : ''); ?>

                                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                    <span class="text-sm text-gray-700">ใช่</span>
                                </label>
                                <label class="inline-flex items-center gap-1.5 cursor-pointer">
                                    <input type="radio" name="<?php echo e($inputName); ?>" value="no"
                                        <?php echo e(old($inputName) === 'no' ? 'checked' : ''); ?>

                                        class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                    <span class="text-sm text-gray-700">ไม่ใช่</span>
                                </label>
                            </div>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            


            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($formType->code === 'reinstatement'): ?>
            <div class="space-y-6">

                
                <div class="space-y-3">
                    <div>
                        <p class="text-sm font-semibold text-gray-900">พ้นสภาพการเป็นนิสิต เนื่องจาก : <span class="text-red-500">*</span></p>
                    </div>

                    <div class="border border-gray-200 rounded-xl p-5 bg-white space-y-5">
                        
                        <label class="flex items-start gap-3 cursor-pointer group">
                            <input type="radio" name="loss_reason_type" value="not_paid" required
                                <?php echo e(old('loss_reason_type') === 'not_paid' ? 'checked' : ''); ?>

                                class="mt-2 w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 cursor-pointer">
                            <div class="flex-1 text-sm text-gray-800">
                                <div class="leading-loose">
                                    ไม่ชำระเงินเพื่อรักษาสภาพการเป็นนิสิต จำนวน
                                    <input type="number" name="missed_semesters_count" min="1"
                                        value="<?php echo e(old('missed_semesters_count')); ?>"
                                        class="w-16 h-8 mx-1 px-2 py-1 text-center border border-gray-300 rounded-md focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition" placeholder="...">
                                    ภาคเรียน คือภาคเรียนที่
                                    <input type="text" name="missed_semester_details"
                                        value="<?php echo e(old('missed_semester_details')); ?>"
                                        class="w-48 h-8 mx-1 px-2 py-1 text-center border border-gray-300 rounded-md focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition" placeholder="เช่น 1/2566, 2/2566">
                                </div>
                                <div class="text-xs text-gray-500 mt-1">
                                    Did not pay for a status retention for semester(s):
                                </div>
                            </div>
                        </label>

                        
                        <label class="flex items-start gap-3 cursor-pointer group">
                            <input type="radio" name="loss_reason_type" value="not_enrolled"
                                <?php echo e(old('loss_reason_type') === 'not_enrolled' ? 'checked' : ''); ?>

                                class="mt-1 w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 cursor-pointer">
                            <div class="flex-1 text-sm text-gray-800 leading-relaxed">
                                <div>ไม่ได้ลงทะเบียนเรียนโดยสมบูรณ์ ภายในเวลาที่มหาวิทยาลัยกำหนด (ไม่ได้ชำระเงินภายในเวลาที่มหาวิทยาลัยกำหนด)</div>
                                <div class="text-xs text-gray-500 mt-1">
                                    Did not completely enroll according to schedule (No payment within the due date.)
                                </div>
                            </div>
                        </label>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['loss_reason_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                
                <div class="border border-gray-200 rounded-xl p-5 bg-white space-y-6">

                    
                    <div>
                        <p class="text-sm font-semibold text-gray-900 mb-3">มีความประสงค์จะขอคืนสภาพการเป็นนิสิต ตั้งแต่ : <span class="text-xs font-normal text-gray-500 ml-1">Would like to retain student status from:</span> <span class="text-red-500">*</span></p>
                        <div class="flex flex-wrap items-center gap-4 ml-6 text-sm text-gray-800">
                            <label class="inline-flex items-center gap-1.5 cursor-pointer">
                                <input type="radio" name="retain_status_semester" value="1" required <?php echo e(old('retain_status_semester') == '1' ? 'checked' : ''); ?> class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 cursor-pointer">
                                <span>ภาคต้น/ 1<sup>st</sup> semester</span>
                            </label>
                            <label class="inline-flex items-center gap-1.5 cursor-pointer">
                                <input type="radio" name="retain_status_semester" value="2" <?php echo e(old('retain_status_semester') == '2' ? 'checked' : ''); ?> class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 cursor-pointer">
                                <span>ภาคปลาย/ 2<sup>nd</sup> semester</span>
                            </label>
                            <div class="flex items-center gap-2 ml-4">
                                <span>ปีการศึกษา/ Academic Year</span>
                                <input type="text" name="retain_status_year" required value="<?php echo e(old('retain_status_year')); ?>" class="w-24 h-8 px-2 py-1 text-center border border-gray-300 rounded-md focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition" placeholder="เช่น 2566">
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-100">

                    
                    <div>
                        <p class="text-sm font-semibold text-gray-900 mb-3">และขอลาพักการเรียนที่พ้นสภาพจึงถึง : <span class="text-xs font-normal text-gray-500 ml-1">Would like to take a leave of absence in the</span></p>

                        
                        <div class="flex flex-wrap items-center gap-4 ml-6 mb-4 text-sm text-gray-800">
                            <label class="inline-flex items-center gap-1.5 cursor-pointer">
                                <input type="radio" name="leave_from_semester" value="1" <?php echo e(old('leave_from_semester') == '1' ? 'checked' : ''); ?> class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 cursor-pointer">
                                <span>ภาคต้น/ 1<sup>st</sup> semester</span>
                            </label>
                            <label class="inline-flex items-center gap-1.5 cursor-pointer">
                                <input type="radio" name="leave_from_semester" value="2" <?php echo e(old('leave_from_semester') == '2' ? 'checked' : ''); ?> class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 cursor-pointer">
                                <span>ภาคปลาย/ 2<sup>nd</sup> semester</span>
                            </label>
                            <div class="flex items-center gap-2 ml-4">
                                <span>ปีการศึกษา/ Academic Year</span>
                                <input type="text" name="leave_from_year" value="<?php echo e(old('leave_from_year')); ?>" class="w-24 h-8 px-2 py-1 text-center border border-gray-300 rounded-md focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition" placeholder="เช่น 2566">
                            </div>
                        </div>

                        
                        <p class="text-sm text-gray-500 mb-3 ml-6">To the semester of the academic year of</p>
                        <div class="flex flex-wrap items-center gap-4 ml-6 text-sm text-gray-800">
                            <label class="inline-flex items-center gap-1.5 cursor-pointer">
                                <input type="radio" name="leave_to_semester" value="1" <?php echo e(old('leave_to_semester') == '1' ? 'checked' : ''); ?> class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 cursor-pointer">
                                <span>ภาคต้น/ 1<sup>st</sup> semester</span>
                            </label>
                            <label class="inline-flex items-center gap-1.5 cursor-pointer">
                                <input type="radio" name="leave_to_semester" value="2" <?php echo e(old('leave_to_semester') == '2' ? 'checked' : ''); ?> class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 cursor-pointer">
                                <span>ภาคปลาย/ 2<sup>nd</sup> semester</span>
                            </label>
                            <div class="flex items-center gap-2 ml-4">
                                <span>ปีการศึกษา/ Academic Year</span>
                                <input type="text" name="leave_to_year" value="<?php echo e(old('leave_to_year')); ?>" class="w-24 h-8 px-2 py-1 text-center border border-gray-300 rounded-md focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition" placeholder="เช่น 2566">
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($formType->fields->isEmpty()): ?>
            <p class="text-gray-500 text-sm"><?php echo e(__('ui.submission.no_fields')); ?></p>
            <?php else: ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $formType->fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <?php $inputName = 'field_' . $field->field_key; ?>

            
            <div <?php if($field->field_key === 'budget_resource_other'): ?> id="budget-other-wrap" class="hidden" <?php endif; ?>>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($field->field_type === 'radio'): ?>
                
                <p class="block mb-2 text-sm font-medium text-gray-900">
                    <?php echo e($field->label); ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($field->is_required): ?><span class="text-red-500 ml-0.5">*</span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </p>
                <ul class="flex flex-wrap gap-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $field->options ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <li>
                        <input type="radio" id="<?php echo e($inputName); ?>_<?php echo e($loop->index); ?>"
                            name="<?php echo e($inputName); ?>" value="<?php echo e($opt); ?>"
                            <?php echo e(old($inputName) === $opt ? 'checked' : ''); ?>

                            <?php echo e($field->is_required ? 'required' : ''); ?>

                            class="hidden peer">
                        <label for="<?php echo e($inputName); ?>_<?php echo e($loop->index); ?>"
                            class="cursor-pointer select-none px-4 py-2 text-sm rounded-lg border border-gray-300 text-gray-700
                                              peer-checked:bg-blue-600 peer-checked:text-white peer-checked:border-blue-600
                                              hover:bg-gray-50 transition">
                            <?php echo e($opt); ?>

                        </label>
                    </li>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </ul>

                <?php elseif($field->field_type === 'textarea'): ?>
                <label for="<?php echo e($inputName); ?>" class="block mb-2 text-sm font-medium text-gray-900">
                    <?php echo e($field->label); ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($field->is_required): ?><span class="text-red-500 ml-0.5">*</span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </label>
                <textarea id="<?php echo e($inputName); ?>" name="<?php echo e($inputName); ?>" rows="4"
                    placeholder="<?php echo e($field->placeholder); ?>"
                    <?php echo e($field->is_required ? 'required' : ''); ?>

                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900
                                         focus:border-blue-500 focus:ring-2 focus:ring-blue-500
                                         <?php $__errorArgs = [$inputName];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old($inputName)); ?></textarea>

                <?php elseif($field->field_key === 'semester'): ?>
                <label for="<?php echo e($inputName); ?>" class="block mb-2 text-sm font-medium text-gray-900">
                    <?php echo e($field->label); ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($field->is_required): ?><span class="text-red-500 ml-0.5">*</span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </label>
                <select id="<?php echo e($inputName); ?>" name="<?php echo e($inputName); ?>"
                    <?php echo e($field->is_required ? 'required' : ''); ?>

                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900
                                       focus:border-blue-500 focus:ring-2 focus:ring-blue-500
                                       <?php $__errorArgs = [$inputName];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <option value="">-- เลือกภาคการศึกษา --</option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['ภาคต้น', 'ภาคปลาย', 'ก่อนปีการศึกษา']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <option value="<?php echo e($opt); ?>" <?php echo e(old($inputName) === $opt ? 'selected' : ''); ?>><?php echo e($opt); ?></option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </select>

                <?php elseif($field->field_type === 'select'): ?>
                <label for="<?php echo e($inputName); ?>" class="block mb-2 text-sm font-medium text-gray-900">
                    <?php echo e($field->label); ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($field->is_required): ?><span class="text-red-500 ml-0.5">*</span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </label>
                <select id="<?php echo e($inputName); ?>" name="<?php echo e($inputName); ?>"
                    <?php echo e($field->is_required ? 'required' : ''); ?>

                    <?php if($field->field_key === 'budget_resource'): ?> id="budget-resource-select" <?php endif; ?>
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900
                    focus:border-blue-500 focus:ring-2 focus:ring-blue-500
                    <?php $__errorArgs = [$inputName];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <option value=""><?php echo e(__('ui.submission.select_prefix')); ?> <?php echo e($field->label); ?></option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $field->options ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <option value="<?php echo e($opt); ?>" <?php echo e(old($inputName) === $opt ? 'selected' : ''); ?>><?php echo e($opt); ?></option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </select>

                <?php elseif($field->field_type === 'advisor_select'): ?>
                <?php
                $oldAdv = $oldAdvisors[$field->field_key] ?? null;
                $oldAdvisorDisplay = $oldAdv
                ? trim(($oldAdv->prefixname ?? '') . ($oldAdv->advisorname ?? '') . ' ' . ($oldAdv->advisorsurname ?? ''))
                : '';
                ?>
                <label for="<?php echo e($inputName); ?>_search" class="block mb-2 text-sm font-medium text-gray-900">
                    <?php echo e($field->label); ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($field->is_required): ?><span class="text-red-500 ml-0.5">*</span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </label>
                <div class="relative" id="<?php echo e($inputName); ?>_wrapper">
                    <input type="text"
                        id="<?php echo e($inputName); ?>_search"
                        autocomplete="off"
                        placeholder="<?php echo e(__('ui.submission.advisor_placeholder')); ?>"
                        value="<?php echo e($oldAdvisorDisplay); ?>"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900
                                          focus:border-blue-500 focus:ring-2 focus:ring-blue-500
                                          <?php $__errorArgs = [$inputName];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <input type="hidden"
                        name="<?php echo e($inputName); ?>"
                        id="<?php echo e($inputName); ?>"
                        value="<?php echo e(old($inputName)); ?>"
                        <?php if($field->is_required): ?> data-required="1" <?php endif; ?>>
                    <div id="<?php echo e($inputName); ?>_dropdown"
                        class="absolute z-50 w-full bg-white border border-gray-200 rounded-lg shadow-lg mt-1 hidden max-h-60 overflow-y-auto">
                    </div>
                </div>

                <?php elseif($field->field_type === 'signature'): ?>
                <label class="block mb-2 text-sm font-medium text-gray-900">
                    <?php echo e($field->label); ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($field->is_required): ?><span class="text-red-500 ml-0.5">*</span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </label>
                <input type="hidden" name="<?php echo e($inputName); ?>" id="<?php echo e($inputName); ?>_data">
                <div class="border border-gray-300 rounded-lg overflow-hidden w-64 bg-white">
                    <canvas id="<?php echo e($inputName); ?>_canvas" width="256" height="120"
                        class="block cursor-crosshair touch-none"></canvas>
                </div>
                <button type="button" onclick="clearSignature('<?php echo e($inputName); ?>')"
                    class="mt-2 inline-flex items-center gap-1.5 text-xs text-gray-500 border border-gray-300 rounded-lg px-3 py-1.5 hover:bg-gray-100 transition">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <?php echo e(__('ui.submission.clear_signature')); ?>

                </button>

                <?php elseif($field->field_type === 'file'): ?>
                <label for="<?php echo e($inputName); ?>" class="block mb-2 text-sm font-medium text-gray-900">
                    <?php echo e($field->label); ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($field->is_required): ?><span class="text-red-500 ml-0.5">*</span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </label>
                <label for="<?php echo e($inputName); ?>"
                    class="flex flex-col items-center justify-center w-full h-28 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center">
                        <svg class="w-7 h-7 mb-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        <p class="text-xs text-gray-500"><?php echo e(__('ui.submission.click_upload')); ?></p>
                        <p class="text-xs text-gray-400 mt-0.5"><?php echo e(__('ui.submission.max_size')); ?></p>
                    </div>
                    <input id="<?php echo e($inputName); ?>" type="file" name="<?php echo e($inputName); ?>"
                        <?php echo e($field->is_required ? 'required' : ''); ?> class="hidden">
                </label>
                <p id="<?php echo e($inputName); ?>_name" class="text-xs text-blue-600 mt-1 hidden"></p>

                <?php else: ?>
                
                <label for="<?php echo e($inputName); ?>" class="block mb-2 text-sm font-medium text-gray-900">
                    <?php echo e($field->label); ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($field->is_required): ?><span class="text-red-500 ml-0.5">*</span><?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </label>
                <input type="<?php echo e($field->field_type === 'date' ? 'date' : ($field->field_type === 'number' ? 'number' : ($field->field_type === 'email' ? 'email' : ($field->field_type === 'tel' ? 'tel' : 'text')))); ?>"
                    id="<?php echo e($inputName); ?>" name="<?php echo e($inputName); ?>"
                    value="<?php echo e(old($inputName)); ?>" placeholder="<?php echo e($field->placeholder); ?>"
                    <?php echo e($field->is_required ? 'required' : ''); ?>

                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900
                                      focus:border-blue-500 focus:ring-2 focus:ring-blue-500
                                      <?php $__errorArgs = [$inputName];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($field->help_text): ?>
                <p class="mt-1.5 text-xs text-gray-400"><?php echo e($field->help_text); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = [$inputName];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($formType->code === 'research_data_collection'): ?>
            <div class="flex items-start gap-3 p-4 bg-yellow-50 border border-yellow-200 rounded-xl">
                <input id="remark-check" type="checkbox" required
                    class="w-4 h-4 mt-0.5 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <label for="remark-check" class="text-xs text-yellow-800 leading-relaxed">
                    Remark: The processing of the document request will take approximately 7–10 business days.
                </label>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="flex gap-3 pt-4 border-t border-gray-100">
                <button type="submit"
                    class="px-6 py-2.5 rounded-lg bg-blue-600 text-white text-sm font-medium hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition">
                    <?php echo e(__('ui.submission.save_btn')); ?>

                </button>
                <a href="<?php echo e(route('dashboard')); ?>"
                    class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 text-sm font-medium hover:bg-gray-50 transition">
                    <?php echo e(__('ui.common.cancel')); ?>

                </a>
            </div>
        </form>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        // Show selected filename for file inputs
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
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
                return {
                    x: t.clientX - r.left,
                    y: t.clientY - r.top
                };
            };
            canvas.addEventListener('mousedown', e => {
                drawing = true;
                const p = pos(e);
                ctx.beginPath();
                ctx.moveTo(p.x, p.y);
            });
            canvas.addEventListener('mousemove', e => {
                if (!drawing) return;
                const p = pos(e);
                ctx.lineTo(p.x, p.y);
                ctx.stroke();
            });
            canvas.addEventListener('mouseup', () => {
                drawing = false;
                hidden.value = canvas.toDataURL();
            });
            canvas.addEventListener('mouseleave', () => {
                drawing = false;
            });
            canvas.addEventListener('touchstart', e => {
                e.preventDefault();
                drawing = true;
                const p = pos(e);
                ctx.beginPath();
                ctx.moveTo(p.x, p.y);
            });
            canvas.addEventListener('touchmove', e => {
                e.preventDefault();
                if (!drawing) return;
                const p = pos(e);
                ctx.lineTo(p.x, p.y);
                ctx.stroke();
            });
            canvas.addEventListener('touchend', () => {
                drawing = false;
                hidden.value = canvas.toDataURL();
            });
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
            budgetSelect.addEventListener('change', function() {
                budgetOtherWrap.classList.toggle('hidden', this.value !== 'Other');
            });
        }

        // Advisor searchable dropdown
        const _advisorNotFound = <?php echo json_encode(__('ui.submission.advisor_not_found'), 15, 512) ?>;
        const _advisorRequired = <?php echo json_encode(__('ui.submission.advisor_required'), 15, 512) ?>;
        (function() {
            document.querySelectorAll('input[id^="field_"][id$="_search"]').forEach(function(input) {
                const baseName = input.id.replace('_search', '');
                const hidden = document.getElementById(baseName);
                const dropdown = document.getElementById(baseName + '_dropdown');
                if (!hidden || !dropdown) return;

                let timer;

                input.addEventListener('input', function() {
                    hidden.value = '';
                    clearTimeout(timer);
                    const q = this.value.trim();
                    if (!q) {
                        dropdown.classList.add('hidden');
                        return;
                    }

                    timer = setTimeout(function() {
                        fetch('/submissions/advisors/search?q=' + encodeURIComponent(q), {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest'
                                }
                            })
                            .then(function(r) {
                                return r.json();
                            })
                            .then(function(data) {
                                dropdown.innerHTML = '';
                                if (!data.length) {
                                    const empty = document.createElement('div');
                                    empty.className = 'px-4 py-3 text-sm text-gray-400 text-center';
                                    empty.textContent = _advisorNotFound;
                                    dropdown.appendChild(empty);
                                } else {
                                    data.forEach(function(a) {
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
                                        item.addEventListener('click', function() {
                                            input.value = fullName;
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
                document.addEventListener('click', function(e) {
                    const wrapper = document.getElementById(baseName + '_wrapper');
                    if (wrapper && !wrapper.contains(e.target)) {
                        dropdown.classList.add('hidden');
                    }
                });

                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape') dropdown.classList.add('hidden');
                });
            });

            // Client-side required validation before submit
            const form = document.getElementById('submission-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    let firstError = null;
                    this.querySelectorAll('input[type="hidden"][data-required="1"]').forEach(function(h) {
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
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $attributes = $__attributesOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__attributesOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $component = $__componentOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__componentOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\xampp\e-form\resources\views/student/submissions/create.blade.php ENDPATH**/ ?>