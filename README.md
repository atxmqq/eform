# e-Form บัณฑิตวิทยาลัย มหาวิทยาลัยมหาสารคาม

ระบบแบบฟอร์มอิเล็กทรอนิกส์สำหรับนิสิตและเจ้าหน้าที่บัณฑิตวิทยาลัย

## Tech Stack

- **Backend**: Laravel 12 (PHP)
- **Database**: MySQL / MariaDB
- **Frontend**: Blade + Tailwind CSS
- **Auth**: Google OAuth (และ Microsoft OAuth สำรอง)

## การติดตั้ง

### 1. แตกไฟล์และติดตั้ง dependencies

```bash
composer install
npm install && npm run build
```

### 2. ตั้งค่า Environment

คัดลอกไฟล์ `.env` ที่ได้รับมา วางไว้ที่ root ของโปรเจกต์ แล้วแก้ไขค่าต่อไปนี้:

```env
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eform
DB_USERNAME=ชื่อ user mysql ของคุณ
DB_PASSWORD=รหัสผ่าน mysql ของคุณ
```

### 3. Import ฐานข้อมูล

```bash
mysql -u root -p eform < eform.sql
```

> สร้าง database ชื่อ `eform` ก่อนถ้ายังไม่มี:
> ```sql
> CREATE DATABASE eform CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
> ```

### 4. Generate App Key และ Migrate

```bash
php artisan key:generate
php artisan migrate
php artisan storage:link
```

> ถ้าใช้ไฟล์ SQL ที่ให้มาแล้ว ไม่ต้อง migrate ใหม่ครับ

### 5. รันระบบ

```bash
php artisan serve
```

เปิดเบราว์เซอร์ที่ `http://localhost:8000`

---

## โครงสร้างระบบ

### บทบาทผู้ใช้

| Role | หน้าที่ |
|------|---------|
| **นิสิต (Student)** | กรอกและส่งแบบฟอร์ม |
| **อาจารย์ที่ปรึกษา (Approver)** | อนุมัติ/ปฏิเสธแบบฟอร์ม |
| **Admin** | จัดการระบบ, ดูรายงาน |

### Flow การทำงาน

```
นิสิตกรอกฟอร์ม → ส่งเรื่อง → อาจารย์ที่ปรึกษาอนุมัติ → เจ้าหน้าที่รับเรื่อง
```

### ประเภทฟอร์ม (Form Types)

ดูได้จากตาราง `form_types` ในฐานข้อมูล  
Field ของแต่ละฟอร์มอยู่ในตาราง `form_fields`

---

## Google OAuth

ระบบใช้ Google Login — ต้องตั้งค่า `GOOGLE_CLIENT_ID` และ `GOOGLE_CLIENT_SECRET` ใน `.env`  
ถ้าทดสอบ local ให้เพิ่ม `http://localhost:8000/auth/google/callback` ใน Google Cloud Console

---

## บัญชีทดสอบ

| อีเมล | บทบาท |
|-------|--------|
| ดูจากตาราง `users` ในฐานข้อมูล | - |

---

## คำสั่งที่ใช้บ่อย

```bash
# รันระบบ
php artisan serve

# Clear cache
php artisan cache:clear && php artisan config:clear && php artisan view:clear

# ดู route ทั้งหมด
php artisan route:list
```
"# eform" 
