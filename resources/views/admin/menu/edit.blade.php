@extends('layouts.app') {{-- 🛠️ เปลี่ยนเป็นชื่อ Layout หลักของธีมคุณ --}}

@section('title', 'แก้ไขเมนู')

@section('content')
<div class="form-page-container">
    <div class="back-nav">
        <a href="{{ route('admin.menu.index') }}" class="link-back">⬅️ กลับหน้าหลักตั้งค่าเมนู</a>
    </div>

    <div class="form-card edit-mode">
        <h2 class="form-title">✏️ แก้ไขข้อมูลเมนู</h2>

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="error-list">
                    @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.menu.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="menu-form">
            @csrf
            @method('PUT') {{-- ⚠️ จำเป็นต้องใส่เพื่อระบุ Method PUT ของการเซฟอัปเดต --}}

            <div class="form-group">
                <label class="form-label">ชื่อเมนู <span class="required-star">*</span></label>
                <input type="text" name="name" class="form-input" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">หมวดหมู่สินค้า <span class="required-star">*</span></label>
                <select name="category" class="form-select" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ old('category', $product->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">ราคาขาย (บาท) <span class="required-star">*</span></label>
                <input type="number" name="price" step="0.01" min="0" class="form-input" value="{{ old('price', $product->price) }}" required>
            </div>

            <div class="form-group">
                <label class="form-label">รายละเอียดคำอธิบายเมนู</label>
                <textarea name="description" class="form-textarea" rows="3">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="form-group current-image-wrapper">
                <label class="form-label">รูปภาพประกอบเมนูปัจจุบัน</label>
                @if($product->image)
                    <div class="image-preview-box">
                        <img src="{{ asset('storage/' . $product->image) }}" class="edit-img-preview" alt="current image">
                        <p class="image-help-text">* หากไม่ต้องการเปลี่ยนรูปภาพ ไม่ต้องเลือกไฟล์ใหม่ด้านล่าง</p>
                    </div>
                @endif
                <input type="file" name="image" class="form-file-input" accept="image/*">
            </div>

            <div class="form-group-checkbox">
                <input type="checkbox" id="is_available" name="is_available" class="form-checkbox" value="1" {{ old('is_available', $product->is_available) ? 'checked' : '' }}>
                <label for="is_available" class="checkbox-label">เปิดขายรายการนี้ (แสดงบนหน้าร้าน POS)</label>
            </div>

            <button type="submit" class="btn btn-update-menu">💾 อัปเดตข้อมูลเมนู</button>
        </form>
    </div>
</div>
@endsection