<?php $this->extend('main_layout') ?>

<?php $this->section('header') ?>
<title>Daftar Siswa | Admin OSIS</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php $this->endSection() ?>

<?php $this->section('content') ?>
<main class="flex-1 overflow-y-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">

        <!-- Page header -->
        <div>
            <h1 class="text-2xl font-semibold text-gray-900">Daftar Siswa</h1>
            <p class="text-sm text-gray-500 mt-1">Buat dan lihat daftar siswa</p>
        </div>

        <!-- STAT CARDS -->
        <!-- <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500">Total Siswa Aktif</p>
                        <p class="mt-1 text-2xl font-semibold text-gray-900">50</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-lg">
                        👥
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500">Sudah Memilih</p>
                        <p class="mt-1 text-2xl font-semibold text-green-600">640</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center text-lg">
                        ✅
                    </div>
                </div>
                <div class="mt-3">
                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                        <span>Partisipasi</span>
                        <span>78%</span>
                    </div>
                    <div class="w-full h-1.5 rounded-full bg-gray-100 overflow-hidden">
                        <div class="h-1.5 bg-green-500 rounded-full" style="width: 78%;"></div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500">Belum Memilih</p>
                        <p class="mt-1 text-2xl font-semibold text-orange-500">180</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center text-lg">
                        ⏳
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500">Jumlah Kandidat</p>
                        <p class="mt-1 text-2xl font-semibold text-gray-900">4</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center text-lg">
                        🎓
                    </div>
                </div>
            </div>
        </section> -->

        <!-- TABLE & PAGINATION -->
        <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
                <!-- Search -->
                <form action="" method="get" class="flex items-center gap-2">
                    <input
                        type="text"
                        name="find"
                        value="<?= $find ?>"
                        class="w-full sm:w-48 rounded-lg border border-gray-300 px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Cari siswa..." />
                    <button
                        type="submit"
                        class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium border border-gray-300 text-gray-700 hover:bg-gray-50 active:bg-gray-100 active:scale-95">
                        🔍
                    </button>
                </form>

                <div class="flex items-center gap-3">
                    <!-- NAV: Siswa Aktif / Nonaktif -->
                    <nav class="inline-flex rounded-lg bg-gray-100 p-1 text-sm font-medium">
                        <a
                            href="<?= base_url('admin/participant?status=active') ?>"
                            class="px-3 py-1.5 rounded-lg transition
                            <?= $filterStatus == 1 ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-600 hover:text-gray-900' ?>">
                            Siswa Aktif (<?= $totalParticipantActive ?>)
                        </a>
                        <a
                            href="<?= base_url('admin/participant?status=inactive') ?>"
                            class="px-3 py-1.5 rounded-lg transition
                            <?= $filterStatus == 0 ? 'bg-white text-indigo-600 shadow-sm' : 'text-gray-600 hover:text-gray-900' ?>">
                            Siswa Nonaktif (<?= $totalParticipantInactive ?>)
                        </a>
                    </nav>

                    <!-- OPTION MENU: ⋮ -->
                    <div class="relative">
                        <button
                            id="participantOptionsButton"
                            type="button"
                            class="inline-flex items-center justify-center w-9 h-9 rounded-full border border-gray-300 bg-white text-gray-600 hover:bg-gray-50 active:bg-gray-100 active:scale-95 transition">
                            ⋮
                        </button>

                        <div
                            id="participantOptionsMenu"
                            class="hidden absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-lg shadow-lg py-1 z-30 text-sm">
                            <button
                                type="button"
                                data-modal-target="#graduationClassModal"
                                class="w-full text-left px-3 py-2 hover:bg-gray-50 text-gray-700">
                                🎓 Kelulusan Angkatan
                            </button>
                            <a
                                href="<?= base_url('admin/participant/new') ?>"
                                class="block px-3 py-2 hover:bg-gray-50 text-gray-700">
                                ➕ Tambah Siswa
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="overflow-x-auto">

                <?php if (empty($participant)) : ?>
                    <p class="text-center text-gray-500">Tidak ada data</p>
                <?php else: ?>
                    <table class="min-w-full text-sm">
                        <thead>
                            <tr class="border-b border-gray-200 bg-gray-50">
                                <th class="px-3 py-2 text-left font-semibold text-gray-600">NISN</th>
                                <th class="px-3 py-2 text-left font-semibold text-gray-600">Nama</th>
                                <th class="px-3 py-2 text-left font-semibold text-gray-600">Nama Pengguna</th>
                                <th class="px-3 py-2 text-left font-semibold text-gray-600">Jenis Kelamin</th>
                                <th class="px-3 py-2 text-left font-semibold text-gray-600">Kelas</th>
                                <th class="px-3 py-2 text-center font-semibold text-gray-600">Angkatan</th>
                                <th class="px-3 py-2 text-center font-semibold text-gray-600">Status</th>
                                <th class="px-3 py-2 text-center font-semibold text-gray-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($participant as $prt) : ?>
                                <tr class="border-b border-gray-100 hover:bg-gray-50">
                                    <td class="px-3 py-2"><?= $prt['nisn'] ?></td>
                                    <td class="px-3 py-2 font-medium text-black"><?= $prt['name'] ?></td>
                                    <td class="px-3 py-2"><?= $prt['username'] ?></td>
                                    <td class="px-3 py-2"><?= $prt['gender'] == "l" ? "Laki-laki" : "Perempuan" ?></td>
                                    <td class="px-3 py-2"><?= $prt['class'] ?></td>
                                    <td class="px-3 py-2 text-center"><?= $prt['entry_year'] ?></td>
                                    <td class="px-3 py-2 text-center">
                                        <?php if (!$prt['status']) : ?>
                                            <span class="px-3 py-1 rounded-lg bg-red-50 text-xs text-red-700">Nonaktif</span>
                                        <?php else: ?>
                                            <span class="px-3 py-1 rounded-lg bg-green-50 text-xs text-green-700">Aktif</span>
                                        <?php endif ?>
                                    </td>
                                    <td class="px-3 py-2 text-center space-x-1.5">
                                        <a href="<?= base_url('admin/participant/detail/' . $prt['id']) ?>" class="px-2 py-1 rounded-lg bg-indigo-50 text-xs text-indigo-700 hover:bg-indigo-100">Detail</a>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-3 mt-4">
                        <?= $pager->links('default', 'admin_table'); ?>
                    </div>
                <?php endif ?>
            </div>
        </section>
    </div>
