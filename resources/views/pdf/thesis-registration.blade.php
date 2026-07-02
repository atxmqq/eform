@extends('pdf._base')

@php
    $stdId   = $student->std_id_std   ?? '';
    $fname   = $student->std_fname_th ?? ($submission->submitter->name ?? '');
    $lname   = $student->std_lname_th ?? '';
    $faculty = $student->std_faculty_th ?? '';
    $major   = $student->std_major_th  ?? '';
    $degree  = $student->std_degree_th ?? '';
    $isMaster = mb_strpos($degree, 'โท') !== false || mb_stripos($degree, 'master') !== false;

    $type          = $fields['type']          ?? '';
    $titleTh       = $fields['title_th']      ?? '';
    $titleEn       = $fields['title_en']      ?? '';
    $advisorName   = $fields['advisor_name']  ?? '';
    $startSemester = $fields['start_semester'] ?? '';
    $isThesis = mb_stripos($type, 'thesis') !== false;

    $advisorApproval = $approvalsByRole['advisor']          ?? null;
    $deanApproval    = $approvalsByRole['grad_dean']        ?? null;
    $officerApproval = $approvalsByRole['graduate_officer'] ?? null;

    $stdIdChars = str_split(str_pad($stdId, 11, ' '));
    $submittedDate = $submission->submitted_at;
@endphp

@section('content')
<div class="form-code">GS-MSU_14</div>

<h1 class="form-title">คำร้องขอลงทะเบียน Thesis/IS (ระดับบัณฑิตศึกษา)</h1>
<h2 class="form-subtitle">Request Form for Registration for Thesis/IS (Graduate Student)</h2>

<div class="student-id-box">
    <span class="student-id-label">เลขประจำตัวนิสิต/ Student ID.</span>
    <table class="id-cells" style="display:inline-table;">
        <tr>@foreach($stdIdChars as $ch)<td>{{ trim($ch) }}</td>@endforeach</tr>
    </table>
</div>

<div class="field-row">
    ข้าพเจ้า <span class="cb"></span> นาย/ Mr.&nbsp;
    <span class="cb"></span> นาง/ Mrs.&nbsp;
    <span class="cb"></span> นางสาว/ Miss
    <span class="underline-value underline-long">{{ $fname }} {{ $lname }}</span>
</div>

<div class="field-row">
    คณะ/ Faculty <span class="underline-value" style="min-width:190px;">{{ $faculty }}</span>
    &nbsp;สาขาวิชา/ Major <span class="underline-value" style="min-width:190px;">{{ $major }}</span>
</div>

<div class="field-row">
    เป็นนิสิตศึกษาอยู่ที่/ study at &nbsp;
    <span class="cb">{!! $isMaster ? '&#10003;' : '' !!}</span> นิสิตระดับปริญญาโท/Master Student &nbsp;
    <span class="cb">{!! !$isMaster ? '&#10003;' : '' !!}</span> นิสิตระดับปริญญาเอก/Ph. D. Student
</div>

<div class="field-row">
    <span class="cb"></span> ระบบในเวลาราชการ/Weekday classes &nbsp;
    <span class="cb"></span> ระบบนอกเวลาราชการ/Weekend classes
</div>

<div class="field-row">
    <span class="cb">&#10003;</span> วิทยาเขตมหาสารคาม/ Mahasarakham Campus &nbsp;
    <span class="cb"></span> วิทยาเขต/ Other Campus <span class="underline-value" style="min-width:120px;"></span>
</div>

<div class="field-row" style="margin-top:6px;">
    <strong>มีความประสงค์ขอลงทะเบียน/ would like to register</strong>&nbsp;
    <span class="cb">{!! $isThesis ? '&#10003;' : '' !!}</span> Thesis &nbsp;
    <span class="cb">{!! !$isThesis ? '&#10003;' : '' !!}</span> IS
</div>

<div class="field-row">
    กลุ่ม/ Group <span class="underline-value" style="min-width:340px;">{{ $titleTh }}</span>
</div>

@if($titleEn)
<div class="field-row" style="padding-left:20px; font-size:11px; color:#444;">({{ $titleEn }})</div>
@endif

<div class="field-row">
    รหัสวิชา/ subject code <span class="underline-value" style="min-width:100px;"></span>
    &nbsp; เพิ่มอีก (more) <span class="underline-value" style="min-width:40px;"></span> หน่วยกิต (credits)
</div>

<div class="field-row">
    ประจำ/ for &nbsp;
    ( ) ภาคต้น 1<sup>st</sup>Semester &nbsp;
    ( ) ภาคปลาย 2<sup>nd</sup> Semester &nbsp;
    ( ) ภาคการศึกษาพิเศษ 3<sup>rd</sup> Semester
</div>

<div class="field-row">
    ปีการศึกษา (in academic year) <span class="underline-value" style="min-width:160px;">{{ $startSemester }}</span>
