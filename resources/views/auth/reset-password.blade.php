@extends('layouts.mobile-emulator')

@section('title', 'Reset Password - FilkomCare')
@section('page-name', 'Reset Password')

@section('content')
    <div class="w-full min-h-screen bg-white flex flex-col relative">
        <div class="flex-1 flex flex-col px-7 pt-16">
            <div class="mb-8">
                <h1 class="text-[24px] font-bold text-[#3d4a5e] leading-tight mb-2">Kata Sandi Baru</h1>
                <p class="text-[14px] text-gray-500 font-light">
                    Silakan masukkan kata sandi baru Anda. Pastikan kata sandi kuat dan mudah diingat.
                </p>
            </div>

            <form action="{{ route('password.update') }}" method="POST" id="resetPasswordForm">
                @csrf

                @if ($errors->any())
                    <div class="bg-red-50 border border-danger/20 text-danger p-3 rounded-xl text-[11px] mb-4">
                        <ul class="list-disc pl-4 space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Password Input --}}
                <div class="mb-3">
                    <div class="bg-gray-50 rounded-2xl px-5 py-3.5 border border-gray-100 flex items-center transition-all duration-200 keyboard-input-wrap">
                        <input type="password" name="password" id="passwordInput" required minlength="8"
                            placeholder="Input your new password" 
                            class="w-full bg-transparent text-[#3d4a5e] placeholder-gray-400 text-[13px] focus:outline-none font-normal flex-1 keyboard-input"
                            data-keyboard="alpha"
                            autocomplete="new-password">
                        <button type="button" onclick="togglePassword('passwordInput', 'eyeIcon1', 'eyeOffIcon1')" class="ml-2 text-gray-400 hover:text-[#3d4a5e] transition focus:outline-none">
                            <svg id="eyeIcon1" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eyeOffIcon1" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Confirm Password Input --}}
                <div class="mb-8">
                    <div class="bg-gray-50 rounded-2xl px-5 py-3.5 border border-gray-100 flex items-center transition-all duration-200 keyboard-input-wrap">
                        <input type="password" name="password_confirmation" id="confirmPasswordInput" required minlength="8"
                            placeholder="Confirm your new password" 
                            class="w-full bg-transparent text-[#3d4a5e] placeholder-gray-400 text-[13px] focus:outline-none font-normal flex-1 keyboard-input"
                            data-keyboard="alpha"
                            autocomplete="new-password">
                        <button type="button" onclick="togglePassword('confirmPasswordInput', 'eyeIcon2', 'eyeOffIcon2')" class="ml-2 text-gray-400 hover:text-[#3d4a5e] transition focus:outline-none">
                            <svg id="eyeIcon2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eyeOffIcon2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" id="submitBtn" disabled
                    class="w-full bg-[#d1d5db] text-[#9ca3af] font-bold text-[15px] py-4 rounded-2xl shadow-sm transition-all duration-300 transform cursor-not-allowed">
                    Simpan Password Baru
                </button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    function togglePassword(inputId, eyeId, eyeOffId) {
        const input = document.getElementById(inputId);
        const eyeIcon = document.getElementById(eyeId);
        const eyeOffIcon = document.getElementById(eyeOffId);
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

    (function() {
        const passwordInput = document.getElementById('passwordInput');
        const confirmInput = document.getElementById('confirmPasswordInput');
        const submitBtn = document.getElementById('submitBtn');

        function checkForm() {
            const allFilled = passwordInput.value !== '' && confirmInput.value !== '';
            
            if (allFilled) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('bg-[#d1d5db]', 'text-[#9ca3af]', 'cursor-not-allowed');
                submitBtn.classList.add('bg-[#87B4B8]', 'text-white', 'hover:shadow-lg', 'hover:-translate-y-0.5', 'active:scale-95', 'active:bg-[#5A8A8E]');
            } else {
                submitBtn.disabled = true;
                submitBtn.classList.add('bg-[#d1d5db]', 'text-[#9ca3af]', 'cursor-not-allowed');
                submitBtn.classList.remove('bg-[#87B4B8]', 'text-white', 'hover:shadow-lg', 'hover:-translate-y-0.5', 'active:scale-95', 'active:bg-[#5A8A8E]');
            }
        }

        [passwordInput, confirmInput].forEach(input => {
            input.addEventListener('input', checkForm);
            input.addEventListener('change', checkForm);
        });
    })();
</script>
@endpush
