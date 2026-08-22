<div class="-mx-4 -mt-4 sm:-mx-6 sm:-mt-6 md:-mx-8 md:-mt-8 p-4 sm:p-6 md:p-8 min-h-screen bg-[#ffd554] pb-24 space-y-5.5 font-sans relative overflow-hidden">
    
    <!-- Leaf Decoration (Top Right background - Soft amber outline) -->
    <div class="absolute top-0 right-0 w-32 h-32 opacity-10 pointer-events-none translate-x-6 -translate-y-6 z-0">
        <svg class="w-full h-full text-amber-800" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17 2c-3.87 0-7 3.13-7 7 0 2.21 1.02 4.18 2.62 5.5L12 15c-.41.34-1.07.34-1.48 0L2.3 8.3c-.63-.5-1.52-.38-2 .25-.5.63-.38 1.52.25 2l8.22 6.7c1.39 1.13 3.47 1.13 4.86 0L22 10.3c.63-.5.75-1.39.25-2-.5-.63-1.39-.75-2-.25l-2.62 2.15C17.98 9.38 17 7.41 17 5V2z"/>
        </svg>
    </div>

    <!-- Header Welcome/Banner Area -->
    <div class="relative flex items-center justify-between min-h-[140px] z-10 font-['Outfit'] pt-4 pb-2">
        <!-- Info Left Section -->
        <div class="text-left space-y-3.5 relative z-10 pr-32 sm:pr-48 md:pr-64">
            <div class="space-y-1.5">
                <h1 class="text-2xl md:text-3xl font-black text-[#0f172a] tracking-tight max-w-[200px] sm:max-w-none">Riwayat Transaksi Global</h1>
                <p class="hidden md:block text-xs md:text-sm text-slate-750 font-bold leading-relaxed max-w-xs md:max-w-lg">Pantau riwayat setor tunai dan penarikan tabungan global siswa keseluruhan kelas</p>
            </div>
            
            <div class="inline-flex items-center space-x-2.5 px-4.5 py-2.5 bg-[#fff8e5] border border-amber-200/20 rounded-full text-[11px] font-black shadow-3xs">
                <span class="text-amber-800 uppercase tracking-wider">Akses Utama</span>
                <span class="text-slate-400">|</span>
                <span class="text-slate-900">Administrator</span>
            </div>
        </div>

        <!-- Header Illustration on the right (centered vertically) -->
        <div class="absolute -right-4 top-1/2 -translate-y-1/2 w-44 h-32 sm:w-60 sm:h-44 md:w-72 md:h-48 pointer-events-none z-0">
            <img src="/assets/headerguru.png" alt="Header Illustration" class="w-full h-full object-contain object-right-center scale-105">
        </div>
    </div>



    <!-- Search and Filters Container -->
    <div class="bg-white border border-slate-100 rounded-3xl p-4.5 shadow-xs relative z-30 space-y-3 font-['Outfit']">
        <!-- Row 1: Search & Class Filter Dropdown -->
        <!-- Row 1: Search & Class Filter Dropdown (Side-by-side on mobile and desktop) -->
        <div class="flex flex-row gap-2 sm:gap-3 w-full">
            <div class="relative flex-1">
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

            <!-- School filter dropdown (Custom Dropdown for Per Sekolah) -->
            <div class="relative shrink-0 w-36 sm:w-52 font-['Outfit']" x-data="{ openSchool: false }">
                <button 
                    @click="openSchool = !openSchool"
                    class="w-full px-3 py-3 bg-slate-50/50 border border-slate-100 rounded-2xl flex items-center justify-between space-x-1.5 text-xs font-bold text-slate-700 shadow-3xs cursor-pointer transition-all active:scale-[0.97]"
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
                    class="absolute right-0 mt-1.5 w-44 sm:w-60 max-h-48 overflow-y-auto rounded-2xl bg-white shadow-lg border border-slate-100 z-50 py-1"
                    style="display: none; scrollbar-width: thin;"
                >
                    <button wire:click="$set('schoolFilter', 'all')" @click="openSchool = false" class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-700 text-xs {{ $schoolFilter === 'all' ? 'bg-amber-50 text-amber-900 font-bold' : '' }} cursor-pointer">Semua Sekolah</button>
                    @foreach($availableSchools as $sch)
                        <button wire:click="$set('schoolFilter', '{{ $sch }}')" @click="openSchool = false" class="w-full text-left px-4 py-2 hover:bg-slate-50 font-semibold text-slate-700 text-xs {{ $schoolFilter === $sch ? 'bg-amber-50 text-amber-900 font-bold' : '' }} cursor-pointer">{{ $sch }}</button>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Row 2: Date Filter -->
        <div class="w-full relative z-40" x-data="{ openFilter: false }">
            <button 
                @click="openFilter = !openFilter"
                class="w-full py-3 bg-white border flex items-center justify-center space-x-2 text-xs font-bold text-slate-700 rounded-2xl hover:bg-slate-50 transition-colors shadow-3xs cursor-pointer active:scale-[0.98] {{ ($startDate || $endDate) ? 'border-amber-400 ring-2 ring-amber-400/20 text-amber-800' : 'border-slate-200/80' }}"
            >
                <svg class="w-4 h-4 {{ ($startDate || $endDate) ? 'text-amber-600' : 'text-slate-550' }}" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                </svg>
                <span>Filter Berdasarkan Tanggal</span>
            </button>

            <!-- Date Dropdown -->
            <div 
                x-show="openFilter" 
                @click.away="openFilter = false"
                x-transition
                class="absolute left-0 right-0 mt-2 bg-white border border-slate-105 rounded-3xl p-4.5 shadow-lg z-50 font-['Outfit'] space-y-3.5"
                style="display: none;"
            >
                <div class="text-[11px] font-black text-slate-800 uppercase tracking-wider block">Filter Rentang Tanggal</div>
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

                <div class="space-y-1.5">
                    <label class="text-[9px] font-bold text-slate-405 uppercase">Preset Cepat</label>
                    <div class="grid grid-cols-2 gap-1.5">
                        <button type="button" @click="$wire.setDateRangePreset('today'); openFilter = false" class="py-1.5 bg-slate-50 border border-slate-150 hover:bg-[#fff8e5] hover:text-amber-800 hover:border-amber-200/50 text-[9px] font-extrabold rounded-lg cursor-pointer transition-all">Hari Ini</button>
                        <button type="button" @click="$wire.setDateRangePreset('7days'); openFilter = false" class="py-1.5 bg-slate-50 border border-slate-150 hover:bg-[#fff8e5] hover:text-amber-800 hover:border-amber-200/50 text-[9px] font-extrabold rounded-lg cursor-pointer transition-all">7 Hari Terakhir</button>
                        <button type="button" @click="$wire.setDateRangePreset('this_month'); openFilter = false" class="py-1.5 bg-slate-50 border border-slate-150 hover:bg-[#fff8e5] hover:text-amber-800 hover:border-amber-200/50 text-[9px] font-extrabold rounded-lg cursor-pointer transition-all">Bulan Ini</button>
                        <button type="button" @click="$wire.setDateRangePreset('all'); openFilter = false" class="py-1.5 bg-slate-50 border border-slate-150 hover:bg-[#fff8e5] hover:text-amber-800 hover:border-amber-200/50 text-[9px] font-extrabold rounded-lg cursor-pointer transition-all">Semua Waktu</button>
                    </div>
                </div>

                @if($startDate || $endDate)
                    <div class="pt-2 border-t border-slate-100 flex items-center justify-between">
                        <span class="text-[9px] text-amber-850 font-bold">Filter aktif</span>
                        <button type="button" wire:click="setDateRangePreset('all')" @click="openFilter = false" class="text-[9px] text-rose-600 hover:underline font-extrabold cursor-pointer">Reset Filter</button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Filter Tabs & Month Select -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 w-full relative z-20 font-['Outfit']">
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

        <div class="relative w-full sm:w-auto shrink-0" x-data="{ openSort: false }">
            <button 
                @click="openSort = !openSort"
                class="w-full sm:w-auto px-4.5 py-2.5 bg-white hover:bg-slate-50 border border-slate-200/80 rounded-2xl flex items-center justify-between sm:justify-start space-x-2 text-xs font-bold text-slate-700 shadow-3xs cursor-pointer transition-all active:scale-[0.97]"
            >
                <span>Bulan: {{ $monthFilter === 'all' ? 'Semua Bulan' : [1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'][$monthFilter] }}</span>
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </button>
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

    <!-- Daftar Transaksi -->
    <h2 class="text-sm font-black text-slate-850 tracking-tight text-left relative z-10 font-['Outfit'] mt-6 mb-3">Daftar Transaksi</h2>

    <div class="relative z-10 max-h-[460px] overflow-y-auto pr-1.5 space-y-3.5 pb-2" style="scrollbar-width: thin; scrollbar-color: rgba(217, 119, 6, 0.35) transparent;">
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

                <!-- Card -->
                <div class="flex-1 bg-white border border-slate-100 rounded-3xl p-3.5 sm:p-4.5 flex items-center justify-between shadow-3xs hover:border-amber-400 hover:shadow-xs transition-all duration-300 font-['Outfit']">
                    <div class="flex items-center space-x-3.5 min-w-0 flex-1">
                        <!-- Student Profile Photo Avatar -->
                        <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full bg-slate-100 border border-amber-200 flex items-center justify-center overflow-hidden shrink-0 shadow-3xs">
                            <img src="/assets/{{ $student->avatar ?? 'i1.png' }}" alt="Profile" class="w-full h-full object-cover rounded-full">
                        </div>
                        <div class="text-left min-w-0 space-y-0.5">
                            <h3 class="text-xs sm:text-sm font-extrabold text-slate-850 truncate leading-tight font-sans">{{ $student->name }}</h3>
                            <div class="text-[10px] text-slate-400 font-semibold leading-relaxed">
                                <div>Kelas: {{ $student->class_name }} | NISN: {{ $student->nisn }}</div>
                                <div>{{ $tx->created_at->translatedFormat('d M Y, H:i') }}</div>
                            </div>
                            <span class="inline-block px-2.5 py-0.5 text-[8px] font-extrabold uppercase tracking-wide rounded-md {{ $tx->type === 'deposit' ? 'bg-[#e6f4ea] text-[#137333]' : 'bg-[#fce8e6] text-[#c5221f]' }}">
                                {{ $tx->type === 'deposit' ? 'Setoran Tunai' : 'Penarikan' }}
                            </span>
                        </div>
                    </div>

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
</div>
