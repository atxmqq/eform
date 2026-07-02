@extends('pdf._base')

@php
    $stdId   = $student->std_id_std   ?? '';
    $fname   = $student->std_fname_th ?? ($submission->submitter->name ?? '');
    $lname   = $student->std_lname_th ?? '';
    $faculty = $student->std_faculty_th ?? '';
    $major   = $student->std_major_th  ?? '';

    $reason      = $fields['reason']       ?? '';
    $semester    = $fields['semester']     ?? '';
    $passedCase  = (int) ($fields['restore_case'] ?? 0);

    $chkY = function(int $c, int $q) use ($fields) {
        return ($fields["condition_{$c}_{$q}"] ?? '') === 'yes' ? '&#10003;' : '';
    };
    $chkN = function(int $c, int $q) use ($fields) {
        $v = $fields["condition_{$c}_{$q}"] ?? '';
        return ($v !== '' && $v !== 'yes') ? '&#10003;' : '';
    };

    $advisorApproval  = $approvalsByRole['advisor']          ?? null;
    $chairApproval    = $approvalsByRole['program_chair']    ?? null;
    $deanFacApproval  = $approvalsByRole['faculty_dean']     ?? null;
    $officerApproval  = $approvalsByRole['graduate_officer'] ?? null;
    $viceDeanApproval = $approvalsByRole['grad_vice_dean']   ?? null;
    $deanApproval     = $approvalsByRole['grad_dean']        ?? null;

    $submittedDate = $submission->submitted_at;
    $stdIdChars = str_split(str_pad($stdId, 11, ' '));
@endphp

@section('content')
<div class="form-code">ทบ.มมส/โท-เอก 13</div>

<h1 class="form-title">คำร้องขอลงทะเบียนรักษาสภาพ (กรณีพิเศษ)</h1>
<h2 class="form-subtitle">(ผ่านการตรวจสอบข้อมูลเบื้องต้นจากบัณฑิตวิทยาลัย)</h2>

<div style="margin-top:12px;">
    <div class="field-row">
        ชื่อ <span class="underline-value" style="min-width:180px;">{{ $fname }}</span>
        &nbsp; นามสกุล <span class="underline-value" style="min-width:180px;">{{ $lname }}</span>
    </div>
    <div class="field-row">
        เลขประจำตัวนิสิต <span class="underline-value" style="min-width:120px;">{{ $stdId }}</span>
        &nbsp; สาขาวิชา <span class="underline-value" style="min-width:140px;">{{ $major }}</span>
        &nbsp; คณะ <span class="underline-value" style="min-width:130px;">{{ $faculty }}</span>
    </div>
    <div class="field-row">
        ศูนย์การศึกษา &nbsp;
        <span class="cb">&#10003;</span> มหาสารคาม &nbsp;&nbsp;
        <span class="cb">&#9744;</span> อื่นๆ <span class="underline-value" style="min-width:200px;"></span>
    </div>
    <div class="field-row">
        ภาคเรียนที่ <span class="underline-value" style="min-width:100px;">{{ $semester }}</span>
        &nbsp; ปีการศึกษา <span class="underline-value" style="min-width:120px;"></span>
    </div>
</div>

{{-- เหตุผล --}}
@if($reason)
<div style="margin-top:8px; border:1px solid #999; padding:8px; border-radius:4px; font-size:13px;">
    <strong>เหตุผลที่ขอรักษาสภาพ:</strong> {{ $reason }}
</div>
@endif

<hr style="margin:10px 0;">

