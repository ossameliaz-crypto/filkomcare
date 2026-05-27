@extends('layouts.mobile-emulator')

@section('title', 'FilkomCare - Privasi & Keamanan')

@section('content')
<div class="relative w-full h-[844px] bg-[#f8f9fa] overflow-hidden flex flex-col">
    
    {{-- Top Bar --}}
    <div class="px-6 pt-12 pb-6 flex items-center gap-4 z-10 bg-white border-b border-gray-100 shadow-sm">
        <a href="{{ route('profile.index') }}" class="text-[#1a1a2e] hover:text-[#87B4B8] transition">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        </a>
        <h1 class="text-[#1a1a2e] text-[20px] font-bold">Privasi & Keamanan</h1>
    </div>

    {{-- Content --}}
    <div class="flex-1 overflow-y-auto px-6 pt-6 pb-20">
        
        <div class="bg-white rounded-[24px] p-6 shadow-sm mb-6">
            <h2 class="text-[#87B4B8] font-bold text-[16px] mb-3">Kerahasiaan Data</h2>
            <p class="text-gray-500 text-[14px] leading-relaxed mb-4">
                FilkomCare menjamin sepenuhnya kerahasiaan seluruh data pribadi dan informasi sesi konseling Anda. Data hanya dapat diakses oleh Anda dan konselor yang ditugaskan secara spesifik untuk menangani kasus Anda.
            </p>
            <p class="text-gray-500 text-[14px] leading-relaxed">
                Informasi diagnosis maupun catatan konseling tidak akan pernah dibagikan kepada pihak fakultas, dosen, atau institusi lain tanpa persetujuan tertulis secara eksplisit dari Anda, kecuali jika terdapat risiko keselamatan yang mengancam nyawa.
            </p>
        </div>

        <div class="bg-white rounded-[24px] p-6 shadow-sm mb-6">
            <h2 class="text-[#87B4B8] font-bold text-[16px] mb-3">Keamanan Akun</h2>
            <p class="text-gray-500 text-[14px] leading-relaxed mb-5">
                Pastikan Anda selalu menggunakan kata sandi yang kuat dan tidak membagikan kredensial login (Email UB) Anda kepada siapapun.
            </p>

            <button class="w-full py-3 bg-[#f8f9fa] border border-gray-200 text-[#3d4a5e] font-bold rounded-xl text-[14px] hover:bg-gray-100 transition">
                Ubah Kata Sandi
            </button>
        </div>
        
    </div>
</div>
@endsection
