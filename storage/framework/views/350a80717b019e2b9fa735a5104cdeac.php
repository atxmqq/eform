<?php
$colors = [
    'gray'   => 'bg-gray-100 text-gray-600',
    'yellow' => 'bg-yellow-100 text-yellow-700',
    'green'  => 'bg-green-100 text-green-700',
    'red'    => 'bg-red-100 text-red-700',
    'orange' => 'bg-orange-100 text-orange-700',
];
$colorClass = $colors[\App\Models\FormSubmission::STATUSES[$status]['color'] ?? 'gray'] ?? $colors['gray'];
?>
<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo e($colorClass); ?>">
    <?php echo e($label); ?>

</span>
<?php /**PATH C:\xampp\htdocs\xampp\e-form\resources\views/components/status-badge.blade.php ENDPATH**/ ?>