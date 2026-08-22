<div wire:poll.45s class="-mx-4 -mt-4 sm:-mx-6 sm:-mt-6 md:-mx-8 md:-mt-8 p-4 sm:p-6 md:p-8 min-h-screen bg-[#ffd554] pb-24 space-y-5.5 font-sans relative overflow-hidden">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Decorative background elements -->
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
                <img src="/assets/profileicon.jpg" alt="Profile" class="w-full h-full object-cover rounded-xl sm:rounded-2xl">
            </div>
            <div>
                <h2 class="text-xs sm:text-sm font-black text-[#0f172a] leading-none">Halo, Admin 👋</h2>
                <span class="text-[9px] sm:text-[10px] text-slate-750 font-extrabold uppercase tracking-wider mt-0.5 sm:mt-1 block">Administrator</span>
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

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-2 gap-4 relative z-10 font-['Outfit'] pr-0 sm:pr-4">
        <!-- 1. Total Tabungan Card (Premium Dark Metal Style) -->
        <div class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-slate-950 rounded-3xl p-6 text-white shadow-xl overflow-hidden border border-slate-700/30 min-h-[175px] col-span-2">
            <!-- Premium card subtle layout accents -->
            <div class="absolute -top-12 -right-12 w-40 h-40 bg-white/5 rounded-full blur-2xl pointer-events-none z-0"></div>
            <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-[#65b33b]/10 rounded-full blur-xl pointer-events-none z-0"></div>
            
            <!-- Large Wallet Graphic Image (Overlapping right side) -->
            <div class="absolute -right-6 -bottom-9 w-[70%] h-64 flex items-center justify-end pointer-events-none z-0">
                <img src="/assets/uang.png" alt="Saldo" class="w-64 h-64 md:w-72 md:h-72 object-contain translate-y-3">
            </div>
            
            <!-- Content Container with Alpine x-data for balance visibility -->
            <div class="relative z-10 flex flex-col justify-between min-h-[127px] w-[55%]" x-data="{ showBalance: true }">
                <div>
                    <div class="flex items-center space-x-2">
                        <p class="text-[10px] text-slate-400 font-extrabold tracking-wider uppercase">Total Tabungan</p>
                        
                        <!-- Toggle eye visibility button -->
                        <button @click="showBalance = !showBalance" class="text-slate-400 hover:text-white transition-colors cursor-pointer focus:outline-hidden" title="Tampilkan/Sembunyikan Saldo">
                            <!-- Eye Open (Visible when showBalance is true) -->
                            <svg x-show="showBalance" class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <!-- Eye Slash (Visible when showBalance is false) -->
                            <svg x-show="!showBalance" class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                    
                    <h3 class="text-2xl md:text-3xl font-extrabold mt-1 font-['Outfit'] tracking-tight">
                        <span x-show="showBalance">Rp {{ number_format($totalSaving, 0, ',', '.') }}</span>
                        <span x-show="!showBalance" style="display: none;">Rp ••••••••</span>
                    </h3>
                </div>
                
                <div class="border-t border-slate-800/80 pt-3 mt-3">
                    <div class="flex items-center space-x-2">
                        <div class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center shrink-0 overflow-hidden">
                            <img src="/assets/profileicon.jpg" alt="Profile" class="w-full h-full object-cover rounded-full">
                        </div>
                        <span class="text-xs font-bold text-white">Administrator</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Total Siswa Card -->
        <div class="bg-gradient-to-br from-[#556b2f] to-[#39481f] border border-[#6b853b] rounded-3xl p-5 sm:p-6 shadow-xl flex flex-col justify-between min-h-[140px] sm:min-h-[170px] text-left col-span-1 relative overflow-hidden group hover:shadow-2xl transition-all duration-300 text-white">
            <!-- Decorative background icon -->
            <div class="absolute -right-2 -bottom-2 w-20 h-20 text-white/5 pointer-events-none z-0 transition-transform duration-300 group-hover:scale-110">
                <svg class="w-full h-full" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
            </div>
            <div class="relative z-10 w-10 h-10 sm:w-11 sm:h-11 rounded-2xl bg-white/10 flex items-center justify-center text-[#edf3e4] shrink-0 shadow-3xs">
                <!-- Group/Students Icon -->
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
            </div>
            <div class="mt-4 space-y-1 relative z-10">
                <span class="text-[10px] sm:text-xs text-[#dbe3cc] font-extrabold uppercase tracking-wider block truncate">Siswa Aktif</span>
                <span class="text-base sm:text-2xl font-black text-white tracking-tight block">{{ $totalStudents }} Siswa</span>
                <span class="inline-flex items-center space-x-1 px-2.5 py-1 bg-white/10 text-[#edf3e4] text-[9px] sm:text-[10px] font-extrabold rounded-full mt-2 border border-white/15">
                    <span>↑ +1 dari bulan lalu</span>
                </span>
            </div>
        </div>

        <!-- 3. Total Guru Card -->
        <div class="bg-gradient-to-br from-[#97332d] to-[#6b221d] border border-[#ab3a33] rounded-3xl p-5 sm:p-6 shadow-xl flex flex-col justify-between min-h-[140px] sm:min-h-[170px] text-left col-span-1 relative overflow-hidden group hover:shadow-2xl transition-all duration-300 text-white">
            <!-- Decorative background icon -->
            <div class="absolute -right-2 -bottom-2 w-20 h-20 text-white/5 pointer-events-none z-0 transition-transform duration-300 group-hover:scale-110">
                <svg class="w-full h-full" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            </div>
            <div class="relative z-10 w-10 h-10 sm:w-11 sm:h-11 rounded-2xl bg-white/10 flex items-center justify-center text-[#fbe5e3] shrink-0 shadow-3xs">
                <!-- Single User/Teacher Icon -->
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            </div>
            <div class="mt-4 space-y-1 relative z-10">
                <span class="text-[10px] sm:text-xs text-[#f5c3bf] font-extrabold uppercase tracking-wider block truncate">Wali Kelas / Guru</span>
                <span class="text-base sm:text-2xl font-black text-white tracking-tight block">{{ $totalTeachers }} Guru</span>
                <span class="inline-flex items-center space-x-1 px-2.5 py-1 bg-white/10 text-[#fbe5e3] text-[9px] sm:text-[10px] font-extrabold rounded-full mt-2 border border-white/15">
                    <span>— Tetap</span>
                </span>
            </div>
        </div>
    </div>

    <!-- Transaction Analytics Script -->
    <script>
        window.donutChartComponent = function() {
            return {
                donutChart: null,
                timeframe: 'this_month',
                open: false,
                init() {
                    this.renderChart();
                },
                renderChart() {
                    const donutCtx = document.getElementById('donutChartCanvas').getContext('2d');
                    if (this.donutChart) { this.donutChart.destroy(); }
                    this.donutChart = new Chart(donutCtx, {
                        type: 'doughnut',
                        data: {
                            datasets: [{
                                data: [{{ $totalDeposit }}, {{ $totalWithdrawal }}],
                                backgroundColor: ['#10b981', '#ef4444'],
                                borderWidth: 0,
                                hoverOffset: 4
                            }]
                        },
                        options: {
                            cutout: '75%',
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false },
                                tooltip: { enabled: true }
                            }
                        }
                    });
                },
                updateData(detail) {
                    const data = detail[0] || detail;
                    const totalDeposit = parseFloat(data.totalDeposit);
                    const totalWithdrawal = parseFloat(data.totalWithdrawal);

                    const totalVal = ((totalDeposit + totalWithdrawal) / 1000).toLocaleString('id-ID', {maximumFractionDigits:0}) + 'K';
                    const elTotal = document.getElementById('totalValText');
                    if (elTotal) elTotal.innerText = totalVal;

                    const elSetoran = document.getElementById('setoranTextVal');
                    if (elSetoran) elSetoran.innerText = (totalDeposit / 1000).toLocaleString('id-ID', {maximumFractionDigits:0}) + 'K';

                    const totalTx = totalDeposit + totalWithdrawal;
                    const depPercent = totalTx > 0 ? Math.round((totalDeposit / totalTx) * 100) : 0;
                    const withPercent = totalTx > 0 ? 100 - depPercent : 0;

                    const elSetoranPercent = document.getElementById('setoranPercentText');
                    if (elSetoranPercent) elSetoranPercent.innerText = '(' + depPercent + '%)';

                    const elPenarikan = document.getElementById('penarikanTextVal');
                    if (elPenarikan) elPenarikan.innerText = (totalWithdrawal / 1000).toLocaleString('id-ID', {maximumFractionDigits:0}) + 'K';

                    const elPenarikanPercent = document.getElementById('penarikanPercentText');
                    if (elPenarikanPercent) elPenarikanPercent.innerText = '(' + withPercent + '%)';

                    if (this.donutChart) {
                        this.donutChart.data.datasets[0].data = [totalDeposit, totalWithdrawal];
                        this.donutChart.update();
                    }
                }
            };
        };

        window.trendChartComponent = function() {
            let trendChart = null;
            return {
                timeframe: 'this_month',
                open: false,
                init() {
                    this.renderChart();
                },
                renderChart() {
                    const trendCtx = document.getElementById('trendChartCanvas').getContext('2d');
                    if (trendChart) { trendChart.destroy(); }
                    trendChart = new Chart(trendCtx, {
                        type: 'line',
                        data: {
                            labels: {!! json_encode($trendLabels) !!},
                            datasets: [
                                {
                                    label: 'Setoran',
                                    data: {!! json_encode($trendDeposits) !!},
                                    borderColor: '#10b981',
                                    backgroundColor: 'transparent',
                                    borderWidth: 2.5,
                                    tension: 0.35,
                                    pointRadius: 2,
                                    pointHoverRadius: 5
                                },
                                {
                                    label: 'Penarikan',
                                    data: {!! json_encode($trendWithdrawals) !!},
                                    borderColor: '#ef4444',
                                    backgroundColor: 'transparent',
                                    borderWidth: 2.5,
                                    tension: 0.35,
                                    pointRadius: 2,
                                    pointHoverRadius: 5
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false }
                            },
                            scales: {
                                x: {
                                    grid: { display: false },
                                    ticks: {
                                        font: { family: 'Outfit', size: 9 },
                                        color: '#94a3b8',
                                        maxRotation: 0,
                                        autoSkip: true,
                                        maxTicksLimit: 5
                                    }
                                },
                                y: {
                                    grid: { color: '#f1f5f9' },
                                    ticks: {
                                        font: { family: 'Outfit', size: 9 },
                                        color: '#94a3b8',
                                        callback: function(value) {
                                            if (value >= 1000) {
                                                return (value / 1000) + 'K';
                                            }
                                            return value;
                                        }
                                    }
                                }
                            }
                        }
                    });
                },
                updateData(detail) {
                    const data = detail[0] || detail;
                    if (trendChart) {
                        trendChart.data.labels = data.trendLabels;
                        trendChart.data.datasets[0].data = data.trendDeposits;
                        trendChart.data.datasets[1].data = data.trendWithdrawals;
                        trendChart.update();
                    }
                }
            };
        };
    </script>

    <!-- Transaction Analytics Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 relative z-10 font-['Outfit'] pr-0 sm:pr-4">
        <!-- 1. Ringkasan Transaksi (Donut) -->
        <div x-data="donutChartComponent()" @donut-chart-updated.window="console.log('donut-chart-updated event caught:', $event.detail); updateData($event.detail)" wire:ignore class="bg-white border border-slate-100 rounded-3xl p-5 sm:p-6 shadow-xs flex flex-col justify-between space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-xs sm:text-sm font-black text-slate-800 uppercase tracking-wider">Ringkasan Transaksi</h3>
                <!-- Timeframe Select Dropdown -->
                <div class="relative inline-block text-left z-20">
                    <button @click="open = !open" class="flex items-center space-x-1.5 px-3 py-1.5 bg-slate-50 border border-slate-100 text-slate-700 text-[10px] sm:text-xs font-extrabold rounded-xl hover:bg-slate-100 transition-colors cursor-pointer">
                        <span x-text="timeframe === 'this_month' ? 'Bulan Ini' : (timeframe === 'last_month' ? 'Bulan Lalu' : '7 Hari Terakhir')"></span>
                        <svg class="w-3 h-3 text-slate-500 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <!-- Dropdown list overlay -->
                    <div x-show="open" @click.outside="open = false" x-transition class="absolute right-0 mt-1.5 w-32 bg-white border border-slate-100 rounded-xl shadow-md py-1 z-30 font-semibold text-[10px] sm:text-xs text-slate-700">
                        <button wire:click="setTimeframeDonut('this_month')" @click="timeframe = 'this_month'; open = false" class="w-full text-left px-3 py-2 hover:bg-slate-50 transition-colors font-extrabold">Bulan Ini</button>
                        <button wire:click="setTimeframeDonut('last_month')" @click="timeframe = 'last_month'; open = false" class="w-full text-left px-3 py-2 hover:bg-slate-50 transition-colors font-extrabold">Bulan Lalu</button>
                        <button wire:click="setTimeframeDonut('last_7_days')" @click="timeframe = 'last_7_days'; open = false" class="w-full text-left px-3 py-2 hover:bg-slate-50 transition-colors font-extrabold">7 Hari Terakhir</button>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-row items-center justify-between gap-4 mt-2">
                <!-- Donut Chart Container -->
                <div class="w-28 h-28 sm:w-36 sm:h-36 relative flex items-center justify-center shrink-0">
                    <canvas id="donutChartCanvas"></canvas>
                    <div class="absolute inset-0 flex flex-col items-center justify-center pointer-events-none">
                        <span class="text-[9px] text-slate-400 font-extrabold uppercase tracking-wider block">Total</span>
                        <span id="totalValText" class="text-sm sm:text-base font-black text-slate-800 tracking-tight block">
                            {{ number_format(($totalDeposit + $totalWithdrawal) / 1000, 0, ',', '.') }}K
                        </span>
                    </div>
                </div>
                
                <!-- Legends -->
                <div class="flex-1 space-y-4 text-left pl-4">
                    <!-- Setoran -->
                    <div class="space-y-0.5">
                        <div class="flex items-center space-x-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#10b981] shrink-0"></span>
                            <span class="text-[11px] sm:text-xs font-extrabold text-slate-800">Setoran</span>
                        </div>
                        <div class="pl-4.5">
                            <span id="setoranTextVal" class="text-xs sm:text-sm font-black text-slate-800 block">
                                {{ number_format($totalDeposit / 1000, 0, ',', '.') }}K
                            </span>
                            <span id="setoranPercentText" class="text-[9px] sm:text-[10px] text-slate-400 font-bold block">
                                @php
                                    $totalTx = $totalDeposit + $totalWithdrawal;
                                    $depPercent = $totalTx > 0 ? round(($totalDeposit / $totalTx) * 100) : 0;
                                    $withPercent = $totalTx > 0 ? 100 - $depPercent : 0;
                                @endphp
                                ({{ $depPercent }}%)
                            </span>
                        </div>
                    </div>
                    
                    <!-- Penarikan -->
                    <div class="space-y-0.5">
                        <div class="flex items-center space-x-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-[#ef4444] shrink-0"></span>
                            <span class="text-[11px] sm:text-xs font-extrabold text-slate-800">Penarikan</span>
                        </div>
                        <div class="pl-4.5">
                            <span id="penarikanTextVal" class="text-xs sm:text-sm font-black text-slate-800 block">
                                {{ number_format($totalWithdrawal / 1000, 0, ',', '.') }}K
                            </span>
                            <span id="penarikanPercentText" class="text-[9px] sm:text-[10px] text-slate-400 font-bold block">
                                ({{ $withPercent }}%)
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Trend Transaksi (Line Chart) -->
        <div x-data="trendChartComponent()" @trend-chart-updated.window="console.log('trend-chart-updated event caught:', $event.detail); updateData($event.detail)" wire:ignore class="bg-white border border-slate-100 rounded-3xl p-5 sm:p-6 shadow-xs flex flex-col justify-between space-y-4">
            <div class="flex items-center justify-between">
                <div class="space-y-1">
                    <h3 class="text-xs sm:text-sm font-black text-slate-800 uppercase tracking-wider">Trend Transaksi</h3>
                    <!-- Legends inside trend -->
                    <div class="flex items-center space-x-3 text-[10px] font-extrabold">
                        <div class="flex items-center space-x-1.5">
                            <span class="w-2.5 h-0.5 bg-[#10b981] rounded-full inline-block"></span>
                            <span class="text-slate-500">Setoran</span>
                        </div>
                        <div class="flex items-center space-x-1.5">
                            <span class="w-2.5 h-0.5 bg-[#ef4444] rounded-full inline-block"></span>
                            <span class="text-slate-500">Penarikan</span>
                        </div>
                    </div>
                </div>
                <!-- Timeframe Select Dropdown -->
                <div class="relative inline-block text-left z-20">
                    <button @click="open = !open" class="flex items-center space-x-1.5 px-3 py-1.5 bg-slate-50 border border-slate-100 text-slate-700 text-[10px] sm:text-xs font-extrabold rounded-xl hover:bg-slate-100 transition-colors cursor-pointer">
                        <span x-text="timeframe === 'this_month' ? 'Bulan Ini' : (timeframe === 'last_month' ? 'Bulan Lalu' : '7 Hari Terakhir')"></span>
                        <svg class="w-3 h-3 text-slate-500 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <!-- Dropdown list overlay -->
                    <div x-show="open" @click.outside="open = false" x-transition class="absolute right-0 mt-1.5 w-32 bg-white border border-slate-100 rounded-xl shadow-md py-1 z-30 font-semibold text-[10px] sm:text-xs text-slate-700">
                        <button wire:click="setTimeframeTrend('this_month')" @click="timeframe = 'this_month'; open = false" class="w-full text-left px-3 py-2 hover:bg-slate-50 transition-colors font-extrabold">Bulan Ini</button>
                        <button wire:click="setTimeframeTrend('last_month')" @click="timeframe = 'last_month'; open = false" class="w-full text-left px-3 py-2 hover:bg-slate-50 transition-colors font-extrabold">Bulan Lalu</button>
                        <button wire:click="setTimeframeTrend('last_7_days')" @click="timeframe = 'last_7_days'; open = false" class="w-full text-left px-3 py-2 hover:bg-slate-50 transition-colors font-extrabold">7 Hari Terakhir</button>
                    </div>
                </div>
            </div>
            
            <div class="w-full h-32 sm:h-36 relative mt-2">
                <canvas id="trendChartCanvas"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Transactions Section -->
    <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-xs relative z-10 space-y-5">
        <div class="flex items-center justify-between font-['Outfit']">
            <div class="flex items-center space-x-2.5">
                <div class="w-8 h-8 rounded-lg bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-700 shrink-0">
                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider">Aktivitas Transaksi Global Terbaru</h3>
            </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto -mx-6">
            <div class="inline-block min-w-full align-middle px-6">
                <table class="min-w-full divide-y divide-slate-100 text-left">
                    <thead>
                        <tr class="text-[10px] font-black text-slate-400 uppercase tracking-wider">
                            <th class="py-3.5 pr-4">Nama Siswa</th>
                            <th class="py-3.5 px-4">Kelas</th>
                            <th class="py-3.5 px-4">Jenis</th>
                            <th class="py-3.5 px-4">Nominal</th>
                            <th class="py-3.5 px-4 text-center">Status</th>
                            <th class="py-3.5 pl-4">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-xs text-slate-700 font-medium">
                        @forelse($recentTransactions as $transaction)
                            <tr class="hover:bg-slate-50/55 transition-colors">
                                <td class="py-4 pr-4 font-bold text-slate-800">
                                    {{ $transaction->student->name ?? 'Siswa Terhapus' }}
                                </td>
                                <td class="py-4 px-4 font-extrabold text-slate-500">
                                    {{ $transaction->student->class_name ?? '-' }}
                                </td>
                                <td class="py-4 px-4">
                                    @if($transaction->type === 'deposit')
                                        <span class="inline-flex items-center space-x-1 text-emerald-600 font-extrabold">
                                            <span>Setoran</span>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center space-x-1 text-rose-600 font-extrabold">
                                            <span>Penarikan</span>
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 font-black text-slate-800">
                                    Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                </td>
                                <td class="py-4 px-4 text-center">
                                    @if($transaction->status === 'approved')
                                        <span class="inline-flex items-center px-2.5 py-1 bg-emerald-50 border border-emerald-100 rounded-full text-[9px] font-extrabold text-emerald-700 uppercase tracking-wide">
                                            Sukses
                                        </span>
                                    @elseif($transaction->status === 'pending')
                                        <span class="inline-flex items-center px-2.5 py-1 bg-amber-50 border border-amber-100 rounded-full text-[9px] font-extrabold text-amber-750 uppercase tracking-wide">
                                            Pending
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 bg-rose-50 border border-rose-100 rounded-full text-[9px] font-extrabold text-rose-700 uppercase tracking-wide">
                                            Ditolak
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 pl-4 text-slate-400 font-semibold">
                                    {{ $transaction->created_at->format('d/m/Y H:i') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-8 text-center text-slate-400 font-semibold italic">
                                    Belum ada transaksi tercatat.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- View All Button -->
        <div class="pt-2 border-t border-slate-100 flex justify-center font-['Outfit']">
            <a href="/admin/riwayat" wire:navigate class="w-full text-center py-2.5 bg-slate-50 hover:bg-[#fff8e5] text-slate-700 hover:text-amber-850 font-extrabold rounded-2xl text-xs transition-all active:scale-[0.98] border border-slate-150/60 shadow-3xs cursor-pointer">
                Lihat Lebih Banyak
            </a>
        </div>
    </div>
</div>
