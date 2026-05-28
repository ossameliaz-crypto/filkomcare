@extends('layouts.mobile-emulator')

@section('title', 'FilkomCare - Konsultasi')
@section('page-name', 'Konsultasi')

@section('content')
<div x-data="consultationApp()" class="relative w-full h-full min-h-[100dvh] md:min-h-0 bg-white overflow-hidden pb-[70px]">

    {{-- Content Area (Scrollable) --}}
    <form action="{{ route('consultation.store') }}" method="POST" class="h-full overflow-y-auto hide-scrollbar px-6 pt-12 pb-8">
        @csrf
        <input type="hidden" name="date" :value="selectedFullDate">
        <input type="hidden" name="time" :value="selectedTime">
        <input type="hidden" name="service" :value="tab === 'online' ? selectedOnlineService : selectedOfflineService">
        
        {{-- Header --}}
        <h1 class="text-[#3d4a5e] text-[22px] font-bold mb-8">Konseling</h1>

        {{-- Tabs --}}
        <div class="bg-[#f0f2f5] rounded-xl p-1 flex mb-8">
            <button @click="tab = 'online'" :class="{'bg-[#5b687b] text-white': tab === 'online', 'text-[#94a3b8] bg-transparent': tab !== 'online'}" class="flex-1 py-2 text-[14px] font-semibold rounded-lg transition">Online</button>
            <button @click="tab = 'tatap_muka'" :class="{'bg-[#5b687b] text-white': tab === 'tatap_muka', 'text-[#94a3b8] bg-transparent': tab !== 'tatap_muka'}" class="flex-1 py-2 text-[14px] font-semibold rounded-lg transition">Tatap Muka</button>
        </div>

        {{-- Tanggal Selector --}}
        <div class="mb-6">
            <div class="flex justify-between items-center mb-3">
                <span class="text-[#64748b] text-[14px] font-medium">Pilih berdasarkan jadwal</span>
                <div class="relative w-5 h-5 flex items-center justify-center">
                    <input type="date" x-model="selectedFullDate" @change="updateDatesFromPicker($event.target.value)" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10 hover:scale-110 transition-transform" style="-webkit-appearance: none;">
                    <svg class="text-[#a1c4c8] relative z-0 transition-all hover:scale-110" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                </div>
            </div>
            
            <div class="flex overflow-x-auto gap-3 hide-scrollbar -mx-6 px-6 pb-4 pt-1">
                <template x-for="item in dates" :key="item.date">
                    <button type="button" @click="selectedDate = item.date; selectedFullDate = item.fullDate; autoSelectAvailableTime();" 
                            :class="{'border-[#5b687b] bg-[#f3ede3] text-[#5b687b] shadow-md -translate-y-1': selectedDate === item.date, 'border-transparent bg-[#f8f9fa] text-[#cbd5e1] hover:bg-gray-100': selectedDate !== item.date}"
                            class="shrink-0 flex flex-col items-center justify-center w-[55px] h-[75px] rounded-2xl border transition-all duration-300 transform hover:-translate-y-1 hover:shadow-md">
                        <span class="text-[11px] mb-1 font-medium" :class="{'text-[#5b687b]': selectedDate === item.date, 'text-[#cbd5e1]': selectedDate !== item.date}" x-text="item.day"></span>
                        <div class="w-[12px] h-[1.5px] mb-1 rounded-full" :class="{'bg-[#5b687b]': selectedDate === item.date, 'bg-[#cbd5e1]': selectedDate !== item.date}"></div>
                        <span class="text-[20px] font-bold" :class="{'text-[#5b687b]': selectedDate === item.date, 'text-[#cbd5e1]': selectedDate !== item.date}" x-text="item.date"></span>
                    </button>
                </template>
            </div>
        </div>

        {{-- Waktu Konseling --}}
        <div class="mb-6">
            <span class="block text-[#8e98a8] text-[14px] font-medium mb-2">Pilih waktu konseling</span>
            <button @click="timeModalOpen = true" class="w-full flex items-center justify-between border border-gray-200 rounded-xl px-4 py-3 bg-[#f8f9fa] text-left transition-all duration-300 hover:border-[#bce8ee] hover:bg-white hover:shadow-sm transform hover:-translate-y-0.5 group">
                <span class="text-[#a1abb9] text-[13px] group-hover:text-[#3d4a5e] transition-colors" x-text="selectedTime"></span>
                <svg class="text-[#a1abb9] group-hover:text-[#3d4a5e] transition-colors" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </button>
        </div>

        {{-- Pilih Layanan --}}
        <div class="mb-6">
            <span class="block text-[#8e98a8] text-[14px] font-medium mb-2">Pilih layanan</span>
            <button @click="serviceModalOpen = true" class="w-full flex items-center justify-between border border-gray-200 rounded-xl px-4 py-3 bg-[#f8f9fa] text-left transition-all duration-300 hover:border-[#bce8ee] hover:bg-white hover:shadow-sm transform hover:-translate-y-0.5 group">
                <span class="text-[#a1abb9] text-[13px] group-hover:text-[#3d4a5e] transition-colors" x-text="tab === 'online' ? selectedOnlineService : selectedOfflineService"></span>
                <svg class="text-[#a1abb9] group-hover:text-[#3d4a5e] transition-colors" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </button>
        </div>

        {{-- Topik Konsultasi --}}
        <div class="mb-6">
            <span class="block text-[#8e98a8] text-[14px] font-medium mb-2">Topik Konsultasi</span>
            <input type="text" name="topic" required placeholder="Contoh: Masalah Akademik" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-[#f8f9fa] text-[13px] text-[#3d4a5e] transition-all duration-300 focus:outline-none focus:border-[#87B4B8] focus:ring-2 focus:ring-[#87B4B8]/20 focus:bg-white hover:border-[#bce8ee]">
        </div>

        {{-- Deskripsi Singkat --}}
        <div class="mb-8">
            <span class="block text-[#8e98a8] text-[14px] font-medium mb-2">Deskripsi Singkat</span>
            <input type="text" name="description" required placeholder="Contoh: Stres berlebih karena tekanan project" class="w-full border border-gray-200 rounded-xl px-4 py-3 bg-[#f8f9fa] text-[13px] text-[#3d4a5e] transition-all duration-300 focus:outline-none focus:border-[#87B4B8] focus:ring-2 focus:ring-[#87B4B8]/20 focus:bg-white hover:border-[#bce8ee]">
        </div>

        {{-- Checkbox Persetujuan --}}
        <div class="mb-6 flex items-start gap-3">
            <input type="checkbox" id="agreement" name="agreement" required class="mt-1 w-4 h-4 text-[#87B4B8] bg-white border-gray-300 rounded focus:ring-2 focus:ring-[#87B4B8]/30 transition-shadow cursor-pointer hover:shadow-sm">
            <label for="agreement" class="text-[12px] text-gray-500 leading-relaxed cursor-pointer hover:text-gray-700 transition-colors">
                Saya menyetujui persyaratan layanan dan memahami bahwa sesi konseling hanya diproses pada <strong>Senin - Jumat, 09.00 - 17.00 WIB</strong>.
            </label>
        </div>

        {{-- Kirim Button --}}
        <button type="submit" :disabled="selectedTime === 'Penuh'" :class="{'opacity-50 cursor-not-allowed': selectedTime === 'Penuh'}" class="w-full bg-[#a1c4c8] text-white font-bold text-[14px] py-4 rounded-xl mb-4 shadow-sm hover:shadow-lg hover:bg-[#8eb2b6] transition-all duration-300 transform hover:-translate-y-0.5 active:scale-95">
            Kirim
        </button>

    </form>

    @include('components.bottom-nav', ['active' => 'consultation'])

    {{-- Bottom Sheet: Waktu Konseling --}}
    <div x-show="timeModalOpen" class="absolute inset-0 z-50 flex flex-col justify-end" style="display: none;">
        <div x-show="timeModalOpen" x-transition.opacity @click="timeModalOpen = false" class="absolute inset-0 bg-black/20"></div>
        
        <div x-show="timeModalOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-y-full"
             x-transition:enter-end="translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-y-0"
             x-transition:leave-end="translate-y-full"
             class="relative bg-white w-full rounded-t-[30px] pt-4 px-6 pb-8 min-h-[400px]">
            
            <div class="w-[40px] h-[4px] bg-gray-200 rounded-full mx-auto mb-6"></div>
            
            <h3 class="font-bold text-[#3d4a5e] text-[15px] mb-1">Waktu Konseling</h3>
            <p class="text-[13px] text-[#3d4a5e] mb-6">Pagi - Siang - Sore</p>
            
            <div class="grid grid-cols-3 gap-3 mb-8">
                <template x-for="time in times" :key="time">
                    <button type="button" @click="if(!isBooked(time)) selectedTime = time"
                            :disabled="isBooked(time)"
                            :class="{
                                'bg-[#fee2e2] border-[#fca5a5] text-[#ef4444] cursor-not-allowed shadow-inner': isBooked(time),
                                'bg-[#f3ede3] border-[#a1c4c8] text-[#3d4a5e]': selectedTime === time && !isBooked(time), 
                                'border-gray-200 text-[#a1abb9]': selectedTime !== time && !isBooked(time)
                            }"
                            class="border rounded-xl py-2 text-[12px] font-medium transition" x-text="time"></button>
                </template>
            </div>
            
            <button @click="timeModalOpen = false" class="w-full bg-[#a1c4c8] text-white font-bold text-[14px] py-4 rounded-xl shadow-sm hover:bg-[#8eb2b6] transition">
                Pilih Waktu
            </button>
        </div>
    </div>

    {{-- Bottom Sheet: Layanan --}}
    <div x-show="serviceModalOpen" class="absolute inset-0 z-50 flex flex-col justify-end" style="display: none;">
        <div x-show="serviceModalOpen" x-transition.opacity @click="serviceModalOpen = false" class="absolute inset-0 bg-black/20"></div>
        
        <div x-show="serviceModalOpen" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-y-full"
             x-transition:enter-end="translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-y-0"
             x-transition:leave-end="translate-y-full"
             class="relative bg-white w-full rounded-t-[30px] pt-4 px-6 pb-8 min-h-[300px]">
            
            <div class="w-[40px] h-[4px] bg-gray-200 rounded-full mx-auto mb-6"></div>
            
            <h3 class="font-bold text-[#3d4a5e] text-[15px] mb-6" x-text="tab === 'online' ? 'Layanan online yang dipilih' : 'Layanan tatap muka yang dipilih'"></h3>
            
            <div class="flex flex-col gap-5 mb-8">
                <template x-if="tab === 'online'">
                    <template x-for="service in onlineServices" :key="service">
                        <label class="flex items-center justify-between cursor-pointer">
                            <span class="text-[14px] text-[#3d4a5e]" x-text="service"></span>
                            <input type="radio" name="service" :value="service" x-model="selectedOnlineService" class="hidden">
                            <div class="w-5 h-5 rounded-full border flex items-center justify-center"
                                 :class="{'border-[#3d4a5e]': selectedOnlineService === service, 'border-gray-300': selectedOnlineService !== service}">
                                 <div class="w-3 h-3 rounded-full bg-[#3d4a5e]" x-show="selectedOnlineService === service"></div>
                            </div>
                        </label>
                    </template>
                </template>
                
                <template x-if="tab === 'tatap_muka'">
                    <template x-for="service in offlineServices" :key="service">
                        <label class="flex items-center justify-between cursor-pointer">
                            <span class="text-[14px] text-[#3d4a5e]" x-text="service"></span>
                            <input type="radio" name="service" :value="service" x-model="selectedOfflineService" class="hidden">
                            <div class="w-5 h-5 rounded-full border flex items-center justify-center"
                                 :class="{'border-[#3d4a5e]': selectedOfflineService === service, 'border-gray-300': selectedOfflineService !== service}">
                                 <div class="w-3 h-3 rounded-full bg-[#3d4a5e]" x-show="selectedOfflineService === service"></div>
                            </div>
                        </label>
                    </template>
                </template>
            </div>
            
            <button @click="serviceModalOpen = false" class="w-full bg-[#a1c4c8] text-white font-bold text-[14px] py-4 rounded-xl shadow-sm hover:bg-[#8eb2b6] transition mt-auto">
                Pilih Layanan
            </button>
        </div>
    </div>

