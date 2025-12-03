<?php $this->extend('main_layout') ?>

<?php $this->section('header') ?>
<title>Daftar Kandidat | Admin OSIS</title>
<?php $this->endSection() ?>

<?php $this->section('content') ?>
<main class="flex-1 overflow-y-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">

        <!-- Page header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Daftar Kandidat</h1>
                <p class="text-sm text-gray-500 mt-1">Buat dan lihat daftar kandidat</p>
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <button
                    class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium border border-gray-300 text-gray-700 hover:bg-gray-50">
                    ⟳ Refresh Data
                </button>
            </div>
        </div>

        <!-- STAT CARDS -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500">Total Siswa</p>
                        <p class="mt-1 text-2xl font-semibold text-gray-900">820</p>
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
        </section>

        <!-- TABLE & PAGINATION -->
        <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">

                <form method="GET" action="" class="flex items-center gap-2">
                    <input
                        type="text"
                        name="find"
                        value="<?= $find ?>"
                        class="w-full sm:w-48 rounded-lg border border-gray-300 px-3 py-1.5 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Cari kandidat..." />
                    <button
                        type="submit"
                        class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium border border-gray-300 text-gray-700 hover:bg-gray-50 active:bg-gray-100 active:scale-95">
                        🔍
                    </button>
                </form>
                <a href="<?= base_url('admin/candidate/new') ?>" class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium bg-indigo-600 text-white hover:bg-indigo-700 active:bg-indigo-800 active:scale-95 transition duration-150">➕ Tambah Kandidat</a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200 bg-gray-50">
                            <th class="px-3 py-2 text-left font-semibold text-gray-600">Foto</th>
                            <th class="px-3 py-2 text-left font-semibold text-gray-600">NISN</th>
                            <th class="px-3 py-2 text-left font-semibold text-gray-600">Nama</th>
                            <th class="px-3 py-2 text-left font-semibold text-gray-600">Tanggal Lahir</th>
                            <th class="px-3 py-2 text-left font-semibold text-gray-600">Kelas</th>
                            <th class="px-3 py-2 text-left font-semibold text-gray-600">Status</th>
                            <th class="px-3 py-2 text-center font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($candidate as $cand) : ?>
                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                <td class="px-3 py-2">
                                    <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                                        <img src="<?= base_url('uploads/candidates/' . $cand['photo']) ?>" alt="avatar" class="w-10 h-10 object-cover rounded-full">
                                    </div>
                                </td>
                                <td class="px-3 py-2"><?= $cand['nis'] ?></td>
                                <td class="px-3 py-2 font-medium text-black"><?= $cand['name'] ?></td>
                                <td class="px-3 py-2"><?= $cand['birth_date'] ?></td>
                                <td class="px-3 py-2"><?= $cand['class'] ?></td>
                                <td class="px-3 py-2">
                                    <?php if ($cand['is_active']) : ?>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-green-50 text-green-700">Aktif</span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs bg-red-50 text-red-700">Tidak Aktif</span>
                                    <?php endif ?>
                                </td>
                                <td class="px-3 py-2 text-center space-x-1.5">
                                    <button class="px-2 py-1 rounded-lg bg-gray-100 text-xs hover:bg-gray-200">Detail</button>
                                    <button class="px-2 py-1 rounded-lg bg-indigo-50 text-xs text-indigo-700 hover:bg-indigo-100">Edit</button>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-end gap-3 mt-4">
                <?= $pager->links('default', 'admin_table'); ?>
            </div>
        </section>
    </div>
</main>
<?php $this->endSection() ?>