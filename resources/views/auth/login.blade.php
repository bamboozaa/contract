@extends('layouts.guest')
@section('title', 'ระบบจัดการสัญญา - Contract Management System')

@section('importcss')
    @parent
    {{ Html::style('css/custom.css') }}
    <style>
        /* body { filter: grayscale(100%) brightness(1.05); } */
        .login-container {
            min-height: 100vh;
            height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: stretch;
            justify-content: center;
            padding: 0;
            overflow: hidden;
        }
        .login-card {
            background: #ffffff;
            border-radius: 0;
            box-shadow: none;
            overflow: hidden;
            max-width: 100%;
            width: 100%;
            height: 100vh;
            display: flex;
        }
        .login-left {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 80px 60px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            height: 100vh;
        }
        .login-left i {
            font-size: 80px;
            margin-bottom: 20px;
            opacity: 0.9;
        }
        .login-left h2 {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 15px;
        }
        .login-left p {
            font-size: 16px;
            opacity: 0.9;
            line-height: 1.6;
        }
        .login-right {
            padding: 80px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100vh;
            overflow-y: auto;
        }
        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }
        .login-header img {
            max-width: 200px;
            margin-bottom: 20px;
        }
        .login-header h3 {
            color: #333;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .login-header p {
            color: #666;
            font-size: 14px;
        }
        .form-floating {
            margin-bottom: 20px;
        }
        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 15px;
            height: 58px;
            font-size: 15px;
            transition: all 0.3s;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-login {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            border-radius: 10px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            transition: all 0.3s;
            margin-top: 10px;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }
        .toggle-password-btn {
            border: none;
            background: transparent;
            color: #666;
            padding: 0;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .toggle-password-btn:hover {
            color: #667eea;
        }
        .remember-me {
            margin: 20px 0;
        }
        .remember-me .form-check-label {
            color: #666;
            font-size: 14px;
        }
        @media (max-width: 768px) {
            .login-left {
                display: none;
            }
            .login-right {
                padding: 40px 30px;
            }
        }
    </style>
@stop

@section('content')
    <div class="login-container">
        <div class="login-card">
            <div class="row g-0 h-100">
                <div class="col-md-5 login-left">
                    <i class="bi bi-file-earmark-text"></i>
                    <h2>ระบบจัดการสัญญา</h2>
                    <p>Contract Management System</p>
                    <p class="mt-3">จัดการสัญญา ติดตามสถานะ และควบคุมเอกสารสำคัญได้อย่างมีประสิทธิภาพ</p>
                </div>
                <div class="col-md-7 login-right">
                    <div class="login-header">
                        <img src="{{ URL::asset('/images/logo/logo_UTCC_SubMain-2.png') }}" alt="UTCC Logo" class="img-fluid">
                        <h3>เข้าสู่ระบบ</h3>
                        <p>กรุณากรอกข้อมูลเพื่อเข้าใช้งานระบบ</p>
                    </div>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf

                        <!-- User Name input -->
                        <div class="form-floating">
                            <input class="form-control @error('username') is-invalid @enderror"
                                   type="text"
                                   name="username"
                                   id="username"
                                   placeholder="ชื่อผู้ใช้"
                                   required
                                   autofocus>
                            <label for="username"><i class="bi bi-person me-2"></i>ชื่อผู้ใช้</label>
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Password input -->
                        <div class="form-floating position-relative">
                            <input class="form-control @error('password') is-invalid @enderror pe-5"
                                   type="password"
                                   name="password"
                                   id="password"
                                   placeholder="รหัสผ่าน"
                                   required>
                            <label for="password"><i class="bi bi-lock me-2"></i>รหัสผ่าน</label>
                            <button type="button"
                                    class="toggle-password-btn position-absolute end-0 top-50 translate-middle-y"
                                    style="z-index: 10; margin-right: 10px;"
                                    onclick="togglePassword()">
                                <i class="bi bi-eye" id="togglePasswordIcon"></i>
                            </button>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="remember-me">
                            <div class="form-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       value=""
                                       id="remember"
                                       name="remember"
                                       {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    จดจำการเข้าสู่ระบบ
                                </label>
                            </div>
                        </div>

                        <!-- Login Button -->
                        <button type="submit" class="btn btn-login">
                            <i class="bi bi-box-arrow-in-right me-2"></i>เข้าสู่ระบบ
                        </button>

                        <!-- Footer in form -->
                        <div class="text-center mt-4 pt-3" style="border-top: 1px solid #e0e0e0;">
                            <small class="text-muted">
                                Copyright © {{ date('Y') }} University of the Thai Chamber of Commerce
                            </small>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePasswordIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }
    </script>
@endsection
