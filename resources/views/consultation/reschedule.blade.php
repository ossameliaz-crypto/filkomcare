@extends('layouts.mobile-emulator')

@section('title', 'FilkomCare - Reschedule Konsultasi')
@section('page-name', 'Reschedule')

@section('content')
<div x-data="rescheduleApp()" class="relative w-full h-full min-h-[100dvh] md:min-h-0 bg-white overflow-hidden pb-[70px]">

    {{-- Top Bar --}}
    <div class="px-6 pt-12 pb-4 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('history.show', $consultation->id) }}" class="text-[#3d4a5e] transition-all duration-300 transform hover:-translate-x-1 hover:text-[#87B4B8]">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            </a>
            <h1 class="text-[#3d4a5e] text-[20px] font-bold tracking-tight">Reschedule Jadwal</h1>
        </div>
    </div>

    {{-- Content Area (Scrollable) --}}
    <form action="{{ route('consultation.reschedule.update', $consultation->id) }}" method="POST" class="h-full overflow-y-auto hide-scrollbar px-6 pt-4 pb-8">
        @csrf
        <input type="hidden" name="date" :value="selectedFullDate">
        <input type="hidden" name="time" :value="selectedTime">
        
        {{-- Existing Details (Read-only) --}}
        <div class="bg-[#f8f9fa] border border-gray-100 rounded-xl p-4 mb-8">
            <div class="mb-3">
                <span class="block text-[11px] text-[#8e98a8] font-bold uppercase tracking-wider mb-1">Layanan</span>
                <span class="text-[#3d4a5e] text-[14px] font-medium">{{ $consultation->service }}</span>
            </div>
            <div class="mb-3">
                <span class="block text-[11px] text-[#8e98a8] font-bold uppercase tracking-wider mb-1">Topik</span>
                <span class="text-[#3d4a5e] text-[14px] font-medium">{{ $consultation->topic }}</span>
            </div>
            <div>
                <span class="block text-[11px] text-[#8e98a8] font-bold uppercase tracking-wider mb-1">Deskripsi</span>
                <span class="text-[#3d4a5e] text-[13px]">{{ $consultation->description }}</span>
            </div>
        </div>

        {{-- Tanggal Selector --}}
        <div class="mb-6">
            <div class="flex justify-between items-center mb-3">
                <span class="text-[#64748b] text-[14px] font-medium">Pilih jadwal baru</span>
                <div class="relative w-5 h-5 flex items-center justify-center">
                    <input type="date" x-model="selectedFullDate" @change="updateDatesFromPicker($event.target.value)" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10 hover:scale-110 transition-transform" style="-webkit-appearance: none;">
                    <svg class="text-[#a1c4c8] relative z-0 transition-all hover:scale-110" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                </div>
            </div>
            
            <div class="flex overflow-x-auto gap-3 hide-scrollbar -mx-6 px-6 pb-4 pt-3">
                <template x-for="item in dates" :key="item.date">
                    <button type="button" @click="selectedDate = item.date; selectedFullDate = item.fullDate; autoSelectAvailableTime();" 
                            :class="{'border-[#5b687b] bg-[#f3ede3] text-[#5b687b] shadow-md -translate-y-1': selectedDate === item.date, 'border-transparent bg-[#f8f9fa] text-[#94a3b8] hover:bg-gray-100': selectedDate !== item.date}"
                            class="shrink-0 flex flex-col items-center justify-center w-[68px] h-[80px] rounded-2xl border transition-all duration-300 transform hover:-translate-y-1 hover:shadow-md">
                        <span class="text-[11px] mb-1.5 font-medium whitespace-nowrap" :class="{'text-[#5b687b]': selectedDate === item.date, 'text-[#94a3b8]': selectedDate !== item.date}" x-text="item.day"></span>
                        <div class="w-[16px] h-[2px] mb-1.5 rounded-full" :class="{'bg-[#5b687b]': selectedDate === item.date, 'bg-[#cbd5e1]': selectedDate !== item.date}"></div>
                        <span class="text-[20px] font-bold" :class="{'text-[#5b687b]': selectedDate === item.date, 'text-[#cbd5e1]': selectedDate !== item.date}" x-text="item.date"></span>
                    </button>
                </template>
            </div>
        </div>

        {{-- Waktu Konseling --}}
        <div class="mb-8">
            <span class="block text-[#8e98a8] text-[14px] font-medium mb-2">Pilih waktu baru</span>
            <button type="button" @click="timeModalOpen = true" class="w-full flex items-center justify-between border border-gray-200 rounded-xl px-4 py-3 bg-[#f8f9fa] text-left transition-all duration-300 hover:border-[#bce8ee] hover:bg-white hover:shadow-sm transform hover:-translate-y-0.5 group">
                <span class="text-[#a1abb9] text-[13px] group-hover:text-[#3d4a5e] transition-colors" x-text="selectedTime"></span>
                <svg class="text-[#a1abb9] group-hover:text-[#3d4a5e] transition-colors" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
            </button>
        </div>

        {{-- Kirim Button --}}
        <button type="submit" :disabled="selectedTime === 'Penuh'" :class="{'opacity-50 cursor-not-allowed': selectedTime === 'Penuh'}" class="w-full bg-[#a1c4c8] text-white font-bold text-[14px] py-4 rounded-xl shadow-sm hover:shadow-lg hover:bg-[#8eb2b6] transition-all duration-300 transform hover:-translate-y-0.5 active:scale-95">
            Update Jadwal
        </button>

    </form>

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
                    <button type="button" @click="if(!isUnavailable(time)) selectedTime = time"
                            :disabled="isUnavailable(time)"
                            :class="{
                                'bg-[#fee2e2] border-[#fca5a5] text-[#ef4444] cursor-not-allowed shadow-inner': isUnavailable(time),
                                'bg-[#f3ede3] border-[#a1c4c8] text-[#3d4a5e]': selectedTime === time && !isUnavailable(time), 
                                'border-gray-200 text-[#a1abb9]': selectedTime !== time && !isUnavailable(time)
                            }"
                            class="border rounded-xl py-2 text-[12px] font-medium transition" x-text="time"></button>
                </template>
            </div>
            
            <button type="button" @click="timeModalOpen = false" class="w-full bg-[#a1c4c8] text-white font-bold text-[14px] py-4 rounded-xl shadow-sm hover:bg-[#8eb2b6] transition">
                Pilih Waktu
            </button>
        </div>
    </div>

