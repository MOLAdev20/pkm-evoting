<?php $this->extend('main_layout') ?>

<?php $this->section('header') ?>
<title>Daftar Paslon | Admin OSIS</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php $this->endSection() ?>

<?php
/** @var array|null $election */
/** @var array      $candidates */

$election   = $election   ?? null;
$candidates = $candidateGroup ?? [];

// fallback nilai
$electionTitle   = $election['name']        ?? $election['title'] ?? 'Pemilihan OSIS';
$electionDesc    = $election['description'] ?? null;
$periodLabel     = $election['period']      ?? null;

$startRaw = $election['start_at'] ?? $election['start_at_datetime'] ?? null;
$endRaw   = $election['end_at']   ?? $election['end_at_datetime']   ?? null;

$startAt = $startRaw ? date('d M Y H:i', strtotime($startRaw)) : '-';
$endAt   = $endRaw   ? date('d M Y H:i', strtotime($endRaw))   : '-';

$totalVoters   = $election['total_voters']   ?? null;
$totalVoted    = $election['total_voted']    ?? null;
$totalCandidates = count($candidates);

// status badge
$status = $election['status'] ?? 'draft';
$statusLabel = 'Draft';
$statusClass = 'bg-yellow-50 text-yellow-700';

if ($status === 'open') {
    $statusLabel = 'Sedang Berlangsung';
    $statusClass = 'bg-emerald-50 text-emerald-700';
} elseif (in_array($status, ['closed', 'done'])) {
    $statusLabel = 'Selesai';
    $statusClass = 'bg-slate-100 text-slate-700';
}

// hitung partisipasi kalau ada data voters
$participationPct = 0;
if ($totalVoters && $totalVoters > 0 && $totalVoted !== null) {
    $participationPct = round(($totalVoted / $totalVoters) * 100);
}
?>

