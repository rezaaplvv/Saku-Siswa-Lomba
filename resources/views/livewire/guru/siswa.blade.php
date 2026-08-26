<div 
    x-data="{ 
        openDeposit: false, 
        openWaModal: false,
        selectedId: null, 
        selectedName: '',
        depositAmount: '',
        formattedAmount: '',
        copiedWa: false,
        
        updateAmount(val) {
            let clean = val.replace(/\D/g, '');
            this.depositAmount = clean;
            this.formattedAmount = clean.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }
    }"
    class="-mx-4 -mt-4 sm:-mx-6 sm:-mt-6 md:-mx-8 md:-mt-8 p-4 sm:p-6 md:p-8 min-h-screen bg-[#ffd554] pb-6 space-y-6 font-sans relative overflow-hidden"
>
    
    <!-- Background leaf decoration -->
    <div class="absolute top-0 right-0 w-32 h-32 opacity-10 pointer-events-none translate-x-6 -translate-y-6 z-0">
        <svg class="w-full h-full text-amber-800" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17 2c-3.87 0-7 3.13-7 7 0 2.21 1.02 4.18 2.62 5.5L12 15c-.41.34-1.07.34-1.48 0L2.3 8.3c-.63-.5-1.52-.38-2 .25-.5.63-.38 1.52.25 2l8.22 6.7c1.39 1.13 3.47 1.13 4.86 0L22 10.3c.63-.5.75-1.39.25-2-.5-.63-1.39-.75-2-.25l-2.62 2.15C17.98 9.38 17 7.41 17 5V2z"/>
        </svg>
    </div>

    <!-- Header Banner Card (Inverted Dark Slate Container - Fully Centered Illustration & Enlarged Title) -->
    <div class="relative overflow-hidden bg-slate-900 border border-slate-800 rounded-2xl sm:rounded-3xl p-4 sm:p-5 md:p-6 shadow-md flex items-center justify-between min-h-[135px] sm:min-h-[150px] md:min-h-[170px] relative z-10 font-['Outfit'] text-white">
        
        <div class="text-left space-y-2 relative z-10 pr-28 sm:pr-48 md:pr-60">
            <div class="space-y-0.5">
                <h1 class="text-xl sm:text-2xl md:text-3xl font-black text-white tracking-tight leading-tight">
                    <span>Kelola Siswa & Tabungan</span>
                </h1>
            </div>
            
            <!-- Badges Layout (Compact Size) -->
            <div class="flex flex-wrap items-center gap-1.5 sm:gap-2">
                @if(Auth::user()->school_name)
                    <div class="inline-flex items-center px-2 py-0.5 sm:px-3 sm:py-1 bg-white/10 text-white border border-white/20 backdrop-blur-xs rounded-full text-[9px] sm:text-[11px] font-bold shadow-xs">
                        <span>{{ Auth::user()->school_name }}</span>
                    </div>
                @endif
                <div class="inline-flex items-center px-2 py-0.5 sm:px-3 sm:py-1 bg-[#ffd554] text-slate-950 rounded-full text-[9px] sm:text-[11px] font-black shadow-xs">
                    <span>Kelas {{ $className }}</span>
                </div>
            </div>
        </div>

        <!-- Centered Vertical Illustration on Right (Enlarged) -->
        <div class="absolute -right-3 sm:-right-4 top-1/2 -translate-y-1/2 w-44 h-44 sm:w-60 sm:h-60 md:w-72 md:h-72 pointer-events-none z-0">
            <img src="/assets/headerguru.png" alt="Header Illustration" class="w-full h-full object-contain object-right-center scale-110 sm:scale-105">
        </div>
    </div>

    <!-- Toast Notifications -->
    @if(session()->has('success'))
        <div 
            x-data="{ 
                show: true, 
                progress: 100,
                timer: null,
                init() {
                    const duration = 3500;
                    const interval = 35;
                    const step = (interval / duration) * 100;
                    this.timer = setInterval(() => {
                        this.progress -= step;
                        if (this.progress <= 0) {
                            clearInterval(this.timer);
                            this.show = false;
                        }
                    }, interval);
                },
                close() {
                    if (this.timer) clearInterval(this.timer);
                    this.show = false;
                }
            }" 
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 backdrop-blur-none"
            x-transition:enter-end="opacity-100 backdrop-blur-xs"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 backdrop-blur-xs"
            x-transition:leave-end="opacity-0 backdrop-blur-none"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 font-sans"
        >
            <div 
                x-show="show"
                x-transition:enter="transition ease-[cubic-bezier(0.34,1.56,0.64,1)] duration-400"
                x-transition:enter-start="opacity-0 scale-75 translate-y-6"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-90 -translate-y-4"
                class="bg-gradient-to-br from-[#ffd554] via-[#ffca36] to-[#f5b81a] rounded-3xl p-5 max-w-[260px] w-full shadow-2xl border-2 border-amber-300/80 text-center font-['Outfit'] space-y-3.5 relative overflow-hidden"
            >
                <div class="w-20 h-20 mx-auto flex items-center justify-center">
                    <lottie-player src="/assets/success.json" background="transparent" speed="1" class="w-full h-full" autoplay></lottie-player>
                </div>
                <div class="space-y-1 px-1">
                    <h3 class="text-base font-black text-slate-950 tracking-tight">Berhasil!</h3>
                    <p class="text-xs text-slate-900 font-extrabold leading-snug">{{ session('success') }}</p>
                </div>
                <div class="space-y-2">
                    <button @click="close()" class="w-full py-2.5 bg-slate-950 hover:bg-slate-900 text-white font-extrabold rounded-xl text-xs shadow-md active:scale-95 transition-all cursor-pointer">
                        Tutup
                    </button>
                    <!-- Sleek Progress Countdown Bar -->
                    <div class="w-full bg-slate-950/15 rounded-full h-1 overflow-hidden">
                        <div class="bg-slate-950 h-full transition-all ease-linear duration-75" :style="`width: ${progress}%`"></div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(session()->has('error'))
        <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3.5 rounded-xl text-xs font-bold relative z-10">
            {{ session('error') }}
        </div>
    @endif

    <!-- ACTION BAR: 5 Buttons in 1 Single Row (Left: 3 Tools, Right: Impor Excel & Tambah Siswa) -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 relative z-20 font-['Outfit']">
        
        <!-- Left Aligned Tools Group (Bagikan WA, Slip Login, Rekap PDF) -->
        <div class="flex items-center gap-2 sm:gap-2.5 overflow-x-auto pb-1 md:pb-0">
            <!-- Button: Bagikan WA Kelas -->
            <button 
                @click="openWaModal = true"
                class="h-10 px-3.5 bg-white hover:bg-slate-50 border border-slate-200/90 text-slate-800 font-extrabold rounded-xl text-xs flex items-center justify-center space-x-1.5 shadow-2xs active:scale-95 transition-all cursor-pointer whitespace-nowrap"
            >
                <svg class="w-4 h-4 fill-amber-500 shrink-0" viewBox="0 0 24 24">
                    <path d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984a9.932 9.932 0 0 0 1.344 5.016L2 22l5.127-1.332a9.92 9.92 0 0 0 4.885 1.28h.004c5.506 0 9.99-4.478 9.99-9.985A9.94 9.94 0 0 0 12.012 2zm5.836 14.361c-.244.686-1.42 1.31-1.96 1.391-.5.074-1.144.106-3.666-.937-3.037-1.256-4.992-4.341-5.144-4.542-.152-.202-1.233-1.639-1.233-3.125 0-1.486.777-2.217 1.052-2.518.275-.3.6-.375.8-.375.2 0 .4 0 .575.01.187.009.437-.071.684.521.25.6.85 2.073.924 2.223.075.15.125.326.025.526-.1.2-.15.325-.3.5-.15.175-.315.391-.45.525-.15.15-.306.315-.13.615.175.3 0 .777 1.63 2.146 1.956 1.745.326.05.525-.025.725-.1.2-.85-1.002-1.075-1.277-.225-.275-.475-.25-.65 0-.175.25-.725.925-.9 1.15-.175.225-.35.25-.65.1-.3-.15-1.267-.467-2.414-1.49-1.785-1.593-2.99-3.56-3.34-4.16-.35-.6-.037-.925.112-1.074.135-.135.3-.35.45-.525.15-.175.2-.3.3-.5.1-.2.05-.375-.025-.525-.075-.15-.925-2.228-1.268-3.053-.334-.803-.675-.694-.925-.707-.225-.01-.475-.01-.725-.01s-.65.093-.99.467c-.34.374-1.29 1.262-1.29 3.077 0 1.815 1.324 3.568 1.508 3.815.184.247 2.607 3.982 6.315 5.58 2.502 1.08 3.47.864 4.093.804.77-.074 1.76-.719 2.01-1.411z"/>
                </svg>
                <span>Bagikan WA</span>
            </button>

            <!-- Button: Cetak Slip Login -->
            <a 
                href="{{ route('guru.cetak-slip') }}" 
                class="h-10 px-3.5 bg-white hover:bg-slate-50 border border-slate-200/90 text-slate-800 font-extrabold rounded-xl text-xs flex items-center justify-center space-x-1.5 shadow-2xs active:scale-95 transition-all cursor-pointer whitespace-nowrap"
            >
                <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.6 0-1.1-.467-1.12-1.066L6.34 18m11.32 0H6.34m0 0l-.207-2.278a2.25 2.25 0 01.378-1.544l2.122-3.183a2.25 2.25 0 011.872-.995h3.003c.756 0 1.455.38 1.872.995l2.122 3.183c.33.495.467 1.096.378 1.544L17.66 18z" />
                </svg>
                <span>Slip Login</span>
            </a>

            <!-- Button: Cetak Rekap Laporan PDF -->
            <a 
                href="{{ route('guru.cetak-rekap-laporan') }}" 
                class="h-10 px-3.5 bg-white hover:bg-slate-50 border border-slate-200/90 text-slate-800 font-extrabold rounded-xl text-xs flex items-center justify-center space-x-1.5 shadow-2xs active:scale-95 transition-all cursor-pointer whitespace-nowrap"
            >
                <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                <span>Rekap PDF</span>
            </a>
        </div>

        <!-- Right Aligned Primary Group (Impor Excel & Tambah Siswa) -->
        <div class="flex items-center gap-2 sm:gap-2.5 shrink-0">
            <!-- Button: Impor Excel / CSV -->
            <button 
                wire:click="openImportModal()"
                class="h-10 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold rounded-xl text-xs flex items-center justify-center space-x-1.5 shadow-md active:scale-95 transition-all cursor-pointer whitespace-nowrap"
            >
                <svg class="w-4 h-4 text-emerald-200 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                </svg>
                <span>Impor Excel</span>
            </button>

            <!-- Button: Tambah Siswa Manual -->
            <button 
                wire:click="openForm()"
                class="h-10 px-4 bg-slate-900 hover:bg-slate-800 text-white font-extrabold rounded-xl text-xs flex items-center justify-center space-x-1.5 shadow-md active:scale-95 transition-all cursor-pointer whitespace-nowrap"
            >
                <svg class="w-4 h-4 text-amber-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span>+ Tambah Siswa</span>
            </button>
        </div>

    </div>

    <!-- Search & Filter Controls -->
    <div class="space-y-3.5 relative z-20 font-['Outfit']">
        <div class="relative w-full">
            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.602 10.602z" />
                </svg>
            </span>
            <input 
                type="text" 
                wire:model.live.debounce.300ms="search" 
                class="w-full pl-9.5 pr-4 py-2.5 border border-slate-300/40 rounded-xl text-xs placeholder-slate-400 focus:outline-none focus:border-slate-800 focus:ring-4 focus:ring-slate-800/10 bg-white shadow-xs"
                placeholder="Cari nama siswa atau NISN..."
            >
        </div>

        <div class="flex items-center justify-between w-full">
            <div x-data="{ openFilter: false }" class="relative">
                <button 
                    @click="openFilter = !openFilter"
                    class="px-4 py-2 bg-white hover:bg-slate-50 border border-slate-300/45 rounded-xl flex items-center space-x-1.5 text-xs font-extrabold text-slate-700 shadow-xs cursor-pointer"
                >
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3c2.755 0 5.455.232 8.083.678.533.09.917.556.917 1.096v1.044a2.25 2.25 0 01-.659 1.591l-5.432 5.432a2.25 2.25 0 00-.659 1.591v2.927a2.25 2.25 0 01-1.244 2.013L9.75 21v-6.568a2.25 2.25 0 00-.659-1.591L3.659 7.409A2.25 2.25 0 013 5.818V4.774c0-.54.384-1.006.917-1.096A48.32 48.32 0 0112 3z" />
                    </svg>
                    <span>Urutkan</span>
                </button>

                <div 
                    x-show="openFilter" 
                    @click.away="openFilter = false"
                    class="absolute left-0 mt-1.5 w-48 rounded-2xl bg-white shadow-lg border border-gray-100 z-30 py-1.5 overflow-hidden" 
                    style="display: none;"
                >
                    <button wire:click="$set('sortBy', 'name_asc')" @click="openFilter = false" class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-700 text-xs">Nama A - Z</button>
                    <button wire:click="$set('sortBy', 'name_desc')" @click="openFilter = false" class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-700 text-xs">Nama Z - A</button>
                    <button wire:click="$set('sortBy', 'balance_desc')" @click="openFilter = false" class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-700 text-xs">Saldo Terbanyak</button>
                    <button wire:click="$set('sortBy', 'balance_asc')" @click="openFilter = false" class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-700 text-xs">Saldo Tersedikit</button>
                </div>
            </div>

            <div class="text-xs text-slate-900 font-extrabold uppercase tracking-wider text-right">
                TOTAL: {{ $students->total() }} SISWA
            </div>
        </div>
    </div>

    <!-- Student Cards List (2 Columns Grid on Desktop) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3.5 md:gap-4 relative z-10 font-['Outfit']">
        @forelse($students as $student)
            @php
                $words = explode(' ', $student->name);
                $initials = count($words) >= 2 
                    ? substr($words[0], 0, 1) . substr($words[1], 0, 1) 
                    : substr($student->name, 0, 2);
                $initials = strtoupper($initials);
            @endphp
            
            <div wire:key="student-{{ $student->id }}" class="bg-white border border-gray-150 rounded-2xl p-4 space-y-3 shadow-xs hover:border-amber-400 transition-all flex flex-col justify-between">
                
                <!-- Top Header: Avatar, Name, NISN, Balance -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3 min-w-0">
                        <div class="w-12 h-12 rounded-full bg-slate-100 border border-amber-200 flex items-center justify-center shrink-0 overflow-hidden">
                            <img src="/assets/{{ $student->avatar ?? 'i1.png' }}" alt="Profile" class="w-full h-full object-cover rounded-full">
                        </div>
                        <div class="text-left min-w-0">
                            <h3 class="text-sm sm:text-base font-extrabold text-slate-900 truncate">{{ $student->name }}</h3>
                            <p class="text-xs text-slate-400 font-medium">NISN: {{ $student->nisn }}</p>
                        </div>
                    </div>

                    <div class="text-right">
                        <span class="text-[10px] text-slate-400 font-extrabold uppercase tracking-wider block">Saldo Aktif</span>
                        <span class="text-sm sm:text-base font-extrabold text-slate-900">
                            Rp {{ number_format($student->balance, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <!-- Bottom Action Row: Setor, Tarik, Edit, Hapus, Reset Password -->
                <div class="flex items-center justify-between pt-2 border-t border-slate-100">
                    <div class="flex items-center space-x-1.5">
                        <!-- Edit Button -->
                        <button 
                            wire:click="openForm({{ $student->id }})"
                            class="px-2.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-lg text-xs flex items-center space-x-1 transition-all"
                            title="Edit Nama / NISN"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                            <span>Edit</span>
                        </button>

                        <!-- Delete Button -->
                        <button 
                            wire:click="openDeleteModal({{ $student->id }}, '{{ addslashes($student->name) }}')"
                            class="px-2.5 py-1.5 bg-slate-950 hover:bg-slate-900 text-white font-bold rounded-lg text-xs flex items-center space-x-1 transition-all cursor-pointer shadow-xs active:scale-95"
                            title="Hapus Siswa"
                        >
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                            <span>Hapus</span>
                        </button>

                    </div>

                    <div class="flex items-center space-x-2">
                        <!-- Tarik Button -->
                        <button 
                            wire:click="openWithdrawalModal({{ $student->id }}, '{{ addslashes($student->name) }}', {{ $student->balance }})"
                            class="px-3 py-1.5 bg-slate-950 hover:bg-slate-900 text-[#ffd554] font-extrabold rounded-xl text-xs flex items-center space-x-1 transition-all active:scale-95 shadow-xs cursor-pointer"
                        >
                            <span>Tarik</span>
                        </button>

                        <!-- Setor Button -->
                        <button 
                            @click="selectedId = {{ $student->id }}; selectedName = '{{ addslashes($student->name) }}'; depositAmount = ''; formattedAmount = ''; openDeposit = true"
                            class="px-4 py-1.5 bg-amber-400 hover:bg-amber-500 text-slate-900 font-extrabold rounded-xl text-xs flex items-center space-x-1 transition-all active:scale-95 shadow-xs"
                        >
                            <span>Setor</span>
                        </button>
                    </div>
                </div>

            </div>
        @empty
            <div class="col-span-1 md:col-span-2 bg-white border border-gray-150 rounded-2xl p-8 text-center text-slate-400 font-medium italic shadow-xs">
                Belum ada siswa di kelas Anda. Klik "Tambah Siswa" atau "Impor Excel" di atas untuk mulai memasukkan murid.
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($students->hasPages())
        <div class="mt-4 flex items-center justify-between font-['Outfit'] text-xs font-semibold px-2">
            <button wire:click="previousPage" @if($students->onFirstPage()) disabled @endif class="px-3.5 py-2 bg-white border rounded-xl disabled:opacity-40">Sebelumnya</button>
            <span class="text-slate-800 font-bold">Halaman {{ $students->currentPage() }} dari {{ $students->lastPage() }}</span>
            <button wire:click="nextPage" @if(!$students->hasMorePages()) disabled @endif class="px-3.5 py-2 bg-white border rounded-xl disabled:opacity-40">Selanjutnya</button>
        </div>
    @endif

    <!-- Deposit Modal (Alpine controlled) -->
    <div x-show="openDeposit" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center z-50 p-4" style="display: none;">
        <div class="bg-white rounded-3xl p-6 shadow-xl max-w-sm w-full border border-slate-100 space-y-4" @click.away="openDeposit = false">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-extrabold text-slate-800 font-['Outfit']">Setor Tunai Tabungan</h3>
                <button @click="openDeposit = false" class="text-slate-400 hover:text-slate-600">✕</button>
            </div>
            <div class="bg-amber-50 border border-amber-100 p-3 rounded-xl">
                <span class="text-[9px] text-amber-800 font-bold uppercase block">Nama Siswa</span>
                <span class="text-xs font-bold text-slate-700 block mt-0.5" x-text="selectedName"></span>
            </div>
            <form @submit.prevent="$wire.simpanSetoran(selectedId, depositAmount).then(() => { openDeposit = false; })" class="space-y-4">
                <div class="space-y-1">
                    <label class="text-[10px] text-slate-400 font-bold uppercase">Nominal Setoran (Rp)</label>
                    <input type="text" inputmode="numeric" x-model="formattedAmount" @input="updateAmount($event.target.value)" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm font-bold bg-slate-50 focus:outline-none focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10" placeholder="Contoh: 50.000" required>
                </div>
                <button type="submit" class="w-full py-3 bg-[#ffd554] hover:bg-[#e5bf43] text-slate-900 font-extrabold rounded-xl text-xs shadow-md active:scale-95 transition-all cursor-pointer">Simpan Setoran</button>
            </form>
        </div>
    </div>

    <!-- Withdrawal Modal (Livewire controlled) -->
    @if($isWithdrawalModalOpen)
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-3xl p-6 shadow-xl max-w-sm w-full border border-slate-100 space-y-4 font-['Outfit']">
                <div class="flex items-center justify-between border-b pb-3">
                    <h3 class="text-sm font-extrabold text-slate-800">Penarikan Tabungan</h3>
                    <button wire:click="closeWithdrawalModal" class="text-slate-400 hover:text-slate-600">✕</button>
                </div>
                <div class="bg-[#fff8e5] border border-amber-200/80 p-3.5 rounded-2xl shadow-3xs space-y-0.5">
                    <span class="text-[9px] text-amber-900 font-extrabold uppercase tracking-wider block">Siswa & Saldo Aktif</span>
                    <span class="text-xs font-black text-slate-900 block">{{ $withdrawalStudentName }}</span>
                    <span class="text-base font-black text-slate-900 block pt-0.5">Rp {{ number_format($withdrawalStudentBalance, 0, ',', '.') }}</span>
                </div>
                <form wire:submit.prevent="simpanPenarikan" class="space-y-4">
                    <div class="space-y-1" x-data="{ 
                        formatInput(val) {
                            let clean = val.replace(/\D/g, '');
                            if (!clean) {
                                $wire.set('withdrawalAmount', '');
                                return '';
                            }
                            $wire.set('withdrawalAmount', parseInt(clean));
                            return new Intl.NumberFormat('id-ID').format(clean);
                        } 
                    }">
                        <label class="text-[10px] text-slate-400 font-bold uppercase">Nominal Penarikan (Rp)</label>
                        <input 
                            type="text" 
                            inputmode="numeric"
                            x-data="{ displayVal: '{{ $withdrawalAmount ? number_format((float)$withdrawalAmount, 0, ',', '.') : '' }}' }"
                            x-model="displayVal"
                            @input="displayVal = formatInput($event.target.value)"
                            class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm font-bold bg-slate-50 focus:outline-none focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10" 
                            placeholder="Contoh: 20.000" 
                            required
                        >
                        @error('withdrawalAmount') <span class="text-xs text-rose-500 font-bold">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="w-full py-3 bg-slate-950 hover:bg-slate-900 text-[#ffd554] font-extrabold rounded-xl text-xs shadow-md active:scale-95 transition-all cursor-pointer">Proses Penarikan</button>
                </form>
            </div>
        </div>
    @endif

    <!-- Single Student Form Modal (Create / Edit) -->
    @if($isFormOpen)
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center z-50 p-4 font-['Outfit']">
            <div class="bg-white rounded-3xl p-6 shadow-xl max-w-md w-full border border-slate-100 space-y-4">
                <div class="flex items-center justify-between border-b pb-3">
                    <h3 class="text-base font-extrabold text-slate-800">{{ $studentId ? 'Edit Data Siswa' : 'Tambah Siswa Baru' }}</h3>
                    <button wire:click="closeForm" class="text-slate-400 hover:text-slate-600">✕</button>
                </div>
                <form wire:submit.prevent="saveStudent" class="space-y-3">
                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Nama Lengkap Siswa</label>
                        <input type="text" wire:model="name" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm bg-slate-50" placeholder="Contoh: Ahmad Rafif" required>
                        @error('name') <span class="text-xs text-rose-500 font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">NISN (10 Digit Angka)</label>
                        <input type="text" inputmode="numeric" pattern="[0-9]*" wire:model="nisn" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm bg-slate-50 font-mono font-bold" placeholder="Contoh: 0123456789" maxlength="10" required>
                        @error('nisn') <span class="text-xs text-rose-500 font-bold">{{ $message }}</span> @enderror
                    </div>

                    @if(!$studentId)
                        <div class="space-y-1">
                            <label class="text-xs font-bold text-slate-700">Saldo Awal (Rp)</label>
                            <input type="number" inputmode="numeric" pattern="[0-9]*" wire:model="balance" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm bg-slate-50 font-bold" placeholder="0">
                            @error('balance') <span class="text-xs text-rose-500 font-bold">{{ $message }}</span> @enderror
                        </div>
                    @endif

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Target Tabungan (Rp)</label>
                        <input type="number" inputmode="numeric" pattern="[0-9]*" wire:model="saving_target" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-sm bg-slate-50 font-bold" placeholder="500000">
                    </div>

                    <div class="pt-2 flex items-center justify-end space-x-2">
                        <button type="button" wire:click="closeForm" class="px-4 py-2.5 bg-slate-100 text-slate-600 font-bold rounded-xl text-xs">Batal</button>
                        <button type="submit" class="px-5 py-2.5 bg-[#ffd554] hover:bg-[#e5bf43] text-slate-900 font-extrabold rounded-xl text-xs">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- CSV Import Modal -->
    @if($isImportOpen)
        <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center z-50 p-4 font-['Outfit']">
            <div class="bg-white rounded-3xl p-6 shadow-xl max-w-md w-full border border-slate-100 space-y-4">
                <div class="flex items-center justify-between border-b pb-3">
                    <h3 class="text-base font-extrabold text-slate-800">Impor Siswa via Excel / CSV</h3>
                    <button wire:click="closeImportModal" class="text-slate-400 hover:text-slate-600 cursor-pointer">✕</button>
                </div>
                <!-- Template Instruction Card -->
                <div class="bg-amber-50/80 border border-amber-200/60 rounded-2xl p-3.5 space-y-2">
                    <div class="flex items-center space-x-2 text-amber-900">
                        <svg class="w-4 h-4 text-amber-700 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                        </svg>
                        <span class="text-xs font-extrabold">Petunjuk Impor Data Siswa</span>
                    </div>
                    <p class="text-[11px] text-slate-600 leading-relaxed font-medium">
                        Gunakan file Excel berformat <strong>.CSV</strong> sesuai standar template. Silakan unduh contoh file template di bawah ini jika belum memilikinya:
                    </p>
                    <button 
                        type="button"
                        wire:click="downloadTemplate"
                        class="w-full py-2 px-3 bg-white hover:bg-amber-100/50 border border-amber-300/80 text-amber-900 font-extrabold rounded-xl text-xs flex items-center justify-center space-x-2 transition-all cursor-pointer shadow-3xs"
                    >
                        <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        <span>Unduh Format Template Excel (.csv)</span>
                    </button>
                </div>

                <form wire:submit.prevent="importCsv" class="space-y-4">
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-700">Pilih Berkas CSV</label>
                        <div class="relative border-2 border-dashed border-slate-250 hover:border-amber-400 bg-slate-50/60 rounded-2xl p-5 transition-all flex flex-col items-center justify-center text-center cursor-pointer group">
                            <input 
                                type="file" 
                                wire:model="csvFile" 
                                accept=".csv,text/csv" 
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                            >
                            <div class="space-y-2.5 flex flex-col items-center pointer-events-none">
                                <div class="w-10 h-10 rounded-xl bg-amber-100/80 text-amber-700 flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                    </svg>
                                </div>
                                <div class="text-xs font-extrabold text-slate-700">
                                    @if($csvFile)
                                        <span class="inline-flex items-center px-3.5 py-1.5 bg-emerald-100 text-emerald-800 rounded-xl text-xs font-bold shadow-3xs">
                                            Terpilih: {{ $csvFile->getClientOriginalName() }}
                                        </span>
                                    @else
                                        <span class="px-4 py-2 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-extrabold shadow-sm inline-block transition-colors">
                                            Pilih Berkas dari Komputer
                                        </span>
                                    @endif
                                </div>
                                <p class="text-[10px] text-slate-400 font-semibold">Hanya berkas format .csv (Maksimal 2MB)</p>
                            </div>
                        </div>
                        @error('csvFile') <span class="text-xs text-rose-500 font-bold block mt-1">{{ $message }}</span> @enderror
                    </div>

                    @if(!empty($importErrors))
                        <div class="bg-rose-50 border border-rose-200 text-rose-700 p-3 rounded-xl text-xs max-h-36 overflow-y-auto space-y-1">
                            <span class="font-bold block">Catatan Kesalahan:</span>
                            @foreach($importErrors as $err)
                                <div>• {{ $err }}</div>
                            @endforeach
                        </div>
                    @endif

                    <div class="pt-2 flex items-center justify-end space-x-2">
                        <button type="button" wire:click="closeImportModal" class="px-4 py-2.5 bg-slate-100 text-slate-600 font-bold rounded-xl text-xs hover:bg-slate-200 transition-colors cursor-pointer">Batal</button>
                        <button 
                            type="submit" 
                            wire:loading.attr="disabled"
                            class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold rounded-xl text-xs shadow-xs transition-all active:scale-95 cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed flex items-center space-x-1.5"
                        >
                            <span wire:loading.remove>Mulai Impor</span>
                            <span wire:loading class="flex items-center space-x-1.5">
                                <svg class="animate-spin h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>Memproses...</span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Delete Confirmation Floating Pop-up Modal -->
    @if($isDeleteModalOpen)
        <div class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center z-50 p-4 font-['Outfit']">
            <div class="bg-white rounded-3xl p-6 shadow-2xl max-w-sm w-full border border-slate-100 space-y-4 text-center">
                <div class="w-36 h-36 mx-auto flex items-center justify-center -my-3">
                    <lottie-player 
                        src="/assets/delete.json" 
                        background="transparent" 
                        speed="1" 
                        class="w-full h-full" 
                        loop 
                        autoplay
                    ></lottie-player>
                </div>
                <div class="space-y-1.5">
                    <h3 class="text-base font-extrabold text-slate-800 tracking-tight">Hapus Data Siswa?</h3>
                    <p class="text-xs text-slate-600 font-medium leading-relaxed">
                        Apakah Anda yakin ingin menghapus siswa <span class="font-extrabold text-slate-900">{{ $deletingStudentName }}</span>? Seluruh riwayat transaksi murid ini akan terhapus.
                    </p>
                </div>
                <div class="grid grid-cols-2 gap-2.5 pt-2">
                    <button 
                        wire:click="closeDeleteModal" 
                        class="w-full py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-extrabold rounded-xl text-xs transition-all active:scale-95 cursor-pointer"
                    >
                        Batal
                    </button>
                    <button 
                        wire:click="deleteStudent" 
                        class="w-full py-2.5 bg-slate-950 hover:bg-slate-900 text-white font-extrabold rounded-xl text-xs transition-all active:scale-95 cursor-pointer shadow-md"
                    >
                        Ya, Hapus
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- WhatsApp Share Broadcast Modal (Alpine controlled) -->
    <div 
        x-show="openWaModal" 
        x-transition
        class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs flex items-center justify-center z-50 p-4 font-['Outfit']"
        style="display: none;"
    >
        <div class="bg-white rounded-3xl p-6 shadow-2xl max-w-md w-full border border-slate-100 space-y-4" @click.away="openWaModal = false">
            <div class="flex items-center justify-between border-b pb-3">
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center text-emerald-600">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M12.012 2c-5.506 0-9.989 4.478-9.99 9.984a9.932 9.932 0 0 0 1.344 5.016L2 22l5.127-1.332a9.92 9.92 0 0 0 4.885 1.28h.004c5.506 0 9.99-4.478 9.99-9.985A9.94 9.94 0 0 0 12.012 2zm5.836 14.361c-.244.686-1.42 1.31-1.96 1.391-.5.074-1.144.106-3.666-.937-3.037-1.256-4.992-4.341-5.144-4.542-.152-.202-1.233-1.639-1.233-3.125 0-1.486.777-2.217 1.052-2.518.275-.3.6-.375.8-.375.2 0 .4 0 .575.01.187.009.437-.071.684.521.25.6.85 2.073.924 2.223.075.15.125.326.025.526-.1.2-.15.325-.3.5-.15.175-.315.391-.45.525-.15.15-.306.315-.13.615.175.3 0 .777 1.63 2.146 1.956 1.745.326.05.525-.025.725-.1.2-.85-1.002-1.075-1.277-.225-.275-.475-.25-.65 0-.175.25-.725.925-.9 1.15-.175.225-.35.25-.65.1-.3-.15-1.267-.467-2.414-1.49-1.785-1.593-2.99-3.56-3.34-4.16-.35-.6-.037-.925.112-1.074.135-.135.3-.35.45-.525.15-.175.2-.3.3-.5.1-.2.05-.375-.025-.525-.075-.15-.925-2.228-1.268-3.053-.334-.803-.675-.694-.925-.707-.225-.01-.475-.01-.725-.01s-.65.093-.99.467c-.34.374-1.29 1.262-1.29 3.077 0 1.815 1.324 3.568 1.508 3.815.184.247 2.607 3.982 6.315 5.58 2.502 1.08 3.47.864 4.093.804.77-.074 1.76-.719 2.01-1.411z"/>
                        </svg>
                    </div>
                    <h3 class="text-base font-extrabold text-slate-800">Bagikan Pesan Pengumuman WA</h3>
                </div>
                <button @click="openWaModal = false" class="text-slate-400 hover:text-slate-600 cursor-pointer">✕</button>
            </div>

            <div class="space-y-2">
                <p class="text-xs text-slate-600 font-medium">
                    Salin teks pengumuman resmi di bawah ini untuk dibagikan ke grup WhatsApp Wali Murid {{ $className ?? 'Kelas' }}:
                </p>
                <textarea 
                    id="waText" 
                    readonly 
                    rows="6" 
                    class="w-full p-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-xs font-mono text-slate-800 focus:outline-none leading-relaxed"
                >Assalamu'alaikum Wr. Wb. / Selamat Pagi Bapak/Ibu Wali Murid {{ $className ?? 'Kelas' }} {{ Auth::user()->school_name ?? '' }}.

Guna mempermudah pemantauan saldo dan riwayat tabungan harian putra/putri Bapak/Ibu secara transparan dari rumah, silakan unduh aplikasi SakuSiswa di Play Store.

Masuk menggunakan nomor NISN putra/putri Anda sebagai Username & Password.

Terima kasih.
Wali Kelas {{ $className ?? '' }} - {{ Auth::user()->name }}</textarea>
            </div>

            <div class="pt-2 flex items-center justify-between gap-3">
                <button 
                    type="button" 
                    @click="openWaModal = false" 
                    class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-extrabold rounded-xl text-xs"
                >
                    Tutup
                </button>
                <button 
                    type="button" 
                    @click="navigator.clipboard.writeText(document.getElementById('waText').value); copiedWa = true; setTimeout(() => copiedWa = false, 3000)" 
                    class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold rounded-xl text-xs flex items-center space-x-2 shadow-md cursor-pointer"
                >
                    <svg x-show="!copiedWa" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 01-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 011.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 00-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 01-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 0013.875 3.75H12" />
                    </svg>
                    <span x-show="!copiedWa">Salin Teks Pengumuman WA</span>
                    <span x-show="copiedWa" style="display: none;">Teks Berhasil Disalin!</span>
                </button>
            </div>
        </div>
    </div>
</div>
