@extends('layouts.mobile-emulator')

@section('title', 'FilkomCare - Riwayat')

@section('content')
<div class="relative w-full h-[844px] bg-[#fafafa] overflow-hidden flex flex-col" x-data="historyApp()">
    
    {{-- Header --}}
    <div class="px-6 pt-12 pb-4 bg-white z-10 rounded-b-[24px]">
        <h1 class="text-[#3d4a5e] text-[20px] font-bold tracking-tight mb-5">Riwayat Konsultasi</h1>
        
        {{-- Search Bar --}}
        <div class="relative mb-5">
            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                <svg class="text-[#8e98a8]" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </div>
            <input type="text" x-model="search" placeholder="Cari Riwayat Konsultasi..." class="w-full bg-white border border-gray-200 shadow-sm text-[#3d4a5e] placeholder-[#8e98a8] rounded-xl py-3 pl-11 pr-4 text-[13px] font-medium transition-all duration-300 focus:outline-none focus:border-[#87B4B8] focus:ring-2 focus:ring-[#87B4B8]/20 hover:border-gray-300">
        </div>

        {{-- Filter Chips --}}
        <div class="flex items-center gap-2 overflow-x-auto no-scrollbar pb-1">
            <template x-for="chip in ['Semua', 'Menunggu', 'Diproses', 'Selesai']">
                <button @click="filter = chip" 
                        :class="filter === chip ? 'bg-[#87B4B8] text-white shadow-md' : 'bg-[#fcfcfc] text-[#475569] border border-gray-100 hover:bg-gray-50'"
                        class="px-5 py-2 rounded-full text-[13px] font-medium whitespace-nowrap transition-all duration-300 shadow-sm hover:shadow-md transform hover:-translate-y-0.5 active:scale-95">
                    <span x-text="chip"></span>
                </button>
            </template>
        </div>
    </div>
    
    {{-- Separator Line (Light grey border attached to header bottom) --}}
    <div class="w-full h-px bg-gray-200"></div>

    {{-- Main Content Area (Scrollable) --}}
    <div class="flex-1 overflow-y-auto pb-[100px] px-6 pt-6 flex flex-col">
        
        {{-- Empty State (No Data Ever or Not Found) --}}
        <div x-show="filteredItems.length === 0" class="flex-1 flex flex-col items-center justify-center pb-20 mt-10" style="display: none;">
            <img src="{{ asset('images/empty_history.png') }}" alt="Empty State" class="w-[260px] mb-6 object-contain transition-transform duration-500 hover:-translate-y-2">
            <h3 class="text-[#3d4a5e] text-[20px] font-bold text-center leading-tight">Anda belum pernah<br>berkonsultasi</h3>
        </div>

        {{-- List --}}
        <div class="flex flex-col gap-4">
            <template x-for="item in filteredItems" :key="item.id">
                <a :href="'{{ url('/riwayat') }}/' + item.id" class="block bg-white rounded-[20px] border border-gray-50 p-5 shadow-[0_2px_12px_rgba(0,0,0,0.04)] hover:shadow-[0_4px_16px_rgba(135,180,184,0.3)] hover:border-[#87B4B8] transition-all duration-300 transform hover:-translate-y-1 active:scale-[0.98]">
                    
                    {{-- Top Row: ID & Status --}}
                    <div class="flex justify-between items-center mb-2">
                        <span class="text-[#8e98a8] text-[11px] font-bold tracking-wider uppercase" x-text="item.report_id"></span>
                        
                        {{-- Status Badge --}}
                        <div :class="{
                            'border-[#22c55e] text-[#16a34a] bg-[#f0fdf4]': item.status === 'Selesai',
                            'border-[#3b82f6] text-[#2563eb] bg-[#eff6ff]': item.status === 'Diproses',
                            'border-[#d97706] text-[#d97706] bg-[#fffbeb]': item.status === 'Menunggu'
                        }" class="border rounded-full px-3 py-1 flex items-center gap-1.5 shadow-sm transition-colors duration-300">
                            <span class="w-2.5 h-2.5 rounded-full" :class="{
                                'bg-[#22c55e]': item.status === 'Selesai',
                                'bg-[#3b82f6]': item.status === 'Diproses',
                                'bg-[#d97706]': item.status === 'Menunggu'
                            }"></span>
                            <span class="text-[12px] font-bold" x-text="item.status"></span>
                        </div>
                    </div>

                    {{-- Title --}}
                    <h3 class="text-[#3d4a5e] text-[16px] font-bold mb-4 group-hover:text-[#87B4B8] transition-colors" x-text="item.topic"></h3>

                    {{-- Date --}}
                    <div class="flex items-center gap-2">
                        <svg class="text-[#8e98a8]" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                        <span class="text-[#8e98a8] text-[13px] font-medium" x-text="formatDate(item.date)"></span>
                    </div>

                </a>
            </template>
        </div>
        
    </div>

    @include('components.bottom-nav', ['active' => 'history'])
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
