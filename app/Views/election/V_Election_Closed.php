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
                <a href="#panduan" class="rounded-full border px-3 py-1 hover:bg-slate-50">Panduan</a>
            </div>
        </div>
    </header>

    <main class="mx-auto max-w-6xl px-4">
        <section class="min-h-[70vh] flex items-center justify-center py-10">
            <div class="w-full max-w-xl">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-card sm:p-8 text-center">
                    <!-- Icon -->
                    <div class="mx-auto mb-5 grid h-16 w-16 place-items-center rounded-2xl bg-rose-50 text-rose-600">
                        <svg class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <circle cx="12" cy="12" r="10"></circle>
                            <path d="M15 9l-6 6"></path>
                            <path d="M9 9l6 6"></path>
                        </svg>
                    </div>

                    <!-- Text -->
                    <h2 class="text-xl sm:text-2xl font-semibold text-slate-900">
                        Tidak Ada Pemilihan Saat Ini
                    </h2>
                    <p class="mt-2 text-sm text-slate-600">
                        Terima kasih atas partisipasi kamu. <br>
                        Saat ini TPS online sudah tidak menerima suara baru.
                    </p>

                    <!-- Info tambahan -->
                    <div class="mt-6 rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3 text-xs text-slate-600 text-left">
                        <p class="font-semibold text-slate-800 mb-1">
                            Apa langkah selanjutnya?
                        </p>
                        <ul class="list-disc pl-4 space-y-1">
                            <li>Panitia akan melakukan rekap dan verifikasi hasil pemilihan.</li>
                            <li>Hasil resmi akan diumumkan melalui OSIS / wali kelas / kanal resmi sekolah.</li>
                            <li>Jika kamu merasa ada kendala saat memilih, segera hubungi panitia.</li>
                        </ul>
                    </div>

                    <!-- Actions -->
                    <div class="mt-6 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-center">
                        <a href="<?= base_url('public') ?>"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-brand px-4 py-2 text-sm font-medium text-white hover:bg-blue-700">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M5 12h14"></path>
                                <path d="m12 5 7 7-7 7"></path>
                            </svg>
                            <span>Lihat hasil sementara</span>
                        </a>
                        <a href="<?= base_url('participant/login') ?>"
                            class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
                            Kembali ke halaman login
                        </a>
                    </div>
                </div>

                <p class="mt-5 text-center text-[11px] text-slate-500">
                    Halaman ini muncul karena status pemilihan sudah ditutup oleh panitia.
                    Jika menurutmu ini sebuah kesalahan, silakan konfirmasi ke panitia OSIS.
                </p>
            </div>
        </section>

        <footer class="mb-8 text-center text-xs text-slate-400">
            © 2025 OSIS — Sistem pemungutan suara siswa
        </footer>
    </main>

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

            fotoKetua.src = fotoKetuaUrl;
            fotoWakil.src = fotoWakilUrl;

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
                        <img src='${fotoKetuaUrl}' class='h-24 w-full rounded-lg object-cover'/>
                        <img src='${fotoWakilUrl}' class='h-24 w-full rounded-lg object-cover'/>
                      </div>
                      <div class='flex items-center justify-between'>
                        <h5 class='font-semibold'>No. ${no}</h5>
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
                hint.textContent = `Terpilih: No. ${card.dataset.no} — ${card.dataset.nama}`;
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

        function showSuccess(info, payload) {
            document.body.innerHTML = `
                <main class='mx-auto max-w-2xl px-4 py-16 text-center'>
                  <div class='mx-auto mb-6 grid h-16 w-16 place-items-center rounded-2xl bg-green-100 text-green-700'>
                    <svg class='h-8 w-8' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2'>
                        <path d='M20 6 9 17l-5-5'></path>
                    </svg>
                  </div>
                  <h2 class='text-2xl font-semibold'>Suara Terekam</h2>
                  <p class='mt-2 text-slate-600'>Terima kasih! Pilihanmu: <b>No. ${info.no} — ${info.nama}</b>.</p>
                  <div class='mt-6 text-left rounded-2xl border border-slate-200 bg-white p-4 shadow-card'>
                    <h3 class='mb-2 text-sm font-semibold'>Ringkasan</h3>
                    <pre class='overflow-x-auto text-xs leading-relaxed text-slate-700'>${JSON.stringify({ receipt: crypto.randomUUID(), ...payload }, null, 2)}</pre>
                  </div>
                  <a href='#' onclick='window.print()' class='mt-6 inline-flex items-center gap-2 rounded-xl border px-4 py-2 text-sm hover:bg-slate-50'>Cetak / Simpan PDF</a>
                </main>`;
        }

        // ====== LIVE VOTES UI ======
        const liveList = document.getElementById('liveList');
        const totalVotesEl = document.getElementById('totalVotes');

        function renderLive() {
            const total = Object.values(liveVotes).reduce((a, b) => a + b, 0);
            totalVotesEl.textContent = `Total: ${total} suara`;

            liveList.innerHTML = cards.map(card => {
                const id = card.dataset.candidateId;
                const no = card.dataset.no;
                const nama = card.dataset.nama;
                const v = liveVotes[id] || 0;
                const pct = total ? Math.round(v / total * 100) : 0;

                const badge = card.querySelector('.votes');
                if (badge) badge.textContent = `${v} suara`;

                return `
                  <div>
                    <div class='mb-1 flex items-center justify-between text-sm'>
                      <span>No. ${no} — ${nama}</span>
                      <span class='tabular-nums font-medium'>${v} (${pct}%)</span>
                    </div>
                    <div class='h-2 w-full overflow-hidden rounded bg-slate-100'>
                      <div class='h-2 bg-brand' style='width:${pct}%;'></div>
                    </div>
                  </div>`;
            }).join('');
        }

        async function pollLive() {
            try {
                const ids = cards.map(card => card.dataset.candidateId).filter(Boolean);
                if (!ids.length) return;
                const id = ids[Math.floor(Math.random() * ids.length)];
                liveVotes[id] = (liveVotes[id] || 0) + Math.floor(Math.random() * 2); // 0/1
                renderLive();
            } catch (e) {
                // silent
            }
        }

        renderLive();
        setInterval(pollLive, 5000);

        // ====== TIMER ======
        function tick() {
            const el = document.getElementById('timer');
            if (!el) return;
            const diff = POLL_END - new Date();
            if (diff <= 0) {
                el.textContent = 'Tutup';
                submitBtn.disabled = true;
                submitBtn.dataset.ready = false;
                return;
            }
            const h = Math.floor(diff / 3600000);
            const m = Math.floor((diff % 3600000) / 60000);
            const s = Math.floor((diff % 60000) / 1000);
            el.textContent = `${h}j ${m}m ${s}d`;
        }

        tick();
        setInterval(tick, 1000);
    </script>
</body>

</html>