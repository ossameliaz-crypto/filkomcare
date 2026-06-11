@extends('layouts.mobile-emulator')

@section('title', 'Forgot Password - FilkomCare')
@section('page-name', 'Forgot Password')

@section('content')
    <div class="w-full min-h-screen bg-white flex flex-col relative">
        <div class="flex-1 flex flex-col px-7 pt-16">
            <div class="flex justify-center mb-8">
                <img src="{{ asset('images/logo-filkomcare.png') }}" alt="FilkomCare" class="h-[85px] w-auto object-contain">
            </div>

            <div class="mb-6">
                <h1 class="text-[24px] font-bold text-[#3d4a5e] leading-tight">Forgot Password</h1>
                <p class="text-[14px] text-gray-400 mt-2 font-light">Masukkan email UB Anda. Kami akan mengirimkan 6 digit kode OTP untuk mereset kata sandi Anda.</p>
            </div>

            <form action="{{ route('password.email') }}" method="POST" class="w-full">
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

                <div class="mb-6">
                    <div class="bg-gray-50 rounded-2xl px-5 py-3.5 border border-gray-100 transition-all duration-200 keyboard-input-wrap">
                        <input type="email" name="email" value="{{ old('email') }}" required
                            placeholder="Input your email" 
                            class="w-full bg-transparent text-[#3d4a5e] placeholder-gray-400 text-[13px] focus:outline-none font-normal keyboard-input"
                            data-keyboard="alpha"
                            autocomplete="off">
                    </div>
                    <p class="text-[10px] text-gray-300 mt-1.5 ml-1 font-light">Gunakan email UB aktif (@student.ub.ac.id)</p>
                </div>

                <button type="submit" 
                    class="w-full bg-[#87B4B8] hover:bg-[#76a2a6] active:bg-[#5A8A8E] text-white font-bold text-[15px] py-4 rounded-2xl shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 active:scale-95 active:translate-y-0">
                    Kirim Kode OTP
                </button>
            </form>

            <div class="w-full text-center mt-6">
                <a href="{{ route('login') }}" class="text-[13px] text-[#3d4a5e] font-semibold hover:text-[#87B4B8] transition-all inline-block">
                    &larr; Kembali ke Login
                </a>
            </div>
        </div>
    </div>
@endsection