</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('rescheduleApp', () => ({
            timeModalOpen: false,
            selectedDate: null,
            selectedFullDate: null,
            selectedTime: '10:30 WIB',
            dates: [],
            bookedSchedules: @json($bookedSchedules ?? []),
            currentDate: '{{ $consultation->date }}',
            currentTime: '{{ $consultation->time }}',
            
            isUnavailable(timeStr) {
                // If it's the exact same schedule currently booked by this user, it's available for them to keep
                if (this.selectedFullDate === this.currentDate && timeStr === this.currentTime) {
                    return false;
                }

                // 1. Cek apakah sudah di-booking oleh orang lain
                const booked = this.bookedSchedules.some(s => s.date === this.selectedFullDate && s.time === timeStr);
                if (booked) return true;
                
                // 2. Cek apakah waktu sudah lewat hari ini
                const today = new Date();
                const todayStr = new Date(today.getTime() - (today.getTimezoneOffset() * 60000)).toISOString().split('T')[0];
                
                if (this.selectedFullDate === todayStr) {
                    const timePart = timeStr.split(' ')[0]; // Ambil "10:30" dari "10:30 WIB"
                    const [hours, minutes] = timePart.split(':');
                    
                    const slotTime = new Date();
                    slotTime.setHours(parseInt(hours, 10), parseInt(minutes, 10), 0, 0);
                    
                    if (today >= slotTime) {
                        return true;
                    }
                }
                
                return false;
            },

            autoSelectAvailableTime() {
                // If user selected the current date, default to current time
                if (this.selectedFullDate === this.currentDate) {
                    this.selectedTime = this.currentTime;
                    return;
                }
                let available = this.times.find(t => !this.isUnavailable(t));
                this.selectedTime = available ? available : 'Penuh';
            },
            
            init() {
                // Parse the current consultation date to initialize picker there
                let initDate = new Date(this.currentDate);
                if (isNaN(initDate)) initDate = new Date();
                this.generateDates(initDate);
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
                
                // Cek jika currentDate ada di dalam daftar generated dates
                let foundCurrent = this.dates.find(item => item.fullDate === this.currentDate);
                if (foundCurrent) {
                    this.selectedDate = foundCurrent.date;
                    this.selectedFullDate = foundCurrent.fullDate;
                } else {
                    this.selectedDate = this.dates[0].date;
                    this.selectedFullDate = this.dates[0].fullDate;
                }

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
