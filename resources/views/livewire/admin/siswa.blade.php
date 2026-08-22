<div class="-mx-4 -mt-4 sm:-mx-6 sm:-mt-6 md:-mx-8 md:-mt-8 p-4 sm:p-6 md:p-8 min-h-screen bg-[#ffd554] pb-24 space-y-5.5 font-sans relative overflow-hidden" x-data="{ 
    openForm: @entangle('isFormOpen'),
    openImport: @entangle('isImportOpen'),
    confirmOpen: false,
    confirmTitle: '',
    confirmMessage: '',
    confirmAction: null,
    confirmButtonText: 'Hapus',
    confirmButtonClass: 'bg-rose-500 hover:bg-rose-600 text-white',
    
    formattedBalance: '',
    formattedSavingTarget: '',
    
    init() {
        this.formattedBalance = this.formatNumber($wire.get('balance'));
        this.formattedSavingTarget = this.formatNumber($wire.get('saving_target'));
        
        this.$watch('openForm', value => {
            if (value) {
                this.formattedBalance = this.formatNumber($wire.get('balance'));
                this.formattedSavingTarget = this.formatNumber($wire.get('saving_target'));
            }
        });
        
        this.$watch('$wire.balance', value => {
            this.formattedBalance = this.formatNumber(value);
        });
        
        this.$watch('$wire.saving_target', value => {
            this.formattedSavingTarget = this.formatNumber(value);
        });
    },
    
    formatNumber(val) {
        if (val === undefined || val === null || val === '') return '';
        let clean = val.toString().replace(/\D/g, '');
        return clean.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    },
    
    updateBalance(val) {
        let clean = val.replace(/\D/g, '');
        this.formattedBalance = this.formatNumber(clean);
        $wire.set('balance', parseFloat(clean) || 0);
    },
    
    updateSavingTarget(val) {
        let clean = val.replace(/\D/g, '');
        this.formattedSavingTarget = this.formatNumber(clean);
        $wire.set('saving_target', parseFloat(clean) || 0);
    },
    
    triggerConfirm(title, message, action, buttonText = 'Hapus', buttonClass = 'bg-rose-500 hover:bg-rose-600 text-white') {
        this.confirmTitle = title;
        this.confirmMessage = message;
        this.confirmAction = action;
        this.confirmButtonText = buttonText;
        this.confirmButtonClass = buttonClass;
        this.confirmOpen = true;
    },
    executeConfirm() {
        if (this.confirmAction) {
            this.confirmAction();
        }
        this.confirmOpen = false;
    }
}">
    
    <!-- Decorative background elements -->
    <div class="absolute top-0 right-0 w-32 h-32 opacity-10 pointer-events-none translate-x-6 -translate-y-6 z-0">
        <svg class="w-full h-full text-amber-800" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17 2c-3.87 0-7 3.13-7 7 0 2.21 1.02 4.18 2.62 5.5L12 15c-.41.34-1.07.34-1.48 0L2.3 8.3c-.63-.5-1.52-.38-2 .25-.5.63-.38 1.52.25 2l8.22 6.7c1.39 1.13 3.47 1.13 4.86 0L22 10.3c.63-.5.75-1.39.25-2-.5-.63-1.39-.75-2-.25l-2.62 2.15C17.98 9.38 17 7.41 17 5V2z"/>
        </svg>
    </div>

    <!-- Header Banner Card (Inverted Dark Slate Container with High-Contrast Badges & Illustration) -->
    <div class="relative overflow-hidden bg-slate-900 border border-slate-800 rounded-3xl p-5 sm:p-6 shadow-md flex items-center justify-between min-h-[140px] sm:min-h-[160px] relative z-10 font-['Outfit'] text-white">
        <!-- Text Left Section -->
        <div class="text-left space-y-2.5 sm:space-y-3 relative z-10 pr-28 sm:pr-44 md:pr-60">
            <div class="space-y-1">
                <h1 class="text-xl sm:text-2xl md:text-3xl font-black text-white tracking-tight">Manajemen Siswa</h1>
            </div>

            <!-- Role Badge -->
            <div class="flex flex-wrap items-center gap-2">
                <div class="inline-flex items-center space-x-2 px-3 py-1 sm:px-3.5 sm:py-1.5 bg-[#ffd554] text-slate-950 rounded-full text-xs font-black shadow-xs">
                    <span>Akses Utama</span>
                    <span class="opacity-40">|</span>
                    <span>Administrator</span>
                </div>
            </div>
        </div>

        <!-- Header Illustration on the right -->
        <div class="absolute -right-3 -bottom-3 sm:-right-4 sm:-bottom-4 w-44 h-36 sm:w-56 sm:h-44 md:w-64 md:h-48 pointer-events-none z-0">
            <img src="/assets/headerguru.png" alt="Siswa Illustration" class="w-full h-full object-contain object-right-bottom">
        </div>
    </div>

    <!-- Success Modal with Lottie Animation & Golden Yellow Brand Styling -->
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

    <!-- Controls Area -->
    <div class="flex flex-wrap md:flex-row gap-2 sm:gap-3 w-full relative z-20 font-['Outfit'] justify-between">
        <!-- Bulk Action Toggle Button -->
        <button 
            wire:click="toggleSelectionMode"
            class="order-2 md:order-1 w-auto px-3.5 py-3 rounded-2xl flex items-center justify-center space-x-1.5 text-xs font-bold transition-all active:scale-[0.97] cursor-pointer shadow-3xs shrink-0 border {{ $isSelectionMode ? 'bg-[#0c1a30] border-[#0c1a30] text-white hover:bg-slate-800' : 'bg-white border-slate-100 text-slate-700 hover:bg-slate-50' }}"
        >
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                @if($isSelectionMode)
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                @else
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                @endif
            </svg>
            <span class="hidden sm:inline">{{ $isSelectionMode ? 'Selesai Pilih' : 'Pilih Siswa' }}</span>
            <span class="inline sm:hidden">{{ $isSelectionMode ? 'Selesai' : 'Pilih' }}</span>
        </button>

        <!-- Search bar -->
        <div class="order-1 md:order-2 w-full md:flex-1 relative">
            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400">
                <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </span>
            <input 
                type="text" 
                wire:model.live="search"
                class="w-full pl-11 pr-4 py-3 bg-white border border-slate-100 rounded-2xl text-xs font-bold text-slate-800 focus:outline-hidden focus:border-amber-500 shadow-3xs placeholder-slate-400"
                placeholder="Cari nama siswa atau NISN..."
            >
        </div>

        <!-- School filter dropdown -->
        <div class="order-4 md:order-4 w-36 sm:w-48 relative font-['Outfit']" x-data="{ openSchool: false }">
            <button 
                @click="openSchool = !openSchool"
                class="w-full px-3 py-3 bg-white border border-slate-100 rounded-2xl flex items-center justify-between space-x-1.5 text-xs font-bold text-slate-700 shadow-3xs cursor-pointer transition-all active:scale-[0.97]"
            >
                <span class="truncate">{{ $schoolFilter === '' ? 'Semua Sekolah' : $schoolFilter }}</span>
                <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" :class="openSchool ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </button>
            <div 
                x-show="openSchool" 
                @click.away="openSchool = false"
                x-transition
                class="absolute right-0 mt-1.5 w-44 sm:w-56 max-h-48 overflow-y-auto rounded-2xl bg-white shadow-lg border border-slate-100 z-50 py-1"
                style="display: none; scrollbar-width: thin;"
            >
                <button wire:click="$set('schoolFilter', '')" @click="openSchool = false" class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-700 text-xs {{ $schoolFilter === '' ? 'bg-amber-50 text-amber-900 font-bold' : '' }} cursor-pointer">Semua Sekolah</button>
                @foreach($availableSchools as $sch)
                    <button wire:click="$set('schoolFilter', '{{ $sch }}')" @click="openSchool = false" class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-700 text-xs {{ $schoolFilter === $sch ? 'bg-amber-50 text-amber-900 font-bold' : '' }} cursor-pointer">{{ $sch }}</button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-xs relative z-10 space-y-5">
        <div class="overflow-x-auto -mx-6">
            <div class="inline-block min-w-full align-middle px-6">
                <table class="min-w-full divide-y divide-slate-100 text-left">
                    <thead>
                        <tr class="text-[10px] font-black text-slate-400 uppercase tracking-wider">
                            @if($isSelectionMode)
                            <th class="py-3.5 pr-2 pl-4 w-10">
                                <input 
                                    type="checkbox" 
                                    wire:model.live="selectAll"
                                    class="rounded-md border-slate-200 text-amber-500 focus:ring-amber-500 w-4 h-4 cursor-pointer"
                                >
                            </th>
                            @endif
                            <th class="py-3.5 px-4">Siswa</th>
                            <th class="py-3.5 px-4">NISN</th>
                            <th class="py-3.5 px-4">Sekolah & Kelas</th>
                            <th class="py-3.5 px-4">Wali Kelas</th>
                            <th class="py-3.5 px-4">Saldo</th>
                            <th class="py-3.5 px-4">Target Tabungan</th>
                            <th class="py-3.5 pl-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs text-slate-770 font-medium">
                        @forelse($students as $student)
                            <tr wire:key="student-{{ $student->id }}" class="hover:bg-slate-50/55 transition-colors">
                                @if($isSelectionMode)
                                <td class="py-4 pr-2 pl-4 w-10">
                                    <input 
                                        type="checkbox" 
                                        value="{{ $student->id }}" 
                                        wire:model.live="selectedStudents"
                                        class="rounded-md border-slate-250 text-amber-500 focus:ring-amber-500 w-4 h-4 cursor-pointer"
                                    >
                                </td>
                                @endif
                                <td class="py-4 px-4 font-bold text-slate-800">
                                    {{ $student->name }}
                                </td>
                                <td class="py-4 px-4 font-semibold text-slate-500">
                                    {{ $student->nisn }}
                                </td>
                                <td class="py-4 px-4">
                                    <div class="space-y-0.5">
                                        <span class="font-extrabold text-slate-800 block text-xs whitespace-nowrap">
                                            {{ $student->user->school_name ?? 'Sekolah' }}
                                        </span>
                                        <span class="inline-flex items-center px-2 py-0.5 bg-slate-50 border border-slate-100 rounded-md text-[10px] font-bold text-slate-600 whitespace-nowrap">
                                            Kelas {{ $student->class_name }}
                                        </span>
                                    </div>
                                </td>
                                <td class="py-4 px-4 font-semibold text-slate-700 whitespace-nowrap">
                                    {{ $student->user->name ?? '-' }}
                                </td>
                                <td class="py-4 px-4 font-black text-emerald-600">
                                    Rp {{ number_format($student->balance, 0, ',', '.') }}
                                </td>
                                <td class="py-4 px-4 font-bold text-slate-700">
                                    Rp {{ number_format($student->saving_target, 0, ',', '.') }}
                                </td>
                                <td class="py-4 pl-4 text-right shrink-0">
                                    <div class="flex items-center justify-end space-x-1.5 font-['Outfit']">
                                        <!-- Credentials Dropdown -->
                                        <div x-data="{ openCreds: false }" class="relative inline-block text-left">
                                            <button 
                                                @click="openCreds = !openCreds" 
                                                class="h-8 px-2.5 bg-amber-50 hover:bg-amber-100 text-amber-800 font-extrabold rounded-xl text-[10px] inline-flex items-center justify-center space-x-1 transition-all cursor-pointer border border-amber-250/20 shadow-3xs active:scale-95"
                                            >
                                                <span>Kredensial</span>
                                                <svg class="w-3 h-3 text-amber-700 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                            <div 
                                                x-show="openCreds" 
                                                @click.away="openCreds = false"
                                                x-transition
                                                class="absolute right-0 mt-1.5 w-40 rounded-xl bg-white shadow-lg border border-slate-100 z-30 py-1 overflow-hidden text-left" 
                                                style="display: none;"
                                            >
                                                <button 
                                                    type="button"
                                                    @click="
                                                        openCreds = false;
                                                        triggerConfirm(
                                                            'Reset Password', 
                                                            'Apakah Anda yakin ingin mereset password orang tua siswa <strong>{{ addslashes($student->name) }}</strong> kembali ke NISN default?', 
                                                            () => $wire.resetPasswordOrangTua({{ $student->id }}),
                                                            'Reset',
                                                            'bg-amber-400 hover:bg-amber-500 text-slate-900'
                                                        )
                                                    "
                                                    class="w-full text-left px-4 py-2.5 hover:bg-slate-50 font-semibold text-slate-700 text-xs cursor-pointer block border-b border-slate-50"
                                                >
                                                    Reset Password
                                                </button>
                                                <button 
                                                    type="button"
                                                    @click="
                                                        openCreds = false;
                                                        triggerConfirm(
                                                            'Reset PIN Transaksi', 
                                                            'Apakah Anda yakin ingin mereset PIN transaksi orang tua siswa <strong>{{ addslashes($student->name) }}</strong>?', 
                                                            () => $wire.resetPinOrangTua({{ $student->id }}),
                                                            'Reset',
                                                            'bg-amber-400 hover:bg-amber-500 text-slate-900'
                                                        )
                                                    "
                                                    class="w-full text-left px-4 py-2.5 hover:bg-slate-50 font-semibold text-slate-700 text-xs cursor-pointer block"
                                                >
                                                    Reset PIN
                                                </button>
                                            </div>
                                        </div>

                                        <!-- Edit Icon Button -->
                                        <button 
                                            type="button"
                                            @click="$wire.openForm({{ $student->id }})"
                                            class="w-8 h-8 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-all cursor-pointer inline-flex items-center justify-center border border-slate-200/60 shadow-3xs hover:shadow-2xs active:scale-95 shrink-0"
                                            title="Edit Siswa"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                        </button>

                                        <!-- Delete Icon Button -->
                                        <button 
                                            type="button"
                                            @click="triggerConfirm(
                                                'Hapus Siswa', 
                                                'Apakah Anda yakin ingin menghapus data siswa <strong>{{ addslashes($student->name) }}</strong> secara permanen? <strong class=\'text-rose-600\'>Seluruh riwayat transaksi keuangan (setoran & penarikan) siswa ini akan terhapus secara permanen dari sistem pembukuan!</strong>', 
                                                () => $wire.deleteStudent({{ $student->id }}),
                                                'Hapus',
                                                'bg-rose-500 hover:bg-rose-600 text-white'
                                            )"
                                            class="w-8 h-8 bg-rose-50 hover:bg-rose-100 text-rose-600 font-bold rounded-xl transition-all cursor-pointer inline-flex items-center justify-center border border-rose-200/60 shadow-3xs hover:shadow-2xs active:scale-95 shrink-0"
                                            title="Hapus Siswa"
                                        >
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $isSelectionMode ? '7' : '6' }}" class="py-8 text-center text-slate-400 font-semibold italic">
                                    Belum ada data siswa terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination Controls -->
        @if($students->hasPages())
            <div class="mt-5 flex items-center justify-between font-['Outfit'] text-xs font-semibold px-2 border-t border-slate-50 pt-4">
                <button 
                    wire:click="previousPage" 
                    @if($students->onFirstPage()) disabled @endif
                    class="px-3.5 py-2 bg-white border border-slate-200 text-slate-700 rounded-xl hover:bg-slate-50 transition-all disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer active:scale-95 shadow-3xs"
                >
                    Sebelumnya
                </button>
                
                <span class="text-slate-500 font-bold">
                    Halaman {{ $students->currentPage() }} dari {{ $students->lastPage() }}
                </span>
                
                <button 
                    wire:click="nextPage" 
                    @if(!$students->hasMorePages()) disabled @endif
                    class="px-3.5 py-2 bg-white border border-slate-200 text-slate-700 rounded-xl hover:bg-slate-50 transition-all disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer active:scale-95 shadow-3xs"
                >
                    Selanjutnya
                </button>
            </div>
        @endif
    </div>

    <!-- Modal Form (Alpine controlled with wire:model bindings) -->
    <div 
        x-show="openForm" 
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs font-sans"
        x-transition
        style="display: none;"
    >
        <div 
            @click.away="$wire.closeForm()" 
            class="bg-white rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl border border-slate-100 relative font-['Outfit'] space-y-5"
        >
            <!-- Modal Header -->
            <div class="text-left space-y-1">
                <h3 class="text-lg font-black text-slate-800">{{ $studentId ? 'Edit Data Siswa' : 'Tambah Siswa Baru' }}</h3>
                <p class="text-xs text-slate-400 font-medium">Lengkapi rincian data diri dan target tabungan siswa</p>
            </div>

            <!-- Form -->
            <form wire:submit.prevent="saveStudent" class="space-y-4 text-left font-['Plus_Jakarta_Sans']">
                <!-- NISN -->
                <div class="space-y-1.5">
                    <label for="nisn" class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">NISN (10 Digit)</label>
                    <input 
                        type="text" 
                        inputmode="numeric"
                        pattern="[0-9]*"
                        id="nisn" 
                        wire:model="nisn"
                        class="w-full px-4 py-3 rounded-2xl border border-slate-250 text-xs placeholder-slate-450 focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-slate-50/40 font-mono font-bold"
                        placeholder="Contoh: 0123456789"
                        required
                    >
                    @error('nisn') <span class="text-[10px] text-rose-500 font-bold block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Name -->
                <div class="space-y-1.5">
                    <label for="name" class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Nama Lengkap Siswa</label>
                    <input 
                        type="text" 
                        id="name" 
                        wire:model="name"
                        class="w-full px-4 py-3 rounded-2xl border border-slate-250 text-xs placeholder-slate-450 focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-slate-50/40"
                        placeholder="Nama Lengkap Siswa"
                        required
                    >
                    @error('name') <span class="text-[10px] text-rose-500 font-bold block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Class -->
                <div class="space-y-1.5" x-data="{ 
                    openSelect: false,
                    value: @entangle('class_name'),
                    options: @js($availableClasses),
                    selectOption(val) {
                        this.value = val;
                        this.openSelect = false;
                    }
                }">
                    <label class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Kelas</label>
                    <div class="relative">
                        <button 
                            type="button"
                            @click="openSelect = !openSelect"
                            class="w-full px-4 py-3 rounded-2xl border border-slate-250 text-xs font-semibold focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-slate-50/40 transition-all duration-200 text-left flex items-center justify-between cursor-pointer"
                        >
                            <span x-text="value ? 'Kelas ' + value : 'Pilih Kelas'" class="text-slate-800"></span>
                            <svg class="w-3.5 h-3.5 text-slate-450 transition-transform duration-200" :class="openSelect ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        <div 
                            x-show="openSelect" 
                            @click.away="openSelect = false"
                            x-transition
                            class="absolute left-0 right-0 mt-1.5 max-h-48 overflow-y-auto rounded-2xl bg-white shadow-xl border border-slate-150 z-50 py-1"
                            style="display: none; scrollbar-width: thin;"
                        >
                            <button type="button" @click="selectOption('')" class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-550 text-xs cursor-pointer">Pilih Kelas</button>
                            <template x-for="cls in options" :key="cls">
                                <button 
                                    type="button" 
                                    @click="selectOption(cls)" 
                                    class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-700 text-xs flex items-center justify-between cursor-pointer"
                                    :class="value === cls ? 'bg-amber-50 text-amber-900 font-bold' : ''"
                                >
                                    <span x-text="'Kelas ' + cls"></span>
                                    <svg x-show="value === cls" class="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                </button>
                            </template>
                        </div>
                    </div>
                    @error('class_name') <span class="text-[10px] text-rose-500 font-bold block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Balance -->
                <div class="space-y-1.5">
                    <label for="balance" class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Saldo Tabungan Awal (Rp)</label>
                    <input 
                        type="text" 
                        id="balance" 
                        x-model="formattedBalance"
                        @input="updateBalance($event.target.value)"
                        class="w-full px-4 py-3 rounded-2xl border border-slate-250 text-xs placeholder-slate-450 focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-slate-50/40 disabled:opacity-60 disabled:cursor-not-allowed font-bold"
                        placeholder="0"
                        required
                        @if($studentId) disabled @endif
                    >
                    @error('balance') <span class="text-[10px] text-rose-500 font-bold block mt-1">{{ $message }}</span> @enderror
                </div>
 
                <!-- Saving Target -->
                <div class="space-y-1.5">
                    <label for="saving_target" class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Target Tabungan (Rp)</label>
                    <input 
                        type="text" 
                        id="saving_target" 
                        x-model="formattedSavingTarget"
                        @input="updateSavingTarget($event.target.value)"
                        class="w-full px-4 py-3 rounded-2xl border border-slate-250 text-xs placeholder-slate-450 focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-slate-50/40 font-bold"
                        placeholder="500.000"
                        required
                    >
                    @error('saving_target') <span class="text-[10px] text-rose-500 font-bold block mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Action buttons -->
                <div class="flex items-center space-x-3 pt-3">
                    <button 
                        type="button" 
                        @click="$wire.closeForm()"
                        class="flex-1 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-extrabold rounded-2xl text-xs transition-all active:scale-[0.98] cursor-pointer"
                    >
                        Batal
                    </button>
                    <button 
                        type="submit"
                        class="flex-1 py-3 bg-amber-400 hover:bg-amber-500 text-slate-900 font-extrabold rounded-2xl text-xs transition-all active:scale-[0.98] cursor-pointer shadow-xs"
                    >
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Classroom Manager Modal -->
    <div 
        x-show="$wire.isClassroomModalOpen" 
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs font-sans"
        x-transition
        style="display: none;"
    >
        <div 
            @click.away="$wire.closeClassroomModal()" 
            class="bg-white rounded-3xl p-6 max-w-md w-full shadow-2xl border border-slate-100 relative font-['Outfit'] space-y-4 text-left"
        >
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <h3 class="text-base font-black text-slate-800">Kelola Daftar Kelas</h3>
                <button @click="$wire.closeClassroomModal()" class="text-slate-400 hover:text-slate-650 cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Flash alerts inside classroom modal -->
            @if(session()->has('class_success'))
                <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-2.5 rounded-xl text-xs font-bold animate-fadeIn">
                    {{ session('class_success') }}
                </div>
            @endif
            @if(session()->has('class_error'))
                <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-2.5 rounded-xl text-xs font-bold animate-fadeIn">
                    {{ session('class_error') }}
                </div>
            @endif

            <!-- Add class form -->
            <form wire:submit.prevent="addClassroom" class="flex gap-2">
                <div class="relative flex-1">
                    <input 
                        type="text" 
                        wire:model="newClassroomName"
                        placeholder="Ketik kelas baru (misal: 1-C)"
                        class="w-full px-4 py-2.5 border border-slate-200 rounded-2xl text-xs font-bold placeholder-slate-400 focus:outline-hidden focus:border-amber-500"
                        required
                    >
                </div>
                <button 
                    type="submit" 
                    class="px-4 py-2.5 bg-[#0c1a30] hover:bg-slate-800 text-white font-extrabold rounded-2xl text-xs transition-colors cursor-pointer active:scale-95"
                >
                    Tambah
                </button>
            </form>
            @error('newClassroomName') 
                <span class="text-[10px] text-rose-500 font-bold block mt-1">{{ $message }}</span> 
            @enderror

            <!-- Classrooms list -->
            <div class="space-y-2">
                <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Daftar Kelas Resmi</div>
                <div class="max-h-48 overflow-y-auto space-y-1.5 pr-1" style="scrollbar-width: thin;">
                    @forelse($classrooms as $cls)
                        <div class="bg-slate-50 border border-slate-100 rounded-2xl px-4 py-2.5 flex items-center justify-between shadow-3xs">
                            <span class="text-xs font-bold text-slate-800">Kelas {{ $cls->name }}</span>
                            <button 
                                type="button"
                                wire:click="deleteClassroom({{ $cls->id }})"
                                class="text-slate-400 hover:text-rose-600 transition-colors cursor-pointer"
                                title="Hapus Kelas"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        </div>
                    @empty
                        <div class="text-xs text-slate-400 italic text-center py-4">Belum ada kelas terdaftar.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Import CSV Modal (Alpine & Livewire controlled) -->
    <div 
        x-show="openImport" 
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs font-sans"
        x-transition
        style="display: none;"
    >
        <div 
            @click.away="$wire.closeImportModal()" 
            class="bg-white rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl border border-slate-100 relative font-['Outfit'] space-y-5 text-left max-h-[90vh] overflow-y-auto"
            style="scrollbar-width: thin;"
        >
            <!-- Modal Header -->
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <div class="text-left space-y-0.5">
                    <h3 class="text-lg font-black text-slate-800">Import Data Siswa (CSV)</h3>
                    <p class="text-xs text-slate-400 font-medium font-sans">Unggah daftar siswa secara massal menggunakan file template CSV</p>
                </div>
                <button @click="$wire.closeImportModal()" class="text-slate-400 hover:text-slate-650 cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Steps & Instructions -->
            <div class="bg-slate-50 border border-slate-100 rounded-2xl p-5 text-xs text-slate-750 leading-relaxed font-sans space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-slate-200/60 pb-3">
                    <div class="font-extrabold text-slate-800 uppercase tracking-wider text-[9px]">Petunjuk Import Data</div>
                    <!-- Download template button cleanly separated from list text -->
                    <button 
                        type="button"
                        wire:click="downloadTemplate" 
                        class="inline-flex items-center justify-center space-x-1.5 px-3 py-1.5 bg-[#0c1a30] hover:bg-slate-850 text-white font-extrabold rounded-xl text-[10px] cursor-pointer shadow-3xs transition-all active:scale-95 shrink-0"
                    >
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        <span>Unduh Template CSV</span>
                    </button>
                </div>
                <ul class="list-decimal pl-4.5 space-y-2.5 font-medium">
                    <li>Gunakan berkas template CSV yang diunduh di atas sebagai acuan pengisian data siswa.</li>
                    <li>Buka berkas di <strong>Excel / Google Sheets</strong>, lalu isi kolom Nama, NISN, Kelas, dan Saldo Awal. Hapus baris data contoh sebelum disimpan.</li>
                    <li>Pilih <strong>Save As -> CSV (Comma delimited / UTF-8)</strong> saat menyimpan file Excel Anda.</li>
                    <li>Pastikan kelas yang diinput **sudah terdaftar** di sistem SakuSiswa.</li>
                    <li>Sistem otomatis men-hash password orang tua menggunakan <strong>NISN</strong> siswa tersebut.</li>
                </ul>
            </div>

            <!-- Import Form -->
            <form wire:submit.prevent="importCsv" class="space-y-4 font-sans">
                <div class="space-y-1.5">
                    <label class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Pilih Berkas CSV</label>
                    <div class="relative border-2 border-dashed border-slate-200 hover:border-amber-400/80 rounded-2xl p-6 transition-colors flex flex-col items-center justify-center bg-slate-50/25">
                        <input 
                            type="file" 
                            wire:model="csvFile" 
                            accept=".csv,text/csv"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                        >
                        <div class="text-center space-y-1">
                            <svg class="w-8 h-8 text-slate-400 mx-auto" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                            </svg>
                            <div class="text-xs font-bold text-slate-700">
                                @if($csvFile)
                                    <span class="text-emerald-600">Terpilih: {{ $csvFile->getClientOriginalName() }}</span>
                                @else
                                    Tarik berkas ke sini atau <span class="text-amber-600 underline">Cari File</span>
                                @endif
                            </div>
                            <p class="text-[10px] text-slate-400 font-semibold">Hanya berkas .csv (Maksimal 2MB)</p>
                        </div>
                    </div>
                    @error('csvFile') 
                        <span class="text-[10px] text-rose-500 font-bold block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <!-- Display Errors List -->
                @if(count($importErrors) > 0)
                    <div class="bg-rose-55 border border-rose-200 text-rose-800 rounded-2xl p-4.5 text-[11px] leading-relaxed space-y-2 max-h-48 overflow-y-auto" style="scrollbar-width: thin;">
                        <div class="font-extrabold text-rose-900 uppercase tracking-wider text-[9px] flex items-center space-x-1.5">
                            <svg class="w-3.5 h-3.5 text-rose-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span>Daftar Kesalahan Data (Import Dibatalkan):</span>
                        </div>
                        <ul class="list-disc pl-4 space-y-1 font-bold">
                            @foreach($importErrors as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Modal Actions -->
                <div class="flex items-center space-x-3 pt-3 border-t border-slate-100 font-['Outfit']">
                    <button 
                        type="button" 
                        @click="$wire.closeImportModal()"
                        class="flex-1 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-extrabold rounded-2xl text-xs transition-all active:scale-[0.98] cursor-pointer"
                    >
                        Batal
                    </button>
                    <button 
                        type="submit"
                        wire:loading.attr="disabled"
                        class="flex-1 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold rounded-2xl text-xs transition-all active:scale-[0.98] cursor-pointer shadow-xs disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center space-x-1.5"
                    >
                        <span wire:loading.remove>Mulai Import</span>
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

    <!-- Floating Bulk Action Bar -->
    @if(count($selectedStudents) > 0)
        <div 
            class="fixed bottom-20 md:bottom-6 left-1/2 -translate-x-1/2 z-40 bg-[#0c1a30] text-white rounded-2xl px-5 py-3.5 shadow-2xl flex items-center space-x-5 border border-slate-800 font-['Outfit'] transition-all duration-300 ease-out flex-row text-xs shrink-0 max-w-sm sm:max-w-md w-[calc(100%-2rem)] sm:w-auto"
            x-transition
        >
            <div class="flex items-center space-x-2">
                <span class="inline-flex items-center justify-center bg-amber-400 text-slate-950 font-extrabold w-5 h-5 rounded-full text-[10px]">
                    {{ count($selectedStudents) }}
                </span>
                <span class="font-bold text-slate-350">Terpilih</span>
            </div>
            
            <div class="h-4 border-l border-slate-700"></div>

            <div class="flex items-center space-x-2">
                <!-- Deselect Button -->
                <button 
                    type="button"
                    wire:click="$set('selectedStudents', [])"
                    class="text-[10px] text-slate-400 hover:text-white font-extrabold transition-colors cursor-pointer mr-1"
                >
                    Batal
                </button>

                <!-- Bulk Delete Button -->
                <button 
                    type="button"
                    @click="
                        triggerConfirm(
                            'Hapus Massal Siswa', 
                            'Apakah Anda yakin ingin menghapus <strong>{{ count($selectedStudents) }} siswa</strong> terpilih secara permanen? <strong class=\'text-rose-600\'>Seluruh riwayat transaksi keuangan mereka akan ikut terhapus selamanya dari sistem!</strong>', 
                            () => $wire.deleteSelected(),
                            'Hapus Semua',
                            'bg-rose-500 hover:bg-rose-600 text-white'
                        )
                    "
                    class="px-3.5 py-2 bg-rose-600 hover:bg-rose-700 text-white font-extrabold rounded-xl text-[10px] transition-all cursor-pointer shadow-3xs active:scale-[0.97] flex items-center space-x-1"
                >
                    <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                    <span>Hapus</span>
                </button>
            </div>
        </div>
    @endif

    <!-- Custom Confirmation Modal (Alpine.js controlled) -->
    <div 
        x-show="confirmOpen" 
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs font-sans"
        x-transition
        style="display: none;"
    >
        <div 
            @click.away="confirmOpen = false" 
            class="bg-white rounded-3xl p-6 max-w-sm w-full shadow-2xl border border-slate-100 relative font-['Outfit'] space-y-4 text-center"
        >
            <!-- Warning / Alert Icon -->
            <div class="mx-auto w-12 h-12 rounded-full bg-rose-50 flex items-center justify-center text-rose-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>

            <!-- Content -->
            <div class="space-y-2">
                <h3 class="text-base font-black text-slate-800" x-text="confirmTitle">Konfirmasi</h3>
                <p class="text-xs text-slate-500 font-semibold leading-relaxed" x-html="confirmMessage"></p>
            </div>

            <!-- Actions -->
            <div class="flex items-center space-x-3 pt-2">
                <button 
                    type="button" 
                    @click="confirmOpen = false"
                    class="flex-1 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-extrabold rounded-2xl text-xs transition-all active:scale-[0.98] cursor-pointer"
                >
                    Batal
                </button>
                <button 
                    type="button"
                    @click="executeConfirm()"
                    class="flex-1 py-3 font-extrabold rounded-2xl text-xs transition-all active:scale-[0.98] cursor-pointer shadow-xs"
                    :class="confirmButtonClass"
                    x-text="confirmButtonText"
                >
                </button>
            </div>
        </div>
    </div>
</div>
