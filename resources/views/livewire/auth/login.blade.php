<div class="h-screen w-screen flex flex-col md:flex-row overflow-hidden font-sans relative" x-data="{ showContact: false }">
    
    <!-- Premium Google Fonts Import -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- ======================================================== -->
    <!-- LEFT HALF: Brand Title & Mascot (Desktop Only - Yellow)  -->
    <!-- ======================================================== -->
    <div class="hidden md:flex md:w-1/2 h-full bg-[#ffd554] flex-col justify-between p-7 lg:p-9 xl:p-11 relative overflow-hidden text-left items-start">
        <!-- Floating white & amber gradient blur circles -->
        <div class="absolute -top-16 -right-16 w-96 h-96 bg-white/20 rounded-full blur-3xl pointer-events-none z-0"></div>
        <div class="absolute -bottom-16 -left-16 w-96 h-96 bg-amber-600/15 rounded-full blur-3xl pointer-events-none z-0"></div>
        
        <!-- Top Right Dot Grid Pattern -->
        <div class="absolute top-10 right-10 text-amber-800/15 pointer-events-none z-0 animate-pulse">
            <svg width="48" height="32" viewBox="0 0 48 32" fill="currentColor">
                <circle cx="4" cy="4" r="2" />
                <circle cx="16" cy="4" r="2" />
                <circle cx="28" cy="4" r="2" />
                <circle cx="40" cy="4" r="2" />
                <circle cx="4" cy="16" r="2" />
                <circle cx="16" cy="16" r="2" />
                <circle cx="28" cy="16" r="2" />
                <circle cx="40" cy="16" r="2" />
                <circle cx="4" cy="28" r="2" />
                <circle cx="16" cy="28" r="2" />
                <circle cx="28" cy="28" r="2" />
                <circle cx="40" cy="28" r="2" />
            </svg>
        </div>

        <!-- 1. TOP HEADER: Logo & SakuSiswa Branding -->
        <div class="flex items-center space-x-3.5 relative z-10 animate-fade-in-left animation-delay-100">
            <div class="w-12 h-12 rounded-2xl bg-white/90 backdrop-blur-md flex items-center justify-center text-amber-600 shrink-0 shadow-sm border border-white/60 hover:scale-105 transition-transform duration-300">
                <img src="/assets/iconaplikasi.png" alt="Mascot Mini" class="w-8 h-8 object-contain">
            </div>
            <div>
                <h2 class="text-2xl lg:text-3xl font-extrabold text-slate-800 tracking-tight font-['Outfit'] leading-none">
                    Saku<span class="text-amber-900">Siswa</span>
                </h2>
                <span class="text-[10px] lg:text-[11px] font-semibold text-amber-900/70 tracking-wide uppercase font-sans">Platform Tabungan Sekolah Digital</span>
            </div>
        </div>

        <!-- 2. MIDDLE CONTENT: Headline & Description -->
        <div class="space-y-2.5 lg:space-y-3.5 max-w-md relative z-10 my-auto py-1 animate-fade-in-left animation-delay-200">
            <!-- Headline -->
            <h1 class="text-2xl lg:text-3xl xl:text-[2.35rem] font-extrabold text-slate-800 leading-snug font-['Outfit'] tracking-tight">
                Menabung hari ini,<br>
                <span class="text-amber-900">masa depan lebih cerah.</span>
            </h1>
            <p class="text-xs lg:text-sm text-slate-700/85 font-medium leading-relaxed">
                Kelola tabungan, pantau mutasi secara real-time, dan capai impian finansial anak sejak dini secara aman & transparan.
            </p>
        </div>

        <!-- 3. BOTTOM CONTENT: Mascot Image centered and enlarged -->
        <div class="w-full flex-1 flex items-center justify-center relative z-10 py-1 animate-pop-in animation-delay-300">
            <div class="relative flex items-center justify-center">
                <!-- Soft Glow behind Mascot -->
                <div class="absolute inset-0 bg-white/20 rounded-full blur-2xl transform scale-110 pointer-events-none"></div>
                <img src="/assets/maskot.png" alt="Mascot" class="max-h-[34vh] lg:max-h-[40vh] xl:max-h-[44vh] w-auto max-w-full object-contain filter drop-shadow-[0_15px_30px_rgba(180,83,9,0.18)] relative z-10">
            </div>
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- RIGHT HALF: Login Form (Solid Yellow Mobile background)   -->
    <!-- ======================================================== -->
    <div class="w-full md:w-1/2 h-full bg-[#f4f7f6] md:bg-white flex flex-col justify-center items-center p-3 sm:p-5 md:p-6 relative overflow-hidden max-md:bg-[#ffd554]">
        
        <!-- Bottom Right Yellow Right-Angled Triangle Decorative Accent -->
        <div class="hidden md:block absolute bottom-0 right-0 w-56 h-56 lg:w-[320px] lg:h-[320px] xl:w-[390px] xl:h-[390px] pointer-events-none z-0 animate-pop-in">
            <svg viewBox="0 0 100 100" preserveAspectRatio="none" class="w-full h-full text-[#ffd554]/60 lg:text-[#ffd554]/75">
                <polygon points="100,0 100,100 0,100" fill="currentColor" />
            </svg>
        </div>
        
        <!-- Mobile-only background decorative shapes -->
        <div class="block md:hidden absolute -top-40 -left-40 w-[600px] h-[600px] bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="block md:hidden absolute bottom-[-150px] right-[-150px] w-[600px] h-[600px] bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
        
        <!-- Mobile-only Top Right Dot Matrix decoration -->
        <div class="block md:hidden absolute top-8 right-6 text-white/30 pointer-events-none">
            <svg width="24" height="24" viewBox="0 0 32 32" fill="currentColor">
                <circle cx="4" cy="4" r="2" />
                <circle cx="14" cy="4" r="2" />
                <circle cx="24" cy="4" r="2" />
                <circle cx="4" cy="14" r="2" />
                <circle cx="14" cy="14" r="2" />
                <circle cx="24" cy="14" r="2" />
                <circle cx="4" cy="24" r="2" />
                <circle cx="14" cy="24" r="2" />
                <circle cx="24" cy="24" r="2" />
            </svg>
        </div>

        <!-- Mobile-only Mascot Header -->
        <div class="flex md:hidden justify-center mb-2 relative z-10 animate-pop-in">
            <img src="/assets/maskot.png" class="h-[22vh] max-h-[160px] object-contain filter drop-shadow-[0_10px_20px_rgba(0,0,0,0.12)]" alt="Maskot">
        </div>

        <!-- White Card Wrapper with Elevated Shadow -->
        <div class="w-full max-w-[380px] sm:max-w-[400px] lg:max-w-[415px] relative z-10 animate-fade-in-right animation-delay-150">
            
            <!-- Actual White Card Container -->
            <div class="w-full bg-white rounded-3xl p-5 sm:p-6 md:p-6 lg:p-7 shadow-xl md:shadow-2xl border border-slate-100/90 relative z-10">
                <div class="space-y-3 md:space-y-3.5">
                    
                    <!-- Logo and Title row (Unified for Mobile view) -->
                    <div class="flex md:hidden items-center space-x-3 pb-2 border-b border-slate-100 mb-1.5">
                        <div class="bg-amber-50 p-1.5 rounded-xl border border-amber-200/50 shadow-xs flex-shrink-0">
                            <img src="/assets/iconaplikasi.png" alt="Logo" class="w-7 h-7 object-contain">
                        </div>
                        <div class="text-left space-y-0.5 font-sans">
                            <h2 class="text-base font-extrabold text-slate-800 tracking-tight font-['Outfit']">
                                Saku<span class="text-amber-700">Siswa</span>
                            </h2>
                            <p class="text-[10px] text-slate-500 font-light leading-relaxed">
                                Kelola uang saku dan tabungan siswa dengan mudah.
                            </p>
                        </div>
                    </div>

                    <!-- Desktop-only Card Header -->
                    <div class="hidden md:block text-center space-y-2 font-['Outfit'] animate-fade-in-up animation-delay-200">
                        <div class="inline-block p-1.5 rounded-2xl bg-amber-50/80 border border-amber-200/40 shadow-xs hover:scale-105 transition-all duration-300">
                            <img src="/assets/iconaplikasi.png" alt="Logo SakuSiswa" class="w-11 h-11 mx-auto object-contain">
                        </div>
                        <div class="space-y-0.5">
                            <h2 class="text-xl lg:text-2xl font-extrabold text-slate-800 tracking-tight font-['Outfit']">
                                Saku<span class="text-amber-700">Siswa</span>
                            </h2>
                            <p class="text-xs text-slate-500 font-light tracking-wide leading-relaxed">
                                Masukkan kredensial Anda untuk memantau tabungan & saldo <span class="text-amber-700 font-semibold">secara berkala</span>.
                            </p>
                        </div>
                    </div>

                    <!-- Flash Success Floating Pop-up Modal (e.g. from registration redirect) -->
                    @if (session()->has('success'))
                        <div 
                            x-data="{ show: true }" 
                            x-show="show"
                            x-init="setTimeout(() => show = false, 6000)"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-90 translate-y-4"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-90 translate-y-4"
                            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-xs font-sans"
                        >
                            <div class="bg-white rounded-3xl p-6 sm:p-7 max-w-xs sm:max-w-sm w-full shadow-2xl border border-slate-100 text-center font-['Outfit'] space-y-4 relative">
                                <div class="w-16 h-16 rounded-full bg-emerald-50 border-4 border-emerald-100 flex items-center justify-center text-emerald-600 mx-auto animate-bounce">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                </div>
                                <div class="space-y-1.5">
                                    <h3 class="text-base font-extrabold text-slate-800 tracking-tight">Registrasi Berhasil!</h3>
                                    <p class="text-xs text-slate-600 font-medium leading-relaxed">
                                        {{ session('success') }}
                                    </p>
                                </div>
                                <button 
                                    @click="show = false" 
                                    class="w-full py-3 bg-[#ffd554] hover:bg-[#e5bf43] text-slate-900 font-extrabold rounded-xl text-xs transition-all active:scale-[0.98] cursor-pointer shadow-md"
                                >
                                    Siap, Masuk Sekarang
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- Input Form -->
                    <form wire:submit.prevent="login" class="space-y-3 font-sans animate-fade-in-up animation-delay-300">
                        <!-- Input: Email / Username -->
                        <div class="space-y-1">
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-amber-600">
                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"></path>
                                    </svg>
                                </span>
                                <input 
                                    type="text" 
                                    id="username_or_email" 
                                    wire:model="username_or_email"
                                    class="w-full pl-10 pr-4 py-2.5 rounded-2xl border border-amber-300/80 hover:border-amber-400 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20 bg-amber-50/20 hover:bg-amber-50/40 focus:bg-white text-xs md:text-sm font-medium placeholder-slate-400 focus:outline-none transition-all duration-300 font-sans"
                                    placeholder="Masukkan Email / NISN Siswa"
                                    autocomplete="username"
                                >
                            </div>
                            @error('username_or_email') <span class="text-xs text-rose-500 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <!-- Input: Password -->
                        <div class="space-y-1" x-data="{ showPass: false }">
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center text-amber-600">
                                    <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </span>
                                <input 
                                    :type="showPass ? 'text' : 'password'" 
                                    id="password" 
                                    wire:model="password"
                                    class="w-full pl-10 pr-11 py-2.5 rounded-2xl border border-amber-300/80 hover:border-amber-400 focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20 bg-amber-50/20 hover:bg-amber-50/40 focus:bg-white text-xs md:text-sm font-medium placeholder-slate-400 focus:outline-none transition-all duration-300 font-sans"
                                    placeholder="Password"
                                    autocomplete="current-password"
                                >
                                <button 
                                    type="button" 
                                    @click="showPass = !showPass"
                                    class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-amber-600 hover:text-amber-700 focus:outline-hidden cursor-pointer"
                                >
                                    <!-- Eye Icon (Open) -->
                                    <svg x-show="!showPass" class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.43 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                                    </svg>
                                    <!-- Eye Icon (Closed) -->
                                    <svg x-show="showPass" class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" style="display: none;">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.815 7.815L21 21m-3.957-3.957-1.4 1.4m-1.432-1.432a4.969 4.969 0 0 1-3.037.404M15 12a3 3 0 0 1 3 3m0 0a3.003 3.003 0 0 1-2.247-4.293M12 9a3 3 0 0 1 3 3"></path>
                                    </svg>
                                </button>
                            </div>
                            @error('password') <span class="text-xs text-rose-500 font-medium">{{ $message }}</span> @enderror
                        </div>

                        <!-- Forgot Password Link -->
                        <div class="flex justify-end text-xs select-none">
                            <a href="#" @click.prevent="showContact = true" class="text-amber-600 hover:text-amber-700 hover:underline font-semibold transition-colors duration-150">Lupa Password?</a>
                        </div>

                        <!-- Yellow Submit Button -->
                        <button 
                            type="submit" 
                            wire:loading.attr="disabled"
                            class="w-full h-11 md:h-12 bg-[#ffd554] hover:bg-[#e5bf43] text-slate-900 text-sm font-extrabold rounded-2xl shadow-lg shadow-amber-500/10 active:scale-[0.98] transition-all duration-300 flex items-center justify-center cursor-pointer disabled:opacity-75 disabled:cursor-not-allowed"
                        >
                            <span wire:loading.remove wire:target="login" class="tracking-wide">Masuk</span>
                            <span wire:loading wire:target="login">
                                <span class="flex items-center justify-center space-x-2">
                                    <svg class="animate-spin h-4.5 w-4.5 text-slate-900" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-90" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span class="tracking-wide font-extrabold text-slate-900">Memproses...</span>
                                </span>
                            </span>
                        </button>
                    </form>

                    <!-- Center Register Link under Submit Button -->
                    <div class="text-center pt-2 text-xs text-slate-500 font-medium animate-fade-in-up animation-delay-400">
                        Belum Punya Akun? <a href="/register" class="text-amber-600 font-bold hover:underline">Daftar Akun di Sini</a>
                    </div>
                </div>
            </div>

        </div>

        <!-- ======================================================== -->
        <!-- BOTTOM FOOTER                                            -->
        <!-- ======================================================== -->
        <div class="w-full mt-3 md:mt-4 pb-1 text-center text-[10px] sm:text-xs text-slate-500 font-medium relative z-10 font-['Outfit'] flex flex-col sm:flex-row items-center justify-center space-y-0.5 sm:space-y-0 sm:space-x-3 animate-fade-in-up animation-delay-500">
            <span>&copy; 2026 SakuSiswa. All rights reserved.</span>
            <span class="hidden sm:inline text-slate-300">|</span>
            <a href="/privacy-policy" class="text-slate-600 hover:text-amber-800 underline font-bold transition-colors">Kebijakan Privasi</a>
        </div>

    </div>

    <!-- ======================================================== -->
    <!-- MOBILE BOTTOM CORNER DECORATIVE LEAVES (Soft amber)      -->
    <!-- ======================================================== -->
    <!-- Bottom Left Leaves -->
    <div class="block md:hidden absolute bottom-0 left-0 w-24 h-24 text-amber-800/10 pointer-events-none z-0">
        <svg viewBox="0 0 100 100" fill="currentColor" class="w-full h-full">
            <path d="M0,100 C15,85 30,85 35,70 C40,55 35,40 30,30 C45,45 50,70 35,85 C28,92 14,96 0,100 Z" />
            <path d="M0,100 C20,92 35,80 35,65 C35,50 25,40 18,30 C30,45 42,70 28,85 C18,92 8,96 0,100 Z" />
        </svg>
    </div>
    <!-- Bottom Right Leaves -->
    <div class="block md:hidden absolute bottom-0 right-0 w-24 h-24 text-amber-800/10 pointer-events-none z-0">
        <svg viewBox="0 0 100 100" fill="currentColor" class="w-full h-full transform scale-x-[-1]">
            <path d="M0,100 C15,85 30,85 35,70 C40,55 35,40 30,30 C45,45 50,70 35,85 C28,92 14,96 0,100 Z" />
            <path d="M0,100 C20,92 35,80 35,65 C35,50 25,40 18,30 C30,45 42,70 28,85 C18,92 8,96 0,100 Z" />
        </svg>
    </div>

    <!-- Contact Info Modal (Alpine.js controlled) -->
    <div 
        x-show="showContact" 
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs font-sans"
        x-transition
        style="display: none;"
    >
        <div 
            @click.away="showContact = false" 
            class="bg-white rounded-3xl p-6 sm:p-8 max-w-sm w-full shadow-2xl border border-slate-100 relative font-['Outfit'] space-y-5 text-left"
        >
            <!-- Modal Header -->
            <div class="flex items-center justify-between border-b border-slate-100 pb-3">
                <div class="text-left space-y-0.5">
                    <h3 class="text-base font-black text-slate-800">Hubungi Administrator</h3>
                    <p class="text-[10px] text-slate-400 font-medium font-sans">Bantuan reset password & masalah akun</p>
                </div>
                <button @click="showContact = false" class="text-slate-400 hover:text-slate-650 cursor-pointer">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Content Info -->
            <div class="space-y-4 text-xs text-slate-700 leading-relaxed font-sans font-medium">
                <p>
                    Untuk menjaga keamanan data tabungan siswa, proses reset password atau pembuatan akun baru wajib dilakukan secara langsung oleh Administrator Sekolah.
                </p>
                
                <div class="flex flex-col space-y-2.5 pt-2 border-t border-slate-100 font-['Outfit']">
                    <!-- Direct WhatsApp Link Button -->
                    <a 
                        href="https://wa.me/6285782257192?text=Halo%20Admin%20SakuSiswa%2C%20saya%20ingin%20meminta%20bantuan%20terkait%20akun%20tabungan%20siswa." 
                        target="_blank"
                        class="w-full py-3.5 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold rounded-2xl text-xs transition-all active:scale-[0.98] cursor-pointer text-center flex items-center justify-center space-x-2 shadow-xs"
                    >
                        <svg class="w-4 h-4 fill-current text-white shrink-0" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.513 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.455L0 24zm6.59-4.846c1.62.962 3.238 1.486 4.887 1.487 5.467 0 9.914-4.444 9.918-9.907.002-2.646-1.03-5.131-2.903-7.005C16.681 1.86 14.198.83 11.554.83c-5.474 0-9.92 4.447-9.924 9.912-.001 1.76.47 3.486 1.365 5.034l-.993 3.626 3.71-.973zm13.114-6.42c-.085-.141-.31-.225-.648-.394-.338-.169-1.996-.983-2.306-1.096-.31-.113-.535-.169-.76.169-.225.338-.873 1.096-1.07 1.32-.197.225-.394.254-.732.085-.338-.169-1.427-.526-2.719-1.68-1.004-.896-1.681-2.002-1.879-2.34-.197-.338-.021-.52.148-.689.152-.152.338-.394.507-.59.169-.197.225-.338.338-.563.113-.225.056-.423-.028-.59-.085-.169-.76-1.832-1.042-2.516-.275-.662-.554-.572-.76-.582-.21-.01-.45-.01-.69-.01-.24 0-.63.09-.96.45-.33.36-1.265 1.24-1.265 3.02s1.3 3.49 1.48 3.73c.18.24 2.56 3.91 6.2 5.48.865.374 1.54.597 2.067.764.87.277 1.66.238 2.288.145.7-.104 1.996-.817 2.278-1.604.282-.788.282-1.464.197-1.604z"/>
                        </svg>
                        <span>Hubungi via WhatsApp</span>
                    </a>

                    <button 
                        type="button" 
                        @click="showContact = false"
                        class="w-full py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-extrabold rounded-2xl text-xs transition-all active:scale-[0.98] cursor-pointer text-center"
                    >
                        Tutup Jendela
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
