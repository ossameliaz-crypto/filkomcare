<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'FilkomCare')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        primary: '#87B4B8',
                        'primary-hover': '#6ca3a8',
                        'slate-dark': '#3d4a5e',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { 
            font-family: 'Poppins', sans-serif; 
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        html, body { 
            overscroll-behavior: none;
            -webkit-tap-highlight-color: transparent;
            margin: 0;
            padding: 0;
        }
        input::-ms-reveal { display: none; }

        /* ===== Desktop Background ===== */
        .emulator-bg {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 25%, #0f4c5c 50%, #3ab3c3 75%, #c4eff5 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
            overflow: hidden;
        }

        /* Animated background orbs */
        .emulator-bg::before,
        .emulator-bg::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.3;
            animation: float 8s ease-in-out infinite;
        }
        .emulator-bg::before {
            width: 400px;
            height: 400px;
            background: #87B4B8;
            top: -100px;
            left: -100px;
            animation-delay: 0s;
        }
        .emulator-bg::after {
            width: 350px;
            height: 350px;
            background: #3ab3c3;
            bottom: -80px;
            right: -80px;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -20px) scale(1.05); }
            66% { transform: translate(-20px, 20px) scale(0.95); }
        }

        /* ===== Phone Frame ===== */
        .phone-frame {
            position: relative;
            z-index: 10;
            width: 390px;
            height: 844px;
            background: #1a1a2e;
            border-radius: 55px;
            padding: 12px;
            box-shadow: 
                0 0 0 2px #2a2a3e,
                0 0 0 4px #0a0a14,
                0 25px 60px rgba(0, 0, 0, 0.5),
                0 0 100px rgba(58, 179, 195, 0.15),
                inset 0 0 2px rgba(255, 255, 255, 0.05);
            animation: phoneAppear 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) both;
        }

        @keyframes phoneAppear {
            0% { 
                opacity: 0; 
                transform: translateY(40px) scale(0.9); 
            }
            100% { 
                opacity: 1; 
                transform: translateY(0) scale(1); 
            }
        }

        /* Side buttons */
        .phone-frame::before {
            content: '';
            position: absolute;
            right: -4px;
            top: 180px;
            width: 4px;
            height: 80px;
            background: linear-gradient(to bottom, #2a2a3e, #1a1a2e, #2a2a3e);
            border-radius: 0 4px 4px 0;
        }
        .phone-frame::after {
            content: '';
            position: absolute;
            left: -4px;
            top: 140px;
            width: 4px;
            height: 40px;
            background: linear-gradient(to bottom, #2a2a3e, #1a1a2e, #2a2a3e);
            border-radius: 4px 0 0 4px;
            box-shadow: 0 60px 0 0 #2a2a3e;
        }

        /* ===== Phone Screen ===== */
        .phone-screen {
            width: 100%;
            height: 100%;
            border-radius: 44px;
            overflow: hidden;
            background: #ffffff;
            position: relative;
        }

        /* ===== Dynamic Island / Notch ===== */
        .dynamic-island {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 126px;
            height: 36px;
            background: #0a0a14;
            border-radius: 20px;
            z-index: 100;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding-right: 12px;
        }

        .dynamic-island::before {
            content: '';
            width: 10px;
            height: 10px;
            background: radial-gradient(circle, #1a2a3a 30%, #0a0a14 70%);
            border-radius: 50%;
            border: 1.5px solid #1a1a2e;
        }

        /* ===== Status Bar ===== */
        .status-bar {
            position: absolute;
            top: 14px;
            left: 30px;
            right: 30px;
            z-index: 99;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            font-weight: 600;
            color: #1a1a2e;
        }

        .status-bar .time {
            font-size: 14px;
            font-weight: 700;
            letter-spacing: -0.3px;
        }

        .status-icons {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* ===== Scrollable Content ===== */
        .phone-content {
            width: 100%;
            height: 100%;
            overflow-y: auto;
            overflow-x: hidden;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }
        
        /* Hide scrollbars globally inside phone */
        .phone-frame * {
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none;  /* IE and Edge */
        }
        .phone-frame *::-webkit-scrollbar {
            display: none; /* Chrome, Safari and Opera */
        }

        /* Utility class just in case */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* ===== Home Indicator ===== */
        .home-indicator {
            position: absolute;
            bottom: 8px;
            left: 50%;
            transform: translateX(-50%);
            width: 134px;
            height: 5px;
            background: #1a1a2e;
            border-radius: 100px;
            opacity: 0.3;
            z-index: 100;
        }

        /* ===== Info Panel (beside phone) ===== */
        .info-panel {
            position: absolute;
            top: 50%;
            right: calc(50% - 320px);
            transform: translateY(-50%) translateX(100%);
            margin-right: -200px;
            z-index: 10;
            display: flex;
            flex-direction: column;
            gap: 16px;
            animation: slideInRight 0.8s ease both;
            animation-delay: 0.4s;
        }

        @keyframes slideInRight {
            0% { opacity: 0; transform: translateY(-50%) translateX(calc(100% + 30px)); }
            100% { opacity: 1; transform: translateY(-50%) translateX(100%); }
        }

        .info-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            padding: 20px 24px;
            color: white;
            min-width: 200px;
        }

        .info-card .label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            opacity: 0.5;
            margin-bottom: 6px;
        }

        .info-card .value {
            font-size: 16px;
            font-weight: 600;
        }

        .info-card .subtitle {
            font-size: 11px;
            opacity: 0.4;
            margin-top: 4px;
        }

        /* ===== Brand label on left ===== */
        .brand-label {
            position: absolute;
            top: 50%;
            left: calc(50% - 320px);
            transform: translateY(-50%) translateX(-100%);
            margin-left: -60px;
            z-index: 10;
            animation: slideInLeft 0.8s ease both;
            animation-delay: 0.3s;
        }

        @keyframes slideInLeft {
            0% { opacity: 0; transform: translateY(-50%) translateX(calc(-100% - 30px)); }
            100% { opacity: 1; transform: translateY(-50%) translateX(-100%); }
        }

        .brand-label h2 {
            font-size: 36px;
            font-weight: 700;
            color: white;
            line-height: 1.2;
            letter-spacing: -1px;
        }

        .brand-label p {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.45);
            margin-top: 8px;
            font-weight: 300;
        }

        .brand-label .accent-line {
            width: 40px;
            height: 3px;
            background: linear-gradient(90deg, #3ab3c3, #87B4B8);
            border-radius: 2px;
            margin-top: 16px;
        }

        /* ===== Responsive: hide frame on mobile ===== */
        @media (max-width: 768px) {
            .emulator-bg {
                background: white;
                padding: 0;
                min-height: 100vh;
            }
            .emulator-bg::before,
            .emulator-bg::after {
                display: none;
            }
            .phone-frame {
                width: 100%;
                height: auto;
                min-height: 100vh;
                border-radius: 0;
                padding: 0;
                box-shadow: none;
                background: white;
                animation: none;
            }
            .phone-screen {
                border-radius: 0;
            }
            .phone-content {
                min-height: 100vh;
            }
            .dynamic-island,
            .status-bar,
            .home-indicator,
            .info-panel,
            .brand-label {
                display: none;
            }
        }

        @media (max-width: 1400px) {
            .info-panel,
            .brand-label {
                display: none;
            }
        }
    </style>
    @stack('styles')
</head>
<body>

    <div class="emulator-bg">

        {{-- Brand Label (Left side) --}}
        <div class="brand-label">
            <h2>Filkom<br>Care</h2>
            <p>Mental Health Support<br>for FILKOM Students</p>
            <div class="accent-line"></div>
        </div>

        {{-- Phone Frame --}}
        <div class="phone-frame">
            <div class="phone-screen">

                {{-- Dynamic Island --}}
                <div class="dynamic-island"></div>

                {{-- Status Bar --}}
                <div class="status-bar">
                    <span class="time" id="statusTime">9:41</span>
                    <div class="status-icons">
                        {{-- Signal --}}
                        <svg width="17" height="12" viewBox="0 0 17 12" fill="currentColor">
                            <rect x="0" y="9" width="3" height="3" rx="0.5"/>
                            <rect x="4.5" y="6" width="3" height="6" rx="0.5"/>
                            <rect x="9" y="3" width="3" height="9" rx="0.5"/>
                            <rect x="13.5" y="0" width="3" height="12" rx="0.5"/>
                        </svg>
                        {{-- WiFi --}}
                        <svg width="16" height="12" viewBox="0 0 16 12" fill="currentColor">
                            <path d="M8 9.6a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4zM4.46 7.39a4.8 4.8 0 017.08 0l-.94.94a3.36 3.36 0 00-5.2 0l-.94-.94zM1.75 4.68a8.16 8.16 0 0112.5 0l-.94.94a6.72 6.72 0 00-10.62 0l-.94-.94z"/>
                        </svg>
                        {{-- Battery --}}
                        <svg width="27" height="12" viewBox="0 0 27 12" fill="currentColor">
                            <rect x="0" y="0.5" width="23" height="11" rx="2.5" stroke="currentColor" stroke-width="1" fill="none" opacity="0.35"/>
                            <rect x="24" y="3.5" width="2.5" height="5" rx="1" opacity="0.4"/>
                            <rect x="2" y="2.5" width="19" height="7" rx="1.5" fill="currentColor"/>
                        </svg>
                    </div>
                </div>

                {{-- Scrollable Content --}}
                <div class="phone-content">
                    @yield('content')
                </div>

                {{-- SOS Modal --}}
                @include('components.sos-modal')

                {{-- Home Indicator --}}
                <div class="home-indicator"></div>

            </div>
        </div>

        {{-- Info Panel (Right side) --}}
        <div class="info-panel">
            <div class="info-card">
                <div class="label">Platform</div>
                <div class="value">iOS 18</div>
                <div class="subtitle">iPhone 15 Pro</div>
            </div>
            <div class="info-card">
                <div class="label">Screen</div>
                <div class="value">390 × 844</div>
                <div class="subtitle">Super Retina XDR</div>
            </div>
            <div class="info-card">
                <div class="label">Page</div>
                <div class="value">@yield('page-name', 'Home')</div>
                <div class="subtitle">FilkomCare App</div>
            </div>
        </div>

    </div>

    {{-- Update status bar time --}}
    <script>
        function updateTime() {
            const now = new Date();
            const h = now.getHours();
            const m = now.getMinutes().toString().padStart(2, '0');
            document.getElementById('statusTime').textContent = h + ':' + m;
        }
        updateTime();
        setInterval(updateTime, 30000);
    </script>

    @stack('scripts')
</body>
</html>
