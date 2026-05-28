@extends('layouts.mobile-emulator')

@section('title', 'FilkomCare - Notifikasi')

@section('content')
<div class="relative w-full h-full min-h-[100dvh] md:min-h-0 bg-[#f8f9fa] overflow-hidden flex flex-col">
    
    {{-- Top Bar --}}
    <div class="px-6 pt-12 pb-4 flex items-center justify-between z-10 bg-white">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-[#3d4a5e] transition-all duration-300 transform hover:-translate-x-1 hover:text-[#87B4B8]">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            </a>
            <h1 class="text-[#3d4a5e] text-[20px] font-bold">Notification</h1>
        </div>

        @if($notifications->where('is_read', false)->count() > 0)
        <form action="{{ route('notifications.markAllRead') }}" method="POST">
            @csrf
            <button type="submit" class="text-[#87B4B8] text-[13px] font-bold hover:text-[#6ca3a8] transition">
                Mark as read
            </button>
        </form>
        @endif
    </div>

    {{-- Tab --}}
    <div class="px-6 bg-white pb-0">
        <div class="flex border-b border-gray-100">
            <button class="text-[#87B4B8] text-[14px] font-semibold pb-3 border-b-2 border-[#87B4B8] px-1">
                Reminder
            </button>
        </div>
    </div>

    {{-- Content --}}
    <div class="flex-1 overflow-y-auto px-6 pt-5 pb-8">
        
        @if($notifications->count() > 0)
            <div class="flex flex-col gap-3">
                @foreach($notifications as $notif)
                <div class="bg-white rounded-2xl px-4 py-4 flex items-start gap-3 shadow-[0_2px_8px_rgba(0,0,0,0.04)] {{ !$notif->is_read ? 'border border-[#d2e8eb]' : 'border border-gray-100' }} transition-all duration-300 hover:shadow-md transform hover:-translate-y-0.5 cursor-pointer hover:border-[#87B4B8]/50">
                    {{-- Bell Icon --}}
                    <div class="w-10 h-10 rounded-full {{ !$notif->is_read ? 'bg-[#ddf0f4]' : 'bg-gray-100' }} flex items-center justify-center shrink-0 mt-0.5">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="{{ !$notif->is_read ? '#5c9dab' : '#94a3b8' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                    </div>

                    {{-- Text --}}
                    <div class="flex-1 min-w-0">
                        <div class="flex items-start justify-between gap-2 mb-0.5">
                            <h3 class="text-[#3d4a5e] text-[15px] font-bold leading-tight">{{ $notif->title }}</h3>
                            <div class="flex items-center gap-1.5 shrink-0">
                                <span class="text-gray-400 text-[11px]">{{ $notif->time_ago }}</span>
                                <span class="w-2 h-2 rounded-full shrink-0 {{ !$notif->is_read ? 'bg-[#87B4B8]' : 'bg-[#d1d5db]' }}"></span>
                            </div>
                        </div>
                        <p class="text-[#8e98a8] text-[12px] leading-relaxed">{{ $notif->message }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            {{-- Empty State --}}
            <div class="flex flex-col items-center justify-center h-full">
                <div class="w-20 h-20 bg-[#e0f2f4] rounded-full flex items-center justify-center mb-4">
                    <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="#87B4B8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                </div>
                <p class="text-[#3d4a5e] text-[15px] font-bold">Belum ada notifikasi</p>
                <p class="text-gray-400 text-[12px] mt-1">Notifikasi terbaru akan tampil di sini</p>
            </div>
        @endif

    </div>
</div>
@endsection
