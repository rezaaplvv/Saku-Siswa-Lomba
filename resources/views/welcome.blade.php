<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SakuSiswa - Cara Modern Membiasakan Menabung Sejak Dini</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/assets/iconaplikasi.png">
    <link rel="shortcut icon" type="image/png" href="/assets/iconaplikasi.png">
    <link rel="apple-touch-icon" href="/assets/iconaplikasi.png">

    <!-- Google Fonts: Fredoka (Bold Headlines) & Inter (Sub-headline & Body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700;800&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS / Vite -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif

    <style>
        .font-fredoka {
            font-family: 'Fredoka', cursive, sans-serif;
        }
        .font-inter {
            font-family: 'Inter', sans-serif;
        }
        html.lenis, html.lenis body {
            height: auto;
        }
        .lenis.lenis-smooth {
            scroll-behavior: auto !important;
        }
        .lenis.lenis-smooth [data-lenis-prevent] {
            overscroll-behavior: contain;
        }
        .lenis.lenis-stopped {
            overflow: hidden;
        }
        .lenis.lenis-scrolling iframe {
            pointer-events: none;
        }
    </style>
</head>
<body class="bg-[#FFE96E] text-slate-900 min-h-screen overflow-x-hidden selection:bg-amber-400 selection:text-slate-900 font-inter">

    <!-- ======================================================== -->
    <!-- TOP NAVBAR: LOGO SAKUSISWA                              -->
    <!-- ======================================================== -->
    <header class="w-full max-w-7xl mx-auto px-6 sm:px-10 lg:px-12 pt-6 sm:pt-8 pb-4 relative z-30">
        <div class="flex items-center justify-between">
            <a href="{{ url('/') }}" class="inline-flex items-center space-x-3.5 group transition-transform duration-200 hover:scale-[1.02]">
                <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-white/90 shadow-xs border border-amber-300/60 p-2 flex items-center justify-center">
                    <img src="/assets/iconaplikasi.png" alt="SakuSiswa Logo" class="w-full h-full object-contain">
                </div>
                <span class="font-fredoka text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">
                    Saku<span class="text-amber-900">Siswa</span>
                </span>
            </a>

            <div class="hidden sm:flex items-center space-x-3">
                <a href="{{ route('login') }}" 
                   class="px-5 py-2.5 bg-slate-900 text-white font-fredoka font-bold text-sm rounded-xl border border-slate-950 shadow-[0_4px_0_#020617] hover:shadow-[0_2px_0_#020617] hover:translate-y-[2px] active:shadow-[0_0px_0_#020617] active:translate-y-[4px] transition-all inline-flex items-center justify-center">
                    Masuk Akun
                </a>
            </div>
        </div>
    </header>

    <!-- ======================================================== -->
    <!-- SECTION 1: HERO SECTION                                  -->
    <!-- ======================================================== -->
    <section class="w-full max-w-7xl mx-auto px-6 sm:px-10 lg:px-12 pt-6 pb-16 lg:pb-24 flex items-center min-h-[calc(100vh-100px)]">
        <div class="w-full grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">

            <!-- LEFT COLUMN: DEVICE MOCKUPS (LAPTOP & IPHONE) -->
            <div class="lg:col-span-7 flex items-center justify-center relative">
                <div class="relative w-full max-w-[540px] sm:max-w-[600px] lg:max-w-[640px] flex items-center justify-center">
                    
                    <!-- Macbook Laptop Mockup -->
                    <img src="/assets/macbook.png" 
                         alt="SakuSiswa on Macbook Laptop" 
                         class="w-full h-auto object-contain drop-shadow-[0_20px_35px_rgba(0,0,0,0.15)] select-none pointer-events-none">

                    <!-- iPhone Mobile Phone Mockup Overlapping on the Right -->
                    <div class="absolute -right-2 sm:-right-4 md:-right-6 bottom-0 sm:-bottom-2 w-[28%] sm:w-[32%] md:w-[34%] z-10 transition-transform duration-300 hover:scale-105">
                        <img src="/assets/iphone.png" 
                             alt="SakuSiswa on iPhone Smartphone" 
                             class="w-full h-auto object-contain drop-shadow-[0_25px_30px_rgba(0,0,0,0.25)] select-none pointer-events-none">
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: HERO HEADLINE, SUBTEXT & 3D BUTTONS -->
            <div class="lg:col-span-5 flex flex-col items-start text-left space-y-5 sm:space-y-6 z-20">
                
                <!-- Main Bold Headline (Font: Fredoka) -->
                <h1 class="font-fredoka font-bold text-3xl sm:text-4xl md:text-[2.75rem] lg:text-[3.15rem] text-slate-900 leading-[1.12] tracking-tight">
                    Cara modern membiasakan menabung sejak dini!
                </h1>

                <!-- Sub-headline (Font: Inter) -->
                <p class="font-inter text-base sm:text-lg lg:text-xl text-slate-800/90 font-medium leading-relaxed max-w-lg">
                    SakuSiswa membantu mengelola tabungan dengan mudah, aman dan transparan
                </p>

                <!-- 2 Buttons with 3D Shadow Effect -->
                <div class="flex flex-wrap items-center gap-4 sm:gap-5 pt-2 sm:pt-3">
                    
                    <!-- Button 1: Daftar Sekarang (White 3D Button) -->
                    <a href="{{ route('register') }}" 
                       class="px-7 py-3.5 sm:px-8 sm:py-4 bg-white text-slate-900 font-fredoka font-bold text-base sm:text-lg rounded-2xl border-2 border-slate-200/90 shadow-[0_6px_0_#94a3b8] hover:shadow-[0_4px_0_#94a3b8] hover:translate-y-[2px] active:shadow-[0_0px_0_#94a3b8] active:translate-y-[6px] transition-all cursor-pointer inline-flex items-center justify-center text-center">
                        Daftar Sekarang
                    </a>

                    <!-- Button 2: Masuk ke Akun (Dark Slate 3D Button) -->
                    <a href="{{ route('login') }}" 
                       class="px-7 py-3.5 sm:px-8 sm:py-4 bg-slate-900 text-white font-fredoka font-bold text-base sm:text-lg rounded-2xl border-2 border-slate-950 shadow-[0_6px_0_#020617] hover:shadow-[0_4px_0_#020617] hover:translate-y-[2px] active:shadow-[0_0px_0_#020617] active:translate-y-[6px] transition-all cursor-pointer inline-flex items-center justify-center text-center">
                        Masuk ke Akun
                    </a>

                </div>

            </div>

        </div>
    </section>

    <!-- ======================================================== -->
    <!-- SECTION 2: SCROLLTRIGGER INTERACTIVE SHOWCASE            -->
    <!-- ======================================================== -->
    <section id="scrolly-section" class="w-full bg-[#FFF38C] py-16 lg:py-24 relative overflow-hidden border-t border-amber-300/40">
        <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-12">
            
            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-12 lg:mb-20">
                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold font-fredoka tracking-wider bg-white text-amber-900 border border-amber-300/80 shadow-xs uppercase">
                    Eksplorasi Fitur
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-fredoka font-bold text-slate-900 mt-3.5 tracking-tight">
                    Satu Aplikasi, Tiga Solusi Nyata
                </h2>
                <p class="text-sm sm:text-base text-slate-800/80 font-medium mt-3 leading-relaxed">
                    Dirancang khusus untuk menghubungkan siswa, orang tua, dan guru dalam ekosistem tabungan yang transparan.
                </p>
            </div>

            <!-- DESKTOP PINNED SCROLLTRIGGER CONTAINER (>= lg) -->
            <div class="hidden lg:block relative min-h-[300vh]" id="pinned-container">
                <div class="sticky top-20 h-[80vh] flex items-center justify-between w-full">
                    
                    <!-- LEFT TEXT STACK (Story 1 & Story 3) -->
                    <div class="w-[45%] flex flex-col justify-center relative h-full">
                        
                        <!-- Story 1: Target Tabungan (Left Text, Phone on Right) -->
                        <div id="story-1" class="absolute inset-x-0 my-auto space-y-4 bg-white/95 backdrop-blur-sm p-8 rounded-3xl border-2 border-amber-200/80 shadow-[0_12px_0_#e2e8f0]">
                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-extrabold font-fredoka bg-amber-100 text-amber-900 uppercase tracking-wider">
                                01. Motivasi Siswa
                            </span>
                            <h3 class="text-2xl xl:text-3xl font-fredoka font-bold text-slate-900 leading-tight">
                                Tetapkan Impian, Capai Target Tabungan!
                            </h3>
                            <p class="text-sm xl:text-base text-slate-700 font-medium leading-relaxed">
                                Siswa bukan cuma diajak menyimpan uang, tapi termotivasi mencapai target impian mereka seperti membeli buku baru, sepeda, atau perlengkapan sekolah dengan indikator progres yang interaktif.
                            </p>
                            <div class="pt-2 space-y-2">
                                <div class="flex items-center space-x-3 text-xs font-bold text-slate-800">
                                    <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                    </div>
                                    <span>Target Tabungan Personal & Fleksibel</span>
                                </div>
                                <div class="flex items-center space-x-3 text-xs font-bold text-slate-800">
                                    <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                    </div>
                                    <span>Visualisasi Progres Real-Time</span>
                                </div>
                            </div>
                        </div>

                        <!-- Story 3: Guru & Sekolah (Left Text, Phone on Right) -->
                        <div id="story-3" class="absolute inset-x-0 my-auto space-y-4 bg-white/95 backdrop-blur-sm p-8 rounded-3xl border-2 border-amber-200/80 shadow-[0_12px_0_#e2e8f0] opacity-0 pointer-events-none">
                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-extrabold font-fredoka bg-amber-100 text-amber-900 uppercase tracking-wider">
                                03. Efisiensi Sekolah
                            </span>
                            <h3 class="text-2xl xl:text-3xl font-fredoka font-bold text-slate-900 leading-tight">
                                Pencatatan Cepat, Bebas Selisih Kas!
                            </h3>
                            <p class="text-sm xl:text-base text-slate-700 font-medium leading-relaxed">
                                Tinggalkan pembukuan manual yang rawan hilang dan salah hitung. Guru kelas dapat menginput setoran siswa dalam hitungan detik, dan laporan rekapitulasi keuangan sekolah langsung siap dicetak.
                            </p>
                            <div class="pt-2 space-y-2">
                                <div class="flex items-center space-x-3 text-xs font-bold text-slate-800">
                                    <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                    </div>
                                    <span>Input Setoran Kilat Tanpa Ribet</span>
                                </div>
                                <div class="flex items-center space-x-3 text-xs font-bold text-slate-800">
                                    <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                    </div>
                                    <span>Rekapitulasi dan Cetak Laporan PDF</span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- CENTER GLIDING PHONE CONTAINER -->
                    <div id="gliding-phone" class="absolute z-20 w-[300px] xl:w-[330px] flex items-center justify-center" style="left: 65%;">
                        <div class="relative w-full aspect-[9/18.5] flex items-center justify-center">
                            
                            <!-- Image 1: Target Tabungan -->
                            <img id="img-phone-1" 
                                 src="/assets/iphone.png" 
                                 alt="SakuSiswa Target Tabungan" 
                                 class="absolute inset-0 w-full h-full object-contain drop-shadow-[0_25px_35px_rgba(0,0,0,0.25)]">

                            <!-- Image 2: Riwayat Transaksi -->
                            <img id="img-phone-2" 
                                 src="/assets/iphone_riwayat.png" 
                                 alt="SakuSiswa Riwayat Transaksi" 
                                 class="absolute inset-0 w-full h-full object-contain drop-shadow-[0_25px_35px_rgba(0,0,0,0.25)] opacity-0">

                            <!-- Image 3: Input Guru -->
                            <img id="img-phone-3" 
                                 src="/assets/iphone_guru.png" 
                                 alt="SakuSiswa Panel Guru" 
                                 class="absolute inset-0 w-full h-full object-contain drop-shadow-[0_25px_35px_rgba(0,0,0,0.25)] opacity-0">

                        </div>
                    </div>

                    <!-- RIGHT TEXT STACK (Story 2) -->
                    <div class="w-[45%] flex flex-col justify-center relative h-full">
                        
                        <!-- Story 2: Transparansi Wali (Right Text, Phone on Left) -->
                        <div id="story-2" class="absolute inset-x-0 my-auto space-y-4 bg-white/95 backdrop-blur-sm p-8 rounded-3xl border-2 border-amber-200/80 shadow-[0_12px_0_#e2e8f0] opacity-0 pointer-events-none">
                            <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-extrabold font-fredoka bg-amber-100 text-amber-900 uppercase tracking-wider">
                                02. Transparansi Wali
                            </span>
                            <h3 class="text-2xl xl:text-3xl font-fredoka font-bold text-slate-900 leading-tight">
                                Pantau Uang Saku Anak dari Mana Saja!
                            </h3>
                            <p class="text-sm xl:text-base text-slate-700 font-medium leading-relaxed">
                                Orang tua tidak perlu lagi khawatir atau menerka sisa uang saku anak. Setiap transaksi setoran dan penarikan tercatat secara transparan dengan rincian lengkap langsung ke smartphone wali murid.
                            </p>
                            <div class="pt-2 space-y-2">
                                <div class="flex items-center space-x-3 text-xs font-bold text-slate-800">
                                    <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                    </div>
                                    <span>Riwayat Mutasi Saldo Real-Time</span>
                                </div>
                                <div class="flex items-center space-x-3 text-xs font-bold text-slate-800">
                                    <div class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>
                                    </div>
                                    <span>Pengajuan Penarikan Saldo Praktis</span>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <!-- MOBILE FALLBACK LIST (< lg): CLEAN STACKED CARDS -->
            <div class="block lg:hidden space-y-12">
                
                <!-- Card 1: Target Tabungan -->
                <div class="bg-white p-6 sm:p-8 rounded-3xl border-2 border-amber-200 shadow-[0_8px_0_#e2e8f0] space-y-6">
                    <div class="w-full max-w-[240px] mx-auto">
                        <img src="/assets/iphone.png" alt="Target Tabungan" class="w-full h-auto object-contain drop-shadow-xl">
                    </div>
                    <div class="space-y-3 text-left">
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-extrabold font-fredoka bg-amber-100 text-amber-900 uppercase">
                            01. Motivasi Siswa
                        </span>
                        <h3 class="text-xl sm:text-2xl font-fredoka font-bold text-slate-900">
                            Tetapkan Impian, Capai Target Tabungan!
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-700 font-medium leading-relaxed">
                            Siswa bukan cuma diajak menyimpan uang, tapi termotivasi mencapai target impian mereka seperti membeli buku baru, sepeda, atau perlengkapan sekolah dengan indikator progres yang interaktif.
                        </p>
                    </div>
                </div>

                <!-- Card 2: Riwayat Transaksi -->
                <div class="bg-white p-6 sm:p-8 rounded-3xl border-2 border-amber-200 shadow-[0_8px_0_#e2e8f0] space-y-6">
                    <div class="w-full max-w-[240px] mx-auto">
                        <img src="/assets/iphone_riwayat.png" alt="Riwayat Transaksi" class="w-full h-auto object-contain drop-shadow-xl">
                    </div>
                    <div class="space-y-3 text-left">
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-extrabold font-fredoka bg-amber-100 text-amber-900 uppercase">
                            02. Transparansi Wali
                        </span>
                        <h3 class="text-xl sm:text-2xl font-fredoka font-bold text-slate-900">
                            Pantau Uang Saku Anak dari Mana Saja!
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-700 font-medium leading-relaxed">
                            Orang tua tidak perlu lagi khawatir atau menerka sisa uang saku anak. Setiap transaksi setoran dan penarikan tercatat secara transparan dengan rincian lengkap langsung ke smartphone wali murid.
                        </p>
                    </div>
                </div>

                <!-- Card 3: Guru & Sekolah -->
                <div class="bg-white p-6 sm:p-8 rounded-3xl border-2 border-amber-200 shadow-[0_8px_0_#e2e8f0] space-y-6">
                    <div class="w-full max-w-[240px] mx-auto">
                        <img src="/assets/iphone_guru.png" alt="Input Setoran Guru" class="w-full h-auto object-contain drop-shadow-xl">
                    </div>
                    <div class="space-y-3 text-left">
                        <span class="inline-flex items-center px-3 py-1 rounded-lg text-xs font-extrabold font-fredoka bg-amber-100 text-amber-900 uppercase">
                            03. Efisiensi Sekolah
                        </span>
                        <h3 class="text-xl sm:text-2xl font-fredoka font-bold text-slate-900">
                            Pencatatan Cepat, Bebas Selisih Kas!
                        </h3>
                        <p class="text-xs sm:text-sm text-slate-700 font-medium leading-relaxed">
                            Tinggalkan pembukuan manual yang rawan hilang dan salah hitung. Guru kelas dapat menginput setoran siswa dalam hitungan detik, dan laporan rekapitulasi keuangan sekolah langsung siap dicetak.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ======================================================== -->
    <!-- SECTION 3: CALL TO ACTION BANNER (BOTTOM)                -->
    <!-- ======================================================== -->
    <section class="w-full max-w-7xl mx-auto px-6 sm:px-10 lg:px-12 py-16 lg:py-24 text-center">
        <div class="bg-slate-900 text-white rounded-3xl p-8 sm:p-12 lg:p-16 border-2 border-slate-950 shadow-[0_16px_0_#020617] relative overflow-hidden">
            
            <div class="relative z-10 max-w-3xl mx-auto space-y-6">
                <span class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-bold font-fredoka tracking-wider bg-amber-400 text-slate-900 uppercase">
                    Mulai Sekarang
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-fredoka font-bold leading-tight tracking-tight">
                    Siap Memulai Transformasi Tabungan Sekolah?
                </h2>
                <p class="text-sm sm:text-base lg:text-lg text-slate-300 font-medium max-w-xl mx-auto leading-relaxed">
                    Bergabung bersama ribuan siswa dan orang tua untuk membangun kebiasaan finansial yang bijak sejak bangku sekolah.
                </p>
                <div class="flex flex-wrap items-center justify-center gap-4 pt-4">
                    <a href="{{ route('register') }}" 
                       class="px-8 py-4 bg-[#ffd554] hover:bg-[#e5bf43] text-slate-900 font-fredoka font-bold text-base sm:text-lg rounded-2xl border-2 border-amber-300 shadow-[0_6px_0_#b45309] hover:shadow-[0_4px_0_#b45309] hover:translate-y-[2px] active:shadow-[0_0px_0_#b45309] active:translate-y-[6px] transition-all cursor-pointer inline-flex items-center justify-center">
                        Daftar Akun Baru
                    </a>
                    <a href="{{ route('login') }}" 
                       class="px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-fredoka font-bold text-base sm:text-lg rounded-2xl border-2 border-white/20 shadow-[0_6px_0_rgba(0,0,0,0.4)] hover:shadow-[0_4px_0_rgba(0,0,0,0.4)] hover:translate-y-[2px] active:shadow-[0_0px_0_rgba(0,0,0,0.4)] active:translate-y-[6px] transition-all cursor-pointer inline-flex items-center justify-center">
                        Masuk ke Portal
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- GSAP, ScrollTrigger & Lenis Smooth Scroll Scripts -->
    <script src="https://unpkg.com/lenis@1.1.20/dist/lenis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <script>
        // 1. Initialize Lenis Smooth Scroll
        const lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            smoothWheel: true,
        });

        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);

        // Connect Lenis with GSAP ScrollTrigger
        lenis.on('scroll', ScrollTrigger.update);
        gsap.ticker.add((time) => {
            lenis.raf(time * 1000);
        });
        gsap.ticker.lagSmoothing(0);

        // 2. GSAP ScrollTrigger Timeline for Desktop Gliding Phone
        gsap.registerPlugin(ScrollTrigger);

        const mm = gsap.matchMedia();

        mm.add("(min-width: 1024px)", () => {
            const tl = gsap.timeline({
                scrollTrigger: {
                    trigger: "#pinned-container",
                    start: "top top",
                    end: "bottom bottom",
                    scrub: 1,
                    pin: true,
                }
            });

            // Initial State:
            // Phone at right (left: 65%), showing img-phone-1, story-1 visible

            // --- STEP 1 -> STEP 2 (Phone moves to LEFT, Crossfade to Image 2, Story 1 fades out, Story 2 fades in) ---
            tl.to("#story-1", { opacity: 0, y: -30, pointerEvents: "none", duration: 0.3 }, 0)
              .to("#gliding-phone", { left: "5%", xPercent: 0, duration: 1, ease: "power2.inOut" }, 0.2)
              .to("#img-phone-1", { opacity: 0, duration: 0.4 }, 0.4)
              .to("#img-phone-2", { opacity: 1, duration: 0.4 }, 0.4)
              .to("#story-2", { opacity: 1, y: 0, pointerEvents: "auto", duration: 0.4 }, 0.7);

            // --- STEP 2 -> STEP 3 (Phone moves back to RIGHT, Crossfade to Image 3, Story 2 fades out, Story 3 fades in) ---
            tl.to("#story-2", { opacity: 0, y: -30, pointerEvents: "none", duration: 0.3 }, 1.3)
              .to("#gliding-phone", { left: "65%", xPercent: 0, duration: 1, ease: "power2.inOut" }, 1.5)
              .to("#img-phone-2", { opacity: 0, duration: 0.4 }, 1.7)
              .to("#img-phone-3", { opacity: 1, duration: 0.4 }, 1.7)
              .to("#story-3", { opacity: 1, y: 0, pointerEvents: "auto", duration: 0.4 }, 2.0);
        });
    </script>

</body>
</html>
