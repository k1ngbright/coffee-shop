<div class="table-card">
    <div class="table-responsive">
        <table class="table menu-table">
            <thead>
                <tr>
                    <th style="width: 100px;">รูปเมนู</th>
                    <th>ชื่อรายการ</th>
                    <th style="width: 150px;">หมวดหมู่</th>
                    <th style="width: 120px;">ราคา</th>
                    <th style="width: 120px;">สถานะ</th>
                    <th style="width: 180px;">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr id="row-{{ $product->id }}">
                    <td>
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="menu-img-preview" alt="menu">
                        @else
                            <div class="menu-no-img">☕ ไม่มีรูป</div>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.menu.show', $product->id) }}" class="menu-link-name">{{ $product->name }}</a>
                        <p class="menu-desc-short">{{ $product->description ?? 'ไม่ได้ระบุคำอธิบาย' }}</p>
                    </td>
                    <td><span class="badge-category">{{ $product->category }}</span></td>
                    <td class="menu-price-text">฿{{ number_format($product->price, 2) }}</td>
                    <td>
                        @if($product->is_available)
                            <span class="status-badge available">พร้อมขาย</span>
                        @else
                            <span class="status-badge unavailable">สินค้าหมด</span>
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.menu.show', $product->id) }}" class="btn btn-info btn-sm">ดู</a>
                            <a href="{{ route('admin.menu.edit', $product->id) }}" class="btn btn-warning btn-sm">แก้ไข</a>
                            <button type="button" onclick="deleteMenu({{ $product->id }})" class="btn btn-danger btn-sm">ลบ</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center table-empty-state">📭 ยังไม่มีข้อมูลเมนูในระบบร้านกาแฟ</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>