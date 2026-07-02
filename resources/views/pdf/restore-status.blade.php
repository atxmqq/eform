@extends('pdf._base')

@php
    $stdId   = $student->std_id_std   ?? '';
    $fname   = $student->std_fname_th ?? ($submission->submitter->name ?? '');
    $lname   = $student->std_lname_th ?? '';
    $faculty = $student->std_faculty_th ?? '';
    $major   = $student->std_major_th  ?? '';
    $degree  = $student->std_degree_th ?? '';
    $isMaster = mb_strpos($degree, 'โท') !== false || mb_stripos($degree, 'master') !== false;


    $leaveReason   = $fields['leave_reason']   ?? '';
    $restoreReason = $fields['restore_reason'] ?? '';
    $semester      = $fields['semester']       ?? '';

    $chk  = '&#10003;';
    $unch = '';

    $advisorApproval  = $approvalsByRole['advisor']          ?? null;
    $officerApproval  = $approvalsByRole['graduate_officer'] ?? null;
    $viceDeanApproval = $approvalsByRole['grad_vice_dean']   ?? null;
    $deanApproval     = $approvalsByRole['grad_dean']        ?? null;

    $submittedDate = $submission->submitted_at;
    $stdIdChars = str_split(str_pad($stdId, 11, ' '));
@endphp

@section('content')
<div class="form-code">GS-MSU_06</div>

<h1 class="form-title">คำร้องขอคืนสภาพการเป็นนิสิต (ระดับบัณฑิตศึกษา)</h1>
<h2 class="form-subtitle">Request Form for Retaining Student Status (Graduate Student)</h2>

<div class="student-id-box">
    <span class="student-id-label">เลขประจำตัวนิสิต/ Student ID.</span>
    <table class="id-cells" style="display:inline-table;">
        <tr>
            @foreach($stdIdChars as $ch)
            <td>{{ trim($ch) }}</td>
            @endforeach
        </tr>
    </table>
</div>

<div class="field-row" style="margin-top:8px;">
    <span class="label">ข้าพเจ้า </span>
    <span class="cb"></span> นาย/ Mr.&nbsp;
    <span class="cb"></span> นาง/ Mrs.&nbsp;
    <span class="cb"></span> นางสาว/ Miss
    <span class="underline-long underline-value">{{ $fname }} {{ $lname }}</span>
</div>

<div class="field-row">
    <span class="label">คณะ/ Faculty</span>
    <span class="underline-value" style="min-width:200px;">{{ $faculty }}</span>
    &nbsp;&nbsp;<span class="label">สาขาวิชา/ Major</span>
    <span class="underline-value" style="min-width:200px;">{{ $major }}</span>
</div>

<div class="field-row">
    เป็นนิสิตศึกษาอยู่ที่/ study at &nbsp;
    <span class="cb">&#10003;</span> วิทยาเขตมหาสารคาม/ MahasaraKham Campus &nbsp;&nbsp;
    <span class="cb"></span> วิทยาเขต/ Other Campus (Please specify)
    <span class="underline-value" style="min-width:100px;"></span>
</div>

<div class="field-row">
    <span class="cb">{!! $isMaster ? '&#10003;' : '' !!}</span>
    นิสิตระดับปริญญาโท/Master Student &nbsp;
    <span class="cb"></span> ระบบในเวลาราชการ/Weekday &nbsp;
    <span class="cb"></span> ระบบนอกเวลาราชการ/Weekend
</div>
<div class="field-row">
    <span class="cb">{!! !$isMaster ? '&#10003;' : '' !!}</span>
    นิสิตระดับปริญญาเอก/Ph. D. Student &nbsp;
    <span class="cb"></span> ระบบในเวลาราชการ/Weekday &nbsp;
    <span class="cb"></span> ระบบนอกเวลาราชการ/Weekend
</div>

