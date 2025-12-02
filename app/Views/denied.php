<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Halaman Tidak Ditemukan — 404</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            DEFAULT: '#2563eb'
                        }
                    },
                    boxShadow: {
                        soft: '0 18px 40px rgba(15,23,42,0.06)'
                    }
                }
            }
        };
    </script>
</head>

<body class="min-h-screen bg-slate-50 text-slate-900 antialiased flex items-center justify-center px-4">

    <main class="w-full max-w-xl">
        <!-- Brand kecil -->
        <div class="mb-6 flex items-center justify-center gap-3 text-xs text-slate-500">
            <div class="h-9 w-9 rounded-2xl bg-white border border-slate-200 shadow-sm flex items-center justify-center">
                <span class="text-[10px] font-semibold tracking-[0.14em] text-slate-700">OS</span>
            </div>
            <div class="text-left">
                <p class="uppercase tracking-[0.18em] text-[10px] text-slate-500">
                    Panel Pemilihan OSIS
                </p>
                <p class="text-[11px] text-slate-500">
                    Sistem pemilihan internal sekolah.
                </p>
            </div>
        </div>

        <!-- Card utama -->
        <section
            class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white px-6 py-7 shadow-soft">

            <!-- aksen halus -->
            <div class="pointer-events-none absolute -top-10 -right-10 h-28 w-28 rounded-full bg-sky-100/80 blur-2xl"></div>

            <div class="relative">
                <!-- Label kecil -->
                <span
                    class="mb-3 inline-flex items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-[11px] text-slate-500">
                    <span class="h-1.5 w-1.5 rounded-full bg-amber-400"></span>
                    Halaman tidak ditemukan
                </span>

                <!-- 404 besar -->
                <div class="mb-3 flex items-baseline gap-2">
                    <p class="text-4xl font-semibold tracking-tight text-slate-900">
                        404
                    </p>
                </div>

                <p class="text-sm text-slate-600 mb-4">
                    Halaman yang kamu cari tidak tersedia, sudah dipindahkan, atau URL yang
                    dimasukkan kurang tepat. Coba cek kembali alamatnya, atau kembali ke halaman utama.
                </p>

                <!-- Tombol aksi -->
                <div class="flex flex-col sm:flex-row gap-2">
                    <a href="/"
                        class="inline-flex flex-1 items-center justify-center rounded-2xl bg-brand px-4 py-2.5 text-sm font-medium text-white hover:bg-blue-600 transition">
                        Pergi ke beranda
                    </a>
                </div>
            </div>
        </section>

        <!-- Footer kecil -->
        <p class="mt-4 text-center text-[11px] text-slate-500">
            Jika masalah terus berulang, silakan hubungi panitia atau admin sistem.
        </p>
    </main>

</body>

</html>