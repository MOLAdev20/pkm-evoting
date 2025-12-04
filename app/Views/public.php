<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pemilihan OSIS — Akses Publik</title>
    <meta name="description" content="Halaman publik pemilihan OSIS: informasi singkat, quick count, dan akses login peserta.">
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
                        soft: '0 20px 50px rgba(15,23,42,.08)'
                    },
                    keyframes: {
                        'vote-pop': {
                            '0%': {
                                transform: 'translateY(0) scale(1)',
                                boxShadow: '0 0 0 rgba(37,99,235,0)'
                            },
                            '40%': {
                                transform: 'translateY(-2px) scale(1.01)',
                                boxShadow: '0 14px 30px rgba(37,99,235,.25)'
                            },
                            '100%': {
                                transform: 'translateY(0) scale(1)',
                                boxShadow: '0 0 0 rgba(37,99,235,0)'
                            }
                        },
                        'bar-glow': {
                            '0%': {
                                boxShadow: '0 0 0 rgba(37,99,235,0)',
                                opacity: '0.9'
                            },
                            '40%': {
                                boxShadow: '0 0 0 3px rgba(37,99,235,.4)',
                                opacity: '1'
                            },
                            '100%': {
                                boxShadow: '0 0 0 rgba(37,99,235,0)',
                                opacity: '1'
                            }
                        }
                    },
                    animation: {
                        'vote-pop': 'vote-pop 0.45s ease-out',
                        'bar-glow': 'bar-glow 0.6s ease-out'
                    }
                }
            }
        }
    </script>
</head>

