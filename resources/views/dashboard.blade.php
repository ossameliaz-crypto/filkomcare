@extends('layouts.mobile-emulator')

@section('title', 'Dashboard - FilkomCare')
@section('page-name', 'Home')

@section('content')
<div class="relative w-full h-full min-h-[100dvh] md:min-h-0 bg-[#fcfcfc] overflow-hidden flex flex-col pb-[70px]">
    <div class="flex-1 overflow-y-auto w-full pb-8">

    {{-- ===== Top Header Background ===== --}}
    <div class="bg-[#5d687c] w-full pt-16 pb-16 px-6 rounded-b-[32px] relative z-10">
        {{-- Greeting Row --}}
        <div class="flex justify-between items-center mb-2">
            <h1 class="text-white text-[22px] font-semibold flex items-center gap-2">
                👋 Hai, {{ explode(' ', Auth::user()->name ?? 'Mahasiswa')[0] }}
            </h1>
            <a href="{{ route('notifications.index') }}" class="relative block">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                    <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                </svg>
                @php
                    $unreadNotifCount = \App\Models\Notification::where('user_id', Auth::id())->where('is_read', false)->count();
                @endphp
                @if($unreadNotifCount > 0)
                <div class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full border-2 border-[#5d687c] flex items-center justify-center">
                    <span class="text-white text-[8px] font-bold">{{ $unreadNotifCount > 9 ? '9+' : $unreadNotifCount }}</span>
                </div>
                @endif
            </a>
        </div>
    </div>

    {{-- ===== Waktu Layanan Card ===== --}}
    <div class="px-6 -mt-12 relative z-20 mb-8">
        <div class="bg-gradient-to-r from-[#f7fcfd] to-[#d6f2f5] rounded-2xl p-4 flex items-center gap-4 shadow-sm">
            <div class="w-12 h-12 rounded-full bg-[#c2ebf0] flex items-center justify-center shrink-0">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#3d4a5e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <polyline points="12 6 12 12 16 14"></polyline>
                </svg>
            </div>
            <div>
                <h3 class="text-[#3d4a5e] font-semibold text-[15px]">Waktu Layanan</h3>
                <div class="flex items-center gap-3 mt-1 text-[11px] text-[#5d687c]">
                    <div class="flex items-center gap-1">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        Senin - Jumat
                    </div>
                    <div class="flex items-center gap-1">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        09.00 - 17.00 WIB
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ===== Layanan Filkom Care ===== --}}
    <div class="px-6 mb-8">
        <h2 class="text-[#3d4a5e] text-[20px] font-bold mb-4">Layanan Filkom Care</h2>
        
        <div class="flex gap-4 mb-4">
            {{-- Chat Konseling --}}
            <div class="flex-1 bg-[#f0f9fb] border border-[#bce8ee] rounded-2xl p-4 shadow-sm flex flex-col transition-all duration-300 hover:shadow-md transform hover:-translate-y-0.5 cursor-pointer">
                <div class="w-10 h-10 rounded-full bg-[#bce8ee] flex items-center justify-center mb-3">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#3d4a5e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                </div>
                <h3 class="text-[#3d4a5e] font-bold text-[15px] mb-1">Chat Konseling</h3>
                <p class="text-[10px] text-gray-500 leading-tight">Konsultasi via chat secara online</p>
            </div>
            
            {{-- Telepon Konseling --}}
            <div class="flex-1 bg-[#fff8f3] border border-[#f0e3d6] rounded-2xl p-4 shadow-sm flex flex-col transition-all duration-300 hover:shadow-md transform hover:-translate-y-0.5 cursor-pointer">
                <div class="w-10 h-10 rounded-full bg-[#f0e3d6] flex items-center justify-center mb-3">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#3d4a5e" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                </div>
                <h3 class="text-[#3d4a5e] font-bold text-[15px] mb-1">Telepon Konseling</h3>
                <p class="text-[10px] text-gray-500 leading-tight">Konsultasi via telepon secara online</p>
            </div>
        </div>

        {{-- Konsultasi Tatap Muka --}}
        <div class="bg-[#eef1f5] border border-[#d6dce3] rounded-2xl p-4 shadow-sm flex items-center justify-between relative overflow-hidden transition-all duration-300 hover:shadow-md transform hover:-translate-y-0.5 cursor-pointer">
            <div class="relative z-10 w-[60%]">
                <h3 class="text-[#3d4a5e] font-bold text-[15px] mb-1">Konsultasi Tatap Muka</h3>
                <p class="text-[11px] text-gray-600 leading-tight">Buat janji konseling langsung di kampus</p>
            </div>
            <img src="{{ asset('images/home_consultation.png') }}" class="absolute right-2 bottom-0 h-[90%] object-contain" alt="Consultation">
        </div>
    </div>

    {{-- ===== Pilihan Konselor Terbaik ===== --}}
    <div class="mb-10">
        <h2 class="px-6 text-[#3d4a5e] text-[20px] font-bold mb-4">Pilihan Konselor Terbaik</h2>
        
        <div class="px-6 relative overflow-hidden">
            <div class="flex transition-transform duration-500 ease-in-out" id="counselorTrack" style="transform: translateX(0%);">
                
                {{-- Slide 1: Konselor Sebaya --}}
                <div class="w-full shrink-0 px-0.5">
                    <div class="bg-white border border-[#e2e8f0] rounded-3xl p-3 shadow-sm flex items-center gap-4">
                        <img src="{{ asset('images/counselor_sebaya.jpg') }}" class="w-[100px] h-[100px] rounded-2xl object-cover" alt="Konselor Sebaya">
                        <div class="flex-1 flex flex-col justify-between h-[100px]">
                            <div>
                                <h3 class="text-[#3d4a5e] font-bold text-[15px] mb-1">Konselor Sebaya</h3>
                                <p class="text-[10px] text-gray-500 leading-snug">Mahasiswa Filkom Aktif yang sudah diberi upgrading sebagai konselor</p>
                            </div>
                            <div class="flex justify-end mt-auto">
                                <button type="button" onclick="nextCounselor()" class="w-8 h-8 rounded-full bg-[#bce8ee] flex items-center justify-center text-[#3d4a5e] hover:bg-[#87B4B8] hover:text-white transition">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Slide 2: ULKT --}}
                <div class="w-full shrink-0 px-0.5">
                    <div class="bg-white border border-[#e2e8f0] rounded-3xl p-3 shadow-sm flex items-center gap-4">
                        <img src="{{ asset('images/counselor_ulkt.jpg') }}" class="w-[100px] h-[100px] rounded-2xl object-cover" alt="ULKT">
                        <div class="flex-1 flex flex-col justify-between h-[100px]">
                            <div>
                                <h3 class="text-[#3d4a5e] font-bold text-[15px] mb-1">ULKT</h3>
                                <p class="text-[10px] text-gray-500 leading-snug">Unit layanan konseling terpadu</p>
                            </div>
                            <div class="flex justify-end mt-auto">
                                <button type="button" onclick="nextCounselor()" class="w-8 h-8 rounded-full bg-[#bce8ee] flex items-center justify-center text-[#3d4a5e] hover:bg-[#87B4B8] hover:text-white transition">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Slide 3: DWP Filkom --}}
                <div class="w-full shrink-0 px-0.5">
                    <div class="bg-white border border-[#e2e8f0] rounded-3xl p-3 shadow-sm flex items-center gap-4">
                        <img src="{{ asset('images/counselor_dwp.jpg') }}" class="w-[100px] h-[100px] rounded-2xl object-cover" alt="DWP Filkom">
                        <div class="flex-1 flex flex-col justify-between h-[100px]">
                            <div>
                                <h3 class="text-[#3d4a5e] font-bold text-[15px] mb-1">DWP Filkom</h3>
                                <p class="text-[10px] text-gray-500 leading-snug">Dharma Wanita Persatuan Filkom</p>
                            </div>
                            <div class="flex justify-end mt-auto">
                                <button type="button" onclick="nextCounselor()" class="w-8 h-8 rounded-full bg-[#bce8ee] flex items-center justify-center text-[#3d4a5e] hover:bg-[#87B4B8] hover:text-white transition">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ===== 3 Langkah Mudah ===== --}}
    <div class="mb-10">
        <h2 class="px-6 text-[#3d4a5e] text-[20px] font-bold mb-6 leading-snug tracking-tight">3 Langkah Konseling</h2>
        
        <div class="grid grid-cols-3 gap-3 px-6">
            <div class="bg-[#F1E9E2] rounded-2xl p-3 flex flex-col items-center text-center justify-between shadow-sm hover:shadow-md transition-shadow">
                <h3 class="text-[#3d4a5e] font-bold text-[11px] mb-2 min-h-[32px] leading-tight flex items-center justify-center w-full">Pahami Keluhan</h3>
                <img src="{{ asset('images/home_step1.png') }}" class="w-[65px] h-[65px] object-contain" alt="Step 1">
            </div>
            <div class="bg-[#F1E9E2] rounded-2xl p-3 flex flex-col items-center text-center justify-between shadow-sm hover:shadow-md transition-shadow">
                <h3 class="text-[#3d4a5e] font-bold text-[11px] mb-2 min-h-[32px] leading-tight flex items-center justify-center w-full">Pilih Layanan</h3>
                <img src="{{ asset('images/home_step2.png') }}" class="w-[65px] h-[65px] object-contain" alt="Step 2">
            </div>
            <div class="bg-[#F1E9E2] rounded-2xl p-3 flex flex-col items-center text-center justify-between shadow-sm hover:shadow-md transition-shadow">
                <h3 class="text-[#3d4a5e] font-bold text-[11px] mb-2 min-h-[32px] leading-tight flex items-center justify-center w-full">Buat jadwal konseling</h3>
                <img src="{{ asset('images/home_step3.png') }}" class="w-[65px] h-[65px] object-contain" alt="Step 3">
            </div>
        </div>
    </div>

    {{-- ===== Butuh bantuan darurat? ===== --}}
    <div class="px-6 mb-12" x-data>
        <div class="bg-[#5d687c] rounded-[24px] p-5 shadow-sm relative overflow-visible flex flex-col min-h-[140px] border border-[#6b768a]">
            <div class="flex items-center justify-between h-full z-10 relative">
                {{-- Text Content --}}
                <div class="flex-1 pr-2 z-20">
                    <h2 class="text-white text-[20px] font-bold mb-1 leading-tight">Butuh bantuan darurat?</h2>
                    <p class="text-[#e2e8f0] text-[12px] mb-4">Dapatkan bantuan sekarang!</p>
                    
                    <button @click="$dispatch('open-sos')" class="bg-[#bce8ee] text-[#3d4a5e] font-bold text-[13px] py-2 px-5 rounded-xl shadow-md hover:bg-[#a6dce4] active:scale-95 transition-all w-max hover:shadow-lg">
                        Bantu Saya
                    </button>
                </div>

                {{-- Image --}}
                <div class="absolute -right-2 -bottom-5 w-[140px] z-10 drop-shadow-xl pointer-events-none">
                    <img src="{{ asset('images/home_emergency.png') }}" class="w-full h-auto drop-shadow-xl" alt="Emergency">
                </div>
            </div>
        </div>
    </div>
    </div>

    {{-- ===== Bottom Navigation ===== --}}
    @include('components.bottom-nav', ['active' => 'home'])

</div>
@endsection


@push('scripts')
<script>
    let currentCounselorIndex = 0;
    const totalCounselors = 3;

    function nextCounselor() {
        const track = document.getElementById('counselorTrack');
        currentCounselorIndex = (currentCounselorIndex + 1) % totalCounselors;
        
        // Slide left by 100% of the container width per item
        track.style.transform = `translateX(-${currentCounselorIndex * 100}%)`;
    }
</script>
@endpush
