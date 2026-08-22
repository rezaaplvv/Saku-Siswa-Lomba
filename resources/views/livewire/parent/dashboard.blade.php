<div wire:poll.25s x-data="{ showModal: false, showBalance: true }" @close-modal.window="showModal = false" class="-mx-4 -mt-4 sm:-mx-6 sm:-mt-6 md:-mx-8 md:-mt-8 p-4 sm:p-6 md:p-8 min-h-screen bg-[#ffd554] pb-28 md:pb-12 space-y-5 font-sans relative overflow-hidden">
    
    <!-- Leaf Decoration (Top Right background) -->
    <div class="absolute top-0 right-0 w-32 h-32 opacity-10 pointer-events-none translate-x-6 -translate-y-6 z-0">
        <svg class="w-full h-full text-amber-800" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17 2c-3.87 0-7 3.13-7 7 0 2.21 1.02 4.18 2.62 5.5L12 15c-.41.34-1.07.34-1.48 0L2.3 8.3c-.63-.5-1.52-.38-2 .25-.5.63-.38 1.52.25 2l8.22 6.7c1.39 1.13 3.47 1.13 4.86 0L22 10.3c.63-.5.75-1.39.25-2-.5-.63-1.39-.75-2-.25l-2.62 2.15C17.98 9.38 17 7.41 17 5V2z"/>
        </svg>
    </div>

    <!-- Header Welcome -->
    <div class="flex items-center justify-between relative z-10 pt-2">
        <div>
            <h2 class="text-xl font-extrabold text-slate-800 tracking-tight font-['Outfit']">Halo, Orang Tua</h2>
            <p class="text-xs text-slate-700 font-medium">Pantau tabungan buah hati Anda</p>
        </div>
        <div class="w-10 h-10 rounded-full bg-white/95 p-0.5 shadow-xs border border-slate-100/80 shrink-0 overflow-hidden">
            <img src="/assets/{{ $student->avatar ?? 'i1.png' }}" alt="Profile Avatar" class="w-full h-full object-cover rounded-full">
        </div>
    </div>

    <!-- Floating Success Toast / Pop-up -->
    @if(session()->has('message'))
        <div 
            x-data="{ show: true }" 
            x-show="show"
            x-init="setTimeout(() => show = false, 3500)"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
            x-transition:leave-end="opacity-0 scale-90 translate-y-4"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-xs font-sans"
        >
            <div class="bg-white rounded-3xl p-6 max-w-xs w-full shadow-2xl border border-slate-100 text-center font-['Outfit'] space-y-4 relative animate-scaleIn">
                <!-- Circular Checkmark Icon -->
                <div class="w-16 h-16 rounded-full bg-emerald-50 border-4 border-emerald-100 flex items-center justify-center text-emerald-600 mx-auto animate-bounce">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </div>
                
                <!-- Success Text -->
                <div class="space-y-1.5">
                    <h3 class="text-sm font-black text-slate-800">Berhasil!</h3>
                    <p class="text-xs text-slate-500 font-semibold leading-relaxed">
                        {{ session('message') }}
                    </p>
                </div>
                
                <!-- Dismiss button -->
                <button 
                    @click="show = false" 
                    class="w-full py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-extrabold rounded-xl text-xs transition-all active:scale-[0.98] cursor-pointer"
                >
                    Tutup
                </button>
            </div>
        </div>
    @endif

    <!-- Alert: Active Pending Withdrawal Request -->
    @if ($pending_withdrawal)
        <div class="bg-amber-50 border border-amber-200 text-amber-900 p-4 rounded-2xl text-xs font-semibold leading-relaxed flex items-start space-x-3 shadow-xs relative z-10">
            <svg class="w-5 h-5 text-amber-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <div>
                <span class="font-extrabold text-amber-800">Pengajuan Berjalan:</span> Anda memiliki 1 pengajuan penarikan sebesar <span class="font-extrabold text-amber-950">Rp {{ number_format($pending_withdrawal->amount, 0, ',', '.') }}</span> yang sedang menunggu persetujuan Guru Kelas.
            </div>
        </div>
    @endif

    <!-- ======================================================== -->
    <!-- MOBILE VIEW ONLY (< md): ORIGINAL MOBILE LAYOUT          -->
    <!-- ======================================================== -->
    <div class="block md:hidden space-y-5 relative z-10 font-sans">
        
        <!-- 1. Balance Card (Original Dark Metal Card) -->
        <div class="relative bg-gradient-to-br from-slate-900 via-slate-800 to-slate-950 rounded-3xl p-6 text-white shadow-xl overflow-hidden border border-slate-700/30 min-h-[175px]">
            <div class="absolute -top-12 -right-12 w-40 h-40 bg-white/5 rounded-full blur-2xl pointer-events-none z-0"></div>
            <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-[#65b33b]/10 rounded-full blur-xl pointer-events-none z-0"></div>
            
            <div class="absolute -right-6 -bottom-9 w-[70%] h-64 flex items-center justify-end pointer-events-none z-0">
                <img src="/assets/uang.png" alt="Saldo" class="w-64 h-64 object-contain translate-y-3">
            </div>
            
            <div class="relative z-10 flex flex-col justify-between min-h-[127px] w-[65%]">
                <div>
                    <div class="flex items-center space-x-2">
                        <p class="text-[10px] text-slate-400 font-extrabold tracking-wider uppercase">Total Saldo Aktif</p>
                        <button type="button" @click="showBalance = !showBalance" class="focus:outline-hidden cursor-pointer" title="Tampilkan/Sembunyikan Saldo">
                            <template x-if="showBalance">
                                <svg class="w-4 h-4 text-slate-400 hover:text-slate-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.43 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </template>
                            <template x-if="!showBalance">
                                <svg class="w-4 h-4 text-slate-400 hover:text-slate-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </template>
                        </button>
                    </div>
                    <h3 class="text-2xl font-extrabold mt-1 font-['Outfit'] tracking-tight">
                        <span x-show="showBalance">Rp {{ number_format($student->balance, 0, ',', '.') }}</span>
                        <span x-show="!showBalance" style="display: none;">Rp ••••••</span>
                    </h3>
                </div>
                
                <div class="grid grid-cols-2 gap-4 border-t border-slate-800/80 pt-3 mt-3">
                    <div>
                        <p class="text-[9px] text-slate-500 uppercase font-extrabold tracking-wider">Pemilik Akun</p>
                        <div class="flex items-center space-x-2 mt-1.5">
                            <div class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center shrink-0 overflow-hidden">
                                <img src="/assets/{{ $student->avatar ?? 'i1.png' }}" alt="Profile" class="w-full h-full object-cover rounded-full">
                            </div>
                            <p class="text-xs font-bold tracking-tight text-slate-200">{{ $student->name }}</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-[9px] text-slate-500 uppercase font-extrabold tracking-wider">Kelas</p>
                        <p class="text-xs font-bold mt-2.5 tracking-tight text-slate-200">{{ $student->class_name }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Setoran vs Penarikan (Pastel Split 2-Column Cards) -->
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-[#f0fdf4] border border-green-200/50 rounded-2xl p-4 shadow-xs flex items-center space-x-3">
                <div class="w-9 h-9 rounded-xl bg-green-100 flex items-center justify-center text-green-700 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] text-green-700 font-bold uppercase tracking-wider">Total Ditabung</p>
                    <p class="text-sm font-extrabold text-slate-800 mt-0.5">Rp {{ number_format($total_deposits, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="bg-[#fff1f2] border border-rose-200/50 rounded-2xl p-4 shadow-xs flex items-center space-x-3">
                <div class="w-9 h-9 rounded-xl bg-rose-100 flex items-center justify-center text-rose-700 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] text-rose-700 font-bold uppercase tracking-wider">Total Ditarik</p>
                    <p class="text-sm font-extrabold text-slate-800 mt-0.5">Rp {{ number_format($total_withdrawals, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <!-- 3. Informasi Identitas Siswa Card (With Ajukan Penarikan Button) -->
        <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-xs relative z-10">
            <div class="mb-4">
                <h4 class="text-xs font-extrabold text-slate-800 uppercase tracking-wider font-['Outfit']">Informasi Identitas Siswa</h4>
            </div>

            <div class="space-y-1">
                <div class="flex items-center justify-between py-3.5 border-b border-slate-100">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        <span class="text-xs font-semibold text-slate-500">Nama Lengkap</span>
                    </div>
                    <span class="text-xs font-extrabold text-slate-900 tracking-tight">{{ $student->name }}</span>
                </div>

                <div class="flex items-center justify-between py-3.5 border-b border-slate-100">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="16" rx="3" stroke-width="2" />
                            <circle cx="9" cy="10" r="2" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 16c0-1.8 1.5-2.5 3-2.5s3 .7 3 2.5" />
                            <line x1="14" y1="9" x2="18" y2="9" stroke-linecap="round" />
                            <line x1="14" y1="12.5" x2="18" y2="12.5" stroke-linecap="round" />
                            <line x1="14" y1="16" x2="16.5" y2="16" stroke-linecap="round" />
                        </svg>
                        <span class="text-xs font-semibold text-slate-500">NISN</span>
                    </div>
                    <span class="text-xs font-mono font-extrabold text-slate-900">{{ $student->nisn }}</span>
                </div>

                <div class="flex items-center justify-between py-3.5">
                    <div class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13.18v4L12 21l7-3.82v-4" />
                        </svg>
                        <span class="text-xs font-semibold text-slate-500">Kelas</span>
                    </div>
                    <span class="text-xs font-extrabold text-slate-900">{{ $student->class_name }}</span>
                </div>
            </div>

            <button @click="showModal = true" class="w-full mt-5 py-3.5 bg-[#ffd554] hover:bg-[#e5bf43] text-slate-900 text-sm font-extrabold rounded-2xl shadow-md shadow-amber-500/10 active:scale-[0.99] transition-all flex items-center justify-center space-x-2 cursor-pointer">
                <span>Ajukan Penarikan Saldo</span>
                <svg class="w-4 h-4 text-slate-900" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </button>
        </div>

        <!-- 4. Target Tabungan Anak Card -->
        @php
            $percentage = $student->saving_target > 0 ? min(100, round(($student->balance / $student->saving_target) * 100)) : 0;
        @endphp
        <div class="bg-gradient-to-br from-[#fffdf3] to-[#fffbeb] border border-amber-200/50 rounded-3xl p-5 shadow-xs relative z-10">
            <div class="flex justify-between items-center mb-3">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-amber-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="10" />
                        <circle cx="12" cy="12" r="6" />
                        <circle cx="12" cy="12" r="2" />
                    </svg>
                    <h4 class="text-xs font-bold text-slate-800 uppercase tracking-wider font-['Outfit']">Target Tabungan Anak</h4>
                    @if($percentage >= 100)
                        <span class="inline-flex items-center px-1.5 py-0.5 rounded-md text-[8px] font-extrabold bg-emerald-100 text-emerald-800 border border-emerald-200/50 uppercase tracking-wider">Tercapai</span>
                    @endif
                </div>
                
                @if(!$is_editing_target)
                    <button wire:click="startEditTarget" class="text-xs font-bold text-amber-600 hover:underline flex items-center space-x-1 cursor-pointer">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                        </svg>
                        <span>Ubah</span>
                    </button>
                @endif
            </div>
            
            @if($is_editing_target)
                <div class="mb-4 p-3 bg-white/80 border border-amber-100 rounded-xl space-y-2">
                    <label class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Set Target Baru</label>
                    <div class="flex items-center space-x-2">
                        <div class="relative flex-1">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400 text-xs font-semibold">Rp</span>
                            <input type="number" 
                                   wire:model="new_target" 
                                   class="w-full pl-8 pr-3 py-2 rounded-lg border border-slate-200 text-xs focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-white" 
                                   placeholder="Contoh: 500000"
                                   required>
                        </div>
                        <button wire:click="saveTarget" class="px-3.5 py-2 bg-[#ffd554] hover:bg-[#e5bf43] text-slate-900 text-xs font-extrabold rounded-lg cursor-pointer transition-colors">
                            Simpan
                        </button>
                        <button wire:click="$set('is_editing_target', false)" class="px-3.5 py-2 bg-slate-200 hover:bg-slate-300 text-slate-600 text-xs font-bold rounded-lg cursor-pointer transition-colors">
                            Batal
                        </button>
                    </div>
                </div>
            @endif

            <div class="w-full bg-slate-200/60 rounded-full h-2.5 overflow-hidden">
                <div class="{{ $percentage >= 100 ? 'bg-emerald-500' : 'bg-amber-500' }} h-2.5 rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
            </div>
            
            <div class="flex justify-between items-center mt-3 text-xs text-slate-600 font-semibold leading-relaxed">
                <span>Mencapai Rp {{ number_format($student->balance, 0, ',', '.') }}</span>
                <span>Target: Rp {{ number_format($student->saving_target, 0, ',', '.') }} ({{ $percentage }}%)</span>
            </div>
        </div>

        <!-- 5. 3 Transaksi Terakhir Card -->
        <div class="space-y-3">
            <div class="flex justify-between items-center">
                <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider">3 Transaksi Terakhir</h4>
                <a href="/parent/riwayat" wire:navigate class="text-xs font-bold text-amber-700 hover:underline transition-all">Lihat Semua</a>
            </div>
            
            <div class="bg-white border border-slate-100 rounded-2xl p-5 shadow-xs space-y-4">
                @forelse($transactions as $tx)
                    <div class="flex items-center justify-between {{ !$loop->last ? 'pb-4 border-b border-slate-100' : '' }}">
                        <div class="flex items-center space-x-3.5">
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
                            
                            @if($tx->status === 'approved')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[9px] font-bold bg-green-50 text-green-700 border border-green-200/50 mt-1">
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
                @empty
                    <div class="py-4 text-center">
                        <p class="text-xs text-gray-400 font-medium">Belum ada riwayat transaksi</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- 6. Tips Hari Ini Card -->
        <div class="bg-[#fffbeb] border border-amber-200/60 rounded-2xl p-5 shadow-xs text-slate-800">
            <div class="flex items-center space-x-2.5 mb-2.5">
                <div class="w-7 h-7 rounded-lg bg-amber-100 flex items-center justify-center text-amber-700 shrink-0">
                    <svg class="w-4 h-4 text-amber-700" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                        <path d="M12 2a6 6 0 0 0-6 6c0 2.21 1.2 4.14 3 5.18V16a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-2.82c1.8-1.04 3-2.97 3-5.18a6 6 0 0 0-6-6z" />
                        <line x1="10" y1="20" x2="14" y2="20" />
                    </svg>
                </div>
                <h5 class="text-xs font-extrabold text-amber-800 uppercase tracking-wider">Tips Hari Ini</h5>
            </div>
            <p class="text-xs text-amber-950/90 font-medium leading-relaxed">
                Ajarkan anak membagi uang sakunya menjadi tiga bagian utama: untuk jajan (spending), untuk ditabung (saving), dan untuk berbagi (sharing).
            </p>
        </div>
    </div>


    <!-- ======================================================== -->
    <!-- DESKTOP VIEW ONLY (>= md): OPTION 1 LAYOUT               -->
    <!-- ======================================================== -->
    <div class="hidden md:block space-y-5 relative z-10 font-['Outfit']">
        
        <!-- BARIS 1: FULL-WIDTH DARK SLATE HERO CARD -->
        <div class="relative overflow-hidden bg-slate-900 border border-slate-800 rounded-3xl p-6 sm:p-7 shadow-xl text-white min-h-[185px] flex items-center justify-between">
            <div class="absolute -top-12 -right-12 w-48 h-48 bg-amber-500/10 rounded-full blur-2xl pointer-events-none z-0"></div>
            <div class="absolute -bottom-8 -left-8 w-40 h-40 bg-emerald-500/10 rounded-full blur-xl pointer-events-none z-0"></div>
            
            <div class="space-y-3 relative z-10 max-w-[65%] sm:max-w-[70%]">
                <div>
                    <div class="flex items-center space-x-2">
                        <p class="text-[10px] sm:text-xs text-slate-400 font-extrabold tracking-wider uppercase">Total Saldo Aktif</p>
                        <button type="button" @click="showBalance = !showBalance" class="focus:outline-hidden cursor-pointer" title="Tampilkan/Sembunyikan Saldo">
                            <template x-if="showBalance">
                                <svg class="w-4 h-4 text-slate-400 hover:text-white transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.43 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </template>
                            <template x-if="!showBalance">
                                <svg class="w-4 h-4 text-slate-400 hover:text-white transition-colors" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </template>
                        </button>
                    </div>

                    <h3 class="text-2xl sm:text-3xl md:text-4xl font-extrabold tracking-tight pt-0.5">
                        <span x-show="showBalance">Rp {{ number_format($student->balance, 0, ',', '.') }}</span>
                        <span x-show="!showBalance" style="display: none;">Rp ••••••</span>
                    </h3>
                </div>

                <div class="flex flex-wrap items-center gap-2 pt-1">
                    <div class="inline-flex items-center space-x-2 bg-white/10 backdrop-blur-xs px-3 py-1 rounded-full text-xs font-bold text-slate-200">
                        <div class="w-5 h-5 rounded-full bg-white flex items-center justify-center shrink-0 overflow-hidden">
                            <img src="/assets/{{ $student->avatar ?? 'i1.png' }}" alt="Avatar" class="w-full h-full object-cover">
                        </div>
                        <span class="truncate max-w-[130px] text-white">{{ $student->name }}</span>
                        <span class="text-slate-500">•</span>
                        <span class="text-[#ffd554] font-extrabold">{{ $student->class_name }}</span>
                    </div>

                    <button @click="showModal = true" class="inline-flex items-center space-x-2 px-4 py-1.5 bg-[#ffd554] hover:bg-[#e5bf43] text-slate-950 font-black rounded-full text-xs transition-all shadow-md active:scale-95 cursor-pointer">
                        <span>Ajukan Penarikan Saldo</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Right 3D Wallet Graphic (Centered Vertically Top-to-Bottom) -->
            <div class="absolute right-0 sm:right-4 top-1/2 -translate-y-1/2 w-48 h-48 sm:w-64 sm:h-64 md:w-76 md:h-76 pointer-events-none z-0 flex items-center justify-end">
                <img src="/assets/uang.png" alt="Wallet Illustration" class="w-full h-full object-contain object-right-center">
            </div>
        </div>

        <!-- BARIS 2: 3 MINI SUMMARY CARDS (GRID 3 COLUMNS) -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            
            <div class="bg-[#f0fdf4] border border-emerald-200/60 rounded-2xl sm:rounded-3xl p-4.5 shadow-xs flex items-center justify-between">
                <div class="space-y-0.5">
                    <span class="text-[9px] sm:text-[10px] text-emerald-800 font-extrabold uppercase tracking-wider block">Total Ditabung</span>
                    <span class="text-base sm:text-lg font-black text-slate-800 block">Rp {{ number_format($total_deposits, 0, ',', '.') }}</span>
                </div>
                <div class="w-10 h-10 rounded-2xl bg-emerald-100 border border-emerald-200/80 flex items-center justify-center text-emerald-700 shrink-0 shadow-3xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
                    </svg>
                </div>
            </div>

            <div class="bg-[#fff1f2] border border-rose-200/60 rounded-2xl sm:rounded-3xl p-4.5 shadow-xs flex items-center justify-between">
                <div class="space-y-0.5">
                    <span class="text-[9px] sm:text-[10px] text-rose-800 font-extrabold uppercase tracking-wider block">Total Ditarik</span>
                    <span class="text-base sm:text-lg font-black text-slate-800 block">Rp {{ number_format($total_withdrawals, 0, ',', '.') }}</span>
                </div>
                <div class="w-10 h-10 rounded-2xl bg-rose-100 border border-rose-200/80 flex items-center justify-center text-rose-700 shrink-0 shadow-3xs">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" />
                    </svg>
                </div>
            </div>

            <div class="bg-gradient-to-br from-[#fffdf3] to-[#fffbeb] border border-amber-200/70 rounded-2xl sm:rounded-3xl p-4.5 shadow-xs space-y-2 flex flex-col justify-between">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-1.5">
                        <svg class="w-4 h-4 text-amber-600 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <circle cx="12" cy="12" r="6" />
                            <circle cx="12" cy="12" r="2" />
                        </svg>
                        <span class="text-[10px] font-extrabold text-slate-800 uppercase tracking-wider">Target Tabungan</span>
                    </div>

                    @if(!$is_editing_target)
                        <button wire:click="startEditTarget" class="text-[11px] font-extrabold text-amber-600 hover:underline flex items-center space-x-1 cursor-pointer">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                            </svg>
                            <span>Ubah</span>
                        </button>
                    @endif
                </div>

                @if($is_editing_target)
                    <div class="p-2.5 bg-white/90 border border-amber-200 rounded-xl space-y-2">
                        <div class="flex items-center space-x-1.5">
                            <div class="relative flex-1">
                                <span class="absolute inset-y-0 left-0 pl-2.5 flex items-center text-slate-400 text-xs font-semibold">Rp</span>
                                <input type="number" 
                                       wire:model="new_target" 
                                       class="w-full pl-7 pr-2 py-1.5 rounded-lg border border-slate-200 text-xs font-bold focus:outline-hidden focus:border-amber-500 bg-white" 
                                       placeholder="Target Baru"
                                       required>
                            </div>
                            <button wire:click="saveTarget" class="px-2.5 py-1.5 bg-[#ffd554] hover:bg-[#e5bf43] text-slate-900 text-xs font-extrabold rounded-lg cursor-pointer">
                                Simpan
                            </button>
                            <button wire:click="$set('is_editing_target', false)" class="px-2 py-1.5 bg-slate-200 text-slate-600 text-xs font-bold rounded-lg cursor-pointer">
                                X
                            </button>
                        </div>
                    </div>
                @else
                    <div class="space-y-1.5">
                        <div class="w-full bg-slate-200/80 rounded-full h-2 overflow-hidden">
                            <div class="{{ $percentage >= 100 ? 'bg-emerald-500' : 'bg-amber-500' }} h-full rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
                        </div>
                        <div class="flex justify-between items-center text-[10px] text-slate-600 font-bold">
                            <span>Target: Rp {{ number_format($student->saving_target, 0, ',', '.') }}</span>
                            <span class="text-amber-700 font-black">{{ $percentage }}%</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- BARIS 3: GRID 2-KOLOM SIMETRIS (60% LEFT, 40% RIGHT) -->
        <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-start">
            
            <div class="md:col-span-7 space-y-4">
                <div class="bg-white border border-slate-100 rounded-3xl p-5 sm:p-6 shadow-xs space-y-4">
                    <div class="flex justify-between items-center pb-1 border-b border-slate-100">
                        <div class="flex items-center space-x-2">
                            <div class="w-6 h-6 rounded-lg bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 shrink-0">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h4 class="text-xs font-extrabold text-slate-800 uppercase tracking-wider">3 Transaksi Terakhir</h4>
                        </div>
                        <a href="/parent/riwayat" wire:navigate class="text-xs font-extrabold text-amber-600 hover:underline transition-all">Lihat Semua →</a>
                    </div>

                    <div class="space-y-3.5">
                        @forelse($transactions as $tx)
                            <div class="flex items-center justify-between p-3 rounded-2xl bg-slate-50/70 border border-slate-100 hover:bg-slate-50 transition-colors">
                                <div class="flex items-center space-x-3">
                                    @if($tx->type === 'deposit')
                                        <div class="w-9 h-9 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0">
                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
                                            </svg>
                                        </div>
                                    @else
                                        <div class="w-9 h-9 rounded-xl bg-rose-100 text-rose-700 flex items-center justify-center shrink-0">
                                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" />
                                            </svg>
                                        </div>
                                    @endif
                                    
                                    <div>
                                        <h5 class="text-xs font-extrabold text-slate-800">
                                            {{ $tx->type === 'deposit' ? 'Setoran Tabungan' : 'Penarikan Saldo' }}
                                        </h5>
                                        <p class="text-[10px] text-slate-400 font-semibold">
                                            {{ $tx->created_at->format('d M Y, H:i') }}
                                        </p>
                                    </div>
                                </div>
                                
                                <div class="text-right">
                                    <span class="text-xs font-black block {{ $tx->type === 'deposit' ? 'text-emerald-600' : 'text-rose-600' }}">
                                        {{ $tx->type === 'deposit' ? '+' : '-' }} Rp {{ number_format($tx->amount, 0, ',', '.') }}
                                    </span>
                                    
                                    @if($tx->status === 'approved')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-black bg-emerald-100 text-emerald-800 uppercase tracking-wider mt-0.5">
                                            Sukses
                                        </span>
                                    @elseif($tx->status === 'pending')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-black bg-amber-100 text-amber-800 uppercase tracking-wider mt-0.5">
                                            Pending
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[9px] font-black bg-rose-100 text-rose-800 uppercase tracking-wider mt-0.5">
                                            Ditolak
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="py-6 text-center">
                                <p class="text-xs text-slate-400 font-medium">Belum ada riwayat transaksi</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="md:col-span-5 space-y-4">
                <div class="bg-[#fffbeb] border border-amber-200/70 rounded-3xl p-5 shadow-xs text-slate-800 space-y-2.5">
                    <div class="flex items-center space-x-2">
                        <div class="w-6 h-6 rounded-lg bg-amber-100 flex items-center justify-center text-amber-700 shrink-0">
                            <svg class="w-3.5 h-3.5 text-amber-700" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
                                <path d="M12 2a6 6 0 0 0-6 6c0 2.21 1.2 4.14 3 5.18V16a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1v-2.82c1.8-1.04 3-2.97 3-5.18a6 6 0 0 0-6-6z" />
                                <line x1="10" y1="20" x2="14" y2="20" />
                            </svg>
                        </div>
                        <h5 class="text-xs font-extrabold text-amber-900 uppercase tracking-wider">Tips Keuangan Hari Ini</h5>
                    </div>
                    <p class="text-xs text-amber-950/90 font-medium leading-relaxed">
                        Ajarkan anak membagi uang sakunya menjadi tiga bagian utama: untuk jajan (spending), untuk ditabung (saving), dan untuk berbagi (sharing).
                    </p>
                </div>

                <div class="bg-white border border-slate-100 rounded-3xl p-5 shadow-xs space-y-1">
                    <div class="mb-3">
                        <h5 class="text-xs font-extrabold text-slate-800 uppercase tracking-wider font-['Outfit']">Informasi Identitas Siswa</h5>
                    </div>

                    <div class="space-y-1">
                        <div class="flex items-center justify-between py-3 border-b border-slate-100">
                            <div class="flex items-center space-x-3">
                                <svg class="w-4.5 h-4.5 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                                <span class="text-xs font-semibold text-slate-500">Nama Lengkap</span>
                            </div>
                            <span class="text-xs font-extrabold text-slate-900 tracking-tight">{{ $student->name }}</span>
                        </div>

                        <div class="flex items-center justify-between py-3 border-b border-slate-100">
                            <div class="flex items-center space-x-3">
                                <svg class="w-4.5 h-4.5 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <rect x="3" y="4" width="18" height="16" rx="3" stroke-width="2" />
                                    <circle cx="9" cy="10" r="2" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 16c0-1.8 1.5-2.5 3-2.5s3 .7 3 2.5" />
                                    <line x1="14" y1="9" x2="18" y2="9" stroke-linecap="round" />
                                    <line x1="14" y1="12.5" x2="18" y2="12.5" stroke-linecap="round" />
                                    <line x1="14" y1="16" x2="16.5" y2="16" stroke-linecap="round" />
                                </svg>
                                <span class="text-xs font-semibold text-slate-500">NISN</span>
                            </div>
                            <span class="text-xs font-mono font-extrabold text-slate-900">{{ $student->nisn }}</span>
                        </div>

                        <div class="flex items-center justify-between py-3">
                            <div class="flex items-center space-x-3">
                                <svg class="w-4.5 h-4.5 text-amber-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13.18v4L12 21l7-3.82v-4" />
                                </svg>
                                <span class="text-xs font-semibold text-slate-500">Kelas</span>
                            </div>
                            <span class="text-xs font-extrabold text-slate-900">{{ $student->class_name }}</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- ======================================================== -->
    <!-- WITHDRAWAL FORM MODAL (Backdrop and form layout)          -->
    <!-- ======================================================== -->
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-[100] flex items-end sm:items-center justify-center p-4"
         x-show="showModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
         
        <!-- Modal Content Card -->
        <div class="bg-white rounded-t-3xl sm:rounded-2xl w-full max-w-sm p-6 shadow-2xl relative text-left"
             x-show="showModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-y-full sm:scale-95 sm:translate-y-0"
             x-transition:enter-end="translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-y-0 sm:scale-100"
             x-transition:leave-end="translate-y-full sm:scale-95 sm:translate-y-0"
             @click.away="showModal = false">
             
             @if(!$is_pin_set)
                 <!-- Modal Header: Create PIN -->
                 <div class="flex justify-between items-center mb-4">
                     <h3 class="text-base font-bold text-slate-800 font-['Outfit']">Buat PIN Transaksi</h3>
                     <button @click="showModal = false" class="text-slate-400 hover:text-slate-600 focus:outline-hidden cursor-pointer">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                         </svg>
                     </button>
                 </div>
                 
                 <!-- PIN Setup Form -->
                 <form wire:submit.prevent="buatPinTransaksi" class="space-y-4">
                     <p class="text-xs text-slate-500 font-medium leading-relaxed">
                         Anda belum memiliki PIN Transaksi. Buat 6 angka PIN aman untuk mengotorisasi setiap pengajuan penarikan tabungan.
                     </p>
                     
                     <!-- PIN Input -->
                     <div class="space-y-1">
                          <label for="new_pin" class="text-xs font-semibold text-slate-500">PIN Baru (6 Angka)</label>
                          <input type="text" 
                                 id="new_pin" 
                                 wire:model="new_pin" 
                                 maxlength="6"
                                 pattern="[0-9]*"
                                 inputmode="numeric"
                                 autocomplete="one-time-code"
                                 style="-webkit-text-security: disc; text-security: disc;"
                                 class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 hover:border-amber-400 focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-white transition-colors text-sm tracking-widest text-center font-bold shadow-3xs" 
                                 placeholder="------"
                                 required>
                          @error('new_pin') <span class="text-xs text-rose-500 font-medium block">{{ $message }}</span> @enderror
                      </div>

                      <!-- PIN Confirmation Input -->
                      <div class="space-y-1">
                          <label for="new_pin_confirmation" class="text-xs font-semibold text-slate-500">Konfirmasi PIN</label>
                          <input type="text" 
                                 id="new_pin_confirmation" 
                                 wire:model="new_pin_confirmation" 
                                 maxlength="6"
                                 pattern="[0-9]*"
                                 inputmode="numeric"
                                 autocomplete="one-time-code"
                                 style="-webkit-text-security: disc; text-security: disc;"
                                 class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 hover:border-amber-400 focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-white transition-colors text-sm tracking-widest text-center font-bold shadow-3xs" 
                                 placeholder="------"
                                 required>
                     </div>
                     
                     <button type="submit" 
                             class="w-full py-3 bg-[#ffd554] hover:bg-[#fadb36] text-slate-800 text-sm font-bold rounded-xl active:scale-[0.98] transition-all duration-200 shadow-md shadow-green-600/10 cursor-pointer">
                         Simpan PIN Baru
                     </button>
                 </form>
             @else
                 <!-- Modal Header: Submit Withdrawal -->
                 <div class="flex justify-between items-center mb-4">
                     <h3 class="text-base font-bold text-slate-800 font-['Outfit']">Ajukan Penarikan Saldo</h3>
                     <button @click="showModal = false" class="text-slate-400 hover:text-slate-600 focus:outline-hidden cursor-pointer">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                         </svg>
                     </button>
                 </div>
                 
                 <!-- Modal Form -->
                 <form wire:submit.prevent="ajukanPenarikan" class="space-y-4">
                      <!-- Nominal Input -->
                      <div class="space-y-1">
                          <label for="nominal_penarikan" class="text-xs font-semibold text-slate-500">Nominal Penarikan</label>
                          <div class="relative">
                              <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-slate-400 text-sm font-bold">Rp</span>
                              <input type="number" 
                                     id="nominal_penarikan" 
                                     wire:model="nominal_penarikan" 
                                     class="w-full pl-10 pr-4 py-3 rounded-xl border border-slate-300 hover:border-amber-400 focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-white transition-colors text-sm shadow-3xs" 
                                     placeholder="Contoh: 50000"
                                     required>
                          </div>
                          @error('nominal_penarikan') <span class="text-xs text-rose-500 font-medium">{{ $message }}</span> @enderror
                      </div>

                      <!-- Quick Select Nominal Buttons -->
                      <div class="space-y-1.5">
                          <span class="text-xs font-semibold text-slate-500">Pilih Nominal Cepat</span>
                          <div class="grid grid-cols-4 gap-2">
                              <button type="button" @click="$wire.set('nominal_penarikan', 10000)" class="py-2 bg-slate-50 border border-slate-300 text-xs font-bold text-slate-600 rounded-lg hover:bg-[#f4faf0] hover:text-[#65b33b] hover:border-[#65b33b]/30 cursor-pointer transition-all">10rb</button>
                              <button type="button" @click="$wire.set('nominal_penarikan', 20000)" class="py-2 bg-slate-50 border border-slate-300 text-xs font-bold text-slate-600 rounded-lg hover:bg-[#f4faf0] hover:text-[#65b33b] hover:border-[#65b33b]/30 cursor-pointer transition-all">20rb</button>
                              <button type="button" @click="$wire.set('nominal_penarikan', 50000)" class="py-2 bg-slate-50 border border-slate-300 text-xs font-bold text-slate-600 rounded-lg hover:bg-[#f4faf0] hover:text-[#65b33b] hover:border-[#65b33b]/30 cursor-pointer transition-all">50rb</button>
                              <button type="button" @click="$wire.set('nominal_penarikan', 100000)" class="py-2 bg-slate-50 border border-slate-300 text-xs font-bold text-slate-600 rounded-lg hover:bg-[#f4faf0] hover:text-[#65b33b] hover:border-[#65b33b]/30 cursor-pointer transition-all">100rb</button>
                          </div>
                      </div>
                      
                      <!-- Alasan Input -->
                      <div class="space-y-1">
                          <label for="alasan_penarikan" class="text-xs font-semibold text-slate-500">Alasan Penarikan</label>
                          <textarea id="alasan_penarikan" 
                                    wire:model="alasan_penarikan" 
                                    rows="3" 
                                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 hover:border-amber-400 focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-white transition-colors text-sm shadow-3xs" 
                                    placeholder="Contoh: Kebutuhan membeli buku tulis"
                                    required></textarea>
                          @error('alasan_penarikan') <span class="text-xs text-rose-500 font-medium">{{ $message }}</span> @enderror
                      </div>

                      <!-- PIN Verification Input -->
                      <div class="space-y-1">
                          <label for="parent_pin_input" class="text-xs font-semibold text-slate-500">PIN Otorisasi (6 Angka)</label>
                          <input type="text" 
                                 id="parent_pin_input" 
                                 wire:model="parent_pin_input" 
                                 maxlength="6"
                                 pattern="[0-9]*"
                                 inputmode="numeric"
                                 autocomplete="one-time-code"
                                 style="-webkit-text-security: disc; text-security: disc;"
                                 class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 hover:border-amber-400 focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-white transition-colors text-sm tracking-widest text-center font-bold shadow-3xs" 
                                 placeholder="------"
                                 required>
                          @error('parent_pin_input') <span class="text-xs text-rose-500 font-medium block">{{ $message }}</span> @enderror
                      </div>
                     
                     <!-- Submit Button -->
                     <button type="submit" 
                             class="w-full py-3 bg-[#65b33b] hover:bg-[#579f32] text-white text-sm font-bold rounded-xl active:scale-[0.98] transition-all duration-200 shadow-md shadow-green-600/10 cursor-pointer">
                         Kirim Pengajuan
                     </button>
                 </form>
             @endif
        </div>
    </div>

</div>
