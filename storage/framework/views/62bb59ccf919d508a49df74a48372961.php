<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['title' => ''.e(__('ui.admin.form_types_title')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('ui.admin.form_types_title')).'']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800"><?php echo e(__('ui.admin.form_types_title')); ?></h1>
            <p class="text-gray-500 text-sm mt-1"><?php echo e(__('ui.admin.form_types_subtitle')); ?></p>
        </div>
        <a href="<?php echo e(route('admin.form-types.create')); ?>"
           class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition flex items-center gap-2">
            <span>+</span> <?php echo e(__('ui.admin.add_form_type')); ?>

        </a>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($formTypes->isEmpty()): ?>
        <div class="bg-white border border-gray-200 rounded-xl p-12 text-center">
            <div class="text-5xl mb-4">📋</div>
            <p class="text-gray-500 mb-4"><?php echo e(__('ui.admin.no_form_types')); ?></p>
            <a href="<?php echo e(route('admin.form-types.create')); ?>" class="text-blue-600 hover:underline"><?php echo e(__('ui.admin.create_first')); ?></a>
        </div>
    <?php else: ?>
    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 text-left text-gray-600 font-medium"><?php echo e(__('ui.common.name')); ?></th>
                    <th class="px-4 py-3 text-left text-gray-600 font-medium"><?php echo e(__('ui.admin.code_col')); ?></th>
                    <th class="px-4 py-3 text-left text-gray-600 font-medium"><?php echo e(__('ui.admin.total_submissions_col')); ?></th>
                    <th class="px-4 py-3 text-left text-gray-600 font-medium"><?php echo e(__('ui.common.status')); ?></th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $formTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <div class="font-medium text-gray-800"><?php echo e($type->name); ?></div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($type->description): ?>
                            <div class="text-xs text-gray-400"><?php echo e(Str::limit($type->description, 60)); ?></div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </td>
                    <td class="px-4 py-3"><code class="text-xs bg-gray-100 px-2 py-0.5 rounded"><?php echo e($type->code); ?></code></td>
                    <td class="px-4 py-3 text-gray-600"><?php echo e($type->submissions_count); ?></td>
                    <td class="px-4 py-3">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($type->is_active): ?>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700"><?php echo e(__('ui.admin.active')); ?></span>
                        <?php else: ?>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500"><?php echo e(__('ui.admin.inactive')); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="<?php echo e(route('admin.form-types.edit', $type)); ?>" class="text-blue-600 hover:underline text-xs"><?php echo e(__('ui.admin.edit_workflow')); ?></a>
                            <form action="<?php echo e(route('admin.form-types.destroy', $type)); ?>" method="POST"
                                  onsubmit="return confirm('<?php echo e(__('ui.admin.confirm_delete')); ?>')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button class="text-red-500 hover:underline text-xs"><?php echo e(__('ui.common.delete')); ?></button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </tbody>
        </table>
    </div>
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
<?php /**PATH C:\xampp\htdocs\xampp\e-form\resources\views/admin/form-types/index.blade.php ENDPATH**/ ?>