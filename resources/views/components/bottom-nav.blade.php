    {{-- ===== Bottom Navigation ===== --}}
    <div x-data class="fixed bottom-0 left-0 w-full h-[70px] bg-white border-t border-gray-100 shadow-[0_-8px_20px_rgba(0,0,0,0.04)] flex justify-between items-center px-4 z-40 md:absolute">
        {{-- Home --}}
        <a href="{{ route('dashboard') }}" class="flex flex-col items-center w-[60px] transition group {{ $active === 'home' ? 'text-[#87B4B8]' : 'text-gray-400 hover:text-[#87B4B8]' }}">
            <svg class="mb-1 transition-transform group-hover:-translate-y-1" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $active === 'home' ? '2.5' : '2' }}" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
            <span class="text-[10px] font-medium transition-all {{ $active === 'home' ? 'font-bold' : '' }}">Home</span>
            @if($active === 'home') <div class="w-1 h-1 bg-[#87B4B8] rounded-full mt-0.5"></div> @endif
        </a>

        {{-- Konsultasi --}}
        <a href="{{ route('consultation.index') }}" class="flex flex-col items-center w-[60px] transition mr-8 group {{ $active === 'consultation' ? 'text-[#87B4B8]' : 'text-gray-400 hover:text-[#87B4B8]' }}">
            <svg class="mb-1 transition-transform group-hover:-translate-y-1" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $active === 'consultation' ? '2.5' : '2' }}" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            <span class="text-[10px] font-medium transition-all {{ $active === 'consultation' ? 'font-bold' : '' }}">Konsultasi</span>
            @if($active === 'consultation') <div class="w-1 h-1 bg-[#87B4B8] rounded-full mt-0.5"></div> @endif
        </a>

        {{-- SOS Button (Floating) --}}
        <div class="absolute left-1/2 bottom-8 -translate-x-1/2 z-50">
            <button @click="$dispatch('open-sos')" class="w-[64px] h-[64px] rounded-full bg-[#df4a56] text-white font-bold text-[17px] shadow-[0_10px_25px_rgba(223,74,86,0.7)] flex items-center justify-center transform active:scale-95 hover:scale-110 hover:bg-[#d43f4b] hover:-translate-y-2 transition-all duration-300">
                SOS
            </button>
        </div>
        
        {{-- Riwayat --}}
        <a href="{{ route('history.index') }}" class="flex flex-col items-center w-[60px] transition ml-8 group {{ $active === 'history' ? 'text-[#87B4B8]' : 'text-gray-400 hover:text-[#87B4B8]' }}">
            <svg class="mb-1 transition-transform group-hover:-translate-y-1" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $active === 'history' ? '2.5' : '2' }}" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
            </svg>
            <span class="text-[10px] font-medium transition-all {{ $active === 'history' ? 'font-bold' : '' }}">Riwayat</span>
            @if($active === 'history') <div class="w-1 h-1 bg-[#87B4B8] rounded-full mt-0.5"></div> @endif
        </a>

        {{-- Profile --}}
        <a href="{{ route('profile.index') }}" class="flex flex-col items-center w-[60px] transition group {{ $active === 'profile' ? 'text-[#87B4B8]' : 'text-gray-400 hover:text-[#87B4B8]' }}">
            <svg class="mb-1 transition-transform group-hover:-translate-y-1" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $active === 'profile' ? '2.5' : '2' }}" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
            <span class="text-[10px] font-medium transition-all {{ $active === 'profile' ? 'font-bold' : '' }}">Profile</span>
            @if($active === 'profile') <div class="w-1 h-1 bg-[#87B4B8] rounded-full mt-0.5"></div> @endif
        </a>
    </div>
