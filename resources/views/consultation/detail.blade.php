@extends('layouts.mobile-emulator')

@section('title', 'FilkomCare - Detail Sesi')
@section('page-name', 'Detail Sesi Konseling')

@section('content')
<div class="relative w-full h-[844px] bg-[#fafafa] overflow-y-auto px-6 pt-12 pb-8">
    
    {{-- Top Bar --}}
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('consultation.index') }}" class="text-[#3d4a5e] transition-all duration-300 transform hover:-translate-x-1 hover:text-[#87B4B8]">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        </a>
        <h1 class="text-[#1a1a2e] text-[20px] font-bold tracking-tight">Detail Sesi Konseling</h1>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-[24px] border border-gray-100 shadow-[0_4px_20px_-4px_rgba(0,0,0,0.03)] p-6 w-full transition-shadow duration-300 hover:shadow-[0_8px_30px_-4px_rgba(0,0,0,0.08)]">
        
        {{-- User Profile --}}
        <div class="flex items-center gap-6 mb-8">
            {{-- Avatar --}}
            <div class="w-[88px] h-[88px] rounded-full bg-gradient-to-br from-[#f1e5da] to-[#f9f6f2] flex items-center justify-center shrink-0 transition-transform duration-300 hover:scale-105">
                <span class="text-[#3d4a5e] text-[32px] font-semibold">{{ $initials }}</span>
            </div>
            {{-- Name --}}
            <h2 class="text-[#1a1a2e] text-[15px] font-semibold">{{ $user->name }}</h2>
        </div>

        {{-- Info Box (Grid) --}}
        <div class="border border-gray-200 rounded-[14px] mb-8 overflow-hidden transition-colors hover:border-[#bce8ee]">
            <div class="grid grid-cols-2 divide-x divide-gray-200">
                {{-- Jadwal Konseling --}}
                <div class="p-4 flex flex-col justify-start hover:bg-[#f8f9fa] transition-colors">
                    <div class="flex items-center gap-2 mb-2.5">
                        {{-- Calendar Check Icon --}}
                        <svg class="text-[#a1c4c8]" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line><path d="M9 16l2 2 4-4"></path></svg>
                        <span class="text-[#8e98a8] text-[11px] font-medium">Jadwal Konseling</span>
                    </div>
                    <div class="text-[#1a1a2e] text-[12px] font-semibold leading-relaxed">
                        {{ $formattedDate }}<br>
                        @if(isset($data['time']) && strpos($data['time'], 'WIB') !== false)
                            {{ str_replace(' WIB', '', $data['time']) }} - {{ date('H:i', strtotime(str_replace(' WIB', '', $data['time'])) + 3600) }} WIB
                        @else
                            {{ $data['time'] ?? '10:30 - 11:30 WIB' }}
                        @endif
                    </div>
                </div>

                {{-- Layanan Konsultasi --}}
                <div class="p-4 flex flex-col justify-start hover:bg-[#f8f9fa] transition-colors">
                    <div class="flex items-center gap-2 mb-2.5">
                        {{-- Headset Profile Icon --}}
                        <svg class="text-[#a1c4c8]" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 18v-6a9 9 0 0 1 18 0v6"></path><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3zM3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"></path><circle cx="12" cy="13" r="3"></circle></svg>
                        <span class="text-[#8e98a8] text-[11px] font-medium">Layanan Konsultasi</span>
                    </div>
                    <div class="text-[#1a1a2e] text-[12px] font-semibold leading-relaxed">
                        @if($isOffline)
                            Tatap muka dengan<br>{{ $data['service'] }}
                        @else
                            {{ $data['service'] }}<br>via Whatsapp
                        @endif
                    </div>
                </div>
            </div>

            @if($isOffline)
            {{-- Tempat Konseling --}}
            <div class="border-t border-gray-200 p-4 flex flex-col justify-start hover:bg-[#f8f9fa] transition-colors">
                <div class="flex items-center gap-2 mb-2.5">
                    {{-- Home Icon --}}
                    <svg class="text-[#a1c4c8]" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    <span class="text-[#8e98a8] text-[11px] font-medium">Tempat Konseling</span>
                </div>
                <div class="text-[#1a1a2e] text-[12px] font-semibold leading-relaxed">
                    {{ $location }}
                </div>
            </div>
            @endif
        </div>

        @if(!$isOffline)
        {{-- Whatsapp Button --}}
        <a href="{{ $waLink }}" target="_blank" class="border border-gray-200 rounded-[14px] py-3.5 flex items-center justify-center gap-3 hover:bg-gray-50 transition-all duration-300 hover:shadow-md hover:border-[#25D366] transform hover:-translate-y-0.5 active:scale-95 mb-6 mx-auto w-full max-w-[85%] shadow-sm">
            <svg class="text-[#25D366]" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                <path d="M16.5 16c0-1-.5-2-1.5-2-.6 0-1 .4-1.4.8-.4-.2-.8-.4-1.2-.7s-.8-.8-1-1.2c.4-.4.8-.8.8-1.4 0-1-1-1.5-2-1.5-.4 0-.8.2-1.1.5-.3.3-.4.7-.4 1.1 0 1.2 1 3 3.5 4.5 1.5 1 2.5 1.5 3.5 1.5.4 0 .8-.1 1.1-.4.3-.3.5-.7.5-1.1z"></path>
            </svg>
            <span class="text-[#1a1a2e] text-[13px] font-bold">{{ $waName }}</span>
        </a>
        @endif

        {{-- Return Button --}}
        <a href="{{ route('dashboard') }}" class="block w-full bg-[#96b6b9] text-white text-center font-bold text-[14px] py-4 rounded-xl shadow-sm hover:bg-[#85a3a6] transition-all duration-300 hover:shadow-lg transform hover:-translate-y-0.5 active:scale-95">
            Kembali ke home
        </a>

    </div>

</div>
@endsection
