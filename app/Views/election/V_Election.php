<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Pemilihan OSIS — Pilih Paslon</title>
    <meta name="description" content="Halaman pemilihan OSIS untuk siswa. Desain minimal & modern. Fleksibel untuk banyak paslon, dengan penanda pilihan, foto ketua & wakil, dan hitung suara sementara." />
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
                <div id="timer" class="rounded-full bg-slate-100 px-3 py-1">Memuat…</div>
                <a href="#panduan" class="rounded-full border px-3 py-1 hover:bg-slate-50">Panduan</a>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4">
        <!-- Intro -->
        <section class="mt-6">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-card">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-xl sm:text-2xl font-semibold">Suaramu menentukan.</h2>
                        <p class="text-slate-600">Pilih <b>1 paslon</b> Ketua & Wakil OSIS. Kamu akan diminta konfirmasi sebelum pengiriman.</p>
                    </div>
                    <div class="text-center">
                        <span class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-3 py-2 text-blue-700 ring-1 ring-blue-200">
                            <span class="h-2.5 w-2.5 rounded-full bg-blue-500 animate-pulse"></span> TPS Online
                        </span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Candidates -->
        <section class="mt-6">
            <div class="flex items-end justify-between">
                <h3 class="text-lg font-semibold">Daftar Paslon</h3>
                <button id="compareBtn" type="button" class="text-sm underline underline-offset-4">Bandingkan visi & misi</button>
            </div>
            <div id="grid" class="mt-4 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">

                <!-- Paslon 3 -->
                <?php foreach ($candidateGroup as $cg) : ?>
                    <label
                        id="<?= $cg['id'] ?>"
                        class="focus-ring cursor-pointer relative isolate block overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-card transition active:scale-95 hover:bg-slate-50 hover:ring-1 hover:ring-slate-200 hover:shadow-md"
                        data-candidate-id="<?= $cg['id'] ?>"
                        data-no="<?= $cg['alias'] ?>"
                        data-nama="<?= $cg['chairperson'] ?> & <?= $cg['vice_chairperson'] ?>"
                        data-foto-ketua="<?= $cg['cp_photo'] ?>"
                        data-foto-wakil="<?= $cg['vcp_photo'] ?>"
                        data-visi="<?= $cg['vision'] ?>"
                        data-misi="Aplikasi aspirasi|Laporan terbuka|Literasi digital">
                        <input type="radio" name="paslon" value="<?= $cg['id'] ?>" class="hide-radio">
                        <div class="p-4">
                            <div class="flex items-center justify-between">
                                <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-700"><?= $cg['alias'] ?></span>
                                <div class="flex items-center gap-2">
                                    <span class="votes inline-flex items-center gap-1 rounded-full bg-emerald-50 px-2 py-1 text-xs text-emerald-700 ring-1 ring-emerald-200">0 suara</span>
                                    <button type="button" class="detail inline-flex items-center gap-1 rounded-full px-2 py-1 text-xs text-blue-700 hover:bg-blue-50">Detail</button>
                                </div>
                            </div>
                            <!-- Duo photo -->
                            <div class="mt-3 grid grid-cols-2 gap-2">
                                <img src="<?= base_url('uploads/candidates/' . $cg['cp_photo']) ?>" class="h-40 w-full rounded-xl object-cover" />
                                <img src="<?= base_url('uploads/candidates/' . $cg['vcp_photo']) ?>" class="h-40 w-full rounded-xl object-cover" />
                            </div>
                            <div class="mt-3">
                                <h4 class="text-lg font-semibold"><?= $cg['chairperson'] ?> &amp; <?= $cg['vice_chairperson'] ?></h4>
                                <p class="text-sm text-slate-600"><?= $cg['vision'] ?></p>
                            </div>
                        </div>
                        <!-- selected marker -->
                        <div class="pointer-events-none absolute inset-0 rounded-2xl ring-2 ring-transparent transition-all"></div>
                        <div class="pointer-events-none absolute right-3 top-3 hidden rounded-full bg-brand p-1 text-white" aria-hidden="true">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                <path d="M20 6 9 17l-5-5" />
                            </svg>
                        </div>
                    </label>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Live Votes -->
        <section class="mt-6">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-card">
                <div class="mb-3 flex items-center justify-between">
                    <h3 class="text-lg font-semibold">Perolehan Sementara</h3>
                    <span id="totalVotes" class="text-sm text-slate-500">Total: 0 suara</span>
                </div>
                <div id="liveList" class="grid gap-3"></div>
                <p class="mt-3 text-xs text-slate-500">*Data ini bersifat sementara (live). Hubungkan ke API real-time untuk akurasi.</p>
            </div>
        </section>

        <!-- Actions -->
        <section class="my-8">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-card">
                <form id="voteForm" class="grid gap-4">
                    <label class="flex items-start gap-3 text-sm">
                        <input id="consent" type="checkbox" class="mt-1 h-4 w-4 rounded border-slate-300 text-brand focus:ring-brand" />
                        <span>Saya menyatakan pilihan ini dibuat secara sadar dan tidak akan mengubah setelah dikirim.</span>
                    </label>
                    <div class="flex flex-wrap items-center gap-3">
                        <button id="submitBtn" type="submit" disabled class="inline-flex items-center gap-2 rounded-xl bg-slate-300 px-4 py-2 font-medium text-white transition disabled:cursor-not-allowed disabled:opacity-70 data-[ready=true]:bg-brand data-[ready=true]:hover:bg-blue-700">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 2L11 13" />
                                <path d="M22 2l-7 20-4-9-9-4 20-7z" />
                            </svg>
                            <span>Kirim Suara</span>
                        </button>
                        <p id="hint" class="text-sm text-slate-600">Belum ada pilihan.</p>
                    </div>
                </form>
            </div>
        </section>

        <footer class="mb-10 pb-10 text-center text-sm text-slate-500">© 2025 OSIS — Halaman pemungutan suara siswa (bukan admin)</footer>
    </main>

    <!-- Modal detail paslon -->
    <dialog id="modal" class="w-full max-w-2xl rounded-2xl p-0">
        <form method="dialog" class="rounded-t-2xl bg-slate-900 px-5 py-3 text-white">
            <div class="flex items-center justify-between">
                <h4 id="modalTitle" class="font-semibold">Paslon</h4>
                <button class="rounded-lg bg-white/15 px-2 py-1 text-sm hover:bg-white/25">Tutup</button>
            </div>
        </form>
        <div class="space-y-3 p-5">
            <div class="grid grid-cols-2 gap-2">
                <img id="fotoKetua" alt="Foto Ketua" class="h-40 w-full rounded-xl object-cover" />
                <img id="fotoWakil" alt="Foto Wakil" class="h-40 w-full rounded-xl object-cover" />
            </div>
            <div class="grid gap-3 sm:grid-cols-2">
                <div>
                    <h5 class="mb-1 font-semibold">Visi</h5>
                    <ul id="visiList" class="list-disc pl-5 text-sm text-slate-700 space-y-1"></ul>
                </div>
                <div>
                    <h5 class="mb-1 font-semibold">Misi</h5>
                    <ul id="misiList" class="list-disc pl-5 text-sm text-slate-700 space-y-1"></ul>
                </div>
            </div>
        </div>
    </dialog>

    <!-- Modal bandingkan -->
    <dialog id="compare" class="w-full max-w-4xl rounded-2xl p-0">
        <form method="dialog" class="rounded-t-2xl bg-slate-900 px-5 py-3 text-white">
            <div class="flex items-center justify-between">
                <h4 class="font-semibold">Bandingkan Visi & Misi</h4>
                <button class="rounded-lg bg-white/15 px-2 py-1 text-sm hover:bg-white/25">Tutup</button>
            </div>
        </form>
        <div id="compareGrid" class="grid gap-4 p-5 sm:grid-cols-2 lg:grid-cols-3"></div>
    </dialog>

    <script>
        // ====== KONFIG / DATA DARI DOM ======
        const POLL_END = new Date('2025-12-01T15:00:00+07:00');

        const hint = document.getElementById('hint');
        const consent = document.getElementById('consent');
        const submitBtn = document.getElementById('submitBtn');
        const cards = Array.from(document.querySelectorAll('[data-candidate-id]'));

        let selectedId = null;

        // liveVotes diinisialisasi dari data di DOM (bukan array config)
        const liveVotes = {};
        cards.forEach(card => {
            const id = card.dataset.candidateId;
            if (id) liveVotes[id] = 0;
        });

        // ====== SELECTION & CARD EVENTS ======
        function updateSelectionStyles() {
            cards.forEach(card => {
                const overlay = card.querySelector('.absolute.inset-0');
                const check = card.querySelector('.absolute.right-3.top-3');
                if (!overlay || !check) return;

                if (card.dataset.candidateId === selectedId) {
                    overlay.classList.add('ring-brand');
                    overlay.classList.remove('ring-transparent');
                    check.classList.remove('hidden');
                    card.classList.add('border-brand/40');
                } else {
                    overlay.classList.remove('ring-brand');
                    overlay.classList.add('ring-transparent');
                    check.classList.add('hidden');
                    card.classList.remove('border-brand/40');
                }
            });
        }

        cards.forEach(card => {
            card.addEventListener('click', (e) => {
                if (e.target.closest('.detail')) return; // detail di-handle terpisah
                selectedId = card.dataset.candidateId;
                updateSelectionStyles();
                updateSubmit();
            });

            const detailBtn = card.querySelector('.detail');
            if (detailBtn) {
                detailBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    openDetail(card);
                });
            }
        });

        // ====== MODAL DETAIL & BANDINGKAN ======
        const modal = document.getElementById('modal');
        const modalTitle = document.getElementById('modalTitle');
        const fotoKetua = document.getElementById('fotoKetua');
        const fotoWakil = document.getElementById('fotoWakil');
        const visiList = document.getElementById('visiList');
        const misiList = document.getElementById('misiList');

        function getVisiItems(card) {
            return (card.dataset.visi || '').split('|').map(s => s.trim()).filter(Boolean);
        }

        function getMisiItems(card) {
            return (card.dataset.misi || '').split('|').map(s => s.trim()).filter(Boolean);
        }

        function openDetail(card) {
            modalTitle.textContent = `No. ${card.dataset.no} — ${card.dataset.nama}`;

            const fotoKetuaUrl = card.dataset.fotoKetua || card.querySelector('img:nth-of-type(1)')?.src || '';
            const fotoWakilUrl = card.dataset.fotoWakil || card.querySelector('img:nth-of-type(2)')?.src || '';

            fotoKetua.src = `<?= base_url('') ?>/uploads/candidates/${fotoKetuaUrl}`
            fotoWakil.src = `<?= base_url('') ?>/uploads/candidates/${fotoWakilUrl}`;

            const visiItems = getVisiItems(card);
            const misiItems = getMisiItems(card);

            visiList.innerHTML = visiItems.map(x => `<li>${x}</li>`).join('');
            misiList.innerHTML = misiItems.map(x => `<li>${x}</li>`).join('');

            modal.showModal();
        }

        const compareBtn = document.getElementById('compareBtn');
        const compareDialog = document.getElementById('compare');
        const compareGrid = document.getElementById('compareGrid');

        compareBtn.addEventListener('click', () => {
            compareGrid.innerHTML = cards.map(card => {
                const id = card.dataset.candidateId;
                const no = card.dataset.no;
                const nama = card.dataset.nama;
                const fotoKetuaUrl = card.dataset.fotoKetua || card.querySelector('img:nth-of-type(1)')?.src || '';
                const fotoWakilUrl = card.dataset.fotoWakil || card.querySelector('img:nth-of-type(2)')?.src || '';
                const visiItems = getVisiItems(card);
                const misiItems = getMisiItems(card);

                return `
                    <div class='rounded-xl border border-slate-200 bg-white p-4'>
                      <div class='mb-2 grid grid-cols-2 gap-2'>
                        <img src='<?= base_url('') ?>/uploads/candidates/${fotoKetuaUrl}' class='h-24 w-full rounded-lg object-cover'/>
                        <img src='<?= base_url('') ?>/uploads/candidates/${fotoWakilUrl}' class='h-24 w-full rounded-lg object-cover'/>
                      </div>
                      <div class='flex items-center justify-between'>
                        <h5 class='font-semibold'>Paslon ${no}</h5>
                        <button type='button' data-id='${id}' class='text-blue-700 underline'>Pilih</button>
                      </div>
                      <p class='text-sm text-slate-600 mb-2'>${nama}</p>
                      <div class='grid gap-2 text-sm'>
                        <div><b>Visi:</b> <ul class='list-disc pl-5'>${visiItems.map(v=>`<li>${v}</li>`).join('')}</ul></div>
                        <div><b>Misi:</b> <ul class='list-disc pl-5'>${misiItems.map(v=>`<li>${v}</li>`).join('')}</ul></div>
                      </div>
                    </div>`;
            }).join('');

            compareGrid.querySelectorAll('button[data-id]').forEach(btn => {
                btn.addEventListener('click', () => {
                    selectedId = btn.dataset.id;
                    updateSelectionStyles();
                    updateSubmit();
                    compareDialog.close();
                });
            });

            compareDialog.showModal();
        });

        // ====== SUBMIT ======
        function getSelectedCard() {
            if (!selectedId) return null;
            return cards.find(card => card.dataset.candidateId === selectedId) || null;
        }

        function updateSubmit() {
            const card = getSelectedCard();
            if (card) {
                hint.textContent = `Terpilih: Paslon ${card.dataset.no} — ${card.dataset.nama}`;
            } else {
                hint.textContent = 'Belum ada pilihan.';
            }

            const ok = !!card && consent.checked;
            submitBtn.toggleAttribute('disabled', !ok);
            submitBtn.dataset.ready = ok;
        }

        consent.addEventListener('change', updateSubmit);

        // Proses submit
        const voteForm = document.getElementById('voteForm');
        voteForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            if (submitBtn.disabled) return;

            const card = getSelectedCard();
            if (!card) return;

            const info = {
                id: card.dataset.candidateId,
                no: card.dataset.no,
                nama: card.dataset.nama
            };

            Swal.fire({
                title: 'Yakin?',
                text: `Anda akan memilih Paslon ${info.no} — ${info.nama}`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then(async (result) => {
                if (!result.isConfirmed) return;

                // Disable button + spinner
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <svg class='h-5 w-5 animate-spin' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2'>
                        <circle cx='12' cy='12' r='10' class='opacity-25'></circle>
                        <path d='M22 12a10 10 0 0 1-10 10' class='opacity-75'></path>
                    </svg>
                    <span>Mengirim…</span>
                `;

                try {

                    // Siapkan data
                    const formData = new FormData();
                    formData.append('candidateId', info.id);
                    formData.append('time', new Date().toISOString());

                    // Kirim ke server
                    const response = await fetch('<?= base_url('election/store') ?>', {
                        method: 'POST',
                        body: formData
                    });

                    const data = await response.json();
                    console.log(data);

                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: data.message,
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: data.message || 'Terjadi kesalahan.',
                        });
                    }

                } catch (err) {
                    console.error(err);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Gagal mengirim data. Periksa koneksi Anda.',
                    });
                } finally {
                    // Balikkan tombol ke semula
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = 'Kirim';
                }
            });




        });

        // ====== LIVE VOTES UI ======
        // Pastikan di atas ini kamu sudah punya:
        // const cards = Array.from(document.querySelectorAll('[data-candidate-id]'));
        // let liveVotes = {}; // { [candidateId]: jumlahSuara }

        // ====== LIVE VOTES UI ======
        document.addEventListener('DOMContentLoaded', () => {
            // Kartu kandidat di halaman (pakai data-candidate-id seperti di card yang tadi)
            const cards = Array.from(document.querySelectorAll('[data-candidate-id]'));
            let liveVotes = {}; // { [candidateId]: jumlahSuara }

            const liveList = document.getElementById('liveList');
            const totalVotesEl = document.getElementById('totalVotes');

            // Lebih aman pakai site_url kalau ini view CodeIgniter
            const LIVE_VOTES_URL = "<?= site_url('election/ajax/live-votes'); ?>";
            // Kalau mau fix string:
            // const LIVE_VOTES_URL = 'http://localhost:8080/election/ajax/live-votes';

            function renderLive(totalOverride) {
                // totalOverride = dari backend (data.total), fallback ke hitung manual
                const total = typeof totalOverride === 'number' && !Number.isNaN(totalOverride) ?
                    totalOverride :
                    Object.values(liveVotes).reduce((a, b) => a + b, 0);

                if (totalVotesEl) {
                    totalVotesEl.textContent = `Total: ${total} suara`;
                }

                if (!liveList) return;
                if (!cards.length) {
                    liveList.innerHTML = '<p class="text-sm text-slate-500">Belum ada kandidat.</p>';
                    return;
                }

                liveList.innerHTML = cards.map(card => {
                    const id = card.dataset.candidateId;
                    const no = card.dataset.no;
                    const nama = card.dataset.nama;
                    const v = liveVotes[id] || 0;
                    const pct = total ? Math.round((v / total) * 100) : 0;

                    // update badge di dalam kartu paslon
                    const badge = card.querySelector('.votes');
                    if (badge) badge.textContent = `${v} suara`;

                    // progress bar di panel live
                    return `
                    <div>
                        <div class="mb-1 flex items-center justify-between text-sm">
                            <span>${no} — ${nama}</span>
                            <span class="tabular-nums font-medium">${v} (${pct}%)</span>
                        </div>
                        <div class="h-2 w-full overflow-hidden rounded bg-slate-100">
                            <div class="h-2 bg-brand" style="width:${pct}%;"></div>
                        </div>
                    </div>`;
                }).join('');
            }

            async function pollLive() {

                try {
                    const response = await fetch(LIVE_VOTES_URL, {
                        method: 'GET',
                        headers: {
                            'Accept': 'application/json'
                        },
                        cache: 'no-cache'
                    });

                    if (!response.ok) {
                        throw new Error('HTTP error ' + response.status);
                    }

                    const json = await response.json();

                    // Format:
                    // {
                    //   "success": true,
                    //   "data": {
                    //     "votes": [
                    //       { "id": "1", "alias": "Kebangkitan Siswa", "total_suara": "2" },
                    //       ...
                    //     ],
                    //     "total": 3
                    //   }
                    // }

                    if (!json || !json.success || !json.data) {
                        console.warn('[live-votes] response tidak sesuai format');
                        return;
                    }

                    const votes = Array.isArray(json.data.votes) ? json.data.votes : [];
                    const totalFromBackend =
                        json.data.total != null ? Number(json.data.total) : undefined;

                    const nextLiveVotes = {};

                    // default 0 untuk semua paslon yang ada di UI
                    cards.forEach(card => {
                        const id = card.dataset.candidateId;
                        if (id) {
                            nextLiveVotes[id] = 0;
                        }
                    });

                    // isi nilai dari backend
                    votes.forEach(item => {
                        const id = String(item.id);
                        const count = Number(item.total_suara) || 0;
                        nextLiveVotes[id] = count;
                    });

                    // update global state
                    liveVotes = nextLiveVotes;

                    // render UI dengan data terbaru
                    renderLive(totalFromBackend);
                } catch (e) {
                    console.error('Gagal mengambil live votes:', e);
                }
            }

            // render awal (semua 0) lalu mulai polling ke server
            renderLive(0);
            pollLive(); // panggil pertama kali
            setInterval(pollLive, 5000); // lalu setiap 5 detik

            // ====== TIMER ======
            function tick() {
                const el = document.getElementById('timer');
                if (!el || typeof POLL_END === 'undefined') return;

                const diff = POLL_END - new Date();
                if (diff <= 0) {
                    el.textContent = 'Tutup';
                    return;
                }
                const h = Math.floor(diff / 3600000);
                const m = Math.floor((diff % 3600000) / 60000);
                const s = Math.floor((diff % 60000) / 1000);
                el.textContent = `${h}j ${m}m ${s}d`;
            }

            tick();
            setInterval(tick, 1000);
        });
    </script>
</body>

</html>