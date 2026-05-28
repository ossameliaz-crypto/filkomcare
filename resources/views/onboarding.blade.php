@extends('layouts.mobile-emulator')

@section('title', 'Welcome - FilkomCare')
@section('page-name', 'Onboarding')

@section('content')
    <div class="w-full min-h-screen bg-white flex flex-col relative overflow-hidden" id="onboardingContainer">

        {{-- Slides Container --}}
        <div class="w-full h-screen relative" id="slidesWrapper">

            {{-- ===== Slide 1: Splash Logo ===== --}}
            <div class="onboarding-slide active" data-slide="0">
                {{-- Skip --}}
                <div class="skip-btn-wrap">
                    <button type="button" class="skip-btn" onclick="skipOnboarding()">
                        Skip <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </button>
                </div>

                <div class="slide-content slide-center">
                    <div class="splash-logo-wrapper">
                        <img src="{{ asset('images/logo-filkomcare.png') }}" alt="FilkomCare" class="splash-logo">
                    </div>
                </div>
            </div>

            {{-- ===== Slide 2: Layanan Lengkap ===== --}}
            <div class="onboarding-slide" data-slide="1">
                {{-- Skip --}}
                <div class="skip-btn-wrap">
                    <button type="button" class="skip-btn" onclick="skipOnboarding()">
                        Skip <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </button>
                </div>

                <div class="slide-content">
                    <div class="slide-illustration">
                        <img src="{{ asset('images/onboarding-selfcare.png') }}" alt="Layanan Lengkap">
                    </div>
                    <div class="slide-text">
                        <h2 class="slide-title">Layanan Lengkap</h2>
                        <p class="slide-subtitle">Jaga kesehatan mentalmu dengan berbagai fitur yang tersedia</p>
                    </div>
                </div>
            </div>

            {{-- ===== Slide 3: Buat Dirimu Tenang ===== --}}
            <div class="onboarding-slide" data-slide="2">
                {{-- Skip --}}
                <div class="skip-btn-wrap">
                    <button type="button" class="skip-btn" onclick="skipOnboarding()">
                        Skip <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                    </button>
                </div>

                <div class="slide-content" style="padding-top: 50px;">
                    <div class="slide-illustration" style="max-width: 250px; margin-bottom: 60px;">
                        <img src="{{ asset('images/onboarding-meditation.png') }}" alt="Buat Dirimu Tenang">
                    </div>
                    <div class="slide-text">
                        <h2 class="slide-title">Buat Dirimu Tenang</h2>
                        <p class="slide-subtitle">Jalani hari dengan lebih mindful bersama FilkomCare</p>
                    </div>
                </div>
            </div>

        </div>

        {{-- Bottom Section (Button + Dots) --}}
        <div class="onboarding-bottom absolute bottom-0 left-0 w-full z-10">
            {{-- Lanjut Button --}}
            <button type="button" id="nextBtn" class="lanjut-btn" onclick="nextSlide()">
                Lanjut
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
            </button>

            {{-- Dot Indicators --}}
            <div class="dot-indicators" id="dotIndicators">
                <span class="dot active" data-dot="0"></span>
                <span class="dot" data-dot="1"></span>
                <span class="dot" data-dot="2"></span>
            </div>
        </div>

    </div>
@endsection

