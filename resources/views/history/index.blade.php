@extends('layouts.mobile-emulator')

@section('title', 'FilkomCare - Riwayat')

@section('content')
<div class="relative w-full h-[844px] bg-[#fafafa] overflow-hidden flex flex-col" x-data="historyApp()">
    
    {{-- Header --}}
    <div class="px-6 pt-12 pb-4 bg-white z-10 rounded-b-[24px]">
        <h1 class="text-[#1a1a2e] text-[20px] font-bold tracking-tight mb-5">Riwayat Konsultasi</h1>
        
        {{-- Search Bar --}}
        <div class="relative mb-5">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="text-[#3d4a5e]" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </div>
            <input type="text" x-model="search" placeholder="Cari Riwayat Konsultasi..." class="w-full bg-[#b8d6da] bg-opacity-70 text-[#3d4a5e] placeholder-[#5c6d7a] rounded-xl py-3 pl-11 pr-4 text-[13px] font-medium focus:outline-none transition">
        </div>

        {{-- Filter Chips --}}
        <div class="flex items-center gap-2 overflow-x-auto no-scrollbar pb-1">
            <template x-for="chip in ['Semua', 'Menunggu', 'Diproses', 'Selesai']">
                <button @click="filter = chip" 
                        :class="filter === chip ? 'bg-[#5c687f] text-white' : 'bg-[#fcfcfc] text-[#475569] border border-gray-100'"
                        class="px-5 py-2 rounded-full text-[13px] font-medium whitespace-nowrap transition shadow-sm">
                    <span x-text="chip"></span>
                </button>
            </template>
        </div>
    </div>
    
    {{-- Separator Line (Light grey border attached to header bottom) --}}
    <div class="w-full h-px bg-gray-200"></div>

    {{-- Main Content Area (Scrollable) --}}
    <div class="flex-1 overflow-y-auto pb-[100px] px-6 pt-6">
        
        {{-- Empty State (No Data Ever or Not Found) --}}
        <div x-show="filteredItems.length === 0" class="flex flex-col items-center justify-center pt-8 pb-8" style="display: none;">
            <img src="{{ asset('images/empty_history.png') }}" alt="Empty State" class="w-[280px] mb-8 object-contain">
            <h3 class="text-[#1a1a2e] text-[20px] font-bold text-center leading-snug">Anda belum pernah<br>berkonsultasi</h3>
        </div>

        {{-- List --}}
        <div class="flex flex-col gap-4">
            <template x-for="item in filteredItems" :key="item.id">
                <a :href="'/riwayat/' + item.id" class="block bg-white rounded-[20px] border border-gray-50 p-5 shadow-[0_2px_12px_rgba(0,0,0,0.04)] hover:shadow-[0_4px_16px_rgba(0,0,0,0.06)] transition">
                    
                    {{-- Top Row: ID & Status --}}
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-[#8e98a8] text-[11px] font-bold tracking-wider uppercase" x-text="item.report_id"></span>
                        
                        {{-- Status Badge --}}
                        <div :class="{
                            'border-[#22c55e] text-[#16a34a] bg-[#f0fdf4]': item.status === 'Selesai',
                            'border-[#3b82f6] text-[#2563eb] bg-[#eff6ff]': item.status === 'Diproses',
                            'border-[#d97706] text-[#d97706] bg-[#fffbeb]': item.status === 'Menunggu'
                        }" class="border rounded-full px-3 py-1 flex items-center gap-1.5 shadow-sm">
                            <span class="w-2.5 h-2.5 rounded-full" :class="{
                                'bg-[#22c55e]': item.status === 'Selesai',
                                'bg-[#3b82f6]': item.status === 'Diproses',
                                'bg-[#d97706]': item.status === 'Menunggu'
                            }"></span>
                            <span class="text-[12px] font-bold" x-text="item.status"></span>
                        </div>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-[#3d4a5e] text-[16px] font-bold mb-4" x-text="item.topic"></h3>

                    {{-- Date --}}
                    <div class="flex items-center gap-2">
                        <svg class="text-[#8e98a8]" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        <span class="text-[#8e98a8] text-[13px] font-medium" x-text="formatDate(item.date)"></span>
                    </div>

                </a>
            </template>
        </div>
        
    </div>

    {{-- Bottom Navigation --}}
    <div class="absolute bottom-0 w-full h-[90px] bg-white border-t border-gray-100 flex justify-between px-8 pt-4 pb-6 rounded-b-[40px] z-50 shadow-[0_-4px_20px_rgba(0,0,0,0.03)]">
        {{-- Home --}}
        <a href="{{ route('dashboard') }}" class="flex flex-col items-center w-[60px] text-gray-400 hover:text-[#87B4B8] transition mr-8">
            <svg class="mb-1" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            <span class="text-[10px] font-medium mt-1">Home</span>
        </a>
        
        {{-- Konsultasi --}}
        <a href="{{ route('consultation.index') }}" class="flex flex-col items-center w-[60px] text-gray-400 hover:text-[#87B4B8] transition">
            <svg class="mb-1" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            <span class="text-[10px] font-medium mt-1">Konsultasi</span>
        </a>

        {{-- SOS Button --}}
        <div class="relative -top-8 mx-2">
            <button class="w-[60px] h-[60px] bg-[#df4a56] text-white rounded-full flex items-center justify-center font-bold shadow-[0_8px_20px_rgba(223,74,86,0.4)] hover:bg-[#c93f4a] hover:-translate-y-1 transition duration-300">
                SOS
            </button>
        </div>
        
        {{-- Riwayat --}}
        <a href="{{ route('history.index') }}" class="flex flex-col items-center w-[60px] text-[#87B4B8] transition ml-8">
            <svg class="mb-1" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
            <span class="text-[10px] font-bold mt-1">Riwayat</span>
        </a>

        {{-- Profile --}}
        <a href="#" class="flex flex-col items-center w-[60px] text-gray-400 hover:text-[#87B4B8] transition ml-2">
            <svg class="mb-1" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
            <span class="text-[10px] font-medium mt-1">Profile</span>
        </a>
    </div>

</div>

{{-- Alpine.js for History Page logic --}}
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('historyApp', () => ({
            search: '',
            filter: 'Semua',
            items: @json($consultations),
            
            get filteredItems() {
                return this.items.filter(item => {
                    const matchesSearch = item.topic.toLowerCase().includes(this.search.toLowerCase()) || 
                                          item.report_id.toLowerCase().includes(this.search.toLowerCase());
                    const matchesFilter = this.filter === 'Semua' || item.status === this.filter;
                    return matchesSearch && matchesFilter;
                });
            },
            
            formatDate(dateString) {
                const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                const d = new Date(dateString);
                return d.getDate() + ' ' + months[d.getMonth()] + ' ' + d.getFullYear();
            }
        }))
    })
</script>
@endsection
