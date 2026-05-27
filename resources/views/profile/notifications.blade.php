@extends('layouts.mobile-emulator')

@section('title', 'FilkomCare - Preferensi Notifikasi')

@section('content')
<div class="relative w-full h-[844px] bg-[#f8f9fa] overflow-hidden flex flex-col" x-data="{ notifEmail: true, notifSchedule: true, notifMessage: true }">
    
    {{-- Top Bar --}}
    <div class="px-6 pt-12 pb-6 flex items-center gap-4 z-10 bg-white border-b border-gray-100 shadow-sm">
        <a href="{{ route('profile.index') }}" class="text-[#1a1a2e] hover:text-[#87B4B8] transition">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        </a>
        <h1 class="text-[#1a1a2e] text-[20px] font-bold">Preferensi Notifikasi</h1>
    </div>

    {{-- Content --}}
    <div class="flex-1 overflow-y-auto px-6 pt-6 pb-20">
        
        <p class="text-gray-500 text-[14px] mb-6">Atur jenis notifikasi yang ingin Anda terima dari FilkomCare.</p>

        <div class="bg-white rounded-[24px] shadow-sm p-4 flex flex-col">
            
            {{-- Toggle 1 --}}
            <div class="flex items-center justify-between py-4 border-b border-gray-100">
                <div>
                    <h3 class="text-[#3d4a5e] text-[15px] font-bold mb-1">Email Notifikasi</h3>
                    <p class="text-gray-400 text-[12px]">Terima ringkasan jadwal dan riwayat via email.</p>
                </div>
                <button @click="notifEmail = !notifEmail" 
                        :class="notifEmail ? 'bg-[#87B4B8]' : 'bg-gray-200'" 
                        class="w-12 h-7 rounded-full relative transition-colors duration-300 focus:outline-none shrink-0">
                    <span :class="notifEmail ? 'translate-x-6' : 'translate-x-1'" 
                          class="absolute left-0 top-1 w-5 h-5 bg-white rounded-full transition-transform duration-300 shadow-sm"></span>
                </button>
            </div>

            {{-- Toggle 2 --}}
            <div class="flex items-center justify-between py-4 border-b border-gray-100">
                <div>
                    <h3 class="text-[#3d4a5e] text-[15px] font-bold mb-1">Pengingat Jadwal</h3>
                    <p class="text-gray-400 text-[12px]">Dapatkan pengingat H-1 sebelum sesi konseling.</p>
                </div>
                <button @click="notifSchedule = !notifSchedule" 
                        :class="notifSchedule ? 'bg-[#87B4B8]' : 'bg-gray-200'" 
                        class="w-12 h-7 rounded-full relative transition-colors duration-300 focus:outline-none shrink-0">
                    <span :class="notifSchedule ? 'translate-x-6' : 'translate-x-1'" 
                          class="absolute left-0 top-1 w-5 h-5 bg-white rounded-full transition-transform duration-300 shadow-sm"></span>
                </button>
            </div>

            {{-- Toggle 3 --}}
            <div class="flex items-center justify-between py-4">
                <div>
                    <h3 class="text-[#3d4a5e] text-[15px] font-bold mb-1">Pesan Konselor</h3>
                    <p class="text-gray-400 text-[12px]">Notifikasi saat konselor membalas chat Anda.</p>
                </div>
                <button @click="notifMessage = !notifMessage" 
                        :class="notifMessage ? 'bg-[#87B4B8]' : 'bg-gray-200'" 
                        class="w-12 h-7 rounded-full relative transition-colors duration-300 focus:outline-none shrink-0">
                    <span :class="notifMessage ? 'translate-x-6' : 'translate-x-1'" 
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
