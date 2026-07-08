<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::create('menus', function (Blueprint $table) {
        $table->id();
        $table->string('name');           // ชื่อเมนูกาแฟ
        $table->string('category');       // หมวดหมู่ (เก็บเป็นข้อความ เช่น 'กาแฟ', 'ชา')
        $table->decimal('price', 8, 2);   // ราคาขาย
        $table->text('description')->nullable(); // รายละเอียดเมนู
        $table->string('image')->nullable();    // พาธรูปภาพ
        $table->boolean('is_available')->default(1); // สถานะพร้อมขาย (1 = พร้อม, 0 = หมด)
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
