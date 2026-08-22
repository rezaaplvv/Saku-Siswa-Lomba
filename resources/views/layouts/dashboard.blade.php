<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="color-scheme" content="only light">
    <title>{{ $title ?? 'Dasbor - SakuSiswa' }}</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/assets/iconaplikasi.png">
    <link rel="shortcut icon" type="image/png" href="/assets/iconaplikasi.png">
    <link rel="apple-touch-icon" href="/assets/iconaplikasi.png">
    
    <!-- Premium Google Fonts Import -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Livewire Styles -->
    @livewireStyles
    
    <!-- PWA Manifest & Meta Tags -->
    <link class="pwa-manifest" rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#ffd554">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="SakuSiswa">
    
    <!-- Service Worker Registration -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/service-worker.js')
                    .then(reg => console.log('Service Worker terdaftar!', reg))
                    .catch(err => console.error('Pendaftaran Service Worker gagal!', err));
            });
        }
    </script>
    <!-- Lottie Player Script -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>
<body class="bg-[#ffd554] text-slate-900 antialiased h-screen overflow-hidden flex flex-col font-sans">

    <div class="flex flex-1 overflow-hidden h-screen">
        
        <!-- ======================================================== -->
        <!-- DESKTOP SIDEBAR (Visible ONLY on md screens and above)   -->
        <!-- ======================================================== -->
        <aside class="hidden md:flex md:w-64 bg-white border-r border-gray-200 flex-col shrink-0">
            <!-- Sidebar Header -->
            <div class="p-6 border-b border-gray-100 flex items-center space-x-3">
                <img src="/assets/iconaplikasi.png" alt="Logo Sekolah" class="w-9 h-9 object-contain">
                <div>
                    <h1 class="text-lg font-bold text-slate-800 tracking-tight font-['Outfit']">
                        Saku<span class="text-amber-600">Siswa</span>
                    </h1>
                    <p class="text-[10px] text-gray-400 font-medium font-sans">
                        @if(session('parent_logged_in') === true)
                            Platform Tabungan
                        @elseif(Auth::check())
                            {{ Auth::user()->role === 'admin' ? 'Platform Tabungan' : (Auth::user()->school_name ?? 'Platform Digital') }}
                        @else
                            Platform Digital
                        @endif
                    </p>
                </div>
            </div>
            
            <!-- Sidebar Navigation -->
            <nav class="flex-1 p-4 space-y-1.5 overflow-y-auto font-['Outfit']">
                @if(session('parent_logged_in') === true)
                    <!-- Parent Menu -->
                    <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider px-3 mb-2">Menu Utama</div>
                    <a href="/parent/dashboard" wire:navigate class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ Request::is('parent/dashboard') ? 'bg-[#fff8e5] text-amber-700 font-extrabold shadow-2xs' : 'text-slate-600 hover:bg-gray-50 hover:text-slate-900' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span>Beranda</span>
                    </a>
                    <a href="/parent/riwayat" wire:navigate class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ Request::is('parent/riwayat*') ? 'bg-[#fff8e5] text-amber-700 font-extrabold shadow-2xs' : 'text-slate-600 hover:bg-gray-50 hover:text-slate-900' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Riwayat Transaksi</span>
                    </a>
                    <a href="/parent/profil" wire:navigate class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ Request::is('parent/profil*') ? 'bg-[#fff8e5] text-amber-700 font-extrabold shadow-2xs' : 'text-slate-600 hover:bg-gray-50 hover:text-slate-900' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        <span>Profil Saya</span>
                    </a>
                @elseif(Auth::check())
                    @if(Auth::user()->role === 'admin')
                        <!-- Admin Menu -->
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider px-3 mb-2">Menu Administrator</div>
                        <a href="/admin/dashboard" wire:navigate class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ Request::is('admin/dashboard') ? 'bg-[#fff8e5] text-amber-700 font-extrabold' : 'text-slate-600 hover:bg-gray-50 hover:text-slate-900' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span>Ringkasan</span>
                        </a>
                        <a href="/admin/guru" wire:navigate class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ Request::is('admin/guru*') ? 'bg-[#fff8e5] text-amber-700 font-extrabold' : 'text-slate-600 hover:bg-gray-50 hover:text-slate-900' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            <span>Kelola Guru</span>
                        </a>
                        <a href="/admin/siswa" wire:navigate class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ Request::is('admin/siswa*') ? 'bg-[#fff8e5] text-amber-700 font-extrabold' : 'text-slate-600 hover:bg-gray-50 hover:text-slate-900' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            <span>Kelola Siswa</span>
                        </a>
                        <a href="/admin/riwayat" wire:navigate class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ Request::is('admin/riwayat*') ? 'bg-[#fff8e5] text-amber-700 font-extrabold' : 'text-slate-600 hover:bg-gray-50 hover:text-slate-900' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Riwayat Transaksi</span>
                        </a>
                        <a href="/admin/laporan" wire:navigate class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ Request::is('admin/laporan*') ? 'bg-[#fff8e5] text-amber-700 font-extrabold' : 'text-slate-600 hover:bg-gray-50 hover:text-slate-900' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            <span>Laporan</span>
                        </a>
                    @elseif(Auth::user()->role === 'guru')
                        <!-- Guru Menu -->
                        <div class="text-[10px] font-bold text-gray-400 uppercase tracking-wider px-3 mb-2">Menu Guru</div>
                        <a href="/guru/dashboard" wire:navigate class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ Request::is('guru/dashboard') ? 'bg-[#fff8e5] text-amber-700 font-extrabold' : 'text-slate-600 hover:bg-gray-50 hover:text-slate-900' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            <span>Ringkasan Kelas</span>
                        </a>
                        <a href="/guru/siswa" wire:navigate class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ Request::is('guru/siswa*') ? 'bg-[#fff8e5] text-amber-700 font-extrabold' : 'text-slate-600 hover:bg-gray-50 hover:text-slate-900' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            <span>Kelola Siswa</span>
                        </a>
                        <a href="/guru/riwayat" wire:navigate class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ Request::is('guru/riwayat*') ? 'bg-[#fff8e5] text-amber-700 font-extrabold' : 'text-slate-600 hover:bg-gray-50 hover:text-slate-900' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>Riwayat Transaksi</span>
                        </a>
                        <a href="/guru/profil" wire:navigate class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-sm font-semibold transition-all duration-200 {{ Request::is('guru/profil*') ? 'bg-[#fff8e5] text-amber-700 font-extrabold' : 'text-slate-600 hover:bg-gray-50 hover:text-slate-900' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            </svg>
                            <span>Profil Saya</span>
                        </a>
                    @endif
                @endif
            </nav>
            
            <!-- Sidebar Profile Footer -->
            @if(session('parent_logged_in') === true)
                @php
                    $parentStudent = \App\Models\Student::find(session('student_id'));
                @endphp
                <div class="p-4 border-t border-gray-100 flex items-center justify-between font-['Outfit']">
                    <div class="flex items-center space-x-3 overflow-hidden">
                        <div class="w-9 h-9 rounded-full bg-slate-100 border border-amber-200/50 flex items-center justify-center shrink-0 overflow-hidden">
                            <img src="/assets/{{ $parentStudent->avatar ?? 'i1.png' }}" alt="Profile" class="w-full h-full object-cover rounded-full">
                        </div>
                        <div class="overflow-hidden">
                            <h2 class="text-xs font-bold text-slate-800 truncate">{{ $parentStudent->name ?? 'Wali Murid' }}</h2>
                            <p class="text-[10px] text-gray-400 font-medium capitalize">Wali Murid</p>
                        </div>
                    </div>
                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" class="inline shrink-0 ml-2">
                        @csrf
                        <button type="submit" class="p-2 hover:bg-rose-50 text-rose-500 hover:text-rose-600 rounded-xl transition-colors cursor-pointer" title="Keluar">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>
                        </button>
                    </form>
                </div>
            @elseif(Auth::check())
                <div class="p-4 border-t border-gray-100 flex items-center justify-between font-['Outfit']">
                    <div class="flex items-center space-x-3 overflow-hidden">
                        <div class="w-9 h-9 rounded-full bg-slate-100 border border-amber-200/50 flex items-center justify-center shrink-0 overflow-hidden">
                            <img src="/assets/{{ Auth::user()->avatar ?? 'i1.png' }}" alt="Profile" class="w-full h-full object-cover rounded-full">
                        </div>
                        <div class="overflow-hidden">
                            <h2 class="text-xs font-bold text-slate-800 truncate">{{ Auth::user()->name }}</h2>
                            <p class="text-[10px] text-gray-400 font-medium capitalize">{{ Auth::user()->role }}</p>
                        </div>
                    </div>
                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" class="inline shrink-0 ml-2">
                        @csrf
                        <button type="submit" class="p-2 hover:bg-rose-50 text-rose-500 hover:text-rose-600 rounded-xl transition-colors cursor-pointer" title="Keluar">
                            <svg class="w-4.5 h-4.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>
                        </button>
                    </form>
                </div>
            @endif
        </aside>

        <!-- ======================================================== -->
        <!-- MAIN CONTENT WRAPPER                                     -->
        <!-- ======================================================== -->
        <div class="flex-1 flex flex-col overflow-hidden relative">
            
            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 md:p-8 pb-24 md:pb-8">
                @if(session('parent_logged_in') === true)
                    <div class="max-w-xl md:max-w-5xl mx-auto w-full transition-all">
                        {{ $slot }}
                    </div>
                @else
                    {{ $slot }}
                @endif
            </main>
            
        </div>
    </div>

    <!-- ======================================================== -->
    <!-- MOBILE BOTTOM NAVIGATION (STRICTLY md:hidden FOR HP)    -->
    <!-- ======================================================== -->
    @if(session('parent_logged_in') === true)
        <nav class="md:hidden fixed bottom-0 left-0 right-0 h-16 bg-white border-t border-gray-200 flex justify-around items-center z-50 shadow-lg">
            <!-- Home Link -->
            <a href="/parent/dashboard" wire:navigate class="flex flex-col items-center justify-center w-20 text-slate-600 hover:text-amber-600 transition-colors duration-200">
                <svg class="w-5 h-5 {{ Request::is('parent/dashboard') ? 'text-amber-600' : '' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                <span class="text-[10px] font-bold mt-1 {{ Request::is('parent/dashboard') ? 'text-amber-600' : '' }}">Beranda</span>
            </a>
            <!-- History Link -->
            <a href="/parent/riwayat" wire:navigate class="flex flex-col items-center justify-center w-20 text-slate-600 hover:text-amber-600 transition-colors duration-200">
                <svg class="w-5 h-5 {{ Request::is('parent/riwayat*') ? 'text-amber-600' : '' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-[10px] font-bold mt-1 {{ Request::is('parent/riwayat*') ? 'text-amber-600' : '' }}">Riwayat</span>
            </a>
            <!-- Profile Link -->
            <a href="/parent/profil" wire:navigate class="flex flex-col items-center justify-center w-20 text-slate-600 hover:text-amber-600 transition-colors duration-200">
                <svg class="w-5 h-5 {{ Request::is('parent/profil*') ? 'text-amber-600' : '' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                <span class="text-[10px] font-bold mt-1 {{ Request::is('parent/profil*') ? 'text-amber-600' : '' }}">Profil</span>
            </a>
        </nav>
    @endif

    @auth
        @if(Auth::user()->role === 'guru')
            <nav class="md:hidden fixed bottom-0 left-0 right-0 h-16 bg-white border-t border-gray-200 flex justify-around items-center z-50 shadow-lg">
                <!-- Ringkasan Kelas -->
                <a href="/guru/dashboard" wire:navigate class="flex flex-col items-center justify-center w-1/4 text-slate-600 hover:text-amber-600 transition-colors duration-200">
                    <svg class="w-5 h-5 {{ Request::is('guru/dashboard') ? 'text-amber-600' : '' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    <span class="text-[10px] font-bold mt-1 {{ Request::is('guru/dashboard') ? 'text-amber-600' : '' }}">Ringkasan</span>
                </a>
                <!-- Kelola Siswa -->
                <a href="/guru/siswa" wire:navigate class="flex flex-col items-center justify-center w-1/4 text-slate-600 hover:text-amber-600 transition-colors duration-200">
                    <svg class="w-5 h-5 {{ Request::is('guru/siswa*') ? 'text-amber-600' : '' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    <span class="text-[10px] font-bold mt-1 {{ Request::is('guru/siswa*') ? 'text-amber-600' : '' }}">Kelola Siswa</span>
                </a>
                <!-- Riwayat Transaksi -->
                <a href="/guru/riwayat" wire:navigate class="flex flex-col items-center justify-center w-1/4 text-slate-600 hover:text-amber-600 transition-colors duration-200">
                    <svg class="w-5 h-5 {{ Request::is('guru/riwayat*') ? 'text-amber-600' : '' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-[10px] font-bold mt-1 {{ Request::is('guru/riwayat*') ? 'text-amber-600' : '' }}">Riwayat</span>
                </a>
                <!-- Profil Saya -->
                <a href="/guru/profil" wire:navigate class="flex flex-col items-center justify-center w-1/4 text-slate-600 hover:text-amber-600 transition-colors duration-200">
                    <svg class="w-5 h-5 {{ Request::is('guru/profil*') ? 'text-amber-600' : '' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    <span class="text-[10px] font-bold mt-1 {{ Request::is('guru/profil*') ? 'text-amber-600' : '' }}">Profil</span>
                </a>
            </nav>
        @elseif(Auth::user()->role === 'admin')
            <nav class="md:hidden fixed bottom-0 left-0 right-0 h-16 bg-white border-t border-gray-200 flex justify-around items-center z-50 shadow-lg animate-fadeIn">
                <!-- Ringkasan -->
                <a href="/admin/dashboard" wire:navigate class="flex flex-col items-center justify-center w-1/5 text-slate-600 hover:text-amber-600 transition-colors duration-200">
                    <svg class="w-5 h-5 {{ Request::is('admin/dashboard') ? 'text-amber-600' : '' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    <span class="text-[10px] font-bold mt-1 {{ Request::is('admin/dashboard') ? 'text-amber-600' : '' }}">Ringkasan</span>
                </a>
                <!-- Kelola Guru -->
                <a href="/admin/guru" wire:navigate class="flex flex-col items-center justify-center w-1/5 text-slate-600 hover:text-amber-600 transition-colors duration-200">
                    <svg class="w-5 h-5 {{ Request::is('admin/guru*') ? 'text-amber-600' : '' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                    <span class="text-[10px] font-bold mt-1 {{ Request::is('admin/guru*') ? 'text-amber-600' : '' }}">Kelola Guru</span>
                </a>
                <!-- Kelola Siswa -->
                <a href="/admin/siswa" wire:navigate class="flex flex-col items-center justify-center w-1/5 text-slate-600 hover:text-amber-600 transition-colors duration-200">
                    <svg class="w-5 h-5 {{ Request::is('admin/siswa*') ? 'text-amber-600' : '' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    <span class="text-[10px] font-bold mt-1 {{ Request::is('admin/siswa*') ? 'text-amber-600' : '' }}">Kelola Siswa</span>
                </a>
                <!-- Riwayat -->
                <a href="/admin/riwayat" wire:navigate class="flex flex-col items-center justify-center w-1/5 text-slate-600 hover:text-amber-600 transition-colors duration-200">
                    <svg class="w-5 h-5 {{ Request::is('admin/riwayat*') ? 'text-amber-600' : '' }}" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-[10px] font-bold mt-1 {{ Request::is('admin/riwayat*') ? 'text-amber-600' : '' }}">Riwayat</span>
                </a>
                <!-- Laporan -->
                <a href="/admin/laporan" wire:navigate class="flex flex-col items-center justify-center w-1/5 text-slate-600 hover:text-amber-600 transition-colors duration-200">
                    <svg class="w-5 h-5 {{ Request::is('admin/laporan*') ? 'text-amber-600' : '' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                    </svg>
                    <span class="text-[10px] font-bold mt-1 {{ Request::is('admin/laporan*') ? 'text-amber-600' : '' }}">Laporan</span>
                </a>
            </nav>
        @endif
    @endauth

    <!-- Livewire Scripts -->
    @livewireScripts
</body>
</html>
