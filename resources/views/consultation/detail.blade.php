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
        <h1 class="text-[#3d4a5e] text-[20px] font-bold tracking-tight">Detail Sesi Konseling</h1>
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
            <h2 class="text-[#3d4a5e] text-[15px] font-semibold">{{ $user->name }}</h2>
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
                    <div class="text-[#3d4a5e] text-[12px] font-semibold leading-relaxed">
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
                    <div class="text-[#3d4a5e] text-[12px] font-semibold leading-relaxed">
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
                <div class="text-[#3d4a5e] text-[12px] font-semibold leading-relaxed">
                    {{ $location }}
                </div>
            </div>
            @endif
        </div>

        @if(!$isOffline)
        {{-- Whatsapp Button --}}
        <a href="{{ $waLink }}" target="_blank" class="border border-gray-200 rounded-[14px] py-3.5 flex items-center justify-center gap-3 hover:bg-gray-50 transition-all duration-300 hover:shadow-md hover:border-[#25D366] transform hover:-translate-y-0.5 active:scale-95 mb-6 mx-auto w-full max-w-[85%] shadow-sm">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="#25D366" xmlns="http://www.w3.org/2000/svg">
                <path d="M12.0031 0C5.37895 0 0 5.38555 0 12.0223C0 14.1481 0.558362 16.1437 1.54519 17.8821L0.354144 22.2536L4.82194 21.0827C6.48624 21.9687 8.39704 22.4939 12.0031 22.4939C18.6272 22.4939 24 17.1084 24 10.4716C24 3.83486 18.6272 0 12.0031 0ZM18.5284 16.5501C18.2588 17.3101 16.9248 17.9734 16.1804 18.069C15.5843 18.145 14.7705 18.2404 11.8394 17.0267C8.09312 15.4746 5.6798 11.6666 5.4938 11.4191C5.30781 11.1716 3.96347 9.38711 3.96347 7.54536C3.96347 5.7036 4.88414 4.80998 5.25624 4.41999C5.5539 4.10601 6.03741 3.95383 6.50232 3.95383C6.65103 3.95383 6.7812 3.96347 6.89278 3.97298C7.30198 4.01099 7.50654 4.02984 7.78546 4.70494C8.1388 5.55998 8.9943 7.65063 9.08726 7.84091C9.18022 8.03119 9.329 8.27855 9.19883 8.5259C9.06866 8.77326 8.95708 8.8778 8.77109 9.08709C8.5851 9.29638 8.40854 9.44855 8.22256 9.67675C8.0552 9.88585 7.85994 10.1141 8.08307 10.4942C8.3062 10.8744 9.06866 12.1192 10.1939 13.1264C11.6445 14.424 12.8253 14.8329 13.2345 15.0232C13.6437 15.2134 14.0715 15.1754 14.3504 14.8806C14.7037 14.5097 15.1315 13.8443 15.5779 13.1979C15.894 12.7225 16.3217 12.6653 16.7681 12.8364C17.2144 13.0076 19.5762 14.177 20.0411 14.4052C20.506 14.6334 20.822 14.7476 20.9336 14.9379C21.0452 15.1281 21.0452 16.0315 20.6734 16.7915L18.5284 16.5501Z" />
            </svg>
            <span class="text-[#3d4a5e] text-[13px] font-bold">{{ $waName }}</span>
        </a>
        @endif

        {{-- Return Button --}}
        <a href="{{ route('dashboard') }}" class="block w-full bg-[#96b6b9] text-white text-center font-bold text-[14px] py-4 rounded-xl shadow-sm hover:bg-[#85a3a6] transition-all duration-300 hover:shadow-lg transform hover:-translate-y-0.5 active:scale-95">
            Kembali ke home
        </a>

    </div>

</div>
@endsection
