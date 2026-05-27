<div x-data="{ sosOpen: false }" 
     @open-sos.window="sosOpen = true"
     @keydown.escape.window="sosOpen = false"
     class="relative z-[100]" 
     style="display: none;" 
     x-show="sosOpen">
    
    {{-- Backdrop --}}
    <div x-show="sosOpen" 
         x-transition.opacity.duration.300ms
         @click="sosOpen = false"
         class="absolute inset-0 bg-black bg-opacity-40 backdrop-blur-sm z-[100]">
    </div>

    {{-- Modal Panel --}}
    <div x-show="sosOpen" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-full"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-full"
         class="absolute bottom-0 left-0 w-full z-[101] px-4 pb-8">
        
        <div class="bg-white rounded-[32px] w-full p-6 flex flex-col items-center shadow-2xl relative">
            
            {{-- Drag Handle --}}
            <div class="w-16 h-1.5 bg-gray-200 rounded-full mb-6"></div>

            {{-- SOS Circle --}}
            <div class="w-[100px] h-[100px] bg-[#df4a56] rounded-full flex items-center justify-center mb-5 shadow-[0_8px_24px_rgba(223,74,86,0.3)]">
                <span class="text-white text-[28px] font-bold tracking-wider">SOS</span>
            </div>

            {{-- Title --}}
            <h2 class="text-[#3d4a5e] text-[22px] font-bold mb-1">Bantuan Darurat</h2>
            <p class="text-[#87B4B8] text-[13px] font-bold mb-1 uppercase tracking-wide">Hotline UKLT Filkom</p>
            <p class="text-gray-400 text-[12px] text-center mb-6 leading-relaxed px-4">
                Layanan beroperasi pada hari<br><strong>Senin - Jumat, pukul 09.00 - 17.00 WIB</strong>
            </p>

            {{-- WhatsApp Button --}}
            <a href="https://wa.me/6281803805321" target="_blank" class="w-full flex items-center justify-between p-4 bg-[#f0f7f2] border border-[#d2e8d8] rounded-2xl mb-3 hover:bg-[#e4f2e8] transition group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-[#3a964a] rounded-full flex items-center justify-center text-white shrink-0 shadow-sm group-hover:scale-105 transition-transform">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[#3d4a5e] text-[14px] font-bold">Whatsapp UKLT</span>
                        <span class="text-gray-500 text-[12px]">+62 818-0380-5321</span>
                    </div>
                </div>
                <svg class="text-gray-400 group-hover:text-[#3a964a] transition-colors" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </a>

            {{-- Phone Button --}}
            <a href="tel:+6281803805321" class="w-full flex items-center justify-between p-4 bg-[#fdf2f3] border border-[#f5d7d9] rounded-2xl mb-5 hover:bg-[#fae6e8] transition group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 bg-[#df4a56] rounded-full flex items-center justify-center text-white shrink-0 shadow-sm group-hover:scale-105 transition-transform">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-[#3d4a5e] text-[14px] font-bold">Telepon Darurat UKLT</span>
                        <span class="text-gray-500 text-[12px]">+62 818-0380-5321</span>
                    </div>
                </div>
                <svg class="text-gray-400 group-hover:text-[#df4a56] transition-colors" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
            </a>

            {{-- Cancel Button --}}
            <button @click="sosOpen = false" class="w-full py-4 bg-[#e2e4e6] text-[#3d4a5e] font-bold rounded-2xl text-[15px] hover:bg-[#d5d8db] transition">
                Batal
            </button>
        </div>
    </div>
</div>
