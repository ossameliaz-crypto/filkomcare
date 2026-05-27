@extends('layouts.mobile-emulator')

@section('title', 'FilkomCare - Pengaturan')

@section('content')
<div class="relative w-full h-[844px] bg-[#f8f9fa] overflow-hidden flex flex-col">
    
    {{-- Top Bar --}}
    <div class="px-6 pt-12 pb-6 flex items-center gap-4 z-10 bg-white border-b border-gray-100 shadow-sm">
        <a href="{{ route('profile.index') }}" class="text-[#1a1a2e] hover:text-[#87B4B8] transition">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        </a>
        <h1 class="text-[#1a1a2e] text-[20px] font-bold">Pengaturan</h1>
    </div>

    {{-- Content --}}
    <div class="flex-1 overflow-y-auto px-6 pt-6 pb-20">
        
        <h2 class="text-[#3d4a5e] text-[14px] font-bold mb-3 uppercase tracking-wider">Aplikasi</h2>
        <div class="bg-white rounded-[24px] shadow-sm p-2 flex flex-col mb-6">
            
            <a href="#" class="flex items-center justify-between p-4 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition rounded-xl">
                <div class="flex flex-col">
                    <span class="text-[#3d4a5e] text-[15px] font-bold">Bahasa</span>
                    <span class="text-gray-400 text-[12px]">Indonesia</span>
                </div>
                <svg class="text-gray-300" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </a>
            
            <a href="#" class="flex items-center justify-between p-4 border-b border-gray-100 last:border-0 hover:bg-gray-50 transition rounded-xl">
                <div class="flex flex-col">
                    <span class="text-[#3d4a5e] text-[15px] font-bold">Tema</span>
                    <span class="text-gray-400 text-[12px]">Terang (Light)</span>
                </div>
                <svg class="text-gray-300" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </a>

        </div>

        <h2 class="text-[#3d4a5e] text-[14px] font-bold mb-3 uppercase tracking-wider">Zona Berbahaya</h2>
        <div class="bg-white rounded-[24px] shadow-sm p-4 flex flex-col mb-6 border border-red-100">
            <p class="text-gray-500 text-[13px] mb-4">
                Menghapus akun akan menghilangkan seluruh riwayat konsultasi dan data diri Anda secara permanen. Tindakan ini tidak dapat dibatalkan.
            </p>
            <button class="w-full bg-[#fde9eb] text-[#df4a56] font-bold py-3.5 rounded-xl text-[14px] hover:bg-[#fad8db] transition">
                Hapus Akun Permanen
            </button>
        </div>

        <div class="mt-8 flex flex-col items-center justify-center">
            <img src="{{ asset('images/logo-filkomcare.png') }}" alt="FilkomCare Logo" class="h-8 mb-2 opacity-50 grayscale">
            <p class="text-gray-400 text-[12px] font-medium">Versi 1.0.0 (Build 245)</p>
        </div>
        
    </div>
</div>
@endsection
