<?php
// Biar jumlah page di sekitar current gak terlalu rame
$pager->setSurroundCount(2);
?>

<div class="inline-flex items-center space-x-1 text-xs">
    <!-- Tombol Sebelumnya -->
    <?php if ($pager->hasPrevious()) : ?>
        <a href="<?= $pager->getPreviousPage(); ?>"
            class="px-2 py-1 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
            ‹ Sebelumnya
        </a>
    <?php else : ?>
        <span class="px-2 py-1 rounded-lg border border-gray-200 text-gray-400 cursor-not-allowed">
            ‹ Sebelumnya
        </span>
    <?php endif; ?>

    <!-- Nomor halaman -->
    <?php foreach ($pager->links() as $link) : ?>
        <?php if ($link['active']) : ?>
            <span
                class="px-2.5 py-1 rounded-lg border border-gray-900 bg-gray-900 text-white">
                <?= $link['title']; ?>
            </span>
        <?php else : ?>
            <a href="<?= $link['uri']; ?>"
                class="px-2.5 py-1 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
                <?= $link['title']; ?>
            </a>
        <?php endif; ?>
    <?php endforeach; ?>

    <!-- Tombol Berikutnya -->
    <?php if ($pager->hasNext()) : ?>
        <a href="<?= $pager->getNextPage(); ?>"
            class="px-2 py-1 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
            Berikutnya ›
        </a>
    <?php else : ?>
        <span class="px-2 py-1 rounded-lg border border-gray-200 text-gray-400 cursor-not-allowed">
            Berikutnya ›
        </span>
    <?php endif; ?>
</div>