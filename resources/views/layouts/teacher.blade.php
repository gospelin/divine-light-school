<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Teacher Portal') | Divine Light School</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600|playfair-display:700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/heroicons/2.1.1/heroicons.min.js"></script>

<style>
   :root {
            --primary: #0f172a;        /* Deep slate navy - elegant, professional */
            --primary-light: #1e293b;
            --accent: #7f1d1d;         /* Rich maroon - school prestige */
            --accent-hover: #991b1b;
            --accent-light: #fef2f2;  /* Soft red background */
            --success: #059669;        /* Emerald green */
            --info: #1e40af;           /* Deep blue */
            --gray-100: #f3f4f6;
            --gray-200: #e5e7eb;
            --gray-700: #374151;
            --gray-800: #1f2937;
        }

    body {
        font-family: 'Playfair Display', sans-serif;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: 'Playfair Display', serif;
        font-weight: 700;
    }

    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f8fafc;
    }

    ::-webkit-scrollbar-thumb {
        background: var(--primary-light);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--accent);
    }
</style>

    @stack('styles')
</head>

<body class="antialiased bg-gray-50 text-gray-800" x-data="{ sidebarOpen: true }">

    <!-- Toast Container -->
    <div id="toast-container" class="fixed top-20 right-6 z-50 space-y-4"></div>

    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="bg-white border-b border-gray-200 fixed top-0 left-0 right-0 z-40 shadow-sm">
            <div class="flex items-center justify-between px-6 py-4">
                <div class="flex items-center gap-6">
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </button>
                    <a href="{{ route('teacher.dashboard') }}" class="flex items-center gap-4">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12">
                        <div>
                            <h1 class="text-2xl font-bold" style="color: var(--primary)">Divine Light</h1>
                            <p class="text-xs text-gray-500 -mt-1">Teacher Portal</p>
                        </div>
                    </a>
                </div>

                <div class="flex items-center gap-4">
                    <div class="hidden md:flex items-center gap-3">
                        <span class="text-sm text-gray-600">Session:</span>
                        <strong class="text-sm font-medium">{{ $currentSessionName }}</strong>
                    </div>

                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-3 hover:bg-gray-100 rounded-lg px-3 py-2 transition">
                            <img src="{{ asset('images/avatar.jpg') }}" alt="Profile" class="w-10 h-10 rounded-full ring-2 ring-gray-200">
                            <div class="text-left hidden md:block">
                                <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500">Teacher</p>
                            </div>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-2">
                            <a href="#" class="block px-4 py-2.5 hover:bg-gray-50">My Profile</a>
                            <hr class="my-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2.5 hover:bg-gray-50 text-red-600">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-30 w-72 bg-white border-r border-gray-200 shadow-lg transform transition-transform duration-300 pt-20 overflow-y-auto lg:translate-x-0">
            <nav class="p-6">
                <ul class="space-y-8">
                    <li>
                        <h6 class="text-xs font-semibold uppercase text-gray-500 tracking-wider mb-3">Main</h6>
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ route('teacher.dashboard') }}"
                                    class="flex items-center gap-4 px-4 py-3 rounded-lg hover:bg-gray-100 transition {{ request()->routeIs('teacher.dashboard') ? 'bg-gray-100 font-medium' : 'text-gray-700' }}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                    Dashboard
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <h6 class="text-xs font-semibold uppercase text-gray-500 tracking-wider mb-3">My Classes</h6>
                         <ul class="space-y-1">
                            @if(auth()->user()->teacher?->currentClasses->count())
                                @foreach($teacherClasses as $class)
                                    <li>
                                        <a href="{{ route('teacher.classes.show', $class) }}" class="flex items-center gap-4 px-4 py-3 rounded-lg hover:bg-gray-100 transition text-gray-700">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M3 10V7a1 1 0 011-1h16a1 1 0 011 1v3" />
                                            </svg>
                                            {{ $class->display_name }}
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <li class="text-gray-500 text-sm px-4">No classes assigned</li>
                            @endif
                        </ul> 
                    </li>

                    <li>
                        <h6 class="text-xs font-semibold uppercase text-gray-500 tracking-wider mb-3">Tools</h6>
                        <ul class="space-y-1">
                            <li><a href="#" class="flex items-center gap-4 px-4 py-3 rounded-lg hover:bg-gray-100 transition text-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg> Take Attendance</a></li>
                            <li><a href="#" class="flex items-center gap-4 px-4 py-3 rounded-lg hover:bg-gray-100 transition text-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2" />
                                </svg> Enter Results</a></li>
                            <li><a href="#" class="flex items-center gap-4 px-4 py-3 rounded-lg hover:bg-gray-100 transition text-gray-700">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 17v-2m3 2v-2m3 2v-2m3-6V5a2 2 0 00-2-2H6a2 2 0 00-2 2v14a2 2 0 002 2h12a2 2 0 002-2v-4" />
                                </svg> View Reports</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 mt-16 lg:ml-72 p-8">
            @yield('content')
        </main>

        <!-- Mobile Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-20 lg:hidden"></div>
    </div>

    @stack('scripts')
    <script>
        // Same toast script as admin
        document.addEventListener('DOMContentLoaded', function () {
            function showToast(message, type = 'success') {
                // ... (same as admin layout)
                // Copy the full toast script from admin layout here
            }

            @if(session('success')) showToast("{{ session('success') }}", 'success'); @endif
            @if(session('error')) showToast("{{ session('error') }}", 'error'); @endif
            @if(session('info')) showToast("{{ session('info') }}", 'info'); @endif
            @if(session('warning')) showToast("{{ session('warning') }}", 'warning'); @endif
        });
    </script>
</body>
</html>