<div style="margin-top:8px;">
    <div class="field-row"><strong>พ้นสภาพการเป็นนิสิต เนื่องจาก: Student status is canceled because:</strong></div>
    <div class="checkbox-row">
        &nbsp; ( ) ไม่ชำระเงินเพื่อรักษาสภาพการเป็นนิสิต จำนวน <span class="underline-value" style="min-width:40px;"></span> ภาคเรียน คือภาคเรียนที่
        <span class="underline-value" style="min-width:140px;"></span>
    </div>
    <div class="checkbox-row">
        &nbsp; ( ) ไม่ได้ลงทะเบียนเรียนโดยสมบูรณ์ ภายในเวลาที่มหาวิทยาลัยกำหนด
    </div>
    @if($leaveReason)
    <div style="padding-left:14px; font-size:12px; color:#333;">({{ $leaveReason }})</div>
    @endif
</div>

<div style="margin-top:8px;">
    <div class="field-row"><strong>มีความประสงค์จะขอคืนสภาพการเป็นนิสิต ตั้งแต่: Would like to retain student status from:</strong></div>
    <div class="checkbox-row">
        &nbsp; <span class="cb"></span> ภาคต้น/ 1<sup>st</sup> semester &nbsp;&nbsp;
        <span class="cb"></span> ภาคปลาย/ 2<sup>nd</sup> semester &nbsp;&nbsp;
        ปีการศึกษา/ Academic Year <span class="underline-value" style="min-width:60px;">{{ $semester }}</span>
    </div>
</div>

@if($restoreReason)
<div style="margin-top:6px; font-size:13px; border:1px solid #ccc; padding:6px; border-radius:3px;">
    <strong>เหตุผลที่ต้องการคืนสภาพ:</strong> {{ $restoreReason }}
</div>
@endif

{{-- Student Signature --}}
<div style="text-align:right; margin-top:14px;">
    <div class="sig-area">
        @if($studentSigPath)
            <img src="file://{{ $studentSigPath }}" class="sig-img" alt="sig"><br>
        @else
            <div style="height:45px;"></div>
        @endif
        <span style="border-top:1px solid #000; display:inline-block; min-width:220px; text-align:center; font-size:13px;">
            ลงชื่อ/ Signature &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ผู้ยื่นคำร้อง/Applicant
        </span><br>
        <span style="font-size:12px;">({{ $fname }} {{ $lname }})</span>
        &nbsp;&nbsp;
        <span style="font-size:12px;">{{ $submittedDate?->format('d/m/Y') ?? '....../......./.......' }}</span>
    </div>
</div>

