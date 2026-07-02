<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['title' => ''.e(__('ui.approval.pending_list')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('ui.approval.pending_list')).'']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800"><?php echo e(__('ui.approval.pending_list')); ?></h1>
        <p class="text-gray-500 mt-1"><?php echo e(auth()->user()->role_name); ?></p>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pending->isEmpty()): ?>
        <div class="bg-white border border-gray-200 rounded-xl p-12 text-center">
            <div class="text-5xl mb-4">✅</div>
            <p class="text-gray-500"><?php echo e(__('ui.approval.no_pending')); ?></p>
        </div>
    <?php else: ?>
    <div class="space-y-3">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $pending; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $approval): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
        <div class="bg-white border border-gray-200 rounded-xl p-5 hover:border-blue-300 transition">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="font-semibold text-gray-800"><?php echo e($approval->submission->formType->name); ?></span>
                        <span class="text-xs bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full"><?php echo e(__('ui.dashboard.step_label')); ?>: <?php echo e($approval->workflowStep->step_name); ?></span>
                    </div>
                    <p class="text-sm text-gray-600">
                        <?php echo e(__('ui.approval.submitter_label')); ?>: <span class="font-medium"><?php echo e($approval->submission->submitter->name); ?></span>
                        (<?php echo e($approval->submission->submitter->email); ?>)
                    </p>
                    <p class="text-xs text-gray-400 mt-1">
                        <?php echo e(__('ui.approval.submitted_at_label')); ?>: <?php echo e($approval->submission->submitted_at?->format('d/m/Y H:i')); ?>

                    </p>
                </div>
                <a href="<?php echo e(route('approver.show', $approval->submission)); ?>"
                   class="shrink-0 bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition">
                    <?php echo e(__('ui.dashboard.proceed_btn')); ?>

                </a>
            </div>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($recent->isNotEmpty()): ?>
    <section class="mt-10">
        <h2 class="text-lg font-semibold text-gray-700 mb-4"><?php echo e(__('ui.dashboard.history')); ?></h2>
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium"><?php echo e(__('ui.submission.form_type_col')); ?></th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium"><?php echo e(__('ui.approval.submitter_label')); ?></th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium"><?php echo e(__('ui.dashboard.action_col')); ?></th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium"><?php echo e(__('ui.submission.submitted_date_col')); ?></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $recent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <tr>
                        <td class="px-4 py-3 text-gray-800"><?php echo e($act->submission->formType->name); ?></td>
                        <td class="px-4 py-3 text-gray-600"><?php echo e($act->submission->submitter->name); ?></td>
                        <td class="px-4 py-3">
                            <?php $colors = ['approved'=>'green','rejected'=>'red','returned'=>'orange']; $c = $colors[$act->action] ?? 'gray'; ?>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-<?php echo e($c); ?>-100 text-<?php echo e($c); ?>-700">
                                <?php echo e($act->action_label); ?>

                            </span>
                        </td>
                        <td class="px-4 py-3 text-gray-400 text-xs"><?php echo e($act->acted_at?->format('d/m/Y H:i')); ?></td>
                    </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $attributes = $__attributesOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__attributesOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal23a33f287873b564aaf305a1526eada4)): ?>
<?php $component = $__componentOriginal23a33f287873b564aaf305a1526eada4; ?>
<?php unset($__componentOriginal23a33f287873b564aaf305a1526eada4); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\xampp\e-form\resources\views/dashboard/approver.blade.php ENDPATH**/ ?>