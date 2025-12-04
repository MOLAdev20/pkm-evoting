<?php $this->extend('main_layout') ?>

<?php $this->section('header') ?>
<title>Daftar Paslon | Admin OSIS</title>
<?php $this->endSection() ?>

<?php $this->section('content') ?>
<main class="flex-1 overflow-y-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">

        <!-- Page header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Daftar Paslon</h1>
                <p class="text-sm text-gray-500 mt-1">Buat dan lihat daftar pasangan calon</p>
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


        <div class="space-y-4">
            <div>
                <span class="text-sm text-gray-600">Pasangan calon (paslon) dapat dibuat di <a href="<?= base_url('admin/election/') ?>" class="text-indigo-700">menu pemilihan</a></span>
            </div>
            <?php foreach ($candidateGroup as $cg): ?>
                <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <div class="space-y-4">

                        <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm hover:shadow-md transition">

                            <!-- Outer flex (responsive) -->
                            <div class="flex flex-col md:flex-row md:items-start gap-5">

                                <!-- FOTO OVERLAP (CENTER ON MOBILE) -->
                                <div class="relative min-w-[100px] mx-auto md:mx-0">
                                    <!-- Ketua -->
                                    <?php if ($cg['cp_photo'] == null): ?>
                                        <img src="<?= base_url('assets/blank.png') ?>"
                                            class="w-16 h-16 rounded-full object-cover border-2 border-white shadow absolute top-0 left-0 z-20">
                                    <?php else: ?>
                                        <img src="<?= base_url('uploads/candidates/' . $cg['cp_photo']) ?>"
                                            class="w-16 h-16 rounded-full object-cover border-2 border-white shadow absolute top-0 left-0 z-20">
                                    <?php endif ?>

                                    <!-- Wakil -->
                                    <?php if ($cg['vcp_photo'] == null): ?>
                                        <img src="<?= base_url('assets/blank.png') ?>"
                                            class="w-16 h-16 rounded-full object-cover border-2 border-white shadow absolute top-8 left-12 z-10">
                                    <?php else: ?>
                                        <img src="<?= base_url('uploads/candidates/' . $cg['vcp_photo']) ?>"
                                            class="w-16 h-16 rounded-full object-cover border-2 border-white shadow absolute top-8 left-12 z-10">
                                    <?php endif ?>

                                    <!-- Space box untuk responsive layout -->
                                    <div class="w-32 h-24"></div>
                                </div>

                                <!-- KONTEN UTAMA -->
                                <div class="flex-1 space-y-2">

                                    <!-- HEADER PASLON -->
                                    <div class="flex flex-wrap items-center gap-2">
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            <?= $cg['alias'] ?>
                                        </h3>

                                        <span class="text-xs bg-green-100 text-green-700 px-2 py-0.5 rounded-full">
                                            Aktif
                                        </span>
                                    </div>

                                    <!-- INFO KETUA/WAKIL -->
                                    <p class="text-sm text-gray-600">
                                        <strong>Ketua:</strong> <?= $cg['chairperson'] ?? "<span class='text-red-500'>Belum Ditentukan</span>" ?> •
                                        <strong>Wakil:</strong> <?= $cg['vice_chairperson'] ?? "<span class='text-red-500'>Belum Ditentukan</span>" ?>
                                    </p>

                                    <!-- VISI -->
                                    <p class="text-sm text-gray-500 line-clamp-2">
                                        <strong>Visi:</strong> <?= $cg['vision'] ?>
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>



                </section>
            <?php endforeach ?>
        </div>
    </div>
</main>
<?php $this->endSection() ?>