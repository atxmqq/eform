<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['title' => ''.e(__('ui.submission.detail_title')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('ui.submission.detail_title')).'']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="mb-6">
        <a href="<?php echo e(route('student.submissions.index')); ?>" class="text-gray-500 hover:text-gray-700 text-sm"><?php echo e(__('ui.common.back')); ?></a>
        <div class="flex items-center justify-between mt-2">
            <h1 class="text-2xl font-bold text-gray-800"><?php echo e($submission->formType->name); ?></h1>
            <div class="flex items-center gap-3">
                <?php echo $__env->make('components.status-badge', ['status' => $submission->status, 'label' => $submission->status_label], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($submission->formType->code, ['leave_study','thesis_registration','special_status','restore_status'])): ?>
                <a href="<?php echo e(route('submissions.pdf', $submission)); ?>"
                    target="_blank"
                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <?php echo e(__('ui.submission.download_pdf')); ?>

                </a>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
        <p class="text-gray-500 text-sm mt-1"><?php echo e(__('ui.submission.submitted_at', ['date' => $submission->submitted_at?->format('d/m/Y H:i')])); ?></p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        
        <div class="lg:col-span-2 bg-white border border-gray-200 rounded-xl p-6">
            <h2 class="font-semibold text-gray-700 mb-4"><?php echo e(__('ui.submission.form_data')); ?></h2>
            <dl class="space-y-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $submission->formType->fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php
                $val = $submission->fieldValues->firstWhere('field_key', $field->field_key)?->value;

                // ถ้าเป็นช่องเลือกอาจารย์ ให้ไปดึงชื่ออาจารย์มา
                if ($field->field_type === 'advisor_select' && $val) {
                $advisor = DB::table('form_request_advisor')->where('advisor_id', $val)->first();
                if ($advisor) {
                $val = ($advisor->prefixname ?? '') . $advisor->advisorname . ' ' . $advisor->advisorsurname;
                }
                }
                ?>

                <div class="mb-4">
                    <p class="text-sm text-gray-500"><?php echo e($field->label); ?></p>
                    <p class="text-gray-900 font-medium"><?php echo e($val ?? '-'); ?></p>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($submission->formType->code === 'reinstatement'): ?>
                <?php
                // ฟังก์ชันช่วยดึงข้อมูลจาก Database
                $getVal = function($key) use ($submission) {
                $f = $submission->fieldValues->firstWhere('field_key', $key);
                return $f ? $f->value : null;
                };

                $lossReason = $getVal('loss_reason_type');
                $missedCount = $getVal('missed_semesters_count');
                $missedDetails = $getVal('missed_semester_details');

                $retainSem = $getVal('retain_status_semester');
                $retainYear = $getVal('retain_status_year');

                $leaveFromSem = $getVal('leave_from_semester');
                $leaveFromYear = $getVal('leave_from_year');
                $leaveToSem = $getVal('leave_to_semester');
                $leaveToYear = $getVal('leave_to_year');
                ?>

                <div class="mt-6 border-t border-gray-100 pt-5">
                    <div class="space-y-4 bg-blue-50 border border-blue-100 rounded-xl p-4">
                        
                        <div>
                            <p class="text-xs text-gray-500 font-medium mb-1">พ้นสภาพการเป็นนิสิต เนื่องจาก</p>
                            <p class="text-sm text-gray-900">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lossReason === 'not_paid'): ?>
                                🔴 ไม่ชำระเงินเพื่อรักษาสภาพ จำนวน <span class="font-bold"><?php echo e($missedCount); ?></span> ภาคเรียน (คือภาคเรียนที่ <span class="font-bold"><?php echo e($missedDetails); ?></span>)
                                <?php elseif($lossReason === 'not_enrolled'): ?>
                                🔴 ไม่ได้ลงทะเบียนเรียนโดยสมบูรณ์ ภายในเวลาที่มหาวิทยาลัยกำหนด
                                <?php else: ?>
                                -
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </p>
                        </div>

                        <hr class="border-blue-200">

                        
                        <div>
                            <p class="text-xs text-gray-500 font-medium mb-1">มีความประสงค์จะขอคืนสภาพการเป็นนิสิต ตั้งแต่</p>
                            <p class="text-sm text-gray-900 font-medium">
                                🟢 ภาคเรียนที่ <?php echo e($retainSem); ?> / ปีการศึกษา <?php echo e($retainYear); ?>

                            </p>
                        </div>

                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($leaveFromSem && $leaveFromYear): ?>
                        <div>
                            <p class="text-xs text-gray-500 font-medium mb-1">และขอลาพักการเรียนที่พ้นสภาพจึงถึง</p>
                            <p class="text-sm text-gray-900 font-medium">
                                🟡 ภาคเรียนที่ <?php echo e($leaveFromSem); ?>/<?php echo e($leaveFromYear); ?> ถึง ภาคเรียนที่ <?php echo e($leaveToSem); ?>/<?php echo e($leaveToYear); ?>

                            </p>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </dl>
        </div>

        
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <h2 class="font-semibold text-gray-700 mb-4"><?php echo e(__('ui.submission.approval_steps')); ?></h2>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($submission->approvals->isEmpty()): ?>
            <p class="text-sm text-gray-400"><?php echo e(__('ui.submission.no_approval_steps')); ?></p>
            <?php else: ?>
            <ol class="relative border-l border-gray-200 space-y-4 ml-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $submission->approvals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $approval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php
                $colors = ['pending'=>'yellow','approved'=>'green','rejected'=>'red','returned'=>'orange','waiting'=>'gray'];
                $c = $colors[$approval->action] ?? 'gray';
                $dots = ['yellow'=>'bg-yellow-400','green'=>'bg-green-500','red'=>'bg-red-500','orange'=>'bg-orange-400','gray'=>'bg-gray-300'];
                ?>
                <li class="ml-4">
                    <div class="absolute w-3 h-3 rounded-full -left-1.5 border border-white <?php echo e($dots[$c] ?? 'bg-gray-300'); ?>"></div>
                    <div class="text-sm font-medium text-gray-800"><?php echo e($approval->workflowStep->step_name); ?></div>
                    <div class="text-xs text-gray-500"><?php echo e($approval->workflowStep->role_name); ?></div>
                    <div class="mt-1">
                        <?php $actionColors = ['pending'=>'bg-yellow-100 text-yellow-700','approved'=>'bg-green-100 text-green-700','rejected'=>'bg-red-100 text-red-700','returned'=>'bg-orange-100 text-orange-700','waiting'=>'bg-gray-100 text-gray-500']; ?>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium <?php echo e($actionColors[$approval->action] ?? 'bg-gray-100 text-gray-500'); ?>">
                            <?php echo e($approval->action === 'waiting' ? __('ui.approval.action.waiting') : $approval->action_label); ?>

                        </span>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($approval->approver): ?>
                    <p class="text-xs text-gray-400 mt-1"><?php echo e(__('ui.submission.by_approver', ['name' => $approval->approver->name])); ?></p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($approval->comment): ?>
                    <p class="text-xs text-gray-600 mt-1 bg-gray-50 rounded p-2"><?php echo e($approval->comment); ?></p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($approval->acted_at): ?>
                    <p class="text-xs text-gray-400"><?php echo e($approval->acted_at->format('d/m/Y H:i')); ?></p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </li>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </ol>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $attributes = $__attributesOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__attributesOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $component = $__componentOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__componentOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\xampp\e-form\resources\views/student/submissions/show.blade.php ENDPATH**/ ?>