@extends('layouts.mobile-emulator')

@section('title', 'Login - FilkomCare')
@section('page-name', 'Login')

@section('content')
    {{-- Mobile App Container --}}
    <div class="w-full min-h-screen bg-white flex flex-col relative" id="loginContainer">
        
        {{-- Content Area --}}
        <div class="flex-1 flex flex-col px-7 pt-16" id="loginContent">

            {{-- Logo --}}
            <div class="flex justify-center mb-8">
                <img src="{{ asset('images/logo-filkomcare.png') }}" alt="FilkomCare" class="h-[85px] w-auto object-contain">
            </div>

            {{-- Title Section - Left aligned --}}
            <div class="mb-6">
                <h1 class="text-[26px] font-bold text-slate-dark leading-tight">Login</h1>
                <p class="text-[13px] text-gray-400 mt-1 font-light">Login ke akun FilkomCare</p>
            </div>

            {{-- Form --}}
            <form action="{{ route('login') }}" method="POST" class="w-full" id="loginForm">
                @csrf

                {{-- Error Messages --}}
                @if (session('success'))
                    <div class="bg-green-50 border border-success/20 text-success p-3 rounded-xl text-[11px] mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('info'))
                    <div class="bg-blue-50 border border-sky-deeper/20 text-sky-deeper p-3 rounded-xl text-[11px] mb-4">
                        {{ session('info') }}
                    </div>
                @endif

                @if ($errors->has('login_error'))
                    <div class="bg-red-50 border border-danger/20 text-danger p-3 rounded-xl text-[11px] mb-4">
                        {{ $errors->first('login_error') }}
                    </div>
                @endif

                @if ($errors->any() && !$errors->has('login_error'))
                    <div class="bg-red-50 border border-danger/20 text-danger p-3 rounded-xl text-[11px] mb-4">
                        <ul class="list-disc pl-4 space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- NIM / Email Input --}}
                <div class="mb-1">
                    <div class="bg-gray-50 rounded-2xl px-5 py-3.5 border border-gray-100 transition-all duration-200 keyboard-input-wrap">
                        <input type="text" name="nim" value="{{ old('nim') }}" required
                            placeholder="Input your NIM number or email" 
                            class="w-full bg-transparent text-slate-dark placeholder-gray-400 text-[13px] focus:outline-none font-normal keyboard-input"
                            data-keyboard="alpha"
                            autocomplete="off">
                    </div>
                    <p class="text-[10px] text-gray-300 mt-1.5 ml-1 font-light">Gunakan email UB aktif (@student.ub.ac.id)</p>
                </div>

                {{-- Password Input --}}
                <div class="mb-4 mt-3">
                    <div class="bg-gray-50 rounded-2xl px-5 py-3.5 border border-gray-100 flex items-center transition-all duration-200 keyboard-input-wrap">
                        <input type="password" name="password" id="passwordInput" required
                            placeholder="Input your password" 
                            class="w-full bg-transparent text-slate-dark placeholder-gray-400 text-[13px] focus:outline-none font-normal flex-1 keyboard-input"
                            data-keyboard="alpha"
                            autocomplete="off">
                        <button type="button" onclick="togglePassword()" class="ml-2 text-gray-400 hover:text-slate-dark transition focus:outline-none">
                            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eyeOffIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center mb-6 pl-1">
                    <input id="remember" type="checkbox" name="remember" class="w-4 h-4 text-[#87B4B8] bg-gray-100 border-gray-300 rounded focus:ring-[#87B4B8] focus:ring-2">
                    <label for="remember" class="ml-2 text-[12px] font-medium text-gray-500">Ingat Saya</label>
                </div>

                {{-- Login Button --}}
                <button type="submit" 
                    class="w-full bg-[#87B4B8] hover:bg-[#76a2a6] active:bg-[#5A8A8E] text-white font-bold text-[15px] py-4 rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 active:scale-95 active:translate-y-0">
                    Login Now
                </button>

                {{-- Forgot Password --}}
                <div class="text-center mt-5">
                    <a href="#" class="text-[13px] text-slate-dark font-semibold hover:text-[#87B4B8] transition-all inline-block hover:scale-105">
                        Forgot password?
                    </a>
                </div>
            </form>

        </div>

        {{-- Bottom Link --}}
        <div class="w-full text-center pb-10 pt-6">
            <p class="text-[12px] text-gray-400 font-normal">
                Kamu belum punya akun? 
                <a href="{{ url('/register') }}" class="text-slate-dark font-bold hover:text-[#87B4B8] transition-all inline-block hover:scale-105 ml-1">Sign up now</a>
            </p>
        </div>

        {{-- ===== Virtual Keyboard ===== --}}
        <div id="virtualKeyboard" class="virtual-keyboard hidden">
            {{-- QWERTY Layout --}}
            <div id="kbAlpha">
                <div class="kb-row">
                    <button type="button" class="kb-key" data-key="q">Q</button>
                    <button type="button" class="kb-key" data-key="w">W</button>
                    <button type="button" class="kb-key" data-key="e">E</button>
                    <button type="button" class="kb-key" data-key="r">R</button>
                    <button type="button" class="kb-key" data-key="t">T</button>
                    <button type="button" class="kb-key" data-key="y">Y</button>
                    <button type="button" class="kb-key" data-key="u">U</button>
                    <button type="button" class="kb-key" data-key="i">I</button>
                    <button type="button" class="kb-key" data-key="o">O</button>
                    <button type="button" class="kb-key" data-key="p">P</button>
                </div>
                <div class="kb-row">
                    <div class="kb-spacer-half"></div>
                    <button type="button" class="kb-key" data-key="a">A</button>
                    <button type="button" class="kb-key" data-key="s">S</button>
                    <button type="button" class="kb-key" data-key="d">D</button>
                    <button type="button" class="kb-key" data-key="f">F</button>
                    <button type="button" class="kb-key" data-key="g">G</button>
                    <button type="button" class="kb-key" data-key="h">H</button>
                    <button type="button" class="kb-key" data-key="j">J</button>
                    <button type="button" class="kb-key" data-key="k">K</button>
                    <button type="button" class="kb-key" data-key="l">L</button>
                    <div class="kb-spacer-half"></div>
                </div>
                <div class="kb-row">
                    <button type="button" class="kb-key kb-key-wide kb-key-special" id="shiftKey" data-action="shift">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19V5M5 12l7-7 7 7"/></svg>
                    </button>
                    <button type="button" class="kb-key" data-key="z">Z</button>
                    <button type="button" class="kb-key" data-key="x">X</button>
                    <button type="button" class="kb-key" data-key="c">C</button>
                    <button type="button" class="kb-key" data-key="v">V</button>
                    <button type="button" class="kb-key" data-key="b">B</button>
                    <button type="button" class="kb-key" data-key="n">N</button>
                    <button type="button" class="kb-key" data-key="m">M</button>
                    <button type="button" class="kb-key kb-key-wide kb-key-special" data-action="backspace">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 4H8l-7 8 7 8h13a2 2 0 002-2V6a2 2 0 00-2-2z"/><line x1="18" y1="9" x2="12" y2="15"/><line x1="12" y1="9" x2="18" y2="15"/></svg>
                    </button>
                </div>
                <div class="kb-row">
                    <button type="button" class="kb-key kb-key-wide kb-key-special" data-action="numbers">123</button>
                    <button type="button" class="kb-key kb-key-space" data-key=" ">space</button>
                    <button type="button" class="kb-key kb-key-wide kb-key-special" data-action="enter">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 10 4 15 9 20"/><path d="M20 4v7a4 4 0 01-4 4H4"/></svg>
                    </button>
                </div>
                <div class="kb-row kb-bottom-row">
                    <button type="button" class="kb-key kb-key-icon" data-key="">😊</button>
                    <div class="flex-1"></div>
                    <button type="button" class="kb-key kb-key-icon" data-key="">🎤</button>
                </div>
            </div>

            {{-- Numbers Layout --}}
            <div id="kbNumbers" class="hidden">
                <div class="kb-row">
                    <button type="button" class="kb-key" data-key="1">1</button>
                    <button type="button" class="kb-key" data-key="2">2</button>
                    <button type="button" class="kb-key" data-key="3">3</button>
                    <button type="button" class="kb-key" data-key="4">4</button>
                    <button type="button" class="kb-key" data-key="5">5</button>
                    <button type="button" class="kb-key" data-key="6">6</button>
                    <button type="button" class="kb-key" data-key="7">7</button>
                    <button type="button" class="kb-key" data-key="8">8</button>
                    <button type="button" class="kb-key" data-key="9">9</button>
                    <button type="button" class="kb-key" data-key="0">0</button>
                </div>
                <div class="kb-row">
                    <button type="button" class="kb-key" data-key="-">-</button>
                    <button type="button" class="kb-key" data-key="/">/</button>
                    <button type="button" class="kb-key" data-key=":">:</button>
                    <button type="button" class="kb-key" data-key=";">;</button>
                    <button type="button" class="kb-key" data-key="(">(</button>
                    <button type="button" class="kb-key" data-key=")">)</button>
                    <button type="button" class="kb-key" data-key="@">@</button>
                    <button type="button" class="kb-key" data-key="&">&amp;</button>
                    <button type="button" class="kb-key" data-key=".">.</button>
                    <button type="button" class="kb-key" data-key=",">,</button>
                </div>
                <div class="kb-row">
                    <button type="button" class="kb-key kb-key-wide kb-key-special" data-action="backspace">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 4H8l-7 8 7 8h13a2 2 0 002-2V6a2 2 0 00-2-2z"/><line x1="18" y1="9" x2="12" y2="15"/><line x1="12" y1="9" x2="18" y2="15"/></svg>
                    </button>
                </div>
                <div class="kb-row">
                    <button type="button" class="kb-key kb-key-wide kb-key-special" data-action="alpha">ABC</button>
                    <button type="button" class="kb-key kb-key-space" data-key=" ">space</button>
                    <button type="button" class="kb-key kb-key-wide kb-key-special" data-action="enter">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 10 4 15 9 20"/><path d="M20 4v7a4 4 0 01-4 4H4"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
