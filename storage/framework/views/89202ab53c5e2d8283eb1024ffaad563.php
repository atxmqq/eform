<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['title' => ''.e(__('ui.dashboard.admin_title')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('ui.dashboard.admin_title')).'']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-800"><?php echo e(__('ui.dashboard.admin_title')); ?></h1>
    </div>

    
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = [
            ['label' => __('ui.dashboard.total_submissions'), 'value' => $stats['total_submissions'], 'color' => 'blue',   'icon' => '📋'],
            ['label' => __('ui.dashboard.pending_count'),     'value' => $stats['pending'],           'color' => 'yellow', 'icon' => '⏳'],
            ['label' => __('ui.dashboard.approved_count'),    'value' => $stats['approved'],          'color' => 'green',  'icon' => '✅'],
            ['label' => __('ui.dashboard.rejected_count'),    'value' => $stats['rejected'],          'color' => 'red',    'icon' => '❌'],
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
        <div class="bg-white border border-gray-200 rounded-xl p-5">
            <div class="text-2xl mb-1"><?php echo e($stat['icon']); ?></div>
            <div class="text-2xl font-bold text-gray-800"><?php echo e($stat['value']); ?></div>
            <div class="text-sm text-gray-500"><?php echo e($stat['label']); ?></div>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
    </div>

    
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-8">
        <a href="<?php echo e(route('admin.form-types.index')); ?>" class="bg-blue-600 text-white rounded-xl p-6 hover:bg-blue-700 transition">
            <div class="text-3xl mb-2">📝</div>
            <h3 class="font-bold text-lg"><?php echo e(__('ui.dashboard.manage_forms')); ?></h3>
            <p class="text-blue-200 text-sm mt-1"><?php echo e(__('ui.dashboard.manage_forms_desc')); ?></p>
        </a>
        <a href="<?php echo e(route('admin.users.index')); ?>" class="bg-purple-600 text-white rounded-xl p-6 hover:bg-purple-700 transition">
            <div class="text-3xl mb-2">👥</div>
            <h3 class="font-bold text-lg"><?php echo e(__('ui.dashboard.manage_users')); ?></h3>
            <p class="text-purple-200 text-sm mt-1"><?php echo e(__('ui.dashboard.manage_users_desc')); ?></p>
        </a>
    </div>

    
    <section>
        <h2 class="text-lg font-semibold text-gray-700 mb-4"><?php echo e(__('ui.dashboard.recent_all')); ?></h2>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($recent->isEmpty()): ?>
            <div class="bg-white border border-gray-200 rounded-xl p-8 text-center text-gray-400"><?php echo e(__('ui.dashboard.no_data')); ?></div>
        <?php else: ?>
        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium"><?php echo e(__('ui.dashboard.submitter_col')); ?></th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium"><?php echo e(__('ui.submission.form_type_col')); ?></th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium"><?php echo e(__('ui.submission.submitted_date_col')); ?></th>
                        <th class="px-4 py-3 text-left text-gray-600 font-medium"><?php echo e(__('ui.common.status')); ?></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $recent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-800"><?php echo e($sub->submitter->name); ?></div>
                            <div class="text-xs text-gray-400"><?php echo e($sub->submitter->email); ?></div>
                        </td>
                        <td class="px-4 py-3 text-gray-700"><?php echo e($sub->formType->name); ?></td>
                        <td class="px-4 py-3 text-gray-500"><?php echo e($sub->submitted_at?->format('d/m/Y') ?? '-'); ?></td>
                        <td class="px-4 py-3">
                            <?php echo $__env->make('components.status-badge', ['status' => $sub->status, 'label' => $sub->status_label], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
<?php /**PATH C:\xampp\htdocs\xampp\e-form\resources\views/dashboard/admin.blade.php ENDPATH**/ ?>