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

        <div>
            <button type="button" id="openModal" class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium bg-indigo-600 text-white hover:bg-indigo-700 active:bg-indigo-800 active:scale-95 transition duration-150">➕ Buat Paslon</button>
        </div>

        <!-- Data Show -->
        <?php foreach ($candidateGroup as $cg): ?>
            <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="space-y-4">

                    <div class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm hover:shadow-md transition">

                        <!-- Outer flex (responsive) -->
                        <div class="flex flex-col md:flex-row md:items-start gap-5">

                            <!-- FOTO OVERLAP (CENTER ON MOBILE) -->
                            <div class="relative min-w-[100px] mx-auto md:mx-0">
                                <!-- Ketua -->
                                <img src="<?= base_url('uploads/candidates/' . $cg['cp_photo']) ?>"
                                    class="w-16 h-16 rounded-full object-cover border-2 border-white shadow absolute top-0 left-0 z-20">

                                <!-- Wakil -->
                                <img src="<?= base_url('uploads/candidates/' . $cg['vcp_photo']) ?>"
                                    class="w-16 h-16 rounded-full object-cover border-2 border-white shadow absolute top-8 left-12 z-10">

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
                                    <strong>Ketua:</strong> <?= $cg['chairperson'] ?> •
                                    <strong>Wakil:</strong> <?= $cg['vice_chairperson'] ?>
                                </p>

                                <!-- VISI -->
                                <p class="text-sm text-gray-500 line-clamp-2">
                                    <strong>Visi:</strong> <?= $cg['vision'] ?>
                                </p>

                                <!-- HASIL SUARA -->
                                <div class="pt-3">

                                    <div class="flex justify-between items-center mb-1">
                                        <span class="text-sm font-medium text-gray-700">Perolehan Suara</span>
                                        <span class="text-sm font-semibold text-gray-900">
                                            1,240 • 45%
                                        </span>
                                    </div>

                                    <!-- PROGRESS BAR -->
                                    <div class="w-full bg-gray-200 rounded-full h-2 overflow-hidden">
                                        <div class="bg-indigo-600 h-2 rounded-full" style="width: 45%;"></div>
                                    </div>

                                </div>
                            </div>

                            <!-- ACTION BUTTONS -->
                            <div class="flex md:flex-col flex-row md:items-end gap-2 mt-4 md:mt-0">

                                <a href="/paslon/detail">
                                    <button class="px-3 py-1.5 text-sm bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                                        Detail
                                    </button>
                                </a>

                                <a href="/paslon/edit">
                                    <button class="px-3 py-1.5 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                        Edit
                                    </button>
                                </a>

                                <form action="/paslon/delete" method="POST"
                                    onsubmit="return confirm('Hapus paslon ini?')">
                                    <button class="px-3 py-1.5 text-sm bg-red-600 text-white rounded-lg hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>

                            </div>

                        </div>

                    </div>

                </div>



            </section>
        <?php endforeach ?>
    </div>
</main>
<?php $this->endSection() ?>

