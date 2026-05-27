@extends('layouts.mobile-emulator')

@section('title', 'FilkomCare - Privasi & Keamanan')

@section('content')
<div class="relative w-full h-[844px] bg-[#f8f9fa] overflow-hidden flex flex-col">
    
    {{-- Top Bar --}}
    <div class="px-6 pt-12 pb-6 flex items-center gap-4 z-10 bg-white border-b border-gray-100 shadow-sm">
        <a href="{{ route('profile.index') }}" class="text-[#1a1a2e] transition-all duration-300 transform hover:-translate-x-1 hover:text-[#87B4B8]">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        </a>
        <h1 class="text-[#1a1a2e] text-[20px] font-bold">Privasi & Keamanan</h1>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
    <div class="mx-6 mt-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-[13px] font-medium">
        {{ session('success') }}
    </div>
    @endif
    @if($errors->any())
    <div class="mx-6 mt-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-[13px] font-medium">
        {{ $errors->first() }}
    </div>
    @endif

    {{-- Content --}}
    <div class="flex-1 overflow-y-auto px-6 pt-6 pb-20">
        
        <div class="bg-white rounded-[24px] p-6 shadow-sm mb-6 transition-shadow duration-300 hover:shadow-md">
            <h2 class="text-[#87B4B8] font-bold text-[16px] mb-3">Kerahasiaan Data</h2>
            <p class="text-gray-500 text-[14px] leading-relaxed mb-4">
                FilkomCare menjamin sepenuhnya kerahasiaan seluruh data pribadi dan informasi sesi konseling Anda. Data hanya dapat diakses oleh Anda dan konselor yang ditugaskan secara spesifik untuk menangani kasus Anda.
            </p>
            <p class="text-gray-500 text-[14px] leading-relaxed">
                Informasi diagnosis maupun catatan konseling tidak akan pernah dibagikan kepada pihak fakultas, dosen, atau institusi lain tanpa persetujuan tertulis secara eksplisit dari Anda, kecuali jika terdapat risiko keselamatan yang mengancam nyawa.
            </p>
        </div>

        <div class="bg-white rounded-[24px] p-6 shadow-sm mb-6 transition-shadow duration-300 hover:shadow-md">
            <h2 class="text-[#87B4B8] font-bold text-[16px] mb-3">Keamanan Akun</h2>
            <p class="text-gray-500 text-[14px] leading-relaxed mb-5">
                Pastikan Anda selalu menggunakan kata sandi yang kuat dan tidak membagikan kredensial login (Email UB) Anda kepada siapapun.
            </p>

            <form action="{{ route('profile.changePassword') }}" method="POST">
                @csrf
                <div class="flex flex-col gap-5 mt-2">
                    {{-- Current Password --}}
                    <div>
                        <label class="text-[#3d4a5e] text-[13px] font-medium mb-2 block">Password Lama</label>
                        <input type="password" name="current_password" required placeholder="Masukkan password lama" 
                               class="w-full bg-[#f8f9fa] border border-gray-200 text-[#3d4a5e] rounded-xl py-3 px-4 text-[14px] transition-all duration-300 focus:outline-none focus:border-[#87B4B8] focus:ring-2 focus:ring-[#87B4B8]/20 focus:bg-white hover:border-[#bce8ee]">
                        @error('current_password')
                        <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- New Password --}}
                    <div>
                        <label class="text-[#3d4a5e] text-[13px] font-medium mb-2 block">Password Baru</label>
                        <input type="password" name="new_password" required placeholder="Minimal 8 karakter" 
                               class="w-full bg-[#f8f9fa] border border-gray-200 text-[#3d4a5e] rounded-xl py-3 px-4 text-[14px] transition-all duration-300 focus:outline-none focus:border-[#87B4B8] focus:ring-2 focus:ring-[#87B4B8]/20 focus:bg-white hover:border-[#bce8ee]">
                        @error('new_password')
                        <p class="text-red-500 text-[11px] mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label class="text-[#3d4a5e] text-[13px] font-medium mb-2 block">Konfirmasi Password Baru</label>
                        <input type="password" name="new_password_confirmation" required placeholder="Ulangi password baru" 
                               class="w-full bg-[#f8f9fa] border border-gray-200 text-[#3d4a5e] rounded-xl py-3 px-4 text-[14px] transition-all duration-300 focus:outline-none focus:border-[#87B4B8] focus:ring-2 focus:ring-[#87B4B8]/20 focus:bg-white hover:border-[#bce8ee]">
                    </div>

                    <button type="submit" class="w-full bg-[#87B4B8] text-white font-bold py-3.5 rounded-xl text-[14px] hover:bg-[#6ca3a8] transition-all duration-300 shadow-[0_4px_12px_rgba(135,180,184,0.3)] hover:shadow-lg transform hover:-translate-y-0.5 active:scale-95">
                        Ubah Kata Sandi
                    </button>
                </div>
            </form>
        </div>
        
    </div>
</div>
@endsection
