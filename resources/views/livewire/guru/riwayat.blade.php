<div class="-mx-4 -mt-4 sm:-mx-6 sm:-mt-6 md:-mx-8 md:-mt-8 p-4 sm:p-6 md:p-8 min-h-screen bg-[#ffd554] pb-24 space-y-5.5 font-sans relative overflow-hidden">
    
    <!-- Leaf Decoration (Top Right background - Soft amber outline) -->
    <div class="absolute top-0 right-0 w-32 h-32 opacity-10 pointer-events-none translate-x-6 -translate-y-6 z-0">
        <svg class="w-full h-full text-amber-800" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17 2c-3.87 0-7 3.13-7 7 0 2.21 1.02 4.18 2.62 5.5L12 15c-.41.34-1.07.34-1.48 0L2.3 8.3c-.63-.5-1.52-.38-2 .25-.5.63-.38 1.52.25 2l8.22 6.7c1.39 1.13 3.47 1.13 4.86 0L22 10.3c.63-.5.75-1.39.25-2-.5-.63-1.39-.75-2-.25l-2.62 2.15C17.98 9.38 17 7.41 17 5V2z"/>
        </svg>
    </div>

    <!-- Header Welcome/Banner Area (Dark Container with White Text) -->
    <div class="relative overflow-hidden bg-slate-900 border border-slate-800 rounded-3xl p-6 shadow-md flex items-center justify-between min-h-[160px] relative z-10 font-['Outfit'] text-white">
        <!-- Info Left Section -->
        <div class="text-left space-y-3.5 relative z-10 pr-24 md:pr-48">
            <div class="space-y-1.5">
                <h1 class="text-2xl md:text-3xl font-black text-white tracking-tight">Riwayat Transaksi</h1>
                <p class="text-xs md:text-sm text-slate-300 font-semibold leading-relaxed max-w-[280px] xs:max-w-xs md:max-w-md">Pantau riwayat setor tunai dan penarikan tabungan kelas Anda</p>
            </div>
            
            @if($className)
                <!-- Pill Badge: KELAS AKTIF | 1-A -->
                <div class="inline-flex items-center space-x-2.5 px-4 py-2 bg-white/10 border border-white/20 backdrop-blur-xs rounded-full text-[11px] font-black shadow-xs">
                    <span class="text-slate-300 uppercase tracking-wider">Kelas Aktif</span>
                    <span class="text-white/30">|</span>
                    <span class="text-amber-400 font-extrabold">{{ $className }}</span>
                </div>
            @endif
        </div>

        <!-- Header Illustration on the right -->
        <div class="absolute -right-4 -bottom-3 w-52 h-40 md:w-72 md:h-48 pointer-events-none z-0">
            <img src="/assets/headerguru.png" alt="Header Illustration" class="w-full h-full object-contain object-right-bottom scale-105">
        </div>
    </div>

    @if(!$className)
        <div class="bg-rose-50 border border-rose-200 text-rose-800 px-6 py-4 rounded-2xl text-sm font-medium relative z-10">
            Akun Anda belum dikaitkan dengan kelas manapun. Silakan hubungi Administrator Sekolah untuk mengkonfigurasi wali kelas.
        </div>
    @else
        <!-- Search and CSV Exporter Card (Elevated z-index to resolve popover overlay stacking bug) -->
        <div class="bg-white border border-slate-105 rounded-3xl p-4.5 shadow-xs relative z-35 space-y-3 font-['Outfit']">
            <!-- Row 1: Search (Spans full width) -->
            <div class="relative w-full">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400">
                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.602 10.602z" />
                    </svg>
                </span>
                <input 
                    type="text" 
                    wire:model.live.debounce.300ms="search" 
                    class="w-full pl-10 pr-4 py-3 border border-slate-100 rounded-2xl text-xs placeholder-slate-400 focus:outline-hidden focus:border-slate-800 focus:ring-4 focus:ring-slate-850/5 bg-slate-50/50 font-bold"
                    placeholder="Cari nama siswa atau NISN..."
                >
            </div>

            <!-- Row 2: Filter Button & Export Button (Side by side) -->
            <div class="flex items-center space-x-2.5 w-full relative z-40">
                <!-- Inline filter settings indicator with custom date range popover -->
                <div class="relative" x-data="{ openFilter: false }">
                    <button 
                        @click="openFilter = !openFilter"
                        class="w-10 h-10 flex items-center justify-center bg-white border rounded-xl hover:bg-slate-50 transition-colors shadow-3xs cursor-pointer active:scale-[0.97] shrink-0 {{ ($startDate || $endDate) ? 'border-amber-400 ring-2 ring-amber-400/20' : 'border-slate-200/80' }}"
                    >
                        <svg class="w-4 h-4 {{ ($startDate || $endDate) ? 'text-amber-600' : 'text-slate-700' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
                        </svg>
                    </button>

                    <!-- Dropdown Popover Card for Custom Date Range -->
                    <div 
                        x-show="openFilter" 
                        @click.away="openFilter = false"
                        x-transition
                        class="absolute left-0 mt-2 w-72 bg-white border border-slate-105 rounded-3xl p-4.5 shadow-lg z-50 font-['Outfit'] space-y-3.5"
                        style="display: none;"
                    >
                        <div class="text-[11px] font-black text-slate-800 uppercase tracking-wider block">Filter Rentang Tanggal</div>
                        
                        <!-- Date fields -->
                        <div class="grid grid-cols-2 gap-2">
                            <div class="space-y-1">
                                <label class="text-[9px] font-bold text-slate-405 uppercase">Mulai</label>
                                <input type="date" wire:model.live="startDate" class="w-full px-2.5 py-1.5 border border-slate-150 rounded-xl text-[10px] font-bold focus:outline-hidden focus:border-slate-800 bg-slate-50/50">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[9px] font-bold text-slate-405 uppercase">Selesai</label>
                                <input type="date" wire:model.live="endDate" class="w-full px-2.5 py-1.5 border border-slate-150 rounded-xl text-[10px] font-bold focus:outline-hidden focus:border-slate-800 bg-slate-50/50">
                            </div>
                        </div>

                        <!-- Quick presets -->
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-bold text-slate-405 uppercase">Preset Cepat</label>
                            <div class="grid grid-cols-2 gap-1.5">
                                <button type="button" @click="$wire.setDateRangePreset('today'); openFilter = false" class="py-1.5 bg-slate-50 border border-slate-150 hover:bg-[#fff8e5] hover:text-amber-800 hover:border-amber-200/50 text-[9px] font-extrabold rounded-lg cursor-pointer transition-all">Hari Ini</button>
                                <button type="button" @click="$wire.setDateRangePreset('7days'); openFilter = false" class="py-1.5 bg-slate-50 border border-slate-150 hover:bg-[#fff8e5] hover:text-amber-800 hover:border-amber-200/50 text-[9px] font-extrabold rounded-lg cursor-pointer transition-all">7 Hari Terakhir</button>
                                <button type="button" @click="$wire.setDateRangePreset('this_month'); openFilter = false" class="py-1.5 bg-slate-50 border border-slate-150 hover:bg-[#fff8e5] hover:text-amber-800 hover:border-amber-200/50 text-[9px] font-extrabold rounded-lg cursor-pointer transition-all">Bulan Ini</button>
                                <button type="button" @click="$wire.setDateRangePreset('all'); openFilter = false" class="py-1.5 bg-slate-50 border border-slate-150 hover:bg-[#fff8e5] hover:text-amber-800 hover:border-amber-200/50 text-[9px] font-extrabold rounded-lg cursor-pointer transition-all">Semua Waktu</button>
                            </div>
                        </div>

                        <!-- Active range display or reset -->
                        @if($startDate || $endDate)
                            <div class="pt-2 border-t border-slate-100 flex items-center justify-between">
                                <span class="text-[9px] text-amber-850 font-bold">Filter aktif</span>
                                <button type="button" wire:click="setDateRangePreset('all')" @click="openFilter = false" class="text-[9px] text-rose-600 hover:underline font-extrabold cursor-pointer">Reset Filter</button>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Export Button -->
                <button 
                    wire:click="exportCsv"
                    class="flex-1 py-3 bg-[#0c1a30] hover:bg-slate-800 text-white font-extrabold rounded-2xl flex items-center justify-center space-x-2 text-xs transition-all active:scale-[0.98] cursor-pointer shadow-xs"
                >
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                    <span>Ekspor Laporan (CSV)</span>
                </button>
            </div>
        </div>

        <!-- Filter tabs & sorting option -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 w-full relative z-20 font-['Outfit']">
            <!-- Filter Tabs -->
            <div class="flex bg-white p-1 rounded-2xl border border-slate-150/60 shadow-3xs w-full sm:w-auto">
                <button 
                    wire:click="$set('typeFilter', 'all')"
                    class="flex-1 sm:flex-none px-4 py-2.5 rounded-xl text-xs font-bold transition-all cursor-pointer {{ $typeFilter === 'all' ? 'bg-[#ffd554] text-slate-900 font-extrabold shadow-3xs' : 'text-slate-500 hover:bg-slate-50' }}"
                >
                    Semua
                </button>
                <button 
                    wire:click="$set('typeFilter', 'deposit')"
                    class="flex-1 sm:flex-none px-4 py-2.5 rounded-xl text-xs font-bold transition-all cursor-pointer {{ $typeFilter === 'deposit' ? 'bg-[#ffd554] text-slate-900 font-extrabold shadow-3xs' : 'text-slate-500 hover:bg-slate-50' }}"
                >
                    Setoran
                </button>
                <button 
                    wire:click="$set('typeFilter', 'withdrawal')"
                    class="flex-1 sm:flex-none px-4 py-2.5 rounded-xl text-xs font-bold transition-all cursor-pointer {{ $typeFilter === 'withdrawal' ? 'bg-[#ffd554] text-slate-900 font-extrabold shadow-3xs' : 'text-slate-500 hover:bg-slate-50' }}"
                >
                    Penarikan
                </button>
            </div>

            <!-- Month Filter Select -->
            <div class="relative w-full sm:w-auto shrink-0" x-data="{ openSort: false }">
                <button 
                    @click="openSort = !openSort"
                    class="w-full sm:w-auto px-4.5 py-2.5 bg-white hover:bg-slate-50 border border-slate-200/80 rounded-2xl flex items-center justify-between sm:justify-start space-x-2 text-xs font-bold text-slate-700 shadow-3xs cursor-pointer transition-all active:scale-[0.97]"
                >
                    <div class="flex items-center space-x-1.5">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                        <span>
                            @if($monthFilter === 'all') Semua Bulan
                            @elseif($monthFilter == '1') Januari
                            @elseif($monthFilter == '2') Februari
                            @elseif($monthFilter == '3') Maret
                            @elseif($monthFilter == '4') April
                            @elseif($monthFilter == '5') Mei
                            @elseif($monthFilter == '6') Juni
                            @elseif($monthFilter == '7') Juli
                            @elseif($monthFilter == '8') Agustus
                            @elseif($monthFilter == '9') September
                            @elseif($monthFilter == '10') Oktober
                            @elseif($monthFilter == '11') November
                            @elseif($monthFilter == '12') Desember
                            @endif
                        </span>
                    </div>
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div 
                    x-show="openSort" 
                    @click.away="openSort = false"
                    x-transition
                    class="absolute left-0 sm:left-auto sm:right-0 mt-1.5 w-full sm:w-40 max-h-60 overflow-y-auto rounded-2xl bg-white shadow-lg border border-slate-100 z-30 py-1 font-['Outfit']"
                    style="display: none; scrollbar-width: thin;"
                >
                    <button wire:click="$set('monthFilter', 'all')" @click="openSort = false" class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-700 text-xs {{ $monthFilter === 'all' ? 'bg-amber-50 text-amber-900 font-bold' : '' }} cursor-pointer">Semua Bulan</button>
                    @foreach(range(1, 12) as $m)
                        @php
                            $monthName = [
                                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
                            ][$m];
                        @endphp
                        <button wire:click="$set('monthFilter', '{{ $m }}')" @click="openSort = false" class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-700 text-xs {{ $monthFilter == $m ? 'bg-amber-50 text-amber-900 font-bold' : '' }} cursor-pointer">{{ $monthName }}</button>
                    @endforeach
                </div>
            </div>
        </div>



        <!-- Section Title: Daftar Transaksi -->
        <h2 class="text-sm font-black text-slate-850 tracking-tight text-left relative z-10 font-['Outfit'] mt-6 mb-3">Daftar Transaksi</h2>

        <!-- Timeline connected student list (Scrollable wrapper: displays ~5 items, scroll to view more) -->
        <div 
            class="relative z-10 max-h-[460px] overflow-y-auto pr-1.5 space-y-3.5 pb-2"
            style="scrollbar-width: thin; scrollbar-color: rgba(217, 119, 6, 0.35) transparent;"
        >
            <!-- Absolute vertical line behind circles (exactly centered horizontally on circle width) -->
            @if($transactions->count() > 0)
                <div class="absolute left-[16px] top-6 bottom-6 w-0.5 border-l-2 border-dashed border-amber-400/80 z-0"></div>
            @endif

            @forelse($transactions as $index => $tx)
                @php
                    $student = $tx->student;
                    $words = explode(' ', $student->name);
                    $initials = count($words) >= 2 
                        ? substr($words[0], 0, 1) . substr($words[1], 0, 1) 
                        : substr($student->name, 0, 2);
                    $initials = strtoupper($initials);
                @endphp
                
                <div class="flex items-center space-x-3.5 relative z-10">
                    <!-- Icon Circle (Centered vertically with items-center) -->
                    @if($tx->type === 'deposit')
                        <div class="w-8 h-8 rounded-full bg-[#e6f4ea] border border-emerald-300 flex items-center justify-center text-emerald-600 shrink-0 shadow-3xs z-10">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
                            </svg>
                        </div>
                    @else
                        <div class="w-8 h-8 rounded-full bg-[#fce8e6] border border-rose-300 flex items-center justify-center text-rose-600 shrink-0 shadow-3xs z-10">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" />
                            </svg>
                        </div>
                    @endif

                    <!-- Transaction Card -->
                    <div class="flex-1 bg-white border border-slate-100 rounded-3xl p-3.5 sm:p-4.5 flex items-center justify-between shadow-3xs hover:border-amber-400 hover:shadow-xs transition-all duration-300 font-['Outfit']">
                        <!-- Left side: avatar, name, details -->
                        <div class="flex items-center space-x-3.5 min-w-0 flex-1">
                            <!-- Student Profile Photo Avatar -->
                            <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-slate-100 border border-amber-200 flex items-center justify-center overflow-hidden shrink-0 shadow-3xs">
                                <img src="/assets/{{ $student->avatar ?? 'i1.png' }}" alt="Profile" class="w-full h-full object-cover rounded-full">
                            </div>
                            <div class="text-left min-w-0 space-y-0.5">
                                <h3 class="text-xs sm:text-sm font-extrabold text-slate-850 truncate leading-tight font-sans">{{ $student->name }}</h3>
                                <div class="text-[10px] text-slate-400 font-semibold leading-relaxed">
                                    <div>NISN: {{ $student->nisn }}</div>
                                    <div>{{ $tx->created_at->translatedFormat('d M Y, H:i') }}</div>
                                </div>
                                <!-- Colored transaction capsule badge -->
                                <span class="inline-block px-2.5 py-0.5 text-[8px] font-extrabold uppercase tracking-wide rounded-md {{ $tx->type === 'deposit' ? 'bg-[#e6f4ea] text-[#137333]' : 'bg-[#fce8e6] text-[#c5221f]' }}">
                                    {{ $tx->type === 'deposit' ? 'Setoran Tunai' : 'Penarikan' }}
                                </span>
                            </div>
                        </div>

                        <!-- Right side: amount, status, chevron -->
                        <div class="flex items-center space-x-3.5 shrink-0 pl-2">
                            <div class="text-right space-y-1">
                                @if($tx->type === 'deposit')
                                    <span class="text-xs sm:text-sm font-black text-emerald-600 block">
                                        + Rp {{ number_format($tx->amount, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="text-xs sm:text-sm font-black text-rose-600 block">
                                        - Rp {{ number_format($tx->amount, 0, ',', '.') }}
                                    </span>
                                @endif

                                <div class="block">
                                    @if($tx->status === 'approved')
                                        <span class="px-2.5 py-0.5 bg-[#e6f4ea] text-[#137333] rounded-full text-[8px] sm:text-[9px] font-extrabold uppercase tracking-wider border border-[#137333]/15">
                                            Disetujui
                                        </span>
                                    @elseif($tx->status === 'pending')
                                        <span class="px-2.5 py-0.5 bg-amber-50 text-amber-800 rounded-full text-[8px] sm:text-[9px] font-extrabold uppercase tracking-wider border border-amber-200/50">
                                            Pending
                                        </span>
                                    @else
                                        <span class="px-2.5 py-0.5 bg-[#fce8e6] text-[#c5221f] rounded-full text-[8px] sm:text-[9px] font-extrabold uppercase tracking-wider border border-[#c5221f]/15">
                                            Ditolak
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Chevron right icon -->
                            <div class="text-slate-350">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white border border-gray-150 rounded-3xl p-8 text-center text-slate-400 font-medium italic shadow-xs">
                    Tidak ada riwayat transaksi ditemukan.
                </div>
            @endforelse
        </div>
    @endif
</div>
