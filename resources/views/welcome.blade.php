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

    <!-- Google Fonts: Fredoka (Bold Headlines) & Inter (Sub-headline & UI) -->
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
    </style>
</head>
<body class="bg-[#FFE96E] min-h-screen flex flex-col justify-between overflow-x-hidden selection:bg-amber-400 selection:text-slate-900">

    <!-- ======================================================== -->
    <!-- TOP NAVBAR: LOGO SAKUSISWA                              -->
    <!-- ======================================================== -->
    <header class="w-full max-w-7xl mx-auto px-6 sm:px-10 lg:px-12 pt-6 sm:pt-8 pb-4">
        <a href="{{ url('/') }}" class="inline-flex items-center space-x-3.5 group transition-transform duration-200 hover:scale-[1.02]">
            <div class="w-11 h-11 sm:w-12 sm:h-12 rounded-2xl bg-white/90 shadow-xs border border-amber-300/60 p-2 flex items-center justify-center">
                <img src="/assets/iconaplikasi.png" alt="SakuSiswa Logo" class="w-full h-full object-contain">
            </div>
            <span class="font-fredoka text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">
                Saku<span class="text-amber-900">Siswa</span>
            </span>
        </a>
    </header>

    <!-- ======================================================== -->
    <!-- MAIN HERO SECTION: 2 COLUMNS (MOCKUPS & HEADLINE)        -->
    <!-- ======================================================== -->
    <main class="w-full max-w-7xl mx-auto px-6 sm:px-10 lg:px-12 py-8 sm:py-12 my-auto flex-1 flex items-center">
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
    </main>

    <!-- ======================================================== -->
    <!-- BOTTOM FOOTER NOTE / SPACING                             -->
    <!-- ======================================================== -->
    <footer class="w-full max-w-7xl mx-auto px-6 sm:px-10 lg:px-12 py-4 text-center sm:text-left text-xs font-inter font-medium text-slate-700/60">
        <p>&copy; {{ date('Y') }} SakuSiswa. Platform Tabungan Sekolah Digital.</p>
    </footer>

</body>
</html>