{{-- Approval Table --}}
<table class="approval-table" style="margin-top:10px;">
    <tr>
        {{-- Advisor --}}
        <td style="width:50%; vertical-align:top;">
            <div><strong>❶ กรรมการควบคุมวิทยานิพนธ์/อาจารย์ที่ปรึกษา</strong></div>
            <div style="font-size:12px;">(Advisor/Chairman of the thesis)</div>
            <div style="min-height:36px; border-bottom:1px solid #ccc; margin:4px 0; font-size:13px;">
                {{ $advisorApproval?->comment ?? '' }}
            </div>
            <div class="sig-area">
                @if(isset($approverSigs['advisor']) && $approverSigs['advisor'])
                    <img src="file://{{ $approverSigs['advisor'] }}" class="sig-img" alt="sig"><br>
                @else
                    <div style="height:36px;"></div>
                @endif
                <span style="border-top:1px solid #000; display:inline-block; min-width:140px; text-align:center; font-size:12px;">
                    ลงชื่อ/Signature {{ $advisorApproval?->acted_at?->format('(d/m/Y)') ?? '(......./......../.........)' }}
                </span><br>
                <span style="font-size:12px;">({{ $advisorApproval?->approver?->name ?? '..............................' }})</span>
            </div>
        </td>

        {{-- Dean Graduate --}}
        <td style="width:50%; vertical-align:top;">
            <div><strong>❷ คณบดีบัณฑิตวิทยาลัย (Dean of Graduate School)</strong></div>
            <div style="min-height:36px; border-bottom:1px solid #ccc; margin:4px 0; font-size:13px;">
                {{ $deanApproval?->comment ?? '' }}
            </div>
            <div class="sig-area">
                @if(isset($approverSigs['grad_dean']) && $approverSigs['grad_dean'])
                    <img src="file://{{ $approverSigs['grad_dean'] }}" class="sig-img" alt="sig"><br>
                @else
                    <div style="height:36px;"></div>
                @endif
                <span style="border-top:1px solid #000; display:inline-block; min-width:140px; text-align:center; font-size:12px;">
                    ลงชื่อ/Signature {{ $deanApproval?->acted_at?->format('(d/m/Y)') ?? '(......./......../.........)' }}
                </span><br>
                <span style="font-size:12px;">({{ $deanApproval?->approver?->name ?? '..............................' }})</span>
            </div>
        </td>
    </tr>
    <tr>
        {{-- Registrar --}}
        <td colspan="2" style="vertical-align:top;">
            <div><strong>❸ นายทะเบียน (The Registrar)</strong></div>
            <div style="font-size:13px; margin-top:4px;">
                <span class="cb"></span> ตามข้อบังคับฯ ข้อ <span class="underline-value" style="min-width:50px;"></span> สามารถคืนสภาพได้ &nbsp;&nbsp;
                <span class="cb"></span> มีหนี้ค้างที่ต้องชำระเป็นเงิน <span class="underline-value" style="min-width:60px;"></span> บาท &nbsp;&nbsp;
                <span class="cb"></span> ไม่มีหนี้ค้าง
            </div>
            <div class="sig-area" style="margin-top:6px;">
                <span style="border-top:1px solid #000; display:inline-block; min-width:160px; text-align:center; font-size:12px;">
                    ลงชื่อ/ Signature <span style="font-size:11px;">(......./......../..........)</span>
                </span>
            </div>
        </td>
    </tr>
    <tr>
        {{-- President Approval --}}
        <td style="width:50%; vertical-align:top;">
            <div><strong>❹ เสนออธิการบดี เพื่อโปรดสั่งการ</strong></div>
            <div style="font-size:12px;">(President for Approval)</div>
            <div class="approve-check" style="margin-top:6px;">
                <span class="cb">{{ ($deanApproval?->action === 'approved') ? $chk : $unch }}</span> อนุมัติ/ Approve &nbsp;&nbsp;
                <span class="cb">{{ ($deanApproval?->action === 'rejected') ? $chk : $unch }}</span> ไม่อนุมัติ/Disapprove
            </div>
            <div class="sig-area">
                <div style="height:36px;"></div>
                <span style="border-top:1px solid #000; display:inline-block; min-width:140px; text-align:center; font-size:12px;">
                    ลงชื่อ/Signature (......./......../.........)
                </span>
            </div>
        </td>

        {{-- Graduate School Registration Officer --}}
        <td style="width:50%; vertical-align:top;">
            <div><strong>❺ เจ้าหน้าที่ทะเบียนบัณฑิตวิทยาลัย</strong></div>
            <div style="font-size:12px;">(Graduate School Registration Officer)</div>
            <div class="sig-area" style="margin-top:6px;">
                @if(isset($approverSigs['graduate_officer']) && $approverSigs['graduate_officer'])
                    <img src="file://{{ $approverSigs['graduate_officer'] }}" class="sig-img" alt="sig"><br>
                @else
                    <div style="height:36px;"></div>
                @endif
                <span style="border-top:1px solid #000; display:inline-block; min-width:140px; text-align:center; font-size:12px;">
                    ลงชื่อ/Signature ผู้บันทึกข้อมูล (Recorder)<br>
                    {{ $officerApproval?->acted_at?->format('(d/m/Y)') ?? '(......./......../.........)' }}
                </span>
            </div>
        </td>
    </tr>
</table>

<div style="text-align:right; font-size:11px; margin-top:16px;">ปรับปรุง ณ วันที่ 15 กุมภาพันธ์ 2564</div>
@endsection
