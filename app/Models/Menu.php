<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // กำหนดฟิลด์ที่อนุญาตให้กรอกข้อมูลและบันทึกพร้อมกันได้ (Mass Assignment)
    protected $fillable = ['name', 'category', 'price', 'description', 'image', 'is_available'];
}