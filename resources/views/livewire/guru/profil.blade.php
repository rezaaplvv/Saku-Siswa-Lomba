<div x-data="{ 
    showModal: false, 
    showCurrentPass: false, 
    showNewPass: false, 
    showConfirmPass: false 
}" class="-mx-4 -mt-4 sm:-mx-6 sm:-mt-6 md:-mx-8 md:-mt-8 p-4 sm:p-6 md:p-8 min-h-screen bg-[#ffd554] pb-24 space-y-5.5 font-sans relative overflow-hidden">
    
    <!-- Leaf Decoration (Top Right background - Soft amber outline) -->
    <div class="absolute top-0 right-0 w-32 h-32 opacity-10 pointer-events-none translate-x-6 -translate-y-6 z-0">
        <svg class="w-full h-full text-amber-800" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17 2c-3.87 0-7 3.13-7 7 0 2.21 1.02 4.18 2.62 5.5L12 15c-.41.34-1.07.34-1.48 0L2.3 8.3c-.63-.5-1.52-.38-2 .25-.5.63-.38 1.52.25 2l8.22 6.7c1.39 1.13 3.47 1.13 4.86 0L22 10.3c.63-.5.75-1.39.25-2-.5-.63-1.39-.75-2-.25l-2.62 2.15C17.98 9.38 17 7.41 17 5V2z"/>
        </svg>
    </div>

    <!-- Container for Profile Cards (Option 3: Full-Width Symmetrical 2x2 Grid Desktop, 1-Column Mobile) -->
    <div class="w-full max-w-7xl mx-auto relative z-10 font-['Outfit']">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 md:gap-6 items-start">
            
            <!-- CARD 1: Profile Header & Data Diri Guru -->
            <div class="bg-gradient-to-br from-[#fffef9] via-white to-[#fffdfa] border border-amber-200/50 rounded-3xl p-6 shadow-xs space-y-5 relative overflow-hidden">
                <!-- Subtle Decorative Ambient Background Glows -->
                <div class="absolute -top-12 -right-12 w-44 h-44 bg-amber-300/20 rounded-full blur-2xl pointer-events-none z-0"></div>
                <div class="absolute -bottom-10 -left-10 w-36 h-36 bg-amber-400/15 rounded-full blur-xl pointer-events-none z-0"></div>
                
                <!-- Decorative School Badge Watermark Pattern (Top Right) -->
                <div class="absolute -top-3 -right-3 w-36 h-36 opacity-[0.14] text-amber-800 pointer-events-none rotate-12 z-0">
                    <svg fill="currentColor" viewBox="0 0 24 24" class="w-full h-full">
                        <path d="M12 3L1 9l11 6 9-4.91V17h2V9L12 3zm0 13.5L3.8 12 12 7.5l8.2 4.5L12 16.5zM5 13.18v4l7 3.82 7-3.82v-4L12 17l-7-3.82z"/>
                    </svg>
                </div>

                <!-- Profile Header: Avatar, Name and Role -->
                <div class="flex items-center space-x-4 relative z-10">
                    <div class="w-16 h-16 rounded-full bg-slate-100 border border-amber-200/60 flex items-center justify-center shrink-0 shadow-3xs overflow-hidden">
                        <img src="/assets/{{ $user->avatar ?? 'i1.png' }}" alt="Profile" class="w-full h-full object-cover rounded-full">
                    </div>
                    <div class="text-left space-y-1.5">
                        <h2 class="text-base font-extrabold text-slate-900 leading-tight font-sans">{{ $user->name }}</h2>
                        <div class="flex flex-wrap items-center gap-1.5">
                            <div class="inline-flex items-center space-x-1.5 px-3 py-1 bg-[#fff8e5] border border-amber-250/20 rounded-full text-[9px] font-extrabold text-amber-850 uppercase tracking-wide">
                                <svg class="w-3.5 h-3.5 text-amber-700 mr-0.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                                </svg>
                                Wali Kelas
                            </div>
                            <!-- Dedicated Edit Profil Button with Pencil Icon -->
                            <button 
                                type="button"
                                wire:click="openProfileModal"
                                class="inline-flex items-center space-x-1 px-3 py-1 bg-amber-400 hover:bg-amber-500 text-slate-900 rounded-full text-[9px] font-extrabold shadow-3xs transition-all active:scale-95 cursor-pointer"
                            >
                                <svg class="w-3 h-3 text-slate-900" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                                <span>Edit Profil</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Section 1: Data Diri Guru -->
                <div class="space-y-4 pt-4 border-t border-dashed border-slate-200 relative z-10">
                    <div class="flex items-center space-x-2 text-slate-800">
                        <div class="w-7 h-7 rounded-lg bg-[#fff8e5] border border-amber-100/50 flex items-center justify-center text-amber-700 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                        </div>
                        <h3 class="text-[11px] font-black text-slate-800 uppercase tracking-wider block">Data Diri Guru</h3>
                    </div>

                    <div class="space-y-3">
                        <!-- NIP card -->
                        <div class="bg-[#fffdf9] border border-amber-100/60 rounded-2xl p-3 flex items-center justify-between shadow-3xs">
                            <div class="flex items-center space-x-3 min-w-0 flex-1">
                                <div class="w-9 h-9 rounded-xl bg-[#fff8e5] border border-amber-100 flex items-center justify-center text-amber-700 shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                                    </svg>
                                </div>
                                <div class="text-left min-w-0">
                                    <span class="text-[8px] sm:text-[9px] text-amber-800/80 font-extrabold uppercase tracking-wider block">NIP (Nomor Induk Pegawai)</span>
                                    <span class="text-xs sm:text-sm font-black text-slate-800 block mt-0.5">{{ $user->nip ?? '-' }}</span>
                                </div>
                            </div>
                            <div x-data="{ copied: false }" class="shrink-0 pl-2">
                                <button 
                                    type="button"
                                    @click="navigator.clipboard.writeText('{{ $user->nip ?? '-' }}'); copied = true; setTimeout(() => copied = false, 2000)" 
                                    class="w-8.5 h-8.5 rounded-lg border border-amber-200/60 bg-white flex items-center justify-center hover:bg-amber-50 transition-colors shadow-3xs cursor-pointer active:scale-95"
                                >
                                    <svg x-show="!copied" class="w-4.5 h-4.5 text-amber-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z" />
                                    </svg>
                                    <svg x-show="copied" class="w-4.5 h-4.5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Email Aktif card -->
                        <div class="bg-[#fffdf9] border border-amber-100/60 rounded-2xl p-3 flex items-center justify-between shadow-3xs">
                            <div class="flex items-center space-x-3 min-w-0 flex-1">
                                <div class="w-9 h-9 rounded-xl bg-[#fff8e5] border border-amber-100 flex items-center justify-center text-amber-700 shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                                    </svg>
                                </div>
                                <div class="text-left min-w-0">
                                    <span class="text-[8px] sm:text-[9px] text-amber-800/80 font-extrabold uppercase tracking-wider block">Email Aktif</span>
                                    <span class="text-xs sm:text-sm font-black text-slate-800 block mt-0.5 truncate">{{ $user->email ?? '-' }}</span>
                                </div>
                            </div>
                            <div x-data="{ copied: false }" class="shrink-0 pl-2">
                                <button 
                                    type="button"
                                    @click="navigator.clipboard.writeText('{{ $user->email ?? '-' }}'); copied = true; setTimeout(() => copied = false, 2000)" 
                                    class="w-8.5 h-8.5 rounded-lg border border-amber-200/60 bg-white flex items-center justify-center hover:bg-amber-50 transition-colors shadow-3xs cursor-pointer active:scale-95"
                                >
                                    <svg x-show="!copied" class="w-4.5 h-4.5 text-amber-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 00-3.375-3.375h-1.5a1.125 1.125 0 01-1.125-1.125v-1.5A3.375 3.375 0 006.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0015 2.25h-1.5a2.251 2.251 0 00-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 00-9-9z" />
                                    </svg>
                                    <svg x-show="copied" class="w-4.5 h-4.5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="display: none;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CARD 2: Informasi Kelas & Sekolah -->
            <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-xs space-y-4">
                <div class="flex items-center space-x-2 text-slate-800">
                    <div class="w-7 h-7 rounded-lg bg-[#fff8e5] border border-amber-100/50 flex items-center justify-center text-amber-700 shrink-0">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21V10.5m0 0a3 3 0 11-6 0M12 10.5a3 3 0 106 0M3 21h18M12 3v3.75m0 0H7.5m4.5 0H16.5M7.5 12h9m-9 3h9m-9 3h9" />
                        </svg>
                    </div>
                    <h3 class="text-[11px] font-black text-slate-800 uppercase tracking-wider block">Informasi Kelas & Sekolah</h3>
                </div>

                <div class="grid grid-cols-3 gap-2.5 text-left">
                    <!-- Kelas Card -->
                    <div class="bg-[#fffbeb] border border-amber-100/60 rounded-2xl p-3 flex flex-col justify-between min-h-[120px]">
                        <div class="w-7 h-7 rounded-lg bg-[#fff1cc] flex items-center justify-center text-amber-800 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>
                        </div>
                        <div class="mt-2.5">
                            <span class="text-[8px] sm:text-[9px] text-amber-800 font-extrabold uppercase tracking-wider block">Kelas</span>
                            <span class="text-xs sm:text-sm font-black text-slate-800 block mt-0.5">{{ $className ?? '-' }}</span>
                        </div>
                    </div>

                    <!-- Jumlah Siswa Card -->
                    <div class="bg-[#fffbeb] border border-amber-100/60 rounded-2xl p-3 flex flex-col justify-between min-h-[120px]">
                        <div class="w-7 h-7 rounded-lg bg-[#fff1cc] flex items-center justify-center text-amber-800 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                        </div>
                        <div class="mt-2.5">
                            <span class="text-[8px] sm:text-[9px] text-amber-800 font-extrabold uppercase tracking-wider block">Jumlah Siswa</span>
                            <span class="text-xs sm:text-sm font-black text-slate-800 block mt-0.5">{{ $siswaCount }} Siswa</span>
                        </div>
                    </div>

                    <!-- Sekolah Card -->
                    <div class="bg-[#fffbeb] border border-amber-100/60 rounded-2xl p-3 flex flex-col justify-between min-h-[120px]">
                        <div class="w-7 h-7 rounded-lg bg-[#fff1cc] flex items-center justify-center text-amber-800 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                        </div>
                        <div class="mt-2.5 min-w-0">
                            <span class="text-[8px] sm:text-[9px] text-amber-800 font-extrabold uppercase tracking-wider block">Sekolah</span>
                            <span class="text-[10px] sm:text-xs font-black text-slate-800 block mt-0.5 leading-tight break-words">{{ $user->school_name ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CARD 3: Pengaturan Keamanan -->
            <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-xs space-y-4">
                <div class="flex items-center space-x-2 text-slate-800">
                    <div class="w-7 h-7 rounded-lg bg-[#fff8e5] border border-amber-100/50 flex items-center justify-center text-amber-700 shrink-0">
                        <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.57-.598-3.75h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                        </svg>
                    </div>
                    <h3 class="text-[11px] font-black text-slate-800 uppercase tracking-wider block">Pengaturan Keamanan</h3>
                </div>

                <button type="button" 
                        @click="showModal = true" 
                        class="flex items-center justify-between w-full p-4 rounded-2xl border border-slate-100 bg-[#fffdf9] hover:bg-amber-50/20 hover:border-amber-200/55 transition-all cursor-pointer text-left focus:outline-hidden">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 border border-amber-100/50 flex items-center justify-center text-amber-600 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                            </svg>
                        </div>
                        <div>
                            <h5 class="text-xs font-bold text-slate-800">Ubah Password Login</h5>
                            <p class="text-[10px] text-slate-400 font-medium mt-0.5">Perbarui password untuk keamanan akun Anda</p>
                        </div>
                    </div>
                    <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                    </svg>
                </button>
            </div>

            <!-- CARD 4: Logout Action (Solid Black Button) -->
            <div class="bg-white border border-slate-100 rounded-3xl p-6 shadow-xs flex flex-col justify-center min-h-[120px]">
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
    </div>

    <!-- Change Password Modal -->
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
        <div class="bg-white rounded-t-3xl sm:rounded-2xl w-full max-w-sm p-6 shadow-2xl relative text-left"
             x-show="showModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-y-full sm:scale-95 sm:translate-y-0"
             x-transition:enter-end="translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-y-0 sm:scale-100"
             x-transition:leave-end="translate-y-full sm:scale-95 sm:translate-y-0"
             @click.away="showModal = false">
             
             <div class="flex justify-between items-center mb-4">
                 <h3 class="text-base font-bold text-slate-800 font-['Outfit']">Ubah Password Login</h3>
                 <button @click="showModal = false" class="text-slate-400 hover:text-slate-656 focus:outline-hidden cursor-pointer">
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
    </div>

    <!-- Floating Success Toast / Pop-up -->
    @if(session()->has('success'))
        <div 
            x-data="{ 
                show: true, 
                progress: 100,
                timer: null,
                init() {
                    const duration = 3500;
                    const interval = 35;
                    const step = (interval / duration) * 100;
                    this.timer = setInterval(() => {
                        this.progress -= step;
                        if (this.progress <= 0) {
                            clearInterval(this.timer);
                            this.show = false;
                        }
                    }, interval);
                },
                close() {
                    if (this.timer) clearInterval(this.timer);
                    this.show = false;
                }
            }" 
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 backdrop-blur-none"
            x-transition:enter-end="opacity-100 backdrop-blur-xs"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 backdrop-blur-xs"
            x-transition:leave-end="opacity-0 backdrop-blur-none"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 font-sans"
        >
            <div 
                x-show="show"
                x-transition:enter="transition ease-[cubic-bezier(0.34,1.56,0.64,1)] duration-400"
                x-transition:enter-start="opacity-0 scale-75 translate-y-6"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-90 -translate-y-4"
                class="bg-gradient-to-br from-[#ffd554] via-[#ffca36] to-[#f5b81a] rounded-3xl p-5 max-w-[260px] w-full shadow-2xl border-2 border-amber-300/80 text-center font-['Outfit'] space-y-3.5 relative overflow-hidden"
            >
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
                
                <!-- Dismiss button & Progress Bar -->
                <div class="space-y-2">
                    <button 
                        @click="close()" 
                        class="w-full py-2.5 bg-slate-950 hover:bg-slate-900 text-white font-extrabold rounded-xl text-xs shadow-md active:scale-95 transition-all cursor-pointer"
                    >
                        Tutup
                    </button>
                    <!-- Sleek Progress Countdown Bar -->
                    <div class="w-full bg-slate-950/15 rounded-full h-1 overflow-hidden">
                        <div class="bg-slate-950 h-full transition-all ease-linear duration-75" :style="`width: ${progress}%`"></div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- Edit Profile Modal -->
    @if($isProfileModalOpen)
        <div 
            x-data="{ 
                show: false, 
                closeModal() { 
                    this.show = false; 
                    setTimeout(() => $wire.closeProfileModal(), 250); 
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
                class="bg-white rounded-3xl w-full max-w-md p-6 shadow-2xl relative text-left border border-slate-100 space-y-4 max-h-[90vh] overflow-y-auto"
            >
                <div class="flex justify-between items-center border-b pb-3">
                    <h3 class="text-base font-extrabold text-slate-800">Edit Profil & Informasi Kelas</h3>
                    <button type="button" @click="closeModal()" class="text-slate-400 hover:text-slate-600 cursor-pointer">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <form wire:submit.prevent="saveProfile" class="space-y-3.5">
                    <!-- Avatar Selection Section (Top of Modal) -->
                    <div class="space-y-1.5 pb-1">
                        <label class="text-xs font-bold text-slate-700">Pilih Foto Avatar Profil</label>
                        <div class="grid grid-cols-4 gap-2 bg-slate-50 p-2.5 rounded-2xl border border-slate-200/80">
                            @foreach(['i1.png', 'i2.png', 'i3.png', 'i4.png', 'i5.png', 'i6.png', 'i7.png', 'i8.png'] as $icon)
                                <button 
                                    type="button" 
                                    wire:click="selectAvatar('{{ $icon }}')"
                                    class="relative rounded-2xl p-1 transition-all duration-200 flex items-center justify-center cursor-pointer group {{ $avatar === $icon ? 'bg-amber-100 ring-3 ring-amber-400 scale-105 shadow-xs' : 'bg-white hover:bg-slate-100 border border-slate-200' }}"
                                >
                                    <img src="/assets/{{ $icon }}" alt="Avatar {{ $icon }}" class="w-10 h-10 object-contain rounded-xl">
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

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Nama Lengkap Guru</label>
                        <input type="text" wire:model="name" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-xs font-bold bg-slate-50 focus:outline-none focus:border-amber-500" placeholder="Contoh: Rangga Wijaya, S.Pd." required>
                        @error('name') <span class="text-[10px] text-rose-500 font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">NIP (Nomor Induk Pegawai)</label>
                        <input 
                            type="text" 
                            inputmode="numeric" 
                            pattern="[0-9]*" 
                            maxlength="18" 
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                            wire:model="nip" 
                            class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-xs font-mono font-bold bg-slate-50 focus:outline-none focus:border-amber-500 tracking-wider" 
                            placeholder="18 Digit Angka NIP (Opsional)"
                        >
                        @error('nip') <span class="text-[10px] text-rose-500 font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Nama Sekolah</label>
                        <input type="text" wire:model="school_name" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-xs font-bold bg-slate-50 focus:outline-none focus:border-amber-500" placeholder="Contoh: SDN 01 Sukamaju" required>
                        @error('school_name') <span class="text-[10px] text-rose-500 font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div class="space-y-1">
                        <label class="text-xs font-bold text-slate-700">Nama Kelas Binaan</label>
                        <input type="text" wire:model="edit_class_name" class="w-full px-4 py-2.5 border border-slate-200 rounded-xl text-xs font-bold bg-slate-50 focus:outline-none focus:border-amber-500" placeholder="Contoh: Kelas 5B" required>
                        @error('edit_class_name') <span class="text-[10px] text-rose-500 font-bold">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-2 flex items-center justify-end space-x-2">
                        <button type="button" @click="closeModal()" class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl text-xs transition-all cursor-pointer">Batal</button>
                        <button type="submit" class="px-5 py-2.5 bg-[#ffd554] hover:bg-[#e5bf43] text-slate-900 font-extrabold rounded-xl text-xs transition-all cursor-pointer shadow-md">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