<style>
    /* ===== Virtual Keyboard Styles ===== */
    .virtual-keyboard {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: #d1d5db;
        padding: 8px 3px 4px;
        z-index: 50;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.3s ease;
        transform: translateY(0);
        opacity: 1;
        border-top: 1px solid #c5c5c5;
    }
    .virtual-keyboard.hidden {
        transform: translateY(100%);
        opacity: 0;
        pointer-events: none;
    }

    .kb-row {
        display: flex;
        justify-content: center;
        gap: 5px;
        margin-bottom: 6px;
    }
    .kb-bottom-row {
        margin-bottom: 2px;
        padding: 0 8px;
    }

    .kb-key {
        min-width: 30px;
        height: 42px;
        border-radius: 6px;
        border: none;
        background: #ffffff;
        color: #1a1a2e;
        font-size: 16px;
        font-weight: 500;
        font-family: 'Poppins', -apple-system, sans-serif;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12);
        transition: background 0.1s ease, transform 0.1s ease;
        flex: 1;
        -webkit-user-select: none;
        user-select: none;
        padding: 0 2px;
    }
    .kb-key:active {
        background: #e5e7eb;
        transform: scale(0.95);
    }
    .kb-key-wide {
        flex: 1.4;
    }
    .kb-key-special {
        background: #adb5bd;
        color: #1a1a2e;
        font-size: 13px;
        font-weight: 600;
    }
    .kb-key-special:active {
        background: #9ca3af;
    }
    .kb-key-space {
        flex: 4;
        font-size: 13px;
        color: #6b7280;
        letter-spacing: 1px;
    }
    .kb-key-icon {
        background: transparent;
        box-shadow: none;
        font-size: 22px;
        flex: 0;
        min-width: 40px;
    }
    .kb-key-icon:active {
        background: transparent;
    }
    .kb-spacer-half {
        flex: 0.5;
    }

    /* Focus style for inputs when keyboard is visible */
    .keyboard-input-wrap.kb-focused {
        border-color: #87B4B8 !important;
        box-shadow: 0 0 0 2px rgba(135, 180, 184, 0.15);
    }

    /* Hide keyboard on real mobile devices */
    @media (max-width: 768px) {
        .virtual-keyboard {
            display: none !important;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // ===== Toggle Password =====
    function togglePassword() {
        const input = document.getElementById('passwordInput');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');
        if (input.type === 'password') {
            input.type = 'text';
            eyeIcon.classList.add('hidden');
            eyeOffIcon.classList.remove('hidden');
        } else {
            input.type = 'password';
            eyeIcon.classList.remove('hidden');
            eyeOffIcon.classList.add('hidden');
        }
    }

    // ===== Virtual Keyboard Logic =====
    (function() {
        const keyboard = document.getElementById('virtualKeyboard');
        const kbAlpha = document.getElementById('kbAlpha');
        const kbNumbers = document.getElementById('kbNumbers');
        const shiftKey = document.getElementById('shiftKey');
        const inputs = document.querySelectorAll('.keyboard-input');
        let activeInput = null;
        let isShifted = true; // Start with shift ON (uppercase)
        let isNumberMode = false;

        // Prevent default focus behavior on keyboard buttons
        keyboard.addEventListener('mousedown', (e) => {
            e.preventDefault(); // Prevent blur on active input
        });

        // Show keyboard on input focus
        inputs.forEach(input => {
            input.addEventListener('focus', () => {
                activeInput = input;
                keyboard.classList.remove('hidden');
                // Add focus styling
                input.closest('.keyboard-input-wrap')?.classList.add('kb-focused');
                // Scroll content up a bit
                setTimeout(() => {
                    input.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }, 100);
            });

            input.addEventListener('blur', () => {
                input.closest('.keyboard-input-wrap')?.classList.remove('kb-focused');
            });
        });

        // Handle key press
        keyboard.addEventListener('click', (e) => {
            const btn = e.target.closest('.kb-key');
            if (!btn || !activeInput) return;

            const key = btn.dataset.key;
            const action = btn.dataset.action;

            if (key !== undefined && key !== '') {
                // Insert character
                const start = activeInput.selectionStart;
                const end = activeInput.selectionEnd;
                const val = activeInput.value;
                let char = key;

                // Apply shift
                if (!isNumberMode && char.length === 1 && char !== ' ') {
                    char = isShifted ? char.toUpperCase() : char.toLowerCase();
                }

                activeInput.value = val.substring(0, start) + char + val.substring(end);
                activeInput.selectionStart = activeInput.selectionEnd = start + char.length;
                activeInput.dispatchEvent(new Event('input', { bubbles: true }));

                // Auto-disable shift after first char
                if (isShifted && !isNumberMode) {
                    isShifted = false;
                    updateKeyLabels();
                }
            } else if (action) {
                handleAction(action);
            }
        });

        function handleAction(action) {
            switch (action) {
                case 'backspace':
                    if (activeInput) {
                        const start = activeInput.selectionStart;
                        const end = activeInput.selectionEnd;
                        const val = activeInput.value;
                        if (start === end && start > 0) {
                            activeInput.value = val.substring(0, start - 1) + val.substring(end);
                            activeInput.selectionStart = activeInput.selectionEnd = start - 1;
                        } else if (start !== end) {
                            activeInput.value = val.substring(0, start) + val.substring(end);
                            activeInput.selectionStart = activeInput.selectionEnd = start;
                        }
                        activeInput.dispatchEvent(new Event('input', { bubbles: true }));
                    }
                    break;

                case 'shift':
                    isShifted = !isShifted;
                    updateKeyLabels();
                    break;

                case 'numbers':
                    isNumberMode = true;
                    kbAlpha.classList.add('hidden');
                    kbNumbers.classList.remove('hidden');
                    break;

                case 'alpha':
                    isNumberMode = false;
                    kbNumbers.classList.add('hidden');
                    kbAlpha.classList.remove('hidden');
                    break;

                case 'enter':
                    // Submit the form
                    document.getElementById('loginForm')?.submit();
                    break;
            }
        }

        function updateKeyLabels() {
            kbAlpha.querySelectorAll('.kb-key[data-key]').forEach(btn => {
                const key = btn.dataset.key;
                if (key && key.length === 1 && key !== ' ') {
                    btn.textContent = isShifted ? key.toUpperCase() : key.toLowerCase();
                }
            });
            // Update shift key appearance
            if (shiftKey) {
                shiftKey.style.background = isShifted ? '#ffffff' : '#adb5bd';
            }
        }

        // Hide keyboard when clicking outside
        document.addEventListener('click', (e) => {
            if (!keyboard.contains(e.target) && !e.target.classList.contains('keyboard-input')) {
                keyboard.classList.add('hidden');
                activeInput = null;
                document.querySelectorAll('.kb-focused').forEach(el => el.classList.remove('kb-focused'));
            }
        });
    })();
</script>
@endpush