</main>
<?php $this->endSection() ?>

<?php $this->section("modal") ?>
<div data-modal id="graduationClassModal" class="fixed inset-0 z-40 flex items-center justify-center px-4 py-6 bg-black bg-opacity-40 opacity-0 pointer-events-none transition-opacity duration-200">
    <div data-modal-panel class="bg-white max-w-2xl w-full rounded-2xl shadow-xl transform scale-95 transition-transform duration-200">
        <!-- Header -->
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-base font-semibold text-gray-900">
                Nonaktifkan Angkatan
            </h3>
            <button
                data-modal-dismiss
                type="button"
                class="p-1.5 rounded-full hover:bg-gray-100 text-gray-500">
                ✖
            </button>
        </div>

        <!-- Form -->
        <?= form_open('admin/participant/deactivated-entry-year', ["class" => "px-5 py-4 space-y-4 text-sm", "id" => "graduationClassForm"]) ?>

        <!-- Deskripsi -->
        <p class="text-gray-600">
            Fitur ini akan menonaktifkan seluruh siswa pada satu angkatan.
            Siswa yang dinonaktifkan tidak akan bisa mengikuti pemilihan OSIS berikutnya,
            namun data mereka tetap tersimpan sebagai arsip.
        </p>

        <!-- Pilih angkatan -->
        <div class="space-y-1">
            <label for="entry_year" class="block font-medium text-gray-800">
                Pilih angkatan yang akan dinonaktifkan
            </label>
            <select
                id="entry_year"
                name="entry_year"
                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                required>
                <option value="">-- Pilih angkatan --</option>
                <?php if (!empty($entryYears)): ?>
                    <?php foreach ($entryYears as $year): ?>
                        <option value="<?= $year['entry_year'] ?>"><?= $year['entry_year'] ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
            <p class="text-xs text-gray-500">
                Hanya angkatan yang sudah waktunya lulus yang sebaiknya muncul di sini.
            </p>
        </div>

        <!-- Konfirmasi ketik ulang tahun -->
        <div class="space-y-1">
            <label for="confirm_year" class="block font-medium text-gray-800">
                Ketik ulang tahun angkatan untuk konfirmasi
            </label>
            <input
                id="confirm_year"
                name="confirm_year"
                type="text"
                class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                placeholder="Misal: 2024"
                required>
            <p class="text-xs text-red-500">
                Aksi ini bersifat massal dan akan menonaktifkan seluruh siswa pada angkatan tersebut.
                Pastikan data sudah benar.
            </p>
        </div>

        <!-- Checkbox yakin -->
        <div class="flex items-start space-x-2">
            <input
                id="confirm_checkbox"
                name="confirm_checkbox"
                type="checkbox"
                class="mt-1 h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                required>
            <label for="confirm_checkbox" class="text-xs text-gray-700">
                Saya yakin ingin menonaktifkan seluruh siswa pada angkatan yang dipilih.
                Saya memahami bahwa mereka tidak akan dapat mengikuti pemilihan OSIS berikutnya.
            </label>
        </div>

        <!-- Footer -->
        <div class="pt-3 mt-3 border-t border-gray-100 flex items-center justify-end space-x-2">
            <button
                type="button"
                data-modal-dismiss
                class="px-3 py-2 rounded-lg text-sm font-medium border border-gray-300 text-gray-700 hover:bg-gray-50">
                Batal
            </button>
            <button
                id="graduationSubmitBtn"
                type="submit"
                class="px-4 py-2 rounded-lg text-sm font-medium bg-red-600 text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 disabled:opacity-50 disabled:cursor-not-allowed"
                disabled>
                Nonaktifkan Angkatan
            </button>
        </div>

        <?= form_close() ?>
    </div>
