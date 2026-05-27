    {{-- ===== Bottom Navigation ===== --}}
    <div x-data class="absolute bottom-0 left-0 w-full h-[70px] bg-white border-t border-gray-100 flex justify-between items-center px-4 z-40">
        {{-- Home --}}
        <a href="{{ route('dashboard') }}" class="flex flex-col items-center w-[60px] transition {{ $active === 'home' ? 'text-[#87B4B8]' : 'text-gray-400 hover:text-[#87B4B8]' }}">
            <svg class="mb-1" width="24" height="24" viewBox="0 0 24 24" fill="{{ $active === 'home' ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                @if($active !== 'home') <polyline points="9 22 9 12 15 12 15 22"></polyline> @endif
            </svg>
            <span class="text-[10px] font-medium">Home</span>
        </a>

        {{-- Konsultasi --}}
        <a href="{{ route('consultation.index') }}" class="flex flex-col items-center w-[60px] transition mr-8 {{ $active === 'consultation' ? 'text-[#87B4B8]' : 'text-gray-400 hover:text-[#87B4B8]' }}">
            <svg class="mb-1" width="24" height="24" viewBox="0 0 24 24" fill="{{ $active === 'consultation' ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            <span class="text-[10px] font-medium">Konsultasi</span>
        </a>

        {{-- SOS Button (Floating) --}}
        <div class="absolute left-1/2 bottom-5 -translate-x-1/2">
            <button @click="$dispatch('open-sos')" class="w-[60px] h-[60px] rounded-full bg-[#df4a56] text-white font-bold text-[16px] shadow-lg shadow-red-500/30 border-4 border-white flex items-center justify-center transform active:scale-95 transition-transform">
                SOS
            </button>
        </div>
        
        {{-- Riwayat --}}
        <a href="{{ route('history.index') }}" class="flex flex-col items-center w-[60px] transition ml-8 {{ $active === 'history' ? 'text-[#87B4B8]' : 'text-gray-400 hover:text-[#87B4B8]' }}">
            <svg class="mb-1" width="24" height="24" viewBox="0 0 24 24" fill="{{ $active === 'history' ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
            </svg>
            <span class="text-[10px] font-medium">Riwayat</span>
        </a>

        {{-- Profile --}}
        <a href="{{ route('profile.index') }}" class="flex flex-col items-center w-[60px] transition {{ $active === 'profile' ? 'text-[#87B4B8]' : 'text-gray-400 hover:text-[#87B4B8]' }}">
            <svg class="mb-1" width="24" height="24" viewBox="0 0 24 24" fill="{{ $active === 'profile' ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                <circle cx="12" cy="7" r="4"></circle>
            </svg>
            <span class="text-[10px] font-medium">Profile</span>
        </a>
    </div>
