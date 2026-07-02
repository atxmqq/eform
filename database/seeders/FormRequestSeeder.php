<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormRequestSeeder extends Seeder
{
    public function run(): void
    {
        // form_request_student
        DB::table('form_request_student')->insert([
            ['std_id_std' => '65010001', 'std_id_crad' => null, 'std_fname_th' => 'สมชาย',    'std_lname_th' => 'ใจดี',       'std_fname_en' => 'Somchai',    'std_lname_en' => 'Jaidee',      'std_province_th' => 'มหาสารคาม', 'std_degree_th' => 'ปริญญาโท',  'std_faculty_th' => 'คณะวิทยาการสารสนเทศ',    'std_faculty_id' => 1, 'std_major_th' => 'วิทยาการคอมพิวเตอร์',   'std_province_en' => 'Mahasarakham', 'std_degree_en' => 'Master Degree',   'std_faculty_en' => 'Faculty of Informatics',          'std_major_en' => 'Computer Science',        'std_img' => null, 'std_email' => 'somchai@msu.ac.th',    'std_modifile' => now()],
            ['std_id_std' => '65010002', 'std_id_crad' => null, 'std_fname_th' => 'สมหญิง',   'std_lname_th' => 'รักเรียน',  'std_fname_en' => 'Somying',    'std_lname_en' => 'Rakrian',     'std_province_th' => 'ขอนแก่น',   'std_degree_th' => 'ปริญญาโท',  'std_faculty_th' => 'คณะวิทยาการสารสนเทศ',    'std_faculty_id' => 1, 'std_major_th' => 'วิทยาการคอมพิวเตอร์',   'std_province_en' => 'Khon Kaen',    'std_degree_en' => 'Master Degree',   'std_faculty_en' => 'Faculty of Informatics',          'std_major_en' => 'Computer Science',        'std_img' => null, 'std_email' => 'somying@msu.ac.th',    'std_modifile' => now()],
            ['std_id_std' => '65010003', 'std_id_crad' => null, 'std_fname_th' => 'วิชัย',    'std_lname_th' => 'มานะดี',    'std_fname_en' => 'Wichai',     'std_lname_en' => 'Manadee',     'std_province_th' => 'ร้อยเอ็ด',  'std_degree_th' => 'ปริญญาเอก', 'std_faculty_th' => 'คณะวิทยาการสารสนเทศ',    'std_faculty_id' => 1, 'std_major_th' => 'เทคโนโลยีสารสนเทศ',     'std_province_en' => 'Roi Et',       'std_degree_en' => 'Doctoral Degree', 'std_faculty_en' => 'Faculty of Informatics',          'std_major_en' => 'Information Technology',  'std_img' => null, 'std_email' => 'wichai@msu.ac.th',     'std_modifile' => now()],
            ['std_id_std' => '65020001', 'std_id_crad' => null, 'std_fname_th' => 'นภาพร',    'std_lname_th' => 'สุขสันต์',  'std_fname_en' => 'Napaporn',   'std_lname_en' => 'Suksun',      'std_province_th' => 'กาฬสินธุ์', 'std_degree_th' => 'ปริญญาโท',  'std_faculty_th' => 'คณะการบัญชีและการจัดการ', 'std_faculty_id' => 2, 'std_major_th' => 'บริหารธุรกิจ',          'std_province_en' => 'Kalasin',      'std_degree_en' => 'Master Degree',   'std_faculty_en' => 'Faculty of Accountancy and Management', 'std_major_en' => 'Business Administration', 'std_img' => null, 'std_email' => 'napaporn@msu.ac.th',   'std_modifile' => now()],
            ['std_id_std' => '65020002', 'std_id_crad' => null, 'std_fname_th' => 'ประสิทธิ์', 'std_lname_th' => 'ทองดี',    'std_fname_en' => 'Prasit',     'std_lname_en' => 'Thongdee',    'std_province_th' => 'มหาสารคาม', 'std_degree_th' => 'ปริญญาเอก', 'std_faculty_th' => 'คณะการบัญชีและการจัดการ', 'std_faculty_id' => 2, 'std_major_th' => 'การจัดการ',              'std_province_en' => 'Mahasarakham', 'std_degree_en' => 'Doctoral Degree', 'std_faculty_en' => 'Faculty of Accountancy and Management', 'std_major_en' => 'Management',              'std_img' => null, 'std_email' => 'prasit@msu.ac.th',     'std_modifile' => now()],
        ]);

        // form_request_advisor
        DB::table('form_request_advisor')->insert([
            ['advisorcode' => 'ADV001', 'prefixname' => 'รศ.ดร.',  'advisorname' => 'สมศักดิ์',  'advisorsurname' => 'วิชาการ',  'prefixnameeng' => 'Assoc.Prof.Dr.', 'advisornameeng' => 'Somsak',    'advisorsurnameeng' => 'Wichakarn',  'facultyid' => 1, 'facultyname' => 'คณะวิทยาการสารสนเทศ',    'citizenid' => null, 'advisor_email' => 'somsak@msu.ac.th',    'advisor_modifile' => now()],
            ['advisorcode' => 'ADV002', 'prefixname' => 'ผศ.ดร.',  'advisorname' => 'วันดี',     'advisorsurname' => 'ใฝ่รู้',   'prefixnameeng' => 'Asst.Prof.Dr.',  'advisornameeng' => 'Wandee',    'advisorsurnameeng' => 'Fairoo',     'facultyid' => 1, 'facultyname' => 'คณะวิทยาการสารสนเทศ',    'citizenid' => null, 'advisor_email' => 'wandee@msu.ac.th',    'advisor_modifile' => now()],
            ['advisorcode' => 'ADV003', 'prefixname' => 'ดร.',     'advisorname' => 'ประเสริฐ',  'advisorsurname' => 'มงคลดี',  'prefixnameeng' => 'Dr.',            'advisornameeng' => 'Prasert',   'advisorsurnameeng' => 'Mongkoldee', 'facultyid' => 1, 'facultyname' => 'คณะวิทยาการสารสนเทศ',    'citizenid' => null, 'advisor_email' => 'prasert@msu.ac.th',   'advisor_modifile' => now()],
            ['advisorcode' => 'ADV004', 'prefixname' => 'รศ.ดร.',  'advisorname' => 'กนกวรรณ',  'advisorsurname' => 'ศรีสุข',  'prefixnameeng' => 'Assoc.Prof.Dr.', 'advisornameeng' => 'Kanokwan',  'advisorsurnameeng' => 'Srisuk',     'facultyid' => 2, 'facultyname' => 'คณะการบัญชีและการจัดการ', 'citizenid' => null, 'advisor_email' => 'kanokwan@msu.ac.th',  'advisor_modifile' => now()],
            ['advisorcode' => 'ADV005', 'prefixname' => 'ผศ.',     'advisorname' => 'ธนากร',    'advisorsurname' => 'พัฒนา',   'prefixnameeng' => 'Asst.Prof.',     'advisornameeng' => 'Thanakorn', 'advisorsurnameeng' => 'Pattana',    'facultyid' => 2, 'facultyname' => 'คณะการบัญชีและการจัดการ', 'citizenid' => null, 'advisor_email' => 'thanakorn@msu.ac.th', 'advisor_modifile' => now()],
        ]);

        // form_request_staff_faculty
        DB::table('form_request_staff_faculty')->insert([
            ['staff_fac_title' => 'นาย',    'staff_fac_name' => 'วรพล',    'staff_fac_surname' => 'สุขใจ',    'staff_faculty_id' => 1, 'staff_username' => 'worapol',  'staff_pass' => md5('password'), 'staff_id_crad' => null, 'staff_email' => 'worapol@msu.ac.th',  'staff_ses' => null],
            ['staff_fac_title' => 'นางสาว', 'staff_fac_name' => 'ปิยะดา',  'staff_fac_surname' => 'มีสุข',    'staff_faculty_id' => 1, 'staff_username' => 'piyada',   'staff_pass' => md5('password'), 'staff_id_crad' => null, 'staff_email' => 'piyada@msu.ac.th',   'staff_ses' => null],
            ['staff_fac_title' => 'นาง',    'staff_fac_name' => 'รัตนา',   'staff_fac_surname' => 'ดีงาม',    'staff_faculty_id' => 2, 'staff_username' => 'rattana',  'staff_pass' => md5('password'), 'staff_id_crad' => null, 'staff_email' => 'rattana@msu.ac.th',  'staff_ses' => null],
            ['staff_fac_title' => 'นาย',    'staff_fac_name' => 'ชัยวัฒน์', 'staff_fac_surname' => 'ก้าวหน้า', 'staff_faculty_id' => 2, 'staff_username' => 'chaiwat',  'staff_pass' => md5('password'), 'staff_id_crad' => null, 'staff_email' => 'chaiwat@msu.ac.th',  'staff_ses' => null],
            ['staff_fac_title' => 'นางสาว', 'staff_fac_name' => 'อรนุช',   'staff_fac_surname' => 'ใสสะอาด',  'staff_faculty_id' => 1, 'staff_username' => 'oranuch',  'staff_pass' => md5('password'), 'staff_id_crad' => null, 'staff_email' => 'oranuch@msu.ac.th',  'staff_ses' => null],
        ]);

        // form_request_staff (บัณฑิตวิทยาลัย)
        DB::table('form_request_staff')->insert([
            ['staff_name' => 'รศ.ดร.สุชาติ มั่นคง',       'staff_position' => 'คณบดีบัณฑิตวิทยาลัย',              'staff_level' => 'dean',      'staff_user' => 'suchat',    'staff_pass' => md5('password'), 'staff_img' => null, 'staff_email' => 'suchat@msu.ac.th'],
            ['staff_name' => 'ผศ.ดร.วิภาวดี ศรีงาม',      'staff_position' => 'รองคณบดีบัณฑิตวิทยาลัย',           'staff_level' => 'vice',      'staff_user' => 'wipawadee', 'staff_pass' => md5('password'), 'staff_img' => null, 'staff_email' => 'wipawadee@msu.ac.th'],
            ['staff_name' => 'นางสาวพรทิพย์ สุขสมบูรณ์',  'staff_position' => 'เจ้าหน้าที่บัณฑิตวิทยาลัย',        'staff_level' => 'officer',   'staff_user' => 'porntip',   'staff_pass' => md5('password'), 'staff_img' => null, 'staff_email' => 'porntip@msu.ac.th'],
            ['staff_name' => 'นายธีรพล วงศ์งาม',           'staff_position' => 'เจ้าหน้าที่กองทะเบียนและประมวลผล', 'staff_level' => 'registrar', 'staff_user' => 'teeraphon', 'staff_pass' => md5('password'), 'staff_img' => null, 'staff_email' => 'teeraphon@msu.ac.th'],
            ['staff_name' => 'นางสาวอภิญญา ดีเลิศ',       'staff_position' => 'เจ้าหน้าที่ทะเบียนบัณฑิตวิทยาลัย', 'staff_level' => 'registrar', 'staff_user' => 'apinya',    'staff_pass' => md5('password'), 'staff_img' => null, 'staff_email' => 'apinya@msu.ac.th'],
        ]);

        // form_request_dean_faculty
        DB::table('form_request_dean_faculty')->insert([
            ['dean_fac_title' => 'รศ.ดร.', 'dean_fac_name' => 'ประยูร',   'dean_fac_surname' => 'สิทธิชัย', 'dean_faculty_id' => 1, 'dean_position' => 'dean',      'dean_can_sign' => true,  'dean_username' => 'prayoon',   'dean_pass' => md5('password'), 'dean_id_crad' => null, 'dean_email' => 'prayoon@msu.ac.th',   'dean_ses' => null],
            ['dean_fac_title' => 'ผศ.ดร.', 'dean_fac_name' => 'นิภา',     'dean_fac_surname' => 'วงษ์ดี',   'dean_faculty_id' => 1, 'dean_position' => 'vice_dean', 'dean_can_sign' => false, 'dean_username' => 'nipa',      'dean_pass' => md5('password'), 'dean_id_crad' => null, 'dean_email' => 'nipa@msu.ac.th',      'dean_ses' => null],
            ['dean_fac_title' => 'รศ.ดร.', 'dean_fac_name' => 'ชาญชัย',  'dean_fac_surname' => 'พงษ์ไพร', 'dean_faculty_id' => 2, 'dean_position' => 'dean',      'dean_can_sign' => true,  'dean_username' => 'chanchai',  'dean_pass' => md5('password'), 'dean_id_crad' => null, 'dean_email' => 'chanchai@msu.ac.th',  'dean_ses' => null],
            ['dean_fac_title' => 'ผศ.',    'dean_fac_name' => 'สุภาพร',  'dean_fac_surname' => 'ใจกล้า',   'dean_faculty_id' => 2, 'dean_position' => 'vice_dean', 'dean_can_sign' => false, 'dean_username' => 'supaporn',  'dean_pass' => md5('password'), 'dean_id_crad' => null, 'dean_email' => 'supaporn@msu.ac.th',  'dean_ses' => null],
        ]);
    }
}