</div>

<?php $this->endSection() ?>

<?php $this->section('script') ?>
<?= session()->getFlashdata('msg') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('graduationClassForm');
        if (!form) return;

        const entryYearSelect = document.getElementById('entry_year');
        const confirmYearInput = document.getElementById('confirm_year');
        const confirmCheckbox = document.getElementById('confirm_checkbox');
        const submitBtn = document.getElementById('graduationSubmitBtn');

        function validateGraduationForm() {
            const selectedYear = entryYearSelect.value;
            const confirmYear = confirmYearInput.value.trim();
            const checked = confirmCheckbox.checked;

            const isValid = selectedYear !== '' &&
                confirmYear !== '' &&
                confirmYear === selectedYear &&
                checked;

            submitBtn.disabled = !isValid;
        }

        // Jalankan validasi setiap ada perubahan
        entryYearSelect.addEventListener('change', validateGraduationForm);
        confirmYearInput.addEventListener('input', validateGraduationForm);
        confirmCheckbox.addEventListener('change', validateGraduationForm);

        // Kalau modal bisa dibuka/ditutup dinamis, bisa di-reset di sini kalau perlu
        validateGraduationForm();

        // option menu buka tutup
        const btnOptionMenu = document.getElementById('participantOptionsButton');
        const menu = document.getElementById('participantOptionsMenu');

        if (!btnOptionMenu || !menu) return;

        // Toggle buka/tutup saat tombol ⋮ di-klik
        btnOptionMenu.addEventListener('click', function(e) {
            e.stopPropagation(); // jangan terus ke document
            menu.classList.toggle('hidden');
        });

        // Klik di dalam menu (misal klik "Kelulusan" atau "Tambah Siswa") → biarin, tapi jangan nutup gara-gara event bubbling
        menu.addEventListener('click', function(e) {
            e.stopPropagation();
            // Optional: kalau mau menu otomatis nutup setelah pilih salah satu:
            // menu.classList.add('hidden');
        });

        // Klik di mana pun di luar tombol & menu → tutup menu
        document.addEventListener('click', function() {
            menu.classList.add('hidden');
        });
    });
</script>
<?php $this->endSection() ?>