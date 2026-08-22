<div class="min-h-screen bg-[#ffd554] flex items-center justify-center p-4 sm:p-6 md:p-8 font-sans relative overflow-hidden select-none">
    
    <!-- Decorative background elements -->
    <div class="absolute -top-40 -left-40 w-[600px] h-[600px] bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-[-150px] right-[-150px] w-[600px] h-[600px] bg-white/10 rounded-full blur-3xl pointer-events-none"></div>

    <!-- Main Card -->
    <div class="w-full max-w-md bg-white rounded-3xl p-6 sm:p-8 shadow-2xl border border-slate-100/80 relative z-10 font-['Outfit'] space-y-6">
        
        <!-- Header -->
        <div class="text-center space-y-2">
            <div class="w-20 h-20 mx-auto flex items-center justify-center -mb-1">
                <lottie-player 
                    src="/assets/lock.json" 
                    background="transparent" 
                    speed="1" 
                    class="w-full h-full" 
                    loop 
                    autoplay
                ></lottie-player>
            </div>
            <h2 class="text-2xl font-black text-slate-800 tracking-tight">Wajib Perbarui Kata Sandi</h2>
            <p class="text-xs text-slate-500 font-medium leading-relaxed px-4">
                Administrator telah menyetel ulang akun Anda. Silakan tentukan kata sandi baru untuk menjaga keamanan tabungan siswa.
            </p>
        </div>

        @if(session()->has('error'))
            <div class="bg-rose-50 border border-rose-100 text-rose-800 px-4 py-3 rounded-xl text-xs font-semibold text-left">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form with Real-time Criteria Validation -->
        <form 
            wire:submit.prevent="updatePassword" 
            x-data="{ 
                newPass: '', 
                confirmPass: '',
                showOld: false,
                showNew: false,
                showConfirm: false,
                get minLength() { return (this.newPass || '').length >= 6 },
                get hasUppercase() { return /[A-Z]/.test(this.newPass || '') },
                get hasNumber() { return /[0-9]/.test(this.newPass || '') },
                get isMatching() { return (this.newPass || '').length > 0 && this.newPass === this.confirmPass },
                get isLongPass() { return (this.newPass || '').length >= 10 },
                get score() {
                    let s = 0;
                    if (this.hasUppercase) s++;
                    if (this.minLength) s++;
                    if (this.hasNumber) s++;
                    if (this.isLongPass) s++;
                    return s;
                },
                get strengthLabel() {
                    if (!this.newPass || this.newPass.length === 0) return 'Belum Diisi';
                    if (this.score <= 1) return 'Lemah';
                    if (this.score <= 3) return 'Sedang';
                    return 'Kuat';
                },
                get strengthBadgeClass() {
                    if (!this.newPass || this.newPass.length === 0) return 'bg-slate-100 text-slate-400 border-slate-200 font-medium';
                    if (this.score <= 1) return 'bg-rose-50 text-rose-600 border-rose-200/80 font-bold';
                    if (this.score <= 3) return 'bg-amber-50 text-amber-700 border-amber-200/80 font-bold';
                    return 'bg-emerald-50 text-emerald-700 border-emerald-200 font-extrabold';
                }
            }"
            class="space-y-4 text-left font-['Outfit']"
        >
            <!-- Old Password -->
            <div class="space-y-1.5">
                <label for="old_password" class="text-[10px] text-slate-500 font-extrabold uppercase tracking-wider block">Kata Sandi Lama / Default</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-amber-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </span>
                    <input 
                        :type="showOld ? 'text' : 'password'" 
                        id="old_password" 
                        wire:model="old_password"
                        class="w-full pl-11 pr-12 py-3.5 rounded-2xl border border-slate-200 text-sm font-bold placeholder:font-semibold placeholder:text-slate-400 focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-slate-50/40 transition-all duration-300"
                        placeholder="Masukkan sandi default (NISN)"
                        required
                    >
                    <button 
                        type="button"
                        @click="showOld = !showOld"
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-amber-600 hover:text-amber-700 cursor-pointer focus:outline-hidden"
                    >
                        <svg x-show="!showOld" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.43 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <svg x-show="showOld" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.815 7.815L21 21m-3.957-3.957-1.4 1.4m-1.432-1.432a4.969 4.969 0 0 1-3.037.404M15 12a3 3 0 0 1-3 3m0 0a3.003 3.003 0 0 1-2.247-4.293M12 9a3 3 0 0 1 3 3" />
                        </svg>
                    </button>
                </div>
                @error('old_password') <span class="text-xs text-rose-500 font-medium block mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- New Password -->
            <div class="space-y-1.5">
                <label for="new_password" class="text-[10px] text-slate-500 font-extrabold uppercase tracking-wider block">Kata Sandi Baru</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-amber-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </span>
                    <input 
                        :type="showNew ? 'text' : 'password'" 
                        id="new_password" 
                        wire:model="new_password"
                        x-model="newPass"
                        class="w-full pl-11 pr-12 py-3.5 rounded-2xl border border-slate-200 text-sm font-bold placeholder:font-semibold placeholder:text-slate-400 focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-slate-50/40 transition-all duration-300"
                        placeholder="Minimal 6 karakter"
                        required
                    >
                    <button 
                        type="button"
                        @click="showNew = !showNew"
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-amber-600 hover:text-amber-700 cursor-pointer focus:outline-hidden"
                    >
                        <svg x-show="!showNew" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.43 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <svg x-show="showNew" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.815 7.815L21 21m-3.957-3.957-1.4 1.4m-1.432-1.432a4.969 4.969 0 0 1-3.037.404M15 12a3 3 0 0 1-3 3m0 0a3.003 3.003 0 0 1-2.247-4.293M12 9a3 3 0 0 1 3 3" />
                        </svg>
                    </button>
                </div>
                @error('new_password') <span class="text-xs text-rose-500 font-medium block mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Confirm New Password -->
            <div class="space-y-1.5">
                <label for="new_password_confirmation" class="text-[10px] text-slate-500 font-extrabold uppercase tracking-wider block">Konfirmasi Kata Sandi Baru</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-amber-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </span>
                    <input 
                        :type="showConfirm ? 'text' : 'password'" 
                        id="new_password_confirmation" 
                        wire:model="new_password_confirmation"
                        x-model="confirmPass"
                        class="w-full pl-11 pr-12 py-3.5 rounded-2xl border border-slate-200 text-sm font-bold placeholder:font-semibold placeholder:text-slate-400 focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-slate-50/40 transition-all duration-300"
                        placeholder="Ulangi kata sandi baru"
                        required
                    >
                    <button 
                        type="button"
                        @click="showConfirm = !showConfirm"
                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-amber-600 hover:text-amber-700 cursor-pointer focus:outline-hidden"
                    >
                        <svg x-show="!showConfirm" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.43 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <svg x-show="showConfirm" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.815 7.815L21 21m-3.957-3.957-1.4 1.4m-1.432-1.432a4.969 4.969 0 0 1-3.037.404M15 12a3 3 0 0 1-3 3m0 0a3.003 3.003 0 0 1-2.247-4.293M12 9a3 3 0 0 1 3 3" />
                        </svg>
                    </button>
                </div>
                @error('new_password_confirmation') <span class="text-xs text-rose-500 font-medium block mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Real-time Password Criteria Validation Checklist (Positioned at the bottom) -->
            <div class="p-3.5 rounded-2xl bg-amber-50/70 border border-amber-200/70 space-y-2 text-xs font-['Outfit'] shadow-3xs">
                <div class="flex items-center justify-between">
                    <span class="font-extrabold text-amber-900 text-[10px] uppercase tracking-wider">Kriteria</span>
                    <span 
                        class="text-[10px] px-2 py-0.5 rounded-full transition-all border"
                        :class="strengthBadgeClass"
                        x-text="strengthLabel"
                    ></span>
                </div>
                <div class="space-y-1.5 font-bold text-[11px]">
                    <div class="flex items-center space-x-2 transition-colors duration-200" :class="hasUppercase ? 'text-slate-800 font-bold' : 'text-slate-400'">
                        <div class="w-3.5 h-3.5 rounded-full flex items-center justify-center shrink-0 transition-all duration-300" :class="hasUppercase ? 'bg-emerald-500 text-white shadow-xs' : 'bg-white text-slate-300 border border-slate-300'">
                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        </div>
                        <span>Minimal 1 huruf kapital (A-Z)</span>
                    </div>
                    <div class="flex items-center space-x-2 transition-colors duration-200" :class="minLength ? 'text-slate-800 font-bold' : 'text-slate-400'">
                        <div class="w-3.5 h-3.5 rounded-full flex items-center justify-center shrink-0 transition-all duration-300" :class="minLength ? 'bg-emerald-500 text-white shadow-xs' : 'bg-white text-slate-300 border border-slate-300'">
                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        </div>
                        <span>Minimal 6 karakter</span>
                    </div>
                    <div class="flex items-center space-x-2 transition-colors duration-200" :class="hasNumber ? 'text-slate-800 font-bold' : 'text-slate-400'">
                        <div class="w-3.5 h-3.5 rounded-full flex items-center justify-center shrink-0 transition-all duration-300" :class="hasNumber ? 'bg-emerald-500 text-white shadow-xs' : 'bg-white text-slate-300 border border-slate-300'">
                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        </div>
                        <span>Minimal 1 angka (0-9)</span>
                    </div>
                    <div class="flex items-center space-x-2 transition-colors duration-200" :class="isMatching ? 'text-slate-800 font-bold' : 'text-slate-400'">
                        <div class="w-3.5 h-3.5 rounded-full flex items-center justify-center shrink-0 transition-all duration-300" :class="isMatching ? 'bg-emerald-500 text-white shadow-xs' : 'bg-white text-slate-300 border border-slate-300'">
                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                        </div>
                        <span>Konfirmasi kata sandi cocok</span>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <button 
                type="submit" 
                wire:loading.attr="disabled"
                class="w-full h-13 bg-[#ffd554] hover:bg-[#e5bf43] text-slate-900 text-sm font-extrabold rounded-2xl shadow-lg shadow-amber-500/10 active:scale-[0.98] transition-all duration-300 flex items-center justify-center cursor-pointer disabled:opacity-75 disabled:cursor-not-allowed font-['Outfit']"
            >
                <span wire:loading.remove wire:target="updatePassword" class="tracking-wide">Simpan Kata Sandi Baru</span>
                <span wire:loading wire:target="updatePassword">
                    <span class="flex items-center justify-center space-x-2">
                        <svg class="animate-spin h-5 w-5 text-slate-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-90" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span class="tracking-wide font-extrabold text-slate-900">Menyimpan...</span>
                    </span>
                </span>
            </button>
        </form>
    </div>
</div>
