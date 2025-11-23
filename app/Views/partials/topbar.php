<header class="bg-white border-b border-gray-200">
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Left: Logo + Burger -->
            <div class="flex items-center space-x-3">
                <!-- Hamburger (mobile) -->
                <button
                    id="sidebarToggle"
                    class="md:hidden inline-flex items-center justify-center p-2 rounded-lg border border-gray-200 hover:border-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    aria-label="Toggle sidebar">
                    <span class="sr-only">Buka menu</span>
                    <!-- Icon burger -->
                    <div class="space-y-0.5">
                        <span class="block w-4 h-0.5 bg-gray-800"></span>
                        <span class="block w-4 h-0.5 bg-gray-800"></span>
                        <span class="block w-4 h-0.5 bg-gray-800"></span>
                    </div>
                </button>

                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <div class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-indigo-600 text-white font-bold">
                        O
                    </div>
                    <div class="flex flex-col leading-tight">
                        <span class="font-semibold text-gray-900">OSIS Admin</span>
                        <span class="text-xs text-gray-500">SMP Contoh</span>
                    </div>
                </div>
            </div>

            <!-- Right: Profile menu -->
            <div class="flex items-center space-x-4">
                <!-- Bisa ditambah notifikasi, dll -->
                <button
                    class="flex items-center space-x-3 rounded-full px-3 py-1.5 hover:bg-gray-50 border border-gray-200">
                    <div class="hidden sm:block text-right">
                        <div class="text-sm font-medium text-gray-900">Admin OSIS</div>
                        <div class="text-xs text-gray-500">admin@smp.sch.id</div>
                    </div>
                    <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center text-white text-sm font-semibold">
                        A
                    </div>
                </button>
            </div>
        </div>
    </div>
</header>