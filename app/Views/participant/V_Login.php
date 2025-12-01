<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Peserta — Pemilihan OSIS</title>
    <meta name="description" content="Halaman login peserta pemilihan OSIS yang simpel, cepat, dan nyaman di perangkat mobile." />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                        soft: '0 18px 45px rgba(15,23,42,.06)'
                    }
                }
            }
        }
    </script>
</head>

<body class="min-h-screen bg-gradient-to-b from-sky-50 via-white to-slate-50 text-slate-900">
    <main class="min-h-screen flex items-center justify-center px-4">
        <div class="w-full max-w-md">
            <!-- Brand & periode -->
            <header class="mb-6 text-center">
                <div class="mb-3 flex items-center justify-center gap-3">
                    <div class="grid h-10 w-10 place-items-center rounded-2xl bg-brand text-xs font-semibold text-white">
                        OS
                    </div>
                    <div class="text-left">
                        <p class="text-[11px] uppercase tracking-[0.18em] text-slate-500">Pemilihan OSIS</p>
                        <p class="text-xs font-medium text-slate-600">Periode 2025 / 2026</p>
                    </div>
                </div>

                <h1 class="text-xl font-semibold tracking-tight text-slate-900 sm:text-2xl">
                    Login untuk mulai memilih
                </h1>
                <p class="mt-1 text-xs text-slate-500">
                    Gunakan akun sekolah yang sudah didaftarkan panitia.
                </p>
            </header>

            <!-- Card login -->
            <section class="rounded-3xl border border-slate-200 bg-white p-5 shadow-soft sm:p-6">
                <?= form_open("login/participant", ["class" => "space-y-4"]) ?>
                <!-- NIS / Email -->
                <div class="space-y-1.5">
                    <label for="identity" class="block text-xs font-medium text-slate-700">
                        NISN
                    </label>
                    <input
                        type="text"
                        id="identity"
                        name="identity"
                        required
                        autocomplete="username"
                        inputmode="text"
                        placeholder="Masukkan NISN kamu"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 text-sm text-slate-900 placeholder:text-slate-400 outline-none transition
                     focus:border-brand focus:bg-white focus:ring-2 focus:ring-brand/25" />
                </div>

                <!-- Password -->
                <div class="space-y-1.5">
                    <label for="password" class="block text-xs font-medium text-slate-700">
                        Kata sandi
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Kata sandi"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-3.5 py-2.5 pr-10 text-sm text-slate-900 placeholder:text-slate-400 outline-none transition
                   focus:border-brand focus:bg-white focus:ring-2 focus:ring-brand/25" />

                        <!-- Tombol show/hide -->
                        <button
                            type="button"
                            id="togglePassword"
                            class="absolute inset-y-0 right-2 flex items-center px-2 text-slate-400 hover:text-slate-700 focus:outline-none"
                            aria-label="Tampilkan / sembunyikan kata sandi">
                            <!-- ikon ‘eye’ -->
                            <svg data-eye="show" class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z" />
                                <circle cx="12" cy="12" r="3" />
                            </svg>
                            <!-- ikon ‘eye-off’ -->
                            <svg data-eye="hide" class="h-4 w-4 hidden" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17.94 17.94A10.94 10.94 0 0 1 12 20c-7 0-11-8-11-8a21.77 21.77 0 0 1 5.06-6.36" />
                                <path d="M9.9 4.24A10.94 10.94 0 0 1 12 4c7 0 11 8 11 8a21.8 21.8 0 0 1-4.87 6.23" />
                                <line x1="1" y1="1" x2="23" y2="23" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Options -->
                <div class="flex items-center justify-between text-[11px] text-slate-600">
                    <label class="inline-flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="remember"
                            class="h-3.5 w-3.5 rounded border-slate-300 text-brand focus:ring-brand/60" />
                        <span>Ingat di perangkat ini</span>
                    </label>
                    <a href="#" class="font-medium text-brand hover:text-blue-700">
                        Lupa sandi?
                    </a>
                </div>

                <!-- Button -->
                <button
                    type="submit"
                    class="mt-1 inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-brand px-4 py-2.5 text-sm font-medium text-white
                   shadow-md shadow-brand/30 transition hover:bg-blue-700 focus-visible:outline-none
                   focus-visible:ring-2 focus-visible:ring-brand/60 focus-visible:ring-offset-2 focus-visible:ring-offset-sky-50 active:scale-95">
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14" />
                        <path d="m12 5 7 7-7 7" />
                    </svg>
                    <span>Masuk & lanjut ke pemilihan</span>
                </button>
                <?= form_close() ?>

                <!-- Info kecil -->
                <p class="mt-4 text-[11px] leading-relaxed text-slate-500">
                    1 akun hanya dapat digunakan untuk memberikan 1 suara. Identitas dipakai untuk verifikasi, bukan untuk melihat pilihanmu.
                </p>
            </section>

            <!-- Link panitia -->
            <div class="mt-5 text-center">
                <a href="/admin/login" class="inline-flex items-center gap-1 text-[11px] text-slate-500 hover:text-slate-700">
                    <span>Masuk sebagai panitia</span>
                </a>
            </div>
        </div>
    </main>

    <?= session()->getFlashdata('msg') ?>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const btn = document.getElementById('togglePassword');
            if (!input || !btn) return;

            const isHidden = input.type === 'password';
            input.type = isHidden ? 'text' : 'password';
            btn.setAttribute('aria-pressed', isHidden ? 'true' : 'false');

            const showIcon = btn.querySelector('[data-eye="show"]');
            const hideIcon = btn.querySelector('[data-eye="hide"]');
            if (showIcon && hideIcon) {
                showIcon.classList.toggle('hidden', !isHidden);
                hideIcon.classList.toggle('hidden', isHidden);
            }
        }

        // kalau mau pakai onclick di HTML:
        document.getElementById('togglePassword')?.addEventListener('click', togglePassword);
    </script>


</body>

</html>