@extends('layouts.mobile-emulator')

@section('title', 'FilkomCare - Detail Riwayat')

@section('content')
<div class="relative w-full h-[844px] bg-[#fafafa] overflow-y-auto px-6 pt-12 pb-8">
    
    {{-- Top Bar --}}
    <div class="flex items-center justify-between mb-8">
        <div class="flex items-center gap-4">
            <a href="{{ route('history.index') }}" class="text-[#3d4a5e] transition-all duration-300 transform hover:-translate-x-1 hover:text-[#87B4B8]">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            </a>
            <h1 class="text-[#3d4a5e] text-[20px] font-bold tracking-tight">Detail Konsultasi</h1>
        </div>
        <span class="text-[#64748b] text-[13px] font-bold tracking-wide">{{ $consultation->report_id }}</span>
    </div>

    {{-- Separator Line --}}
    <div class="w-full h-px bg-gray-200 mb-6 -mx-6 w-[calc(100%+3rem)]"></div>

    {{-- Main Card --}}
    <div class="bg-white rounded-[20px] border border-gray-50 shadow-[0_2px_12px_rgba(0,0,0,0.04)] p-6 w-full transition-shadow duration-300 hover:shadow-[0_8px_30px_-4px_rgba(0,0,0,0.08)]">
        
        {{-- Card Header: Report ID & Status Badge --}}
        <div class="flex justify-between items-center mb-5">
            <span class="text-[#8e98a8] text-[11px] font-bold tracking-wider uppercase">{{ $consultation->report_id }}</span>
            
            <div class="{{ 
                $consultation->status === 'Selesai' ? 'border-[#22c55e] text-[#16a34a] bg-[#f0fdf4]' : 
                ($consultation->status === 'Diproses' ? 'border-[#3b82f6] text-[#2563eb] bg-[#eff6ff]' : 
                'border-[#d97706] text-[#d97706] bg-[#fffbeb]') 
            }} border rounded-full px-3 py-1 flex items-center gap-1.5 shadow-sm">
                <span class="w-2.5 h-2.5 rounded-full {{ 
                    $consultation->status === 'Selesai' ? 'bg-[#22c55e]' : 
                    ($consultation->status === 'Diproses' ? 'bg-[#3b82f6]' : 
                    'bg-[#d97706]') 
                }}"></span>
                <span class="text-[12px] font-bold">{{ $consultation->status }}</span>
            </div>
        </div>

        {{-- Topic --}}
        <h2 class="text-[#3d4a5e] text-[16px] font-bold mb-4">{{ $consultation->topic }}</h2>

        {{-- Description --}}
        <p class="text-[#3d4a5e] text-[13px] font-medium leading-[1.6] mb-6">
            {{ $consultation->description }}
        </p>

        {{-- Separator --}}
        <div class="w-full h-px bg-gray-200 mb-5"></div>

        {{-- Date --}}
        <div class="flex items-center gap-2">
            <svg class="text-[#8e98a8]" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            <span class="text-[#8e98a8] text-[13px] font-medium">{{ $formattedDate }}</span>
        </div>

    </div>

</div>
@endsection
