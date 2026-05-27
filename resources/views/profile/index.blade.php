@extends('layouts.mobile-emulator')

@section('title', 'FilkomCare - Profile')

@section('content')
<div class="relative w-full h-[844px] bg-[#f8f9fa] overflow-hidden flex flex-col" x-data="profileApp()">
    
    {{-- Dark Header Area --}}
    <div class="relative h-[160px] bg-[#5c687f] w-full pt-14 px-6 z-0">
        <h1 class="text-white text-[20px] font-bold tracking-wide">My Account</h1>
    </div>

    {{-- Profile Card (Overlapping header) --}}
    <div class="px-6 -mt-16 z-10">
        <div class="bg-white rounded-3xl p-6 shadow-[0_8px_30px_rgba(0,0,0,0.06)] flex items-center gap-5">
            {{-- Initials Avatar --}}
            <div class="w-[85px] h-[85px] rounded-full bg-[#f4ece3] flex items-center justify-center shrink-0">
                <span class="text-[#3d4a5e] text-[32px] font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}{{ strtoupper(substr(strrchr(Auth::user()->name, ' '), 1, 1) ?: '') }}
                </span>
            </div>
            
            {{-- User Details --}}
            <div class="flex-1">
                <h2 class="text-[#3d4a5e] text-[20px] font-bold mb-1">{{ Auth::user()->name }}</h2>
                <p class="text-[#5c6d7a] text-[12px] font-medium mb-1">{{ Auth::user()->nim ?? 'NIM belum diisi' }}</p>
                <p class="text-[#5c6d7a] text-[12px] font-medium leading-snug">{{ Auth::user()->department ?? 'Program Studi belum diisi' }}</p>
            </div>
        </div>
    </div>

    @php
        $isProfileComplete = !empty(Auth::user()->nim) && !empty(Auth::user()->department) && !empty(Auth::user()->phone_number);
    @endphp

    @if(!$isProfileComplete)
        {{-- Incomplete Profile Banner --}}
        <div class="px-6 mt-8 z-10 flex-1">
            <div class="bg-[#f0f7f8] border border-[#d2e8eb] rounded-2xl p-5 text-center shadow-sm">
                <div class="w-16 h-16 bg-[#e0f2f4] text-[#3ab3c3] rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                </div>
                <h3 class="text-[#207c88] font-bold text-[16px] mb-2">Lengkapi Data Diri</h3>
                <p class="text-[#4b9ba6] text-[13px] leading-relaxed mb-6">
                    Hai {{ explode(' ', Auth::user()->name)[0] }}, kamu belum bisa mengakses menu profile nih. Yuk lengkapi NIM, Program Studi, dan Nomor WhatsApp kamu dulu!
                </p>
                <a href="{{ route('profile.edit') }}" class="inline-block w-full bg-[#87B4B8] text-white font-bold py-3.5 px-6 rounded-xl text-[14px] shadow-md hover:bg-[#6ca3a8] transition">
                    Lengkapi Sekarang
                </a>
            </div>
            
            {{-- Sign Out Button (Always visible) --}}
            <div class="mt-8 mb-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-[#fde9eb] border border-[#f5c6cb] text-[#df4a56] font-bold py-3.5 rounded-xl text-[15px] hover:bg-[#fad8db] transition-all duration-300 shadow-sm hover:shadow-md transform hover:-translate-y-0.5 active:scale-95">
                        Sign Out
                    </button>
                </form>
            </div>
        </div>
    @else
        {{-- Edit Profile Button --}}
        <div class="flex justify-center mt-6 z-10">
            <a href="{{ route('profile.edit') }}" class="bg-[#87B4B8] text-white font-bold py-2 px-6 rounded-lg text-[13px] hover:bg-[#6ca3a8] transition-all duration-300 shadow-sm hover:shadow-md transform hover:-translate-y-0.5 active:scale-95">
                Edit Profile
            </a>
        </div>

        {{-- Main Menu List --}}
        <div class="px-6 mt-8 flex-1 overflow-y-auto pb-[140px] z-10">

            @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-[13px] font-medium">
                {{ session('success') }}
            </div>
            @endif
            @if($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-[13px] font-medium">
                {{ $errors->first() }}
            </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm p-4">
                
                {{-- Menu Items --}}
                <a href="{{ route('profile.privacy') }}" class="flex items-center justify-between py-4 border-b border-gray-100 last:border-b-0 group hover:bg-gray-50 rounded-lg px-2 transition-all duration-300 transform hover:translate-x-1">
                    <span class="text-[#3d4a5e] text-[15px] font-medium group-hover:text-[#87B4B8] transition-colors">Privasi & Keamanan</span>
                    <svg class="text-gray-300 group-hover:text-[#87B4B8] transition-colors" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </a>
                
                <a href="{{ route('profile.notifications') }}" class="flex items-center justify-between py-4 border-b border-gray-100 last:border-b-0 group hover:bg-gray-50 rounded-lg px-2 transition-all duration-300 transform hover:translate-x-1">
                    <span class="text-[#3d4a5e] text-[15px] font-medium group-hover:text-[#87B4B8] transition-colors">Preferensi Notifikasi</span>
                    <svg class="text-gray-300 group-hover:text-[#87B4B8] transition-colors" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </a>
                
                <a href="{{ route('profile.faq') }}" class="flex items-center justify-between py-4 group hover:bg-gray-50 rounded-lg px-2 transition-all duration-300 transform hover:translate-x-1">
                    <span class="text-[#3d4a5e] text-[15px] font-medium group-hover:text-[#87B4B8] transition-colors">Bantuan & FAQ</span>
                    <svg class="text-gray-300 group-hover:text-[#87B4B8] transition-colors" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </a>
            </div>

            {{-- Sign Out Button --}}
            <div class="mt-8 mb-3">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full bg-[#fde9eb] border border-[#f5c6cb] text-[#df4a56] font-bold py-3.5 rounded-xl text-[15px] hover:bg-[#fad8db] transition-all duration-300 shadow-sm hover:shadow-md transform hover:-translate-y-0.5 active:scale-95">
                        Sign Out
                    </button>
                </form>
            </div>

            {{-- Delete Account Button --}}
            <div class="mb-4">
                <button @click="deleteModalOpen = true" class="w-full text-gray-400 text-[13px] font-medium hover:text-[#df4a56] transition py-2">
                    Hapus Akun Permanen
                </button>
            </div>
            
            {{-- Footer Text --}}
            <div class="text-center text-gray-400 text-[13px] font-medium">
                FilkomCare v1.0.0 | UKLT Filkom
            </div>
        </div>
    @endif

    {{-- ===== Delete Account Modal ===== --}}
    <div x-show="deleteModalOpen" class="absolute inset-0 bg-black bg-opacity-40 z-50 flex items-center justify-center p-6" x-transition.opacity style="display: none;">
        <div class="bg-white w-full rounded-2xl p-6 shadow-2xl" x-show="deleteModalOpen" x-transition.scale>
            <div class="flex flex-col items-center mb-6">
                <div class="w-16 h-16 bg-[#fde9eb] rounded-full flex items-center justify-center mb-4">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#df4a56" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="3 6 5 6 21 6"></polyline>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                        <line x1="10" y1="11" x2="10" y2="17"></line>
                        <line x1="14" y1="11" x2="14" y2="17"></line>
                    </svg>
                </div>
                <h3 class="text-[#1a1a2e] text-[18px] font-bold mb-1">Hapus Akun?</h3>
                <p class="text-gray-500 text-[13px] text-center leading-relaxed">Semua data kamu akan dihapus permanen dan tidak bisa dikembalikan. Masukkan password untuk konfirmasi.</p>
            </div>

            <form action="{{ route('profile.deleteAccount') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <input type="password" name="confirm_password" required placeholder="Masukkan password kamu" 
                           class="w-full bg-[#f8f9fa] border border-gray-200 text-[#3d4a5e] rounded-xl py-3 px-4 text-[14px] focus:outline-none focus:border-red-300 transition">
                </div>
                <div class="flex gap-3">
                    <button type="button" @click="deleteModalOpen = false" class="flex-1 py-3 rounded-xl bg-gray-100 text-gray-500 font-bold hover:bg-gray-200 transition">Batal</button>
                    <button type="submit" class="flex-1 py-3 rounded-xl bg-[#df4a56] text-white font-bold hover:bg-[#c0394a] transition">Hapus</button>
                </div>
            </form>
        </div>
    </div>

    @include('components.bottom-nav', ['active' => 'profile'])
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('profileApp', () => ({
            deleteModalOpen: false
        }))
    })
</script>
@endsection