<?php $this->section("modal") ?>
<div id="modal" class="fixed inset-0 z-40 flex items-center justify-center px-4 py-6 bg-black bg-opacity-40 opacity-0 pointer-events-none transition-opacity duration-200">
    <div id="modalPanel" class="bg-white max-w-3xl w-full rounded-2xl shadow-xl transform scale-95 transition-transform duration-200">
        <?= form_open("admin/candidate-group/store") ?>
        <div class="px-5 py-4 border-b border-gray-100 flex items-center justify-between">
            <h3 class="text-base font-semibold text-gray-900">Buat Paslon Baru</h3>
            <button id="modalClose" type="button" class="p-1.5 rounded-full hover:bg-gray-100 text-gray-500">
                ✖
            </button>
        </div>

        <?php if (session()->has('errors')) : ?>
            <div class="px-5 py-4 space-y-4 text-sm text-red-700 bg-red-100">
                <ul class="list-disc list-inside">
                    <?php foreach (session('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="px-5 py-4 space-y-4 text-sm">
            <!-- PILIH KETUA & WAKIL -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- KETUA -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Ketua</label>
                    <div class="relative">
                        <!-- Trigger -->
                        <button
                            type="button"
                            class="candidate-trigger flex w-full items-center justify-between rounded-lg border <?php echo session()->has('cp-id') ? 'border-red-500' : 'border-gray-200'; ?> px-3 py-2 text-sm bg-white hover:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            data-role="chairperson">
                            <span class="flex items-center space-x-2 text-gray-400">
                                <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 text-xs">
                                    📷
                                </span>
                                <span class="flex flex-col text-left">
                                    <span class="text-xs">NIS / Nama Ketua</span>
                                    <span class="text-[11px] text-gray-400">Klik untuk memilih kandidat</span>
                                </span>
                            </span>
                            <span class="text-xs text-gray-400">▼</span>
                        </button>

                        <!-- Dropdown -->
                        <div
                            class="candidate-dropdown hidden absolute left-0 mt-1 w-full rounded-xl border border-gray-200 bg-white shadow-lg z-50"
                            data-dropdown-for="chairperson">
                            <div class="p-2 border-b border-gray-100">
                                <input
                                    type="text"
                                    class="candidate-search block w-full rounded-lg border border-gray-200 px-2.5 py-1.5 text-xs focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="Cari nama atau NIS..." />
                            </div>
                            <ul class="candidate-list max-h-60 overflow-y-auto py-1 text-sm"></ul>
                        </div>

                        <input type="hidden" name="cp-id" id="cp-id">
                    </div>
                </div>

                <!-- WAKIL -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Wakil</label>
                    <div class="relative">
                        <!-- Trigger -->
                        <button
                            type="button"
                            class="candidate-trigger flex w-full items-center justify-between rounded-lg border border-gray-300 px-3 py-2 text-sm bg-white hover:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                            data-role="vice-chairperson">
                            <span class="flex items-center space-x-2 text-gray-400">
                                <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 text-xs">
                                    📷
                                </span>
                                <span class="flex flex-col text-left">
                                    <span class="text-xs">NIS / Nama Wakil</span>
                                    <span class="text-[11px] text-gray-400">Klik untuk memilih kandidat</span>
                                </span>
                            </span>
                            <span class="text-xs text-gray-400">▼</span>
                        </button>

                        <!-- Dropdown -->
                        <div
                            class="candidate-dropdown hidden absolute left-0 mt-1 w-full rounded-xl border border-gray-200 bg-white shadow-lg z-50"
                            data-dropdown-for="vice-chairperson">
                            <div class="p-2 border-b border-gray-100">
                                <input
                                    type="text"
                                    class="candidate-search block w-full rounded-lg border border-gray-200 px-2.5 py-1.5 text-xs focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500"
                                    placeholder="Cari nama atau NIS..." />
                            </div>
                            <ul class="candidate-list max-h-60 overflow-y-auto py-1 text-sm"></ul>
                        </div>

                        <input type="hidden" name="vcp-id" id="vcp-id">
                    </div>
                </div>
            </div>


            <div>
                <label for="alias" class="block text-sm font-medium text-gray-700 mb-1">* Nama Paslon/Nomor Urut</label>
                <input
                    type="text"
                    id="alias"
                    name="alias"
                    required
                    value="<?= old('alias') ?>"
                    class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out" />
            </div>


            <div>
                <label for="vision" class="block text-sm font-medium text-gray-700 mb-1">* Visi Paslon</label>
                <textarea
                    id="vision"
                    name="vision"
                    rows="3"
                    class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out"
                    placeholder="Input visi kandidat"
                    required><?= old('vision') ?></textarea>
            </div>
            <div>
                <label for="mission" class="block text-sm font-medium text-gray-700 mb-1">* Misi Paslon</label>
                <textarea
                    id="mission"
                    name="mission"
                    rows="3"
                    class="block w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out"
                    placeholder="Input misi kandidat"
                    required><?= old('mission') ?></textarea>
            </div>
        </div>

        <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-end space-x-2">
            <button
                id="modalCancel"
                type="button"
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

<?php $this->section("script") ?>
<!-- open modal when it error -->
<?php if (session()->has('errors')): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelector("#openModal").click();
        })
    </script>