<body class="min-h-screen bg-gradient-to-b from-sky-50 via-white to-slate-50 text-slate-900">
    <!-- HEADER -->
    <header class="sticky top-0 z-30 border-b border-slate-200/70 bg-white/80 backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-3">
            <div class="flex items-center gap-2">
                <div class="grid h-9 w-9 place-items-center rounded-2xl bg-brand text-xs font-semibold text-white">
                    OS
                </div>
                <div class="leading-tight">
                    <p class="text-[10px] uppercase tracking-[0.18em] text-slate-500">
                        Pemilihan OSIS
                    </p>
                    <p class="text-xs font-medium text-slate-800">
                        Periode 2025 / 2026
                    </p>
                </div>
            </div>

            <nav class="hidden items-center gap-5 text-xs text-slate-600 md:flex">
                <a href="#quick-count" class="hover:text-slate-900">Quick count</a>
                <a href="#info" class="hover:text-slate-900">Cara memilih</a>
            </nav>

            <div class="flex items-center gap-3">
                <span class="hidden text-[11px] text-slate-500 sm:inline">
                    TPS Online • Siswa
                </span>
                <a
                    href="<?= base_url('login/participant') ?>"
                    class="inline-flex items-center gap-1.5 rounded-full bg-brand px-3.5 py-1.5 text-xs font-medium text-white shadow-sm shadow-brand/30 hover:bg-blue-700">
                    <span>Masuk untuk memilih</span>
                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4 pb-12 pt-8">
        <!-- HERO -->
        <section class="relative overflow-hidden rounded-3xl border border-sky-100 bg-gradient-to-br from-white via-sky-50 to-sky-100 p-6 shadow-soft md:p-8">
            <!-- background bubbles -->
            <div class="pointer-events-none absolute inset-0">
                <div class="absolute -right-10 top-0 h-40 w-40 rounded-full bg-sky-200/60 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 h-40 w-40 rounded-full bg-indigo-100/70 blur-3xl"></div>
            </div>

            <div class="relative grid gap-8 md:grid-cols-[minmax(0,3fr)_minmax(0,2.3fr)] md:items-center">
                <!-- copy -->
                <div class="space-y-5">
                    <div class="inline-flex items-center gap-2 rounded-full bg-white/70 px-3 py-1 text-[11px] text-slate-600 ring-1 ring-slate-200/70 backdrop-blur">
                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        <span>Pemilihan OSIS sedang berlangsung</span>
                    </div>

                    <div class="space-y-2">
                        <h1 class="text-3xl font-semibold tracking-tight text-slate-900 sm:text-4xl">
                            Akses publik pemilihan OSIS,
                            <span class="text-brand">pantau hasilnya</span> dari mana saja.
                        </h1>
                        <p class="max-w-xl text-sm text-slate-600">
                            Halaman ini menampilkan perolehan suara sementara Ketua & Wakil OSIS.
                            Siapa pun di sekolah dapat memantau perkembangan tanpa harus login.
                        </p>
                    </div>

                    <div class="flex flex-wrap items-center gap-3">
                        <a
                            href="<?= base_url('login/participant') ?>"
                            class="inline-flex items-center gap-2 rounded-2xl bg-brand px-4 py-2 text-sm font-medium text-white shadow-md shadow-brand/30 hover:bg-blue-700">
                            <span>Masuk untuk ikut memilih</span>
                        </a>
                        <a
                            href="#quick-count"
                            class="inline-flex items-center gap-1.5 rounded-2xl bg-white/80 px-4 py-2 text-sm text-slate-700 ring-1 ring-slate-200 hover:bg-white">
                            <span>Lihat quick count</span>
                        </a>
                    </div>

                    <div class="flex flex-wrap gap-4 text-[11px] text-slate-500">
                        <div class="flex items-center gap-1.5">
                            <span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span>
                            <span>1 akun siswa = 1 suara</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            <span>Pilihan individu tetap rahasia</span>
                        </div>
                    </div>
                </div>

                <!-- summary card -->
                <?php if (!empty($candidateGroup)) : ?>
                    <aside class="rounded-3xl bg-white/80 p-4 shadow-soft ring-1 ring-slate-200/80 backdrop-blur-sm">
                        <header class="mb-3 flex items-center justify-between text-xs">
                            <div>
                                <p class="text-[11px] uppercase tracking-[0.16em] text-slate-500">
                                    Status TPS Online
                                </p>
                                <p id="pollStatus" class="text-xs font-semibold text-emerald-600">
                                    Sedang berlangsung
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-[11px] text-slate-500">Berakhir dalam</p>
                                <p id="timer" class="text-xs font-semibold text-slate-800">–</p>
                            </div>
                        </header>

                        <dl class="grid grid-cols-2 gap-3 text-xs">
                            <div class="rounded-2xl bg-slate-50 px-3 py-2.5">
                                <dt class="text-slate-500">Total suara masuk</dt>
                                <dd id="heroTotal" class="mt-1 text-base font-semibold text-slate-900">0</dd>
                                <dd class="mt-0.5 text-[11px] text-slate-500">update realtime</dd>
                            </div>
                            <div class="rounded-2xl bg-slate-50 px-3 py-2.5">
                                <dt class="text-slate-500">Perkiraan partisipasi</dt>
                                <dd id="heroPercent" class="mt-1 text-base font-semibold text-slate-900">0%</dd>
                                <dd class="mt-0.5 text-[11px] text-slate-500">dari target 800 siswa</dd>
                            </div>
                        </dl>

                        <div class="mt-4 rounded-2xl border border-slate-100 bg-slate-50/60 p-3">
                            <p class="mb-2 text-[11px] font-medium uppercase tracking-[0.16em] text-slate-500">
                                Snapshot cepat
                            </p>
                            <div class="space-y-2 text-xs text-slate-700">
                                <div class="flex items-center justify-between">
                                    <span>Nadia &amp; Raka</span>
                                    <span id="snapA1" class="tabular-nums font-semibold">0%</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span>Dewi &amp; Arif</span>
                                    <span id="snapB2" class="tabular-nums font-semibold">0%</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span>Satria &amp; Maya</span>
                                    <span id="snapC3" class="tabular-nums font-semibold">0%</span>
                                </div>
                            </div>
                        </div>
                    </aside>
                <?php endif; ?>
            </div>
        </section>

        <!-- QUICK COUNT -->
        <?php if (!empty($candidateGroup)): ?>
            <section id="quick-count" class="mt-10">
                <div class="mb-5 flex flex-wrap items-end justify-between gap-3">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">
                            Pemlihan Sedang Berlangsung
                        </h2>
                        <p class="text-xs text-slate-500">
                            Angka di bawah diperbarui secara berkala dan belum merupakan hasil resmi.
                        </p>
                    </div>
                    <div class="text-right text-xs text-slate-500">
                        <p id="totalVotes">Total suara terekam: 0</p>
                        <p id="lastUpdate">Pembaruan terakhir: –</p>
                    </div>
                </div>

                <div class="grid gap-4 md:grid-cols-3">

                    <?php foreach ($candidateGroup as $cg): ?>
                        <article
                            class="flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-soft/40 transition-transform"
                            data-candidate-id="<?= $cg["id"] ?>"
                            data-no="<?= $cg["id"] ?>"
                            data-nama="<?= $cg["chairperson"] ?> &amp; <?= $cg["vice_chairperson"] ?>">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <p class="text-[11px] uppercase tracking-[0.16em] text-slate-500"><?= $cg["alias"] ?></p>
                                    <h3 class="text-sm font-semibold text-slate-900"><?= $cg["chairperson"] ?> &amp; <?= $cg["vice_chairperson"] ?></h3>
                                </div>
                                <div class="flex flex-col items-end text-right text-[11px] text-slate-500">
                                    <span data-role="percent" class="text-xs font-semibold text-slate-900">0%</span>
                                    <span data-role="votes">0 suara</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <img
                                    src="<?= base_url('uploads/candidates/' . $cg['cp_photo']) ?>"
                                    alt="Foto Ketua Nadia"
                                    class="h-10 w-10 rounded-full object-cover" />
                                <img
                                    src="<?= base_url('uploads/candidates/' . $cg['vcp_photo']) ?>"
                                    alt="Foto Wakil Raka"
                                    class="h-10 w-10 rounded-full object-cover" />
                            </div>
                            <div>
                                <div class="mb-1 flex items-center justify-between text-[11px] text-slate-500">
                                    <span>Perolehan suara</span>
                                </div>
                                <div class="h-2.5 w-full overflow-hidden rounded-full bg-slate-100">
                                    <div
                                        data-role="bar"
                                        class="h-2.5 rounded-full bg-brand transition-all duration-500 ease-out"
                                        style="width:0%;"></div>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <p class="mt-3 text-[11px] text-slate-500">
                    *Untuk produksi, hubungkan komponen quick count ini ke API real-time (misalnya dengan fetch berkala atau WebSocket).
                </p>
            </section>
        <?php else: ?>
            <section id="quick-count" class="mt-10">
                <div class="grid gap-4 md:grid-cols-3">
                    <article class="col-span-3 flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-4 shadow-soft/40">
                        <h3 class="text-sm font-semibold text-slate-900">Belum ada pemilihan untuk saat ini</h3>
                        <p class="text-xs text-slate-600">
                            Nantikan kabar terbaru yang akan datang.
                        </p>
                    </article>
                </div>
            </section>
        <?php endif; ?>

        <!-- INFO SECTION -->
        <section id="info" class="mt-10">
            <div class="mb-5 flex flex-wrap items-end justify-between gap-3">
                <div>
                    <h2 class="text-lg font-semibold text-slate-900">
                        Bagaimana proses pemilihan bekerja?
                    </h2>
                    <p class="text-xs text-slate-500">
                        Singkat, terverifikasi, dan dirancang agar mudah diakses semua siswa.
                    </p>
                </div>
            </div>

            <div class="grid gap-4 md:grid-cols-3">
                <article class="rounded-2xl border border-slate-200 bg-white p-4 shadow-soft/40">
                    <h3 class="mb-2 text-sm font-semibold text-slate-900">Siapa yang dapat memilih?</h3>
                    <p class="text-xs text-slate-600">
                        Seluruh siswa aktif yang terdaftar di sekolah dan sudah menerima akun
                        (NIS / email sekolah) dari panitia.
                    </p>
                </article>

                <article class="rounded-2xl border border-slate-200 bg-white p-4 shadow-soft/40">
                    <h3 class="mb-2 text-sm font-semibold text-slate-900">Langkah singkat pemilihan</h3>
                    <ol class="space-y-1.5 text-xs text-slate-600">
                        <li>1. Login dengan akun sekolah di halaman peserta.</li>
                        <li>2. Baca visi & misi tiap paslon, lalu pilih 1 paslon.</li>
                        <li>3. Konfirmasi dan kirim suara. Sistem otomatis mengunci suara.</li>
                    </ol>
                </article>

                <article class="rounded-2xl border border-slate-200 bg-white p-4 shadow-soft/40">
                    <h3 class="mb-2 text-sm font-semibold text-slate-900">Keamanan & transparansi</h3>
                    <p class="text-xs text-slate-600">
                        1 akun hanya dapat memberikan 1 suara. Panitia hanya dapat melihat
                        rekap jumlah suara, bukan pilihan tiap individu.
                    </p>
                </article>
            </div>
        </section>
    </main>

    <footer class="border-t border-slate-200 bg-white/80">
        <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-2 px-4 py-3 text-[11px] text-slate-500">
            <span>© 2025 OSIS — Sistem pemilihan siswa.</span>
            <span>Halaman ini bersifat publik (non-voting).</span>
        </div>
    </footer>

    <script>
        // ===== TIMER SAMPAI PENUTUPAN TPS =====
        const POLL_END = new Date("2025-12-01T15:00:00+07:00");

        function updateTimer() {
            const el = document.getElementById("timer");
            const statusEl = document.getElementById("pollStatus");
            if (!el) return;

            const now = new Date();
            const diff = POLL_END - now;
            if (diff <= 0) {
                el.textContent = "TPS online telah ditutup";
                if (statusEl) statusEl.textContent = "Selesai";
                return;
            }
            const h = Math.floor(diff / 3600000);
            const m = Math.floor((diff % 3600000) / 60000);
            const s = Math.floor((diff % 60000) / 1000);
            el.textContent = `${h}j ${m}m ${s}d lagi`;
        }
        updateTimer();
        setInterval(updateTimer, 1000);

        // ===== QUICK COUNT LIVE (PAKAI API) =====

        // Kartu kandidat (pastikan di HTML pakai data-candidate-id, data-role="votes", dll)
        const cards = Array.from(document.querySelectorAll("[data-candidate-id]"));

        // Map id kandidat -> jumlah suara
        const counts = {};
        cards.forEach(c => {
            const id = c.dataset.candidateId;
            if (id) counts[id] = 0;
        });

        const totalVotesEl = document.getElementById("totalVotes");
        const lastUpdateEl = document.getElementById("lastUpdate");
        const heroTotalEl = document.getElementById("heroTotal");
        const heroPercentEl = document.getElementById("heroPercent");

        // snapshot kecil (tiga slot) – isinya nanti diisi top 3 paslon
        const snapA1 = document.getElementById("snapA1");
        const snapB2 = document.getElementById("snapB2");
        const snapC3 = document.getElementById("snapC3");

        const TARGET_VOTERS = 20; // buat hitung persen partisipasi (sesuaikan)
        // const LIVE_VOTES_URL = "<?= site_url('election/ajax/live-votes'); ?>";
        // atau kalau mau hardcode:
        const LIVE_VOTES_URL = 'http://localhost:8080/election/ajax/live-votes';

        function animateCandidate(id) {
            const card = document.querySelector(`[data-candidate-id="${id}"]`);
            if (!card) return;
            const bar = card.querySelector('[data-role="bar"]');

            // restart animasi card
            card.classList.remove("animate-vote-pop");
            void card.offsetWidth; // force reflow
            card.classList.add("animate-vote-pop");

            if (bar) {
                bar.classList.remove("animate-bar-glow");
                void bar.offsetWidth;
                bar.classList.add("animate-bar-glow");
            }
        }

        function renderLive(totalOverride) {
            // totalOverride: dari backend (data.total), kalau ada
            const computedTotal = Object.values(counts).reduce((a, b) => a + b, 0);
            const total = (typeof totalOverride === "number" && !Number.isNaN(totalOverride)) ?
                totalOverride :
                computedTotal;

            const now = new Date();

            // Update tiap kartu kandidat
            cards.forEach(card => {
                const id = card.dataset.candidateId;
                const n = counts[id] || 0;
                const pct = total ? Math.round((n / total) * 100) : 0;

                const votesEl = card.querySelector('[data-role="votes"]');
                const pctEl = card.querySelector('[data-role="percent"]');
                const barEl = card.querySelector('[data-role="bar"]');

                if (votesEl) votesEl.textContent = `${n.toLocaleString("id-ID")} suara`;
                if (pctEl) pctEl.textContent = `${pct}%`;
                if (barEl) barEl.style.width = `${pct}%`;
            });

            // Total suara dan partisipasi
            if (totalVotesEl)
                totalVotesEl.textContent = `Total suara terekam: ${total.toLocaleString("id-ID")}`;
            if (heroTotalEl)
                heroTotalEl.textContent = total.toLocaleString("id-ID");

            const partPercent = TARGET_VOTERS ?
                Math.round((total / TARGET_VOTERS) * 100) :
                0;
            if (heroPercentEl)
                heroPercentEl.textContent = `${partPercent}%`;

            // Info waktu update terakhir
            if (lastUpdateEl) {
                lastUpdateEl.textContent =
                    "Pembaruan terakhir: " +
                    now.toLocaleTimeString("id-ID", {
                        hour: "2-digit",
                        minute: "2-digit",
                        second: "2-digit"
                    });
            }

            // Snapshot kecil: pakai top 3 paslon
            const snapSlots = [snapA1, snapB2, snapC3];
            const totalForSnap = total || 1;
            if (snapSlots.some(el => el)) {
                const entries = Object.entries(counts); // [ [id, count], ... ]
                entries.sort((a, b) => b[1] - a[1]); // urut dari suara terbanyak

                entries.slice(0, snapSlots.length).forEach(([id, value], idx) => {
                    const slotEl = snapSlots[idx];
                    if (!slotEl) return;
                    const pct = Math.round((value / totalForSnap) * 100);
                    slotEl.textContent = `${pct}%`;
                });
            }
        }

        async function pollLive() {
            try {
                if (!cards.length) return;

                const res = await fetch(LIVE_VOTES_URL, {
                    method: "GET",
                    headers: {
                        "Accept": "application/json"
                    },
                    cache: "no-cache"
                });

                if (!res.ok) {
                    throw new Error("HTTP error " + res.status);
                }

                const json = await res.json();
                // Format:
                // {
                //   "success": true,
                //   "data": {
                //     "votes": [
                //       { "id": "1", "alias": "Kebangkitan Siswa", "total_suara": "2" },
                //       { "id": "2", "alias": "Akum Team", "total_suara": "1" }
                //     ],
                //     "total": 3
                //   }
                // }

                if (!json || !json.success || !json.data) {
                    console.warn("[quick-count] response tidak sesuai format");
                    return;
                }

                const votes = Array.isArray(json.data.votes) ? json.data.votes : [];
                const totalFromBackend =
                    json.data.total != null ? Number(json.data.total) : undefined;

                // Siapkan map baru dari hasil backend
                const newCounts = {};
                cards.forEach(card => {
                    const id = card.dataset.candidateId;
                    if (id) newCounts[id] = 0;
                });

                votes.forEach(item => {
                    const id = String(item.id);
                    const count = Number(item.total_suara) || 0;
                    newCounts[id] = count;
                });

                // Animasi hanya kandidat yang naik suaranya
                Object.keys(newCounts).forEach(id => {
                    const oldVal = counts[id] || 0;
                    const newVal = newCounts[id];
                    if (newVal > oldVal) {
                        animateCandidate(id);
                    }
                });

                // Copy newCounts ke counts (mutasi in-place)
                Object.keys(newCounts).forEach(id => {
                    counts[id] = newCounts[id];
                });

                // Render ulang UI
                renderLive(totalFromBackend);
            } catch (e) {
                console.error("Gagal mengambil quick count:", e);
            }
        }

        // Render awal (semua 0), lalu mulai polling setiap 5 detik
        renderLive(0);
        pollLive();
        setInterval(pollLive, 5000);
    </script>

</body>

</html>