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

    <!-- Google Fonts: Fredoka & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

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
    <!-- SECTION 2: DUOLINGO-STYLE SCROLL SHOWCASE (NO BOXES)     -->
    <!-- ======================================================== -->
    <section class="w-full bg-[#FFE96E] relative overflow-hidden py-12 lg:py-20">
        <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-12">

            <!-- DESKTOP PINNED SCROLL CONTAINER (>= lg) -->
            <div class="hidden lg:block relative min-h-[320vh]" id="duo-pinned-container">
                <div class="sticky top-16 h-[85vh] flex items-center justify-between w-full">
                    
                    <!-- LEFT TEXT COLUMN (For Stage 1 & Stage 3) -->
                    <div class="w-[46%] flex flex-col justify-center relative h-full">
                        
                        <!-- STAGE 1 TEXT (Left) -->
                        <div id="duo-text-1" class="absolute inset-x-0 my-auto space-y-5 text-left">
                            <h2 class="font-fredoka font-bold text-4xl xl:text-5xl 2xl:text-6xl text-slate-900 leading-[1.08] tracking-tight">
                                seru. mudah. terarah.
                            </h2>
                            <p class="font-inter text-base xl:text-lg text-slate-800/90 font-medium leading-relaxed max-w-lg">
                                Menabung bersama SakuSiswa itu seru dan <span class="font-bold text-slate-900 underline decoration-amber-600 decoration-2 underline-offset-4">membuat anak bersemangat</span>! Dengan target tabungan impian dan progress bar yang jelas, anak belajar menyisihkan uang jajan sehari-hari untuk mewujudkan cita-citanya.
                            </p>
                        </div>

                        <!-- STAGE 3 TEXT (Left) -->
                        <div id="duo-text-3" class="absolute inset-x-0 my-auto space-y-5 text-left opacity-0 pointer-events-none">
                            <h2 class="font-fredoka font-bold text-4xl xl:text-5xl 2xl:text-6xl text-slate-900 leading-[1.08] tracking-tight">
                                cepat. rapi. otomatis.
                            </h2>
                            <p class="font-inter text-base xl:text-lg text-slate-800/90 font-medium leading-relaxed max-w-lg">
                                Bebaskan guru dari kerumitan buku kas manual. Pencatatan setoran selesai dalam hitungan detik dan <span class="font-bold text-slate-900 underline decoration-amber-600 decoration-2 underline-offset-4">laporan keuangan sekolah otomatis siap dicetak</span> kapan saja.
                            </p>
                        </div>

                    </div>

                    <!-- GLIDING PHONE CONTAINER (Transitions Left <-> Right) -->
                    <div id="duo-gliding-phone" class="absolute z-20 w-[300px] xl:w-[340px] flex items-center justify-center pointer-events-none" style="left: 62%;">
                        <div class="relative w-full aspect-[9/18.5] flex items-center justify-center">
                            
                            <!-- Phone Image 1: Target Tabungan -->
                            <img id="duo-img-1" 
                                 src="/assets/iphone.png" 
                                 alt="SakuSiswa Target Tabungan" 
                                 class="absolute inset-0 w-full h-full object-contain drop-shadow-[0_30px_40px_rgba(0,0,0,0.25)] select-none">

                            <!-- Phone Image 2: Riwayat Transaksi -->
                            <img id="duo-img-2" 
                                 src="/assets/iphone_riwayat.png" 
                                 alt="SakuSiswa Riwayat Transaksi" 
                                 class="absolute inset-0 w-full h-full object-contain drop-shadow-[0_30px_40px_rgba(0,0,0,0.25)] select-none opacity-0">

                            <!-- Phone Image 3: Input Guru -->
                            <img id="duo-img-3" 
                                 src="/assets/iphone_guru.png" 
                                 alt="SakuSiswa Panel Guru" 
                                 class="absolute inset-0 w-full h-full object-contain drop-shadow-[0_30px_40px_rgba(0,0,0,0.25)] select-none opacity-0">

                        </div>
                    </div>

                    <!-- RIGHT TEXT COLUMN (For Stage 2) -->
                    <div class="w-[46%] flex flex-col justify-center relative h-full ml-auto">
                        
                        <!-- STAGE 2 TEXT (Right) -->
                        <div id="duo-text-2" class="absolute inset-x-0 my-auto space-y-5 text-left opacity-0 pointer-events-none">
                            <h2 class="font-fredoka font-bold text-4xl xl:text-5xl 2xl:text-6xl text-slate-900 leading-[1.08] tracking-tight">
                                aman. transparan. tenang.
                            </h2>
                            <p class="font-inter text-base xl:text-lg text-slate-800/90 font-medium leading-relaxed max-w-lg">
                                Orang tua bisa memantau aliran tabungan anak <span class="font-bold text-slate-900 underline decoration-amber-600 decoration-2 underline-offset-4">secara real-time dari rumah</span>. Setiap uang yang disetor di sekolah langsung tercatat rapi, tanpa rasa khawatir uang hilang atau salah catat.
                            </p>
                        </div>

                    </div>

                </div>
            </div>

            <!-- MOBILE STACKED LIST (< lg): CLEAN TYPOGRAPHY LAYOUT -->
            <div class="block lg:hidden space-y-20 py-8">
                
                <!-- Mobile Stage 1 -->
                <div class="space-y-6 text-left">
                    <div class="w-full max-w-[260px] mx-auto py-2">
                        <img src="/assets/iphone.png" alt="Target Tabungan" class="w-full h-auto object-contain drop-shadow-2xl">
                    </div>
                    <div class="space-y-3">
                        <h2 class="font-fredoka font-bold text-3xl sm:text-4xl text-slate-900 leading-tight">
                            seru. mudah. terarah.
                        </h2>
                        <p class="font-inter text-sm sm:text-base text-slate-800/90 font-medium leading-relaxed">
                            Menabung bersama SakuSiswa itu seru dan <span class="font-bold text-slate-900 underline decoration-amber-600 decoration-2 underline-offset-2">membuat anak bersemangat</span>! Dengan target tabungan impian dan progress bar yang jelas, anak belajar menyisihkan uang jajan sehari-hari untuk mewujudkan cita-citanya.
                        </p>
                    </div>
                </div>

                <!-- Mobile Stage 2 -->
                <div class="space-y-6 text-left">
                    <div class="w-full max-w-[260px] mx-auto py-2">
                        <img src="/assets/iphone_riwayat.png" alt="Riwayat Transaksi" class="w-full h-auto object-contain drop-shadow-2xl">
                    </div>
                    <div class="space-y-3">
                        <h2 class="font-fredoka font-bold text-3xl sm:text-4xl text-slate-900 leading-tight">
                            aman. transparan. tenang.
                        </h2>
                        <p class="font-inter text-sm sm:text-base text-slate-800/90 font-medium leading-relaxed">
                            Orang tua bisa memantau aliran tabungan anak <span class="font-bold text-slate-900 underline decoration-amber-600 decoration-2 underline-offset-2">secara real-time dari rumah</span>. Setiap uang yang disetor di sekolah langsung tercatat rapi, tanpa rasa khawatir uang hilang atau salah catat.
                        </p>
                    </div>
                </div>

                <!-- Mobile Stage 3 -->
                <div class="space-y-6 text-left">
                    <div class="w-full max-w-[260px] mx-auto py-2">
                        <img src="/assets/iphone_guru.png" alt="Panel Guru" class="w-full h-auto object-contain drop-shadow-2xl">
                    </div>
                    <div class="space-y-3">
                        <h2 class="font-fredoka font-bold text-3xl sm:text-4xl text-slate-900 leading-tight">
                            cepat. rapi. otomatis.
                        </h2>
                        <p class="font-inter text-sm sm:text-base text-slate-800/90 font-medium leading-relaxed">
                            Bebaskan guru dari kerumitan buku kas manual. Pencatatan setoran selesai dalam hitungan detik dan <span class="font-bold text-slate-900 underline decoration-amber-600 decoration-2 underline-offset-2">laporan keuangan sekolah otomatis siap dicetak</span> kapan saja.
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

        // 2. GSAP ScrollTrigger Timeline for Desktop Gliding Phone (Duolingo Style)
        gsap.registerPlugin(ScrollTrigger);

        const mm = gsap.matchMedia();

        mm.add("(min-width: 1024px)", () => {
            const tl = gsap.timeline({
                scrollTrigger: {
                    trigger: "#duo-pinned-container",
                    start: "top top",
                    end: "bottom bottom",
                    scrub: 1,
                    pin: true,
                }
            });

            // Initial: Phone on Right (left: 62%), duo-img-1 visible, duo-text-1 visible

            // --- TRANSITION 1: Move Phone to LEFT, crossfade to Riwayat image, show Text 2 ---
            tl.to("#duo-text-1", { opacity: 0, y: -40, duration: 0.35 }, 0)
              .to("#duo-gliding-phone", { left: "6%", duration: 1, ease: "power2.inOut" }, 0.2)
              .to("#duo-img-1", { opacity: 0, duration: 0.4 }, 0.45)
              .to("#duo-img-2", { opacity: 1, duration: 0.4 }, 0.45)
              .to("#duo-text-2", { opacity: 1, y: 0, pointerEvents: "auto", duration: 0.45 }, 0.75);

            // --- TRANSITION 2: Move Phone back to RIGHT, crossfade to Guru image, show Text 3 ---
            tl.to("#duo-text-2", { opacity: 0, y: -40, duration: 0.35 }, 1.35)
              .to("#duo-gliding-phone", { left: "62%", duration: 1, ease: "power2.inOut" }, 1.55)
              .to("#duo-img-2", { opacity: 0, duration: 0.4 }, 1.75)
              .to("#duo-img-3", { opacity: 1, duration: 0.4 }, 1.75)
              .to("#duo-text-3", { opacity: 1, y: 0, pointerEvents: "auto", duration: 0.45 }, 2.05);
        });
    </script>

</body>
</html>
