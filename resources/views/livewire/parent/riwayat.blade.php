<div wire:poll.25s class="-mx-4 -mt-4 sm:-mx-6 sm:-mt-6 md:-mx-8 md:-mt-8 p-4 sm:p-6 md:p-8 min-h-screen bg-[#ffd554] pb-28 md:pb-12 space-y-5 font-sans relative overflow-hidden">
    
    <!-- Leaf Decoration (Top Right background - Soft amber outline) -->
    <div class="absolute top-0 right-0 w-32 h-32 opacity-10 pointer-events-none translate-x-6 -translate-y-6 z-0">
        <svg class="w-full h-full text-amber-800" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17 2c-3.87 0-7 3.13-7 7 0 2.21 1.02 4.18 2.62 5.5L12 15c-.41.34-1.07.34-1.48 0L2.3 8.3c-.63-.5-1.52-.38-2 .25-.5.63-.38 1.52.25 2l8.22 6.7c1.39 1.13 3.47 1.13 4.86 0L22 10.3c.63-.5.75-1.39.25-2-.5-.63-1.39-.75-2-.25l-2.62 2.15C17.98 9.38 17 7.41 17 5V2z"/>
        </svg>
    </div>

    <!-- Header Welcome -->
    <div class="flex items-center justify-between relative z-10 pt-2">
        <div>
            <h2 class="text-xl font-extrabold text-slate-800 tracking-tight font-['Outfit']">Riwayat Transaksi</h2>
            <p class="text-xs text-slate-700 font-medium">Laporan lengkap mutasi saldo tabungan anak</p>
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- FILTER BAR CARD                                          -->
    <!-- ======================================================== -->
    <div class="bg-white border border-slate-100 rounded-2xl p-4 shadow-xs space-y-4 relative z-30">
        <!-- Search Input -->
        <div class="relative">
            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </span>
            <input type="text" 
                   wire:model.live.debounce.300ms="search" 
                   class="w-full pl-9 pr-4 py-2.5 rounded-xl border border-slate-300 hover:border-amber-400 focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-white transition-colors text-xs shadow-3xs" 
                   placeholder="Cari alasan penarikan...">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <!-- Filter Type Tab Buttons -->
            <div class="bg-slate-100/80 p-1 rounded-xl flex space-x-1">
                <button type="button" 
                        wire:click="$set('filter_type', 'all')" 
                        class="flex-1 py-1.5 text-[11px] font-bold rounded-lg cursor-pointer transition-all {{ $filter_type === 'all' ? 'bg-white text-slate-900 shadow-xs' : 'text-slate-500 hover:text-slate-800' }}">
                    Semua
                </button>
                <button type="button" 
                        wire:click="$set('filter_type', 'deposit')" 
                        class="flex-1 py-1.5 text-[11px] font-bold rounded-lg cursor-pointer transition-all {{ $filter_type === 'deposit' ? 'bg-white text-green-700 shadow-xs' : 'text-slate-500 hover:text-slate-800' }}">
                    Setoran
                </button>
                <button type="button" 
                        wire:click="$set('filter_type', 'withdrawal')" 
                        class="flex-1 py-1.5 text-[11px] font-bold rounded-lg cursor-pointer transition-all {{ $filter_type === 'withdrawal' ? 'bg-white text-rose-700 shadow-xs' : 'text-slate-500 hover:text-slate-800' }}">
                    Penarikan
                </button>
            </div>

            <!-- Custom Alpine.js Dropdown for Time Filter -->
            <div class="relative" x-data="{ open: false }">
                <button type="button" 
                        @click="open = !open" 
                        class="w-full pl-4 pr-10 py-2.5 rounded-xl border border-slate-200 text-xs font-bold text-slate-600 bg-white hover:bg-slate-50 cursor-pointer flex items-center justify-between transition-all focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10">
                    <span>
                        @if($filter_time === 'all')
                            Semua Waktu
                        @elseif($filter_time === 'month')
                            Bulan Ini
                        @else
                            3 Bulan Terakhir
                        @endif
                    </span>
                    <svg class="w-4 h-4 text-slate-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                
                <!-- Dropdown Menu Options -->
                <div x-show="open" 
                     @click.away="open = false"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute z-50 mt-1.5 w-full rounded-xl bg-white border border-slate-100 shadow-xl py-1 text-xs"
                     style="display: none;">
                    
                    <button type="button" 
                            wire:click="$set('filter_time', 'all')"
                            @click="open = false"
                            class="w-full text-left px-4 py-2 hover:bg-amber-50 hover:text-amber-700 font-semibold text-slate-600 cursor-pointer transition-colors block {{ $filter_time === 'all' ? 'text-amber-700 bg-amber-50/50' : '' }}">
                        Semua Waktu
                    </button>
                    
                    <button type="button" 
                            wire:click="$set('filter_time', 'month')"
                            @click="open = false"
                            class="w-full text-left px-4 py-2 hover:bg-amber-50 hover:text-amber-700 font-semibold text-slate-600 cursor-pointer transition-colors block {{ $filter_time === 'month' ? 'text-amber-700 bg-amber-50/50' : '' }}">
                        Bulan Ini
                    </button>
                    
                    <button type="button" 
                            wire:click="$set('filter_time', '3months')"
                            @click="open = false"
                            class="w-full text-left px-4 py-2 hover:bg-amber-50 hover:text-amber-700 font-semibold text-slate-600 cursor-pointer transition-colors block {{ $filter_time === '3months' ? 'text-amber-700 bg-amber-50/50' : '' }}">
                        3 Bulan Terakhir
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- GROUPED LIST VIEW                                        -->
    <!-- ======================================================== -->
    <div class="space-y-4 relative z-10">
        @forelse($groupedTransactions as $month => $txs)
            <!-- Month Divider Subtitle -->
            <div class="flex justify-between items-center px-1">
                <span class="text-xs font-bold text-slate-700 uppercase tracking-wider">{{ $month }}</span>
                <span class="text-[10px] font-bold text-slate-800 bg-slate-900/10 px-2 py-0.5 rounded-full">{{ $totalTransactionsCount }} Transaksi</span>
            </div>

            <!-- Month Card Container -->
            <div class="bg-white border border-slate-100 rounded-2xl p-5 shadow-xs space-y-4">
                @foreach($txs as $tx)
                    <div wire:click="selectTransaction({{ $tx->id }})" 
                          class="flex items-center justify-between cursor-pointer hover:bg-slate-50 p-2.5 -mx-2.5 rounded-xl transition-all duration-200 {{ !$loop->last ? 'pb-4 border-b border-slate-100' : '' }}">
                        
                        <div class="flex items-center space-x-3.5">
                            <!-- Icon type -->
                            @if($tx->type === 'deposit')
                                <div class="w-10 h-10 rounded-full bg-green-50 border border-green-100 flex items-center justify-center text-green-600 shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m0 0l6.75-6.75M12 19.5l-6.75-6.75" />
                                    </svg>
                                </div>
                            @else
                                <div class="w-10 h-10 rounded-full bg-rose-50 border border-rose-100 flex items-center justify-center text-rose-600 shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19.5V4.5m0 0l6.75 6.75M12 4.5L5.25 11.25" />
                                    </svg>
                                </div>
                            @endif
                            
                            <div>
                                <h5 class="text-sm font-bold text-slate-800 tracking-tight">
                                    {{ $tx->type === 'deposit' ? 'Setoran Tabungan' : 'Penarikan Saldo' }}
                                </h5>
                                <p class="text-[11px] text-gray-400 font-medium">
                                    {{ $tx->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="text-right">
                            <span class="text-sm font-extrabold block tracking-tight {{ $tx->type === 'deposit' ? 'text-green-600' : 'text-rose-600' }}">
                                {{ $tx->type === 'deposit' ? '+' : '-' }} Rp {{ number_format($tx->amount, 0, ',', '.') }}
                            </span>
                            
                            <!-- Status Badge -->
                            @if($tx->status === 'approved')
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-bold bg-green-50 text-green-700 border border-green-200/50 mt-1">
                                    Sukses
                                </span>
                            @elseif($tx->status === 'pending')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[9px] font-bold bg-amber-50 text-amber-700 border border-amber-200/50 mt-1">
                                    Pending
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[9px] font-bold bg-rose-50 text-rose-700 border border-rose-200/50 mt-1">
                                    Ditolak
                                </span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @empty
            <!-- Empty State -->
            <div class="bg-white border border-slate-100 rounded-2xl p-10 text-center shadow-xs">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                </svg>
                <p class="text-sm text-gray-400 font-bold">Tidak menemukan hasil transaksi</p>
                <p class="text-xs text-gray-400 mt-1 font-medium">Coba sesuaikan kata kunci pencarian atau filter Anda</p>
            </div>
        @endforelse

        <!-- Pagination controls -->
        @if($transactions->hasPages())
            <div class="bg-white border border-slate-100 rounded-2xl p-4 shadow-xs flex items-center justify-between font-['Outfit'] relative z-10">
                <button 
                    type="button" 
                    wire:click="previousPage" 
                    wire:loading.attr="disabled"
                    class="px-4 py-2 bg-slate-50 border border-slate-200 hover:bg-slate-100 text-slate-700 font-extrabold rounded-xl text-xs transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer flex items-center space-x-1"
                    {{ $transactions->onFirstPage() ? 'disabled' : '' }}
                >
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                    </svg>
                    <span>Sebelumnya</span>
                </button>

                <span class="text-xs font-bold text-slate-500">
                    Halaman {{ $transactions->currentPage() }} dari {{ $transactions->lastPage() }}
                </span>

                <button 
                    type="button" 
                    wire:click="nextPage" 
                    wire:loading.attr="disabled"
                    class="px-4 py-2 bg-slate-50 border border-slate-200 hover:bg-slate-100 text-slate-700 font-extrabold rounded-xl text-xs transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed cursor-pointer flex items-center space-x-1"
                    {{ !$transactions->hasMorePages() ? 'disabled' : '' }}
                >
                    <span>Selanjutnya</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>
        @endif
    </div>

    <!-- ======================================================== -->
    <!-- MODAL POPUP: TRANSACTION DETAIL                          -->
    <!-- ======================================================== -->
    @if($show_detail_modal && $selectedTx)
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-[100] flex items-end sm:items-center justify-center p-4">
             
            <!-- Modal Body Container -->
            <div class="bg-white rounded-t-3xl sm:rounded-2xl w-full max-w-sm p-6 shadow-2xl relative text-left"
                 @click.away="@this.call('closeDetailModal')">
                 
                 <!-- Modal Header -->
                 <div class="flex justify-between items-center mb-5">
                     <h3 class="text-base font-bold text-slate-800 font-['Outfit']">Detail Transaksi</h3>
                     <button wire:click="closeDetailModal" class="text-slate-400 hover:text-slate-600 focus:outline-hidden cursor-pointer">
                          <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                          </svg>
                     </button>
                 </div>
                 
                 <!-- Modal Details -->
                 <div class="space-y-4">
                     <!-- Code Ref -->
                     <div class="flex justify-between items-center">
                          <span class="text-xs text-slate-500 font-semibold">Ref ID</span>
                          <span class="text-xs font-mono font-bold text-slate-800 bg-slate-50 px-2.5 py-1 rounded-lg border border-slate-100">#TX-{{ str_pad($selectedTx->id, 6, '0', STR_PAD_LEFT) }}</span>
                     </div>

                     <!-- Date -->
                     <div class="flex justify-between items-center">
                          <span class="text-xs text-slate-500 font-semibold">Tanggal & Jam</span>
                          <span class="text-xs font-bold text-slate-800">{{ $selectedTx->created_at->format('d F Y, H:i') }} WIB</span>
                     </div>

                     <!-- Transaction Type -->
                     <div class="flex justify-between items-center">
                          <span class="text-xs text-slate-500 font-semibold">Jenis Transaksi</span>
                          <span class="text-xs font-bold {{ $selectedTx->type === 'deposit' ? 'text-green-700 bg-green-50 border border-green-200/50' : 'text-rose-700 bg-rose-50 border border-rose-200/50' }} px-2.5 py-0.5 rounded-full">
                              {{ $selectedTx->type === 'deposit' ? 'Setoran Masuk' : 'Penarikan Keluar' }}
                          </span>
                     </div>

                     <!-- Amount -->
                     <div class="flex justify-between items-center">
                          <span class="text-xs text-slate-500 font-semibold">Jumlah Uang</span>
                          <span class="text-sm font-extrabold text-slate-800">Rp {{ number_format($selectedTx->amount, 0, ',', '.') }}</span>
                     </div>

                     <!-- Status -->
                     <div class="flex justify-between items-center">
                          <span class="text-xs text-slate-500 font-semibold">Status</span>
                          @if($selectedTx->status === 'approved')
                              <span class="text-xs font-bold text-green-700 bg-green-50 border border-green-200/50 px-2.5 py-0.5 rounded-full">Disetujui</span>
                          @elseif($selectedTx->status === 'pending')
                              <span class="text-xs font-bold text-amber-700 bg-amber-50 border border-amber-200/50 px-2.5 py-0.5 rounded-full">Menunggu Persetujuan</span>
                          @else
                              <span class="text-xs font-bold text-rose-700 bg-rose-50 border border-rose-200/50 px-2.5 py-0.5 rounded-full">Ditolak</span>
                          @endif
                     </div>

                     <!-- Reason/Notes -->
                     <div class="border-t border-slate-100 pt-3">
                          <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-1">Catatan / Alasan</span>
                          <p class="text-xs font-semibold text-slate-800 bg-slate-50 p-2.5 rounded-xl border border-slate-100 leading-relaxed">
                              {{ $selectedTx->notes ?? 'Tidak ada catatan transaksi' }}
                          </p>
                     </div>

                     <!-- Verifier / Admin info -->
                     <div class="flex justify-between items-center text-[10px] text-slate-400 font-bold uppercase tracking-wider pt-1.5">
                          <span>Verifikator</span>
                          <span class="text-slate-600">
                              {{ $selectedTx->user ? $selectedTx->user->name : ($selectedTx->status === 'pending' ? 'Belum Diverifikasi' : 'Sistem Otomatis') }}
                          </span>
                     </div>
                 </div>

                 <!-- Close button -->
                 <button wire:click="closeDetailModal" 
                         class="w-full mt-6 py-2.5 bg-[#ffd554] hover:bg-[#e5bf43] text-slate-900 text-xs font-extrabold rounded-xl cursor-pointer transition-colors active:scale-[0.98]">
                     Tutup Detail
                 </button>
            </div>
        </div>
    @endif

</div>
