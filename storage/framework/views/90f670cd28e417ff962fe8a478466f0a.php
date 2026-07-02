<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['title' => ''.e(__('ui.admin.edit_prefix')).': '.e($formType->name).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('ui.admin.edit_prefix')).': '.e($formType->name).'']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="mb-6">
        <a href="<?php echo e(route('admin.form-types.index')); ?>" class="text-gray-500 hover:text-gray-700 text-sm"><?php echo e(__('ui.common.back')); ?></a>
        <h1 class="text-2xl font-bold text-gray-800 mt-2"><?php echo e($formType->name); ?></h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        
        <div class="space-y-6">

            
            <div class="bg-white border border-gray-200 rounded-xl p-6">
                <h2 class="font-semibold text-gray-700 mb-4"><?php echo e(__('ui.admin.general_info')); ?></h2>
                <form action="<?php echo e(route('admin.form-types.update', $formType)); ?>" method="POST" class="space-y-3">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1"><?php echo e(__('ui.common.name')); ?></label>
                        <input type="text" name="name" value="<?php echo e(old('name', $formType->name)); ?>" required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1"><?php echo e(__('ui.admin.description_label')); ?></label>
                        <textarea name="description" rows="2"
                                  class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo e(old('description', $formType->description)); ?></textarea>
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" id="is_active" value="1" <?php echo e($formType->is_active ? 'checked' : ''); ?>>
                        <label for="is_active" class="text-sm text-gray-700"><?php echo e(__('ui.admin.active_label')); ?></label>
                    </div>
                    <div class="grid grid-cols-2 gap-3 pt-1">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?php echo e(__('ui.admin.opens_at_label')); ?></label>
                            <input type="datetime-local" name="opens_at"
                                   value="<?php echo e(old('opens_at', $formType->opens_at?->format('Y-m-d\TH:i'))); ?>"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <p class="text-xs text-gray-400 mt-0.5"><?php echo e(__('ui.admin.no_limit_hint')); ?></p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1"><?php echo e(__('ui.admin.closes_at_label')); ?></label>
                            <input type="datetime-local" name="closes_at"
                                   value="<?php echo e(old('closes_at', $formType->closes_at?->format('Y-m-d\TH:i'))); ?>"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <p class="text-xs text-gray-400 mt-0.5"><?php echo e(__('ui.admin.no_limit_hint')); ?></p>
                        </div>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition"><?php echo e(__('ui.common.save')); ?></button>
                </form>
            </div>

            
            <div class="bg-white border border-gray-200 rounded-xl p-6">
                <h2 class="font-semibold text-gray-700 mb-4"><?php echo e(__('ui.admin.form_fields')); ?></h2>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($formType->fields->isNotEmpty()): ?>
                <div class="space-y-2 mb-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $formType->fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="flex items-center justify-between bg-gray-50 border border-gray-200 rounded-lg px-3 py-2">
                        <div>
                            <span class="text-sm font-medium text-gray-800"><?php echo e($field->label); ?></span>
                            <span class="text-xs text-gray-400 ml-2"><?php echo e($fieldTypes[$field->field_type] ?? $field->field_type); ?></span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($field->is_required): ?>
                                <span class="text-xs text-red-500 ml-1">*<?php echo e(__('ui.admin.required_badge')); ?></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <form action="<?php echo e(route('admin.form-types.fields.destroy', [$formType, $field])); ?>" method="POST"
                              onsubmit="return confirm('<?php echo e(__('ui.admin.confirm_delete_field')); ?>')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="text-red-400 hover:text-red-600 text-xs"><?php echo e(__('ui.common.delete')); ?></button>
                        </form>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                
                <details class="group">
                    <summary class="cursor-pointer text-sm text-blue-600 font-medium hover:underline list-none">
                        + <?php echo e(__('ui.admin.add_field')); ?>

                    </summary>
                    <form action="<?php echo e(route('admin.form-types.fields.store', $formType)); ?>" method="POST" class="mt-3 space-y-3 border-t border-gray-100 pt-3">
                        <?php echo csrf_field(); ?>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1"><?php echo e(__('ui.admin.field_label')); ?></label>
                                <input type="text" name="label" required placeholder="<?php echo e(__('ui.admin.field_label_placeholder')); ?>"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1"><?php echo e(__('ui.admin.field_key')); ?></label>
                                <input type="text" name="field_key" required placeholder="<?php echo e(__('ui.admin.field_key_placeholder')); ?>"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm font-mono focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1"><?php echo e(__('ui.admin.field_type')); ?></label>
                                <select name="field_type" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $fieldTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <option value="<?php echo e($val); ?>"><?php echo e($label); ?></option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </select>
                            </div>
                            <div class="flex items-end pb-2">
                                <label class="flex items-center gap-2 text-sm text-gray-700">
                                    <input type="checkbox" name="is_required" value="1"> <?php echo e(__('ui.admin.field_required')); ?>

                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1">Placeholder</label>
                            <input type="text" name="placeholder" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-600 mb-1"><?php echo e(__('ui.admin.field_options_label')); ?></label>
                            <textarea name="options" rows="3" placeholder="<?php echo e(__('ui.admin.field_options_placeholder')); ?>"
                                      class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition"><?php echo e(__('ui.admin.add_field')); ?></button>
                    </form>
                </details>
            </div>
        </div>

        
        <div class="bg-white border border-gray-200 rounded-xl p-6">
            <h2 class="font-semibold text-gray-700 mb-1"><?php echo e(__('ui.admin.workflow_title')); ?></h2>
            <p class="text-xs text-gray-400 mb-4"><?php echo e(__('ui.admin.workflow_subtitle')); ?></p>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($formType->workflowSteps->isNotEmpty()): ?>
            <div class="space-y-2 mb-4" id="workflow-list">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $formType->workflowSteps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <div class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-lg px-3 py-3 cursor-move" draggable="true" data-step-id="<?php echo e($step->id); ?>">
                    <span class="text-gray-400 text-sm">⠿</span>
                    <div class="flex-1">
                        <div class="text-sm font-medium text-gray-800"><?php echo e($step->step_order); ?>. <?php echo e($step->step_name); ?></div>
                        <div class="text-xs text-gray-400"><?php echo e($step->role_name); ?></div>
                        <div class="flex gap-2 mt-1">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($step->can_reject): ?>
                                <span class="text-xs bg-red-50 text-red-500 px-1.5 py-0.5 rounded"><?php echo e(__('ui.admin.can_reject')); ?></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($step->can_return): ?>
                                <span class="text-xs bg-orange-50 text-orange-500 px-1.5 py-0.5 rounded"><?php echo e(__('ui.admin.can_return')); ?></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                    <form action="<?php echo e(route('admin.workflow.destroy', [$formType, $step])); ?>" method="POST"
                          onsubmit="return confirm('<?php echo e(__('ui.admin.confirm_delete_step')); ?>')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button class="text-red-400 hover:text-red-600 text-sm"><?php echo e(__('ui.common.delete')); ?></button>
                    </form>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
            <?php else: ?>
            <div class="border-2 border-dashed border-gray-200 rounded-lg p-6 text-center text-gray-400 text-sm mb-4">
                <?php echo e(__('ui.admin.no_workflow_steps')); ?>

            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <details class="group">
                <summary class="cursor-pointer text-sm text-blue-600 font-medium hover:underline list-none">
                    + <?php echo e(__('ui.admin.add_step')); ?>

                </summary>
                <form action="<?php echo e(route('admin.workflow.store', $formType)); ?>" method="POST" class="mt-3 space-y-3 border-t border-gray-100 pt-3">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1"><?php echo e(__('ui.admin.step_name')); ?></label>
                        <input type="text" name="step_name" required placeholder="<?php echo e(__('ui.admin.step_name_placeholder')); ?>"
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1"><?php echo e(__('ui.admin.approver_role')); ?></label>
                        <select name="approver_role" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $approverRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <option value="<?php echo e($role); ?>"><?php echo e($label); ?></option>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </select>
                    </div>
                    <div class="flex gap-4">
                        <label class="flex items-center gap-2 text-sm text-gray-700">
                            <input type="checkbox" name="can_reject" value="1" checked> <?php echo e(__('ui.admin.can_reject')); ?>

                        </label>
                        <label class="flex items-center gap-2 text-sm text-gray-700">
                            <input type="checkbox" name="can_return" value="1" checked> <?php echo e(__('ui.admin.can_return')); ?>

                        </label>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition"><?php echo e(__('ui.admin.add_step')); ?></button>
                </form>
            </details>
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
<?php endif; ?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const list = document.getElementById('workflow-list');
    if (list) {
        sortable(list);
        list.addEventListener('reorder', () => {
            const ids = [...list.querySelectorAll('[data-step-id]')].map(el => el.dataset.stepId);
            fetch('<?php echo e(route('admin.workflow.reorder', $formType)); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                },
                body: JSON.stringify({ steps: ids }),
            }).then(() => location.reload());
        });
    }
});
</script>
<?php /**PATH C:\xampp\htdocs\xampp\e-form\resources\views/admin/form-types/edit.blade.php ENDPATH**/ ?>