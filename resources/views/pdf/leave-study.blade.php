@extends('pdf._base')

@php
    $stdId   = $student->std_id_std   ?? '';
    $fname   = $student->std_fname_th ?? ($submission->submitter->name ?? '');
    $lname   = $student->std_lname_th ?? '';
    $faculty = $student->std_faculty_th ?? '';
    $major   = $student->std_major_th  ?? '';
    $degree  = $student->std_degree_th ?? '';
    $isMaster = mb_strpos($degree, 'โท') !== false || mb_stripos($degree, 'master') !== false;

    $semester         = $fields['semester']           ?? '';
    $semesterTerm     = $fields['semester_term']      ?? '';
    $reason           = $fields['reason']             ?? '';
    $thesisFinished   = $fields['thesis_finished']    ?? '';
    $thesisInProgress = $fields['thesis_in_progress'] ?? '';
    $thesisNotStarted = $fields['thesis_not_started'] ?? '';

    $advisorApproval  = $approvalsByRole['advisor']          ?? null;
    $officerApproval  = $approvalsByRole['graduate_officer'] ?? null;
    $deanApproval     = $approvalsByRole['grad_dean']        ?? null;

    $stdIdChars = str_split(str_pad($stdId, 11, ' '));
    $submittedDate = $submission->submitted_at;


@endphp

@section('content')
<div class="form-code">GS-MSU_03</div>

<h1 class="form-title">คำร้องขอลาพักการเรียน (ระดับบัณฑิตศึกษา)</h1>
<h2 class="form-subtitle">Request Form for Taking a Leave (Graduate Student)</h2>

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

<div class="field-row">
    ข้าพเจ้า
    <span class="cb"></span> นาย/ Mr.&nbsp;
    <span class="cb"></span> นาง/ Mrs.&nbsp;
    <span class="cb"></span> นางสาว/ Miss
    <span class="underline-long underline-value">{{ $fname }} {{ $lname }}</span>
</div>

<div class="field-row">
    คณะ/ Faculty
    <span class="underline-value" style="min-width:200px;">{{ $faculty }}</span>
    &nbsp;&nbsp;สาขาวิชา/ Major
    <span class="underline-value" style="min-width:180px;">{{ $major }}</span>
</div>

<div class="field-row">
    เป็นนิสิตศึกษาอยู่ที่/ study at &nbsp;
    <span class="cb">{!! $isMaster ? '&#10003;' : '' !!}</span> นิสิตระดับปริญญาโท/Master Student &nbsp;&nbsp;
    <span class="cb">{!! !$isMaster ? '&#10003;' : '' !!}</span> นิสิตระดับปริญญาเอก/Ph. D. Student
</div>

<div class="field-row">
    <span class="cb"></span> ระบบในเวลาราชการ/Weekday classes &nbsp;&nbsp;
    <span class="cb"></span> ระบบนอกเวลาราชการ/Weekend classes
</div>

<div class="field-row">
    <span class="cb">✓</span> วิทยาเขตมหาสารคาม/ Mahasarakham Campus &nbsp;&nbsp;
    <span class="cb"></span> วิทยาเขต/ Other Campus (Please specify)
    <span class="underline-value" style="min-width:140px;"></span>
</div>

<div style="margin-top:8px;">
    <div class="field-row"><strong>มีความประสงค์ขอลาพักการเรียน/ Would like to take a leave in:</strong></div>
    <div class="field-row">
        <span class="cb">{!! $semesterTerm === 'ภาคต้น' ? '&#10003;' : '' !!}</span> ภาคต้น/ 1<sup>st</sup> semester &nbsp;
        <span class="cb">{!! $semesterTerm === 'ภาคปลาย' ? '&#10003;' : '' !!}</span> ภาคปลาย/ 2<sup>nd</sup> semester &nbsp;
        <span class="cb">{!! $semesterTerm === 'ภาคการศึกษาพิเศษ' ? '&#10003;' : '' !!}</span> ภาคการศึกษาพิเศษ/ 3<sup>rd</sup> semester &nbsp;
        ปีการศึกษา/ Academic year <span class="underline-value" style="min-width:60px;">{{ $semester }}</span>
    </div>
    <div class="field-row">
        เนื่องจาก/ because
        <span class="underline-value" style="min-width:350px;">{{ $reason }}</span>
    </div>
</div>

<div style="margin-top:6px;">
    <div class="field-row">
        <strong>กรณีได้อนุมัติให้ทำวิทยานิพนธ์/การศึกษาค้นคว้าอิสระ/ Getting the approval to do thesis/independent study</strong>
    </div>
    <div class="checkbox-row"><span class="cb">{!! $thesisFinished   ? '&#10003;' : '' !!}</span> งานที่ทำแล้วเสร็จ/ The finished assignment: <span class="underline-value" style="min-width:300px;">{{ $thesisFinished }}</span></div>
    <div class="checkbox-row"><span class="cb">{!! $thesisInProgress ? '&#10003;' : '' !!}</span> งานที่กำลังทำ/ The unfinished assignment: <span class="underline-value" style="min-width:295px;">{{ $thesisInProgress }}</span></div>
    <div class="checkbox-row"><span class="cb">{!! $thesisNotStarted ? '&#10003;' : '' !!}</span> งานที่ยังไม่ทำ/ The unstarting assignment: <span class="underline-value" style="min-width:290px;">{{ $thesisNotStarted }}</span></div>
