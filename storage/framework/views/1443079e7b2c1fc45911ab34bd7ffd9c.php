<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    <?php
    $fontPath = str_replace("\\", "/", storage_path('fonts/THSarabunNew.ttf'));
    ?>

    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            /* เรียกใช้ตัวแปรที่เตรียมไว้ */
            src: url('<?php echo e($fontPath); ?>') format('truetype');
        }

        /* บังคับให้ทุกส่วนใช้ฟอนต์นี้ */
        * {
            font-family: 'THSarabunNew', sans-serif !important;
        }

        body {
            font-size: 16pt;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            font-weight: bold;
            font-size: 20pt;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="header">คำร้องคืนสภาพนักศึกษา</div>

    <div class="section">
        <strong>ข้อมูลนิสิต:</strong> <?php echo e($student->std_fname_th ?? ''); ?> <?php echo e($student->std_lname_th ?? ''); ?>

        (รหัสนิสิต: <?php echo e($student->std_id_std ?? '-'); ?>)
    </div>

    <div class="section">
        <strong>สาเหตุที่พ้นสภาพ:</strong>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($fields['loss_reason_type'])): ?>
        <?php echo e($fields['loss_reason_type'] === 'not_paid' ? 'ไม่ชำระเงินรักษาสภาพ (' . ($fields['missed_semesters_count'] ?? '') . ' ภาคเรียน, คือภาคเรียนที่ ' . ($fields['missed_semester_details'] ?? '') . ')' : 'ไม่ได้ลงทะเบียนเรียนตามกำหนด'); ?>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <div class="section">
        <strong>ความประสงค์ขอคืนสภาพ:</strong> ภาค <?php echo e($fields['retain_status_semester'] ?? '-'); ?> / ปีการศึกษา <?php echo e($fields['retain_status_year'] ?? '-'); ?>

    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($fields['leave_from_semester'])): ?>
    <div class="section">
        <strong>ลาพักการเรียน:</strong> ภาค <?php echo e($fields['leave_from_semester'] ?? '-'); ?>/<?php echo e($fields['leave_from_year'] ?? '-'); ?> ถึง ภาค <?php echo e($fields['leave_to_semester'] ?? '-'); ?>/<?php echo e($fields['leave_to_year'] ?? '-'); ?>

    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</body>

</html><?php /**PATH C:\xampp\htdocs\xampp\e-form\resources\views/pdf/reinstatement.blade.php ENDPATH**/ ?>