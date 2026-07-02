<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['title' => ''.e(__('ui.admin.users_title')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('ui.admin.users_title')).'']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800"><?php echo e(__('ui.admin.users_title')); ?></h1>
        <p class="text-gray-500 text-sm mt-1"><?php echo e(__('ui.admin.users_subtitle')); ?></p>
    </div>

    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-4 py-3 text-left text-gray-600 font-medium"><?php echo e(__('ui.admin.user_col')); ?></th>
                    <th class="px-4 py-3 text-left text-gray-600 font-medium"><?php echo e(__('ui.admin.student_id_col')); ?></th>
                    <th class="px-4 py-3 text-left text-gray-600 font-medium"><?php echo e(__('ui.admin.department_col')); ?></th>
                    <th class="px-4 py-3 text-left text-gray-600 font-medium"><?php echo e(__('ui.admin.role_col')); ?></th>
                    <th class="px-4 py-3 text-left text-gray-600 font-medium"><?php echo e(__('ui.common.status')); ?></th>
                    <th class="px-4 py-3"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">
                        <div class="flex items-center gap-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->avatar): ?>
                                <img src="<?php echo e($user->avatar); ?>" class="w-8 h-8 rounded-full object-cover">
                            <?php else: ?>
                                <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white text-xs font-bold">
                                    <?php echo e(mb_substr($user->name, 0, 1)); ?>

                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <div>
                                <div class="font-medium text-gray-800"><?php echo e($user->name); ?></div>
                                <div class="text-xs text-gray-400"><?php echo e($user->email); ?></div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-gray-600"><?php echo e($user->student_id ?? '-'); ?></td>
                    <td class="px-4 py-3 text-gray-600"><?php echo e($user->department ?? '-'); ?></td>
                    <td class="px-4 py-3">
                        <form action="<?php echo e(route('admin.users.update', $user)); ?>" method="POST" class="flex items-center gap-2">
                            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                            <input type="hidden" name="is_active" value="<?php echo e($user->is_active ? '1' : '0'); ?>">
                            <input type="hidden" name="department" value="<?php echo e($user->department); ?>">
                            <input type="hidden" name="student_id" value="<?php echo e($user->student_id); ?>">
                            <select name="role" onchange="this.form.submit()"
                                    class="border border-gray-300 rounded-lg px-2 py-1.5 text-xs focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roleKey => $roleLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <option value="<?php echo e($roleKey); ?>" <?php echo e($user->role === $roleKey ? 'selected' : ''); ?>>
                                        <?php echo e($roleLabel); ?>

                                    </option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </select>
                        </form>
                    </td>
                    <td class="px-4 py-3">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->is_active): ?>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700"><?php echo e(__('ui.admin.user_active')); ?></span>
                        <?php else: ?>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-600"><?php echo e(__('ui.admin.user_suspended')); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </td>
                    <td class="px-4 py-3 text-right">
                        <form action="<?php echo e(route('admin.users.update', $user)); ?>" method="POST">
                            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                            <input type="hidden" name="role" value="<?php echo e($user->role); ?>">
                            <input type="hidden" name="department" value="<?php echo e($user->department); ?>">
                            <input type="hidden" name="student_id" value="<?php echo e($user->student_id); ?>">
                            <input type="hidden" name="is_active" value="<?php echo e($user->is_active ? '0' : '1'); ?>">
                            <button class="text-xs <?php echo e($user->is_active ? 'text-red-500 hover:text-red-700' : 'text-green-600 hover:text-green-800'); ?>">
                                <?php echo e($user->is_active ? __('ui.admin.suspend_btn') : __('ui.admin.activate_btn')); ?>

                            </button>
                        </form>
                    </td>
                </tr>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="mt-4"><?php echo e($users->links()); ?></div>
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
<?php /**PATH C:\xampp\htdocs\xampp\e-form\resources\views/admin/users/index.blade.php ENDPATH**/ ?>