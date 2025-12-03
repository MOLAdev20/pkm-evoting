<?php $this->extend('main_layout') ?>

<?php $this->section('header') ?>
<title>Daftar Pemilihan | Admin OSIS</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php $this->endSection() ?>

<?php $this->section('content') ?>
<main class="flex-1 overflow-y-auto">
    <?php
    // Hitung statistik sederhana
    $totalElections = isset($elections) && is_array($elections) ? count($elections) : 0;
    $openCount   = 0;
    $closedCount = 0;
    $draftCount  = 0;

    if (!empty($elections) && is_array($elections)) {
        foreach ($elections as $el) {
            $st = $el['status'] ?? 'draft';
            if ($st === 'open') {
                $openCount++;
            } elseif ($st === 'closed') {
                $closedCount++;
            } else {
                $draftCount++;
            }
        }
    }
    ?>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
        <!-- Page header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Manajemen Pemilihan <?= uri_string() ?></h1>
                <p class="mt-1 text-sm text-gray-500">
                    Kelola periode pemilihan OSIS. Setiap pemilihan memiliki kandidat dan hasil suaranya sendiri.
                </p>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <button
                    type="button"
                    data-modal-target="#addElectionModal"
                    class="inline-flex items-center px-4 py-2 rounded-xl bg-indigo-600 text-white text-sm font-medium shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    ➕ Tambah Pemilihan
                </button>
            </div>
        </div>

        <!-- List elections (versi card, bukan tabel) -->
        <section class="bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="px-4 sm:px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-sm font-semibold text-gray-900">🕒 Sedang Berlangsung</h2>
            </div>

            <?php if (empty($onGoing)): ?>
                <div class="px-4 sm:px-5 py-10 text-center">
                    <p class="text-sm text-gray-500">
                        Belum ada pemilihan yang sedang berlangsung.
                        Klik <span class="font-semibold">"Buka Pemilihan”</span> untuk membuka pemilihan.
                    </p>
                </div>
            <?php else: ?>
                <div class="px-4 sm:px-5 py-3">
                    <div class="space-y-2.5">
                        <?php
                        $status      = $onGoing['status'] ?? 'draft';
                        $statusLabel = $status;
                        $badgeClass  = 'bg-gray-100 text-gray-700 ring-gray-200';
                        $dotClass    = 'bg-gray-400';

                        if ($status === 'open') {
                            $statusLabel = 'Berlangsung';
                            $badgeClass  = 'bg-emerald-50 text-emerald-700 ring-emerald-200';
                            $dotClass    = 'bg-emerald-500';
                        } elseif ($status === 'closed') {
                            $statusLabel = 'Selesai';
                            $badgeClass  = 'bg-gray-100 text-gray-700 ring-gray-200';
                            $dotClass    = 'bg-gray-500';
                        } elseif ($status === 'draft') {
                            $statusLabel = 'Draft';
                            $badgeClass  = 'bg-amber-50 text-amber-700 ring-amber-200';
                            $dotClass    = 'bg-amber-400';
                        }

                        $startAt = isset($onGoing['start_at']) ? date('d M Y H:i', strtotime($onGoing['start_at'])) : '-';
                        $endAt   = isset($onGoing['end_at'])   ? date('d M Y H:i', strtotime($onGoing['end_at']))   : '-';
                        ?>
                        <article
                            class="flex flex-col gap-2 rounded-2xl bg-gray-50/80 px-4 py-3
                               ring-2 ring-green-500 hover:bg-white hover:border-indigo-100 hover:shadow-sm
                               transition sm:flex-row sm:items-center sm:justify-between">
                            <!-- Kiri: nama election + status -->
                            <div class="gap-4">
                                <div class="min-w-0">
                                    <div class="flex items-center gap-2">
                                        <a
                                            href="<?= site_url('admin/election/detail/' . $onGoing['id']) ?>"
                                            class="font-semibold text-orange-500 hover:text-indigo-600 truncate">
                                            🏁 <?= esc($onGoing['title'] ?? 'Tanpa nama') ?>
                                        </a>
                                    </div>
                                </div>

                                <div class="flex flex-wrap gap-4 text-[12px] text-gray-600 mt-2">
                                    <div>
                                        <div class="flex gap-1 items-center ">
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Mulai: <?= esc($startAt) ?>
                                        </div>
                                        <div class="flex gap-1 items-center ">
                                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Selesai: <?= esc($endAt) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kanan: aksi -->
                            <div class="flex items-center justify-end gap-1.5 sm:ml-4">
                                <a
                                    href="<?= site_url('admin/election/detail/' . $onGoing['id'] . '') ?>"
                                    class="inline-flex items-center rounded-full border border-gray-200 bg-white px-3 py-1.5 text-[11px] text-gray-700 hover:bg-gray-50">
                                    Detail
                                </a>

                                <?php if ($status === 'open'): ?>
                                    <!-- Tombol tutup pemilihan -->
                                    <a
                                        href="javascript:void(0)"
                                        onclick="changeStatus('<?= $onGoing['id'] ?>', 'closed')">
                                        <button
                                            type="button"
                                            class="inline-flex items-center rounded-full border border-red-100 bg-red-50 px-3 py-1.5 text-[11px] text-red-600 hover:bg-red-100">
                                            Tutup pemilihan
                                        </button>
                                    </a>
                                <?php elseif (in_array($status, ['draft', 'closed'], true)): ?>
                                    <!-- Tombol buka pemilihan -->
                                    <a
                                        href="javascript:void(0)"
                                        onclick="changeStatus('<?= $onGoing['id'] ?>', 'open')">
                                        <button
                                            type="submit"
                                            class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-[11px] text-emerald-700 hover:bg-emerald-100">
                                            Buka pemilihan
                                        </button>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </article>
                    </div>
                </div>
            <?php endif ?>
        </section>

        <section class="bg-white rounded-2xl shadow-sm border border-gray-100">
            <div class="px-4 sm:px-5 py-4 border-b border-gray-100 flex items-center justify-between">
                <div>
                    <h2 class="text-sm font-semibold text-gray-900">Semua Data Pemilihan</h2>
                    <?php if (!empty($elections)): ?>
                        <p class="text-xs mt-1">Tidak dapat merubah status, karena ada pemilihan sedang berlangsung.</p>
                    <?php endif ?>
                </div>
                <p class="text-[11px] text-gray-500">
                    <?= esc($totalElections) ?> pemilihan terdaftar
                </p>
            </div>

            <?php if (empty($elections)): ?>
                <div class="px-4 sm:px-5 py-10 text-center">
                    <p class="text-sm text-gray-500">
                        Belum ada pemilihan yang dibuat.
                        Klik <span class="font-semibold">“Tambah Pemilihan”</span> untuk membuat pemilihan OSIS baru.
                    </p>
                </div>
            <?php else: ?>
                <div class="px-4 sm:px-5 py-3">
                    <div class="space-y-2.5">
                        <?php foreach ($elections as $election): ?>
                            <?php
                            $status      = $election['status'] ?? 'draft';
                            $statusLabel = $status;
                            $badgeClass  = 'bg-gray-100 text-gray-700 ring-gray-200';
                            $dotClass    = 'bg-gray-400';

                            if ($status === 'open') {
                                $statusLabel = 'Berlangsung';
                                $badgeClass  = 'bg-emerald-50 text-emerald-700 ring-emerald-200';
                                $dotClass    = 'bg-emerald-500';
                            } elseif ($status === 'closed') {
                                $statusLabel = 'Selesai';
                                $badgeClass  = 'bg-gray-100 text-gray-700 ring-gray-200';
                                $dotClass    = 'bg-gray-500';
                            } elseif ($status === 'draft') {
                                $statusLabel = 'Draft';
                                $badgeClass  = 'bg-amber-50 text-amber-700 ring-amber-200';
                                $dotClass    = 'bg-amber-400';
                            }

                            $startAt = isset($election['start_at']) ? date('d M Y H:i', strtotime($election['start_at'])) : '-';
                            $endAt   = isset($election['end_at'])   ? date('d M Y H:i', strtotime($election['end_at']))   : '-';
                            ?>
                            <article
                                class="flex flex-col gap-2 rounded-2xl bg-gray-50/80 px-4 py-3
                               border border-gray-100 hover:bg-white hover:border-indigo-100 hover:shadow-sm
                               transition sm:flex-row sm:items-center sm:justify-between">
                                <!-- Kiri: nama election + status -->
                                <div class="gap-4">
                                    <div class="min-w-0">
                                        <div class="flex items-center gap-2">
                                            <a
                                                href="<?= site_url('admin/election/detail/' . $election['id']) ?>"
                                                class="font-semibold text-gray-900 hover:text-indigo-600 truncate">
                                                <?= esc($election['title'] ?? 'Tanpa nama') ?>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="flex flex-wrap gap-4 text-[12px] text-gray-600 mt-2">
                                        <div>
                                            <div class="flex gap-1 items-center ">
                                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Mulai: <?= esc($startAt) ?>
                                            </div>
                                            <div class="flex gap-1 items-center ">
                                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                Selesai: <?= esc($endAt) ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Kanan: aksi -->
                                <div class="flex items-center justify-end gap-1.5 sm:ml-4">
                                    <a
                                        href="<?= site_url('admin/election/detail/' . $election['id'] . '') ?>"
                                        class="inline-flex items-center rounded-full border border-gray-200 bg-white px-3 py-1.5 text-[11px] text-gray-700 hover:bg-gray-50">
                                        Detail
                                    </a>

                                    <?php if (!empty($onGoing)): ?>
                                        <!-- Tombol disabled -->
                                        <a href="javascript:void(0)" class="pointer-events-none opacity-50">
                                            <button type="button" class="inline-flex items-center rounded-full border border-slate-300 bg-slate-100 px-3 py-1.5 text-[11px] text-gray-600">
                                                🚫 Buka pemilihan
                                            </button>
                                        </a>
                                    <?php elseif ($status === 'open'): ?>
                                        <!-- Tombol tutup pemilihan -->
                                        <a
                                            href="javascript:void(0)"
                                            onclick="changeStatus('<?= $election['id'] ?>', 'closed')">
                                            <button
                                                type="button"
                                                class="inline-flex items-center rounded-full border border-red-100 bg-red-50 px-3 py-1.5 text-[11px] text-red-600 hover:bg-red-100">
                                                Tutup pemilihan
                                            </button>
                                        </a>
                                    <?php elseif (in_array($status, ['draft', 'closed'], true)): ?>
                                        <!-- Tombol buka pemilihan -->
                                        <a
                                            href="javascript:void(0)"
                                            onclick="changeStatus('<?= $election['id'] ?>', 'open')">
                                            <button
                                                type="submit"
                                                class="inline-flex items-center rounded-full border border-emerald-200 bg-emerald-50 px-3 py-1.5 text-[11px] text-emerald-700 hover:bg-emerald-100">
                                                Buka pemilihan
                                            </button>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </article>
                        <?php endforeach ?>
                    </div>
                </div>
            <?php endif ?>
        </section>


        <p class="text-[11px] text-gray-500">
            Tip: setiap tahun cukup buat pemilihan baru. Data lama akan tetap tersimpan sebagai arsip.
        </p>
    </div>
