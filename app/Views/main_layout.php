<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->renderSection('header') ?>
    <link rel="shortcut icon" href="<?= base_url('assets/favicon.ico') ?>" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-800 font-sans h-screen">

    <div class="h-full min-h-screen flex flex-col">

        <?= $this->include('partials/topbar') ?>

        <div class="flex flex-1 overflow-hidden">
            <?= $this->include('partials/sidebar') ?>

            <?= $this->renderSection('content') ?>
        </div>

    </div>

    <?= $this->renderSection('modal') ?>

    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    <?= $this->renderSection('script') ?>

</body>