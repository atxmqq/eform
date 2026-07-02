<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(isset($title) ? $title . ' - ' : ''); ?><?php echo e(config('app.name')); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">


<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center gap-4">
                <a href="<?php echo e(route('dashboard')); ?>" class="text-blue-700 font-bold text-lg tracking-tight">
                    📋 <?php echo e(config('app.name')); ?>

                </a>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                <div class="hidden md:flex items-center gap-1">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->isAdmin()): ?>
                        <a href="<?php echo e(route('admin.form-types.index')); ?>" class="px-3 py-2 text-sm text-gray-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition"><?php echo e(__('ui.nav.form_types')); ?></a>
                        <a href="<?php echo e(route('admin.users.index')); ?>" class="px-3 py-2 text-sm text-gray-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition"><?php echo e(__('ui.nav.manage_users')); ?></a>
                    <?php elseif(auth()->user()->isStudent()): ?>
                        <a href="<?php echo e(route('student.submissions.index')); ?>" class="px-3 py-2 text-sm text-gray-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition"><?php echo e(__('ui.nav.my_submissions')); ?></a>
                    <?php elseif(auth()->user()->canApprove()): ?>
                        <a href="<?php echo e(route('approver.index')); ?>" class="px-3 py-2 text-sm text-gray-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition"><?php echo e(__('ui.nav.pending_approvals')); ?></a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
            <div class="flex items-center gap-3">
                
                <div class="flex items-center gap-0.5 text-xs border border-gray-200 rounded-lg overflow-hidden">
                    <a href="<?php echo e(route('lang.switch', 'th')); ?>"
                       class="px-2.5 py-1.5 transition <?php echo e(app()->getLocale() === 'th' ? 'bg-blue-600 text-white font-semibold' : 'text-gray-500 hover:bg-gray-100'); ?>">TH</a>
                    <a href="<?php echo e(route('lang.switch', 'en')); ?>"
                       class="px-2.5 py-1.5 transition <?php echo e(app()->getLocale() === 'en' ? 'bg-blue-600 text-white font-semibold' : 'text-gray-500 hover:bg-gray-100'); ?>">EN</a>
                </div>

                <div class="flex items-center gap-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->avatar): ?>
                        <img src="<?php echo e(auth()->user()->avatar); ?>" class="w-8 h-8 rounded-full object-cover">
                    <?php else: ?>
                        <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white text-sm font-bold">
                            <?php echo e(mb_substr(auth()->user()->name, 0, 1)); ?>

                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <div class="hidden sm:block">
                        <p class="text-sm font-medium text-gray-700"><?php echo e(auth()->user()->name); ?></p>
                        <p class="text-xs text-gray-400"><?php echo e(auth()->user()->role_name); ?></p>
                    </div>
                </div>
                <a href="<?php echo e(route('profile.show')); ?>"
                   class="text-sm text-gray-500 hover:text-blue-600 transition px-2 py-1 rounded flex items-center gap-1">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!auth()->user()->signature): ?>
                        <span class="w-2 h-2 rounded-full bg-yellow-400 inline-block"></span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php echo e(__('ui.nav.profile')); ?>

                </a>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button class="text-sm text-gray-500 hover:text-red-600 transition px-2 py-1 rounded"><?php echo e(__('ui.nav.logout')); ?></button>
                </form>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</nav>


<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center gap-2">
        <span>✅</span> <?php echo e(session('success')); ?>

    </div>
</div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center gap-2">
        <span>❌</span> <?php echo e(session('error')); ?>

    </div>
</div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <?php echo e($slot); ?>

</main>

<script>
function sortable(el) {
    // Simple drag-and-drop reorder for workflow steps
    let dragSrc = null;
    el.querySelectorAll('[draggable]').forEach(item => {
        item.addEventListener('dragstart', e => { dragSrc = item; item.classList.add('opacity-50'); });
        item.addEventListener('dragend', e => item.classList.remove('opacity-50'));
        item.addEventListener('dragover', e => e.preventDefault());
        item.addEventListener('drop', e => {
            e.preventDefault();
            if (dragSrc !== item) {
                const items = [...el.querySelectorAll('[draggable]')];
                const srcIdx = items.indexOf(dragSrc);
                const dstIdx = items.indexOf(item);
                if (srcIdx < dstIdx) item.after(dragSrc);
                else item.before(dragSrc);
                el.dispatchEvent(new Event('reorder'));
            }
        });
    });
}
</script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\xampp\e-form\resources\views/components/layout.blade.php ENDPATH**/ ?>