</main>
<?php $this->endSection() ?>

<?php $this->section('modal') ?>
<!-- Modal: Tambah Pemilihan Baru (menggunakan mekanisme modal existing: #modal, #modalPanel, #openModal, dll) -->
<div data-modal id="addElectionModal" class="fixed inset-0 z-40 flex items-center justify-center px-4 py-6 bg-black bg-opacity-40 opacity-0 pointer-events-none transition-opacity duration-200">
    <div data-modal-panel class="bg-white max-w-3xl w-full rounded-2xl shadow-xl transform scale-95 transition-transform duration-200">
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-base font-semibold text-gray-900">Buat Pemilihan Baru</h3>
            <button
                data-modal-dismiss
                type="button"
                class="p-1.5 rounded-full hover:bg-gray-100 text-gray-500">
                ✖
            </button>
        </div>
        <?= form_open('admin/election/store', ["class" => "px-5 py-4 space-y-3 text-sm"]) ?>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1" for="election-title">
                Nama Pemilihan
            </label>
            <input
                id="election-title"
                name="election-title"
                type="text"
                required
                placeholder="Pemilihan OSIS 2025/2026"
                class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-3 py-2 text-sm text-gray-900 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1" for="start_at">
                    Tanggal Mulai
                </label>
                <input
                    id="start_at"
                    name="start-at"
                    type="datetime-local"
                    required
                    class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1" for="end_at">
                    Tanggal Selesai
                </label>
                <input
                    id="end_at"
                    name="end-at"
                    type="datetime-local"
                    required
                    class="block w-full rounded-xl border border-gray-200 bg-gray-50 px-3 py-2 text-sm text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />
            </div>
        </div>

        <div class="pt-3 mt-3 border-t border-gray-100 flex items-center justify-end space-x-2">
            <button
                type="button"
                data-modal-dismiss
                class="px-3 py-2 rounded-lg text-sm font-medium border border-gray-300 text-gray-700 hover:bg-gray-50">
                Batal
            </button>
            <button
                type="submit"
                class="px-4 py-2 rounded-lg text-sm font-medium bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                Simpan
            </button>
        </div>
        <?= form_close() ?>
    </div>
</div>
<?php $this->endSection() ?>

<?php $this->section('script') ?>
<?= session()->getFlashdata('msg') ?>
<script>
    const base_url = "<?= base_url() ?>";

    $(function() {
        // Modal logic – sama pola dengan template yang lu kirim
        function openModal() {
            $('#modal')
                .removeClass('opacity-0 pointer-events-none')
                .addClass('opacity-100');
            $('#modalPanel')
                .removeClass('scale-95')
                .addClass('scale-100');
        }

        function closeModal() {
            $('#modal')
                .addClass('opacity-0 pointer-events-none')
                .removeClass('opacity-100');
            $('#modalPanel')
                .removeClass('scale-100')
                .addClass('scale-95');
        }

        $('#openModal').on('click', function(e) {
            e.preventDefault();
            openModal();
        });

        $('#modalClose, #modalCancel').on('click', function() {
            closeModal();
        });

        // Close when clicking backdrop
        $('#modal').on('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Esc to close
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
    });

    function changeStatus(election_id, status) {

        let title = "Buka Pemilihan?";
        let text = "Pemilihan ini akan dibuka. Siswa dapat memilih";

        if (status == 'closed') {
            title = "Tutup Pemilihan?";
            text = "Pemilihan ini akan ditutup. Siswa tidak dapat memilih";
        }

        Swal.fire({
            title,
            text,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjutkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                location.replace(`${base_url}/admin/election/switch/${election_id}?switch=${status}`)
            }
        })
    }
</script>
<?php $this->endSection() ?>