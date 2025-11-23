<?php $this->extend('main_layout') ?>

<?php $this->section('header') ?>
<title>Input Kandidat Baru | Admin OSIS</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php $this->endSection() ?>

<?php $this->section('content') ?>
<main class="flex-1 overflow-y-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">

        <!-- Page header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Input Kandidat Baru</h1>
                <nav class="flex items-center gap-1 text-sm text-gray-500 mt-1">
                    <a href="#" class="hover:text-gray-700">Dashboard</a>
                    <span>/</span>
                    <a href="<?= base_url('admin/candidate/') ?>" class="hover:text-gray-700">Kandidat</a>
                    <span>/</span>
                    <span class="text-gray-900 font-medium">Input Kandidat Baru</span>
                </nav>
            </div>
        </div>


        <!-- FORMS -->
        <section class="grid grid-cols-1">
            <!-- Form Tambah Kandidat -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <?= form_open_multipart('admin/candidate/store', ["class" => "space-y-4"]) ?>

                <?php if (session()->has('errors')) : ?>
                    <div class="p-3 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                        <ul class="list-disc list-inside">
                            <?php foreach (session('errors') as $error) : ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                <?php endif; ?>


                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

                    <div class="space-y-4 col-span-1">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">* Foto Kandidat</label>

                            <div
                                class="flex flex-col p-1 items-center justify-center w-full h-48 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-indigo-400 transition group"
                                onclick="document.getElementById('photo').click()">
                                <!-- Preview image -->
                                <img
                                    id="photo-preview"
                                    class="hidden h-full object-cover rounded-xl" />

                                <!-- Placeholder -->
                                <div id="photo-placeholder" class="flex flex-col items-center text-gray-500 group-hover:text-indigo-500">
                                    <svg class="w-10 h-10 mb-2 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            d="M3 7h18M3 7l2 10h14l2-10M5 7l2-4h10l2 4" />
                                    </svg>
                                    <p class="text-sm">Klik untuk mengupload foto</p>
                                    <p class="text-xs text-gray-400 group-hover:text-indigo-400">Format JPG/PNG, Max 2MB</p>
                                </div>
                            </div>

                            <p id="photo-error" class="text-sm text-red-500 mt-2 hidden"></p>

                            <input
                                type="file"
                                id="photo"
                                name="photo"
                                class="hidden"
                                accept="image/*"
                                onchange="validateAndPreview(event)" />
                        </div>
                    </div>

                    <div class="space-y-4 col-span-1 sm:col-span-2">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label for="nisn" class="block text-sm font-medium text-gray-700 mb-1">* NISN</label>
                                <input
                                    type="number"
                                    id="nisn"
                                    name="nisn"
                                    value="<?= old('nisn') ?>"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out"
                                    min="1"
                                    required />
                            </div>
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">* Nama Kandidat</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="<?= old('name') ?>"
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
                                            <?= old('gender') == 'l' ? 'checked' : '' ?>>
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
                                            <?= old('gender') == 'p' ? 'checked' : '' ?>>
                                        <span
                                            class="w-4 h-4 rounded-full border border-gray-400 peer-checked:border-pink-500 peer-checked:bg-pink-500 transition"></span>
                                        <span class="text-gray-700">Perempuan</span>
                                    </label>

                                </div>

                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                            <div>
                                <label for="birth-date" class="block text-sm font-medium text-gray-700 mb-1">* Tanggal Lahir</label>
                                <input
                                    type="date"
                                    id="birth-date"
                                    name="birth-date"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    min="1"
                                    value="<?= old('birth-date') ?>"
                                    required />
                            </div>
                            <div>
                                <label for="class-name" class="block text-sm font-medium text-gray-700 mb-1">* Kelas</label>
                                <input
                                    id="class-name"
                                    name="class-name"
                                    type="text"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                    min="1"
                                    value="<?= old('class-name') ?>"
                                    required />
                            </div>
                        </div>

                        <div>
                            <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">* Bio</label>
                            <textarea
                                id="bio"
                                name="bio"
                                rows="3"
                                class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out"
                                placeholder="Bio tentang kandidat"><?= old('bio') ?></textarea>
                        </div>

                        <div>
                            <label for="video-url" class="block text-sm font-medium text-gray-700 mb-1">URL Video (opsional)</label>
                            <input
                                name="video-url"
                                type="text"
                                class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out"
                                value="<?= old('video-url') ?>" />
                        </div>

                        <div class="flex items-center justify-end space-x-2 pt-2">
                            <a href="<?= base_url('admin/candidate') ?>"
                                class="px-3 py-2 rounded-lg text-sm font-medium border border-gray-300 text-gray-700 hover:bg-gray-50">
                                Batal
                            </a>
                            <button
                                type="submit"
                                class="px-4 py-2 rounded-lg text-sm font-medium bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                Simpan Kandidat
                            </button>
                        </div>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
        </section>



    </div>
</main>
<?php $this->endSection() ?>

<?php $this->section('script') ?>
<div class="space-y-4 col-span-1">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-2">* Foto Kandidat</label>

        <div
            class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-indigo-400 transition group"
            onclick="document.getElementById('photo').click()">
            <!-- Preview -->
            <img
                id="photo-preview"
                class="hidden h-full object-cover rounded-xl" />

            <!-- Placeholder -->
            <div id="photo-placeholder" class="flex flex-col items-center text-gray-500 group-hover:text-indigo-500">
                <svg class="w-10 h-10 mb-2 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        d="M3 7h18M3 7l2 10h14l2-10M5 7l2-4h10l2 4" />
                </svg>
                <p class="text-sm">Klik untuk upload foto</p>
                <p class="text-xs text-gray-400 group-hover:text-indigo-400">Format JPG/PNG, Max 2MB</p>
            </div>
        </div>

        <!-- Error message -->
        <p id="photo-error" class="text-sm text-red-500 mt-2 hidden"></p>

        <input
            type="file"
            id="photo"
            name="photo"
            class="hidden"
            accept="image/*"
            onchange="validateAndPreview(event)" />
    </div>
</div>
<?= session()->getFlashdata('success') ?>
<script>
    function validateAndPreview(event) {
        const file = event.target.files[0];
        const errorEl = document.getElementById('photo-error');
        const preview = document.getElementById('photo-preview');
        const placeholder = document.getElementById('photo-placeholder');

        errorEl.classList.add('hidden');
        errorEl.textContent = "";

        // Reset preview jika error
        preview.classList.add('hidden');
        placeholder.classList.remove('hidden');

        if (!file) return;

        // VALIDASI 1: Tipe file harus JPG/PNG
        const allowedTypes = ["image/jpeg", "image/jpg", "image/png"];
        if (!allowedTypes.includes(file.type)) {
            errorEl.textContent = "File harus berupa JPG atau PNG.";
            errorEl.classList.remove('hidden');
            event.target.value = ""; // reset input
            return;
        }

        // VALIDASI 2: Maksimal 2MB
        const maxSize = 2 * 1024 * 1024; // 2MB
        if (file.size > maxSize) {
            errorEl.textContent = "Ukuran maksimal file adalah 2MB.";
            errorEl.classList.remove('hidden');
            event.target.value = ""; // reset input
            return;
        }

        // Jika lolos validasi → tampilkan preview
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }
</script>

<?php $this->endSection() ?>