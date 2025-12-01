<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pemilihan OSIS — Terima Kasih</title>
    <meta name="description" content="Halaman konfirmasi setelah siswa selesai memberikan suara pada pemilihan OSIS." />
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
                        card: '0 8px 30px rgba(0,0,0,.06)'
                    }
                }
            }
        }
    </script>
    <style>
        dialog::backdrop {
            background: rgb(0 0 0 / .45);
        }

        .focus-ring:focus-visible {
            outline: 3px solid rgb(37 99 235 / .55);
            outline-offset: 2px;
            border-radius: 1rem;
        }

        .hide-radio {
            position: absolute;
            inset: 0;
            opacity: 0;
            pointer-events: none;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-b from-slate-50 to-white text-slate-800">
    <!-- Header -->
    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/70 backdrop-blur">
        <div class="mx-auto max-w-6xl px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="grid h-10 w-10 place-items-center rounded-xl bg-brand text-white font-bold">OS</div>
                <div>
                    <p class="text-xs text-slate-500">Pemilihan OSIS</p>
                    <h1 class="text-lg font-semibold">Periode 2025/2026</h1>
                </div>
            </div>
            <div class="hidden sm:flex items-center gap-3 text-sm">
                <div id="timer" class="rounded-full bg-slate-100 px-3 py-1">Terima kasih telah berpartisipasi</div>
                <span class="rounded-full border px-3 py-1 text-slate-500 text-xs">Suara kamu sudah terekam</span>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4">
        <!-- MAIN CONTENT: Terima kasih sudah memilih -->
        <section class="min-h-[70vh] flex flex-col items-center justify-center py-10">
            <div class="w-full max-w-xl">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-card sm:p-8">
                    <!-- Icon success -->
                    <div class="mx-auto mb-5 grid h-14 w-14 place-items-center rounded-2xl bg-emerald-50 text-emerald-600">
                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 6 9 17l-5-5" />
                        </svg>
                    </div>

                    <!-- Title & copy -->
                    <div class="text-center space-y-2">
                        <h2 class="text-xl sm:text-2xl font-semibold text-slate-900">
                            Terima kasih sudah memilih! 🎉
                        </h2>
                        <p class="text-sm text-slate-600">
                            Suaramu untuk pemilihan <span class="font-medium">Ketua & Wakil OSIS Periode 2025/2026</span>
                            sudah tercatat dengan baik.
                        </p>
                    </div>

                    <!-- Ringkasan suara (isi dinamis dari backend kalau mau) -->
                    <div class="mt-6 rounded-2xl border border-slate-200 bg-slate-50/70 p-4 text-sm">
                        <h3 class="mb-3 text-xs font-semibold uppercase tracking-[0.16em] text-slate-500">
                            Ringkasan suara
                        </h3>
                        <dl class="grid gap-3 text-xs sm:grid-cols-2">
                            <div class="space-y-0.5">
                                <dt class="text-slate-500">Pilihanmu</dt>
                                <dd class="font-medium text-slate-900">
                                    <!-- Ganti teks ini dari backend -->
                                    No. XX — Nama Paslon
                                </dd>
                            </div>
                            <div class="space-y-0.5">
                                <dt class="text-slate-500">Waktu terekam</dt>
                                <dd class="font-medium text-slate-900">
                                    <!-- Ganti dinamis: misalnya 30 Nov 2025, 10.32 WIB -->
                                    {{ waktu_submit }}
                                </dd>
                            </div>
                            <div class="space-y-0.5">
                                <dt class="text-slate-500">ID bukti (opsional)</dt>
                                <dd class="font-mono text-[11px] text-slate-700 break-all">
                                    <!-- Bisa diisi token / kode referensi -->
                                    {{ vote_receipt }}
                                </dd>
                            </div>
                            <div class="space-y-0.5">
                                <dt class="text-slate-500">Status</dt>
                                <dd class="font-medium text-emerald-600">
                                    Terekam • 1 akun hanya bisa memilih sekali
                                </dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Actions -->
                    <div class="mt-6 gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div class="">
                            <div>
                                <a href="/public" class="inline-flex items-center justify-center w-full gap-2 rounded-xl bg-brand px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M5 12h14" />
                                        <path d="m12 5 7 7-7 7" />
                                    </svg>
                                    <span>Lihat hasil sementara</span>
                                </a>
                            </div>
                            <div>
                                <a href="logout" class="inline-flex items-center justify-center w-full mt-2 gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                        <path d="M16 17l5-5-5-5" />
                                    </svg>
                                    <span>Keluar / tutup sesi</span>
                                </a>
                            </div>
                        </div>
                        <p class="text-[11px] text-center mt-3 text-slate-500">
                            Jika merasa ada kesalahan, segera hubungi panitia OSIS.
                        </p>
                    </div>
                </div>

                <!-- Info kecil di bawah card -->
                <p class="mt-5 text-center text-[11px] text-slate-500">
                    Halaman ini hanya sebagai bukti bahwa suara kamu sudah masuk. Pilihanmu tetap rahasia
                    dan tidak dapat diubah kembali.
                </p>
            </div>
        </section>

        <footer class="mb-10 pb-10 text-center text-sm text-slate-500">
            © 2025 OSIS — Halaman pemungutan suara siswa (bukan admin)
        </footer>
    </main>
</body>

</html>