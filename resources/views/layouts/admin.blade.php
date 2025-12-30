<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') | Divine Light School</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600|playfair-display:700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/heroicons/2.1.1/heroicons.min.js"></script>

    <style>
        :root {
            --primary: #0f172a;
            /* Deep slate navy */
            --primary-light: #1e293b;
            --accent: #7f1d1d;
            /* Deep maroon */
            --accent-hover: #991b1b;
            --gray-border: #e2e8f0;
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
</head>

<body class="antialiased bg-gray-50 text-gray-800" x-data="{ sidebarOpen: true, darkMode: false }"
    :class="{'dark bg-gray-900 text-gray-100': darkMode}">

    <!-- Toast Notification Container -->
    <div id="toast-container" class="fixed top-20 right-6 z-50 space-y-4">
        <!-- Toasts will be injected here by Alpine.js -->
    </div>

    <div class="min-h-screen flex flex-col">
        <!-- Header / Topbar -->
        <header class="bg-white border-b border-gray-200 fixed top-0 left-0 right-0 z-40 shadow-sm">
            <div class="flex items-center justify-between px-6 py-4">
                <!-- Left -->
                <div class="flex items-center gap-6">
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                    </button>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12">
                        <div>
                            <h1 class="text-2xl font-bold" style="color: var(--primary)">Divine Light</h1>
                            <p class="text-xs text-gray-500 -mt-1">School Administration</p>
                        </div>
                    </a>
                </div>

                <!-- Right -->
                <div class="flex items-center gap-4">
                    <div class="hidden md:flex items-center gap-3">
                        <span class="text-sm text-gray-600">Academic Session:</span>
                        <strong class="text-sm font-medium">
                            {{ $currentSessionName }}
                        </strong>
                        @if($isPersonalSessionView)
                            <span class="text-xs bg-amber-100 text-amber-800 px-2 py-1 rounded-full">Personal View</span>
                        @endif
                        <a href="{{ route('admin.sessions.index') }}" class="text-xs text-blue-600 hover:underline">
                            Change
                        </a>
                    </div>

                    <!-- Notifications -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="relative p-2 rounded-lg hover:bg-gray-100 transition">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 00-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-red-500 rounded-full"></span>
                        </button>
                    </div>

                    <!-- Profile -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                            class="flex items-center gap-3 hover:bg-gray-100 rounded-lg px-3 py-2 transition">
                            <img src="{{ asset('images/avatar.jpg') }}" alt="Profile"
                                class="w-10 h-10 rounded-full ring-2 ring-gray-200">
                            <div class="text-left hidden md:block">
                                <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                        </button>
                        <div x-show="open" @click.away="open = false"
                            class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 py-2">
                            <a href="#" class="block px-4 py-2.5 hover:bg-gray-50">My Profile</a>
                            <a href="#" class="block px-4 py-2.5 hover:bg-gray-50">Settings</a>
                            <hr class="my-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2.5 hover:bg-gray-50 text-red-600">Logout</button>
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
                                <a href="{{ route('admin.dashboard') }}"
                                    class="flex items-center gap-4 px-4 py-3 rounded-lg hover:bg-gray-100 transition {{ request()->routeIs('admin.dashboard') ? 'bg-var(--primary-light) text-gray-900 hover:bg-var(--primary)' : 'text-gray-700' }}">
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
                        <h6 class="text-xs font-semibold uppercase text-gray-500 tracking-wider mb-3">People</h6>
                        <ul class="space-y-1">
                            <li><a href="{{ route('admin.students.index') }}"
                                    class="flex items-center gap-4 px-4 py-3 rounded-lg hover:bg-gray-100 transition text-gray-700"><svg
                                        class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg> Students</a></li>
                            <li><a href="{{ route('admin.promotions.index') }}"
                                    class="flex items-center gap-4 px-4 py-3 rounded-lg hover:bg-gray-100 transition text-gray-700">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg> Promotion Tool</a></li>
                            <li><a href="{{ route('admin.teachers.index') }}"
                                    class="flex items-center gap-4 px-4 py-3 rounded-lg hover:bg-gray-100 transition text-gray-700"><svg
                                        class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg> Teachers & Staff</a></li>
                            <li><a href="#"
                                    class="flex items-center gap-4 px-4 py-3 rounded-lg hover:bg-gray-100 transition text-gray-700"><svg
                                        class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 14h.01M9 14h.01M5 10h14M5 18h14" />
                                    </svg> Parents</a></li>
                        </ul>
                    </li>

                    <li>
                        <h6 class="text-xs font-semibold uppercase text-gray-500 tracking-wider mb-3">Academics</h6>
                        <ul class="space-y-1">
                            <li><a href="{{ route('admin.classes.index') }}"
                                    class="flex items-center gap-4 px-4 py-3 rounded-lg hover:bg-gray-100 transition text-gray-700"><svg
                                        class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M3 10V7a1 1 0 011-1h16a1 1 0 011 1v3" />
                                    </svg> Classes & Sections</a></li>
                            <li><a href="#"
                                    class="flex items-center gap-4 px-4 py-3 rounded-lg hover:bg-gray-100 transition text-gray-700"><svg
                                        class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg> Attendance</a></li>
                            <li><a href="#"
                                    class="flex items-center gap-4 px-4 py-3 rounded-lg hover:bg-gray-100 transition text-gray-700"><svg
                                        class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2" />
                                    </svg> Examinations</a></li>
                        </ul>
                    </li>

                    <li>
                        <h6 class="text-xs font-semibold uppercase text-gray-500 tracking-wider mb-3">Media &
                            Communication</h6>
                        <ul class="space-y-1">
                            <li><a href="{{ route('admin.blog.index') }}"
                                    class="flex items-center gap-4 px-4 py-3 rounded-lg hover:bg-gray-100 transition text-gray-700"><svg
                                        class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg> Blog & News</a></li>
                            <li><a href="{{ route('admin.events.index') }}"
                                    class="flex items-center gap-4 px-4 py-3 rounded-lg hover:bg-gray-100 transition text-gray-700"><svg
                                        class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg> Events</a></li>
                            <li><a href="{{ route('admin.gallery.index') }}"
                                    class="flex items-center gap-4 px-4 py-3 rounded-lg hover:bg-gray-100 transition text-gray-700"><svg
                                        class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg> Gallery</a></li>
                        </ul>
                    </li>

                    <li>
                        <h6 class="text-xs font-semibold uppercase text-gray-500 tracking-wider mb-3">Finance</h6>
                        <ul class="space-y-1">
                            <li><a href="{{ route('admin.fees.index') }}"
                                    class="flex items-center gap-4 px-4 py-3 rounded-lg hover:bg-gray-100 transition text-gray-700"><svg
                                        class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                                    </svg> Fees Management</a></li>
                            <li><a href="#"
                                    class="flex items-center gap-4 px-4 py-3 rounded-lg hover:bg-gray-100 transition text-gray-700"><svg
                                        class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg> Expenses</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 mt-16 lg:ml-72 p-8">
            <!-- Flash Messages - Success, Error, Info -->
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-6 mb-8 rounded-r-lg shadow-md">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-green-800">Success!</h3>
                            <p class="text-green-700 mt-1">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-6 mb-8 rounded-r-lg shadow-md">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-red-800">Error!</h3>
                            <p class="text-red-700 mt-1">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('info'))
                <div class="bg-blue-50 border-l-4 border-blue-500 p-6 mb-8 rounded-r-lg shadow-md">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-blue-800">Notice</h3>
                            <p class="text-blue-700 mt-1">{{ session('info') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session('warning'))
                <div class="bg-amber-50 border-l-4 border-amber-500 p-6 mb-8 rounded-r-lg shadow-md">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-8 w-8 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-semibold text-amber-800">Warning</h3>
                            <p class="text-amber-700 mt-1">{{ session('warning') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Mobile Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-20 lg:hidden"></div>
    </div>

    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Function to create toast
            function showToast(message, type = 'success') {
                const icons = {
                    success: `
                    <svg class="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>`,
                    error: `
                    <svg class="w-8 h-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>`,
                    info: `
                    <svg class="w-8 h-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>`,
                    warning: `
                    <svg class="w-8 h-8 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>`
                };

                const bgColors = {
                    success: 'bg-green-50 border-green-500',
                    error: 'bg-red-50 border-red-500',
                    info: 'bg-blue-50 border-blue-500',
                    warning: 'bg-amber-50 border-amber-500'
                };

                const textColors = {
                    success: 'text-green-800',
                    error: 'text-red-800',
                    info: 'text-blue-800',
                    warning: 'text-amber-800'
                };

                const toast = document.createElement('div');
                toast.className = `flex items-center gap-4 p-6 rounded-lg shadow-lg border-l-4 ${bgColors[type]} max-w-md transform translate-x-full transition-all duration-500 ease-out`;

                toast.innerHTML = `
                <div class="flex-shrink-0">
                    ${icons[type]}
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold ${textColors[type]} capitalize">${type.charAt(0).toUpperCase() + type.slice(1)}</h3>
                    <p class="mt-1 text-gray-700">${message}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="ml-4 text-gray-500 hover:text-gray-700">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            `;

                document.getElementById('toast-container').appendChild(toast);

                // Animate in
                setTimeout(() => {
                    toast.classList.remove('translate-x-full');
                }, 100);

                // Auto dismiss after 5 seconds
                setTimeout(() => {
                    toast.classList.add('translate-x-full');
                    setTimeout(() => toast.remove(), 500);
                }, 5000);
            }

            // Show toast from session flash messages
            @if(session('success'))
                showToast("{{ session('success') }}", 'success');
            @endif

            @if(session('error'))
                showToast("{{ session('error') }}", 'error');
            @endif

            @if(session('info'))
                showToast("{{ session('info') }}", 'info');
            @endif

            @if(session('warning'))
                showToast("{{ session('warning') }}", 'warning');
            @endif
    });
    </script>
</body>

</html>