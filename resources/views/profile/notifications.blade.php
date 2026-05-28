@extends('layouts.mobile-emulator')

@section('title', 'FilkomCare - Preferensi Notifikasi')

@section('content')
<div class="relative w-full h-full min-h-[100dvh] md:min-h-0 bg-[#f8f9fa] overflow-hidden flex flex-col" x-data="{ notifStatus: true, notifSchedule: true, notifSystem: true }">
    
    {{-- Top Bar --}}
    <div class="px-6 pt-12 pb-6 flex items-center gap-4 z-10 bg-white border-b border-gray-100 shadow-sm">
        <a href="{{ route('profile.index') }}" class="text-[#3d4a5e] transition-all duration-300 transform hover:-translate-x-1 hover:text-[#87B4B8]">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        </a>
        <h1 class="text-[#3d4a5e] text-[20px] font-bold">Preferensi Notifikasi</h1>
    </div>

    {{-- Content --}}
    <div class="flex-1 overflow-y-auto px-6 pt-6 pb-20">
        
        <p class="text-gray-500 text-[14px] mb-6">Atur jenis notifikasi yang ingin Anda terima dari FilkomCare.</p>

        <div class="bg-white rounded-[24px] shadow-sm p-4 flex flex-col transition-shadow duration-300 hover:shadow-md">
            
            {{-- Toggle 1 --}}
            <div class="flex items-center justify-between py-4 border-b border-gray-100 px-2 -mx-2 rounded-lg transition-colors duration-300 hover:bg-[#f8f9fa] cursor-pointer" @click="notifStatus = !notifStatus">
                <div>
                    <h3 class="text-[#3d4a5e] text-[15px] font-bold mb-1">Pembaruan Status</h3>
                    <p class="text-gray-400 text-[12px]">Pemberitahuan saat status<br>pengajuan konseling berubah.</p>
                </div>
                <button :class="notifStatus ? 'bg-[#87B4B8]' : 'bg-gray-200'" 
                        class="w-12 h-7 rounded-full relative transition-colors duration-300 focus:outline-none shrink-0 shadow-inner">
                    <span :class="notifStatus ? 'translate-x-6' : 'translate-x-1'" 
                          class="absolute left-0 top-1 w-5 h-5 bg-white rounded-full transition-transform duration-300 shadow-sm"></span>
                </button>
            </div>

            {{-- Toggle 2 --}}
            <div class="flex items-center justify-between py-4 border-b border-gray-100 px-2 -mx-2 rounded-lg transition-colors duration-300 hover:bg-[#f8f9fa] cursor-pointer" @click="notifSchedule = !notifSchedule">
                <div>
                    <h3 class="text-[#3d4a5e] text-[15px] font-bold mb-1">Info Jadwal Baru</h3>
                    <p class="text-gray-400 text-[12px]">Konfirmasi saat Anda berhasil membuat jadwal konseling.</p>
                </div>
                <button :class="notifSchedule ? 'bg-[#87B4B8]' : 'bg-gray-200'" 
                        class="w-12 h-7 rounded-full relative transition-colors duration-300 focus:outline-none shrink-0 shadow-inner">
                    <span :class="notifSchedule ? 'translate-x-6' : 'translate-x-1'" 
                          class="absolute left-0 top-1 w-5 h-5 bg-white rounded-full transition-transform duration-300 shadow-sm"></span>
                </button>
            </div>

            {{-- Toggle 3 --}}
            <div class="flex items-center justify-between py-4 px-2 -mx-2 rounded-lg transition-colors duration-300 hover:bg-[#f8f9fa] cursor-pointer" @click="notifSystem = !notifSystem">
                <div>
                    <h3 class="text-[#3d4a5e] text-[15px] font-bold mb-1">Pengumuman Sistem</h3>
                    <p class="text-gray-400 text-[12px]">Informasi dan pembaruan layanan dari FilkomCare.</p>
                </div>
                <button :class="notifSystem ? 'bg-[#87B4B8]' : 'bg-gray-200'" 
                        class="w-12 h-7 rounded-full relative transition-colors duration-300 focus:outline-none shrink-0 shadow-inner">
                    <span :class="notifSystem ? 'translate-x-6' : 'translate-x-1'" 
                          class="absolute left-0 top-1 w-5 h-5 bg-white rounded-full transition-transform duration-300 shadow-sm"></span>
                </button>
            </div>

        </div>

        <div class="mt-8 text-center text-[12px] text-gray-400">
            Perubahan ini akan otomatis tersimpan ke perangkat Anda.
        </div>
        
    </div>
</div>
@endsection
