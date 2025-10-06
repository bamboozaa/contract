@extends('layouts.main')
@section('title', 'โปรไฟล์ผู้ใช้งาน')

@section('importcss')
    @parent
    <style>
        .profile-container {
            background: linear-gradient(135deg, var(--utcc-blue) 0%, var(--utcc-light-blue) 100%);
            min-height: calc(100vh - 76px);
            padding: 1rem 0;
            display: flex;
            align-items: center;
            /* จัดกึ่งกลางแนวตั้ง */
        }

        .profile-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: all 0.3s ease;
            width: 100%;
            max-width: 1000px;
            /* เพิ่มความกว้างสูงสุด */
            margin: 0 auto;
            /* จัดกึ่งกลาง */
        }

        .profile-header {
            background: linear-gradient(135deg, #1a365d 0%, #2b77ad 100%);
            /* สีน้ำเงินเข้มขึ้น */
            color: white;
            padding: 3rem 2rem 2rem;
            text-align: center;
            position: relative;
        }

        /* หรือเอา background logo ออกไปเลย */
        .profile-header::before {
            display: none;
        }

        .profile-avatar {
            width: 120px;
            /* เพิ่มขนาด */
            height: 120px;
            /* เพิ่มขนาด */
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            /* เพิ่มระยะห่าง */
            border: 4px solid rgba(255, 255, 255, 0.3);
            position: relative;
            z-index: 1;
        }

        .profile-avatar i {
            font-size: 3.5rem;
            /* เพิ่มขนาด */
            color: white;
        }

        .profile-name {
            font-size: 2.2rem;
            /* เพิ่มขนาด */
            font-weight: 700;
            margin-bottom: 0.75rem;
            position: relative;
            z-index: 1;
            color: white;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .profile-role {
            font-size: 1.2rem;
            /* เพิ่มขนาด */
            opacity: 0.95;
            font-weight: 500;
            position: relative;
            z-index: 1;
            color: rgba(255, 255, 255, 0.95);
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        .profile-body {
            padding: 3rem;
            /* เพิ่ม padding */
        }

        .info-section {
            background: #f8f9fa;
            border-radius: 15px;
            padding: 2.5rem;
            /* เพิ่ม padding */
            border-left: 4px solid var(--utcc-gold);
        }

        .info-section-title {
            color: var(--utcc-dark-blue);
            font-size: 1.5rem;
            /* เพิ่มขนาด */
            font-weight: 700;
            margin-bottom: 2rem;
            /* เพิ่มระยะห่าง */
            display: flex;
            align-items: center;
        }

        .info-section-title i {
            margin-right: 1rem;
            /* เพิ่มระยะห่าง */
            color: var(--utcc-gold);
            font-size: 1.5rem;
            /* เพิ่มขนาด */
        }

        .info-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px;
            padding: 2rem;
            /* เพิ่ม padding */
            border-left: 4px solid var(--utcc-blue);
            margin-bottom: 2rem;
            /* เพิ่มระยะห่าง */
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .info-title {
            color: var(--utcc-dark-blue);
            font-weight: 700;
            font-size: 1rem;
            /* เพิ่มขนาด */
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 1rem;
            /* เพิ่มระยะห่าง */
            display: flex;
            align-items: center;
        }

        .info-title i {
            margin-right: 0.75rem;
            color: var(--utcc-blue);
            font-size: 1.2rem;
            /* เพิ่มขนาด */
        }

        .info-value {
            color: #495057;
            font-size: 1.3rem;
            /* เพิ่มขนาด */
            font-weight: 500;
        }

        .btn-back {
            background: linear-gradient(135deg, #6c757d 0%, #545b62 100%);
            border: none;
            color: white;
            padding: 1rem 2.5rem;
            /* เพิ่ม padding */
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.1rem;
            /* เพิ่มขนาด */
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            box-shadow: 0 4px 15px rgba(108, 117, 125, 0.3);
        }

        .btn-back:hover {
            background: linear-gradient(135deg, #545b62 0%, #343a40 100%);
            transform: translateY(-2px);
            color: white;
            text-decoration: none;
            box-shadow: 0 6px 20px rgba(108, 117, 125, 0.4);
        }

        .utcc-divider {
            height: 4px;
            /* เพิ่มความหนา */
            background: linear-gradient(90deg, var(--utcc-gold) 0%, var(--utcc-blue) 100%);
            border: none;
            border-radius: 2px;
            margin: 2.5rem 0;
            /* เพิ่มระยะห่าง */
        }

        .badge {
            font-size: 0.9rem;
            /* เพิ่มขนาด */
            padding: 0.5rem 1rem;
            /* เพิ่ม padding */
        }

        /* Desktop styles for large screens */
        @media (min-width: 1200px) {
            .profile-container {
                padding: 2rem 0;
            }

            .profile-card {
                max-width: 1200px;
                /* เพิ่มความกว้างสำหรับหน้าจอใหญ่ */
            }

            .profile-body {
                padding: 4rem;
                /* เพิ่ม padding สำหรับหน้าจอใหญ่ */
            }

            .info-section {
                padding: 3rem;
                /* เพิ่ม padding สำหรับหน้าจอใหญ่ */
            }

            .info-card {
                padding: 2.5rem;
                /* เพิ่ม padding สำหรับหน้าจอใหญ่ */
            }
        }

        /* Responsive สำหรับหน้าจอกลาง */
        @media (min-width: 992px) and (max-width: 1199px) {
            .profile-card {
                max-width: 900px;
            }
        }

        /* Responsive สำหรับหน้าจอเล็ก */
        @media (max-width: 768px) {
            .profile-container {
                padding: 0.5rem;
                min-height: calc(100vh - 76px);
                align-items: flex-start;
                /* ไม่จัดกึ่งกลางในมือถือ */
            }

            .profile-header {
                padding: 2rem 1rem 1.5rem;
            }

            .profile-body {
                padding: 1.5rem;
            }

            .info-section {
                padding: 1.5rem;
            }

            .info-card {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }

            .profile-avatar {
                width: 100px;
                height: 100px;
            }

            .profile-avatar i {
                font-size: 3rem;
            }

            .profile-name {
                font-size: 1.8rem;
            }

            .profile-role {
                font-size: 1rem;
            }

            .info-section-title {
                font-size: 1.2rem;
                margin-bottom: 1.5rem;
            }

            .info-value {
                font-size: 1.1rem;
            }

            .btn-back {
                padding: 0.75rem 2rem;
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .profile-container {
                padding: 0.25rem;
            }

            .info-section {
                padding: 1rem;
            }

            .profile-body {
                padding: 1rem;
            }

            .info-card {
                padding: 1.2rem;
            }
        }
    </style>
@stop

@section('content')
    <div class="profile-container">
        <div class="container-fluid">
            <div class="row justify-content-center h-100">
                <div class="col-12"> <!-- เปลี่ยนเป็น col-12 เต็มความกว้าง -->
                    <div class="profile-card">
                        <!-- Profile Header -->
                        <div class="profile-header">
                            <div class="profile-avatar">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            <h1 class="profile-name">{{ $user->name }}</h1>
                            <div class="profile-role">
                                @if ($user->role === 1)
                                    <i class="bi bi-shield-check me-1"></i>ผู้ดูแลระบบ
                                @else
                                    <i class="bi bi-person-badge me-1"></i>ผู้ใช้งานทั่วไป
                                @endif
                            </div>
                        </div>

                        <!-- Profile Body -->
                        <div class="profile-body">
                            <!-- ข้อมูลส่วนตัว -->
                            <div class="info-section">
                                <h3 class="info-section-title">
                                    <i class="bi bi-person-lines-fill"></i>
                                    ข้อมูลส่วนตัว
                                </h3>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="info-card">
                                            <div class="info-title">
                                                <i class="bi bi-person"></i>ชื่อ-นามสกุล
                                            </div>
                                            <div class="info-value">{{ $user->name }}</div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="info-card">
                                            <div class="info-title">
                                                <i class="bi bi-envelope"></i>อีเมล
                                            </div>
                                            <div class="info-value">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="info-card">
                                            <div class="info-title">
                                                <i class="bi bi-shield"></i>สิทธิ์การใช้งาน
                                            </div>
                                            <div class="info-value">
                                                @if ($user->role === 1)
                                                    <span class="badge bg-primary">ผู้ดูแลระบบ</span>
                                                @else
                                                    <span class="badge bg-secondary">ผู้ใช้งานทั่วไป</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="info-card">
                                            <div class="info-title">
                                                <i class="bi bi-calendar-plus"></i>วันที่สมัครสมาชิก
                                            </div>
                                            <div class="info-value">
                                                {{ \Carbon\Carbon::parse($user->created_at)->format('d/m/') . (\Carbon\Carbon::parse($user->created_at)->year + 543) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if ($user->updated_at != $user->created_at)
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="info-card">
                                                <div class="info-title">
                                                    <i class="bi bi-clock-history"></i>อัพเดตล่าสุด
                                                </div>
                                                <div class="info-value">
                                                    {{ \Carbon\Carbon::parse($user->updated_at)->format('d/m/') . (\Carbon\Carbon::parse($user->updated_at)->year + 543) . ' เวลา ' . \Carbon\Carbon::parse($user->updated_at)->format('H:i') . ' น.' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <hr class="utcc-divider">

                            <!-- ปุ่มกลับ -->
                            <div class="text-center">
                                <a href="{{ route('home') }}" class="btn-back">
                                    <i class="bi bi-arrow-left me-2"></i>กลับหน้าหลัก
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('importjs')
    @parent
@stop
