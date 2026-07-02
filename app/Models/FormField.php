<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormField extends Model
{
    protected $fillable = [
        'form_type_id', 'label', 'field_key', 'field_type',
        'is_required', 'options', 'placeholder', 'help_text', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_required' => 'boolean',
            'options'     => 'array',
        ];
    }

    public const FIELD_TYPES = [
        'text'     => 'ข้อความสั้น',
        'textarea' => 'ข้อความยาว',
        'number'   => 'ตัวเลข',
        'date'     => 'วันที่',
        'select'   => 'รายการเลือก (Dropdown)',
        'radio'    => 'ตัวเลือกเดี่ยว',
        'checkbox' => 'ตัวเลือกหลายอย่าง',
        'file'     => 'อัปโหลดไฟล์',
        'email'    => 'อีเมล',
        'tel'      => 'เบอร์โทรศัพท์',
    ];

    public function formType()
    {
        return $this->belongsTo(FormType::class);
    }
}
