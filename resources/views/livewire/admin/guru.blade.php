<div class="-mx-4 -mt-4 sm:-mx-6 sm:-mt-6 md:-mx-8 md:-mt-8 p-4 sm:p-6 md:p-8 min-h-screen bg-[#ffd554] pb-24 space-y-6 font-sans relative overflow-hidden" x-data="{ 
    openForm: @entangle('isFormOpen'),
    confirmOpen: false,
    confirmTitle: '',
    confirmMessage: '',
    confirmAction: null,
    confirmButtonText: 'Hapus',
    confirmButtonClass: 'bg-rose-500 hover:bg-rose-600 text-white',
    
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
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 9999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
    
    <!-- Decorative background elements -->
    <div class="absolute top-0 right-0 w-32 h-32 opacity-10 pointer-events-none translate-x-6 -translate-y-6 z-0">
        <svg class="w-full h-full text-amber-800" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17 2c-3.87 0-7 3.13-7 7 0 2.21 1.02 4.18 2.62 5.5L12 15c-.41.34-1.07.34-1.48 0L2.3 8.3c-.63-.5-1.52-.38-2 .25-.5.63-.38 1.52.25 2l8.22 6.7c1.39 1.13 3.47 1.13 4.86 0L22 10.3c.63-.5.75-1.39.25-2-.5-.63-1.39-.75-2-.25l-2.62 2.15C17.98 9.38 17 7.41 17 5V2z"/>
        </svg>
    </div>

    <!-- Header Banner Card (Inverted Dark Slate Container with High-Contrast Badges & Illustration) -->
    <!-- Header Banner Card (Inverted Dark Slate Container - Fully Optimized Mobile & Desktop) -->
    <div class="relative overflow-hidden bg-slate-900 border border-slate-800 rounded-2xl sm:rounded-3xl p-4 sm:p-5 md:p-6 shadow-md flex items-center justify-between min-h-[120px] sm:min-h-[140px] md:min-h-[160px] relative z-10 font-['Outfit'] text-white">
        <!-- Text Left Section -->
        <div class="text-left space-y-2 sm:space-y-3 relative z-10 pr-24 sm:pr-36 md:pr-60">
            <div class="space-y-0.5 sm:space-y-1">
                <h1 class="text-lg sm:text-2xl md:text-3xl font-black text-white tracking-tight">Manajemen Guru</h1>
            </div>

            <!-- Role Badge -->
            <div class="flex flex-wrap items-center gap-1.5 sm:gap-2">
                <div class="inline-flex items-center space-x-1.5 px-2.5 py-1 sm:px-3.5 sm:py-1.5 bg-[#ffd554] text-slate-950 rounded-full text-[10px] sm:text-xs font-black shadow-xs">
                    <span>Akses Utama</span>
                    <span class="opacity-40">|</span>
                    <span>Administrator</span>
                </div>
            </div>
        </div>

        <!-- Header Illustration on the right -->
        <div class="absolute -right-3 -bottom-3 sm:-right-4 sm:-bottom-4 w-32 h-28 sm:w-48 sm:h-36 md:w-64 md:h-48 pointer-events-none z-0">
            <img src="/assets/adminlogo.png" alt="Admin Illustration" class="w-full h-full object-contain object-right-bottom scale-105">
        </div>
    </div>

    <!-- Alert Notifications (Lottie Success Modal & Golden Yellow Brand Styling) -->
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
        <div class="bg-rose-50 border border-rose-200 text-rose-800 px-6 py-4 rounded-2xl text-sm font-bold relative z-10 text-left shadow-2xs flex items-center space-x-2.5 animate-fadeIn">
            <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
            </svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Search Bar Section -->
    <div class="relative z-20 font-['Outfit']">
        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 pointer-events-none">
            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </span>
        <input 
            type="text" 
            wire:model.live="search"
            class="w-full pl-11 pr-4 py-3.5 bg-white border border-slate-100 rounded-2xl text-xs font-bold text-slate-800 focus:outline-hidden focus:border-amber-500 shadow-3xs placeholder-slate-400 transition-all duration-200"
            placeholder="Cari nama guru atau alamat email..."
        >
    </div>

    <!-- Quick Stats Cards -->
    <div class="grid grid-cols-2 gap-3 relative z-10 font-['Outfit']">
        <!-- Card Total Guru -->
        <div class="bg-gradient-to-br from-[#0c1a30] to-slate-800 text-white rounded-2xl p-3 sm:p-4 shadow-sm flex items-center space-x-3 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
            <!-- Icon -->
            <div class="w-8.5 h-8.5 rounded-xl bg-white/20 flex items-center justify-center text-white shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
            </div>
            <div class="text-left">
                <span class="text-[9px] text-white/80 font-bold uppercase tracking-wider block leading-none">Total Guru</span>
                <span class="text-xs sm:text-base font-black text-white mt-1.5 block leading-none">{{ $teachers->count() }} Orang</span>
            </div>
        </div>

        <!-- Card Kelas Terisi -->
        <div class="bg-gradient-to-br from-[#b45309] to-[#78350f] text-white rounded-2xl p-3 sm:p-4 shadow-sm flex items-center space-x-3 hover:scale-[1.02] active:scale-[0.98] transition-all duration-200">
            <!-- Icon -->
            <div class="w-8.5 h-8.5 rounded-xl bg-white/20 flex items-center justify-center text-white shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                </svg>
            </div>
            <div class="text-left">
                <span class="text-[9px] text-white/80 font-bold uppercase tracking-wider block leading-none">Kelas Terampu</span>
                <span class="text-xs sm:text-base font-black text-white mt-1.5 block leading-none">{{ $teachers->whereNotNull('class_name')->where('class_name', '!=', '')->count() }} Kelas</span>
            </div>
        </div>
    </div>

    <!-- List Section -->
    <div class="bg-white border border-slate-100 rounded-[28px] p-5 sm:p-6 shadow-xs relative z-10 space-y-4">
        <!-- Header inside Card -->
        <div class="flex items-center justify-between font-['Outfit'] pb-1">
            <h3 class="text-sm sm:text-base font-extrabold text-slate-800">Daftar Guru</h3>
            <span class="inline-flex items-center px-3 py-1 bg-amber-55 border border-amber-100 rounded-full text-[10px] font-extrabold text-amber-800 tracking-wide font-['Outfit']">
                {{ $teachers->count() }} guru
            </span>
        </div>
        
        <!-- List Container -->
        <div class="max-h-[390px] overflow-y-auto pr-1.5 space-y-3 font-sans custom-scrollbar">
            @forelse($teachers as $teacher)
                @php
                    $words = explode(' ', $teacher->name);
                    $initials = '';
                    if (count($words) >= 2) {
                        $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
                    } else {
                        $initials = strtoupper(substr($words[0], 0, 2));
                    }
                    
                    $colors = [
                        'bg-blue-50 text-blue-700 border-blue-100',
                        'bg-emerald-50 text-emerald-700 border-emerald-100',
                        'bg-purple-50 text-purple-700 border-purple-100',
                        'bg-[#fff8ee] text-amber-700 border-amber-100',
                        'bg-rose-50 text-rose-700 border-rose-100',
                        'bg-indigo-50 text-indigo-700 border-indigo-100'
                    ];
                    $colorIndex = ord(strtolower(substr($teacher->name, 0, 1))) % count($colors);
                    $avatarColor = $colors[$colorIndex];
                @endphp
                <div wire:key="teacher-{{ $teacher->id }}" class="bg-white border border-slate-100/80 rounded-2xl p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-4 hover:shadow-xs transition-all duration-300">
                    <div class="flex items-center space-x-3">
                        <!-- Teacher Profile Photo Avatar -->
                        <div class="w-10 h-10 rounded-full border border-amber-200 bg-slate-100 flex items-center justify-center shrink-0 font-['Outfit'] overflow-hidden">
                            <img src="/assets/{{ $teacher->avatar ?? 'i1.png' }}" alt="Profile" class="w-full h-full object-cover rounded-full">
                        </div>
                        <div class="text-left">
                            <h4 class="font-extrabold text-slate-800 text-sm leading-tight font-['Outfit'] sm:truncate">{{ $teacher->name }}</h4>
                            <span class="text-[10px] text-slate-450 font-semibold flex items-center mt-1 sm:truncate">
                                <svg class="w-3.5 h-3.5 text-slate-400 mr-1 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                </svg>
                                {{ $teacher->email }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between sm:justify-end sm:space-x-4 shrink-0 font-['Outfit'] border-t border-slate-50 pt-2.5 sm:border-0 sm:pt-0">
                        <!-- School, Class & Metrics Badges -->
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-1.5 sm:gap-2">
                            <!-- School Badge -->
                            <span class="inline-flex items-center px-2.5 py-1 bg-slate-100 border border-slate-200 rounded-lg text-[10px] font-extrabold text-slate-700 uppercase tracking-wide">
                                {{ $teacher->school_name ?? 'Sekolah' }}
                            </span>

                            <!-- Class Badge -->
                            @if($teacher->class_name)
                                <span class="inline-flex items-center px-2.5 py-1 bg-amber-50 border border-amber-200 rounded-lg text-[10px] font-extrabold text-amber-800 uppercase tracking-wide">
                                    Wali Kelas {{ $teacher->class_name }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 bg-slate-50 border border-slate-100 rounded-lg text-[10px] font-bold text-slate-400 tracking-wide">
                                    Belum Ada Kelas
                                </span>
                            @endif

                            <!-- Student Count & Balance Badge -->
                            <div class="flex items-center space-x-2 text-[11px] font-bold text-slate-600 pl-0.5 sm:pl-1">
                                <span class="px-2 py-0.5 bg-emerald-50 text-emerald-800 rounded-md border border-emerald-100 font-extrabold">
                                    {{ $teacher->student_count ?? 0 }} Siswa
                                </span>
                                <span class="font-extrabold text-slate-800">
                                    Rp {{ number_format($teacher->total_balance ?? 0, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Three Dots Menu -->
                        <div x-data="{ openMenu: false }" class="relative">
                            <button @click="openMenu = !openMenu" class="p-1.5 hover:bg-slate-50 rounded-full text-slate-400 hover:text-slate-600 transition-colors cursor-pointer focus:outline-hidden">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                                </svg>
                            </button>
                            <div 
                                x-show="openMenu" 
                                @click.away="openMenu = false" 
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-7 -top-1 w-32 bg-white border border-slate-200 rounded-xl shadow-md py-1.5 z-40 text-left font-semibold text-xs text-slate-700" 
                                style="display: none;"
                            >
                                <button type="button" @click="openMenu = false; $wire.openForm({{ $teacher->id }})" class="w-full text-left px-3 py-1.5 hover:bg-slate-50 transition-colors cursor-pointer font-bold">
                                    Edit
                                </button>
                                <button type="button" @click="openMenu = false; triggerConfirm('Reset Password', 'Apakah Anda yakin ingin mereset password wali kelas <strong>{{ addslashes($teacher->name) }}</strong> menjadi <strong>123456</strong>?', () => $wire.resetPassword({{ $teacher->id }}), 'Reset', 'bg-amber-500 hover:bg-amber-600 text-white')" class="w-full text-left px-3 py-1.5 hover:bg-amber-50 text-amber-700 transition-colors cursor-pointer font-bold">
                                    Reset Password
                                </button>
                                <button type="button" @click="openMenu = false; triggerConfirm('Hapus Guru', 'Apakah Anda yakin ingin menghapus wali kelas <strong>{{ addslashes($teacher->name) }}</strong> secara permanen?', () => $wire.deleteTeacher({{ $teacher->id }}))" class="w-full text-left px-3 py-1.5 hover:bg-rose-50 text-rose-600 transition-colors cursor-pointer font-bold">
                                    Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-8 text-center text-slate-400 font-semibold italic">
                    Belum ada data guru terdaftar.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modal Form (Alpine controlled with wire:model bindings) -->
    <div 
        x-show="openForm" 
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-md font-sans transition-all duration-300"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        style="display: none;"
    >
        <div 
            @click.away="$wire.closeForm()" 
            class="bg-white rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl border border-slate-100 relative font-['Outfit'] space-y-6 transform transition-all duration-300"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
        >
            <!-- Close Button -->
            <button 
                type="button" 
                @click="$wire.closeForm()"
                class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 transition-colors p-1.5 rounded-full hover:bg-slate-50 cursor-pointer"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Modal Header -->
            <div class="text-left space-y-1 pr-6">
                <h3 class="text-lg font-black text-slate-800">{{ $teacherId ? 'Edit Data Guru' : 'Tambah Guru Baru' }}</h3>
                <p class="text-xs text-slate-400 font-medium leading-relaxed">Lengkapi rincian data wali kelas dan kelas ampunannya</p>
            </div>

            <!-- Form -->
            <form wire:submit.prevent="saveTeacher" class="space-y-4 text-left font-['Outfit']">
                <!-- Name -->
                <div class="space-y-1.5">
                    <label for="name" class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Nama Lengkap</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 pointer-events-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </span>
                        <input 
                            type="text" 
                            id="name" 
                            wire:model="name"
                            class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 text-xs font-semibold placeholder-slate-400 focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-slate-50/30 transition-all duration-200"
                            placeholder="Nama Lengkap dengan Gelar"
                            required
                        >
                    </div>
                    @error('name') 
                        <span class="text-[10px] text-rose-500 font-bold flex items-center space-x-1 mt-1 animate-fadeIn">
                            <svg class="w-3.5 h-3.5 text-rose-500 mr-1 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                            <span>{{ $message }}</span>
                        </span> 
                    @enderror
                </div>

                <!-- Email -->
                <div class="space-y-1.5">
                    <label for="email" class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Alamat Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 pointer-events-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                            </svg>
                        </span>
                        <input 
                            type="email" 
                            id="email" 
                            wire:model="email"
                            class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 text-xs font-semibold placeholder-slate-400 focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-slate-50/30 transition-all duration-200"
                            placeholder="alamat@email.com"
                            required
                        >
                    </div>
                    @error('email') 
                        <span class="text-[10px] text-rose-500 font-bold flex items-center space-x-1 mt-1 animate-fadeIn">
                            <svg class="w-3.5 h-3.5 text-rose-500 mr-1 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                            <span>{{ $message }}</span>
                        </span> 
                    @enderror
                </div>

                <!-- NIP -->
                <div class="space-y-1.5">
                    <label for="nip" class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">NIP (Nomor Induk Pegawai)</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 pointer-events-none">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                            </svg>
                        </span>
                        <input 
                            type="text" 
                            id="nip" 
                            wire:model="nip"
                            class="w-full pl-11 pr-4 py-3 rounded-2xl border border-slate-200 text-xs font-semibold placeholder-slate-400 focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-slate-50/30 transition-all duration-200"
                            placeholder="Masukkan nomor NIP (opsional)"
                            maxlength="30"
                        >
                    </div>
                    @error('nip') 
                        <span class="text-[10px] text-rose-500 font-bold flex items-center space-x-1 mt-1 animate-fadeIn">
                            <svg class="w-3.5 h-3.5 text-rose-500 mr-1 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                            <span>{{ $message }}</span>
                        </span> 
                    @enderror
                </div>

                <!-- Class Assignment -->
                <div class="space-y-1.5" x-data="{ 
                    openSelect: false,
                    value: @entangle('class_name'),
                    options: @js($availableClasses),
                    selectOption(val) {
                        this.value = val;
                        this.openSelect = false;
                    }
                }">
                    <label class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Kelas Yang Diampu</label>
                    <div class="relative">
                        <button 
                            type="button"
                            @click="openSelect = !openSelect"
                            class="w-full pl-11 pr-10 py-3 rounded-2xl border border-slate-200 text-xs font-semibold focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-slate-50/30 transition-all duration-200 text-left flex items-center justify-between cursor-pointer"
                        >
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 pointer-events-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                            </span>
                            <span x-text="value ? 'Kelas ' + value : 'Pilih Kelas'" class="text-slate-800"></span>
                            <svg class="w-3.5 h-3.5 text-slate-450 transition-transform duration-200" :class="openSelect ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>

                        <div 
                            x-show="openSelect" 
                            @click.away="openSelect = false"
                            x-transition
                            class="absolute left-0 right-0 mt-1.5 max-h-48 overflow-y-auto rounded-2xl bg-white shadow-xl border border-slate-105 z-50 py-1"
                            style="display: none; scrollbar-width: thin;"
                        >
                            <button type="button" @click="selectOption('')" class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-500 text-xs cursor-pointer">Pilih Kelas</button>
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
                    @error('class_name') 
                        <span class="text-[10px] text-rose-500 font-bold flex items-center space-x-1 mt-1 animate-fadeIn">
                            <svg class="w-3.5 h-3.5 text-rose-500 mr-1 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                            </svg>
                            <span>{{ $message }}</span>
                        </span> 
                    @enderror
                </div>

                <!-- Password (Only when creating a new teacher) -->
                @if(!$teacherId)
                    <div class="space-y-1.5" x-data="{ showPassword: false }">
                        <label for="password" class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">
                            Password
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-slate-400 pointer-events-none">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                </svg>
                            </span>
                            <input 
                                :type="showPassword ? 'text' : 'password'" 
                                id="password" 
                                wire:model="password"
                                class="w-full pl-11 pr-11 py-3 rounded-2xl border border-slate-200 text-xs font-semibold placeholder-slate-400 focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-slate-50/30 transition-all duration-200"
                                placeholder="Minimal 6 karakter"
                                required
                            >
                            <!-- Show/Hide Button -->
                            <button 
                                type="button"
                                @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-650 transition-colors cursor-pointer"
                            >
                                <!-- Eye Open -->
                                <svg x-show="showPassword" class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <!-- Eye Closed -->
                                <svg x-show="!showPassword" class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                        @error('password') 
                            <span class="text-[10px] text-rose-500 font-bold flex items-center space-x-1 mt-1 animate-fadeIn">
                                <svg class="w-3.5 h-3.5 text-rose-500 mr-1 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                                </svg>
                                <span>{{ $message }}</span>
                            </span> 
                        @enderror
                    </div>
                @endif

                <!-- Action buttons -->
                <div class="flex items-center space-x-3 pt-3">
                    <button 
                        type="button" 
                        @click="$wire.closeForm()"
                        class="flex-1 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-extrabold rounded-2xl text-xs transition-all duration-200 active:scale-[0.98] cursor-pointer"
                    >
                        Batal
                    </button>
                    <button 
                        type="submit"
                        class="flex-1 py-3 bg-[#0c1a30] hover:bg-slate-800 text-white font-extrabold rounded-2xl text-xs transition-all duration-200 active:scale-[0.98] cursor-pointer shadow-md hover:shadow-lg"
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
                    class="flex-1 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-extrabold rounded-2xl text-xs transition-all duration-200 active:scale-[0.98] cursor-pointer"
                >
                    Batal
                </button>
                <button 
                    type="button"
                    @click="executeConfirm()"
                    class="flex-1 py-3 font-extrabold rounded-2xl text-xs transition-all duration-200 active:scale-[0.98] cursor-pointer shadow-md hover:shadow-lg"
                    :class="confirmButtonClass"
                    x-text="confirmButtonText"
                >
                </button>
            </div>
        </div>
    </div>
</div>
