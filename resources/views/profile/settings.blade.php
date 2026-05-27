@extends('layouts.mobile-emulator')

@section('title', 'FilkomCare - Pengaturan')

@section('content')
<div class="relative w-full h-[844px] bg-[#f8f9fa] overflow-hidden flex flex-col" x-data="settingsApp()">
    
    {{-- Top Bar --}}
    <div class="px-6 pt-12 pb-6 flex items-center gap-4 z-10 bg-white border-b border-gray-100 shadow-sm">
        <a href="{{ route('profile.index') }}" class="text-[#1a1a2e] transition-all duration-300 transform hover:-translate-x-1 hover:text-[#87B4B8]">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        </a>
        <h1 class="text-[#1a1a2e] text-[20px] font-bold">Pengaturan</h1>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
    <div class="mx-6 mt-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-[13px] font-medium">
        {{ session('success') }}
    </div>
    @endif
    @if($errors->any())
    <div class="mx-6 mt-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-[13px] font-medium">
        {{ $errors->first() }}
    </div>
    @endif

    {{-- Content --}}
    <div class="flex-1 overflow-y-auto px-6 pt-6 pb-20">
        
        <h2 class="text-[#3d4a5e] text-[14px] font-bold mb-3 uppercase tracking-wider">Aplikasi</h2>
        <div class="bg-white rounded-[24px] shadow-sm p-2 flex flex-col mb-6 transition-shadow duration-300 hover:shadow-md">
            
            {{-- Bahasa --}}
            <button @click="langModalOpen = true" class="flex items-center justify-between p-4 border-b border-gray-100 transition-all duration-300 hover:bg-gray-50 hover:shadow-sm transform hover:-translate-y-0.5 active:scale-95 rounded-xl">
                <div class="flex flex-col text-left">
                    <span class="text-[#3d4a5e] text-[15px] font-bold">Bahasa</span>
                    <span class="text-gray-400 text-[12px]" x-text="selectedLang"></span>
                </div>
                <svg class="text-gray-300" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </button>
            
            {{-- Tema --}}
            <button @click="themeModalOpen = true" class="flex items-center justify-between p-4 transition-all duration-300 hover:bg-gray-50 hover:shadow-sm transform hover:-translate-y-0.5 active:scale-95 rounded-xl mt-1">
                <div class="flex flex-col text-left">
                    <span class="text-[#3d4a5e] text-[15px] font-bold">Tema</span>
                    <span class="text-gray-400 text-[12px]" x-text="selectedTheme"></span>
                </div>
                <svg class="text-gray-300" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </button>

        </div>

        <h2 class="text-[#3d4a5e] text-[14px] font-bold mb-3 uppercase tracking-wider">Zona Berbahaya</h2>
        <div class="bg-white rounded-[24px] shadow-sm p-4 flex flex-col mb-6 border border-red-100 transition-shadow duration-300 hover:shadow-md">
            <p class="text-gray-500 text-[13px] mb-4">
                Menghapus akun akan menghilangkan seluruh riwayat konsultasi dan data diri Anda secara permanen. Tindakan ini tidak dapat dibatalkan.
            </p>
            <button @click="deleteModalOpen = true" class="w-full bg-[#fde9eb] text-[#df4a56] font-bold py-3.5 rounded-xl text-[14px] transition-all duration-300 hover:bg-[#fad8db] shadow-sm hover:shadow-md transform hover:-translate-y-0.5 active:scale-95">
                Hapus Akun Permanen
            </button>
        </div>

        <div class="mt-8 flex flex-col items-center justify-center">
            <img src="{{ asset('images/logo-filkomcare.png') }}" alt="FilkomCare Logo" class="h-8 mb-2 opacity-50 grayscale">
            <p class="text-gray-400 text-[12px] font-medium">Versi 1.0.0 (Build 245)</p>
        </div>
        
    </div>

    {{-- ===== Language Modal ===== --}}
    <div x-show="langModalOpen" class="absolute inset-0 bg-black bg-opacity-40 z-50 flex items-end" x-transition.opacity style="display: none;">
        <div @click.away="langModalOpen = false" class="bg-white w-full rounded-t-[30px] pt-4 px-6 pb-8" 
             x-show="langModalOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-y-full"
             x-transition:enter-end="translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-y-0"
             x-transition:leave-end="translate-y-full">
            <div class="w-[40px] h-[4px] bg-gray-200 rounded-full mx-auto mb-6"></div>
            <h3 class="font-bold text-[#1a1a2e] text-[16px] mb-6">Pilih Bahasa</h3>
            
            <div class="flex flex-col gap-3">
                <template x-for="lang in languages" :key="lang">
                    <button @click="selectedLang = lang; langModalOpen = false; saveSetting('lang', lang)" 
                            class="flex items-center justify-between p-4 border rounded-xl transition-all duration-300 transform hover:-translate-y-0.5 active:scale-95 hover:shadow-sm"
                            :class="selectedLang === lang ? 'border-[#87B4B8] bg-[#f0f7f8]' : 'border-gray-200'">
                        <span class="text-[#3d4a5e] text-[14px] font-medium" x-text="lang"></span>
                        <div class="w-5 h-5 rounded-full border flex items-center justify-center"
                             :class="selectedLang === lang ? 'border-[#87B4B8]' : 'border-gray-300'">
                            <div class="w-3 h-3 rounded-full bg-[#87B4B8]" x-show="selectedLang === lang"></div>
                        </div>
                    </button>
                </template>
            </div>
        </div>
    </div>

    {{-- ===== Theme Modal ===== --}}
    <div x-show="themeModalOpen" class="absolute inset-0 bg-black bg-opacity-40 z-50 flex items-end" x-transition.opacity style="display: none;">
        <div @click.away="themeModalOpen = false" class="bg-white w-full rounded-t-[30px] pt-4 px-6 pb-8"
             x-show="themeModalOpen"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-y-full"
             x-transition:enter-end="translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-y-0"
             x-transition:leave-end="translate-y-full">
            <div class="w-[40px] h-[4px] bg-gray-200 rounded-full mx-auto mb-6"></div>
            <h3 class="font-bold text-[#1a1a2e] text-[16px] mb-6">Pilih Tema</h3>
            
            <div class="flex flex-col gap-3">
                <template x-for="theme in themes" :key="theme">
                    <button @click="selectedTheme = theme; themeModalOpen = false; saveSetting('theme', theme)"
                            class="flex items-center justify-between p-4 border rounded-xl transition-all duration-300 transform hover:-translate-y-0.5 active:scale-95 hover:shadow-sm"
                            :class="selectedTheme === theme ? 'border-[#87B4B8] bg-[#f0f7f8]' : 'border-gray-200'">
                        <span class="text-[#3d4a5e] text-[14px] font-medium" x-text="theme"></span>
                        <div class="w-5 h-5 rounded-full border flex items-center justify-center"
                             :class="selectedTheme === theme ? 'border-[#87B4B8]' : 'border-gray-300'">
                            <div class="w-3 h-3 rounded-full bg-[#87B4B8]" x-show="selectedTheme === theme"></div>
                        </div>
                    </button>
                </template>
            </div>
        </div>
    </div>

    {{-- ===== Delete Account Confirmation Modal ===== --}}
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
                <p class="text-gray-500 text-[13px] text-center leading-relaxed">Semua data kamu akan dihapus permanen. Masukkan password untuk konfirmasi.</p>
            </div>

            <form action="{{ route('profile.deleteAccount') }}" method="POST">
                @csrf
                <div class="mb-5">
                    <input type="password" name="confirm_password" required placeholder="Masukkan password kamu" 
                           class="w-full bg-[#f8f9fa] border border-gray-200 text-[#3d4a5e] rounded-xl py-3 px-4 text-[14px] transition-all duration-300 focus:outline-none focus:border-red-400 focus:ring-2 focus:ring-red-400/20 focus:bg-white hover:border-red-200">
                </div>
                <div class="flex gap-3">
                    <button type="button" @click="deleteModalOpen = false" class="flex-1 py-3 rounded-xl bg-gray-100 text-gray-500 font-bold transition-all duration-300 hover:bg-gray-200 hover:shadow-sm transform hover:-translate-y-0.5 active:scale-95">Batal</button>
                    <button type="submit" class="flex-1 py-3 rounded-xl bg-[#df4a56] text-white font-bold transition-all duration-300 hover:bg-[#c0394a] shadow-sm hover:shadow-md transform hover:-translate-y-0.5 active:scale-95">Hapus</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('settingsApp', () => ({
            langModalOpen: false,
            themeModalOpen: false,
            deleteModalOpen: false,
            
            selectedLang: localStorage.getItem('filkomcare_lang') || 'Indonesia',
            selectedTheme: localStorage.getItem('filkomcare_theme') || 'Terang (Light)',
            
            languages: ['Indonesia', 'English'],
            themes: ['Terang (Light)', 'Gelap (Dark)', 'Sistem (Auto)'],

            saveSetting(key, value) {
                localStorage.setItem('filkomcare_' + key, value);
            }
        }))
    })
</script>
@endsection
