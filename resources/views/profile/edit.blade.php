@extends('layouts.mobile-emulator')

@section('title', 'FilkomCare - Edit Profile')

@section('content')
<div class="relative w-full h-full min-h-[100dvh] md:min-h-0 bg-[#f8f9fa] overflow-hidden flex flex-col" x-data="editProfileApp()">
    
    {{-- Top Bar --}}
    <div class="px-6 pt-12 pb-6 flex items-center gap-4 z-10 bg-[#f8f9fa]">
        <a href="{{ route('profile.index') }}" class="text-[#3d4a5e] transition-all duration-300 transform hover:-translate-x-1 hover:text-[#87B4B8]">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        </a>
        <h1 class="text-[#3d4a5e] text-[20px] font-bold">Edit Profile</h1>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
    <div class="mx-6 mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl text-[13px] font-medium">
        {{ session('success') }}
    </div>
    @endif
    @if($errors->any())
    <div class="mx-6 mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-[13px] font-medium">
        {{ $errors->first() }}
    </div>
    @endif

    {{-- Content --}}
    <div class="px-6 flex-1 overflow-y-auto pb-8 z-10">
        <h2 class="text-[#3d4a5e] text-[16px] font-bold mb-4">Account Details</h2>

        <div class="bg-white rounded-[24px] shadow-sm p-6 flex flex-col gap-6">
            
            {{-- Email --}}
            <div class="flex flex-col gap-2 border-b border-gray-300 pb-2">
                <div class="flex justify-between items-center">
                    <label class="text-[#3d4a5e] text-[15px] font-medium">Email</label>
                    <button @click="openModal('email', 'Email', '{{ Auth::user()->email }}')" class="text-[#0ea5e9] text-[13px] font-bold transition-colors duration-300 hover:text-blue-700">Edit</button>
                </div>
                <div class="text-gray-400 text-[14px]">{{ Auth::user()->email }}</div>
            </div>

            {{-- Username --}}
            <div class="flex flex-col gap-2 border-b border-gray-300 pb-2">
                <div class="flex justify-between items-center">
                    <label class="text-[#3d4a5e] text-[15px] font-medium">Username</label>
                    <button @click="openModal('name', 'Username', '{{ Auth::user()->name }}')" class="text-[#0ea5e9] text-[13px] font-bold transition-colors duration-300 hover:text-blue-700">Edit</button>
                </div>
                <div class="text-gray-400 text-[14px]">{{ Auth::user()->name }}</div>
            </div>

            {{-- Phone Number --}}
            <div class="flex flex-col gap-2 border-b border-gray-300 pb-2">
                <div class="flex justify-between items-center">
                    <label class="text-[#3d4a5e] text-[15px] font-medium">Phone number</label>
                    <button @click="openModal('phone_number', 'Phone number', '{{ Auth::user()->phone_number }}')" class="text-[#0ea5e9] text-[13px] font-bold transition-colors duration-300 hover:text-blue-700">
                        {{ Auth::user()->phone_number ? 'Edit' : 'Add' }}
                    </button>
                </div>
                <div class="text-gray-400 text-[14px]">{{ Auth::user()->phone_number ?? '-' }}</div>
            </div>

            {{-- NIM --}}
            <div class="flex flex-col gap-2 border-b border-gray-300 pb-2">
                <div class="flex justify-between items-center">
                    <label class="text-[#3d4a5e] text-[15px] font-medium">NIM</label>
                    <button @click="openModal('nim', 'NIM', '{{ Auth::user()->nim }}')" class="text-[#0ea5e9] text-[13px] font-bold transition-colors duration-300 hover:text-blue-700">
                        {{ Auth::user()->nim ? 'Edit' : 'Add' }}
                    </button>
                </div>
                <div class="text-gray-400 text-[14px]">{{ Auth::user()->nim ?? '-' }}</div>
            </div>
            
            {{-- Department --}}
            <div class="flex flex-col gap-2">
                <div class="flex justify-between items-center">
                    <label class="text-[#3d4a5e] text-[15px] font-medium">Program Studi</label>
                    <button @click="openModal('department', 'Program Studi', '{{ Auth::user()->department }}')" class="text-[#0ea5e9] text-[13px] font-bold transition-colors duration-300 hover:text-blue-700">
                        {{ Auth::user()->department ? 'Edit' : 'Add' }}
                    </button>
                </div>
                <div class="text-gray-400 text-[14px]">{{ Auth::user()->department ?? '-' }}</div>
            </div>

        </div>


    </div>

    {{-- Edit Modal Overlay --}}
    <div x-show="modalOpen" class="absolute inset-0 bg-black bg-opacity-40 z-50 flex items-center justify-center p-6" x-transition.opacity style="display: none;">
        <div class="bg-white w-full rounded-2xl p-6 shadow-2xl" @click.away="closeModal()" x-show="modalOpen" x-transition.scale>
            <h3 class="text-[#3d4a5e] text-[16px] font-bold mb-4">Edit <span x-text="editFieldLabel"></span></h3>
            
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <input type="hidden" name="name" :value="editFieldName === 'name' ? editFieldValue : '{{ addslashes(Auth::user()->name) }}'">
                <input type="hidden" name="email" :value="editFieldName === 'email' ? editFieldValue : '{{ addslashes(Auth::user()->email) }}'">
                <input type="hidden" name="phone_number" :value="editFieldName === 'phone_number' ? editFieldValue : '{{ addslashes(Auth::user()->phone_number) }}'">
                <input type="hidden" name="nim" :value="editFieldName === 'nim' ? editFieldValue : '{{ addslashes(Auth::user()->nim) }}'">
                <input type="hidden" name="department" :value="editFieldName === 'department' ? editFieldValue : '{{ addslashes(Auth::user()->department) }}'">
                
                {{-- Dynamic Input Field --}}
                <div class="mb-5">
                    <template x-if="editFieldName !== 'department'">
                        <input :type="editFieldType" 
                               :name="editFieldName" 
                               x-model="editFieldValue" 
                               class="w-full bg-[#f8f9fa] border border-gray-200 text-[#3d4a5e] rounded-xl py-3 px-4 transition-all duration-300 focus:outline-none focus:border-[#87B4B8] focus:ring-2 focus:ring-[#87B4B8]/20 focus:bg-white hover:border-[#bce8ee]">
                    </template>
                    
                    <template x-if="editFieldName === 'department'">
                        <div class="relative">
                            <select :name="editFieldName" 
                                    x-model="editFieldValue" 
                                    class="w-full bg-[#f8f9fa] border border-gray-200 text-[#3d4a5e] rounded-xl py-3 px-4 pr-10 appearance-none transition-all duration-300 focus:outline-none focus:border-[#87B4B8] focus:ring-2 focus:ring-[#87B4B8]/20 focus:bg-white hover:border-[#bce8ee]">
                                <option value="" disabled>Pilih Program Studi</option>
                                <option value="Teknik Informatika">Teknik Informatika</option>
                                <option value="Sistem Informasi">Sistem Informasi</option>
                                <option value="Teknik Komputer">Teknik Komputer</option>
                                <option value="Teknologi Informasi">Teknologi Informasi</option>
                                <option value="Pendidikan Teknologi Informasi">Pendidikan Teknologi Informasi</option>
                                <option value="S2 Ilmu Komputer">S2 Ilmu Komputer</option>
                                <option value="S2 Sistem Informasi">S2 Sistem Informasi</option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="flex gap-3">
                    <button type="button" @click="closeModal()" class="flex-1 py-3 rounded-xl bg-gray-100 text-gray-500 font-bold transition-all duration-300 hover:bg-gray-200 hover:shadow-sm transform hover:-translate-y-0.5 active:scale-95">Batal</button>
                    <button type="submit" class="flex-1 py-3 rounded-xl bg-[#87B4B8] text-white font-bold hover:bg-[#6ca3a8] transition-all duration-300 shadow-sm hover:shadow-lg transform hover:-translate-y-0.5 active:scale-95">Simpan</button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('editProfileApp', () => ({
            modalOpen: false,
            editFieldName: '',
            editFieldLabel: '',
            editFieldValue: '',
            
            get editFieldType() {
                if (this.editFieldName === 'email') return 'email';
                if (this.editFieldName === 'phone_number' || this.editFieldName === 'nim') return 'number';
                return 'text';
            },

            openModal(fieldName, fieldLabel, currentValue) {
                this.editFieldName = fieldName;
                this.editFieldLabel = fieldLabel;
                this.editFieldValue = currentValue;
                this.modalOpen = true;
            },

            closeModal() {
                this.modalOpen = false;
            }
        }))
    })
</script>
@endsection
