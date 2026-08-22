<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.3, maximum-scale=3.0, user-scalable=yes">
    <title>Cetak Slip Login Ortu - {{ Auth::user()->school_name ?? 'SakuSiswa' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; }
            .slips-wrapper { padding: 0 !important; overflow: visible !important; }
            .zoomable-card { transform: none !important; }
            .slip-card { break-inside: avoid; }
        }
        .zoomable-card {
            touch-action: pan-x pan-y pinch-zoom;
        }
    </style>
</head>
<body class="bg-slate-100 p-2 sm:p-6 font-sans min-h-screen">
    
    <!-- Top Action Bar (Clean Header, No Zoom Buttons) -->
    <div class="max-w-5xl mx-auto mb-4 bg-white p-3.5 sm:p-4 rounded-2xl shadow-xs flex items-center justify-between gap-3 no-print">
        <div class="flex items-center space-x-3">
            <a href="{{ route('guru.siswa') }}" class="px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold transition-all flex items-center space-x-1">
                <span>← Kembali</span>
            </a>
            <div>
                <h1 class="text-sm sm:text-base font-bold text-slate-800 leading-tight">Slip Akses Login Ortu</h1>
                <p class="text-[10px] text-slate-500">Kartu login siswa siap cetak</p>
            </div>
        </div>

        <button onclick="window.print()" class="px-4 py-2 bg-amber-400 hover:bg-amber-500 text-slate-900 rounded-xl text-xs font-extrabold shadow-xs transition-all cursor-pointer">
            Cetak Slip
        </button>
    </div>

    <!-- Outer Horizontal Scroll & Touch Pinch Container -->
    <div class="slips-wrapper overflow-x-auto w-full pb-12 pt-2">
        <!-- Printable Slips Grid (Zoomable Card) -->
        <div class="zoomable-card min-w-[640px] max-w-5xl mx-auto grid grid-cols-2 gap-4 transition-transform duration-75">
            @forelse($students as $student)
                <div class="slip-card bg-white border-2 border-dashed border-slate-300 rounded-2xl p-5 space-y-3 relative overflow-hidden">
                    <!-- Watermark Logo -->
                    <div class="absolute -right-4 -bottom-4 w-24 h-24 opacity-5 pointer-events-none">
                        <img src="/assets/iconaplikasi.png" alt="Logo" class="w-full h-full object-contain">
                    </div>

                    <!-- Slip Header -->
                    <div class="flex items-center justify-between border-b pb-2.5">
                        <div class="flex items-center space-x-2">
                            <div class="w-7 h-7 rounded-lg bg-amber-100 flex items-center justify-center font-bold text-amber-800 text-xs">
                                S
                            </div>
                            <div>
                                <h2 class="text-xs font-extrabold text-slate-800 leading-tight">SakuSiswa - Kartu Login Tabungan</h2>
                                <p class="text-[10px] text-slate-500 font-medium">{{ Auth::user()->school_name ?? 'Sekolah Dasar' }} - {{ $student->class_name }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Student Identity -->
                    <div class="bg-amber-50/60 p-3 rounded-xl space-y-1">
                        <span class="text-[9px] text-amber-800 font-extrabold uppercase tracking-wider block">Nama Siswa</span>
                        <span class="text-sm font-extrabold text-slate-900 block">{{ $student->name }}</span>
                    </div>

                    <!-- Login Credentials -->
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                            <span class="text-[8px] text-slate-400 font-bold uppercase block">Username / NISN</span>
                            <span class="font-mono font-extrabold text-slate-800 block text-xs mt-0.5">{{ $student->nisn }}</span>
                        </div>
                        <div class="bg-slate-50 p-2.5 rounded-xl border border-slate-100">
                            <span class="text-[8px] text-slate-400 font-bold uppercase block">Password Bawaan</span>
                            <span class="font-mono font-extrabold text-slate-800 block text-xs mt-0.5">{{ $student->nisn }}</span>
                        </div>
                    </div>

                    <!-- Instructions Footer -->
                    <div class="pt-1 text-[9px] text-slate-500 font-medium leading-relaxed flex items-start space-x-1.5 border-t border-slate-100">
                        <span class="text-amber-600 font-bold">•</span>
                        <span>Unduh aplikasi <strong>SakuSiswa</strong> di Play Store. Masuk menggunakan NISN di atas untuk memantau tabungan harian.</span>
                    </div>
                </div>
            @empty
                <div class="col-span-2 text-center py-12 bg-white rounded-2xl text-slate-400 font-medium">
                    Belum ada data siswa untuk dicetak.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Touch Gesture Pinch-To-Zoom Handler -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const card = document.querySelector('.zoomable-card');
            if (!card) return;
            let initialDist = 0;
            let currentScale = 1;
            let startScale = 1;

            document.addEventListener('touchstart', (e) => {
                if (e.touches.length === 2) {
                    initialDist = Math.hypot(
                        e.touches[0].pageX - e.touches[1].pageX,
                        e.touches[0].pageY - e.touches[1].pageY
                    );
                    startScale = currentScale;
                }
            });

            document.addEventListener('touchmove', (e) => {
                if (e.touches.length === 2 && initialDist > 0) {
                    const dist = Math.hypot(
                        e.touches[0].pageX - e.touches[1].pageX,
                        e.touches[0].pageY - e.touches[1].pageY
                    );
                    currentScale = Math.min(Math.max(startScale * (dist / initialDist), 0.3), 3.0);
                    card.style.transform = `scale(${currentScale})`;
                    card.style.transformOrigin = 'top center';
                }
            });
        });
    </script>
</body>
</html>
