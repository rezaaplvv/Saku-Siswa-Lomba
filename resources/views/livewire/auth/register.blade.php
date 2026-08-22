<div class="min-h-screen w-screen flex flex-col md:flex-row overflow-x-hidden font-sans relative bg-[#f4f7f6]">

    <!-- ======================================================== -->
    <!-- LEFT HALF: Brand Title & Mascot (Desktop Only - Yellow)  -->
    <!-- ======================================================== -->
    <div class="hidden md:flex md:w-1/2 h-full bg-[#ffd554] flex-col justify-between p-12 fixed left-0 top-0 bottom-0 overflow-hidden text-left items-start">
        <div class="absolute -top-10 -right-10 w-96 h-96 bg-white/10 rounded-full blur-3xl pointer-events-none z-0"></div>
        <div class="absolute -bottom-10 -left-10 w-96 h-96 bg-white/10 rounded-full blur-3xl pointer-events-none z-0"></div>
        
        <!-- Header Logo -->
        <div class="flex items-center space-x-3.5 relative z-10">
            <div class="w-11 h-11 rounded-2xl bg-white/90 flex items-center justify-center text-amber-600 shrink-0 shadow-xs border border-white/20">
                <img src="/assets/iconaplikasi.png" alt="Mascot Mini" class="w-7 h-7 object-contain">
            </div>
            <h2 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight font-['Outfit']">
                Saku<span class="text-amber-800">Siswa</span>
            </h2>
        </div>

        <!-- Middle Content -->
        <div class="space-y-4 max-w-sm relative z-10 mt-8">
            <h1 class="text-3xl lg:text-4xl font-extrabold text-slate-800 leading-tight font-['Outfit'] tracking-tight">
                Kelola tabungan<br>
                <span class="text-amber-800">kelas Anda dengan<br>mudah dan aman.</span>
            </h1>
            <p class="text-sm text-slate-700 font-medium leading-relaxed font-sans">
                Daftarkan akun Guru / Wali Kelas Anda untuk mulai mengelola tabungan murid secara instan.
            </p>
        </div>

        <!-- Bottom Mascot -->
        <div class="w-full flex-1 flex items-end justify-center mt-6 relative z-10 pointer-events-none">
            <img src="/assets/maskot.png" alt="Mascot" class="max-h-[45vh] lg:max-h-[50vh] object-contain filter drop-shadow-[0_20px_40px_rgba(0,0,0,0.08)]">
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- RIGHT HALF: Registration Form                              -->
    <!-- ======================================================== -->
    <div class="w-full md:w-1/2 md:ml-auto min-h-screen bg-[#f4f7f6] md:bg-white flex flex-col justify-center items-center p-4 sm:p-6 md:p-12 relative max-md:bg-[#ffd554]">
        
        <!-- Mobile-only background decorative shapes -->
        <div class="block md:hidden absolute -top-40 -left-40 w-[600px] h-[600px] bg-white/10 rounded-full blur-3xl pointer-events-none"></div>

        <!-- Form Card Wrapper -->
        <div class="w-full max-w-md md:max-w-xl lg:max-w-2xl relative my-6">
            <div class="w-full bg-white rounded-3xl p-5 sm:p-8 shadow-2xl border border-slate-100/80 md:shadow-none md:border-none md:p-0 md:bg-transparent relative z-10 space-y-5">
                
                <!-- Card Header -->
                <div class="text-center space-y-2 font-['Outfit']">
                    <img src="/assets/iconaplikasi.png" alt="Logo" class="w-14 h-14 mx-auto object-contain">
                    <h2 class="text-2xl font-extrabold text-slate-800 tracking-tight font-['Outfit']">
                        Daftar Akun <span class="text-amber-700">Baru</span>
                    </h2>
                    <p class="text-xs text-slate-500 font-medium leading-relaxed font-sans">
                        Lengkapi formulir di bawah ini untuk membuka kelas tabungan mandiri.
                    </p>
                </div>

                <!-- Registration Form -->
                <form wire:submit.prevent="register" class="space-y-4 font-sans">
                    
                    <!-- Input 1: Nama Guru -->
                    <div class="space-y-1">
                        <label for="name" class="block text-xs font-bold text-slate-700">Nama Lengkap Guru</label>
                        <input 
                            type="text" 
                            id="name" 
                            wire:model="name"
                            class="w-full px-4 py-3 rounded-xl border border-amber-300/80 hover:border-amber-400 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20 bg-amber-50/20 hover:bg-amber-50/40 focus:bg-white text-sm font-medium placeholder-slate-400 focus:outline-none transition-all duration-300 font-sans"
                            placeholder="Masukkan Nama Lengkap"
                        >
                        @error('name') <span class="text-xs text-rose-500 font-medium block font-sans">{{ $message }}</span> @enderror
                    </div>

                    <!-- Input 2 & 3 Grid: Nama Sekolah & Nama Kelas -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="space-y-1">
                            <label for="school_name" class="block text-xs font-bold text-slate-700">Nama Sekolah</label>
                            <input 
                                type="text" 
                                id="school_name" 
                                list="school_suggestions"
                                wire:model="school_name"
                                class="w-full px-4 py-3 rounded-xl border border-amber-300/80 hover:border-amber-400 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20 bg-amber-50/20 hover:bg-amber-50/40 focus:bg-white text-sm font-medium placeholder-slate-400 focus:outline-none transition-all duration-300 font-sans"
                                placeholder="Masukkan Nama Sekolah"
                            >
                            <datalist id="school_suggestions">
                                @foreach($existingSchools as $sch)
                                    <option value="{{ $sch }}">
                                @endforeach
                            </datalist>
                            <span class="text-[10px] text-slate-400 font-medium block font-sans">Pilih terdaftar atau ketik baru.</span>
                            @error('school_name') <span class="text-xs text-rose-500 font-medium block font-sans">{{ $message }}</span> @enderror
                        </div>

                        <div class="space-y-1">
                            <label for="class_name" class="block text-xs font-bold text-slate-700">Kelas yang Dikelola</label>
                            <input 
                                type="text" 
                                id="class_name" 
                                wire:model="class_name"
                                class="w-full px-4 py-3 rounded-xl border border-amber-300/80 hover:border-amber-400 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20 bg-amber-50/20 hover:bg-amber-50/40 focus:bg-white text-sm font-medium placeholder-slate-400 focus:outline-none transition-all duration-300 font-sans"
                                placeholder="Contoh : 1-A"
                            >
                            @error('class_name') <span class="text-xs text-rose-500 font-medium block font-sans">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Input 4: Email -->
                    <div class="space-y-1">
                        <label for="email" class="block text-xs font-bold text-slate-700">Alamat Email</label>
                        <input 
                            type="email" 
                            id="email" 
                            wire:model="email"
                            class="w-full px-4 py-3 rounded-xl border border-amber-300/80 hover:border-amber-400 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20 bg-amber-50/20 hover:bg-amber-50/40 focus:bg-white text-sm font-medium placeholder-slate-400 focus:outline-none transition-all duration-300 font-sans"
                            placeholder="Masukkan Email Anda"
                        >
                        @error('email') <span class="text-xs text-rose-500 font-medium block font-sans">{{ $message }}</span> @enderror
                    </div>

                    <!-- Input 5: Password & Password Confirmation with Dynamic Strength Checklist -->
                    <div 
                        x-data="{ 
                            showPass: false, 
                            showConfirmPass: false, 
                            focusPass: false,
                            pass: @entangle('password'),
                            confirmPass: @entangle('password_confirmation'),
                            get minLength() { return (this.pass || '').length >= 8 },
                            get hasUppercase() { return /[A-Z]/.test(this.pass || '') },
                            get hasNumber() { return /[0-9]/.test(this.pass || '') },
                            get isMatching() { return (this.pass || '').length > 0 && this.pass === this.confirmPass },
                            get isLongPass() { return (this.pass || '').length >= 12 },
                            get score() {
                                let s = 0;
                                if (this.hasUppercase) s++;
                                if (this.minLength) s++;
                                if (this.hasNumber) s++;
                                if (this.isLongPass) s++;
                                return s;
                            },
                            get strengthLabel() {
                                if (!this.pass || this.pass.length === 0) return 'Belum Diisi';
                                if (this.score <= 1) return 'Lemah';
                                if (this.score <= 3) return 'Sedang';
                                return 'Kuat';
                            },
                            get strengthBadgeClass() {
                                if (!this.pass || this.pass.length === 0) return 'bg-slate-50 text-slate-400 border-slate-200 font-medium';
                                if (this.score <= 1) return 'bg-rose-50 text-rose-600 border-rose-200/80 font-bold';
                                if (this.score <= 3) return 'bg-amber-50 text-amber-700 border-amber-200/80 font-bold';
                                return 'bg-emerald-50 text-emerald-700 border-emerald-200 font-extrabold';
                            },
                            get allValid() { return this.minLength && this.hasUppercase && this.hasNumber && this.isMatching }
                        }"
                        class="space-y-3 font-sans"
                    >
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-start">
                            
                            <!-- Left Column: Password & Confirm Inputs (7 cols on PC) -->
                            <div class="md:col-span-7 space-y-3">
                                <!-- Password Input -->
                                <div class="space-y-1">
                                    <label for="password" class="block text-xs font-bold text-slate-700">Kata Sandi</label>
                                    <div class="relative">
                                        <input 
                                            :type="showPass ? 'text' : 'password'" 
                                            id="password" 
                                            wire:model.live="password"
                                            @focus="focusPass = true"
                                            @blur="focusPass = false"
                                            class="w-full pl-4 pr-10 py-3 rounded-xl border border-amber-300/80 hover:border-amber-400 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20 bg-amber-50/20 hover:bg-amber-50/40 focus:bg-white text-sm font-medium placeholder-slate-400 focus:outline-none transition-all duration-300 font-sans"
                                            placeholder="Minimal 8 karakter"
                                        >
                                        <button 
                                            type="button" 
                                            @click="showPass = !showPass" 
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-amber-600 hover:text-amber-700 focus:outline-none cursor-pointer"
                                        >
                                            <svg x-show="!showPass" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.43 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <svg x-show="showPass" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display: none;">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 01-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.815 7.815L21 21m-3.957-3.957-1.4 1.4m-1.432-1.432a4.969 4.969 0 01-3.037.404M15 12a3 3 0 013 3m0 0a3.003 3.003 0 01-2.247-4.293M12 9a3 3 0 013 3" />
                                            </svg>
                                        </button>
                                    </div>
                                    @error('password') <span class="text-xs text-rose-500 font-medium block font-sans">{{ $message }}</span> @enderror
                                </div>

                                <!-- Mobile Option A: Floating Popover Box under Password Input on Mobile -->
                                <div 
                                    x-show="(focusPass || (pass && pass.length > 0)) && !allValid"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-1"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 translate-y-1"
                                    class="block md:hidden p-3.5 rounded-2xl bg-white border border-slate-200/90 space-y-2 shadow-lg shadow-slate-200/50 text-xs font-sans relative overflow-hidden"
                                >
                                    <div class="flex items-center justify-between">
                                        <span class="font-extrabold text-slate-400 text-[10px] uppercase tracking-widest font-['Outfit']">Kriteria</span>
                                        <span 
                                            class="text-[10px] px-2 py-0.5 rounded-full transition-all border"
                                            :class="strengthBadgeClass"
                                            x-text="strengthLabel"
                                        ></span>
                                    </div>
                                    <div class="space-y-1.5 font-medium text-[11px]">
                                        <div class="flex items-center space-x-2 transition-colors duration-200" :class="hasUppercase ? 'text-slate-800 font-semibold' : 'text-slate-400'">
                                            <div class="w-3.5 h-3.5 rounded-full flex items-center justify-center shrink-0 transition-all duration-300" :class="hasUppercase ? 'bg-emerald-500 text-white shadow-xs' : 'bg-slate-100 text-slate-300 border border-slate-200'">
                                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                            </div>
                                            <span>Minimal 1 huruf kapital (A-Z)</span>
                                        </div>
                                        <div class="flex items-center space-x-2 transition-colors duration-200" :class="minLength ? 'text-slate-800 font-semibold' : 'text-slate-400'">
                                            <div class="w-3.5 h-3.5 rounded-full flex items-center justify-center shrink-0 transition-all duration-300" :class="minLength ? 'bg-emerald-500 text-white shadow-xs' : 'bg-slate-100 text-slate-300 border border-slate-200'">
                                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                            </div>
                                            <span>Minimal 8 karakter</span>
                                        </div>
                                        <div class="flex items-center space-x-2 transition-colors duration-200" :class="hasNumber ? 'text-slate-800 font-semibold' : 'text-slate-400'">
                                            <div class="w-3.5 h-3.5 rounded-full flex items-center justify-center shrink-0 transition-all duration-300" :class="hasNumber ? 'bg-emerald-500 text-white shadow-xs' : 'bg-slate-100 text-slate-300 border border-slate-200'">
                                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                            </div>
                                            <span>Minimal 1 angka (0-9)</span>
                                        </div>
                                        <div class="flex items-center space-x-2 transition-colors duration-200" :class="isMatching ? 'text-slate-800 font-semibold' : 'text-slate-400'">
                                            <div class="w-3.5 h-3.5 rounded-full flex items-center justify-center shrink-0 transition-all duration-300" :class="isMatching ? 'bg-emerald-500 text-white shadow-xs' : 'bg-slate-100 text-slate-300 border border-slate-200'">
                                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                            </div>
                                            <span>Konfirmasi kata sandi cocok</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Confirm Password Input -->
                                <div class="space-y-1">
                                    <label for="password_confirmation" class="block text-xs font-bold text-slate-700">Konfirmasi Kata Sandi</label>
                                    <div class="relative">
                                        <input 
                                            :type="showConfirmPass ? 'text' : 'password'" 
                                            id="password_confirmation" 
                                            wire:model.live="password_confirmation"
                                            class="w-full pl-4 pr-10 py-3 rounded-xl border border-amber-300/80 hover:border-amber-400 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20 bg-amber-50/20 hover:bg-amber-50/40 focus:bg-white text-sm font-medium placeholder-slate-400 focus:outline-none transition-all duration-300 font-sans"
                                            placeholder="Ulangi kata sandi"
                                        >
                                        <button 
                                            type="button" 
                                            @click="showConfirmPass = !showConfirmPass" 
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-amber-600 hover:text-amber-700 focus:outline-none cursor-pointer"
                                        >
                                            <svg x-show="!showConfirmPass" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.43 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            <svg x-show="showConfirmPass" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display: none;">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 01-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.815 7.815L21 21m-3.957-3.957-1.4 1.4m-1.432-1.432a4.969 4.969 0 01-3.037.404M15 12a3 3 0 013 3m0 0a3.003 3.003 0 01-2.247-4.293M12 9a3 3 0 013 3" />
                                            </svg>
                                        </button>
                                    </div>
                                    @error('password_confirmation') <span class="text-xs text-rose-500 font-medium block font-sans">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Right Column: Desktop Strength Checklist Card (5 cols on PC) -->
                            <div class="hidden md:block md:col-span-5 self-center">
                                <div class="p-3.5 rounded-2xl bg-white/90 border border-slate-200/80 shadow-xs space-y-2.5 font-sans relative overflow-hidden backdrop-blur-xs">
                                    <!-- Dynamic Strength Progress Bar (top border indicator) -->
                                    <div class="absolute top-0 left-0 right-0 h-1 bg-slate-100">
                                        <div 
                                            class="h-full transition-all duration-500 rounded-r-full"
                                            :class="{
                                                'w-0': score === 0,
                                                'w-1/4 bg-rose-500': score === 1,
                                                'w-2/4 bg-amber-500': score === 2,
                                                'w-3/4 bg-amber-500': score === 3,
                                                'w-full bg-emerald-500': score === 4
                                            }"
                                        ></div>
                                    </div>

                                    <!-- Card Header -->
                                    <div class="flex items-center justify-between pt-1">
                                        <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest font-['Outfit']">
                                            Kriteria
                                        </span>
                                        <span 
                                            class="text-[10px] px-2.5 py-0.5 rounded-full transition-all duration-300 border"
                                            :class="strengthBadgeClass"
                                            x-text="strengthLabel"
                                        ></span>
                                    </div>

                                    <!-- Criteria Items -->
                                    <div class="space-y-2 text-xs font-medium">
                                        <div class="flex items-center space-x-2 transition-colors duration-200" :class="hasUppercase ? 'text-slate-800 font-semibold' : 'text-slate-400'">
                                            <div class="w-4 h-4 rounded-full flex items-center justify-center shrink-0 transition-all duration-300" :class="hasUppercase ? 'bg-emerald-500 text-white shadow-xs scale-105' : 'bg-slate-100 text-slate-300 border border-slate-200'">
                                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                            </div>
                                            <span class="text-[11px]">Huruf Kapital (A-Z)</span>
                                        </div>

                                        <div class="flex items-center space-x-2 transition-colors duration-200" :class="minLength ? 'text-slate-800 font-semibold' : 'text-slate-400'">
                                            <div class="w-4 h-4 rounded-full flex items-center justify-center shrink-0 transition-all duration-300" :class="minLength ? 'bg-emerald-500 text-white shadow-xs scale-105' : 'bg-slate-100 text-slate-300 border border-slate-200'">
                                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                            </div>
                                            <span class="text-[11px]">Min. 8 Karakter</span>
                                        </div>

                                        <div class="flex items-center space-x-2 transition-colors duration-200" :class="hasNumber ? 'text-slate-800 font-semibold' : 'text-slate-400'">
                                            <div class="w-4 h-4 rounded-full flex items-center justify-center shrink-0 transition-all duration-300" :class="hasNumber ? 'bg-emerald-500 text-white shadow-xs scale-105' : 'bg-slate-100 text-slate-300 border border-slate-200'">
                                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                            </div>
                                            <span class="text-[11px]">Karakter Angka (0-9)</span>
                                        </div>

                                        <div class="flex items-center space-x-2 transition-colors duration-200" :class="isMatching ? 'text-slate-800 font-semibold' : 'text-slate-400'">
                                            <div class="w-4 h-4 rounded-full flex items-center justify-center shrink-0 transition-all duration-300" :class="isMatching ? 'bg-emerald-500 text-white shadow-xs scale-105' : 'bg-slate-100 text-slate-300 border border-slate-200'">
                                                <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                            </div>
                                            <span class="text-[11px]">Sandi Cocok</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit" 
                        wire:loading.attr="disabled"
                        class="w-full h-12 bg-[#ffd554] hover:bg-[#e5bf43] text-slate-900 text-base font-extrabold rounded-xl shadow-lg shadow-amber-500/10 active:scale-[0.98] transition-all duration-300 flex items-center justify-center cursor-pointer disabled:opacity-75 font-['Outfit'] mt-2"
                    >
                        <span wire:loading.remove wire:target="register">Daftar & Buat Kelas Sekarang</span>
                        <span wire:loading wire:target="register" class="flex items-center space-x-2">
                            <svg class="animate-spin h-5 w-5 text-slate-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-90" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>Memproses Pendaftaran...</span>
                        </span>
                    </button>
                </form>

                <!-- Back to Login -->
                <div class="text-center pt-2 text-xs text-slate-500 font-medium">
                    Sudah punya akun? <a href="/login" class="text-amber-600 font-bold hover:underline">Masuk di sini</a>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="w-full pb-4 text-center text-xs text-slate-500 font-medium font-['Outfit']">
            &copy; 2026 SakuSiswa. All rights reserved.
        </div>
    </div>
</div>