</div>

{{-- Student Signature --}}
<div style="text-align:right; margin-top:10px;">
    <div class="sig-area">
        @if($studentSigPath)
            <img src="file://{{ $studentSigPath }}" class="sig-img" alt="sig"><br>
        @else
            <div style="height:40px;"></div>
        @endif
        <span style="border-top:1px solid #000; display:inline-block; min-width:220px; text-align:center; font-size:12px;">
            ลงชื่อ/ Signature &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ผู้ยื่นคำร้อง/ Applicant
        </span><br>
        <span style="font-size:11px;">({{ $fname }} {{ $lname }})</span>
        &nbsp;&nbsp;
        <span style="font-size:11px;">{{ $submittedDate?->format('d/m/Y') ?? '....../......./.......' }}</span>
    </div>
</div>

{{-- Approval Section --}}
<div class="section-title">ขั้นตอนการลงความเห็น/การอนุมัติ Comment/Approval</div>

<table class="approval-table">
    <tr>
        {{-- Advisor --}}
        <td style="width:50%; vertical-align:top;">
            <div><strong>① ความเห็นอาจารย์ที่ปรึกษา/ประธานควบคุมวิทยานิพนธ์</strong></div>
            <div style="font-size:11px;">(Advisor/Chairman of the thesis)</div>
            <div style="min-height:32px; border-bottom:1px solid #ccc; margin:4px 0; font-size:12px; padding-bottom:3px;">
                {{ $advisorApproval?->comment ?? '' }}
            </div>
            <div class="sig-area">
                @if(isset($approverSigs['advisor']) && $approverSigs['advisor'])
                    <img src="file://{{ $approverSigs['advisor'] }}" class="sig-img" alt="sig"><br>
                @else
                    <div style="height:34px;"></div>
                @endif
                <span style="border-top:1px solid #000; display:inline-block; min-width:150px; text-align:center; font-size:11px;">
                    ลงชื่อ/ Signature {{ $advisorApproval?->acted_at?->format('(d/m/Y)') ?? '(......./......../.........)' }}
                </span><br>
                <span style="font-size:11px;">({{ $advisorApproval?->approver?->name ?? '..............................' }})</span>
            </div>
        </td>

        {{-- Dean of Graduate School --}}
        <td style="width:50%; vertical-align:top;">
            <div><strong>② ความเห็นคณบดีบัณฑิตวิทยาลัย (Dean of Graduate school)</strong></div>
            <div style="min-height:32px; border-bottom:1px solid #ccc; margin:4px 0; font-size:12px; padding-bottom:3px;">
                {{ $deanApproval?->comment ?? '' }}
            </div>
            <div class="approve-check">
                <span class="cb">{!! ($deanApproval?->action === 'approved') ? '&#10003;' : '' !!}</span> อนุมัติ/ Approve
                &nbsp;&nbsp;
                <span class="cb">{!! ($deanApproval?->action === 'rejected') ? '&#10003;' : '' !!}</span> ไม่อนุมัติ/ Disapprove
            </div>
            <div class="sig-area">
                @if(isset($approverSigs['grad_dean']) && $approverSigs['grad_dean'])
                    <img src="file://{{ $approverSigs['grad_dean'] }}" class="sig-img" alt="sig"><br>
                @else
                    <div style="height:34px;"></div>
                @endif
                <span style="border-top:1px solid #000; display:inline-block; min-width:150px; text-align:center; font-size:11px;">
                    ลงชื่อ/ Signature {{ $deanApproval?->acted_at?->format('(d/m/Y)') ?? '(......./......../.........)' }}
                </span><br>
                <span style="font-size:11px;">({{ $deanApproval?->approver?->name ?? '..............................' }})</span>
            </div>
        </td>
    </tr>
    <tr>
        {{-- Officer --}}
        <td colspan="2" style="text-align:center;">
            <div><strong>③ เจ้าหน้าที่กองทะเบียนและประมวลผล</strong></div>
            <div style="font-size:11px;">(The Officer of the Division of Registrar)</div>
            <div class="sig-area" style="margin-top:4px;">
                @if(isset($approverSigs['graduate_officer']) && $approverSigs['graduate_officer'])
                    <img src="file://{{ $approverSigs['graduate_officer'] }}" class="sig-img" alt="sig"><br>
                @else
                    <div style="height:34px;"></div>
                @endif
                <span style="border-top:1px solid #000; display:inline-block; min-width:150px; text-align:center; font-size:11px;">
                    ลงชื่อ/ Signature {{ $officerApproval?->acted_at?->format('(d/m/Y)') ?? '(......./......../.........)' }}
                </span><br>
                <span style="font-size:11px;">({{ $officerApproval?->approver?->name ?? '..............................' }})</span>
            </div>
        </td>
    </tr>
</table>

<div style="text-align:right; font-size:10px; margin-top:8px;">ปรับปรุง ณ วันที่ 1 สิงหาคม 2562</div>
@endsection
