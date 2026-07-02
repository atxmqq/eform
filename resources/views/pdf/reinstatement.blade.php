<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    
    @php
    $fontPath = str_replace("\\", "/", storage_path('fonts/THSarabunNew.ttf'));
    @endphp

    <style>
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            /* เรียกใช้ตัวแปรที่เตรียมไว้ */
            src: url('{{ $fontPath }}') format('truetype');
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
        <strong>ข้อมูลนิสิต:</strong> {{ $student->std_fname_th ?? '' }} {{ $student->std_lname_th ?? '' }}
        (รหัสนิสิต: {{ $student->std_id_std ?? '-' }})
    </div>

    <div class="section">
        <strong>สาเหตุที่พ้นสภาพ:</strong>
        @if(isset($fields['loss_reason_type']))
        {{ $fields['loss_reason_type'] === 'not_paid' ? 'ไม่ชำระเงินรักษาสภาพ (' . ($fields['missed_semesters_count'] ?? '') . ' ภาคเรียน, คือภาคเรียนที่ ' . ($fields['missed_semester_details'] ?? '') . ')' : 'ไม่ได้ลงทะเบียนเรียนตามกำหนด' }}
        @endif
    </div>

    <div class="section">
        <strong>ความประสงค์ขอคืนสภาพ:</strong> ภาค {{ $fields['retain_status_semester'] ?? '-' }} / ปีการศึกษา {{ $fields['retain_status_year'] ?? '-' }}
    </div>

    @if(isset($fields['leave_from_semester']))
    <div class="section">
        <strong>ลาพักการเรียน:</strong> ภาค {{ $fields['leave_from_semester'] ?? '-' }}/{{ $fields['leave_from_year'] ?? '-' }} ถึง ภาค {{ $fields['leave_to_semester'] ?? '-' }}/{{ $fields['leave_to_year'] ?? '-' }}
    </div>
    @endif
</body>

</html>