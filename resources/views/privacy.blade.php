<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="color-scheme" content="only light">
    <title>Kebijakan Privasi - SakuSiswa</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/assets/iconaplikasi.png">
    <link rel="shortcut icon" type="image/png" href="/assets/iconaplikasi.png">
    <link rel="apple-touch-icon" href="/assets/iconaplikasi.png">
    
    <!-- Premium Google Fonts Import -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css'])
</head>
<body class="bg-[#ffd554] text-slate-900 antialiased min-h-screen flex items-center justify-center p-4 sm:p-6 font-sans">

    <div class="w-full max-w-2xl bg-white rounded-3xl p-6 sm:p-10 shadow-2xl border border-slate-100 font-['Outfit'] space-y-6 text-left relative overflow-hidden">
        <!-- Accent circles -->
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-amber-400/20 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-amber-400/20 rounded-full blur-2xl pointer-events-none"></div>

        <!-- Header -->
        <div class="flex items-center space-x-3.5 border-b border-slate-100 pb-5 relative z-10">
            <div class="w-10 h-10 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600 shrink-0 shadow-3xs border border-amber-100/50">
                <img src="/assets/iconaplikasi.png" alt="Logo" class="w-6 h-6 object-contain">
            </div>
            <div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-800 tracking-tight">Kebijakan Privasi</h1>
                <p class="text-xs text-slate-400 font-medium font-sans">Terakhir diperbarui: Juli 2026</p>
            </div>
        </div>

        <!-- Content -->
        <div class="space-y-4.5 text-xs sm:text-sm text-slate-700 leading-relaxed font-sans relative z-10">
            <p>
                Selamat datang di SakuSiswa (Platform Tabungan Sekolah Digital). Kami berkomitmen penuh untuk melindungi privasi dan informasi pribadi siswa, orang tua, serta tenaga pendidik kami. Halaman ini menjelaskan bagaimana kami mengumpulkan, menyimpan, menggunakan, dan melindungi data pribadi Anda sesuai dengan standar keamanan Google Play Store dan undang-undang perlindungan data yang berlaku di Indonesia.
            </p>

            <div class="space-y-2">
                <h3 class="font-extrabold text-slate-800 text-sm font-['Outfit']">1. Informasi yang Kami Kumpulkan</h3>
                <p>
                    Aplikasi SakuSiswa hanya mengumpulkan informasi minimum yang diperlukan untuk memfasilitasi administrasi tabungan sekolah secara digital, meliputi:
                </p>
                <ul class="list-disc pl-5 space-y-1 font-medium">
                    <li><strong>Data Identitas</strong>: Nama lengkap siswa dan tingkatan kelas.</li>
                    <li><strong>Data Kredensial</strong>: Nomor Induk Siswa Nasional (NISN) yang digunakan sebagai pengenal unik/username masuk.</li>
                    <li><strong>Data Transaksi</strong>: Catatan riwayat setoran, penarikan, tanggal transaksi, dan sisa saldo tabungan siswa.</li>
                    <li><strong>Data Keamanan</strong>: Kata sandi akun orang tua dan PIN otorisasi transaksi (yang disimpan dalam bentuk enkripsi satu arah satu sandi).</li>
                </ul>
            </div>

            <div class="space-y-2">
                <h3 class="font-extrabold text-slate-800 text-sm font-['Outfit']">2. Tujuan Penggunaan Data</h3>
                <p>
                    Kami memproses data pribadi Anda secara terbatas untuk tujuan-tujuan berikut:
                </p>
                <ul class="list-disc pl-5 space-y-1 font-medium">
                    <li>Menyediakan akses dasbor mandiri bagi orang tua untuk memantau mutasi saldo anak.</li>
                    <li>Membantu guru kelas dan administrator sekolah melakukan pencatatan transaksi masuk dan keluar.</li>
                    <li>Memvalidasi otorisasi transaksi penarikan dana menggunakan PIN transaksi orang tua secara aman.</li>
                </ul>
            </div>

            <div class="space-y-2">
                <h3 class="font-extrabold text-slate-800 text-sm font-['Outfit']">3. Keamanan Data & Enkripsi</h3>
                <p>
                    Semua transmisi data antara aplikasi dan server dilindungi dengan enkripsi SSL/HTTPS. Kredensial penting seperti kata sandi dan PIN dienkripsi menggunakan algoritma hashing satu arah yang aman di dalam database. Kami tidak pernah menyimpan kata sandi dalam bentuk teks biasa.
                </p>
            </div>

            <div class="space-y-2">
                <h3 class="font-extrabold text-slate-800 text-sm font-['Outfit']">4. Ketiadaan Pembagian Data Pihak Ketiga (No Third-Party Sharing)</h3>
                <p>
                    Aplikasi SakuSiswa <strong>tidak mengandung iklan</strong> dan <strong>tidak menggunakan SDK pelacakan pihak ketiga</strong> untuk analitik iklan. Kami menjamin bahwa seluruh data tabungan dan informasi pribadi siswa disimpan secara aman di dalam server sekolah dan <strong>tidak akan pernah dijual, disewakan, atau dibagikan</strong> kepada pihak ketiga mana pun untuk tujuan komersial.
                </p>
            </div>

            <div class="space-y-2">
                <h3 class="font-extrabold text-slate-800 text-sm font-['Outfit']">5. Hak Pengguna & Prosedur Penghapusan Data</h3>
                <p>
                    Orang tua/wali murid memiliki hak penuh untuk mengakses, memperbaiki, atau meminta penghapusan akun serta seluruh data pribadi siswa dari database SakuSiswa.
                </p>
                <p class="font-semibold text-slate-800">
                    Prosedur Pengajuan Penghapusan Data:
                </p>
                <ul class="list-disc pl-5 space-y-1">
                    <li>Kirimkan email permohonan ke email resmi: <strong>siswasaku@gmail.com</strong> dengan subjek *"Permohonan Hapus Data SakuSiswa"*, atau melalui layanan bantuan yang tersedia di aplikasi.</li>
                    <li>Cantumkan nama lengkap siswa, kelas, dan nomor NISN yang ingin dihapus.</li>
                    <li>Tim IT Administrator SakuSiswa akan memverifikasi permohonan Anda dan menghapus seluruh catatan akun serta data pribadi siswa terkait dari database utama dalam kurun waktu maksimal 7 (tujuh) hari kerja setelah permohonan diterima.</li>
                </ul>
            </div>

            <div class="space-y-2">
                <h3 class="font-extrabold text-slate-800 text-sm font-['Outfit']">6. Hubungi Tim Layanan</h3>
                <p>
                    Untuk pertanyaan, keluhan, atau konsultasi lebih lanjut mengenai penanganan privasi data Anda, silakan hubungi kami secara langsung melalui:
                </p>
                <ul class="list-disc pl-5 space-y-0.5 font-medium">
                    <li><strong>Kantor Administrasi</strong>: Pengembang Platform Digital SakuSiswa, Indonesia.</li>
                    <li><strong>Email Utama</strong>: siswasaku@gmail.com</li>
                </ul>
            </div>
        </div>

        <!-- Footer Action -->
        <div class="border-t border-slate-100 pt-5 flex items-center justify-end relative z-10">
            <a 
                href="/login" 
                class="px-5 py-3 bg-[#0c1a30] hover:bg-slate-800 text-white font-extrabold rounded-2xl text-xs transition-all active:scale-[0.98] cursor-pointer shadow-xs font-['Outfit'] flex items-center space-x-1.5"
            >
                <svg class="w-4 h-4 text-white transform rotate-180" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
                <span>Kembali ke Login</span>
            </a>
        </div>
    </div>

</body>
</html>