@push('styles')
<style>
    /* ===== Slides ===== */
    .onboarding-slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        opacity: 0;
        transform: translateX(60px);
        transition: opacity 0.5s ease, transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        pointer-events: none;
    }
    .onboarding-slide.active {
        opacity: 1;
        transform: translateX(0);
        pointer-events: auto;
    }
    .onboarding-slide.exit-left {
        opacity: 0;
        transform: translateX(-60px);
        pointer-events: none;
    }

    /* Skip button */
    .skip-btn-wrap {
        position: absolute;
        top: 54px;
        right: 24px;
        z-index: 20;
    }
    .skip-btn {
        display: flex;
        align-items: center;
        gap: 2px;
        font-size: 13px;
        font-weight: 500;
        color: #3d4a5e;
        background: none;
        border: none;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        padding: 6px 0;
        transition: color 0.2s ease;
    }
    .skip-btn:hover {
        color: #87B4B8;
    }

    .slide-content {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 0 32px 100px;
    }
    .slide-center {
        padding: 40px 32px 0;
    }

    /* Splash Logo */
    .splash-logo-wrapper {
        animation: logoAppear 1s cubic-bezier(0.34, 1.56, 0.64, 1) both;
    }
    .splash-logo {
        width: 320px;
        max-width: 90vw;
        height: auto;
        object-fit: contain;
    }
    @keyframes logoAppear {
        0% { opacity: 0; transform: scale(0.7); }
        100% { opacity: 1; transform: scale(1); }
    }

    /* Illustration */
    .slide-illustration {
        width: 100%;
        max-width: 280px;
        margin-bottom: 24px;
        animation: illustrationFloat 3s ease-in-out infinite;
    }
    .slide-illustration img {
        width: 100%;
        height: auto;
        object-fit: contain;
    }
    @keyframes illustrationFloat {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }

    /* Text */
    .slide-text {
        text-align: center;
        padding: 0 8px;
    }
    .slide-title {
        font-size: 24px;
        font-weight: 700;
        color: #3d4a5e;
        margin: 0 0 10px;
        line-height: 1.3;
    }
    .slide-subtitle {
        font-size: 15px;
        font-weight: 300;
        color: #9ca3af;
        line-height: 1.6;
        margin: 0;
        max-width: 260px;
        margin: 0 auto;
    }

    /* ===== Bottom Section ===== */
    .onboarding-bottom {
        padding: 0 28px 24px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 16px;
    }

    /* Lanjut Button */
    .lanjut-btn {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: #87B4B8;
        color: #ffffff;
        font-size: 15px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        padding: 16px;
        border-radius: 16px;
        border: none;
        cursor: pointer;
        transition: all 0.2s ease;
        box-shadow: 0 2px 12px rgba(135, 180, 184, 0.3);
    }
    .lanjut-btn:hover {
        background: #76a2a6;
    }
    .lanjut-btn:active {
        background: #5A8A8E;
        transform: scale(0.98);
    }

    /* Dot Indicators */
    .dot-indicators {
        display: flex;
        gap: 6px;
        align-items: center;
    }
    .dot {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: #cbd5e1;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .dot.active {
        width: 20px;
        border-radius: 4px;
        background: #1a1a2e;
    }
</style>
@endpush

@push('scripts')
<script>
(function() {
    const slides = document.querySelectorAll('.onboarding-slide');
    const dots = document.querySelectorAll('.dot');
    const totalSlides = slides.length;
    let currentSlide = 0;
    let isAnimating = false;

    // Auto-advance from splash after 3 seconds
    const autoTimer = setTimeout(() => {
        if (currentSlide === 0) {
            nextSlide();
        }
    }, 3000);

    window.nextSlide = function() {
        if (isAnimating) return;

        if (currentSlide === 0) {
            clearTimeout(autoTimer);
        }

        if (currentSlide >= totalSlides - 1) {
            // Last slide → go to login
            skipOnboarding();
            return;
        }

        isAnimating = true;

        // Exit current slide
        slides[currentSlide].classList.remove('active');
        slides[currentSlide].classList.add('exit-left');

        // Advance
        currentSlide++;

        // Enter new slide
        slides[currentSlide].classList.remove('exit-left');
        slides[currentSlide].classList.add('active');

        // Update dots
        updateDots();

        setTimeout(() => {
            isAnimating = false;
        }, 500);
    };

    window.skipOnboarding = function() {
        // Redirect to complete route which sets session and goes to login
        window.location.href = '{{ route("onboarding.complete") }}';
    };

    function updateDots() {
        dots.forEach((dot, i) => {
            if (i === currentSlide) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });
    }

    // Swipe support
    let touchStartX = 0;
    let touchEndX = 0;

    const container = document.getElementById('onboardingContainer');

    container.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    container.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, { passive: true });

    function handleSwipe() {
        const diff = touchStartX - touchEndX;
        if (Math.abs(diff) > 50) {
            if (diff > 0) {
                // Swipe left → next
                nextSlide();
            }
            // No swipe right (back) in onboarding
        }
    }
})();
</script>
@endpush
