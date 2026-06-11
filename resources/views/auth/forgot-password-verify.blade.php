@extends('layouts.mobile-emulator')

@section('title', 'Verify OTP - FilkomCare')
@section('page-name', 'Verify OTP')

@section('content')
    <div class="w-full min-h-screen bg-white flex flex-col relative">
        <div class="flex-1 flex flex-col px-7 pt-16">
            <div class="mb-8">
                <h1 class="text-[24px] font-bold text-[#3d4a5e] leading-tight mb-2">Verifikasi Email</h1>
                <p class="text-[14px] text-gray-500 font-light">
                    Masukkan 6 digit kode OTP yang telah dikirimkan ke <br>
                    <span class="font-semibold text-[#87B4B8]">{{ $user->email }}</span>
                </p>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border border-danger/20 text-danger p-3 rounded-xl text-[12px] mb-6">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('password.verify.post') }}" method="POST" id="verifyForm">
                @csrf
                <input type="hidden" name="code" id="actualCode">

                <div class="flex justify-between gap-1.5 mb-8" id="otpContainer">
                    @for($i = 0; $i < 6; $i++)
                        <input type="text" maxlength="1" class="otp-input flex-1 min-w-0 h-12 bg-gray-50 border border-gray-200 rounded-xl text-center text-[20px] font-bold text-[#3d4a5e] focus:outline-none focus:border-[#87B4B8] focus:ring-2 focus:ring-[#87B4B8]/20 transition-all keyboard-input shadow-sm" data-keyboard="numbers" inputmode="numeric">
                    @endfor
                </div>

                <button type="submit" id="verifyBtn" disabled
                    class="w-full font-bold text-[15px] py-4 rounded-2xl shadow-sm transition-all duration-300 transform bg-[#d1d5db] text-[#9ca3af] cursor-not-allowed mb-6">
                    Verifikasi Kode
                </button>
            </form>
            
            <div class="text-center">
                <a href="{{ route('password.request') }}" class="text-[13px] text-[#3d4a5e] font-semibold hover:text-[#87B4B8] transition-all">
                    Kirim ulang kode OTP?
                </a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('.otp-input');
        const actualCode = document.getElementById('actualCode');
        const verifyBtn = document.getElementById('verifyBtn');

        function checkComplete() {
            let code = '';
            inputs.forEach(input => code += input.value);
            actualCode.value = code;

            if(code.length === 6) {
                verifyBtn.disabled = false;
                verifyBtn.classList.remove('bg-[#d1d5db]', 'text-[#9ca3af]', 'cursor-not-allowed');
                verifyBtn.classList.add('bg-[#87B4B8]', 'text-white', 'hover:shadow-lg', 'hover:-translate-y-0.5');
            } else {
                verifyBtn.disabled = true;
                verifyBtn.classList.add('bg-[#d1d5db]', 'text-[#9ca3af]', 'cursor-not-allowed');
                verifyBtn.classList.remove('bg-[#87B4B8]', 'text-white', 'hover:shadow-lg', 'hover:-translate-y-0.5');
            }
        }

        inputs.forEach((input, index) => {
            input.addEventListener('input', function(e) {
                if(this.value.length > 1) this.value = this.value.slice(0, 1);
                this.value = this.value.replace(/[^0-9]/g, '');
                
                if(this.value && index < 5) {
                    inputs[index + 1].focus();
                }
                checkComplete();
            });

            input.addEventListener('keydown', function(e) {
                if(e.key === 'Backspace' && !this.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });
            
            // Handle paste
            input.addEventListener('paste', function(e) {
                e.preventDefault();
                const pastedData = e.clipboardData.getData('text').replace(/[^0-9]/g, '').slice(0, 6);
                
                for(let i = 0; i < pastedData.length; i++) {
                    if(inputs[index + i]) {
                        inputs[index + i].value = pastedData[i];
                    }
                }
                
                if(index + pastedData.length < 6) {
                    inputs[index + pastedData.length].focus();
                } else {
                    inputs[5].focus();
                }
                checkComplete();
            });
        });
    });
</script>
@endpush
