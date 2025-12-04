<?php $this->extend('main_layout') ?>

<?php $this->section('header') ?>
<title>Detail Siswa | Admin OSIS</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php $this->endSection() ?>


<?php $this->section('content') ?>
<main class="flex-1 overflow-y-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">

        <!-- Page header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Detail Siswa / Pemilih</h1>
                <nav class="flex items-center gap-1 text-sm text-gray-500 mt-1">
                    <a href="#" class="hover:text-gray-700">Dashboard</a>
                    <span>/</span>
                    <a href="<?= base_url('admin/participant/') ?>" class="hover:text-gray-700">Siswa</a>
                    <span>/</span>
                    <span class="text-gray-900 font-medium">Detail Informasi Siswa</span>
                </nav>
                <p class="mt-1 text-xs text-gray-400">
                    <?= esc($participant["name"]) ?> • NISN: <?= esc($participant["nisn"]) ?>
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-2">

                <?php if ($participant["status"] == 1): ?>
                    <a href="<?= base_url("admin/participant/change-status/{$participant['id']}?status=0") ?>"
                        class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium border border-gray-300 text-gray-700 hover:bg-gray-50">
                        Nonaktifkan
                    </a>
                <?php else: ?>
                    <a href="<?= base_url("admin/participant/change-status/{$participant['id']}?status=1") ?>"
                        class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium border border-gray-300 text-gray-700 hover:bg-gray-50">
                        Aktifkan
                    </a>
                <?php endif; ?>
                <a href="javascript:void(0)"
                    data-modal-target="#editParticipantModal"
                    class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium border border-indigo-500 text-indigo-600 hover:bg-indigo-50">
                    ✏️ Edit Data Siswa
                </a>
            </div>
        </div>

        <!-- DATA SISWA + AKUN -->
        <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Profil Siswa -->
                <div class="md:col-span-2 space-y-4">
                    <div>
                        <h2 class="text-sm font-semibold text-gray-900">Profil Siswa</h2>
                        <p class="text-xs text-gray-500 mt-1">
                            Data identitas siswa yang digunakan sebagai pemilih.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <p class="text-[11px] uppercase tracking-wide text-gray-400 mb-1">Nama Lengkap</p>
                            <p class="text-sm font-medium text-gray-900">
                                <?= $participant["name"] ?>
                            </p>
                        </div>
                        <div>
                            <p class="text-[11px] uppercase tracking-wide text-gray-400 mb-1">NISN</p>
                            <p class="text-sm font-medium text-gray-900">
                                <?= $participant["nisn"] ?>
                            </p>
                        </div>
                        <div>
                            <p class="text-[11px] uppercase tracking-wide text-gray-400 mb-1">Jenis Kelamin</p>
                            <p class="text-sm font-medium text-gray-900">
                                <?= $participant["gender"] == "l" ? "Laki-laki" : "Perempuan" ?>
                            </p>
                        </div>
                        <div>
                            <p class="text-[11px] uppercase tracking-wide text-gray-400 mb-1">Kelas</p>
                            <p class="text-sm font-medium text-gray-900">
                                <?= $participant["class"] ?>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Akun Login / Kredensial -->
                <div class="space-y-3">
                    <h2 class="text-sm font-semibold text-gray-900">Akun Pemilih</h2>
                    <p class="text-xs text-gray-500">
                        Digunakan untuk login ke sistem pemilihan.
                    </p>

                    <div class="space-y-3 mt-2">
                        <div>
                            <p class="text-[11px] uppercase tracking-wide text-gray-400 mb-1">Username</p>
                            <p class="text-sm font-medium text-gray-900">
                                <?= $participant["username"] ?>
                            </p>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <p class="text-[11px] uppercase tracking-wide text-gray-400">
                                    Password / PIN
                                </p>
                                <button type="button"
                                    id="btnTogglePassword"
                                    class="text-[11px] text-indigo-600 hover:underline">
                                    Tampilkan
                                </button>
                            </div>
                            <div class="relative">
                                <input
                                    id="passwordField"
                                    type="password"
                                    class="w-full rounded-lg border-gray-200 text-sm px-3 py-1.5 bg-gray-50"
                                    readonly />
                            </div>
                            <p class="mt-1 text-[11px] text-gray-400">
                                Catatan: idealnya password disimpan dalam bentuk hash. Tampilkan di sini hanya jika yang disimpan adalah <strong>PIN sekali pakai</strong> atau kode khusus.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- RIWAYAT PEMILIHAN -->
        <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-sm font-semibold text-gray-900">Riwayat Pemilihan</h2>
                    <p class="text-xs text-gray-500 mt-1">
                        Daftar pemilihan yang pernah diikuti beserta paslon yang dipilih.
                    </p>
                </div>
            </div>

            <?php if (!empty($electionHistory)): ?>
                <div class="space-y-3">
                    <?php if (!empty($electionHistory)): ?>
                        <?php foreach ($electionHistory as $row): ?>
                            <?php
                            // Struktur yang dipakai:

                            $electionTitle = $row['title']        ?? 'Pemilihan OSIS';
                            $startAtRaw    = $row['start_at']     ?? null;
                            $endAtRaw      = $row['end_at']     ?? null;
                            $status        = $row['status']       ?? 'done';
                            $alias         = $row['alias']        ?? 'Paslon';
                            // antisipasi typo alias 'chaiperson' + kemungkinan 'chairperson'
                            $cpName        = $row['chairperson']   ?? ($row['chairperson'] ?? null);
                            $vcpName       = $row['vice_chairperson'] ?? null;

                            $startAt = $startAtRaw ? date('d M Y H:i', strtotime($startAtRaw)) : '-';
                            $endAt = $endAtRaw ? date('d M Y H:i', strtotime($endAtRaw)) : '-';

                            // badge status
                            $statusLabel = 'Selesai';
                            $statusClass = 'bg-emerald-50 text-emerald-700';
                            if ($status === 'open') {
                                $statusLabel = 'Sedang Berlangsung';
                                $statusClass = 'bg-blue-50 text-blue-700';
                            } elseif ($status === 'draft') {
                                $statusLabel = 'Belum Dimulai';
                                $statusClass = 'bg-yellow-50 text-yellow-700';
                            }
                            ?>
                            <article
                                class="rounded-2xl border border-gray-100 bg-white px-3 py-2.5 sm:px-4 sm:py-3 shadow-sm hover:shadow-md transition flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">

                                <!-- Kiri: info pemilihan + paslon -->
                                <div class="space-y-1">
                                    <div class="flex items-center gap-2 text-xs text-gray-500">
                                        <span class="font-medium text-gray-800">
                                            <?= esc($electionTitle) ?>
                                        </span>
                                    </div>

                                    <div class="flex flex-wrap items-center gap-2 text-[11px] text-gray-700">
                                        <span
                                            class="inline-flex items-center justify-center h-5 px-2 rounded-full bg-slate-100 text-[10px] font-semibold text-slate-700">
                                            <?= esc($alias) ?>
                                        </span>
                                        <?php if ($cpName || $vcpName): ?>
                                            <span class="font-medium">
                                                <?= esc(trim(($cpName ?? '') . ' & ' . ($vcpName ?? ''), ' &')) ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Kanan: waktu mulai & status -->
                                <div class="flex flex-col items-start sm:items-end gap-1 text-[11px]">
                                    <div class="text-gray-500">
                                        <span class="text-gray-400">Mulai:</span>
                                        <span class="ml-1 font-medium text-gray-700">
                                            <?= esc($startAt) ?> - <?= esc($endAt) ?>
                                        </span>
                                    </div>
                                    <span
                                        class="inline-flex items-center gap-1 rounded-full px-2.5 py-0.5 text-[10px] font-medium <?= $statusClass ?>">
                                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                                        <?= esc($statusLabel) ?>
                                    </span>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-sm text-gray-500">
                            Siswa ini belum tercatat mengikuti pemilihan apa pun.
                        </p>
                    <?php endif; ?>
                </div>

            <?php else: ?>
                <p class="text-sm text-gray-500">
                    Siswa ini belum tercatat mengikuti pemilihan apa pun.
                </p>
            <?php endif; ?>
        </section>
    </div>
