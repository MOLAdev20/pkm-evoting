<?php $this->extend('main_layout') ?>

<?php $this->section('header') ?>
<title>Dashboard | Admin OSIS</title>
<?php $this->endSection() ?>

<?php
// Contoh fallback kalau variabel belum diset (biar view nggak error)
$activeElection   = $activeElection   ?? null; // ['name' => '...', 'status' => 'open', 'start_at' => ..., 'end_at' => ...]
$stats            = $stats            ?? [];   // ['total_students' => 0, 'voted' => 0, 'not_voted' => 0, 'total_candidates' => 0]
$candidates       = $candidates       ?? [];   // list paslon + total suara
$classStats       = $classStats       ?? [];   // partisipasi per kelas
$activityLogs     = $activityLogs     ?? [];   // aktivitas terbaru

$totalStudents    = $stats['total_students']    ?? 0;
$totalVoted       = $stats['voted']             ?? 0;
$totalNotVoted    = $stats['not_voted']         ?? max(0, $totalStudents - $totalVoted);
$totalCandidates  = $stats['total_candidates']  ?? count($candidates);

$participationPct = $totalStudents > 0 ? round(($totalVoted / $totalStudents) * 100) : 0;

// hitung total suara sah dari candidates
$totalVotesAll = array_sum(array_map(function ($c) {
    return (int)($c['total_suara'] ?? 0);
}, $candidates));

// CSS badge status election
$electionStatusLabel = 'Tidak ada pemilihan aktif';
$electionStatusClass = 'bg-gray-100 text-gray-700';

if ($activeElection) {
    switch ($activeElection['status']) {
        case 'draft':
            $electionStatusLabel = 'Persiapan';
            $electionStatusClass = 'bg-yellow-50 text-yellow-700';
            break;
        case 'open':
            $electionStatusLabel = 'Sedang Berlangsung';
            $electionStatusClass = 'bg-emerald-50 text-emerald-700';
            break;
        case 'closed':
        case 'done':
            $electionStatusLabel = 'Selesai';
            $electionStatusClass = 'bg-slate-100 text-slate-700';
            break;
    }
}
?>

