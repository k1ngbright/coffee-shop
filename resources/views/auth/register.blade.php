@extends('layouts.app')

@section('title', 'สมัครสมาชิก - Coffee Shop')

@section('styles')
<style>
    .auth-container {
        max-width: 400px;
        margin: 4rem auto;
        background: white;
        padding: 2.5rem;
        border-radius: var(--radius-lg);
        box-shadow: var(--shadow-md);
        border: 1px solid var(--coffee-100);
    }
    
    .auth-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .auth-header h1 {
        font-size: 1.75rem;
        color: var(--coffee-900);
        margin-bottom: 0.5rem;
    }
    
    .auth-header p {
        color: var(--coffee-500);
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: var(--coffee-800);
        font-size: 0.875rem;
    }
    
    .form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid var(--coffee-200);
        border-radius: var(--radius);
        font-size: 1rem;
        transition: all 0.2s;
    }
    
    .form-control:focus {
        outline: none;
        border-color: var(--coffee-500);
        box-shadow: 0 0 0 3px rgba(139, 77, 32, 0.1);
    }
    
    .btn-register {
        width: 100%;
        padding: 0.875rem;
        background: var(--coffee-700);
        color: white;
        border: none;
        border-radius: var(--radius);
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        margin-top: 1rem;
    }
    
    .btn-register:hover {
        background: var(--coffee-800);
        transform: translateY(-1px);
        box-shadow: var(--shadow);
    }
    
    .auth-footer {
        margin-top: 2rem;
        text-align: center;
        font-size: 0.875rem;
        color: var(--coffee-600);
    }
    
    .auth-footer a {
        color: var(--coffee-700);
        font-weight: 600;
        text-decoration: none;
    }
    
    .auth-footer a:hover {
        text-decoration: underline;
    }
    
    .alert-error {
        background: #fee2e2;
        color: #991b1b;
        padding: 1rem;
        border-radius: var(--radius);
        margin-bottom: 1.5rem;
        font-size: 0.875rem;
    }
    
    .alert-error ul {
        margin: 0;
        padding-left: 1.5rem;
    }
</style>
@endsection

@section('content')
<div class="auth-container">
    <div class="auth-header">
        <h1>สมัครสมาชิก</h1>
        <p>สร้างบัญชีเพื่อเริ่มต้นสั่งเครื่องดื่ม</p>
    </div>

    @if($errors->any())
        <div class="alert-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">ชื่อ - นามสกุล</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required autofocus placeholder="John Doe">
        </div>

        <div class="form-group">
            <label for="email">อีเมล</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="your@email.com">
        </div>
        
        <div class="form-group">
            <label for="password">รหัสผ่าน</label>
            <input type="password" id="password" name="password" class="form-control" required placeholder="•••••••• (อย่างน้อย 8 ตัวอักษร)">
        </div>

        <div class="form-group">
            <label for="password_confirmation">ยืนยันรหัสผ่าน</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required placeholder="••••••••">
        </div>

        <button type="submit" class="btn-register">ลงทะเบียน</button>
    </form>
    
    <div class="auth-footer">
        มีบัญชีผู้ใช้อยู่แล้ว? <a href="{{ route('login') }}">เข้าสู่ระบบ</a>
    </div>
</div>
@endsection
