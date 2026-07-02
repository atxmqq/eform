<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แจ้งเตือนคำร้อง</title>
    <style>
        body { margin: 0; padding: 0; background: #f4f6f8; font-family: 'Helvetica Neue', Arial, sans-serif; font-size: 14px; color: #374151; }
        .wrapper { max-width: 600px; margin: 32px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
        .header { background: #1d4ed8; padding: 28px 32px; }
        .header h1 { margin: 0; color: #fff; font-size: 20px; font-weight: 700; }
        .header p  { margin: 4px 0 0; color: #bfdbfe; font-size: 13px; }
        .body { padding: 28px 32px; }
        .body p { margin: 0 0 14px; line-height: 1.6; }
        .info-card { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px 20px; margin: 20px 0; }
        .info-card table { width: 100%; border-collapse: collapse; }
        .info-card td { padding: 5px 0; font-size: 13px; }
        .info-card td:first-child { color: #6b7280; width: 45%; }
        .info-card td:last-child { font-weight: 600; color: #111827; }
        .btn { display: inline-block; margin-top: 4px; padding: 12px 24px; background: #1d4ed8; color: #fff !important; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 600; }
        .footer { padding: 20px 32px; background: #f8fafc; border-top: 1px solid #e5e7eb; font-size: 12px; color: #9ca3af; text-align: center; }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <h1>มีคำร้องรอการพิจารณา</h1>
        <p>{{ config('app.name') }}</p>
    </div>
    <div class="body">
        <p>
            เรียน {{ $advisor->prefixname }}{{ $advisor->advisorname }} {{ $advisor->advisorsurname }},
        </p>
        <p>
            นิสิตได้ยื่น<strong>{{ $submission->formType->name }}</strong>
            ผ่านระบบ E-Form และรอการพิจารณาจากท่านในขั้นตอนแรก
        </p>

        <div class="info-card">
            <table>
                <tr>
                    <td>ประเภทคำร้อง</td>
                    <td>{{ $submission->formType->name }}</td>
                </tr>
                <tr>
                    <td>ชื่อนิสิต</td>
                    <td>
                        @php
                            $fname = $student->std_fname_th ?? $student->std_fname_en ?? '';
                            $lname = $student->std_lname_th ?? $student->std_lname_en ?? '';
                        @endphp
                        {{ $fname }} {{ $lname }}
                    </td>
                </tr>
                <tr>
                    <td>รหัสนิสิต</td>
                    <td>{{ $student->std_id_std ?? '-' }}</td>
                </tr>
                <tr>
                    <td>สาขาวิชา</td>
                    <td>{{ $student->std_major_th ?? $student->std_major_en ?? '-' }}</td>
                </tr>
                <tr>
                    <td>วันที่ยื่น</td>
                    <td>{{ $submission->submitted_at?->format('d/m/Y H:i') }}</td>
                </tr>
                <tr>
                    <td>รหัสคำร้อง</td>
                    <td>#{{ $submission->id }}</td>
                </tr>
            </table>
        </div>

        <p>กรุณาเข้าสู่ระบบเพื่อพิจารณาคำร้องดังกล่าว</p>
        <a href="{{ config('app.url') }}/approver" class="btn">เข้าสู่ระบบพิจารณาคำร้อง</a>
    </div>
    <div class="footer">
        อีเมลนี้ส่งโดยอัตโนมัติจากระบบ {{ config('app.name') }} — กรุณาอย่าตอบกลับอีเมลนี้
    </div>
</div>
</body>
</html>