<?php $this->section('content') ?>
<main class="flex-1 overflow-y-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">

        <!-- PAGE HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Dashboard Admin</h1>
                <p class="text-sm text-gray-500 mt-1">
                    Ringkasan pemilihan Ketua & Wakil Ketua OSIS.
                </p>
                <?php if ($activeElection): ?>
                    <p class="mt-1 text-xs text-gray-400">
                        <?= esc($activeElection['name'] ?? 'Pemilihan OSIS') ?>
                    </p>
                <?php endif; ?>
            </div>

            <div class="flex flex-wrap items-center gap-3 justify-between sm:justify-end">
                <!-- Status Election -->
                <div class="text-right space-y-1">
                    <p class="text-xs text-gray-500">Status Pemilihan</p>
                    <span class="inline-flex items-center gap-1 rounded-full px-2.5 py-1 text-xs font-medium <?= $electionStatusClass ?>">
                        <span class="h-1.5 w-1.5 rounded-full bg-current"></span>
                        <?= esc($electionStatusLabel) ?>
                    </span>
                </div>

                <!-- Timer -->
                <div class="text-right space-y-1">
                    <p class="text-xs text-gray-500">Sisa Waktu</p>
                    <p id="timer" class="font-mono text-sm font-semibold text-gray-900">
                        --
                    </p>
                    <p id="pollStatus" class="text-[11px] text-gray-400"></p>
                </div>

                <!-- Refresh Button -->
                <button
                    type="button"
                    id="btnRefreshDashboard"
                    class="inline-flex items-center px-3 py-2 rounded-lg text-sm font-medium border border-gray-300 text-gray-700 hover:bg-gray-50">
                    ⟳ Refresh Data
                </button>
            </div>
        </div>

        <!-- STAT CARDS -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <!-- Total Siswa -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500">Total Siswa</p>
                        <p class="mt-1 text-2xl font-semibold text-gray-900">
                            <?= number_format($totalStudents, 0, ',', '.') ?>
                        </p>
                        <p class="mt-1 text-[11px] text-gray-400">Pemilih terdaftar</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-lg">
                        👥
                    </div>
                </div>
            </div>

            <!-- Sudah Memilih -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500">Sudah Memilih</p>
                        <p class="mt-1 text-2xl font-semibold text-emerald-600">
                            <?= number_format($totalVoted, 0, ',', '.') ?>
                        </p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-lg">
                        ✅
                    </div>
                </div>
                <div class="mt-3">
                    <div class="flex justify-between text-xs text-gray-500 mb-1">
                        <span>Partisipasi</span>
                        <span><?= $participationPct ?>%</span>
                    </div>
                    <div class="w-full h-1.5 rounded-full bg-gray-100 overflow-hidden">
                        <div class="h-1.5 bg-emerald-500 rounded-full" style="width: <?= $participationPct ?>%;"></div>
                    </div>
                </div>
            </div>

            <!-- Belum Memilih -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500">Belum Memilih</p>
                        <p class="mt-1 text-2xl font-semibold text-orange-500">
                            <?= number_format($totalNotVoted, 0, ',', '.') ?>
                        </p>
                        <p class="mt-1 text-[11px] text-gray-400">Butuh follow-up</p>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center text-lg">
                        ⏳
                    </div>
                </div>
            </div>

            <!-- Jumlah Kandidat -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-gray-500">Jumlah Kandidat</p>
                        <p class="mt-1 text-2xl font-semibold text-gray-900">
                            <?= number_format($totalCandidates, 0, ',', '.') ?>
                        </p>
                        <?php if ($totalCandidates > 0): ?>
                            <p class="mt-1 text-[11px] text-gray-400">Paslon terdaftar</p>
                        <?php else: ?>
                            <p class="mt-1 text-[11px] text-red-500">Belum ada paslon</p>
                        <?php endif; ?>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center text-lg">
                        🎓
                    </div>
                </div>
            </div>
        </section>

        <!-- MAIN GRID: HASIL SUARA & PARTISIPASI -->
        <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- PEROLEHAN SUARA PER PASLON -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-sm font-semibold text-gray-900">Perolehan Suara Sementara</h2>
                        <p class="text-xs text-gray-500 mt-1">
                            Rekap suara sah berdasarkan data realtime.
                        </p>
                    </div>
                    <div class="text-right text-xs text-gray-500">
                        <p id="totalVotes">
                            Total suara terekam:
                            <?= number_format($totalVotesAll, 0, ',', '.') ?>
                        </p>
                        <p id="lastUpdate" class="mt-1">
                            Pembaruan terakhir: -
                        </p>
                    </div>
                </div>

                <?php if (!empty($candidates)): ?>
                    <div class="space-y-3">
                        <?php foreach ($candidates as $c):
                            $id   = $c['id'];
                            $name = ($c['chairperson'] ?? '') . ' &amp; ' . ($c['vice_chairperson'] ?? '');
                            $alias = $c['alias'] ?? ('Paslon ' . $id);
                            $votes = (int)($c['total_suara'] ?? 0);
                            $pct   = $totalVotesAll > 0 ? round(($votes / $totalVotesAll) * 100) : 0;
                        ?>
                            <div
                                class="rounded-xl border border-slate-100 p-3 hover:bg-slate-50 transition"
                                data-candidate-id="<?= esc($id) ?>">
                                <div class="mb-1 flex items-center justify-between text-sm">
                                    <div class="flex items-center gap-2">
                                        <span class="inline-flex items-center justify-center h-6 w-6 rounded-full bg-slate-100 text-[11px] font-semibold text-slate-700">
                                            <?= esc($alias) ?>
                                        </span>
                                        <span class="text-gray-800">
                                            <?= esc($c['chairperson'] . ' & ' . $c['vice_chairperson']) ?>
                                        </span>
                                    </div>
                                    <div class="text-right">
                                        <p class="tabular-nums text-sm font-semibold" data-role="votes">
                                            <?= number_format($votes, 0, ',', '.') ?> suara
                                        </p>
                                        <p class="text-[11px] text-gray-500" data-role="percent">
                                            <?= $pct ?>%
                                        </p>
                                    </div>
                                </div>
                                <div class="h-2 w-full overflow-hidden rounded bg-slate-100">
                                    <div
                                        class="h-2 bg-emerald-500 rounded"
                                        data-role="bar"
                                        style="width: <?= $pct ?>%;"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-sm text-gray-500">Belum ada data perolehan suara.</p>
                <?php endif; ?>
            </div>

            <!-- PARTISIPASI PER KELAS / ROMBEL -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-sm font-semibold text-gray-900">Partisipasi per Kelas</h2>
                        <p class="text-xs text-gray-500 mt-1">
                            Bantu pantau kelas mana yang perlu diingatkan.
                        </p>
                    </div>
                </div>

                <?php if (!empty($classStats)): ?>
                    <div class="space-y-3 max-h-80 overflow-y-auto pr-1">
                        <?php foreach ($classStats as $row):
                            // row: ['class_name' => 'XI IPA 1', 'voted' => 30, 'total' => 36]
                            $className = $row['class_name'] ?? 'Kelas';
                            $votedCls  = (int)($row['voted'] ?? 0);
                            $totalCls  = (int)($row['total'] ?? 0);
                            $pctCls    = $totalCls > 0 ? round(($votedCls / $totalCls) * 100) : 0;
                        ?>
                            <div>
                                <div class="flex items-center justify-between text-xs mb-1">
                                    <span class="font-medium text-gray-800"><?= esc($className) ?></span>
                                    <span class="tabular-nums text-gray-600">
                                        <?= $votedCls ?>/<?= $totalCls ?> (<?= $pctCls ?>%)
                                    </span>
                                </div>
                                <div class="h-1.5 w-full rounded-full bg-gray-100 overflow-hidden">
                                    <div class="h-1.5 rounded-full bg-indigo-500" style="width: <?= $pctCls ?>%;"></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-sm text-gray-500">
                        Data partisipasi per kelas belum tersedia.
                    </p>
                <?php endif; ?>
            </div>
        </section>

        <!-- AKTIVITAS TERBARU & AKSI CEPAT -->
        <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Aktivitas Terbaru -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-sm font-semibold text-gray-900">Aktivitas Terbaru</h2>
                    <p class="text-xs text-gray-500">
                        Log singkat aktivitas sistem.
                    </p>
                </div>

                <?php if (!empty($activityLogs)): ?>
                    <ul class="divide-y divide-gray-100">
                        <?php foreach ($activityLogs as $log): ?>
                            <li class="py-2.5 flex items-start gap-3 text-sm">
                                <div class="mt-0.5 h-2 w-2 rounded-full bg-emerald-400"></div>
                                <div class="flex-1">
                                    <p class="text-gray-800">
                                        <?= esc($log['message'] ?? '-') ?>
                                    </p>
                                    <p class="mt-0.5 text-xs text-gray-400">
                                        <?= esc($log['created_at'] ?? '') ?>
                                    </p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-sm text-gray-500">
                        Belum ada aktivitas yang tercatat.
                    </p>
                <?php endif; ?>
            </div>

            <!-- Aksi Cepat -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                <h2 class="text-sm font-semibold text-gray-900 mb-3">Aksi Cepat</h2>
                <div class="space-y-2">
                    <a href="<?= site_url('election') ?>"
                        class="flex items-center justify-between rounded-xl border border-gray-100 px-3 py-2 text-sm hover:bg-gray-50">
                        <span>Kelola Pemilihan</span>
                        <span class="text-xs text-gray-400">Lihat & edit</span>
                    </a>
                    <a href="<?= site_url('candidates') ?>"
                        class="flex items-center justify-between rounded-xl border border-gray-100 px-3 py-2 text-sm hover:bg-gray-50">
                        <span>Kelola Kandidat</span>
                        <span class="text-xs text-gray-400">Tambah / ubah</span>
                    </a>
                    <a href="<?= site_url('students') ?>"
                        class="flex items-center justify-between rounded-xl border border-gray-100 px-3 py-2 text-sm hover:bg-gray-50">
                        <span>Kelola Data Siswa</span>
                        <span class="text-xs text-gray-400">Import / sinkron</span>
                    </a>
                    <a href="<?= site_url('reports') ?>"
                        class="flex items-center justify-between rounded-xl border border-gray-100 px-3 py-2 text-sm hover:bg-gray-50">
                        <span>Unduh Laporan</span>
                        <span class="text-xs text-gray-400">PDF / Excel</span>
                    </a>
                </div>
            </div>
        </section>

    </div>
</main>
<?php $this->endSection() ?>