{{-- กรณีที่ 1 --}}
<div style="font-weight:bold; font-size:13px; margin-top:8px;">กรณีที่ 1 (ถ้าตอบใช่ทั้ง 3 ข้อ ลงทะเบียนกรณีพิเศษได้)</div>
<table style="width:100%; font-size:13px;">
    <tr><td style="padding:2px 0;">1. ข้าพเจ้าเรียนรายวิชาต่าง ๆ ครบแล้ว</td><td style="width:90px; white-space:nowrap;"><span class="cb">{!! $chkY(1,1) !!}</span> ใช่ &nbsp;<span class="cb">{!! $chkN(1,1) !!}</span> ไม่ใช่</td></tr>
    <tr><td style="padding:2px 0;">2. ข้าพเจ้าส่งวิทยานิพนธ์/การศึกษาค้นคว้าอิสระ 9 เล่ม ให้งานบริหารบัณฑิตศึกษาแล้ว</td><td style="white-space:nowrap;"><span class="cb">{!! $chkY(1,2) !!}</span> ใช่ &nbsp;<span class="cb">{!! $chkN(1,2) !!}</span> ไม่ใช่</td></tr>
    <tr><td style="padding:2px 0;">3. ข้าพเจ้ายังสอบประมวลความรู้<strong>ไม่ผ่าน</strong> หรือยังไม่ได้สอบประมวลความรู้</td><td style="white-space:nowrap;"><span class="cb">{!! $chkY(1,3) !!}</span> ใช่ &nbsp;<span class="cb">{!! $chkN(1,3) !!}</span> ไม่ใช่</td></tr>
</table>

<div style="font-weight:bold; font-size:13px; margin-top:8px;">กรณีที่ 2 (ไม่ใช่ลงทะเบียนกรณีพิเศษ)</div>
<table style="width:100%; font-size:13px;">
    <tr><td style="padding:2px 0;">1. ข้าพเจ้าเรียนรายวิชาต่าง ๆ ครบแล้ว</td><td style="width:90px; white-space:nowrap;"><span class="cb">{!! $chkY(2,1) !!}</span> ใช่ &nbsp;<span class="cb">{!! $chkN(2,1) !!}</span> ไม่ใช่</td></tr>
    <tr><td style="padding:2px 0;">2. ข้าพเจ้าลงหน่วยกิตวิทยานิพนธ์ครบ 12 หน่วยกิต หรือการศึกษาค้นคว้าอิสระครบ 6 หน่วยกิตแล้ว</td><td style="white-space:nowrap;"><span class="cb">{!! $chkY(2,2) !!}</span> ใช่ &nbsp;<span class="cb">{!! $chkN(2,2) !!}</span> ไม่ใช่</td></tr>
    <tr><td style="padding:2px 0;">3. ข้าพเจ้า<strong>ไม่สามารถสอบปากเปล่า</strong> หรือสอบรายงานการศึกษาค้นคว้าอิสระได้ทันในภาคเรียนที่แล้ว</td><td style="white-space:nowrap;"><span class="cb">{!! $chkY(2,3) !!}</span> ใช่ &nbsp;<span class="cb">{!! $chkN(2,3) !!}</span> ไม่ใช่</td></tr>
</table>

<div style="font-weight:bold; font-size:13px; margin-top:8px;">กรณีที่ 3 (ถ้าตอบใช่ทั้ง 3 ข้อ ลงทะเบียนกรณีพิเศษได้)</div>
<table style="width:100%; font-size:13px;">
    <tr><td style="padding:2px 0;">1. ข้าพเจ้าเรียนรายวิชาต่าง ๆ ครบแล้ว</td><td style="width:90px; white-space:nowrap;"><span class="cb">{!! $chkY(3,1) !!}</span> ใช่ &nbsp;<span class="cb">{!! $chkN(3,1) !!}</span> ไม่ใช่</td></tr>
    <tr><td style="padding:2px 0;">2. ข้าพเจ้าสอบประมวลความรู้แล้ว</td><td style="white-space:nowrap;"><span class="cb">{!! $chkY(3,2) !!}</span> ใช่ &nbsp;<span class="cb">{!! $chkN(3,2) !!}</span> ไม่ใช่</td></tr>
    <tr><td style="padding:2px 0;">3. ข้าพเจ้า<strong>ไม่สามารถส่งวิทยานิพนธ์ 9 เล่ม</strong> หรือการศึกษาค้นคว้าอิสระ 9 เล่ม ให้บัณฑิตวิทยาลัยได้ทันตามเวลาที่กำหนดไว้</td><td style="white-space:nowrap;"><span class="cb">{!! $chkY(3,3) !!}</span> ใช่ &nbsp;<span class="cb">{!! $chkN(3,3) !!}</span> ไม่ใช่</td></tr>
</table>