</main>
<?php $this->endSection() ?>

<?php $this->section('modal') ?>
<div data-modal id="editParticipantModal" class="fixed inset-0 z-40 flex items-center justify-center px-4 py-6 bg-black bg-opacity-40 opacity-0 pointer-events-none transition-opacity duration-200">
    <div data-modal-panel class="bg-white max-w-3xl w-full rounded-2xl shadow-xl transform scale-95 transition-transform duration-200">
        <?= form_open("admin/participant/update/{$participant['id']}") ?>
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-base font-semibold text-gray-900">Edit Informasi Siswa</h3>
            <button
                type="button"
                data-modal-dismiss
                class="p-1.5 rounded-full hover:bg-gray-100 text-gray-500">
                ✖
            </button>
        </div>

        <div class="px-5 py-4 space-y-4 text-sm">
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="nisn" class="block text-sm font-medium text-gray-700 mb-1">* NISN</label>
                    <input
                        type="number"
                        id="nisn"
                        name="nisn"
                        value="<?= $participant['nisn'] ?>"
                        class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out"
                        min="1"
                        required />
                </div>
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">* Nama Siswa</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="<?= $participant['name'] ?>"
                        class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out"
                        placeholder="Nama lengkap kandidat" />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">* Jenis Kelamin</label>
                    <div class="flex items-center space-x-4">

                        <!-- Laki-laki -->
                        <label for="laki-laki" class="flex items-center cursor-pointer space-x-2">
                            <input
                                type="radio"
                                id="laki-laki"
                                name="gender"
                                value="l"
                                class="hidden peer"
                                required
                                <?= $participant['gender'] == 'l' ? 'checked' : '' ?>>
                            <span
                                class="w-4 h-4 rounded-full border border-gray-400 peer-checked:border-indigo-600 peer-checked:bg-indigo-600 transition"></span>
                            <span class="text-gray-700">Laki-laki</span>
                        </label>

                        <!-- Perempuan -->
                        <label for="perempuan" class="flex items-center cursor-pointer space-x-2">
                            <input
                                type="radio"
                                id="perempuan"
                                name="gender"
                                value="p"
                                class="hidden peer"
                                required
                                <?= $participant['gender'] == 'p' ? 'checked' : '' ?>>
                            <span
                                class="w-4 h-4 rounded-full border border-gray-400 peer-checked:border-pink-500 peer-checked:bg-pink-500 transition"></span>
                            <span class="text-gray-700">Perempuan</span>
                        </label>

                    </div>

                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="class" class="block text-sm font-medium text-gray-700 mb-1">* Kelas</label>
                    <select
                        id="class"
                        name="class"
                        class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out"
                        required>
                        <option value="">-- Pilih Kelas --</option>
                        <option value="X" <?= $participant['class'] == 'X' ? 'selected' : '' ?>>X</option>
                        <option value="XI" <?= $participant['class'] == 'XI' ? 'selected' : '' ?>>XI</option>
                        <option value="XII" <?= $participant['class'] == 'XII' ? 'selected' : '' ?>>XII</option>
                    </select>
                </div>
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">* Nama Pengguna</label>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="<?= $participant['username'] ?>"
                        class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out"
                        placeholder="Nama lengkap kandidat" />
                </div>
            </div>
        </div>

        <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-end space-x-2">
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
<!-- Toggle password -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('btnTogglePassword');
        const input = document.getElementById('passwordField');

        if (!btn || !input) return;

        btn.addEventListener('click', () => {
            if (input.type === 'password') {
                input.type = 'text';
                btn.textContent = 'Sembunyikan';
            } else {
                input.type = 'password';
                btn.textContent = 'Tampilkan';
            }
        });
    });
</script>
<?php $this->endSection() ?>