</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('consultationApp', () => ({
            tab: 'online',
            selectedDate: 15,
            selectedTime: '10:30 WIB',
            selectedOnlineService: 'Chat Konseling',
            selectedOfflineService: 'Konselor Sebaya',
            timeModalOpen: false,
            serviceModalOpen: false,
            
            selectedDate: null,
            selectedFullDate: null,
            dates: [],
            bookedSchedules: @json($bookedSchedules ?? []),
            
            isBooked(timeStr) {
                return this.bookedSchedules.some(s => s.date === this.selectedFullDate && s.time === timeStr);
            },

            autoSelectAvailableTime() {
                let available = this.times.find(t => !this.isBooked(t));
                this.selectedTime = available ? available : 'Penuh';
            },
            
            init() {
                this.generateDates(new Date());
            },
            
            generateDates(startDate) {
                this.dates = [];
                const dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu'];
                
                let d = new Date(startDate);
                // Jika mulai dari akhir pekan, geser ke Senin
                if (d.getDay() === 0) d.setDate(d.getDate() + 1); // Minggu -> Senin
                if (d.getDay() === 6) d.setDate(d.getDate() + 2); // Sabtu -> Senin

                let addedDays = 0;
                
                while (addedDays < 7) {
                    let currentDay = d.getDay();
                    
                    // Hanya Senin(1) sampai Jumat(5)
                    if (currentDay !== 0 && currentDay !== 6) {
                        let isActualToday = (d.toDateString() === new Date().toDateString());
                        let dayName = isActualToday ? 'Hari ini' : dayNames[currentDay];
                        
                        let localDate = new Date(d.getTime() - (d.getTimezoneOffset() * 60000)).toISOString().split('T')[0];
                        
                        this.dates.push({
                            day: dayName,
                            date: d.getDate(),
                            fullDate: localDate
                        });
                        addedDays++;
                    }
                    d.setDate(d.getDate() + 1);
                }
                this.selectedDate = this.dates[0].date;
                this.selectedFullDate = this.dates[0].fullDate;
                this.autoSelectAvailableTime();
            },
            
            updateDatesFromPicker(val) {
                if(!val) return;
                this.generateDates(new Date(val));
            },
            
            times: [
                '09:00 WIB', '09:30 WIB', '10:00 WIB',
                '10:30 WIB', '11:00 WIB', '11:30 WIB',
                '13:00 WIB', '13:30 WIB', '14:00 WIB',
                '14:30 WIB', '15:00 WIB', '15:30 WIB',
                '16:00 WIB', '16:30 WIB', '17:00 WIB'
            ],
            
            onlineServices: [
                'Chat Konseling',
                'Telepon Konseling'
            ],
            offlineServices: [
                'Konselor Sebaya',
                'UKLT Filkom',
                'DWP Filkom'
            ]
        }));
    });
</script>
@endsection

@push('styles')
<style>
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
@endpush
