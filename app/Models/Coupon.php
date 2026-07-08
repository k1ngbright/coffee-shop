<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'discount_type',
        'discount_value',
        'min_order_amount',
        'max_discount_amount',
        'usage_limit',
        'used_count',
        'start_date',
        'expire_date',
        'status',
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'min_order_amount' => 'decimal:2',
        'max_discount_amount' => 'decimal:2',
        'usage_limit' => 'integer',
        'used_count' => 'integer',
        'start_date' => 'date',
        'expire_date' => 'date',
        'status' => 'boolean',
    ];

    /**
     * ตรวจสอบว่าคูปองใช้ได้หรือไม่
     */
    public function isValid(float $subtotal = 0): array
    {
        if (!$this->status) {
            return ['valid' => false, 'message' => 'คูปองนี้ถูกปิดใช้งาน'];
        }

        if ($this->start_date && Carbon::now()->lt($this->start_date)) {
            return ['valid' => false, 'message' => 'คูปองยังไม่เริ่มใช้งาน'];
        }

        if ($this->expire_date && Carbon::now()->gt($this->expire_date)) {
            return ['valid' => false, 'message' => 'คูปองหมดอายุแล้ว'];
        }

        if ($this->usage_limit && $this->used_count >= $this->usage_limit) {
            return ['valid' => false, 'message' => 'คูปองถูกใช้ครบจำนวนแล้ว'];
        }

        if ($this->min_order_amount && $subtotal < $this->min_order_amount) {
            return ['valid' => false, 'message' => 'ยอดสั่งซื้อขั้นต่ำ ฿' . number_format($this->min_order_amount, 2)];
        }

        return ['valid' => true, 'message' => 'ใช้คูปองได้'];
    }

    /**
     * คำนวณส่วนลดจากคูปอง
     */
    public function calculateDiscount(float $subtotal): float
    {
        if ($this->discount_type === 'percent') {
            $discount = $subtotal * ($this->discount_value / 100);
        } else {
            $discount = $this->discount_value;
        }

        // จำกัดส่วนลดสูงสุด
        if ($this->max_discount_amount && $discount > $this->max_discount_amount) {
            $discount = $this->max_discount_amount;
        }

        // ส่วนลดไม่เกินยอดสั่งซื้อ
        return min($discount, $subtotal);
    }

    /**
     * Orders ที่ใช้คูปองนี้
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
