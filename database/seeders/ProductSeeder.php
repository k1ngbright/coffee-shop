<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // ☕ กาแฟ
            ['name' => 'เอสเพรสโซ่', 'price' => 50, 'category' => 'กาแฟ', 'image' => null, 'status' => true],
            ['name' => 'อเมริกาโน่', 'price' => 55, 'category' => 'กาแฟ', 'image' => null, 'status' => true],
            ['name' => 'ลาเต้', 'price' => 65, 'category' => 'กาแฟ', 'image' => null, 'status' => true],
            ['name' => 'คาปูชิโน่', 'price' => 65, 'category' => 'กาแฟ', 'image' => null, 'status' => true],
            ['name' => 'มอคค่า', 'price' => 70, 'category' => 'กาแฟ', 'image' => null, 'status' => true],
            ['name' => 'คาราเมล มัคคิอาโต้', 'price' => 75, 'category' => 'กาแฟ', 'image' => null, 'status' => true],
            ['name' => 'ดับเบิ้ล ช็อต ลาเต้', 'price' => 80, 'category' => 'กาแฟ', 'image' => null, 'status' => true],
            ['name' => 'ไวท์ มอคค่า', 'price' => 75, 'category' => 'กาแฟ', 'image' => null, 'status' => true],

            // 🍵 ชา
            ['name' => 'ชาเขียว มัทฉะ ลาเต้', 'price' => 65, 'category' => 'ชา', 'image' => null, 'status' => true],
            ['name' => 'ชาไทย', 'price' => 50, 'category' => 'ชา', 'image' => null, 'status' => true],
            ['name' => 'ชาเขียว', 'price' => 45, 'category' => 'ชา', 'image' => null, 'status' => true],
            ['name' => 'ชามะนาว', 'price' => 45, 'category' => 'ชา', 'image' => null, 'status' => true],
            ['name' => 'ชาพีช', 'price' => 55, 'category' => 'ชา', 'image' => null, 'status' => true],

            // 🧋 เครื่องดื่มอื่นๆ
            ['name' => 'ช็อกโกแลต', 'price' => 60, 'category' => 'เครื่องดื่มอื่นๆ', 'image' => null, 'status' => true],
            ['name' => 'โอวัลติน', 'price' => 55, 'category' => 'เครื่องดื่มอื่นๆ', 'image' => null, 'status' => true],
            ['name' => 'นมสด', 'price' => 45, 'category' => 'เครื่องดื่มอื่นๆ', 'image' => null, 'status' => true],
            ['name' => 'โกโก้', 'price' => 60, 'category' => 'เครื่องดื่มอื่นๆ', 'image' => null, 'status' => true],
            ['name' => 'สมูทตี้ มิกซ์เบอร์รี่', 'price' => 75, 'category' => 'เครื่องดื่มอื่นๆ', 'image' => null, 'status' => true],

            // 🍞 ขนม / เบเกอรี่
            ['name' => 'ครัวซองต์ เนยสด', 'price' => 65, 'category' => 'เบเกอรี่', 'image' => null, 'status' => true],
            ['name' => 'เค้กช็อกโกแลต', 'price' => 85, 'category' => 'เบเกอรี่', 'image' => null, 'status' => true],
            ['name' => 'ชีสเค้ก', 'price' => 90, 'category' => 'เบเกอรี่', 'image' => null, 'status' => true],
            ['name' => 'บราวนี่', 'price' => 55, 'category' => 'เบเกอรี่', 'image' => null, 'status' => true],
            ['name' => 'คุกกี้ ช็อคชิพ', 'price' => 35, 'category' => 'เบเกอรี่', 'image' => null, 'status' => true],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
