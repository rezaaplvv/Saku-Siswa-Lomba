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
    <!-- DESKTOP CONTINUOUS FLOATING IPHONE (SINGLE LIVING OBJECT) -->
    <!-- ======================================================== -->
    <div id="motion-phone-container" class="hidden lg:block fixed z-30 pointer-events-none w-[165px] xl:w-[185px]">
        <div class="relative w-full aspect-[9/18.5] flex items-center justify-center">
            
            <!-- Screen 1: Target Tabungan -->
            <img id="motion-img-1" 
                 src="/assets/iphone.png" 
                 alt="SakuSiswa Target Tabungan" 
                 class="absolute inset-0 w-full h-full object-contain drop-shadow-[0_22px_32px_rgba(0,0,0,0.22)] select-none">

            <!-- Screen 2: Riwayat Transaksi -->
            <img id="motion-img-2" 
                 src="/assets/iphone_riwayat.png" 
                 alt="SakuSiswa Riwayat Transaksi" 
                 class="absolute inset-0 w-full h-full object-contain drop-shadow-[0_22px_32px_rgba(0,0,0,0.22)] select-none opacity-0">

            <!-- Screen 3: Input Guru -->
            <img id="motion-img-3" 
                 src="/assets/iphone_guru.png" 
                 alt="SakuSiswa Panel Guru" 
                 class="absolute inset-0 w-full h-full object-contain drop-shadow-[0_22px_32px_rgba(0,0,0,0.22)] select-none opacity-0">

        </div>
    </div>

    <!-- ======================================================== -->
    <!-- SECTION 1: HERO SECTION                                  -->
    <!-- ======================================================== -->
    <section id="hero-section" class="w-full max-w-7xl mx-auto px-6 sm:px-10 lg:px-12 pt-6 pb-20 lg:pb-32 flex items-center min-h-[calc(100vh-100px)] relative">
        <div class="w-full grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 items-center">

            <!-- LEFT COLUMN: MACBOOK LAPTOP WRAPPER (Slides Left on Scroll) -->
            <div id="hero-macbook-col" class="lg:col-span-7 flex items-center justify-center relative">
                <div id="hero-macbook-wrap" class="relative w-full max-w-[540px] sm:max-w-[600px] lg:max-w-[640px] flex items-center justify-center">
                    
                    <!-- Macbook Laptop Mockup -->
                    <img src="/assets/macbook.png" 
                         alt="SakuSiswa on Macbook Laptop" 
                         class="w-full h-auto object-contain drop-shadow-[0_20px_35px_rgba(0,0,0,0.15)] select-none pointer-events-none">

                    <!-- Mobile-Only Static Phone in Hero (< lg) -->
                    <div class="block lg:hidden absolute -right-2 sm:-right-4 md:-right-6 bottom-0 sm:-bottom-2 w-[28%] sm:w-[32%] md:w-[34%] z-10">
                        <img src="/assets/iphone.png" 
                             alt="SakuSiswa on iPhone Smartphone" 
                             class="w-full h-auto object-contain drop-shadow-[0_25px_30px_rgba(0,0,0,0.25)] select-none pointer-events-none">
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: HERO HEADLINE & 3D BUTTONS (Slides Right on Scroll) -->
            <div id="hero-text-wrap" class="lg:col-span-5 flex flex-col items-start text-left space-y-5 sm:space-y-6 z-20">
                
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
    <!-- SECTION 2: CONTINUOUS SCROLLING SHOWCASE (MOTION PATH)   -->
    <!-- ======================================================== -->
    <section id="showcase-section" class="w-full bg-[#FFE96E] relative overflow-hidden py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-6 sm:px-10 lg:px-12 space-y-36 lg:space-y-64">

            <!-- ---------------------------------------------------- -->
            <!-- FEATURE 1: Target Tabungan (Text LEFT, Phone RIGHT)   -->
            <!-- ---------------------------------------------------- -->
            <div id="feature-1" class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center min-h-[70vh]">
                
                <!-- Text on Left -->
                <div id="feature-1-text" class="lg:col-span-6 space-y-5 text-left">
                    <h2 class="font-fredoka font-bold text-4xl sm:text-5xl lg:text-6xl text-slate-900 leading-[1.08] tracking-tight">
                        seru. mudah. terarah.
                    </h2>
                    <p class="font-inter text-base sm:text-lg lg:text-xl text-slate-800/90 font-medium leading-relaxed max-w-lg">
                        Menabung bersama SakuSiswa itu seru dan <span class="font-bold text-slate-900 underline decoration-amber-600 decoration-2 underline-offset-4">membuat anak bersemangat</span>! Dengan target tabungan impian dan progress bar yang jelas, anak belajar menyisihkan uang jajan sehari-hari untuk mewujudkan cita-citanya.
                    </p>
                </div>

                <!-- Target Dock on Right (For Desktop Motion) / Static on Mobile -->
                <div id="dock-1" class="lg:col-span-6 flex items-center justify-center">
                    <div class="block lg:hidden w-full max-w-[170px] mx-auto py-4">
                        <img src="/assets/iphone.png" alt="Target Tabungan" class="w-full h-auto object-contain drop-shadow-2xl">
                    </div>
                </div>

            </div>

            <!-- ---------------------------------------------------- -->
            <!-- FEATURE 2: Riwayat Transaksi (Phone LEFT, Text RIGHT) -->
            <!-- ---------------------------------------------------- -->
            <div id="feature-2" class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center min-h-[70vh]">
                
                <!-- Target Dock on Left (For Desktop Motion) / Static on Mobile -->
                <div id="dock-2" class="lg:col-span-6 flex items-center justify-center order-2 lg:order-1">
                    <div class="block lg:hidden w-full max-w-[170px] mx-auto py-4">
                        <img src="/assets/iphone_riwayat.png" alt="Riwayat Transaksi" class="w-full h-auto object-contain drop-shadow-2xl">
                    </div>
                </div>

                <!-- Text on Right -->
                <div id="feature-2-text" class="lg:col-span-6 space-y-5 text-left order-1 lg:order-2">
                    <h2 class="font-fredoka font-bold text-4xl sm:text-5xl lg:text-6xl text-slate-900 leading-[1.08] tracking-tight">
                        aman. transparan. tenang.
                    </h2>
                    <p class="font-inter text-base sm:text-lg lg:text-xl text-slate-800/90 font-medium leading-relaxed max-w-lg">
                        Orang tua bisa memantau aliran tabungan anak <span class="font-bold text-slate-900 underline decoration-amber-600 decoration-2 underline-offset-4">secara real-time dari rumah</span>. Setiap uang yang disetor di sekolah langsung tercatat rapi, tanpa rasa khawatir uang hilang atau salah catat.
                    </p>
                </div>

            </div>

            <!-- ---------------------------------------------------- -->
            <!-- FEATURE 3: Guru & Sekolah (Text LEFT, Phone RIGHT)   -->
            <!-- ---------------------------------------------------- -->
            <div id="feature-3" class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center min-h-[70vh]">
                
                <!-- Text on Left -->
                <div id="feature-3-text" class="lg:col-span-6 space-y-5 text-left">
                    <h2 class="font-fredoka font-bold text-4xl sm:text-5xl lg:text-6xl text-slate-900 leading-[1.08] tracking-tight">
                        cepat. rapi. otomatis.
                    </h2>
                    <p class="font-inter text-base sm:text-lg lg:text-xl text-slate-800/90 font-medium leading-relaxed max-w-lg">
                        Bebaskan guru dari kerumitan buku kas manual. Pencatatan setoran selesai dalam hitungan detik dan <span class="font-bold text-slate-900 underline decoration-amber-600 decoration-2 underline-offset-4">laporan keuangan sekolah otomatis siap dicetak</span> kapan saja.
                    </p>
                </div>

                <!-- Target Dock on Right (For Desktop Motion) / Static on Mobile -->
                <div id="dock-3" class="lg:col-span-6 flex items-center justify-center">
                    <div class="block lg:hidden w-full max-w-[170px] mx-auto py-4">
                        <img src="/assets/iphone_guru.png" alt="Panel Guru" class="w-full h-auto object-contain drop-shadow-2xl">
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ======================================================== -->
    <!-- SECTION 3: CALL TO ACTION BANNER (BOTTOM)                -->
    <!-- ======================================================== -->
    <section id="cta-section" class="w-full max-w-7xl mx-auto px-6 sm:px-10 lg:px-12 py-16 lg:py-24 text-center relative z-20">
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

        lenis.on('scroll', ScrollTrigger.update);
        gsap.ticker.add((time) => {
            lenis.raf(time * 1000);
        });
        gsap.ticker.lagSmoothing(0);

        // 2. GSAP ScrollTrigger Master Choreography
        gsap.registerPlugin(ScrollTrigger);

        const mm = gsap.matchMedia();

        mm.add("(min-width: 1024px)", () => {
            const phoneContainer = document.getElementById("motion-phone-container");
            const heroSection = document.getElementById("hero-section");
            const showcaseSection = document.getElementById("showcase-section");
            const ctaSection = document.getElementById("cta-section");

            // Initial State: Phone is positioned at Hero beside the Laptop
            gsap.set(phoneContainer, {
                top: "54%",
                left: "44%",
                yPercent: -50,
                xPercent: -50,
                scale: 0.95,
                rotation: 0,
                opacity: 1,
            });

            // ========================================================
            // TIMELINE: FROM HERO -> DETACH -> SECTION 1 -> 2 -> 3 -> CTA
            // ========================================================
            const masterTl = gsap.timeline({
                scrollTrigger: {
                    trigger: heroSection,
                    endTrigger: ctaSection,
                    start: "top top",
                    end: "top 70%",
                    scrub: 1.1,
                }
            });

            // --------------------------------------------------------
            // STEP 1: HERO SCROLL EXIT & DETACH INTO SECTION 1
            // --------------------------------------------------------
            // Macbook exits to the left
            masterTl.to("#hero-macbook-wrap", {
                x: -180,
                opacity: 0,
                ease: "power1.inOut",
                duration: 1.0
            }, 0);

            // Hero text & buttons exit to the right
            masterTl.to("#hero-text-wrap", {
                x: 180,
                opacity: 0,
                ease: "power1.inOut",
                duration: 1.0
            }, 0);

            // iPhone detaches and glides to Section 1 (Right: 66%)
            masterTl.to(phoneContainer, {
                top: "50%",
                left: "66%",
                xPercent: 0,
                scale: 1,
                rotation: 0,
                ease: "power1.inOut",
                duration: 1.2
            }, 0.2);

            // --------------------------------------------------------
            // STEP 2: SECTION 1 -> SECTION 2 (GLIDE TO LEFT: 26%)
            // --------------------------------------------------------
            masterTl.to(phoneContainer, {
                left: "26%",
                rotation: -3,
                ease: "power1.inOut",
                duration: 1.2
            }, 1.8)
            .to("#motion-img-1", { opacity: 0, duration: 0.5 }, 2.0)
            .to("#motion-img-2", { opacity: 1, duration: 0.5 }, 2.0);

            // --------------------------------------------------------
            // STEP 3: SECTION 2 -> SECTION 3 (GLIDE BACK TO RIGHT: 66%)
            // --------------------------------------------------------
            masterTl.to(phoneContainer, {
                left: "66%",
                rotation: 2,
                ease: "power1.inOut",
                duration: 1.2
            }, 3.4)
            .to("#motion-img-2", { opacity: 0, duration: 0.5 }, 3.6)
            .to("#motion-img-3", { opacity: 1, duration: 0.5 }, 3.6);

            // --------------------------------------------------------
            // STEP 4: SECTION 3 -> CTA (FADE OUT INTO BOTTOM BANNER)
            // --------------------------------------------------------
            masterTl.to(phoneContainer, {
                opacity: 0,
                scale: 0.8,
                duration: 0.6
            }, 4.8);

        });
    </script>

</body>
</html>