</div>

<div class="field-row">
    เนื่องจาก/ because <span class="underline-value" style="min-width:330px;"></span>
</div>

{{-- Student Signature --}}
<div style="text-align:right; margin-top:8px;">
    <div class="sig-area">
        @if($studentSigPath)
            <img src="file://{{ $studentSigPath }}" class="sig-img" alt="sig"><br>
        @else
            <div style="height:36px;"></div>
        @endif
        <span style="border-top:1px solid #000; display:inline-block; min-width:220px; text-align:center; font-size:11px;">
            ลงชื่อ/ signature &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ผู้ยื่นคำร้อง/ Applicant
        </span><br>
        <span style="font-size:11px;">({{ $fname }} {{ $lname }})</span>
        &nbsp;&nbsp;<span style="font-size:11px;">{{ $submittedDate?->format('d/m/Y') ?? '....../......./.......' }}</span>
    </div>
</div>

<div class="section-title">ขั้นตอนการลงความเห็น/การอนุมัติ (Comment/Approval)</div>

<table class="approval-table">
    <tr>
        <td style="width:50%; vertical-align:top;">
            <div><strong>(1) ความเห็นอาจารย์ที่ปรึกษา/ประธานควบคุมบทนิพนธ์</strong></div>
            <div style="font-size:11px;">(Advisor/Chairman of Thesis)</div>
            <div style="min-height:28px; border-bottom:1px solid #ccc; margin:3px 0; font-size:12px;">{{ $advisorApproval?->comment ?? '' }}</div>
            <div class="sig-area">
                @if(isset($approverSigs['advisor']) && $approverSigs['advisor'])
                    <img src="file://{{ $approverSigs['advisor'] }}" class="sig-img" alt="sig"><br>
                @else
                    <div style="height:30px;"></div>
                @endif
                <span style="border-top:1px solid #000; display:inline-block; min-width:140px; text-align:center; font-size:11px;">
                    ลงชื่อ/ Signature {{ $advisorApproval?->acted_at?->format('(d/m/Y)') ?? '(......./......./.........)' }}
                </span><br>
                <span style="font-size:11px;">({{ $advisorApproval?->approver?->name ?? '..............................' }})</span>
            </div>
        </td>
        <td style="width:50%; vertical-align:top;">
            <div><strong>(2) ความเห็นคณบดีบัณฑิตวิทยาลัย</strong></div>
            <div style="font-size:11px;">(Dean of Graduate School)</div>
            <div style="min-height:28px; border-bottom:1px solid #ccc; margin:3px 0; font-size:12px;">{{ $deanApproval?->comment ?? '' }}</div>
            <div class="approve-check">
                <span class="cb">{!! ($deanApproval?->action === 'approved') ? '&#10003;' : '' !!}</span> อนุมัติ Approved &nbsp;
                <span class="cb">{!! ($deanApproval?->action === 'rejected') ? '&#10003;' : '' !!}</span> ไม่อนุมัติ Disapproved
            </div>
            <div class="sig-area">
                @if(isset($approverSigs['grad_dean']) && $approverSigs['grad_dean'])
                    <img src="file://{{ $approverSigs['grad_dean'] }}" class="sig-img" alt="sig"><br>
                @else
                    <div style="height:30px;"></div>
                @endif
                <span style="border-top:1px solid #000; display:inline-block; min-width:140px; text-align:center; font-size:11px;">
                    ลงชื่อ/ Signature {{ $deanApproval?->acted_at?->format('(d/m/Y)') ?? '(......./......./.........)' }}
                </span><br>
                <span style="font-size:11px;">({{ $deanApproval?->approver?->name ?? '..............................' }})</span>
            </div>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-align:center;">
            <div><strong>เจ้าหน้าที่กองทะเบียนและประมวลผล (The Officer of the Division of Registrar)</strong></div>
            <div style="min-height:20px; border-bottom:1px solid #ccc; margin:3px auto; max-width:260px;"></div>
            <div class="sig-area">
                @if(isset($approverSigs['graduate_officer']) && $approverSigs['graduate_officer'])
                    <img src="file://{{ $approverSigs['graduate_officer'] }}" class="sig-img" alt="sig"><br>
                @else
                    <div style="height:30px;"></div>
                @endif
                <span style="border-top:1px solid #000; display:inline-block; min-width:140px; text-align:center; font-size:11px;">
                    ลงชื่อ/ Signature {{ $officerApproval?->acted_at?->format('(d/m/Y)') ?? '(......./......./.........)' }}
                </span><br>
                <span style="font-size:11px;">({{ $officerApproval?->approver?->name ?? '..............................' }})</span>
            </div>
        </td>
    </tr>
</table>

<div style="text-align:right; font-size:10px; margin-top:6px;">ปรับปรุง ณ กันยายน 2568</div>
@endsection
