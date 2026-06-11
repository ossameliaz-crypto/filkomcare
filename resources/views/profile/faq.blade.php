@extends('layouts.mobile-emulator')

@section('title', 'FilkomCare - Bantuan & FAQ')

@section('content')
<div class="relative w-full h-full min-h-[100dvh] md:min-h-0 bg-[#f8f9fa] overflow-hidden flex flex-col" x-data="{ activeAccordion: null }">
    
    {{-- Top Bar --}}
    <div class="px-6 pt-12 pb-6 flex items-center gap-4 z-10 bg-white border-b border-gray-100 shadow-sm">
        <a href="{{ route('profile.index') }}" class="text-[#3d4a5e] transition-all duration-300 transform hover:-translate-x-1 hover:text-[#87B4B8]">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        </a>
        <h1 class="text-[#3d4a5e] text-[20px] font-bold">Bantuan & FAQ</h1>
    </div>

    {{-- Content --}}
    <div class="flex-1 overflow-y-auto px-6 pt-6 pb-20">
        
        <h2 class="text-[#3d4a5e] text-[16px] font-bold mb-4">Pertanyaan Populer</h2>

        <div class="bg-white rounded-[24px] shadow-sm p-2 flex flex-col gap-2">
            
            {{-- Panduan 1: Cara Booking --}}
            <div class="border border-gray-100 rounded-2xl overflow-hidden transition-all duration-300" :class="activeAccordion === 1 ? 'shadow-md border-[#87B4B8]' : 'hover:border-[#87B4B8]/50'">
                <button @click="activeAccordion = activeAccordion === 1 ? null : 1" class="w-full flex items-center justify-between p-4 bg-white text-left focus:outline-none transition-colors duration-300 hover:bg-[#f8f9fa]">
                    <span class="text-[#3d4a5e] text-[14px] font-bold pr-4 transition-colors group-hover:text-[#87B4B8]" :class="activeAccordion === 1 ? 'text-[#87B4B8]' : ''">Bagaimana cara membuat jadwal konseling?</span>
                    <svg class="text-[#87B4B8] transition-transform duration-300 shrink-0" :class="activeAccordion === 1 ? 'rotate-180' : ''" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div x-show="activeAccordion === 1" x-collapse>
                    <div class="px-4 pb-4 text-gray-500 text-[13px] leading-relaxed border-t border-gray-50 pt-3 bg-white">
                        <ol class="list-decimal pl-4 space-y-1">
                            <li>Buka menu <strong>Konsultasi</strong> (ikon pesan/kalender) di bawah.</li>
                            <li>Pilih tab <strong>Online</strong> (Chat/Telepon) atau <strong>Tatap Muka</strong>.</li>
                            <li>Pilih tanggal dan waktu yang masih tersedia (berwarna biru). Waktu yang sudah lewat atau di-booking akan dinonaktifkan.</li>
                            <li>Pilih layanan/konselor, isi Topik, dan Deskripsi Singkat keluhan Anda.</li>
                            <li>Centang persetujuan, lalu klik <strong>Kirim</strong>.</li>
                            <li>Setelah berhasil, Anda akan diminta untuk mengonfirmasi jadwal ke WhatsApp admin.</li>
                        </ol>
                    </div>
                </div>
            </div>

            {{-- Panduan 2: Cara Reschedule --}}
            <div class="border border-gray-100 rounded-2xl overflow-hidden transition-all duration-300" :class="activeAccordion === 2 ? 'shadow-md border-[#87B4B8]' : 'hover:border-[#87B4B8]/50'">
                <button @click="activeAccordion = activeAccordion === 2 ? null : 2" class="w-full flex items-center justify-between p-4 bg-white text-left focus:outline-none transition-colors duration-300 hover:bg-[#f8f9fa]">
                    <span class="text-[#3d4a5e] text-[14px] font-bold pr-4 transition-colors group-hover:text-[#87B4B8]" :class="activeAccordion === 2 ? 'text-[#87B4B8]' : ''">Saya berhalangan hadir, bisakah di-reschedule?</span>
                    <svg class="text-[#87B4B8] transition-transform duration-300 shrink-0" :class="activeAccordion === 2 ? 'rotate-180' : ''" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div x-show="activeAccordion === 2" x-collapse>
                    <div class="px-4 pb-4 text-gray-500 text-[13px] leading-relaxed border-t border-gray-50 pt-3 bg-white">
                        Sangat bisa! Jika Anda berhalangan, lakukan langkah berikut:<br>
                        1. Buka menu <strong>Riwayat</strong>.<br>
                        2. Pilih konsultasi Anda yang statusnya masih <strong>Menunggu</strong> atau <strong>Diproses</strong>.<br>
                        3. Scroll ke bawah dan klik tombol <strong>Reschedule Jadwal</strong>.<br>
                        4. Pilih tanggal dan waktu baru, lalu simpan dan lakukan konfirmasi kembali via WhatsApp.
                    </div>
                </div>
            </div>

            {{-- Panduan 3: Panic Button --}}
            <div class="border border-gray-100 rounded-2xl overflow-hidden transition-all duration-300" :class="activeAccordion === 3 ? 'shadow-md border-[#87B4B8]' : 'hover:border-[#87B4B8]/50'">
                <button @click="activeAccordion = activeAccordion === 3 ? null : 3" class="w-full flex items-center justify-between p-4 bg-white text-left focus:outline-none transition-colors duration-300 hover:bg-[#f8f9fa]">
                    <span class="text-[#3d4a5e] text-[14px] font-bold pr-4 transition-colors group-hover:text-[#87B4B8]" :class="activeAccordion === 3 ? 'text-[#87B4B8]' : ''">Kapan saya harus menekan Panic Button (Bantu Saya)?</span>
                    <svg class="text-[#87B4B8] transition-transform duration-300 shrink-0" :class="activeAccordion === 3 ? 'rotate-180' : ''" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div x-show="activeAccordion === 3" x-collapse>
                    <div class="px-4 pb-4 text-gray-500 text-[13px] leading-relaxed border-t border-gray-50 pt-3 bg-white">
                        Tombol <strong>Bantu Saya (SOS)</strong> di halaman Home diperuntukkan untuk situasi krisis psikologis darurat yang membutuhkan intervensi segera.<br><br>
                        <strong>Catatan:</strong> Jika Anda menekannya di luar jam layanan (malam hari atau akhir pekan), laporan Anda akan tetap tercatat dan konselor akan segera menghubungi Anda saat jam layanan kembali aktif (Senin - Jumat, 09:00 - 17:00 WIB).
                    </div>
                </div>
            </div>

            {{-- Panduan 4: Waktu Layanan --}}
            <div class="border border-gray-100 rounded-2xl overflow-hidden transition-all duration-300" :class="activeAccordion === 4 ? 'shadow-md border-[#87B4B8]' : 'hover:border-[#87B4B8]/50'">
                <button @click="activeAccordion = activeAccordion === 4 ? null : 4" class="w-full flex items-center justify-between p-4 bg-white text-left focus:outline-none transition-colors duration-300 hover:bg-[#f8f9fa]">
                    <span class="text-[#3d4a5e] text-[14px] font-bold pr-4 transition-colors group-hover:text-[#87B4B8]" :class="activeAccordion === 4 ? 'text-[#87B4B8]' : ''">Kapan jam operasional FilkomCare?</span>
                    <svg class="text-[#87B4B8] transition-transform duration-300 shrink-0" :class="activeAccordion === 4 ? 'rotate-180' : ''" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div x-show="activeAccordion === 4" x-collapse>
                    <div class="px-4 pb-4 text-gray-500 text-[13px] leading-relaxed border-t border-gray-50 pt-3 bg-white">
                        Layanan FilkomCare beroperasi secara aktif pada:<br>
                        <strong>Hari:</strong> Senin - Jumat (Kecuali hari libur nasional)<br>
                        <strong>Jam:</strong> 09.00 - 17.00 WIB.<br><br>
                        Anda tetap bisa membuat janji temu atau menekan tombol SOS kapan saja, namun respons akan diberikan pada jam kerja tersebut.
                    </div>
                </div>
            </div>

            {{-- Panduan 5: Jenis Layanan --}}
            <div class="border border-gray-100 rounded-2xl overflow-hidden transition-all duration-300" :class="activeAccordion === 5 ? 'shadow-md border-[#87B4B8]' : 'hover:border-[#87B4B8]/50'">
                <button @click="activeAccordion = activeAccordion === 5 ? null : 5" class="w-full flex items-center justify-between p-4 bg-white text-left focus:outline-none transition-colors duration-300 hover:bg-[#f8f9fa]">
                    <span class="text-[#3d4a5e] text-[14px] font-bold pr-4 transition-colors group-hover:text-[#87B4B8]" :class="activeAccordion === 5 ? 'text-[#87B4B8]' : ''">Apa saja pilihan konselor yang tersedia?</span>
                    <svg class="text-[#87B4B8] transition-transform duration-300 shrink-0" :class="activeAccordion === 5 ? 'rotate-180' : ''" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div x-show="activeAccordion === 5" x-collapse>
                    <div class="px-4 pb-4 text-gray-500 text-[13px] leading-relaxed border-t border-gray-50 pt-3 bg-white">
                        FilkomCare menyediakan opsi konsultasi secara Online dan Tatap Muka:<br>
                        - <strong>Konselor Sebaya</strong>: Mahasiswa Filkom aktif yang sudah diberi pelatihan konseling.<br>
                        - <strong>UKLT</strong>: Unit Layanan Konseling Terpadu dengan tenaga ahli profesional.<br>
                        - <strong>DWP Filkom</strong>: Konselor dari Dharma Wanita Persatuan Filkom.
                    </div>
                </div>
            </div>

            {{-- Panduan 6: Biaya --}}
            <div class="border border-gray-100 rounded-2xl overflow-hidden transition-all duration-300" :class="activeAccordion === 6 ? 'shadow-md border-[#87B4B8]' : 'hover:border-[#87B4B8]/50'">
                <button @click="activeAccordion = activeAccordion === 6 ? null : 6" class="w-full flex items-center justify-between p-4 bg-white text-left focus:outline-none transition-colors duration-300 hover:bg-[#f8f9fa]">
                    <span class="text-[#3d4a5e] text-[14px] font-bold pr-4 transition-colors group-hover:text-[#87B4B8]" :class="activeAccordion === 6 ? 'text-[#87B4B8]' : ''">Apakah layanan konseling ini dipungut biaya?</span>
                    <svg class="text-[#87B4B8] transition-transform duration-300 shrink-0" :class="activeAccordion === 6 ? 'rotate-180' : ''" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div x-show="activeAccordion === 6" x-collapse>
                    <div class="px-4 pb-4 text-gray-500 text-[13px] leading-relaxed border-t border-gray-50 pt-3 bg-white">
                        Tidak. Seluruh layanan FilkomCare 100% <strong>GRATIS</strong> untuk mahasiswa Fakultas Ilmu Komputer Universitas Brawijaya (FILKOM UB).
                    </div>
                </div>
            </div>

            {{-- Panduan 7: Privasi --}}
            <div class="border border-gray-100 rounded-2xl overflow-hidden transition-all duration-300" :class="activeAccordion === 7 ? 'shadow-md border-[#87B4B8]' : 'hover:border-[#87B4B8]/50'">
                <button @click="activeAccordion = activeAccordion === 7 ? null : 7" class="w-full flex items-center justify-between p-4 bg-white text-left focus:outline-none transition-colors duration-300 hover:bg-[#f8f9fa]">
                    <span class="text-[#3d4a5e] text-[14px] font-bold pr-4 transition-colors group-hover:text-[#87B4B8]" :class="activeAccordion === 7 ? 'text-[#87B4B8]' : ''">Apakah rahasia dan privasi saya terjamin?</span>
                    <svg class="text-[#87B4B8] transition-transform duration-300 shrink-0" :class="activeAccordion === 7 ? 'rotate-180' : ''" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                </button>
                <div x-show="activeAccordion === 7" x-collapse>
                    <div class="px-4 pb-4 text-gray-500 text-[13px] leading-relaxed border-t border-gray-50 pt-3 bg-white">
                        Tentu. FilkomCare menjunjung tinggi asas kerahasiaan. Semua cerita dan keluhan Anda hanya akan diketahui oleh konselor yang Anda pilih untuk keperluan penanganan psikologis.
                    </div>
                </div>
            </div>

        </div>
        
    </div>
</div>
@endsection
