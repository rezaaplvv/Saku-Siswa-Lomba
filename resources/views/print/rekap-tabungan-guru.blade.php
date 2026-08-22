<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.3, maximum-scale=3.0, user-scalable=yes">
    <title>Rekap Tabungan {{ Auth::user()->class_name ?? 'Kelas' }} - {{ Auth::user()->school_name ?? 'SakuSiswa' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; }
            .report-wrapper { padding: 0 !important; overflow: visible !important; }
            .zoomable-card { border: none !important; shadow: none !important; padding: 0 !important; width: 100% !important; min-width: 0 !important; transform: none !important; }
        }
        .zoomable-card {
            touch-action: pan-x pan-y pinch-zoom;
        }
    </style>
</head>
<body class="bg-slate-100 p-2 sm:p-6 font-sans min-h-screen">
    
    <!-- Top Action Bar (Clean Header, No Zoom Buttons) -->
    <div class="max-w-4xl mx-auto mb-4 bg-white p-3.5 sm:p-4 rounded-2xl shadow-xs flex items-center justify-between gap-3 no-print">
        <div class="flex items-center space-x-3">
            <a href="{{ route('guru.siswa') }}" class="px-3.5 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-xs font-bold transition-all flex items-center space-x-1">
                <span>← Kembali</span>
            </a>
            <div>
                <h1 class="text-sm sm:text-base font-bold text-slate-800 leading-tight">Rekap Tabungan Kelas</h1>
                <p class="text-[10px] text-slate-500">Laporan resmi siap cetak / PDF</p>
            </div>
        </div>

        <button onclick="window.print()" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-extrabold shadow-xs transition-all cursor-pointer">
            Cetak PDF
        </button>
    </div>

    <!-- Outer Horizontal Scroll & Touch Pinch Container -->
    <div class="report-wrapper overflow-x-auto w-full pb-12 pt-2">
        <!-- Printable Report Container (Zoomable Card) -->
        <div class="zoomable-card min-w-[720px] max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-xs space-y-6 text-slate-800 transition-transform duration-75">
            
            <!-- Kop Surat Laporan -->
            <div class="border-b-2 border-slate-900 pb-4 text-center space-y-1">
                <h2 class="text-xl font-extrabold uppercase tracking-wide text-slate-900">{{ Auth::user()->school_name ?? 'SEKOLAH DASAR' }}</h2>
                <h3 class="text-base font-bold text-slate-700">LAPORAN REKAPITULASI TABUNGAN SISWA</h3>
                <p class="text-xs text-slate-500 font-medium">Kelas: <strong>{{ Auth::user()->class_name ?? '-' }}</strong> | Wali Kelas: <strong>{{ Auth::user()->name }}</strong> | Tanggal Cetak: <strong>{{ date('d F Y') }}</strong></p>
            </div>

            <!-- Summary Cards Row (Monochrome Clean Black/Slate Theme) -->
            <div class="grid grid-cols-3 gap-4 font-mono text-center">
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-300">
                    <span class="text-[10px] text-slate-700 font-bold uppercase block">Jumlah Murid</span>
                    <span class="text-base font-extrabold text-slate-900 block mt-0.5">{{ $students->count() }} Siswa</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-300">
                    <span class="text-[10px] text-slate-700 font-bold uppercase block">Total Saldo Tabungan</span>
                    <span class="text-base font-extrabold text-slate-900 block mt-0.5">Rp {{ number_format($students->sum('balance'), 0, ',', '.') }}</span>
                </div>
                <div class="bg-slate-50 p-3 rounded-xl border border-slate-300">
                    <span class="text-[10px] text-slate-700 font-bold uppercase block">Rata-rata Per Siswa</span>
                    <span class="text-base font-extrabold text-slate-900 block mt-0.5">
                        Rp {{ $students->count() > 0 ? number_format($students->sum('balance') / $students->count(), 0, ',', '.') : 0 }}
                    </span>
                </div>
            </div>

            <!-- Table of Students and Balances -->
            <table class="w-full text-left border-collapse border border-slate-300 text-xs">
                <thead>
                    <tr class="bg-slate-100 text-slate-900 font-extrabold">
                        <th class="border border-slate-300 px-3 py-2 text-center w-10">No</th>
                        <th class="border border-slate-300 px-3 py-2">NISN</th>
                        <th class="border border-slate-300 px-3 py-2">Nama Lengkap Siswa</th>
                        <th class="border border-slate-300 px-3 py-2 text-right">Target (Rp)</th>
                        <th class="border border-slate-300 px-3 py-2 text-right">Saldo Aktif (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $index => $student)
                        <tr class="hover:bg-slate-50">
                            <td class="border border-slate-300 px-3 py-2 text-center">{{ $index + 1 }}</td>
                            <td class="border border-slate-300 px-3 py-2 font-mono">{{ $student->nisn }}</td>
                            <td class="border border-slate-300 px-3 py-2 font-bold text-slate-900">{{ $student->name }}</td>
                            <td class="border border-slate-300 px-3 py-2 text-right text-slate-700">Rp {{ number_format($student->saving_target, 0, ',', '.') }}</td>
                            <td class="border border-slate-300 px-3 py-2 text-right font-extrabold text-slate-900">Rp {{ number_format($student->balance, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="border border-slate-300 px-3 py-4 text-center text-slate-500 italic">Belum ada siswa terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="bg-slate-100 font-extrabold text-slate-900">
                        <td colspan="4" class="border border-slate-300 px-3 py-2 text-right uppercase">Total Saldo Terkumpul:</td>
                        <td class="border border-slate-300 px-3 py-2 text-right font-black text-slate-900">Rp {{ number_format($students->sum('balance'), 0, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>

            <!-- Signatures Row -->
            <div class="grid grid-cols-2 gap-8 pt-8 text-center text-xs font-medium">
                <div class="space-y-16">
                    <p>Mengetahui,<br>Kepala Sekolah</p>
                    <p class="font-bold underline">( ............................................ )</p>
                </div>
                <div class="space-y-16">
                    <p>Mengetahui,<br>Wali Kelas {{ Auth::user()->class_name ?? '' }}</p>
                    <p class="font-bold underline"><strong>{{ Auth::user()->name }}</strong></p>
                </div>
            </div>

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
