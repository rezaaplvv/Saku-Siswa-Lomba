<div x-data="{ 
    showModal: false, 
    modalType: '', 
    showCurrentPass: false, 
    showNewPass: false, 
    showConfirmPass: false, 
    showLoginPass: false 
}" class="-mx-4 -mt-4 sm:-mx-6 sm:-mt-6 md:-mx-8 md:-mt-8 p-4 sm:p-6 md:p-8 min-h-screen bg-[#ffd554] pb-6 space-y-6 font-sans relative overflow-hidden">
    
    <!-- Leaf Decoration (Top Right background - Soft amber outline) -->
    <div class="absolute top-0 right-0 w-32 h-32 opacity-10 pointer-events-none translate-x-6 -translate-y-6 z-0">
        <svg class="w-full h-full text-amber-800" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17 2c-3.87 0-7 3.13-7 7 0 2.21 1.02 4.18 2.62 5.5L12 15c-.41.34-1.07.34-1.48 0L2.3 8.3c-.63-.5-1.52-.38-2 .25-.5.63-.38 1.52.25 2l8.22 6.7c1.39 1.13 3.47 1.13 4.86 0L22 10.3c.63-.5.75-1.39.25-2-.5-.63-1.39-.75-2-.25l-2.62 2.15C17.98 9.38 17 7.41 17 5V2z"/>
        </svg>
    </div>

    @php
        // Dynamically calculate initials from student's name
        $words = explode(' ', $student->name);
        $initials = '';
        if (count($words) >= 2) {
            $initials = substr($words[0], 0, 1) . substr($words[1], 0, 1);
        } else {
            $initials = substr($student->name, 0, 2);
        }
        $initials = strtoupper($initials);

        // Dynamically calculate academic year based on current month
        $currentYear = (int) date('Y');
        $currentMonth = (int) date('n');
        $academicYear = $currentMonth >= 7 
            ? $currentYear . ' / ' . ($currentYear + 1) 
            : ($currentYear - 1) . ' / ' . $currentYear;
    @endphp

    <!-- Header Welcome -->
    <div class="flex items-center justify-between relative z-10 pt-2">
        <div>
            <h2 class="text-xl font-extrabold text-slate-900 tracking-tight font-['Outfit']">Profil Orang Tua</h2>
            <p class="text-xs text-slate-700 font-medium">Informasi akun dan pengaturan keamanan</p>
        </div>
    </div>

    <!-- Floating Success Toast / Pop-up -->
    @if(session()->has('success'))
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
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-xs font-sans"
        >
            <div class="bg-gradient-to-br from-[#ffd554] via-[#ffca36] to-[#f5b81a] rounded-3xl p-5 max-w-[260px] w-full shadow-2xl border-2 border-amber-300/80 text-center font-['Outfit'] space-y-3.5 relative animate-scaleIn">
                <!-- Lottie Success Animation -->
                <div class="w-20 h-20 mx-auto flex items-center justify-center">
                    <lottie-player src="/assets/success.json" background="transparent" speed="1" class="w-full h-full" autoplay></lottie-player>
                </div>
                
                <!-- Success Text -->
                <div class="space-y-1 px-1">
                    <h3 class="text-base font-black text-slate-950 tracking-tight">Berhasil!</h3>
                    <p class="text-xs text-slate-900 font-extrabold leading-snug">
                        {{ session('success') }}
                    </p>
                </div>
                
                <!-- Dismiss button -->
                <button 
                    @click="show = false" 
                    class="w-full py-2.5 bg-slate-950 hover:bg-slate-900 text-white font-extrabold rounded-xl text-xs shadow-md active:scale-95 transition-all cursor-pointer"
                >
                    Tutup
                </button>
            </div>
        </div>
    @endif

    <!-- Main Desktop & Mobile Responsive Grid Wrapper (Option 2 Final: Hero Header Top + 2-Column Bottom) -->
    <div class="w-full max-w-7xl mx-auto space-y-5 relative z-10 font-['Outfit']">
        
        <!-- TOP CARD (FULL WIDTH HERO): INFORMASI AKUN -->
        <div class="bg-white rounded-3xl p-6 shadow-xs border border-slate-100/80 space-y-5 relative z-10 overflow-hidden">
            <!-- Subtle Ambient Background Glows -->
            <div class="absolute -top-12 -right-12 w-44 h-44 bg-amber-300/15 rounded-full blur-2xl pointer-events-none z-0"></div>
            
            <!-- Section Header -->
            <div class="flex items-center space-x-2 pb-1 relative z-10">
                <div class="w-6 h-6 rounded-lg bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 shrink-0">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
                <h4 class="text-[11px] font-extrabold text-slate-800 uppercase tracking-wider">Informasi Akun Wali Murid</h4>
            </div>

            <!-- Avatar and Student Name with Edit Button -->
            <div class="flex items-center space-x-4 pb-4 border-b border-slate-100 relative z-10">
                <div class="relative shrink-0">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-slate-100 border-2 border-amber-300/60 flex items-center justify-center overflow-hidden shadow-xs">
                        <img src="/assets/{{ $student->avatar ?? 'i1.png' }}" alt="Profile" class="w-full h-full object-cover rounded-full">
                    </div>
                    <button 
                        type="button" 
                        wire:click="openAvatarModal" 
                        class="absolute -bottom-1.5 left-1/2 -translate-x-1/2 inline-flex items-center space-x-1 px-2.5 py-0.5 bg-amber-400 hover:bg-amber-500 text-slate-950 rounded-full text-[9px] font-extrabold shadow-md transition-all active:scale-95 cursor-pointer z-10 whitespace-nowrap border-2 border-white"
                        title="Ganti Foto Profil"
                    >
                        <svg class="w-2.5 h-2.5 text-slate-950" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>
                        <span>Edit</span>
                    </button>
                </div>
                <div class="space-y-1">
                    <h3 class="text-base sm:text-lg font-extrabold text-slate-800 tracking-tight font-['Outfit']">{{ $student->name }}</h3>
                    <span class="inline-flex px-3 py-0.5 rounded-full text-[10px] font-extrabold bg-amber-50 text-amber-800 border border-amber-100 uppercase tracking-wider">
                        Wali Murid Siswa
                    </span>
                </div>
            </div>

            <!-- Info List Rows (3-Column Grid on Desktop) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 pt-1 relative z-10">
                <!-- NISN -->
                <div class="bg-[#fffdf9] border border-amber-100/60 rounded-2xl p-3 flex items-center justify-between shadow-3xs">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm-1.25 5.25a3.75 3.75 0 00-5 0v1.125h5v-1.125z" />
                            </svg>
                        </div>
                        <div class="text-left">
                            <span class="text-[8px] sm:text-[9px] text-amber-800/80 font-extrabold uppercase tracking-wider block">NISN Siswa</span>
                            <span class="text-xs sm:text-sm font-black text-slate-800 block mt-0.5">{{ $student->nisn }}</span>
                        </div>
                    </div>
                </div>

                <!-- Kelas -->
                <div class="bg-[#fffdf9] border border-amber-100/60 rounded-2xl p-3 flex items-center justify-between shadow-3xs">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147L12 3.75l7.74 6.397m-15.48 0L12 16.5l7.74-6.353m-15.48 0v4.441c0 .762.407 1.464 1.072 1.84L12 20.25l6.668-3.952c.665-.376 1.072-1.078 1.072-1.84V10.147" />
                            </svg>
                        </div>
                        <div class="text-left">
                            <span class="text-[8px] sm:text-[9px] text-amber-800/80 font-extrabold uppercase tracking-wider block">Kelas</span>
                            <span class="text-xs sm:text-sm font-black text-slate-800 block mt-0.5">{{ $student->class_name }}</span>
                        </div>
                    </div>
                </div>

                <!-- Tahun Ajaran -->
                <div class="bg-[#fffdf9] border border-amber-100/60 rounded-2xl p-3 flex items-center justify-between shadow-3xs">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-xl bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                            </svg>
                        </div>
                        <div class="text-left">
                            <span class="text-[8px] sm:text-[9px] text-amber-800/80 font-extrabold uppercase tracking-wider block">Tahun Ajaran</span>
                            <span class="text-xs sm:text-sm font-black text-slate-800 block mt-0.5">{{ $academicYear }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- BOTTOM GRID (2-COLUMN ON DESKTOP) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 items-start">
            
            <!-- LEFT COLUMN: KEAMANAN AKUN & LOGOUT ACTION -->
            <div class="space-y-4">
                <!-- CARD 1: Keamanan Akun -->
                <div class="bg-white rounded-3xl p-6 shadow-xs border border-slate-100/80 space-y-4">
                    <div class="flex items-center space-x-2 pb-1">
                        <div class="w-6 h-6 rounded-lg bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                            </svg>
                        </div>
                        <h4 class="text-[11px] font-extrabold text-slate-800 uppercase tracking-wider">Keamanan Akun</h4>
                    </div>

                    <div class="space-y-3">
                        <!-- Action Button 1: Ubah PIN Penarikan -->
                        <button type="button" 
                                @click="modalType = 'pin'; showModal = true" 
                                class="flex items-center justify-between w-full p-4 rounded-2xl border border-slate-100 bg-[#fffdf9] hover:bg-amber-50/30 hover:border-amber-200/60 transition-all cursor-pointer text-left group">
                            <div class="flex items-center space-x-3.5">
                                <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-100/60 flex items-center justify-center text-amber-700 shrink-0 group-hover:scale-105 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="text-xs font-bold text-slate-800">Ubah PIN Penarikan (6-Digit)</h5>
                                    <p class="text-[10px] text-slate-400 font-medium mt-0.5">Keamanan otorisasi saat melakukan tarik tabungan</p>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-amber-600 group-hover:translate-x-0.5 transition-all shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>

                        <!-- Action Button 2: Ubah Password Login -->
                        <button type="button" 
                                @click="modalType = 'password'; showModal = true" 
                                class="flex items-center justify-between w-full p-4 rounded-2xl border border-slate-100 bg-[#fffdf9] hover:bg-amber-50/30 hover:border-amber-200/60 transition-all cursor-pointer text-left group">
                            <div class="flex items-center space-x-3.5">
                                <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-100/60 flex items-center justify-center text-amber-700 shrink-0 group-hover:scale-105 transition-transform">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 013 3m3 0a6 6 0 01-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1121.75 8.25z" />
                                    </svg>
                                </div>
                                <div>
                                    <h5 class="text-xs font-bold text-slate-800">Ubah Password Login</h5>
                                    <p class="text-[10px] text-slate-400 font-medium mt-0.5">Perbarui kata sandi untuk masuk ke aplikasi SakuSiswa</p>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-amber-600 group-hover:translate-x-0.5 transition-all shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- CARD: Logout Action (Moved to Left Column under Keamanan Akun) -->
                <div class="bg-white rounded-3xl p-5 shadow-xs border border-slate-100/80">
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="w-full py-3.5 bg-slate-950 hover:bg-slate-900 text-white font-extrabold rounded-2xl flex items-center justify-center space-x-2 text-xs transition-all active:scale-[0.98] cursor-pointer shadow-md font-sans">
                            <svg class="w-4.5 h-4.5 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>
                            <span>Keluar dari Akun</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- RIGHT COLUMN: STATUS KARTU & HUBUNGI ADMIN -->
            <div class="space-y-4">
                <!-- CARD 2: Status Kartu Identitas Siswa (Icon removed) -->
                <div class="bg-white rounded-3xl p-6 shadow-xs border border-slate-100/80 space-y-4">
                    <div class="pb-1">
                        <h4 class="text-[11px] font-extrabold text-slate-800 uppercase tracking-wider">Status Kartu Identitas Tabungan</h4>
                    </div>

                    <div class="bg-gradient-to-r from-emerald-500/10 via-teal-500/5 to-transparent border border-emerald-500/20 rounded-2xl p-4 flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-9 h-9 rounded-xl bg-emerald-500 text-white flex items-center justify-center shrink-0 shadow-xs">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <span class="text-[10px] font-extrabold text-emerald-700 uppercase tracking-wider block">Status Kartu Siswa</span>
                                <span class="text-xs font-black text-slate-800 block mt-0.5">AKTIF & DIVERIFIKASI</span>
                            </div>
                        </div>
                        <span class="inline-flex px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-[10px] font-black uppercase tracking-wider">
                            VERIFIED
                        </span>
                    </div>
                </div>

                <!-- CARD 3: Hubungi Admin SakuSiswa (Icon removed) -->
                <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-xs text-slate-800 relative z-10 overflow-hidden flex flex-col justify-between min-h-[175px]">
                    <div class="flex">
                        <!-- Left Side Details -->
                        <div class="w-3/5 pr-1 z-10">
                            <div class="mb-2.5">
                                <h5 class="text-[11px] font-extrabold text-slate-800 uppercase tracking-wider font-['Outfit']">Hubungi Admin SakuSiswa</h5>
                            </div>
                            <p class="text-[10px] text-slate-500 font-semibold leading-relaxed mb-4">
                                Butuh bantuan mengenai saldo, Lupa Password, pendaftaran PIN, atau penarikan? Hubungi Admin SakuSiswa.
                            </p>
                        </div>
                        
                        <!-- Right Side Graphic Image -->
                        <div class="w-1/2 absolute -right-6 -top-10 h-48 flex items-center justify-end pointer-events-none z-0">
                            <img src="/assets/contact.png" alt="Hubungi Sekolah" class="w-40 h-40 md:w-44 md:h-44 object-contain translate-y-3">
                        </div>
                    </div>

                    <!-- WhatsApp Button -->
                    <a href="https://wa.me/6285782257192?text=Halo%20Admin%20SakuSiswa%2C%20saya%20wali%20murid%20dari%20{{ urlencode($student->name) }}%20(NISN%3A%20{{ urlencode($student->nisn) }})%20Kelas%20{{ urlencode($student->class_name) }}%20ingin%20meminta%20informasi%20bantuan%20seputar%20tabungan." 
                       target="_blank" 
                       class="flex w-full justify-between items-center py-3 px-4 bg-[#25D366] hover:bg-[#1eb956] text-white font-extrabold rounded-2xl transition-all shadow-xs cursor-pointer z-10 mt-auto">
                        <div class="flex items-center space-x-2">
                            <!-- WhatsApp SVG icon -->
                            <svg class="w-4 h-4 fill-current text-white" viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.513 2.262 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.5-5.739-1.451L0 24zm6.59-4.846c1.6.95 2.7 1.448 4.26 1.449 5.485.002 9.947-4.462 9.95-9.95.003-2.66-1.025-5.16-2.897-7.03C15.99 1.75 13.49 1.72 12.01 1.72c-5.492 0-9.956 4.462-9.96 9.953-.002 1.83.477 3.62 1.39 5.22L2.317 21l4.33-1.846zm11.306-6.626c-.3-.15-1.776-.877-2.05-.977-.275-.1-.475-.15-.675.15-.2.3-.775.976-.95 1.176-.175.2-.35.225-.65.075-.3-.15-1.267-.467-2.413-1.49-.892-.796-1.493-1.78-1.668-2.08-.175-.3-.018-.463.13-.61.134-.133.3-.349.45-.524.15-.175.2-.3.3-.5.1-.2.05-.375-.025-.525-.075-.15-.675-1.625-.925-2.225-.244-.589-.492-.51-.675-.52-.175-.01-.375-.01-.575-.01-.2 0-.525.075-.8.375-.275.3-1.05 1.025-1.05 2.5 0 1.475 1.075 2.9 1.225 3.1.15.2 2.11 3.22 5.11 4.52.714.31 1.27.495 1.7.63.717.227 1.37.195 1.888.118.577-.087 1.776-.726 2.025-1.426.25-.7.25-1.3 1.176-.176-.15-1.125-.15-1.25-.15z"/>
                            </svg>
                            <span>Hubungi WhatsApp Admin</span>
                        </div>
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- ======================================================== -->
    <!-- SECURE SUPPORT MODAL OVERLAY (With Forms)                -->
    <!-- ======================================================== -->
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs z-[100] flex items-end sm:items-center justify-center p-4"
         x-show="showModal" 
         @close-modal.window="showModal = false"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         style="display: none;">
         
        <!-- Modal Content Card -->
        <div class="bg-white rounded-3xl w-full max-w-sm p-6 shadow-2xl relative text-left border border-slate-100"
             x-show="showModal"
             x-transition:enter="transition ease-[cubic-bezier(0.16,1,0.3,1)] duration-450 transform"
             x-transition:enter-start="translate-y-full opacity-0 scale-95"
             x-transition:enter-end="translate-y-0 opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-250 transform"
             x-transition:leave-start="translate-y-0 opacity-100 scale-100"
             x-transition:leave-end="translate-y-full opacity-0 scale-95"
             @click.away="showModal = false">
             
             <!-- Tab 1: Password Form -->
             <div x-show="modalType === 'password'">
                 <div class="flex justify-between items-center mb-4">
                     <h3 class="text-base font-bold text-slate-800 font-['Outfit']">Ubah Password Login</h3>
                     <button @click="showModal = false" class="text-slate-400 hover:text-slate-600 focus:outline-hidden cursor-pointer">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                         </svg>
                     </button>
                 </div>
                 
                 <form wire:submit.prevent="changePassword" class="space-y-4">
                     <div class="space-y-1">
                         <label for="current_password" class="text-xs font-semibold text-slate-500">Password Saat Ini</label>
                         <div class="relative">
                             <input :type="showCurrentPass ? 'text' : 'password'" 
                                    id="current_password" 
                                    wire:model="current_password" 
                                    class="w-full pl-3.5 pr-10 py-2.5 rounded-xl border border-slate-300 hover:border-amber-400 focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-white transition-colors text-xs font-semibold shadow-3xs" 
                                    required>
                             <button type="button" @click="showCurrentPass = !showCurrentPass" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-655 focus:outline-hidden cursor-pointer">
                                 <!-- Eye Open -->
                                 <svg x-show="showCurrentPass" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                     <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                 </svg>
                                 <!-- Eye Closed -->
                                 <svg x-show="!showCurrentPass" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display: none;">
                                     <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223a10.477 10.477 0 00-2.046 3.777C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                 </svg>
                             </button>
                         </div>
                         @error('current_password') <span class="text-[10px] text-rose-500 font-bold block mt-1">{{ $message }}</span> @enderror
                     </div>
 
                     <div class="space-y-1">
                         <label for="new_password" class="text-xs font-semibold text-slate-500">Password Baru</label>
                         <div class="relative">
                             <input :type="showNewPass ? 'text' : 'password'" 
                                    id="new_password" 
                                    wire:model="new_password" 
                                    class="w-full pl-3.5 pr-10 py-2.5 rounded-xl border border-slate-300 hover:border-amber-400 focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-white transition-colors text-xs font-semibold shadow-3xs" 
                                    required>
                             <button type="button" @click="showNewPass = !showNewPass" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-655 focus:outline-hidden cursor-pointer">
                                 <!-- Eye Open -->
                                 <svg x-show="showNewPass" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                     <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                 </svg>
                                 <!-- Eye Closed -->
                                 <svg x-show="!showNewPass" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display: none;">
                                     <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223a10.477 10.477 0 00-2.046 3.777C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                 </svg>
                             </button>
                         </div>
                         @error('new_password') <span class="text-[10px] text-rose-500 font-bold block mt-1">{{ $message }}</span> @enderror
                     </div>
 
                     <div class="space-y-1">
                         <label for="new_password_confirmation" class="text-xs font-semibold text-slate-500">Konfirmasi Password Baru</label>
                         <div class="relative">
                             <input :type="showConfirmPass ? 'text' : 'password'" 
                                    id="new_password_confirmation" 
                                    wire:model="new_password_confirmation" 
                                    class="w-full pl-3.5 pr-10 py-2.5 rounded-xl border border-slate-300 hover:border-amber-400 focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-white transition-colors text-xs font-semibold shadow-3xs" 
                                    required>
                             <button type="button" @click="showConfirmPass = !showConfirmPass" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-655 focus:outline-hidden cursor-pointer">
                                 <!-- Eye Open -->
                                 <svg x-show="showConfirmPass" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                     <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                 </svg>
                                 <!-- Eye Closed -->
                                 <svg x-show="!showConfirmPass" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display: none;">
                                     <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223a10.477 10.477 0 00-2.046 3.777C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                 </svg>
                             </button>
                         </div>
                     </div>
                     
                     <button type="submit" 
                             class="inline-flex w-full justify-center items-center py-3 bg-[#ffd554] hover:bg-[#e5bf43] text-slate-900 font-extrabold rounded-xl shadow-md transition-all active:scale-[0.98] cursor-pointer text-center text-xs">
                         Simpan Password Baru
                     </button>
                 </form>
             </div>
 
             <!-- Tab 2: PIN Form -->
             <div x-show="modalType === 'pin'">
                 <div class="flex justify-between items-center mb-4">
                     <h3 class="text-base font-bold text-slate-800 font-['Outfit']" x-text="is_pin_set ? 'Ubah PIN Transaksi' : 'Buat PIN Transaksi'"></h3>
                     <button @click="showModal = false" class="text-slate-400 hover:text-slate-600 focus:outline-hidden cursor-pointer">
                         <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                         </svg>
                     </button>
                 </div>
                 
                 <form wire:submit.prevent="changePin" class="space-y-4">
                     <div class="space-y-1">
                         <label for="login_password" class="text-xs font-semibold text-slate-500">Password Login Anda</label>
                         <div class="relative">
                             <input :type="showLoginPass ? 'text' : 'password'" 
                                    id="login_password" 
                                    wire:model="login_password" 
                                    class="w-full pl-3.5 pr-10 py-2.5 rounded-xl border border-slate-300 hover:border-amber-400 focus:outline-hidden focus:border-amber-500 focus:ring-4 focus:ring-amber-500/10 bg-white transition-colors text-xs font-semibold shadow-3xs" 
                                    required>
                             <button type="button" @click="showLoginPass = !showLoginPass" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-655 focus:outline-hidden cursor-pointer">
                                 <!-- Eye Open -->
                                 <svg x-show="showLoginPass" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                     <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                 </svg>
                                 <!-- Eye Closed -->
                                 <svg x-show="!showLoginPass" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display: none;">
                                     <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223a10.477 10.477 0 00-2.046 3.777C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                 </svg>
                             </button>
                         </div>
                         @error('login_password') <span class="text-[10px] text-rose-500 font-bold block mt-1">{{ $message }}</span> @enderror
                     </div>
 
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
                          @error('new_pin') <span class="text-[10px] text-rose-500 font-bold block mt-1">{{ $message }}</span> @enderror
                      </div>
 
                      <div class="space-y-1">
                          <label for="new_pin_confirmation" class="text-xs font-semibold text-slate-500">Konfirmasi PIN Baru</label>
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
                             class="inline-flex w-full justify-center items-center py-3 bg-[#ffd554] hover:bg-[#e5bf43] text-slate-900 font-extrabold rounded-xl shadow-md transition-all active:scale-[0.98] cursor-pointer text-center text-xs">
                         Simpan PIN Transaksi
                     </button>
                 </form>
             </div>

        </div>
    </div>

    <!-- Edit Avatar Modal for Parent -->
    @if($isAvatarModalOpen)
        <div 
            x-data="{ 
                show: false, 
                closeModal() { 
                    this.show = false; 
                    setTimeout(() => $wire.closeAvatarModal(), 250); 
                } 
            }"
            x-init="$nextTick(() => show = true)"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 backdrop-blur-none"
            x-transition:enter-end="opacity-100 backdrop-blur-xs"
            x-transition:leave="transition ease-in duration-250"
            x-transition:leave-start="opacity-100 backdrop-blur-xs"
            x-transition:leave-end="opacity-0 backdrop-blur-none"
            class="fixed inset-0 bg-slate-900/60 z-[100] flex items-end sm:items-center justify-center p-4 font-['Outfit']"
        >
            <div 
                x-show="show"
                x-transition:enter="transition ease-[cubic-bezier(0.16,1,0.3,1)] duration-500 transform"
                x-transition:enter-start="translate-y-full opacity-0 scale-95"
                x-transition:enter-end="translate-y-0 opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-250 transform"
                x-transition:leave-start="translate-y-0 opacity-100 scale-100"
                x-transition:leave-end="translate-y-full opacity-0 scale-95"
                class="bg-white rounded-3xl w-full max-w-sm p-6 shadow-2xl relative text-left border border-slate-100 space-y-4 font-['Outfit']"
            >
                <div class="flex justify-between items-center border-b pb-3">
                    <div class="flex items-center space-x-2">
                        <div class="w-6 h-6 rounded-lg bg-amber-50 border border-amber-100 flex items-center justify-center text-amber-600 shrink-0">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-extrabold text-slate-800">Edit Foto Profil Avatar</h3>
                    </div>
                    <button type="button" @click="closeModal()" class="text-slate-400 hover:text-slate-600 cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form wire:submit.prevent="saveAvatar" class="space-y-4">
                    <div class="space-y-2">
                        <p class="text-xs text-slate-500 font-semibold leading-relaxed">
                            Pilih salah satu karakter avatar di bawah ini untuk digunakan sebagai foto profil Anda:
                        </p>
                        <div class="grid grid-cols-4 gap-2 bg-slate-50 p-3 rounded-2xl border border-slate-200/80">
                            @foreach(['i1.png', 'i2.png', 'i3.png', 'i4.png', 'i5.png', 'i6.png', 'i7.png', 'i8.png'] as $icon)
                                <button 
                                    type="button" 
                                    wire:click="selectAvatar('{{ $icon }}')"
                                    class="relative rounded-2xl p-1 transition-all duration-200 flex items-center justify-center cursor-pointer group {{ $avatar === $icon ? 'bg-amber-100 ring-3 ring-amber-400 scale-105 shadow-xs' : 'bg-white hover:bg-slate-100 border border-slate-200' }}"
                                >
                                    <img src="/assets/{{ $icon }}" alt="Avatar {{ $icon }}" class="w-11 h-11 object-contain rounded-xl">
                                    @if($avatar === $icon)
                                        <div class="absolute -top-1 -right-1 w-4 h-4 bg-amber-500 text-slate-950 rounded-full flex items-center justify-center shadow-xs">
                                            <svg class="w-3 h-3 stroke-[3]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                                            </svg>
                                        </div>
                                    @endif
                                </button>
                            @endforeach
                        </div>
                    </div>

                    <div class="pt-2 flex items-center justify-end space-x-2">
                        <button type="button" @click="closeModal()" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs transition-all cursor-pointer">Batal</button>
                        <button type="submit" class="px-5 py-2.5 bg-[#ffd554] hover:bg-[#e5bf43] text-slate-900 font-extrabold rounded-xl text-xs transition-all cursor-pointer shadow-md">Simpan Avatar</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
