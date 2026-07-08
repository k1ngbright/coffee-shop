@extends('layouts.app')

@section('title', 'หน้าแรก - เมนูแนะนำ')

@section('styles')
<style>
    /* ตกแต่งแบนเนอร์ด้านบน */
    .hero-section {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.4)), url('https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&q=80') center/cover;
        color: white;
        padding: 80px 20px;
        border-radius: 15px;
        text-align: center;
        margin-bottom: 40px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .hero-section h1 {
        font-weight: 800;
        font-size: 2.8rem;
        margin-bottom: 10px;
    }
    .hero-section p {
        font-size: 1.2rem;
        color: #f8f9fa;
        margin-bottom: 25px;
    }
    
    /* ตกแต่งส่วนหัวข้อเมนูแนะนำ */
    .section-title {
        font-weight: 800;
        border-left: 5px solid var(--coffee-600);
        padding-left: 15px;
        margin-bottom: 25px;
        color: var(--coffee-900);
    }

    /* ตกแต่ง Grid เมนูแนะนำ */
    .rec-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 25px;
        padding-bottom: 50px;
    }
    .rec-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        text-align: center;
        padding-bottom: 20px;
        border: 1px solid #f0f0f0;
    }
    .rec-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .rec-img {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }
    .rec-name {
        font-size: 1.25rem;
        font-weight: 700;
        margin: 15px 10px 5px;
        color: var(--coffee-800);
    }
    .rec-price {
        color: #d2691e;
        font-weight: 800;
        font-size: 1.2rem;
        margin-bottom: 15px;
    }
    .btn-main {
        background-color: var(--coffee-600);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 30px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: 0.2s;
    }
    .btn-main:hover {
        background-color: var(--coffee-800);
        color: white;
    }
    .btn-outline {
        border: 2px solid var(--coffee-600);
        color: var(--coffee-600);
        padding: 8px 25px;
        border-radius: 20px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: 0.2s;
    }
    .btn-outline:hover {
        background-color: var(--coffee-600);
        color: white;
    }
</style>
@endsection

@section('content')
    {{-- แบนเนอร์หน้าแรก --}}
    <div class="hero-section">
        <h1>☕ ยินดีต้อนรับสู่ Coffee Shop</h1>
        <p>เริ่มต้นวันใหม่ด้วยกาแฟแก้วโปรดที่คุณสามารถปรับแต่งได้เอง</p>
        <a href="{{ route('orders.create') }}" class="btn-main" style="font-size: 1.2rem;">
            🛒 เริ่มสั่งเครื่องดื่มเลย
        </a>
    </div>

    {{-- ดึงข้อมูลสินค้ามาแสดงเป็นเมนูแนะนำ (สุ่ม 4 รายการ) --}}
    @php
        // เช็คว่ามีคลาส Product อยู่จริงเพื่อป้องกัน Error
        if(class_exists('\App\Models\Product')) {
            $recommendedProducts = \App\Models\Product::where('status', 1)->inRandomOrder()->take(4)->get();
        } else {
            $recommendedProducts = collect(); // ถ้าไม่มีให้เป็นค่าว่าง
        }
    @endphp

    <div class="container-fluid px-0">
        <h3 class="section-title">⭐ เมนูแนะนำประจำวัน</h3>
        
        <div class="rec-grid">
            @forelse($recommendedProducts as $product)
                <div class="rec-card">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="rec-img">
                    @else
                        <div class="rec-img" style="background: #f3ece7; display: flex; align-items: center; justify-content: center; font-size: 4rem;">☕</div>
                    @endif
                    
                    <div class="rec-name">{{ $product->name }}</div>
                    <div class="rec-price">฿{{ number_format($product->price, 0) }}</div>
                    
                    {{-- ปุ่มกดแล้ววิ่งไปหน้า POS --}}
                    <a href="{{ route('orders.create') }}" class="btn-outline">สั่งเลย</a>
                </div>
            @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px; background: white; border-radius: 12px;">
                    <span style="font-size: 3rem;">📝</span>
                    <h4 class="mt-3 text-muted">ยังไม่มีสินค้าในระบบ</h4>
                    <p>กรุณาเพิ่มสินค้าหลังบ้านเพื่อให้แสดงเป็นเมนูแนะนำ</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection