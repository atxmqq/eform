<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['title' => ''.e(__('ui.dashboard.submit_new')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('ui.dashboard.submit_new')).'']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800"><?php echo e(__('ui.dashboard.hello')); ?>, <?php echo e(auth()->user()->name); ?></h1>
        <p class="text-gray-500 mt-1"><?php echo e(__('ui.dashboard.select_form_type')); ?></p>
    </div>

    
    <section class="mb-10">
        <h2 class="text-lg font-semibold text-gray-700 mb-4"><?php echo e(__('ui.dashboard.submit_new')); ?></h2>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($formTypes->isEmpty()): ?>
            <div class="bg-white border border-gray-200 rounded-xl p-8 text-center text-gray-400">
                <?php echo e(__('ui.dashboard.no_forms')); ?>

            </div>
        <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $formTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
            <?php
                $open = $type->isOpen();
                $notYet = $type->opens_at && now()->lt($type->opens_at);
            ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($open): ?>
            <a href="<?php echo e(route('student.submissions.create', $type)); ?>"
               class="bg-white border border-gray-200 rounded-xl p-6 hover:border-blue-400 hover:shadow-md transition group">
                <div class="flex items-start justify-between mb-3">
                    <div class="text-3xl">📄</div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($type->closes_at): ?>
                        <span class="text-xs bg-green-50 text-green-700 border border-green-200 rounded-full px-2 py-0.5">
                            <?php echo e(__('ui.dashboard.closes_badge')); ?> <?php echo e($type->closes_at->format('d/m/Y')); ?>

                        </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <h3 class="font-semibold text-gray-800 group-hover:text-blue-700"><?php echo e($type->name); ?></h3>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($type->description): ?>
                    <p class="text-sm text-gray-500 mt-1 line-clamp-2"><?php echo e($type->description); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <div class="mt-4 text-sm text-blue-600 font-medium"><?php echo e(__('ui.dashboard.submit_btn')); ?></div>
            </a>
            <?php else: ?>
            <div class="bg-gray-50 border border-gray-200 rounded-xl p-6 opacity-60 cursor-not-allowed">
                <div class="flex items-start justify-between mb-3">
                    <div class="text-3xl grayscale">📄</div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($notYet): ?>
                        <span class="text-xs bg-yellow-50 text-yellow-700 border border-yellow-200 rounded-full px-2 py-0.5">
                            <?php echo e(__('ui.dashboard.opens_badge')); ?> <?php echo e($type->opens_at->format('d/m/Y')); ?>

                        </span>
                    <?php else: ?>
                        <span class="text-xs bg-red-50 text-red-600 border border-red-200 rounded-full px-2 py-0.5">
                            <?php echo e(__('ui.dashboard.closed_badge')); ?>

                        </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <h3 class="font-semibold text-gray-700"><?php echo e($type->name); ?></h3>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($type->description): ?>
                    <p class="text-sm text-gray-400 mt-1 line-clamp-2"><?php echo e($type->description); ?></p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <div class="mt-4 text-sm text-gray-400">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($notYet): ?>
                        <?php echo e(__('ui.dashboard.opens_on', ['date' => $type->opens_at->format('d/m/Y H:i')])); ?>

                    <?php else: ?>
                        <?php echo e(__('ui.dashboard.closed_on', ['date' => $type->closes_at?->format('d/m/Y H:i') ?? ''])); ?>

                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </section>

    
    <section>
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-semibold text-gray-700"><?php echo e(__('ui.dashboard.recent_submissions')); ?></h2>
            <a href="<?php echo e(route('student.submissions.index')); ?>" class="text-sm text-blue-600 hover:underline"><?php echo e(__('ui.dashboard.view_all')); ?></a>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($submissions->isEmpty()): ?>
            <div class="bg-white border border-gray-200 rounded-xl p-8 text-center text-gray-400">
                <?php echo e(__('ui.dashboard.no_submissions_yet')); ?>

            </div>
        <?php else: ?>
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium"><?php echo e(__('ui.submission.form_type_col')); ?></th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium"><?php echo e(__('ui.submission.submitted_date_col')); ?></th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium"><?php echo e(__('ui.common.status')); ?></th>
                        <th class="px-4 py-3"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $submissions->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-800"><?php echo e($sub->formType->name); ?></td>
                        <td class="px-4 py-3 text-gray-500"><?php echo e($sub->submitted_at?->format('d/m/Y H:i') ?? '-'); ?></td>
                        <td class="px-4 py-3">
                            <?php echo $__env->make('components.status-badge', ['status' => $sub->status, 'label' => $sub->status_label], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="<?php echo e(route('student.submissions.show', $sub)); ?>" class="text-blue-600 hover:underline text-xs"><?php echo e(__('ui.common.view_details')); ?></a>
                        </td>
                    </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </section>
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
<?php /**PATH C:\xampp\htdocs\xampp\e-form\resources\views/dashboard/student.blade.php ENDPATH**/ ?>