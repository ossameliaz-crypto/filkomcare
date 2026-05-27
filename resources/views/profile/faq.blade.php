@extends('layouts.mobile-emulator')

@section('title', 'FilkomCare - Bantuan & FAQ')

@section('content')
<div class="relative w-full h-[844px] bg-[#f8f9fa] overflow-hidden flex flex-col" x-data="{ activeAccordion: null }">
    
    {{-- Top Bar --}}
    <div class="px-6 pt-12 pb-6 flex items-center gap-4 z-10 bg-white border-b border-gray-100 shadow-sm">
        <a href="{{ route('profile.index') }}" class="text-[#1a1a2e] hover:text-[#87B4B8] transition">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        </a>
        <h1 class="text-[#1a1a2e] text-[20px] font-bold">Bantuan & FAQ</h1>
    </div>

    {{-- Content --}}
    <div class="flex-1 overflow-y-auto px-6 pt-6 pb-20">
        
        <h2 class="text-[#3d4a5e] text-[16px] font-bold mb-4">Pertanyaan Populer</h2>

        <div class="bg-white rounded-[24px] shadow-sm p-2 flex flex-col gap-2">
            
            {{-- FAQ 1 --}}
            <div class="border border-gray-100 rounded-2xl overflow-hidden transition-all duration-300" :class="activeAccordion === 1 ? 'shadow-md border-[#87B4B8]' : ''">
                <button @click="activeAccordion = activeAccordion === 1 ? null : 1" class="w-full flex items-center justify-between p-4 bg-white text-left focus:outline-none">
                    <span class="text-[#3d4a5e] text-[14px] font-bold pr-4">Apakah layanan konseling ini gratis?</span>
                    <svg class="text-[#87B4B8] transition-transform duration-300 shrink-0" :class="activeAccordion === 1 ? 'rotate-180' : ''" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div x-show="activeAccordion === 1" x-collapse>
                    <div class="px-4 pb-4 text-gray-500 text-[13px] leading-relaxed border-t border-gray-50 pt-3">
                        Ya, layanan konseling FilkomCare sepenuhnya <strong>gratis</strong> bagi seluruh mahasiswa aktif Fakultas Ilmu Komputer Universitas Brawijaya. Anda tidak akan dipungut biaya apapun.
                    </div>
                </div>
            </div>

            {{-- FAQ 2 --}}
            <div class="border border-gray-100 rounded-2xl overflow-hidden transition-all duration-300" :class="activeAccordion === 2 ? 'shadow-md border-[#87B4B8]' : ''">
                <button @click="activeAccordion = activeAccordion === 2 ? null : 2" class="w-full flex items-center justify-between p-4 bg-white text-left focus:outline-none">
                    <span class="text-[#3d4a5e] text-[14px] font-bold pr-4">Bagaimana cara membatalkan jadwal?</span>
                    <svg class="text-[#87B4B8] transition-transform duration-300 shrink-0" :class="activeAccordion === 2 ? 'rotate-180' : ''" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div x-show="activeAccordion === 2" x-collapse>
                    <div class="px-4 pb-4 text-gray-500 text-[13px] leading-relaxed border-t border-gray-50 pt-3">
                        Anda dapat membatalkan jadwal minimal <strong>24 jam sebelum sesi dimulai</strong> melalui halaman Riwayat Konsultasi. Silakan klik tiket jadwal Anda dan pilih "Batalkan Konsultasi".
                    </div>
                </div>
            </div>

            {{-- FAQ 3 --}}
            <div class="border border-gray-100 rounded-2xl overflow-hidden transition-all duration-300" :class="activeAccordion === 3 ? 'shadow-md border-[#87B4B8]' : ''">
                <button @click="activeAccordion = activeAccordion === 3 ? null : 3" class="w-full flex items-center justify-between p-4 bg-white text-left focus:outline-none">
                    <span class="text-[#3d4a5e] text-[14px] font-bold pr-4">Siapa konselor yang menangani?</span>
                    <svg class="text-[#87B4B8] transition-transform duration-300 shrink-0" :class="activeAccordion === 3 ? 'rotate-180' : ''" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div x-show="activeAccordion === 3" x-collapse>
                    <div class="px-4 pb-4 text-gray-500 text-[13px] leading-relaxed border-t border-gray-50 pt-3">
                        FilkomCare didukung oleh psikolog profesional, konselor DWP (Dharma Wanita Persatuan), dan relawan konselor sebaya (mahasiswa terlatih). Anda bebas memilih jenis konselor saat melakukan *booking*.
                    </div>
                </div>
            </div>

        </div>
        
    </div>
</div>
@endsection