<div style="font-weight:bold; font-size:13px; margin-top:8px;">กรณีที่ 4 (ถ้าตอบใช่ทั้ง 3 ข้อ ลงทะเบียนกรณีพิเศษได้)</div>
<table style="width:100%; font-size:13px;">
    <tr><td style="padding:2px 0;">1. ข้าพเจ้าเรียนรายวิชาต่าง ๆ ครบแล้ว</td><td style="width:90px; white-space:nowrap;"><span class="cb">{!! $chkY(4,1) !!}</span> ใช่ &nbsp;<span class="cb">{!! $chkN(4,1) !!}</span> ไม่ใช่</td></tr>
    <tr><td style="padding:2px 0;">2. ข้าพเจ้าส่งวิทยานิพนธ์เล่มสมบูรณ์ให้บัณฑิตวิทยาลัยได้ทันตามเวลาที่กำหนดไว้</td><td style="white-space:nowrap;"><span class="cb">{!! $chkY(4,2) !!}</span> ใช่ &nbsp;<span class="cb">{!! $chkN(4,2) !!}</span> ไม่ใช่</td></tr>
    <tr><td style="padding:2px 0;">3. ข้าพเจ้า<strong>รอการตีพิมพ์หรือตอบรับการตีพิมพ์ผลงานวิทยานิพนธ์</strong></td><td style="white-space:nowrap;"><span class="cb">{!! $chkY(4,3) !!}</span> ใช่ &nbsp;<span class="cb">{!! $chkN(4,3) !!}</span> ไม่ใช่</td></tr>
</table>

{{-- Bottom row: student sig + officer summary --}}
<table style="width:100%; margin-top:14px; border-collapse:collapse;">
    <tr>
        <td style="width:55%; border:1px solid #000; padding:8px; vertical-align:top;">
            <div style="font-weight:bold; font-size:13px;">สรุป (สำหรับเจ้าหน้าที่)</div>
            <div style="font-size:13px; margin-top:4px;">1. ค่าธรรมเนียมฯ <span class="underline-value" style="min-width:80px;"></span> บาท</div>
            <div style="font-size:13px;">2. ค่าประกันฯ <span class="underline-value" style="min-width:80px;"></span> บาท</div>
            <div style="font-size:13px;">3. <span class="underline-value" style="min-width:140px;"></span> บาท</div>
            <div style="font-size:13px;">รวมเป็นเงิน <span class="underline-value" style="min-width:80px;"></span> บาท</div>
            <div class="sig-area" style="margin-top:6px;">
                @if(isset($approverSigs['graduate_officer']) && $approverSigs['graduate_officer'])
                    <img src="file://{{ $approverSigs['graduate_officer'] }}" class="sig-img" alt="sig"><br>
                @else
                    <div style="height:40px;"></div>
                @endif
                <span style="border-top:1px solid #000; display:inline-block; min-width:130px; text-align:center; font-size:12px;">ลงชื่อ</span><br>
                <span style="font-size:12px;">({{ $officerApproval?->approver?->name ?? '..............................' }})</span><br>
                <span style="font-size:12px;">วันที่{{ $officerApproval?->acted_at?->format('...d...เดือน...m...พ.ศ.Y') ?? '.......เดือน.........พ.ศ......' }}</span>
            </div>
        </td>
        <td style="width:45%; padding:8px; vertical-align:bottom; text-align:center;">
            <div class="sig-area">
                @if($studentSigPath)
                    <img src="file://{{ $studentSigPath }}" class="sig-img" alt="sig"><br>
                @else
                    <div style="height:45px;"></div>
                @endif
                <span style="border-top:1px solid #000; display:inline-block; min-width:160px; text-align:center; font-size:13px;">
                    ลงชื่อ (นิสิต)
                </span><br>
                <span style="font-size:12px;">({{ $fname }} {{ $lname }})</span><br>
                <span style="font-size:12px;">วันที่ {{ $submittedDate?->format('d') ?? '.......' }} เดือน {{ $submittedDate?->translatedFormat('F') ?? '.................' }} พ.ศ. {{ ($submittedDate ? $submittedDate->year + 543 : '......') }}</span>
            </div>
        </td>
    </tr>
</table>

<div style="text-align:right; font-size:11px; margin-top:16px;">ทบ.มมส/โท-เอก 13</div>
@endsection
