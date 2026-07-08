@extends('layouts.app')

@section('title', 'รายการออเดอร์')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/orders.css') }}">
@endsection

@section('content')
    {{-- Stats --}}
    @php
        $allOrders = \App\Models\Order::selectRaw("
            COUNT(*) as total,
            SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending,
            SUM(CASE WHEN status = 'paid' THEN 1 ELSE 0 END) as paid,
            SUM(CASE WHEN status = 'cancelled' THEN 1 ELSE 0 END) as cancelled
        ")->first();
    @endphp

    <div class="order-stats">
        <div class="stat-card">
            <div class="stat-icon total">📦</div>
            <div class="stat-info">
                <div class="stat-value">{{ $allOrders->total ?? 0 }}</div>
                <div class="stat-label">ออเดอร์ทั้งหมด</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon pending">⏳</div>
            <div class="stat-info">
                <div class="stat-value">{{ $allOrders->pending ?? 0 }}</div>
                <div class="stat-label">รอชำระ</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon paid">✅</div>
            <div class="stat-info">
                <div class="stat-value">{{ $allOrders->paid ?? 0 }}</div>
                <div class="stat-label">ชำระแล้ว</div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon cancelled">❌</div>
            <div class="stat-info">
                <div class="stat-value">{{ $allOrders->cancelled ?? 0 }}</div>
                <div class="stat-label">ยกเลิก</div>
            </div>
        </div>
    </div>

    <div class="page-header">
        <h1>📋 รายการออเดอร์</h1>
        <div class="status-tabs">
            <a href="{{ route('orders.index') }}" class="status-tab {{ !$status ? 'active' : '' }}">ทั้งหมด</a>
            <a href="{{ route('orders.index', ['status' => 'pending']) }}" class="status-tab {{ $status === 'pending' ? 'active' : '' }}">⏳ รอชำระ</a>
            <a href="{{ route('orders.index', ['status' => 'paid']) }}" class="status-tab {{ $status === 'paid' ? 'active' : '' }}">✅ ชำระแล้ว</a>
            <a href="{{ route('orders.index', ['status' => 'cancelled']) }}" class="status-tab {{ $status === 'cancelled' ? 'active' : '' }}">❌ ยกเลิก</a>
        </div>
    </div>

    <div class="orders-table-wrapper">
        @if($orders->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">📋</div>
                <h3>ยังไม่มีออเดอร์</h3>
                <p>เริ่มสร้างออเดอร์แรกกันเลย!</p>
                <a href="{{ route('orders.create') }}" class="btn btn-primary" style="margin-top: 1rem;">🛒 สร้างออเดอร์</a>
            </div>
        @else
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>เลขออเดอร์</th>
                        <th>ลูกค้า</th>
                        <th>รายการ</th>
                        <th>ยอดรวม</th>
                        <th>สถานะ</th>
                        <th>เวลา</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>
                                <a href="{{ route('orders.show', $order) }}" class="order-number-link">
                                    {{ $order->order_number }}
                                </a>
                            </td>
                            <td>
                                {{ $order->customer_name ?? '-' }}
                                @if($order->customer_phone)
                                    <br><span style="font-size: 0.75rem; color: var(--coffee-400);">{{ $order->customer_phone }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="order-items-preview">
                                    {{ $order->items->map(fn($i) => $i->product->name . ' x' . $i->quantity)->join(', ') }}
                                </div>
                            </td>
                            <td class="order-total">฿{{ number_format($order->total, 0) }}</td>
                            <td>
                                <span class="badge badge-{{ $order->status_color }}">{{ $order->status_thai }}</span>
                            </td>
                            <td class="order-time">
                                {{ $order->created_at->format('d/m/Y') }}<br>
                                {{ $order->created_at->format('H:i') }}
                            </td>
                            <td>
                                <div class="status-actions">
                                    @if($order->status === 'pending')
                                        <form method="POST" action="{{ route('orders.update-status', $order) }}" style="display:inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="paid">
                                            <button type="submit" class="status-action-btn pay">✅ ชำระแล้ว</button>
                                        </form>
                                        <form method="POST" action="{{ route('orders.update-status', $order) }}" style="display:inline">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="cancelled">
                                            <button type="submit" class="status-action-btn cancel" onclick="return confirm('ยืนยันยกเลิกออเดอร์นี้?')">❌ ยกเลิก</button>
                                        </form>
                                    @endif
                                    <a href="{{ route('orders.show', $order) }}" class="btn btn-ghost btn-sm">📄 ดู</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination-wrapper">
                {{ $orders->withQueryString()->links() }}
            </div>
        @endif
    </div>
@endsection
