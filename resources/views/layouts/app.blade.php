<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kurikulum OBE') | Teknik Komputer</title>

    <!-- Tailwind via CDN (ganti dengan build Vite untuk production) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        navy: {
                            50: '#eef2f9',
                            100: '#d7e0f0',
                            200: '#b0c1e0',
                            300: '#84a0cd',
                            400: '#5c81ba',
                            500: '#3d63a0',
                            600: '#2d4c80',
                            700: '#233c65',
                            800: '#1a2d4c',
                            900: '#111d33',
                            950: '#0a1120',
                        },
                        amber: {
                            500: '#d99a2b',
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'ui-sans-serif', 'system-ui'],
                        serif: ['"Source Serif 4"', 'ui-serif', 'Georgia'],
                    },
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Source+Serif+4:wght@600;700&display=swap" rel="stylesheet">

    <!-- Alpine.js untuk interaksi sidebar -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @stack('styles')
</head>

<body class="h-full bg-slate-50 font-sans text-slate-800 antialiased">
    <div class="flex h-full min-h-screen">

        <!-- Overlay mobile -->
        <div
            x-show="sidebarOpen"
            x-transition:enter="transition-opacity ease-linear duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-linear duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="sidebarOpen = false"
            class="fixed inset-0 z-30 bg-navy-950/50 lg:hidden"
            style="display: none;"></div>

        <!-- Sidebar -->
        <aside
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-40 flex w-72 flex-col bg-navy-900 transition-transform duration-200 ease-in-out lg:static lg:translate-x-0">
            <!-- Brand -->
            <div class="flex h-16 shrink-0 items-center gap-3 border-b border-white/10 px-6">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-amber-500 font-serif text-lg font-bold text-navy-950">
                    K
                </div>
                <div class="leading-tight">
                    <p class="font-serif text-sm font-semibold text-white">Kurikulum OBE</p>
                    <p class="text-xs text-navy-300">Program Studi</p>
                </div>
            </div>

            <!-- Menu -->
            <nav class="flex-1 space-y-6 overflow-y-auto px-4 py-6">

                <div>
                    <p class="px-2 pb-2 text-xs font-semibold uppercase tracking-wider text-navy-400">Kurikulum</p>
                    <ul class="space-y-1">
                        @php
                        $menu = [
                        ['label' => 'Profil Lulusan', 'route' => 'profil-lulusan', 'icon' => 'user'],
                        ['label' => 'CPL', 'route' => 'cpl', 'icon' => 'target'],
                        ['label' => 'Bahan Kajian', 'route' => 'bahan-kajian.index', 'icon' => 'book'],
                        ['label' => 'Matakuliah', 'route' => 'matakuliah.index', 'icon' => 'book'],
                        ];
                        @endphp

                        @foreach ($menu as $item)
                        @php
                        $isActive = request()->routeIs($item['route']);
                        @endphp
                        <li>
                            <a
                                href="{{ route($item['route']) }}"
                                class="group flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition
                                {{ $isActive
                                    ? 'bg-navy-700/60 text-white'
                                    : 'text-navy-200 hover:bg-navy-800 hover:text-white' }}">
                                <span class="flex h-5 w-5 shrink-0 items-center justify-center {{ $isActive ? 'text-amber-500' : 'text-navy-400 group-hover:text-amber-500' }}">
                                    @switch($item['icon'])
                                    @case('user')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                    @break
                                    @case('target')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                    </svg>
                                    @break
                                    @case('book')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                    </svg>
                                    @break
                                    @case('book')
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" class="h-5 w-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                                    </svg>
                                    @break
                                    @endswitch
                                </span>
                                {{ $item['label'] }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </nav>

            <!-- User -->
            <div class="border-t border-white/10 p-4">
                <div class="flex items-center gap-3 rounded-lg px-2 py-2">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-navy-700 text-sm font-semibold text-white">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm font-medium text-white">{{ auth()->user()->name ?? 'Admin Prodi' }}</p>
                        <p class="truncate text-xs text-navy-400">{{ auth()->user()->email ?? 'admin@kampus.ac.id' }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main -->
        <div class="flex min-w-0 flex-1 flex-col">

            <!-- Topbar -->
            <header class="flex h-16 shrink-0 items-center justify-between border-b border-slate-200 bg-white px-4 sm:px-6">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = true" class="rounded-md p-2 text-slate-500 hover:bg-slate-100 lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                    <h1 class="font-serif text-lg font-semibold text-navy-900">@yield('page-title', 'Dashboard')</h1>
                </div>

                <div class="flex items-center gap-4">
                    <span class="hidden text-sm text-slate-500 sm:block">{{ now()->translatedFormat('l, d F Y') }}</span>
                </div>
            </header>

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                @if (session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                    {{ session('success') }}
                </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>

</html>