<?php if (isset($component)) { $__componentOriginal23a33f287873b564aaf305a1526eada4 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal23a33f287873b564aaf305a1526eada4 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layout','data' => ['title' => ''.e(__('ui.auth.system_name')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e(__('ui.auth.system_name')).'']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="min-h-[70vh] flex items-center justify-center">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-10 w-full max-w-md">
            <div class="text-center mb-8">
                <div class="text-5xl mb-3">📋</div>
                <h1 class="text-2xl font-bold text-gray-800"><?php echo e(__('ui.auth.system_name')); ?></h1>
                <p class="text-gray-500 text-sm mt-1"><?php echo e(__('ui.auth.signin_institution')); ?></p>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm">
                <?php echo e($errors->first()); ?>

            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="space-y-3">
                <a href="<?php echo e(route('auth.social.redirect', 'google')); ?>"
                   class="flex items-center justify-center gap-3 w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-gray-700 font-medium hover:border-blue-400 hover:bg-blue-50 transition">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    <?php echo e(__('ui.auth.signin_google')); ?>

                </a>

                <a href="<?php echo e(route('auth.social.redirect', 'microsoft')); ?>"
                   class="flex items-center justify-center gap-3 w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl text-gray-700 font-medium hover:border-blue-400 hover:bg-blue-50 transition">
                    <svg class="w-5 h-5" viewBox="0 0 24 24">
                        <path fill="#F25022" d="M1 1h10v10H1z"/>
                        <path fill="#00A4EF" d="M13 1h10v10H13z"/>
                        <path fill="#7FBA00" d="M1 13h10v10H1z"/>
                        <path fill="#FFB900" d="M13 13h10v10H13z"/>
                    </svg>
                    <?php echo e(__('ui.auth.signin_microsoft')); ?>

                </a>
            </div>

            <p class="text-center text-xs text-gray-400 mt-6">
                <?php echo e(__('ui.auth.institution_only')); ?>

            </p>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(app()->isLocal()): ?>
            <div class="mt-6 pt-5 border-t border-dashed border-gray-200">
                <p class="text-center text-xs text-gray-400 mb-3">Dev login (local only)</p>
                <form method="POST" action="<?php echo e(route('login.dev')); ?>" class="space-y-3">
                    <?php echo csrf_field(); ?>
                    <input type="email" name="email" placeholder="Email" value="<?php echo e(old('email')); ?>" required
                           class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-500 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-400 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-xs text-red-500"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <input type="password" name="password" placeholder="Password" required
                           class="block w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-500">
                    <button type="submit"
                            class="w-full py-2 text-sm font-medium text-white bg-gray-700 rounded-lg hover:bg-gray-800 transition">
                        <?php echo e(__('ui.auth.login_btn')); ?>

                    </button>
                </form>
            </div>
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
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\xampp\e-form\resources\views/auth/login.blade.php ENDPATH**/ ?>