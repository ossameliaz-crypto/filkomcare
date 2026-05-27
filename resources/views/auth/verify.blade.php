@extends('layouts.mobile-emulator')

@section('title', 'Verifikasi - FilkomCare')
@section('page-name', 'Verifikasi')

@section('content')
    {{-- Mobile App Container --}}
    <div class="w-full min-h-screen bg-white flex flex-col relative" id="verifyContainer">
        
        {{-- Back Button --}}
        <div class="px-5 pt-14 pb-2">
            <a href="{{ url('/register') }}" class="inline-flex items-center text-slate-dark hover:text-primary transition">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"/>
                </svg>
            </a>
        </div>

        {{-- Content Area --}}
        <div class="flex-1 flex flex-col px-7 pt-4">

            {{-- Title Section --}}
            <div class="mb-6">
                <h1 class="text-[26px] font-bold text-slate-dark leading-tight">Verifikasi</h1>
                <p class="text-[13px] text-gray-400 mt-1 font-light">Kode telah dikirimkan ke email</p>
            </div>

            {{-- OTP Form --}}
            <form action="{{ route('verify.submit') }}" method="POST" id="otpForm">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <input type="hidden" name="code" id="otpHidden" value="">

                {{-- OTP Boxes --}}
                <div class="flex gap-3 mb-3" id="otpBoxes">
                    <div class="otp-box" data-index="0"></div>
                    <div class="otp-box" data-index="1"></div>
                    <div class="otp-box" data-index="2"></div>
                    <div class="otp-box" data-index="3"></div>
                    <div class="otp-box" data-index="4"></div>
                    <div class="otp-box" data-index="5"></div>
                </div>

                {{-- Error Messages --}}
                @if ($errors->has('code'))
                    <p class="text-[11px] text-danger mb-2">{{ $errors->first('code') }}</p>
                @endif

                {{-- Countdown / Resend --}}
                <div class="mb-6">
                    <p class="text-[11px] text-gray-400 font-light" id="countdownText">
                        Tunggu <span id="countdown">60</span> detik sebelum meminta kode lainnya
                    </p>
                    <form action="{{ route('verify.resend', $user->id) }}" method="POST" id="resendForm" class="hidden">
                        @csrf
                        <button type="submit" class="text-[11px] text-primary font-semibold hover:text-primary-dark transition">
                            Kirim ulang kode verifikasi
                        </button>
                    </form>
                    @if (session('success'))
                        <p class="text-[11px] text-success mt-1">{{ session('success') }}</p>
                    @endif
                </div>

                {{-- Submit Button --}}
                <button type="submit" id="submitBtn"
                    class="w-full font-semibold text-[14px] py-4 rounded-2xl shadow-sm transition-all duration-300 transform active:scale-[0.98] otp-btn-disabled"
                    disabled>
                    Sign Up Now
                </button>
            </form>

        </div>

        {{-- Bottom Link --}}
        <div class="w-full text-center pb-10 pt-6">
            <p class="text-[12px] text-gray-400 font-normal">
                Kamu sudah punya akun? 
                <a href="{{ url('/login') }}" class="text-slate-dark font-bold hover:text-primary transition">Login now</a>
            </p>
        </div>

        {{-- ===== Numeric Keyboard ===== --}}
        <div id="numericKeyboard" class="numeric-keyboard hidden">
            <div class="nk-row">
                <button type="button" class="nk-key" data-key="1">
                    <span class="nk-num">1</span>
                </button>
                <button type="button" class="nk-key" data-key="2">
                    <span class="nk-num">2</span>
                    <span class="nk-sub">ABC</span>
                </button>
                <button type="button" class="nk-key" data-key="3">
                    <span class="nk-num">3</span>
                    <span class="nk-sub">DEF</span>
                </button>
            </div>
            <div class="nk-row">
                <button type="button" class="nk-key" data-key="4">
                    <span class="nk-num">4</span>
                    <span class="nk-sub">GHI</span>
                </button>
                <button type="button" class="nk-key" data-key="5">
                    <span class="nk-num">5</span>
                    <span class="nk-sub">JKL</span>
                </button>
                <button type="button" class="nk-key" data-key="6">
                    <span class="nk-num">6</span>
                    <span class="nk-sub">MNO</span>
                </button>
            </div>
            <div class="nk-row">
                <button type="button" class="nk-key" data-key="7">
                    <span class="nk-num">7</span>
                    <span class="nk-sub">PQRS</span>
                </button>
                <button type="button" class="nk-key" data-key="8">
                    <span class="nk-num">8</span>
                    <span class="nk-sub">TUV</span>
                </button>
                <button type="button" class="nk-key" data-key="9">
                    <span class="nk-num">9</span>
                    <span class="nk-sub">WXYZ</span>
                </button>
            </div>
            <div class="nk-row">
                <div class="nk-key nk-key-empty"></div>
                <button type="button" class="nk-key" data-key="0">
                    <span class="nk-num">0</span>
                </button>
                <button type="button" class="nk-key nk-key-action" data-action="backspace">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 4H8l-7 8 7 8h13a2 2 0 002-2V6a2 2 0 00-2-2z"/><line x1="18" y1="9" x2="12" y2="15"/><line x1="12" y1="9" x2="18" y2="15"/></svg>
                </button>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    /* ===== OTP Boxes ===== */
    .otp-box {
        flex: 1;
        aspect-ratio: 1;
        max-width: 52px;
        max-height: 52px;
        border-radius: 10px;
        background: #e8e8e8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 600;
        color: #3d4a5e;
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
        font-family: 'Poppins', sans-serif;
    }
    .otp-box.active {
        background: #ffffff;
        border: 2px solid #87B4B8;
        box-shadow: 0 0 0 3px rgba(135, 180, 184, 0.15);
    }
    .otp-box.filled {
        background: #c4eff5;
        color: #3d4a5e;
    }
    .otp-box.active::after {
        content: '';
        width: 2px;
        height: 22px;
        background: #3d4a5e;
        animation: blink 1s infinite;
        position: absolute;
    }
    .otp-box.active.has-value::after {
        display: none;
    }
    @keyframes blink {
        0%, 50% { opacity: 1; }
        51%, 100% { opacity: 0; }
    }

    /* Submit button states */
    .otp-btn-disabled {
        background: #d1d5db;
        color: #9ca3af;
        cursor: not-allowed;
    }
    .otp-btn-enabled {
        background: #87B4B8;
        color: #ffffff;
        cursor: pointer;
    }
    .otp-btn-enabled:hover {
        background: #76a2a6;
    }
    .otp-btn-enabled:active {
        background: #5A8A8E;
    }

    /* ===== Numeric Keyboard ===== */
    .numeric-keyboard {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: #e8e8ed;
        padding: 8px 16px 20px;
        z-index: 50;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease;
        transform: translateY(0);
        opacity: 1;
    }
    .numeric-keyboard.hidden {
        transform: translateY(100%);
        opacity: 0;
        pointer-events: none;
    }

    .nk-row {
        display: flex;
        gap: 6px;
        margin-bottom: 6px;
    }

    .nk-key {
        flex: 1;
        height: 52px;
        border-radius: 8px;
        border: none;
        background: #ffffff;
        color: #1a1a2e;
        font-family: 'Poppins', -apple-system, sans-serif;
        cursor: pointer;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        transition: background 0.1s ease, transform 0.08s ease;
        -webkit-user-select: none;
        user-select: none;
        gap: 0;
        padding: 4px 0 2px;
    }
    .nk-key:active {
        background: #d1d5db;
        transform: scale(0.96);
    }

    .nk-num {
        font-size: 22px;
        font-weight: 400;
        line-height: 1.1;
        color: #1a1a2e;
    }
    .nk-sub {
        font-size: 9px;
        font-weight: 600;
        letter-spacing: 1.5px;
        color: #6b7280;
        line-height: 1;
    }

    .nk-key-empty {
        background: transparent;
        box-shadow: none;
        cursor: default;
    }
    .nk-key-empty:active {
        background: transparent;
        transform: none;
    }
    .nk-key-action {
        background: #c8c9cc;
    }
    .nk-key-action:active {
        background: #b0b1b4;
    }

    /* Hide keyboard on real mobile */
    @media (max-width: 768px) {
        .numeric-keyboard {
            display: none !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
(function() {
    // ===== OTP Logic =====
    const boxes = document.querySelectorAll('.otp-box');
    const hiddenInput = document.getElementById('otpHidden');
    const submitBtn = document.getElementById('submitBtn');
    const keyboard = document.getElementById('numericKeyboard');
    const otpForm = document.getElementById('otpForm');
    let otpValues = ['', '', '', '', '', ''];
    let currentIndex = 0;
    let keyboardVisible = false;

    // Prevent keyboard from stealing focus
    keyboard.addEventListener('mousedown', (e) => {
        e.preventDefault();
    });

    // Click on OTP box
    boxes.forEach((box, index) => {
        box.addEventListener('click', () => {
            setActiveBox(index);
            showKeyboard();
        });
    });

    // Auto-show keyboard on page load with slight delay
    setTimeout(() => {
        setActiveBox(0);
        showKeyboard();
    }, 500);

    function setActiveBox(index) {
        if (index < 0 || index > 5) return;
        currentIndex = index;
        boxes.forEach((b, i) => {
            b.classList.remove('active');
            if (i === index) {
                b.classList.add('active');
                if (otpValues[i]) b.classList.add('has-value');
                else b.classList.remove('has-value');
            }
        });
    }

    function showKeyboard() {
        keyboard.classList.remove('hidden');
        keyboardVisible = true;
    }

    function hideKeyboard() {
        keyboard.classList.add('hidden');
        keyboardVisible = false;
        boxes.forEach(b => b.classList.remove('active'));
    }

    function updateOTP() {
        const code = otpValues.join('');
        hiddenInput.value = code;

        // Update box appearances
        boxes.forEach((box, i) => {
            box.textContent = otpValues[i];
            if (otpValues[i]) {
                box.classList.add('filled');
            } else {
                box.classList.remove('filled');
            }
        });

        // Toggle submit button
        if (code.length === 6 && !code.includes('')) {
            const allFilled = otpValues.every(v => v !== '');
            if (allFilled) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('otp-btn-disabled');
                submitBtn.classList.add('otp-btn-enabled');
                submitBtn.textContent = 'Sign Up Now';
            }
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('otp-btn-disabled');
            submitBtn.classList.remove('otp-btn-enabled');
        }
    }

    // Handle numeric keyboard click
    keyboard.addEventListener('click', (e) => {
        const btn = e.target.closest('.nk-key');
        if (!btn) return;

        const key = btn.dataset.key;
        const action = btn.dataset.action;

        if (key !== undefined) {
            // Type digit
            if (currentIndex <= 5) {
                otpValues[currentIndex] = key;
                updateOTP();

                if (currentIndex < 5) {
                    setActiveBox(currentIndex + 1);
                } else {
                    // All filled, keep last box active with value
                    boxes[currentIndex].classList.add('has-value');
                }
            }
        } else if (action === 'backspace') {
            if (otpValues[currentIndex]) {
                otpValues[currentIndex] = '';
                updateOTP();
                setActiveBox(currentIndex);
            } else if (currentIndex > 0) {
                currentIndex--;
                otpValues[currentIndex] = '';
                updateOTP();
                setActiveBox(currentIndex);
            }
        }
    });

    // Click outside to hide keyboard
    document.addEventListener('click', (e) => {
        if (!keyboard.contains(e.target) && !e.target.closest('.otp-box') && !e.target.closest('#otpBoxes')) {
            hideKeyboard();
        }
    });

    // Also handle real keyboard input for accessibility
    document.addEventListener('keydown', (e) => {
        if (!keyboardVisible) return;

        if (/^\d$/.test(e.key)) {
            if (currentIndex <= 5) {
                otpValues[currentIndex] = e.key;
                updateOTP();
                if (currentIndex < 5) setActiveBox(currentIndex + 1);
                else boxes[currentIndex].classList.add('has-value');
            }
        } else if (e.key === 'Backspace') {
            if (otpValues[currentIndex]) {
                otpValues[currentIndex] = '';
                updateOTP();
                setActiveBox(currentIndex);
            } else if (currentIndex > 0) {
                currentIndex--;
                otpValues[currentIndex] = '';
                updateOTP();
                setActiveBox(currentIndex);
            }
        } else if (e.key === 'Enter') {
            if (!submitBtn.disabled) otpForm.submit();
        }
    });

    // ===== Countdown Timer =====
    let seconds = 60;
    const countdownEl = document.getElementById('countdown');
    const countdownText = document.getElementById('countdownText');
    const resendForm = document.getElementById('resendForm');

    const timer = setInterval(() => {
        seconds--;
        if (countdownEl) countdownEl.textContent = seconds;
        if (seconds <= 0) {
            clearInterval(timer);
            if (countdownText) countdownText.classList.add('hidden');
            if (resendForm) resendForm.classList.remove('hidden');
        }
    }, 1000);

})();
</script>
@endpush
