<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['title' => ''.e(__('ui.approval.review_title')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('ui.approval.review_title')).'']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="mb-6">
        <a href="<?php echo e(route('approver.index')); ?>" class="text-gray-500 hover:text-gray-700 text-sm"><?php echo e(__('ui.common.back')); ?></a>
        <div class="flex items-start justify-between mt-2">
            <div>
                <h1 class="text-2xl font-bold text-gray-800"><?php echo e(__('ui.approval.review_title')); ?>: <?php echo e($submission->formType->name); ?></h1>
                <p class="text-gray-500 text-sm mt-1">
                    <?php echo e(__('ui.approval.submitter_label')); ?>: <?php echo e($submission->submitter->name); ?> —
                    <?php echo e($approval->workflowStep->step_name); ?>

                </p>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($submission->formType->code, ['leave_study','thesis_registration','special_status','reinstatement'])): ?>
            <a href="<?php echo e(route('submissions.pdf', $submission)); ?>" target="_blank"
                class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition mt-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <?php echo e(__('ui.submission.download_pdf')); ?>

            </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 space-y-6">
            
            <div class="bg-white border border-gray-200 rounded-xl p-6">
                <h2 class="font-semibold text-gray-700 mb-4"><?php echo e(__('ui.approval.submitter_info')); ?></h2>
                <dl class="grid grid-cols-2 gap-3 text-sm">
                    <div>
                        <dt class="text-gray-500"><?php echo e(__('ui.common.name')); ?></dt>
                        <dd class="font-medium text-gray-800"><?php echo e($submission->submitter->name); ?></dd>
                    </div>
                    <div>
                        <dt class="text-gray-500"><?php echo e(__('ui.common.email')); ?></dt>
                        <dd class="font-medium text-gray-800"><?php echo e($submission->submitter->email); ?></dd>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($submission->submitter->student_id): ?>
                    <div>
                        <dt class="text-gray-500"><?php echo e(__('ui.approval.student_id')); ?></dt>
                        <dd class="font-medium text-gray-800"><?php echo e($submission->submitter->student_id); ?></dd>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </dl>
            </div>

            
            <div class="bg-white border border-gray-200 rounded-xl p-6">
                <h2 class="font-semibold text-gray-700 mb-4"><?php echo e(__('ui.submission.form_data')); ?></h2>

                
                <dl class="space-y-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $submission->formType->fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="border-b border-gray-50 pb-3 last:border-0">
                        <dt class="text-sm font-medium text-gray-500"><?php echo e($field->label); ?></dt>
                        <dd class="mt-1 text-sm text-gray-800">
                            <?php
                            $val = $submission->getFieldValue($field->field_key);
                            // เช็กว่าเป็นช่องอาจารย์ไหม
                            if ($field->field_type === 'advisor_select' && $val) {
                            $adv = DB::table('form_request_advisor')->where('advisor_id', $val)->first();
                            if ($adv) $val = ($adv->prefixname ?? '') . $adv->advisorname . ' ' . $adv->advisorsurname;
                            }
                            ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($field->field_type === 'file' && $val): ?>
                            <a href="<?php echo e(asset('storage/' . $val)); ?>" target="_blank" class="text-blue-600 hover:underline">Download File</a>
                            <?php else: ?>
                            <?php echo e($val ?? '-'); ?>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </dd>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </dl>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($submission->formType->code === 'reinstatement'): ?>
                <div class="mt-6 pt-6 border-t border-gray-200 bg-blue-50 p-4 rounded-lg">
                    <?php
                    $getVal = fn($key) => $submission->fieldValues->firstWhere('field_key', $key)?->value;
                    ?>
                    <div class="text-sm space-y-2 text-gray-700">
                        <p><strong>สาเหตุ:</strong> <?php echo e($getVal('loss_reason_type') === 'not_paid' ? 'ไม่ชำระเงินรักษาสภาพ ('.$getVal('missed_semesters_count').' ภาคเรียน, เทอม: '.$getVal('missed_semester_details').')' : 'ไม่ได้ลงทะเบียนเรียนตามกำหนด'); ?></p>
                        <p><strong>คืนสภาพตั้งแต่:</strong> ภาค <?php echo e($getVal('retain_status_semester')); ?> / ปี <?php echo e($getVal('retain_status_year')); ?></p>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($getVal('leave_from_semester')): ?>
                        <p><strong>ลาพักการเรียน:</strong> ภาค <?php echo e($getVal('leave_from_semester')); ?>/<?php echo e($getVal('leave_from_year')); ?> ถึง ภาค <?php echo e($getVal('leave_to_semester')); ?>/<?php echo e($getVal('leave_to_year')); ?></p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div class="bg-white border border-blue-200 rounded-xl p-6">
                <h2 class="font-semibold text-gray-700 mb-4"><?php echo e(__('ui.approval.action_section')); ?></h2>
                <form action="<?php echo e(route('approver.act', $submission)); ?>" method="POST" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2"><?php echo e(__('ui.approval.decision')); ?></label>
                        <div class="flex gap-3 flex-wrap">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="action" value="approved" required class="text-green-600">
                                <span class="text-sm font-medium text-green-700 bg-green-50 border border-green-200 px-3 py-1.5 rounded-lg">อนุมัติ</span>
                            </label>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($approval->workflowStep->can_return): ?>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="action" value="returned" class="text-orange-500">
                                <span class="text-sm font-medium text-orange-700 bg-orange-50 border border-orange-200 px-3 py-1.5 rounded-lg">ส่งกลับแก้ไข</span>
                            </label>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($approval->workflowStep->can_reject): ?>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="action" value="rejected" class="text-red-500">
                                <span class="text-sm font-medium text-red-700 bg-red-50 border border-red-200 px-3 py-1.5 rounded-lg">ปฏิเสธ</span>
                            </label>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1"><?php echo e(__('ui.approval.comment')); ?></label>
                        <textarea name="comment" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500"><?php echo e(old('comment')); ?></textarea>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg text-sm font-medium hover:bg-blue-700 transition">ยืนยันการดำเนินการ</button>
                </form>
            </div>
        </div>

        
        <div class="bg-white border border-gray-200 rounded-xl p-6 h-fit">
            <h2 class="font-semibold text-gray-700 mb-4"><?php echo e(__('ui.approval.all_steps')); ?></h2>
            <ol class="relative border-l border-gray-200 space-y-4 ml-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $submission->approvals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php
                $isCurrent = $step->step_order === $submission->current_step_order;
                $dots = ['approved'=>'bg-green-500','rejected'=>'bg-red-500','returned'=>'bg-orange-400','pending'=>'bg-yellow-400','waiting'=>'bg-gray-300'];
                ?>
                <li class="ml-4">
                    <div class="absolute w-3 h-3 rounded-full -left-1.5 border border-white <?php echo e($dots[$step->action] ?? 'bg-gray-300'); ?> <?php echo e($isCurrent ? 'ring-2 ring-blue-300' : ''); ?>"></div>
                    <div class="text-sm font-medium <?php echo e($isCurrent ? 'text-blue-700' : 'text-gray-800'); ?>">
                        <?php echo e($step->workflowStep->step_name); ?>

                    </div>
                    <div class="text-xs text-gray-400"><?php echo e($step->workflowStep->role_name); ?></div>
                </li>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </ol>
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
<?php endif; ?><?php /**PATH C:\xampp\htdocs\xampp\e-form\resources\views/approver/show.blade.php ENDPATH**/ ?>