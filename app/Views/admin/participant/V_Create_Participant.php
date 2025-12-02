<?php $this->extend('main_layout') ?>

<?php $this->section('header') ?>
<title>Input Siswa Baru | Admin OSIS</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php $this->endSection() ?>

<?php $this->section('content') ?>
<main class="flex-1 overflow-y-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">

        <!-- Page header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Input Peserta Baru</h1>
                <nav class="flex items-center gap-1 text-sm text-gray-500 mt-1">
                    <a href="#" class="hover:text-gray-700">Dashboard</a>
                    <span>/</span>
                    <a href="<?= base_url('admin/participant') ?>" class="hover:text-gray-700">Peserta</a>
                    <span>/</span>
                    <span class="text-gray-900 font-medium">Input Peserta Baru</span>
                </nav>
            </div>
        </div>


        <!-- FORMS -->
        <section class="grid grid-cols-1">
            <!-- Form Tambah Kandidat -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <?= form_open_multipart('admin/participant/store', ["class" => "space-y-4"]) ?>


                <div class="grid grid-cols-1 gap-6">

                    <?php if (session()->has('errors')) : ?>
                        <div class="p-3 mb-4 text-sm text-red-700 bg-red-100 rounded-lg">
                            <ul class="list-disc list-inside">
                                <?php foreach (session('errors') as $error) : ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="space-y-4 col-span-1">
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

                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div>
                                <label for="class" class="block text-sm font-medium text-gray-700 mb-1">* Kelas</label>
                                <select
                                    id="class"
                                    name="class"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out"
                                    required>
                                    <option value="">-- Pilih Kelas --</option>
                                    <option value="X" <?= old('class') == 'X' ? 'selected' : '' ?>>X</option>
                                    <option value="XI" <?= old('class') == 'XI' ? 'selected' : '' ?>>XI</option>
                                    <option value="XII" <?= old('class') == 'XII' ? 'selected' : '' ?>>XII</option>
                                </select>
                            </div>
                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">* Nama Pengguna</label>
                                <input
                                    type="text"
                                    id="username"
                                    name="username"
                                    value="<?= old('username') ?>"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out"
                                    placeholder="Nama lengkap kandidat" />
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">* Kata Sandi</label>
                                <input
                                    type="text"
                                    id="password"
                                    name="password"
                                    value="<?= old('password') ?>"
                                    class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out"
                                    placeholder="Nama lengkap kandidat" />
                            </div>
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


        <section class="grid grid-cols-1">
            <!-- Form Tambah Partisipan -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="space-y-4">


                    <div class="gap-6">
                        <div class="w-full bg-white rounded-2xl p-10 shadow-lg border border-gray-100">
                            <!-- Jumbo Heading -->
                            <h2 class="text-2xl sm:text-4xl font-bold text-gray-800 leading-tight">
                                Lelah mengunggah siswa satu per satu?
                            </h2>

                            <!-- Sub Text -->
                            <p class="mt-2 text-gray-500 text-md">
                                Upload dengan format CSV. Seperti pada contoh. <a href="#"
                                    class="text-indigo-600 hover:underline">Download here</a>.
                            </p>

                            <!-- Big Import Button -->
                            <div class="mt-2">
                                <button
                                    id="uploader-button"
                                    class="w-full flex items-center gap-2 sm:w-auto bg-green-600 hover:bg-green-700 text-white font-bold text-lg px-8 py-4 rounded-xl shadow-md transition"
                                    type="button" onclick="openCSVpicker()">
                                    <svg
                                        width="24"
                                        height="24"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <!-- Arrow pointing up -->
                                        <path
                                            d="M12 3L12 15"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M7 8L12 3L17 8"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />

                                        <!-- Bottom tray -->
                                        <path
                                            d="M5 15V19C5 20.1046 5.89543 21 7 21H17C18.1046 21 19 20.1046 19 19V15"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                    Import CSV
                                </button>

                                <div id="loading-spinner" class="hidden flex items-center mt-2 gap-2">
                                    <div class="w-6 h-6 border-4 border-gray-300 border-t-indigo-600 border-b-indigo-600 rounded-full animate-spin"></div> Mengupload...
                                </div>


                                <div id="confirm-upload" class="hidden gap-3 items-center">

                                    <!-- File name -->
                                    <span>Upload File ini? </span><span id="selected-filename" class="text-green-600 underline font-medium">Nama_file_excel.xlsx</span>

                                    <!-- YES / NO merged button group -->
                                    <div class="overflow-hidden flex items-center rounded-full shadow-sm border border-gray-300 bg-white">
                                        <!-- YES Button -->
                                        <button
                                            id="confirm-yes"
                                            type="button"
                                            onclick="confirmUpload()"
                                            class="px-3 py-1 font-semibold transition text-gray-700 hover:bg-gray-100 active:scale-95">
                                            YA
                                        </button>

                                        <!-- NO Button -->
                                        <button
                                            id="confirm-no"
                                            type="button"
                                            onclick="cancelUpload()"
                                            class="px-3 py-1 font-semibold transition border-l border-gray-300 text-gray-700 hover:bg-gray-100 active:scale-95">
                                            TIDAK
                                        </button>
                                    </div>

                                </div>

                            </div>

                            <input type="file" name="excel" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" class="hidden" id="csv-bulk-upload" />
                        </div>

                    </div>
                </div>
            </div>
        </section>


    </div>
</main>
<?php $this->endSection() ?>

<?php $this->section('script') ?>
<?= session()->getFlashdata('success') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const base_url = "<?= base_url() ?>"

    function openCSVpicker() {
        document.getElementById('csv-bulk-upload').click();
    }

    // let formData = new FormData();
    document.getElementById('csv-bulk-upload').addEventListener('change', function() {
        document.getElementById("uploader-button").style.display = "none";
        document.getElementById("confirm-upload").style.display = "flex";
        document.getElementById("selected-filename").innerHTML = this.files[0].name;
    })


    function confirmUpload() {
        const spinner = document.getElementById('loading-spinner');

        // SHOW loading
        spinner.classList.remove('hidden');

        // hide information
        document.getElementById("uploader-button").style.display = "none";
        document.getElementById("confirm-upload").style.display = "none";

        let formData = new FormData();
        formData.append('excel', document.getElementById('csv-bulk-upload').files[0]);

        fetch(base_url + '/admin/participant/import', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                swal.fire("Import Berhasil", "Data siswa berhasil diimport", "success");
                setTimeout(() => {
                    window.location.href = base_url + '/admin/participant';
                }, 800);
            })
            .catch(error => {
                console.log(error);
            })
            .finally(() => {
                // HIDE loading no matter what (success or error)
                spinner.classList.add('hidden');
            });
    }

    function cancelUpload() {
        document.getElementById("uploader-button").style.display = "flex";
        document.getElementById("confirm-upload").style.display = "none";
        document.getElementById("csv-bulk-upload").value = null;
    }
</script>

<?php $this->endSection() ?>