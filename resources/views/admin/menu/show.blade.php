@extends('layouts.app') {{-- 🛠️ เปลี่ยนเป็นชื่อ Layout หลักของธีมคุณ --}}

@section('title', 'รายละเอียดเมนู')

@section('content')
<div class="details-page-container">
    <div class="details-nav-header">
        <a href="{{ route('admin.menu.index') }}" class="link-back">⬅️ กลับหน้าหลักตั้งค่าเมนู</a>
        <a href="{{ route('admin.menu.edit', $product->id) }}" class="btn btn-warning">✏️ แก้ไขเมนูนี้</a>
    </div>

    <div class="details-card-wrapper">
        {{-- โซนแสดงรูปภาพขนาดใหญ่ --}}
        <div class="details-image-section">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="menu-large-image">
            @else
                <div class="menu-large-no-img">
                    <span class="emoji-placeholder">☕</span>
                    <p>ไม่มีรูปภาพประกอบเมนู</p>
                </div>
            @endif
        </div>

        {{-- โซนแสดงรายละเอียดข้อความข้อมูล --}}
        <div class="details-info-section">
            <div class="info-top">
                <span class="badge-category-large">{{ $product->category }}</span>
                <h1 class="menu-detail-title">{{ $product->name }}</h1>
                <div class="menu-detail-price">฿{{ number_format($product->price, 2) }}</div>
            </div>

            <div class="info-middle">
                <h5 class="info-block-title">รายละเอียด / คำอธิบายสินค้า</h5>
                <p class="menu-detail-description">{{ $product->description ?? 'ไม่มีข้อมูลรายละเอียดเชิงลึกสำหรับเมนูนี้' }}</p>
            </div>

            <div class="info-bottom">
                <span class="status-label-text">สถานะการขายปัจจุบัน:</span>
                @if($product->is_available)
                    <span class="status-badge-large available">🟢 พร้อมจำหน่ายบนหน้าจอ POS</span>
                @else
                    <span class="status-badge-large unavailable">🔴 สินค้าหมดชั่วคราว</span>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection