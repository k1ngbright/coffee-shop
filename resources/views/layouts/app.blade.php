<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Coffee Shop POS') — ☕ ร้านกาแฟ</title>
    <meta name="description" content="ระบบจัดการออเดอร์ร้านกาแฟ">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Noto+Sans+Thai:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('styles')
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('orders.create') }}" class="navbar-brand">
            <span class="logo">☕</span>
            <span>Coffee Shop</span>
        </a>
        <ul class="navbar-nav">
            <li>
                <a href="{{ route('orders.create') }}"
                   class="nav-link {{ request()->routeIs('orders.create') ? 'active' : '' }}">
                    🛒 สร้างออเดอร์
                </a>
            </li>
            <li>
                <a href="{{ route('orders.index') }}"
                   class="nav-link {{ request()->routeIs('orders.index') ? 'active' : '' }}">
                    📋 รายการออเดอร์
                </a>
            </li>
        </ul>
    </nav>

    <main class="main-content">
        @if(session('success'))
            <div class="flash-message flash-success">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="flash-message flash-error">
                ❌ {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </main>

    @yield('scripts')
</body>
</html>
