<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<style>
@font-face {
    font-family: 'Tahoma';
    src: url("file://{{ storage_path('fonts/Tahoma.ttf') }}") format('truetype');
    font-weight: normal;
    font-style: normal;
}
@font-face {
    font-family: 'Tahoma';
    src: url("file://{{ storage_path('fonts/Tahoma_Bold.ttf') }}") format('truetype');
    font-weight: bold;
    font-style: normal;
}

* { margin: 0; padding: 0; box-sizing: border-box; }

body {
    font-family: 'Tahoma', sans-serif;
    font-size: 13px;
    color: #000;
    padding: 14px 24px;
    line-height: 1.4;
}

h1.form-title {
    text-align: center;
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 1px;
}
h2.form-subtitle {
    text-align: center;
    font-size: 12px;
    font-weight: normal;
    margin-bottom: 8px;
}
.form-code {
    text-align: right;
    font-size: 12px;
    margin-bottom: 4px;
}

.student-id-box {
    text-align: center;
    margin-bottom: 10px;
}
.student-id-label {
    font-size: 13px;
    display: inline;
}
.id-cells {
    display: inline-block;
    border: 1px solid #000;
    margin-left: 6px;
}
.id-cells td {
    width: 20px;
    height: 20px;
    border: 1px solid #000;
    text-align: center;
    font-size: 13px;
    padding: 0;
}

.field-row {
    margin-bottom: 4px;
    font-size: 13px;
}
.field-row .label {
    display: inline;
}
.underline-value {
    display: inline-block;
    border-bottom: 1px solid #000;
    min-width: 120px;
    font-size: 13px;
    padding: 0 4px;
    vertical-align: bottom;
}
.underline-long {
    min-width: 300px;
}
.underline-xl {
    min-width: 400px;
}
.underline-full {
    width: 100%;
    display: block;
    border-bottom: 1px solid #000;
    min-height: 18px;
    margin-top: 2px;
    font-size: 13px;
    padding: 0 4px;
}

.checkbox-row {
    font-size: 13px;
    margin-bottom: 4px;
}
.cb {
    display: inline-block;
    width: 13px;
    height: 13px;
    border: 1px solid #000;
    text-align: center;
    vertical-align: middle;
    font-size: 10px;
    line-height: 13px;
    margin-right: 3px;
}
.cb.checked::after { content: '✓'; }

.section-title {
    text-align: center;
    font-size: 13px;
    font-weight: bold;
    text-decoration: underline;
    margin: 10px 0 6px 0;
}

.approval-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 8px;
}
.approval-table td {
    border: 1px solid #000;
    padding: 6px 8px;
    vertical-align: top;
    font-size: 12px;
}
.approval-table td.no-border {
    border: none;
}

.sig-area {
    margin-top: 10px;
    text-align: center;
    font-size: 13px;
}
.sig-img {
    height: 45px;
    max-width: 160px;
}
.sig-name {
    border-top: 1px solid #000;
    display: inline-block;
    min-width: 160px;
    text-align: center;
    padding-top: 2px;
    font-size: 12px;
    margin-top: 4px;
}
.sig-date {
    font-size: 12px;
}

.logo-row {
    display: flex;
    align-items: center;
    margin-bottom: 4px;
}

.approve-check {
    font-size: 13px;
    margin: 4px 0;
}
</style>
</head>
<body>
@yield('content')
</body>
</html>
