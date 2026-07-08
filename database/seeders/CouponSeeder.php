<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Coupon;

class CouponSeeder extends Seeder
{
    public function run(): void
    {
        $coupons = [
            [
                'code' => 'WELCOME10',
                'discount_type' => 'percent',
                'discount_value' => 10,
                'min_order_amount' => 100,
                'max_discount_amount' => 50,
                'usage_limit' => 100,
                'used_count' => 0,
                'start_date' => now()->startOfYear(),
                'expire_date' => now()->endOfYear(),
                'status' => true,
            ],
            [
                'code' => 'COFFEE20',
                'discount_type' => 'fixed',
                'discount_value' => 20,
                'min_order_amount' => 80,
                'max_discount_amount' => null,
                'usage_limit' => 50,
                'used_count' => 0,
                'start_date' => now()->startOfYear(),
                'expire_date' => now()->endOfYear(),
                'status' => true,
            ],
            [
                'code' => 'SUMMER50',
                'discount_type' => 'percent',
                'discount_value' => 15,
                'min_order_amount' => 200,
                'max_discount_amount' => 100,
                'usage_limit' => 30,
                'used_count' => 0,
                'start_date' => now()->startOfYear(),
                'expire_date' => now()->endOfYear(),
                'status' => true,
            ],
        ];

        foreach ($coupons as $coupon) {
            Coupon::create($coupon);
        }
    }
}
