<!-- SIDEBAR BACKDROP (mobile) -->
<div id="sidebarBackdrop" class="fixed inset-0 bg-black bg-opacity-40 z-20 hidden md:hidden transition-opacity duration-200"></div>

<?php
$uri = service('uri');
?>
<aside
    id="sidebar"
    class="fixed inset-y-0 left-0 z-30 w-64 transform -translate-x-full md:translate-x-0 md:static md:inset-auto md:z-auto bg-white border-r border-gray-200 shadow-lg md:shadow-none transition-transform duration-300 ease-in-out">
    <div class="h-full flex flex-col">
        <!-- Sidebar header (mobile) -->
        <div class="flex items-center justify-between px-4 py-3 md:hidden border-b border-gray-200">
            <span class="font-semibold text-gray-800">Navigasi</span>
            <button
                id="sidebarClose"
                class="inline-flex items-center justify-center p-2 rounded-lg border border-gray-200 hover:bg-gray-50">
                ✖
            </button>
        </div>


        <!-- Menu -->
        <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto text-sm">
            <a
                href="#"
                class="flex items-center px-3 py-2 rounded-lg font-medium text-gray-900 <?= $uri->getSegment(2) == 'dashboard' ? 'bg-gray-100' : '' ?> hover:bg-gray-50 hover:text-gray-900">
                <span class="mr-2">🏠</span>
                <span>Dashboard</span>
            </a>

            <a
                href="<?= base_url('admin/election') ?>"
                class="flex items-center px-3 py-2 rounded-lg font-medium text-gray-600 <?= $uri->getSegment(2) == 'election' ? 'bg-gray-100 border-l-4 border-indigo-500' : '' ?> hover:bg-gray-50 hover:text-gray-900">
                <span class="mr-2">🗳️</span>
                <span>Pemilihan</span>
            </a>

            <a
                href="<?= base_url('admin/candidate') ?>"
                class="flex items-center px-3 py-2 rounded-lg font-medium text-gray-600 <?= $uri->getSegment(2) == 'candidate' ? 'bg-gray-100 border-l-4 border-indigo-500' : '' ?> hover:bg-gray-50 hover:text-gray-900">
                <span class="mr-2">👥</span>
                <span>Daftar Kandidat</span>
            </a>

            <a
                href="<?= base_url('admin/candidate-group') ?>"
                class="flex items-center px-3 py-2 rounded-lg font-medium text-gray-600 <?= $uri->getSegment(2) == 'candidate-group' ? 'bg-gray-100 border-l-4 border-indigo-500' : '' ?> hover:bg-gray-50 hover:text-gray-900">
                <span class="mr-2">👨‍👩‍👧‍👦</span>
                <span>Daftar Paslon</span>
            </a>

            <a
                href="<?= base_url('admin/participant') ?>"
                class="flex items-center px-3 py-2 rounded-lg font-medium text-gray-600 <?= $uri->getSegment(2) == 'participant' ? 'bg-gray-100 border-l-4 border-indigo-500' : '' ?> hover:bg-gray-50 hover:text-gray-900">
                <span class="mr-2">👥</span>
                <span>Daftar Siswa</span>
            </a>

            <!-- Menu dengan Submenu -->
            <div class="pt-2">
                <button
                    type="button"
                    class="w-full flex items-center justify-between px-3 py-2 rounded-lg font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900"
                    data-submenu-toggle="#submenu-master">
                    <span class="flex items-center">
                        <span class="mr-2">📊</span>
                        <span>Data Master</span>
                    </span>
                    <span class="text-xs text-gray-400" data-submenu-arrow>▼</span>
                </button>
                <div id="submenu-master" class="mt-1 ml-7 space-y-1 hidden">
                    <a
                        href="#"
                        class="flex items-center px-3 py-1.5 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                        <span class="mr-2">👥</span>
                        <span>Data Siswa</span>
                    </a>
                    <a
                        href="#"
                        class="flex items-center px-3 py-1.5 rounded-lg text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                        <span class="mr-2">🎓</span>
                        <span>Data Kandidat</span>
                    </a>
                </div>
            </div>

            <a
                href="#"
                class="flex items-center px-3 py-2 rounded-lg font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                <span class="mr-2">⚙️</span>
                <span>Pengaturan</span>
            </a>

            <a
                href="#"
                class="flex items-center px-3 py-2 rounded-lg font-medium text-gray-600 hover:bg-gray-50 hover:text-gray-900">
                <span class="mr-2">📄</span>
                <span>Laporan</span>
            </a>
        </nav>

        <!-- Footer -->
        <div class="px-4 py-3 border-t border-gray-200 text-xs text-gray-500">
            © 2025 OSIS SMP. All rights reserved.
        </div>
    </div>
</aside>