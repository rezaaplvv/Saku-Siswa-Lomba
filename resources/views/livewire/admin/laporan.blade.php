<div class="-mx-4 -mt-4 sm:-mx-6 sm:-mt-6 md:-mx-8 md:-mt-8 p-4 sm:p-6 md:p-8 min-h-screen bg-[#ffd554] pb-24 space-y-5.5 font-sans relative overflow-hidden">
    
    <!-- Print-only Stylesheet -->
    <style>
        @media print {
            @page {
                margin: 0;
            }
            /* Hide non-printable elements */
            aside, header, nav, button, .no-print, .absolute, .z-0, .z-20 {
                display: none !important;
            }
            /* Reset body background with physical page padding */
            body, .min-h-screen, .bg-\[\#ffd554\] {
                background: white !important;
                color: black !important;
                padding: 1.5cm !important;
                margin: 0 !important;
            }
            /* Print layout wrapper */
            .print-container {
                display: block !important;
                padding: 0 !important;
                font-family: 'Plus Jakarta Sans', sans-serif !important;
            }
            .print-header {
                text-align: center;
                margin-bottom: 20px;
                border-bottom: 3px double #000;
                padding-bottom: 10px;
            }
            .print-table {
                width: 100% !important;
                border-collapse: collapse !important;
                margin-top: 15px;
                font-size: 11px !important;
            }
            .print-table th, .print-table td {
                border: 1px solid #000 !important;
                padding: 6px 8px !important;
                text-align: left !important;
            }
            .print-table th {
                background-color: #f1f5f9 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .print-summary {
                margin-top: 20px;
                float: right;
                width: 250px;
                border: 1px solid #000;
                padding: 10px;
            }
            .print-summary table {
                width: 100%;
                font-size: 11px;
            }
            .print-signatures {
                margin-top: 50px;
                display: flex;
                justify-content: space-between;
                font-size: 11px;
            }
        }
        .print-only {
            display: none;
        }
    </style>

    <!-- Decorative background elements -->
    <div class="absolute top-0 right-0 w-32 h-32 opacity-10 pointer-events-none translate-x-6 -translate-y-6 z-0 no-print">
        <svg class="w-full h-full text-amber-800" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17 2c-3.87 0-7 3.13-7 7 0 2.21 1.02 4.18 2.62 5.5L12 15c-.41.34-1.07.34-1.48 0L2.3 8.3c-.63-.5-1.52-.38-2 .25-.5.63-.38 1.52.25 2l8.22 6.7c1.39 1.13 3.47 1.13 4.86 0L22 10.3c.63-.5.75-1.39.25-2-.5-.63-1.39-.75-2-.25l-2.62 2.15C17.98 9.38 17 7.41 17 5V2z"/>
        </svg>
    </div>

    <!-- Header Welcome/Banner Area -->
    <div class="relative flex items-center justify-between min-h-[140px] z-10 font-['Outfit'] pt-4 pb-2 no-print">
        <!-- Info Left Section -->
        <div class="text-left space-y-3.5 relative z-10 pr-32 sm:pr-48 md:pr-64">
            <div class="space-y-1.5">
                <h1 class="text-2xl md:text-3xl font-black text-[#0f172a] tracking-tight max-w-[200px] sm:max-w-none">Laporan Keuangan Global</h1>
                <p class="hidden md:block text-xs md:text-sm text-slate-750 font-bold leading-relaxed max-w-xs md:max-w-lg">Rekapitulasi setoran dan penarikan tabungan siswa serta ekspor data laporan</p>
            </div>
            
            <div class="inline-flex items-center space-x-2.5 px-4.5 py-2.5 bg-[#fff8e5] border border-amber-200/20 rounded-full text-[11px] font-black shadow-3xs">
                <span class="text-amber-800 uppercase tracking-wider">Akses Utama</span>
                <span class="text-slate-400">|</span>
                <span class="text-slate-900">Laporan</span>
            </div>
        </div>

        <!-- Header Illustration on the right (centered vertically) -->
        <div class="absolute -right-4 top-1/2 -translate-y-1/2 w-44 h-32 sm:w-60 sm:h-44 md:w-72 md:h-48 pointer-events-none z-0">
            <img src="/assets/headerguru.png" alt="Header Illustration" class="w-full h-full object-contain object-right-center scale-105">
        </div>
    </div>

    <!-- Active Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3.5 md:gap-4 relative z-10 no-print font-['Outfit']">
        <!-- 1. Total Setoran Card -->
        <div class="bg-gradient-to-br from-emerald-900 via-teal-900 to-emerald-950 text-white rounded-3xl p-4.5 sm:p-5 shadow-md relative overflow-hidden border border-emerald-700/30 flex items-center justify-between min-h-[110px]">
            <div class="space-y-1 relative z-10">
                <span class="text-[9px] sm:text-[10px] text-white/90 font-extrabold uppercase tracking-wider block">Total Setoran</span>
                <span class="text-base sm:text-xl font-black text-white block">Rp {{ number_format($totalSetoran, 0, ',', '.') }}</span>
                <span class="text-[9px] text-white/80 font-semibold block">Total akumulasi dana masuk</span>
            </div>
            <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl bg-white/10 backdrop-blur-xs border border-white/15 flex items-center justify-center text-white shrink-0 relative z-10">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
                </svg>
            </div>
        </div>

        <!-- 2. Total Penarikan Card -->
        <div class="bg-gradient-to-br from-rose-900 via-rose-950 to-pink-950 text-white rounded-3xl p-4.5 sm:p-5 shadow-md relative overflow-hidden border border-rose-700/30 flex items-center justify-between min-h-[110px]">
            <div class="space-y-1 relative z-10">
                <span class="text-[9px] sm:text-[10px] text-white/90 font-extrabold uppercase tracking-wider block">Total Penarikan</span>
                <span class="text-base sm:text-xl font-black text-white block">Rp {{ number_format($totalPenarikan, 0, ',', '.') }}</span>
                <span class="text-[9px] text-white/80 font-semibold block">Total akumulasi dana ditarik</span>
            </div>
            <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl bg-white/10 backdrop-blur-xs border border-white/15 flex items-center justify-center text-white shrink-0 relative z-10">
                <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" />
                </svg>
            </div>
        </div>

        <!-- 3. Saldo Bersih Card (Dark Metal Card with wallet.png) -->
        <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-slate-950 text-white rounded-3xl p-4.5 sm:p-5 shadow-md relative overflow-hidden border border-slate-700/30 flex items-center justify-between min-h-[110px]">
            <div class="space-y-1 relative z-10">
                <span class="text-[9px] sm:text-[10px] text-white/90 font-extrabold uppercase tracking-wider block">Saldo Bersih</span>
                <span class="text-base sm:text-xl font-black text-white block">Rp {{ number_format($saldoBersih, 0, ',', '.') }}</span>
                <span class="text-[9px] text-white/80 font-semibold block">Selisih arus kas aktif</span>
            </div>
            <div class="w-10 h-10 sm:w-11 sm:h-11 shrink-0 relative z-10">
                <img src="/assets/walletyellow.png" alt="Wallet Icon" class="w-full h-full object-contain filter drop-shadow-md">
            </div>
        </div>
    </div>

    <!-- Filter Configuration Card -->
    <div class="bg-white border border-slate-100 rounded-3xl p-5 shadow-xs relative z-20 space-y-4 font-['Outfit'] no-print">
        <div class="flex items-center space-x-2 text-slate-800">
            <svg class="w-4.5 h-4.5 text-slate-700" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
            </svg>
            <h3 class="text-xs sm:text-sm font-black uppercase tracking-wider">Konfigurasi Laporan</h3>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3.5">
            <!-- 1. Filter Per Sekolah -->
            <div class="space-y-1.5" x-data="{ openSchool: false }">
                <label class="text-[10px] font-extrabold uppercase text-slate-400 tracking-wider">Sekolah</label>
                <button 
                    @click="openSchool = !openSchool"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200/80 rounded-2xl flex items-center justify-between text-xs font-bold text-slate-750 cursor-pointer transition-all active:scale-[0.98]"
                >
                    <span class="truncate">{{ $schoolFilter === 'all' ? 'Semua Sekolah' : $schoolFilter }}</span>
                    <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" :class="openSchool ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div 
                    x-show="openSchool" 
                    @click.away="openSchool = false"
                    x-transition
                    class="absolute mt-1.5 w-60 max-h-48 overflow-y-auto rounded-2xl bg-white shadow-lg border border-slate-100 z-50 py-1"
                    style="display: none; scrollbar-width: thin;"
                >
                    <button wire:click="$set('schoolFilter', 'all')" @click="openSchool = false" class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-700 text-xs {{ $schoolFilter === 'all' ? 'bg-amber-50 text-amber-900 font-bold' : '' }} cursor-pointer">Semua Sekolah</button>
                    @foreach($availableSchools as $sch)
                        <button wire:click="$set('schoolFilter', '{{ $sch }}')" @click="openSchool = false" class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-700 text-xs {{ $schoolFilter === $sch ? 'bg-amber-50 text-amber-900 font-bold' : '' }} cursor-pointer">{{ $sch }}</button>
                    @endforeach
                </div>
            </div>

            <!-- 2. Jenis Transaksi -->
            <div class="space-y-1.5" x-data="{ openType: false }">
                <label class="text-[10px] font-extrabold uppercase text-slate-400 tracking-wider">Jenis Transaksi</label>
                <button 
                    @click="openType = !openType"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200/80 rounded-2xl flex items-center justify-between text-xs font-bold text-slate-750 cursor-pointer transition-all active:scale-[0.98]"
                >
                    <span>
                        @if($typeFilter === 'all') Semua Transaksi
                        @elseif($typeFilter === 'deposit') Setor Tunai
                        @else Penarikan
                        @endif
                    </span>
                    <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" :class="openType ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div 
                    x-show="openType" 
                    @click.away="openType = false"
                    x-transition
                    class="absolute mt-1.5 w-52 rounded-2xl bg-white shadow-lg border border-slate-100 z-50 py-1"
                    style="display: none;"
                >
                    <button wire:click="$set('typeFilter', 'all')" @click="openType = false" class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-700 text-xs {{ $typeFilter === 'all' ? 'bg-amber-50 text-amber-900 font-bold' : '' }} cursor-pointer">Semua Transaksi</button>
                    <button wire:click="$set('typeFilter', 'deposit')" @click="openType = false" class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-700 text-xs {{ $typeFilter === 'deposit' ? 'bg-amber-50 text-amber-900 font-bold' : '' }} cursor-pointer">Setor Tunai</button>
                    <button wire:click="$set('typeFilter', 'withdrawal')" @click="openType = false" class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-700 text-xs {{ $typeFilter === 'withdrawal' ? 'bg-amber-50 text-amber-900 font-bold' : '' }} cursor-pointer">Penarikan</button>
                </div>
            </div>

            <!-- 3. Preset Waktu Cepat -->
            <div class="space-y-1.5" x-data="{ openPresets: false }">
                <label class="text-[10px] font-extrabold uppercase text-slate-400 tracking-wider">Pilihan Rentang Waktu</label>
                <button 
                    @click="openPresets = !openPresets"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200/80 rounded-2xl flex items-center justify-between text-xs font-bold text-slate-750 cursor-pointer transition-all active:scale-[0.98]"
                >
                    <span class="truncate">
                        @if(!$startDate && !$endDate) Semua Waktu
                        @elseif($startDate === today()->toDateString() && $endDate === today()->toDateString()) Hari Ini
                        @elseif($startDate === now()->subDays(6)->toDateString()) 7 Hari Terakhir
                        @elseif($startDate === now()->startOfMonth()->toDateString()) Bulan Ini
                        @else Kustom Tanggal
                        @endif
                    </span>
                    <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" :class="openPresets ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div 
                    x-show="openPresets" 
                    @click.away="openPresets = false"
                    x-transition
                    class="absolute mt-1.5 w-52 rounded-2xl bg-white shadow-lg border border-slate-100 z-50 py-1"
                    style="display: none;"
                >
                    <button wire:click="setDateRangePreset('all')" @click="openPresets = false" class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-700 text-xs {{ (!$startDate && !$endDate) ? 'bg-amber-50 text-amber-900 font-bold' : '' }} cursor-pointer">Semua Waktu</button>
                    <button wire:click="setDateRangePreset('today')" @click="openPresets = false" class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-700 text-xs cursor-pointer">Hari Ini</button>
                    <button wire:click="setDateRangePreset('7days')" @click="openPresets = false" class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-700 text-xs cursor-pointer">7 Hari Terakhir</button>
                    <button wire:click="setDateRangePreset('this_month')" @click="openPresets = false" class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-700 text-xs cursor-pointer">Bulan Ini</button>
                    <button wire:click="setDateRangePreset('last_month')" @click="openPresets = false" class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-700 text-xs cursor-pointer">Bulan Lalu</button>
                </div>
            </div>
        </div>

        <!-- Date Inputs Row & Export Actions -->
        <div class="pt-3 border-t border-slate-100 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
            <div class="flex items-center space-x-2 w-full sm:w-auto">
                <input type="date" wire:model.live="startDate" class="px-3 py-2 bg-slate-50 border border-slate-200/80 rounded-xl text-xs font-bold text-slate-700">
                <span class="text-xs font-bold text-slate-400">s/d</span>
                <input type="date" wire:model.live="endDate" class="px-3 py-2 bg-slate-50 border border-slate-200/80 rounded-xl text-xs font-bold text-slate-700">
            </div>

            <div class="flex items-center space-x-2">
                <button 
                    type="button" 
                    wire:click="exportCsv"
                    class="px-4 py-2.5 bg-[#0c1a30] hover:bg-slate-800 text-white font-extrabold rounded-xl text-xs transition-all active:scale-[0.98] cursor-pointer shadow-xs flex items-center space-x-1.5"
                >
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                    <span>Unduh CSV</span>
                </button>

                <button 
                    type="button"
                    @click="window.print()"
                    class="px-4 py-2.5 bg-amber-400 hover:bg-amber-500 text-slate-900 font-extrabold rounded-xl text-xs transition-all active:scale-[0.98] cursor-pointer shadow-xs flex items-center space-x-1.5"
                >
                    <svg class="w-4 h-4 text-slate-900" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.82l-.24.03-.24-.03a.75.75 0 00-.28 0l-.24.03-.24-.03a.75.75 0 00-.28 0l-.24.03-.24-.03a.75.75 0 00-.5 0v-5.25a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v5.25a.75.75 0 00-.5 0l-.24-.03-.24.03a.75.75 0 00-.28 0l-.24-.03-.24.03a.75.75 0 00-.28 0l-.24-.03-.24.03a.75.75 0 00-.28 0l-.24-.03-.24.03a.75.75 0 00-.5 0v-5.25A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5h15a2.25 2.25 0 002.25-2.25V9a.75.75 0 00-.75-.75h-1.5a.75.75 0 00-.75.75v5.25a.75.75 0 00-.5 0z" />
                    </svg>
                    <span>Cetak PDF</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Live Preview Table Card -->
    <div class="bg-white border border-slate-100 rounded-3xl p-5 shadow-xs relative z-10 space-y-4 no-print font-['Outfit']">
        <div class="flex items-center justify-between pb-1">
            <h3 class="text-xs sm:text-sm font-black uppercase text-slate-800 tracking-wider">Pratinjau Data Laporan</h3>
            <span class="inline-flex items-center px-3 py-1 bg-amber-55 border border-amber-100 rounded-full text-[10px] font-extrabold text-amber-800">
                {{ $transactions->count() }} transaksi
            </span>
        </div>

        <div class="overflow-x-auto -mx-5">
            <div class="inline-block min-w-full align-middle px-5">
                <table class="min-w-full divide-y divide-slate-100 text-left">
                    <thead>
                        <tr class="text-[9px] font-black text-slate-400 uppercase tracking-wider">
                            <th class="py-3.5 pr-4">Siswa</th>
                            <th class="py-3.5 px-4">Sekolah</th>
                            <th class="py-3.5 px-4">Kelas</th>
                            <th class="py-3.5 px-4 text-center">Jenis</th>
                            <th class="py-3.5 px-4 text-right">Nominal</th>
                            <th class="py-3.5 px-4 text-center">Tanggal</th>
                            <th class="py-3.5 pl-4 text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs text-slate-700 font-medium">
                        @forelse($transactions->take(5) as $tx)
                            <tr wire:key="tx-{{ $tx->id }}" class="hover:bg-slate-50/55 transition-colors">
                                <td class="py-3.5 pr-4">
                                    <div class="text-xs font-bold text-slate-850 truncate max-w-[120px]">{{ $tx->student->name }}</div>
                                    <div class="text-[9px] text-slate-400 font-semibold">{{ $tx->student->nisn }}</div>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="inline-flex items-center px-2 py-0.5 bg-amber-50 border border-amber-100 rounded-md text-[9px] font-extrabold text-amber-900 whitespace-nowrap">
                                        {{ $tx->student->user->school_name ?? '-' }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4">
                                    <span class="inline-flex items-center px-2 py-0.5 bg-slate-50 border border-slate-100 rounded-md text-[9px] font-bold text-slate-650 whitespace-nowrap">
                                        {{ $tx->student->class_name ?? '-' }}
                                    </span>
                                </td>
                                <td class="py-3.5 px-4 text-center">
                                    @if($tx->type === 'deposit')
                                        <span class="inline-flex items-center px-2.5 py-0.5 bg-emerald-50 text-emerald-700 text-[9px] font-extrabold rounded-full border border-emerald-100">Setoran</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 bg-rose-50 text-rose-700 text-[9px] font-extrabold rounded-full border border-rose-100">Penarikan</span>
                                    @endif
                                </td>
                                <td class="py-3.5 px-4 text-right font-black {{ $tx->type === 'deposit' ? 'text-emerald-600' : 'text-rose-600' }}">
                                    Rp {{ number_format($tx->amount, 0, ',', '.') }}
                                </td>
                                <td class="py-3.5 px-4 text-center text-[10px] text-slate-450 font-bold">
                                    {{ $tx->created_at->translatedFormat('d M Y H:i') }}
                                </td>
                                <td class="py-3.5 pl-4 text-right">
                                     @if($tx->status === 'approved')
                                         <span class="inline-flex items-center px-2 py-0.5 bg-emerald-50 text-emerald-700 text-[9px] font-black rounded-md">SUKSES</span>
                                     @elseif($tx->status === 'pending')
                                         <span class="inline-flex items-center px-2 py-0.5 bg-amber-50 text-amber-700 text-[9px] font-black rounded-md">PENDING</span>
                                     @else
                                         <span class="inline-flex items-center px-2 py-0.5 bg-rose-50 text-rose-700 text-[9px] font-black rounded-md">DITOLAK</span>
                                     @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-8 text-center text-slate-400 font-semibold italic">
                                    Tidak ada data transaksi yang cocok dengan filter laporan ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($transactions->count() > 5)
            <div class="text-[10px] text-slate-400 font-semibold italic text-left pt-2 border-t border-slate-50">
                * Menampilkan 5 transaksi terbaru sebagai pratinjau. Unduh CSV atau Cetak PDF untuk melihat laporan lengkap dari {{ $transactions->count() }} transaksi.
            </div>
        @endif
    </div>

    <!-- ======================================================== -->
    <!-- PRINT LAYOUT VIEW ONLY (Triggered on window.print())     -->
    <!-- ======================================================== -->
    <div class="print-only print-container">
        <!-- Header -->
        <div class="print-header">
            <h2 style="margin: 0 0 5px 0; font-size: 16px; font-weight: bold; text-transform: uppercase;">PLATFORM TABUNGAN DIGITAL SAKUSISWA</h2>
            <p style="margin: 0; font-size: 10px; color: #475569;">Laporan Rekapitulasi Keuangan Tabungan Lintas Sekolah</p>
            <h3 style="margin: 15px 0 0 0; font-size: 14px; font-weight: 800; text-transform: uppercase;">LAPORAN TRANSAKSI TABUNGAN</h3>
            <p style="margin: 3px 0 0 0; font-size: 10px;">
                Periode: 
                @if(!$startDate && !$endDate) Semua Waktu
                @else {{ $startDate ?? 'Mulai Awal' }} s/d {{ $endDate ?? 'Hari Ini' }}
                @endif
                | Sekolah: {{ $schoolFilter === 'all' ? 'Semua Sekolah' : $schoolFilter }}
            </p>
        </div>

        <!-- Table -->
        <table class="print-table">
            <thead>
                <tr>
                    <th style="width: 4%;">No</th>
                    <th style="width: 14%;">Tanggal</th>
                    <th style="width: 20%;">Sekolah</th>
                    <th style="width: 10%;">Kelas</th>
                    <th style="width: 14%;">NISN</th>
                    <th style="width: 20%;">Nama Siswa</th>
                    <th style="width: 8%;">Jenis</th>
                    <th style="width: 10%;">Nominal</th>
                </tr>
            </thead>
            <tbody>
                @php $index = 1; @endphp
                @forelse($transactions as $tx)
                    @if($tx->status === 'approved')
                        <tr>
                            <td>{{ $index++ }}</td>
                            <td>{{ $tx->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $tx->student->user->school_name ?? '-' }}</td>
                            <td>{{ $tx->student->class_name ?? '-' }}</td>
                            <td>{{ $tx->student->nisn }}</td>
                            <td>{{ $tx->student->name }}</td>
                            <td>{{ $tx->type === 'deposit' ? 'Setoran' : 'Penarikan' }}</td>
                            <td>Rp {{ number_format($tx->amount, 0, ',', '.') }}</td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center;">Tidak ada transaksi disetujui dalam filter ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Summary -->
        <div class="print-summary">
            <table>
                <tr>
                    <td style="font-weight: bold; border: none !important;">Total Setoran:</td>
                    <td style="text-align: right; border: none !important; font-weight: bold;">Rp {{ number_format($totalSetoran, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold; border: none !important;">Total Penarikan:</td>
                    <td style="text-align: right; border: none !important; font-weight: bold;">Rp {{ number_format($totalPenarikan, 0, ',', '.') }}</td>
                </tr>
                <tr style="border-top: 1px solid #000;">
                    <td style="font-weight: bold; border: none !important; padding-top: 5px;">Saldo Bersih:</td>
                    <td style="text-align: right; border: none !important; font-weight: bold; padding-top: 5px;">Rp {{ number_format($saldoBersih, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>

        <div style="clear: both;"></div>

        <!-- Signatures -->
        <div class="print-signatures" style="margin-top: 60px; display: flex; justify-content: space-between; font-size: 11px; text-align: center;">
            <div style="width: 250px;">
                <p style="margin: 0 0 55px 0;">Mengetahui,</p>
                <p style="margin: 0; font-weight: bold; text-decoration: underline; line-height: 1.4;">Administrator Utama SakuSiswa</p>
                <p style="margin: 4px 0 0 0; color: #475569; line-height: 1.2;">Platform Tabungan Digital</p>
            </div>
            <div style="width: 250px;">
                <p style="margin: 0 0 55px 0;">Dibuat Oleh,</p>
                <p style="margin: 0; font-weight: bold; text-decoration: underline; line-height: 1.4;">Petugas Administrator</p>
                <p style="margin: 4px 0 0 0; color: #475569; line-height: 1.2;">{{ Auth::user()->name }}</p>
            </div>
        </div>
    </div>
</div>
