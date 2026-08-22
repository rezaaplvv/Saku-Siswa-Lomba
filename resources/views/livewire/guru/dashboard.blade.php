<div 
    wire:poll.30s
    x-data="{ 
        openApproveModal: false, 
        openRejectModal: false, 
        selectedTxId: null, 
        selectedStudentName: '', 
        selectedAmount: '' 
    }" 
    class="-mx-4 -mt-4 sm:-mx-6 sm:-mt-6 md:-mx-8 md:-mt-8 p-4 sm:p-6 md:p-8 min-h-screen bg-[#ffd554] pb-6 space-y-6 font-sans relative overflow-hidden"
>
    
    <!-- Leaf Decoration (Top Right background - Soft amber outline) -->
    <div class="absolute top-0 right-0 w-32 h-32 opacity-10 pointer-events-none translate-x-6 -translate-y-6 z-0">
        <svg class="w-full h-full text-amber-800" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17 2c-3.87 0-7 3.13-7 7 0 2.21 1.02 4.18 2.62 5.5L12 15c-.41.34-1.07.34-1.48 0L2.3 8.3c-.63-.5-1.52-.38-2 .25-.5.63-.38 1.52.25 2l8.22 6.7c1.39 1.13 3.47 1.13 4.86 0L22 10.3c.63-.5.75-1.39.25-2-.5-.63-1.39-.75-2-.25l-2.62 2.15C17.98 9.38 17 7.41 17 5V2z"/>
        </svg>
    </div>

    <!-- Header Profil & Status Tanggal -->
    <div class="relative z-10 flex flex-row items-center justify-between font-['Outfit'] pt-2 sm:pt-3 pb-2.5 border-b border-amber-900/10 gap-2">
        <!-- Left Side: Profile & Greeting -->
        <div class="flex items-center space-x-2 sm:space-x-3">
            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-xl sm:rounded-2xl bg-slate-100 flex items-center justify-center shrink-0 border border-slate-200 shadow-sm overflow-hidden">
                <img src="/assets/{{ Auth::user()->avatar ?? 'i1.png' }}" alt="Profile" class="w-full h-full object-cover rounded-xl sm:rounded-2xl">
            </div>
            <div>
                <h2 class="text-xs sm:text-sm font-black text-[#0f172a] leading-none">Halo, {{ strtok(Auth::user()->name, ' ') }} 👋</h2>
                <span class="text-[9px] sm:text-[10px] text-slate-750 font-extrabold uppercase tracking-wider mt-0.5 sm:mt-1 block">Wali Kelas {{ $className ?? 'Belum Ditugaskan' }}</span>
            </div>
        </div>
        
        <!-- Right Side: Date & School Year Status & Logout -->
        <div class="flex flex-col items-end space-y-1 sm:flex-row sm:items-center sm:space-y-0 sm:space-x-2 text-slate-850">
            <div class="px-2 py-1 sm:px-3 sm:py-1.5 bg-white/40 border border-white/20 rounded-lg sm:rounded-xl flex items-center space-x-1 shadow-3xs text-[9px] sm:text-xs font-bold">
                <svg class="w-3 h-3 sm:w-3.5 sm:h-3.5 text-[#0f172a]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                </svg>
                <span class="hidden sm:inline">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
                <span class="inline sm:hidden">{{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMM YYYY') }}</span>
            </div>
            
            <div class="flex items-center space-x-1.5">
                <div class="px-2 py-1 sm:px-3 sm:py-1.5 bg-[#0c1a30] text-white rounded-lg sm:rounded-xl flex items-center shadow-3xs text-[9px] sm:text-xs font-extrabold tracking-wide uppercase">
                    <span class="hidden sm:inline">TA 2026/2027</span>
                    <span class="inline sm:hidden">TA 26/27</span>
                </div>
                
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="w-7 h-7 sm:w-8 sm:h-8 flex items-center justify-center bg-rose-50 border border-rose-100 hover:bg-rose-100 text-rose-600 rounded-lg sm:rounded-xl shadow-3xs cursor-pointer transition-all active:scale-[0.95]" title="Keluar">
                        <svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    @if(!$className)
        <div class="bg-rose-50 border border-rose-200 text-rose-800 px-6 py-4 rounded-2xl text-sm font-medium relative z-10">
            Akun Anda belum dikaitkan dengan kelas manapun. Silakan hubungi Administrator Sekolah untuk mengkonfigurasi wali kelas.
        </div>
    @else
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

        @if(session()->has('error'))
            <div class="bg-rose-50 border border-rose-200 text-rose-800 px-4 py-3.5 rounded-xl text-xs font-bold relative z-10">
                {{ session('error') }}
            </div>
        @endif

        @if($pendingWithdrawals->count() > 0)
            <div class="bg-amber-50 border border-amber-200 text-amber-900 p-4 rounded-3xl text-xs font-semibold leading-relaxed flex items-start space-x-3 shadow-xs relative z-10 animate-pulse">
                <div class="w-5 h-5 rounded-full bg-amber-500 flex items-center justify-center text-white shrink-0 mt-0.5">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <span class="font-extrabold text-amber-800">Antrean Penarikan:</span> Ada <span class="font-extrabold text-amber-950 underline decoration-amber-500/50">{{ $pendingWithdrawals->count() }} pengajuan penarikan</span> dari siswa yang menunggu persetujuan Anda. Silakan gulir ke bawah untuk memprosesnya.
                </div>
            </div>
        @endif

        @php
            $teacherName = Auth::user()->name;
            $teacherClass = Auth::user()->class_name ?? 'Wali Kelas';
            
            // Calculate initials
            $words = explode(' ', $teacherName);
            $initials = '';
            if (count($words) >= 2) {
                $initials = substr($words[0], 0, 1) . substr($words[1], 0, 1);
            } else {
                $initials = substr($teacherName, 0, 2);
            }
            $initials = strtoupper($initials);
        @endphp

        <!-- 2. TOTAL SALDO KELAS CARD (Navy theme with gurusaldo.png overlapping on right) -->
        <div class="relative overflow-hidden bg-slate-900 text-white rounded-3xl p-6 shadow-xl flex flex-col justify-between h-48 relative z-10" x-data="{ showBalance: true }">
            <!-- wallet asset background overlay -->
            <img src="/assets/gurusaldo.png" alt="Mascot Wallet" class="absolute -right-6 -bottom-9 w-64 h-64 md:w-72 md:h-72 object-contain pointer-events-none z-0">
            
            <div class="space-y-1 relative z-10 text-left font-['Outfit'] max-w-[55%]">
                <div class="flex items-center space-x-2 text-slate-400">
                    <span class="text-[10px] font-extrabold uppercase tracking-wider">Total Saldo Kelas</span>
                    
                    <button @click="showBalance = !showBalance" class="text-slate-450 hover:text-white transition-colors cursor-pointer focus:outline-hidden" title="Tampilkan/Sembunyikan Saldo">
                        <!-- Eye Open -->
                        <svg x-show="showBalance" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <!-- Eye Closed -->
                        <svg x-show="!showBalance" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223a10.477 10.477 0 00-2.046 3.777C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </button>
                </div>
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold tracking-tight pt-1">
                    <span x-show="showBalance">Rp {{ number_format($totalSaldoKelas, 0, ',', '.') }}</span>
                    <span x-show="!showBalance" style="display: none;">Rp ••••••••</span>
                </h2>
                <div class="relative z-10 flex items-center space-x-2 bg-white/10 backdrop-blur-xs px-2.5 py-1.5 rounded-full w-fit mt-3">
                    <div class="w-5.5 h-5.5 rounded-full bg-slate-100 border border-amber-200 flex items-center justify-center shrink-0 overflow-hidden">
                        <img src="/assets/{{ Auth::user()->avatar ?? 'i1.png' }}" alt="Profile" class="w-full h-full object-cover rounded-full">
                    </div>
                    <div class="flex items-center space-x-1.5 text-[10px] font-semibold text-slate-200">
                        <span class="truncate max-w-[90px] font-bold text-white">{{ $teacherName }}</span>
                        <span class="text-slate-500">•</span>
                        <span class="text-amber-400 font-extrabold uppercase">{{ $teacherClass }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 1. KELAS AKTIF CARD -->
        <div class="bg-gradient-to-br from-indigo-950 via-slate-900 to-indigo-950 border border-indigo-900/40 rounded-3xl p-4.5 flex items-center justify-between shadow-xs relative z-10 text-white">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-[#ffd554] via-amber-400 to-amber-500 flex items-center justify-center shrink-0 shadow-md shadow-amber-500/25 p-1 overflow-hidden">
                    <img src="/assets/school.png" alt="School Icon" class="w-full h-full object-contain scale-135 filter drop-shadow-xs">
                </div>
                <div class="text-left font-['Outfit']">
                    <span class="text-[9px] text-slate-400 font-extrabold uppercase tracking-wider block">Kelas Aktif</span>
                    <span class="text-xl font-black text-white tracking-tight block mt-0.5">{{ $className }}</span>
                </div>
            </div>
            
            <div class="h-8 w-px bg-indigo-900/60 hidden sm:block"></div>
            
            <div class="text-right font-['Outfit']">
                <span class="text-[9px] text-slate-400 font-extrabold uppercase tracking-wider block">Siswa Aktif</span>
                <span class="text-base font-black text-white tracking-tight block mt-0.5">{{ $siswaAktif }} Siswa</span>
            </div>
        </div>

        <!-- 3. TWO STAT CARDS GRID (Forced single row for Setoran & Penarikan) -->
        <div class="grid grid-cols-2 gap-3.5 md:gap-5 relative z-10">
            <!-- Setoran Hari Ini -->
            <div class="bg-gradient-to-br from-[#064e3b] via-[#022c22] to-[#064e3b] border border-emerald-900/40 rounded-3xl p-4 md:p-5 shadow-xs text-left flex flex-col justify-between h-30 md:h-36 text-white">
                <div class="w-8.5 h-8.5 md:w-10 md:h-10 rounded-xl bg-gradient-to-br from-emerald-400 via-teal-500 to-emerald-600 flex items-center justify-center text-white shrink-0 shadow-md shadow-emerald-500/20">
                    <svg class="w-4.5 h-4.5 md:w-5.5 md:h-5.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
                    </svg>
                </div>
                <div class="font-['Outfit'] mt-2">
                    <span class="text-[9px] md:text-[10px] text-slate-350 font-extrabold uppercase tracking-wider block">Setoran Hari Ini</span>
                    <span class="text-sm md:text-lg font-black text-white tracking-tight block mt-0.5 truncate">
                        Rp {{ number_format($setoranHariIni, 0, ',', '.') }}
                    </span>
                    <span class="hidden md:block text-[9px] text-emerald-400/80 font-bold mt-1">Total setoran masuk hari ini</span>
                </div>
            </div>

            <!-- Penarikan Hari Ini -->
            <div class="bg-gradient-to-br from-[#881337] via-[#4c0519] to-[#881337] border border-rose-900/40 rounded-3xl p-4 md:p-5 shadow-xs text-left flex flex-col justify-between h-30 md:h-36 text-white">
                <div class="w-8.5 h-8.5 md:w-10 md:h-10 rounded-xl bg-gradient-to-br from-rose-400 via-red-500 to-pink-500 flex items-center justify-center text-white shrink-0 shadow-md shadow-rose-500/20">
                    <svg class="w-4.5 h-4.5 md:w-5.5 md:h-5.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" />
                    </svg>
                </div>
                <div class="font-['Outfit'] mt-2">
                    <span class="text-[9px] md:text-[10px] text-slate-350 font-extrabold uppercase tracking-wider block">Penarikan Hari Ini</span>
                    <span class="text-sm md:text-lg font-black text-white tracking-tight block mt-0.5 truncate">
                        Rp {{ number_format($penarikanHariIni, 0, ',', '.') }}
                    </span>
                    <span class="hidden md:block text-[9px] text-rose-400/80 font-bold mt-1">Total penarikan sukses hari ini</span>
                </div>
            </div>
        </div>

        <!-- 3.5. STATISTIK TREN TABUNGAN (Option 3 - Charting) -->
        <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-xs relative z-10 text-left space-y-5">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 font-['Outfit']">
                <div>
                    <h2 class="text-base font-extrabold text-slate-800 tracking-tight">Statistik Tren Tabungan</h2>
                    <p class="text-[10px] text-slate-400 font-semibold mt-0.5">Perbandingan setoran masuk dan penarikan keluar kelas selama 7 hari terakhir</p>
                </div>
                <!-- Legend indicators -->
                <div class="flex items-center space-x-3.5 text-[9px] font-extrabold uppercase tracking-wider self-start sm:self-center">
                    <div class="flex items-center space-x-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 block"></span>
                        <span class="text-slate-500">Setoran</span>
                    </div>
                    <div class="flex items-center space-x-1.5">
                        <span class="w-2.5 h-2.5 rounded-full bg-rose-500 block"></span>
                        <span class="text-slate-500">Penarikan</span>
                    </div>
                </div>
            </div>

            <!-- The Chart grid -->
            <div class="flex h-56 w-full font-['Outfit'] pt-4 select-none">
                <!-- Y-Axis Labels (Left) -->
                <div class="w-14 sm:w-16 h-40 flex flex-col justify-between text-right text-[8px] sm:text-[9px] font-extrabold text-slate-400 pr-2.5 pb-1 self-start shrink-0">
                    <span>Rp {{ number_format($maxChartVal, 0, ',', '.') }}</span>
                    <span>Rp {{ number_format($maxChartVal * 0.66, 0, ',', '.') }}</span>
                    <span>Rp {{ number_format($maxChartVal * 0.33, 0, ',', '.') }}</span>
                    <span>Rp 0</span>
                </div>

                <!-- Chart Area (Right) -->
                <div class="flex-1 relative h-40">
                    <!-- Grid Lines -->
                    <div class="absolute inset-x-0 top-0 bottom-0 flex flex-col justify-between pointer-events-none z-0">
                        <div class="border-b border-dashed border-slate-100 w-full h-0"></div>
                        <div class="border-b border-dashed border-slate-100 w-full h-0"></div>
                        <div class="border-b border-dashed border-slate-100 w-full h-0"></div>
                        <div class="border-b border-slate-200 w-full h-0"></div>
                    </div>
                    
                    <!-- Bars overlay -->
                    <div class="absolute inset-0 flex items-end justify-between px-1 sm:px-4 z-10">
                        @foreach($chartData as $day)
                            @php
                                $depHeight = ($day['deposit'] / $maxChartVal) * 100;
                                $witHeight = ($day['withdrawal'] / $maxChartVal) * 100;
                            @endphp
                            <div class="flex flex-col items-center flex-1 h-full justify-end relative">
                                <!-- Bar Pair Container -->
                                <div class="flex items-end space-x-1 sm:space-x-1.5 h-full relative pb-1 justify-center">
                                    <!-- Deposit Bar (Green Gradient) -->
                                    @if($day['deposit'] > 0)
                                        <div 
                                            class="w-2.5 sm:w-4.5 bg-gradient-to-t from-emerald-500 to-emerald-350 rounded-t-xs relative group cursor-pointer transition-all duration-300 hover:opacity-90 shadow-3xs"
                                            style="height: {{ max($depHeight, 4) }}%"
                                        >
                                            <!-- Custom CSS Tooltip -->
                                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-1.5 hidden group-hover:block bg-slate-900 text-white text-[9px] font-bold px-2.5 py-1 rounded-lg shadow-md whitespace-nowrap z-30 pointer-events-none">
                                                Setor: Rp {{ number_format($day['deposit'], 0, ',', '.') }}
                                            </div>
                                        </div>
                                    @endif

                                    <!-- Withdrawal Bar (Rose Gradient) -->
                                    @if($day['withdrawal'] > 0)
                                        <div 
                                            class="w-2.5 sm:w-4.5 bg-gradient-to-t from-rose-500 to-rose-350 rounded-t-xs relative group cursor-pointer transition-all duration-300 hover:opacity-90 shadow-3xs"
                                            style="height: {{ max($witHeight, 4) }}%"
                                        >
                                            <!-- Custom CSS Tooltip -->
                                            <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-1.5 hidden group-hover:block bg-slate-900 text-white text-[9px] font-bold px-2.5 py-1 rounded-lg shadow-md whitespace-nowrap z-30 pointer-events-none">
                                                Tarik: Rp {{ number_format($day['withdrawal'], 0, ',', '.') }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <!-- Day Label below the bar container -->
                                <span class="text-[8px] sm:text-[9px] text-slate-400 font-extrabold tracking-tight whitespace-nowrap absolute top-[102%] left-1/2 transform -translate-x-1/2 mt-1">{{ $day['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. ANTREAN PERSETUJUAN PENARIKAN -->
        <div class="bg-white border border-gray-100 rounded-2xl shadow-xs overflow-hidden relative z-10">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between font-['Outfit']">
                <div class="text-left">
                    <h2 class="text-base font-extrabold text-slate-800 tracking-tight">Antrean Persetujuan Penarikan</h2>
                    <p class="text-[10px] text-slate-400 font-medium mt-0.5">Pengajuan penarikan saldo oleh orang tua yang menunggu persetujuan Anda</p>
                </div>
                <span class="bg-amber-50 text-amber-800 border border-amber-100 text-[10px] font-extrabold px-3 py-1 rounded-full">
                    {{ $pendingWithdrawals->count() }} Antrean
                </span>
            </div>

            <!-- Scrollable list wrapper: displays 2 items and scrolls if there are more -->
            <div 
                class="divide-y divide-gray-100 overflow-y-auto max-h-[340px] md:max-h-[170px]"
                style="scrollbar-width: thin; scrollbar-color: rgba(217, 119, 6, 0.25) transparent;"
            >
                @forelse($pendingWithdrawals as $withdrawal)
                    @php
                        $words = explode(' ', $withdrawal->student->name);
                        $initials = count($words) >= 2 
                            ? substr($words[0], 0, 1) . substr($words[1], 0, 1) 
                            : substr($withdrawal->student->name, 0, 2);
                        $initials = strtoupper($initials);
                    @endphp
                    <!-- Desktop View: Flat Row (Visible only on md screens and above) -->
                    <div class="hidden md:flex p-5 items-center justify-between hover:bg-slate-50/40 transition-colors duration-150 text-xs border-b border-gray-100 last:border-b-0">
                        <div class="flex items-center space-x-3.5">
                            <!-- Student profile photo avatar -->
                            <div class="w-11 h-11 rounded-full bg-slate-100 border border-amber-200 flex items-center justify-center shrink-0 font-['Outfit'] overflow-hidden">
                                <img src="/assets/{{ $withdrawal->student->avatar ?? 'i1.png' }}" alt="Profile" class="w-full h-full object-cover rounded-full">
                            </div>
                            <div class="text-left">
                                <div class="font-bold text-slate-800">{{ $withdrawal->student->name }}</div>
                                <div class="text-[10px] text-slate-400 font-semibold mt-0.5">NISN: {{ $withdrawal->student->nisn }}</div>
                            </div>
                        </div>

                        <div class="text-left text-slate-500">
                            <div class="font-semibold text-[11px]">{{ $withdrawal->created_at->format('d M Y') }}</div>
                            <div class="text-[9px] text-slate-400 font-medium mt-0.5">{{ $withdrawal->created_at->format('H:i') }} WIB</div>
                        </div>

                        <div class="text-right font-['Outfit']">
                            <div class="font-extrabold text-rose-600">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</div>
                            <div class="text-[9px] text-slate-400 font-bold mt-0.5 italic max-w-[200px] break-words">{{ $withdrawal->notes ?? 'Keperluan sekolah' }}</div>
                        </div>

                        <!-- Actions trigger with Popup Modals -->
                        <div class="ml-4 flex items-center space-x-2 shrink-0">
                            <!-- Approve button -->
                            <button 
                                @click="selectedTxId = {{ $withdrawal->id }}; selectedStudentName = '{{ addslashes($withdrawal->student->name) }}'; selectedAmount = '{{ number_format($withdrawal->amount, 0, ',', '.') }}'; openApproveModal = true" 
                                class="px-3.5 py-1.5 bg-emerald-500 hover:bg-emerald-600 text-white font-extrabold rounded-lg transition-all active:scale-[0.98] cursor-pointer"
                            >
                                Setujui
                            </button>

                            <!-- Reject button -->
                            <button 
                                @click="selectedTxId = {{ $withdrawal->id }}; selectedStudentName = '{{ addslashes($withdrawal->student->name) }}'; selectedAmount = '{{ number_format($withdrawal->amount, 0, ',', '.') }}'; openRejectModal = true" 
                                class="px-3.5 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-600 font-extrabold rounded-lg transition-all active:scale-[0.98] cursor-pointer"
                            >
                                Tolak
                            </button>
                        </div>
                    </div>

                    <!-- Mobile View: Stacked Card (Visible only on screens below md) -->
                    <div class="block md:hidden p-5 space-y-4 hover:bg-slate-50/40 transition-colors duration-150 border-b border-gray-100 last:border-b-0">
                        <!-- Top Row: Student profile, name/nisn, and amount -->
                        <div class="flex items-start justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-slate-100 border border-amber-200 flex items-center justify-center shrink-0 overflow-hidden font-['Outfit']">
                                    <img src="/assets/{{ $withdrawal->student->avatar ?? 'i1.png' }}" alt="Profile" class="w-full h-full object-cover rounded-full">
                                </div>
                                <div class="text-left">
                                    <div class="font-bold text-slate-800 text-xs">{{ $withdrawal->student->name }}</div>
                                    <div class="text-[9px] text-slate-400 font-semibold mt-0.5">NISN: {{ $withdrawal->student->nisn }}</div>
                                </div>
                            </div>
                            <!-- Amount red text -->
                            <div class="text-right font-['Outfit']">
                                <div class="font-extrabold text-rose-600 text-sm">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</div>
                            </div>
                        </div>

                        <!-- Middle Row: Date/Time and Notes (Alasan) -->
                        <div class="bg-slate-50/70 p-3 rounded-xl space-y-2 text-left text-[10px] text-slate-500 font-semibold">
                            <div class="flex items-center justify-between">
                                <span class="text-slate-400 font-bold uppercase tracking-wider">Tanggal Pengajuan</span>
                                <span>{{ $withdrawal->created_at->format('d M Y, H:i') }} WIB</span>
                            </div>
                            <div class="border-t border-slate-200/50 pt-2 flex flex-col space-y-1">
                                <span class="text-slate-400 font-bold uppercase tracking-wider">Catatan Alasan</span>
                                <span class="italic text-slate-600 break-words pl-2 border-l-2 border-slate-200 text-[11px] leading-relaxed">{{ $withdrawal->notes ?? 'Keperluan sekolah' }}</span>
                            </div>
                        </div>

                        <!-- Bottom Row: Big Actions buttons -->
                        <div class="flex items-center space-x-3 pt-1">
                            <!-- Approve Action -->
                            <div class="flex-1">
                                <button 
                                    @click="selectedTxId = {{ $withdrawal->id }}; selectedStudentName = '{{ addslashes($withdrawal->student->name) }}'; selectedAmount = '{{ number_format($withdrawal->amount, 0, ',', '.') }}'; openApproveModal = true" 
                                    class="w-full py-2 bg-emerald-500 hover:bg-emerald-600 text-white font-extrabold rounded-xl transition-all active:scale-[0.98] cursor-pointer text-center text-xs"
                                >
                                    Setujui
                                </button>
                            </div>

                            <!-- Reject Action -->
                            <div class="flex-1">
                                <button 
                                    @click="selectedTxId = {{ $withdrawal->id }}; selectedStudentName = '{{ addslashes($withdrawal->student->name) }}'; selectedAmount = '{{ number_format($withdrawal->amount, 0, ',', '.') }}'; openRejectModal = true" 
                                    class="w-full py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-extrabold rounded-xl transition-all active:scale-[0.98] cursor-pointer text-center text-xs"
                                >
                                    Tolak
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-slate-400 font-medium italic">
                        Tidak ada antrean pengajuan penarikan saat ini.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- 5. AKTIVITAS TERAKHIR KELAS -->
        <div class="bg-white border border-gray-100 rounded-2xl shadow-xs overflow-hidden relative z-10">
            <div class="p-6 border-b border-gray-100 flex items-center justify-between font-['Outfit']">
                <div class="text-left">
                    <h2 class="text-base font-extrabold text-slate-800 tracking-tight">Aktivitas Terakhir Kelas</h2>
                    <p class="text-[10px] text-slate-400 font-medium mt-0.5">Daftar transaksi sukses terbaru yang diproses oleh siswa di kelas Anda</p>
                </div>
                <a href="/guru/riwayat" wire:navigate class="px-3 py-1.5 bg-white border border-slate-100 hover:bg-slate-55 text-slate-700 text-xs font-bold rounded-xl flex items-center space-x-1 transition-all duration-200 cursor-pointer">
                    <span>Lihat Semua</span>
                    <svg class="w-3 h-3 text-amber-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </a>
            </div>

            <!-- Scrollable list wrapper: displays 3 items and scrolls if there are more -->
            <div 
                class="divide-y divide-gray-100 overflow-y-auto max-h-[220px]"
                style="scrollbar-width: thin; scrollbar-color: rgba(217, 119, 6, 0.25) transparent;"
            >
                @forelse($recentActivities as $activity)
                    <div class="p-5 flex items-center justify-between hover:bg-slate-50/40 transition-colors duration-150 text-xs">
                        <div class="flex items-center space-x-3.5">
                            <!-- type direction arrow icon -->
                            @if($activity->type === 'deposit')
                                <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 border border-emerald-100/50">
                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
                                    </svg>
                                </div>
                            @else
                                <div class="w-8 h-8 rounded-lg bg-rose-50 text-rose-600 flex items-center justify-center shrink-0 border border-rose-100/50">
                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" />
                                    </svg>
                                </div>
                            @endif

                            <!-- Student profile photo avatar -->
                            <div class="w-9 h-9 rounded-full bg-slate-100 border border-amber-200 flex items-center justify-center overflow-hidden shrink-0 font-['Outfit']">
                                <img src="/assets/{{ $activity->student->avatar ?? 'i1.png' }}" alt="Profile" class="w-full h-full object-cover rounded-full">
                            </div>

                            <div class="text-left font-['Outfit']">
                                <div class="font-bold text-slate-800">{{ $activity->student->name }}</div>
                                <div class="text-[10px] text-slate-400 font-semibold mt-0.5 capitalize">{{ $activity->type === 'deposit' ? 'Setoran' : 'Penarikan' }}</div>
                            </div>
                        </div>

                        <div class="hidden sm:block text-left text-slate-500 font-semibold">
                            <div>{{ $activity->created_at->format('d M Y') }}</div>
                            <div class="text-[9px] text-slate-400 font-medium mt-0.5">{{ $activity->created_at->format('H:i') }} WIB</div>
                        </div>

                        <div class="text-right font-['Outfit']">
                            <div class="font-extrabold {{ $activity->type === 'deposit' ? 'text-emerald-600' : 'text-rose-600' }}">
                                {{ $activity->type === 'deposit' ? '+' : '-' }} Rp {{ number_format($activity->amount, 0, ',', '.') }}
                            </div>
                            <span class="inline-flex px-2 py-0.5 mt-1 rounded-full text-[8px] font-extrabold tracking-wider bg-emerald-50 text-emerald-700 uppercase">
                                Berhasil
                            </span>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-slate-400 font-medium italic">
                        Belum ada riwayat transaksi terdaftar untuk kelas ini.
                    </div>
                @endforelse
            </div>
        </div>
    @endif

    <!-- Modal Konfirmasi Persetujuan Penarikan -->
    <div 
        x-show="openApproveModal" 
        class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center z-50 p-4" 
        style="display: none;"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
    >
        <div class="bg-white rounded-3xl p-6 shadow-xl max-w-sm w-full border border-slate-100 relative space-y-4 font-sans" @click.away="openApproveModal = false">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-extrabold text-slate-800 tracking-tight font-['Outfit']">Konfirmasi Persetujuan</h3>
                <button @click="openApproveModal = false" class="text-slate-400 hover:text-slate-600 focus:outline-hidden cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="text-xs text-slate-500 font-medium text-left leading-relaxed">
                Apakah Anda yakin ingin menyetujui pengajuan penarikan tabungan berikut?
            </div>

            <div class="bg-amber-50/50 border border-amber-100 p-3.5 rounded-2xl space-y-2 text-left font-['Outfit']">
                <div>
                    <span class="text-[9px] text-amber-800/80 font-bold uppercase tracking-wider block">Siswa</span>
                    <span class="text-xs font-bold text-slate-800 block mt-0.5" x-text="selectedStudentName"></span>
                </div>
                <div class="border-t border-amber-200/30 pt-2">
                    <span class="text-[9px] text-amber-800/80 font-bold uppercase tracking-wider block">Nominal Penarikan</span>
                    <span class="text-base font-extrabold text-rose-600 block mt-0.5">Rp <span x-text="selectedAmount"></span></span>
                </div>
            </div>

            <div class="flex items-center space-x-3 pt-2">
                <button 
                    @click="openApproveModal = false" 
                    class="flex-1 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-all active:scale-[0.98] cursor-pointer text-xs"
                >
                    Batal
                </button>
                <button 
                    @click="$wire.setujuiPenarikan(selectedTxId); openApproveModal = false"
                    class="flex-1 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white font-bold rounded-xl transition-all active:scale-[0.98] cursor-pointer text-xs shadow-xs"
                >
                    Ya, Setujui
                </button>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Penolakan Penarikan -->
    <div 
        x-show="openRejectModal" 
        class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs flex items-center justify-center z-50 p-4" 
        style="display: none;"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
    >
        <div class="bg-white rounded-3xl p-6 shadow-xl max-w-sm w-full border border-slate-100 relative space-y-4 font-sans" @click.away="openRejectModal = false">
            <div class="flex items-center justify-between">
                <h3 class="text-sm font-extrabold text-slate-800 tracking-tight font-['Outfit']">Konfirmasi Penolakan</h3>
                <button @click="openRejectModal = false" class="text-slate-400 hover:text-slate-600 focus:outline-hidden cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="text-xs text-slate-500 font-medium text-left leading-relaxed">
                Apakah Anda yakin ingin menolak pengajuan penarikan tabungan berikut?
            </div>

            <div class="bg-rose-50/30 border border-rose-100 p-3.5 rounded-2xl space-y-2 text-left font-['Outfit']">
                <div>
                    <span class="text-[9px] text-rose-800/80 font-bold uppercase tracking-wider block">Siswa</span>
                    <span class="text-xs font-bold text-slate-800 block mt-0.5" x-text="selectedStudentName"></span>
                </div>
                <div class="border-t border-rose-200/30 pt-2">
                    <span class="text-[9px] text-rose-800/80 font-bold uppercase tracking-wider block">Nominal Penarikan</span>
                    <span class="text-base font-extrabold text-slate-700 block mt-0.5">Rp <span x-text="selectedAmount"></span></span>
                </div>
            </div>

            <div class="flex items-center space-x-3 pt-2">
                <button 
                    @click="openRejectModal = false" 
                    class="flex-1 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-all active:scale-[0.98] cursor-pointer text-xs"
                >
                    Batal
                </button>
                <button 
                    @click="$wire.tolakPenarikan(selectedTxId); openRejectModal = false"
                    class="flex-1 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-xl transition-all active:scale-[0.98] cursor-pointer text-xs shadow-xs"
                >
                    Ya, Tolak
                </button>
            </div>
        </div>
    </div>
</div>