<?php endif ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- DATA CONTOH KANDIDAT ---
        // Ganti ini dengan data asli nanti (misal dari backend).
        const candidates = <?php echo json_encode($candidate) ?>;
        const base_url = "<?php echo base_url() ?>";

        // --- HELPERS ---
        function renderCandidateList(dropdownEl, searchTerm = '') {
            const listEl = dropdownEl.querySelector('.candidate-list');
            listEl.innerHTML = '';

            const term = searchTerm.trim().toLowerCase();

            const filtered = candidates.filter((c) => {
                if (!term) return true;
                return (
                    c.name.toLowerCase().includes(term) ||
                    c.nis.toLowerCase().includes(term)
                );
            });

            if (filtered.length === 0) {
                const emptyItem = document.createElement('li');
                emptyItem.className = 'px-3 py-2 text-xs text-gray-400';
                emptyItem.textContent = 'Tidak ada kandidat yang cocok.';
                listEl.appendChild(emptyItem);
                return;
            }

            filtered.forEach((c) => {
                const li = document.createElement('li');
                li.className =
                    'candidate-option cursor-pointer px-3 py-2 hover:bg-gray-50 flex items-center space-x-2';

                li.dataset.id = c.id;
                li.dataset.nis = c.nis;
                li.dataset.name = c.name;
                li.dataset.photo = c.photo;

                li.innerHTML = `
          <img src="${base_url + "/uploads/candidates/" + c.photo}" alt="${c.name}" class="h-9 w-9 rounded-full object-cover flex-shrink-0">
          <div class="flex flex-col">
            <span class="text-[11px] text-gray-500">NIS ${c.nis}</span>
            <span class="text-sm font-medium text-gray-900">${c.name}</span>
          </div>
        `;

                listEl.appendChild(li);
            });
        }

        function setSelectedCandidate(triggerBtn, candidate) {
            triggerBtn.dataset.selectedId = candidate.id;
            triggerBtn.dataset.selectedNis = candidate.nis;
            triggerBtn.dataset.selectedName = candidate.name;
            triggerBtn.dataset.selectedPhoto = candidate.photo;

            triggerBtn.innerHTML = `
        <span class="flex items-center space-x-2">
          <img src="${base_url + "/uploads/candidates/" + candidate.photo}" alt="${candidate.name}" class="h-9 w-9 rounded-full object-cover flex-shrink-0">
          <span class="flex flex-col text-left">
            <span class="text-[11px] text-gray-500">NIS ${candidate.nis}</span>
            <span class="text-sm font-medium text-gray-900">${candidate.name}</span>
          </span>
        </span>
        <span class="text-xs text-gray-400">Ganti ▼</span>
      `;
        }

        function closeAllDropdowns() {
            document.querySelectorAll('.candidate-dropdown').forEach((dd) => {
                dd.classList.add('hidden');
            });
        }

        // --- INISIALISASI ---
        const triggers = document.querySelectorAll('.candidate-trigger');

        triggers.forEach((trigger) => {
            const role = trigger.dataset.role;
            const dropdown = document.querySelector(
                `.candidate-dropdown[data-dropdown-for="${role}"]`
            );

            if (!dropdown) return;

            // Pertama kali render list
            renderCandidateList(dropdown, '');

            // Open/close dropdown
            trigger.addEventListener('click', function(e) {
                e.stopPropagation(); // jangan bubble ke window
                const isHidden = dropdown.classList.contains('hidden');
                closeAllDropdowns();
                if (isHidden) {
                    dropdown.classList.remove('hidden');
                } else {
                    dropdown.classList.add('hidden');
                }
            });

            // Search di dalam dropdown
            const searchInput = dropdown.querySelector('.candidate-search');
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    renderCandidateList(dropdown, this.value);
                });
            }

            // Klik opsi kandidat
            dropdown.addEventListener('click', function(e) {
                const option = e.target.closest('.candidate-option');
                if (!option) return;

                const candidate = {
                    id: option.dataset.id,
                    nis: option.dataset.nis,
                    name: option.dataset.name,
                    photo: option.dataset.photo
                };

                // set id kandidat di input hidden
                if (role == 'chairperson') {
                    document.getElementById('cp-id').value = candidate.id;
                } else if (role == 'vice-chairperson') {
                    document.getElementById('vcp-id').value = candidate.id;
                }

                setSelectedCandidate(trigger, candidate);
                dropdown.classList.add('hidden');
            });
        });

        // Tutup dropdown hanya jika klik DI LUAR trigger & dropdown
        window.addEventListener('click', function(e) {
            const isInsideDropdown = e.target.closest('.candidate-dropdown');
            const isTrigger = e.target.closest('.candidate-trigger');

            // Kalau klik bukan di dropdown dan bukan di tombol pemicu → tutup
            if (!isInsideDropdown && !isTrigger) {
                closeAllDropdowns();
            }
        });

    });
</script>

<?php $this->endSection() ?>