<?php $this->section('content') ?>
<main class="flex-1 overflow-y-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">

        <!-- Page header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900"><?= $election["title"] ?></h1>
                <div class="flex items-center gap-1 text-sm text-gray-500 mt-1 text-sm text-gray-500 mt-1">
                    <a href="#" class="hover:text-gray-700">Dashboard</a>
                    <span>/</span>
                    <a href="<?= base_url('admin/election/') ?>" class="hover:text-gray-700">Pemilihan</a>
                    <span>/</span>
                    <span class="text-gray-900 font-medium">Detail Pemilihan</span>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3 justify-between sm:justify-end">

                <?php if (!empty($otherOnGoing)): ?>
                    <div class="text-right">
                        <a href="javascript:void(0)"
                            onclick="Swal.fire('Tidak Dapat Dilakukan', 'Ada pemilihan yang sedang berlangsung', 'warning')"
                            class="inline-flex items-center px-3 py-2 rounded-lg ring-1 text-sm font-medium border bg-gray-50 text-gray-400 ring-gray-300 hover:bg-gray-100">
                            🚫 Buka Pemilihan
                        </a>
                    </div>
                <?php elseif ($status === 'closed' || $status === 'draft'): ?>
                    <div class="text-right">
                        <a href="javascript:void(0)"
                            onclick="changeStatus('<?= $election['id'] ?>', 'open')"
                            class="inline-flex items-center px-3 py-2 rounded-lg ring-1 text-sm font-medium border bg-emerald-50 text-emerald-700 ring-emerald-300 hover:bg-emerald-100">
                            Buka Pemilihan
                        </a>
                    </div>
                <?php else: ?>
                    <div class="text-right">
                        <a href="javascript:void(0)"
                            onclick="changeStatus('<?= $election['id'] ?>', 'closed')"
                            class="inline-flex items-center px-3 py-2 rounded-lg ring-1 text-sm font-medium border bg-red-50 text-red-700 ring-red-300 hover:bg-red-100">
                            🚫 Tutup Pemilihan
                        </a>
                    </div>
                <?php endif; ?>

                <div class="flex flex-wrap items-center gap-2">
                    <a href="<?= site_url('election/edit/' . ($election['id'] ?? '')) ?>"
                        class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium border border-indigo-500 text-indigo-600 hover:bg-indigo-50">
                        ✏️ Edit Pemilihan
                    </a>
                </div>
            </div>
        </div>

        <!-- Data Show -->
        <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
            <div class="space-y-6">

                <!-- Informasi Pemilihan -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 space-y-3">

                        <?php if ($status === 'open'): ?>
                            <div>
                                <span href="javascript:void(0)"
                                    class="inline-flex items-center px-2 py-1 rounded-lg ring-1 text-sm font-medium border bg-green-50 text-green-700 ring-green-300 hover:bg-green-100">
                                    🚩 Pemilihan ini sedang berlangsung
                                </span>
                            </div>
                        <?php else: ?>
                            <div>
                                <a href="javascript:void(0)"
                                    class="inline-flex items-center px-2 py-1 rounded-lg ring-1 text-sm font-medium border bg-red-50 text-red-700 ring-red-300 hover:bg-red-100">
                                    🚫 Pemilihan ini tidak aktif
                                </a>
                            </div>
                        <?php endif; ?>

                        <div class="space-y-3">

                            <?php if ($electionDesc): ?>
                                <div>
                                    <p class="text-[11px] uppercase tracking-wide text-gray-400 mb-1">
                                        Deskripsi
                                    </p>
                                    <p class="text-sm text-gray-700 leading-relaxed">
                                        <?= nl2br(esc($electionDesc)) ?>
                                    </p>
                                </div>
                            <?php endif; ?>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="rounded-xl border border-dashed border-gray-200 p-3">
                                    <p class="text-[11px] uppercase tracking-wide text-gray-400 mb-1">
                                        Waktu Mulai
                                    </p>
                                    <p class="text-sm font-medium text-gray-900 flex items-center gap-2">
                                        📅 <?= esc($startAt) ?>
                                    </p>
                                </div>
                                <div class="rounded-xl border border-dashed border-gray-200 p-3">
                                    <p class="text-[11px] uppercase tracking-wide text-gray-400 mb-1">
                                        Waktu Selesai
                                    </p>
                                    <p class="text-sm font-medium text-gray-900 flex items-center gap-2">
                                        ⏰ <?= esc($endAt) ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ringkasan Angka -->
                    <div class="space-y-3">
                        <h2 class="text-sm font-semibold text-gray-900">
                            Ringkasan
                        </h2>
                        <div class="space-y-3">
                            <div class="rounded-2xl border border-gray-100 bg-slate-50 p-3">
                                <p class="text-[11px] uppercase tracking-wide text-gray-400 mb-1">
                                    Total Paslon
                                </p>
                                <p class="text-xl font-semibold text-gray-900">
                                    <?= number_format($totalCandidates, 0, ',', '.') ?>
                                </p>
                            </div>

                            <div class="rounded-2xl border border-gray-100 bg-slate-50 p-3">
                                <p class="text-[11px] uppercase tracking-wide text-gray-400 mb-1">
                                    Statistik Pemilih
                                </p>
                                <div class="space-y-1.5">
                                    <p class="text-xs text-gray-600 flex justify-between">
                                        <span>Terdaftar</span>
                                        <span class="font-medium">
                                            <?= $totalVoters !== null ? number_format($totalVoters, 0, ',', '.') : '-' ?>
                                        </span>
                                    </p>
                                    <p class="text-xs text-gray-600 flex justify-between">
                                        <span>Sudah memilih</span>
                                        <span class="font-medium">
                                            <?= $totalVoted !== null ? number_format($totalVoted, 0, ',', '.') : '-' ?>
                                        </span>
                                    </p>
                                    <?php if ($totalVoters && $totalVoted !== null): ?>
                                        <div class="mt-2">
                                            <div class="flex justify-between text-[11px] text-gray-500 mb-1">
                                                <span>Partisipasi</span>
                                                <span><?= $participationPct ?>%</span>
                                            </div>
                                            <div class="w-full h-1.5 rounded-full bg-gray-100 overflow-hidden">
                                                <div class="h-1.5 bg-emerald-500 rounded-full" style="width: <?= $participationPct ?>%;"></div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <a href="<?= site_url('election/live/' . ($election['id'] ?? '')) ?>"
                                class="inline-flex items-center justify-center w-full rounded-xl border border-indigo-500 text-indigo-600 text-sm font-medium px-3 py-2 hover:bg-indigo-50">
                                📊 Lihat Live Result Publik
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-100 pt-4 mt-2">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <h2 class="text-sm font-semibold text-gray-900">Pasangan Calon</h2>
                            <p class="text-xs text-gray-500 mt-1">
                                Daftar paslon yang berpartisipasi dalam pemilihan ini.
                            </p>
                        </div>
                        <?php if ($election['status'] == 'open'): ?>
                            <button
                                type="button"
                                onclick="Swal.fire('Pemilihan Sedang Berlangsung', 'Tidak dapat menambahkan paslon.', 'warning')"
                                class="px-4 py-2 rounded-lg cursor-block text-sm font-medium bg-gray-300 text-white hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-400">
                                Tambah Paslon
                            </button>
                        <?php else: ?>
                            <button
                                type="button"
                                id="openModal"
                                class="px-4 py-2 rounded-lg cursor-block text-sm font-medium bg-indigo-600 text-white hover:bg-indigo-700 active:outline-none active:ring-2 active:ring-indigo-700">
                                Tambah Paslon
                            </button>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($candidates)): ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4 mt-2">
                            <?php foreach ($candidates as $cg): ?>
                                <article
                                    class="relative overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition">
                                    <div class="p-4 space-y-3">
                                        <div class="flex items-center justify-between gap-2">
                                            <div class="flex items-center gap-2">
                                                <span class="inline-flex items-center justify-center h-7 px-3 rounded-full bg-slate-100 text-[11px] font-semibold text-slate-700">
                                                    <?= esc($cg['alias'] ?? 'Paslon') ?>
                                                </span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span class="inline-flex items-center justify-center h-7 px-3 rounded-full bg-green-200 text-[11px] font-semibold text-green-700">
                                                    Vote : <?= $cg['total_suara'] ?>
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Foto duo kalau ada -->
                                        <?php if (!empty($cg['cp_photo']) || !empty($cg['vcp_photo'])): ?>
                                            <div class="grid grid-cols-2 gap-2 mt-1">
                                                <?php if (!empty($cg['cp_photo'])): ?>
                                                    <img
                                                        src="<?= base_url('uploads/candidates/' . $cg['cp_photo']) ?>"
                                                        alt="Ketua"
                                                        class="h-28 w-full rounded-xl object-cover">
                                                <?php endif; ?>
                                                <?php if (!empty($cg['vcp_photo'])): ?>
                                                    <img
                                                        src="<?= base_url('uploads/candidates/' . $cg['vcp_photo']) ?>"
                                                        alt="Wakil"
                                                        class="h-28 w-full rounded-xl object-cover">
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="space-y-1">
                                            <h3 class="text-sm font-semibold text-gray-900">
                                                <?= esc(($cg['chairperson'] ?? 'Ketua') . ' & ' . ($cg['vice_chairperson'] ?? 'Wakil')) ?>
                                            </h3>
                                            <?php if (!empty($cg['vision'])): ?>
                                                <p class="text-xs text-gray-600 line-clamp-3">
                                                    <?= esc($cg['vision']) ?>
                                                </p>
                                            <?php endif; ?>
                                        </div>

                                        <div class="flex items-center justify-end gap-2">
                                            <div class="flex items-center gap-2">
                                                <?php if ($election['status'] == 'open'): ?>
                                                    <a href="javascript:void(0)" onclick="Swal.fire('Tidak Dapat Dihapus', 'Pemilihan Sedang Berlangsung', 'warning')" class="inline-flex items-center rounded-full border border-slate-300 bg-slate-100 px-3 py-1.5 text-[11px] text-gray-600">
                                                        🚫 Hapus
                                                    </a>
                                                <?php else: ?>
                                                    <a href="javascript:void(0)" onclick="deleteCandidateGroup(<?= $cg['id'] ?>)" class="delete-candidate-group inline-flex items-center justify-center h-7 px-3 rounded-full bg-red-50 hover:bg-red-100 text-[11px] font-semibold text-red-500">
                                                        Hapus
                                                    </a>
                                                <?php endif; ?>

                                            </div>
                                        </div>

                                        <?php if (isset($cg['total_suara'])): ?>
                                            <?php
                                            $votes = (int)$cg['total_suara'];
                                            $pct   = $totalVotesAll = $election['total_votes_all'] ?? null;
                                            if ($totalVotesAll === null) {
                                                // kalau belum disediakan, hitung sendiri dari $candidates
                                                $totalVotesAll = array_sum(array_map(function ($x) {
                                                    return (int)($x['total_suara'] ?? 0);
                                                }, $candidates));
                                            }
                                            $pct = $totalVotesAll > 0 ? round(($votes / $totalVotesAll) * 100) : 0;
                                            ?>
                                            <div class="mt-3 space-y-1">
                                                <div class="flex items-center justify-between text-[11px] text-gray-500">
                                                    <span>Perolehan sementara</span>
                                                    <span class="tabular-nums">
                                                        <?= number_format($votes, 0, ',', '.') ?> suara (<?= $pct ?>%)
                                                    </span>
                                                </div>
                                                <div class="h-1.5 w-full rounded-full bg-slate-100 overflow-hidden">
                                                    <div class="h-1.5 rounded-full bg-emerald-500" style="width: <?= $pct ?>%;"></div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-sm text-gray-500">
                            Belum ada pasangan calon yang terdaftar untuk pemilihan ini.
                        </p>
                    <?php endif; ?>
                </div>

            </div>
        </section>
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
            <input type="hidden" name="election-id" value="<?= $election['id'] ?>">
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
    const base_url = "<?= base_url() ?>";

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

    function deleteCandidateGroup(id) {
        Swal.fire({
            title: 'Hapus Pasangan Calon?',
            text: "Anda yakin ingin menghapus Paslon ini?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `${base_url}/admin/candidate-group/delete/${id}`;
            }
        })
    }

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