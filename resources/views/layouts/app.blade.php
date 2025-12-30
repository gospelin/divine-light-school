{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Divine Light International School | Divine Light Seminary Secondary School</title>
    <meta name="description"
        content="Divine Light International School offers exceptional Christ-centered education from nursery to seminary in Nigeria. British & Nigerian curriculum, exceptional facilities, holistic development. Enroll today!" />

    <!-- Open Graph / Social -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="Divine Light International School & Seminary">
    <meta property="og:description" content="Premium Christ-centered education blending British & Nigerian curricula.">
    <meta property="og:image" content="{{ asset('images/logo.jpg') }}">

    <!-- Favicon -->
    <link rel="icon" type="image/ico" href="{{ asset('favicon.ico') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700,800|playfair-display:600,700,800"
        rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --primary: #083873;
            --accent: #83040b;
            --accent-hover: #6a0306;
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Inter', sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Playfair Display', serif;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            overflow-x: hidden;
        }

        /* Navigation underline effect */
        .nav-link {
            position: relative;
            padding-bottom: 6px;
            font-weight: 500;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: currentColor;
            transition: var(--transition);
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Slim Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent);
        }

        * {
            scrollbar-width: thin;
            scrollbar-color: var(--primary) #f1f1f1;
        }

        @keyframes ken-burns {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(1.1);
            }
        }

        .animate-ken-burns {
            animation: ken-burns 20s ease-out infinite alternate;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
</head>

<body class="antialiased bg-white text-gray-900" x-data="{ mobileMenuOpen: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => scrolled = window.scrollY > 40)">

    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-500"
        :class="scrolled ? 'bg-white/98 backdrop-blur-2xl shadow-lg py-3' : 'bg-transparent py-6'"
        x-data="{ mobileMenuOpen: false, mediaOpen: false }" @click.away="mediaOpen = false">
        <div class="max-w-7xl mx-auto px-4 lg:px-6">
            <div class="flex justify-between items-center">
                <!-- Logo & School Name -->
                <a href="/" class="flex items-center space-x-3 md:space-x-5 group">
                    <div class="relative">
                        <img src="{{ asset('images/logo.png') }}" alt="Divine Light Logo"
                            class="h-12 md:h-14 lg:h-16 transition-all duration-500 group-hover:scale-110">
                        <div :class="scrolled ? 'opacity-0' : 'opacity-100'"
                            class="absolute inset-0 bg-gradient-to-r from-blue-400/30 to-red-400/30 rounded-full blur-2xl scale-0 group-hover:scale-110 transition-all duration-700">
                        </div>
                    </div>
                    <div class="flex flex-col justify-center">
                        <div class="font-bold tracking-tight leading-none transition-colors duration-500"
                            :class="scrolled ? 'text-[var(--primary)]' : 'text-white drop-shadow-lg'"
                            style="font-size: clamp(0.9rem, 2vw, 1.2rem);">
                            DIVINE LIGHT INTERNATIONAL SCHOOL
                        </div>
                        <div class="font-semibold tracking-widest leading-tight mt-0.5 transition-colors duration-500"
                            :class="scrolled ? 'text-[var(--accent)]' : 'text-white/90 drop-shadow-md'"
                            style="font-size: clamp(0.65rem, 1.5vw, 0.8rem);">
                            & DIVINE LIGHT SEMINARY SECONDARY SCHOOL
                        </div>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="/" class="nav-link transition"
                        :class="scrolled ? 'text-gray-800 hover:text-[var(--primary)]' : 'text-white hover:text-white/80'">Home</a>
                    <a href="/about" class="nav-link transition"
                        :class="scrolled ? 'text-gray-800 hover:text-[var(--primary)]' : 'text-white hover:text-white/80'">About</a>
                    <a href="/programs" class="nav-link transition"
                        :class="scrolled ? 'text-gray-800 hover:text-[var(--primary)]' : 'text-white hover:text-white/80'">Programs</a>

                    <!-- Desktop Media Dropdown -->
                    <div class="relative">
                        <button @click.prevent="mediaOpen = !mediaOpen"
                            class="nav-link flex items-center gap-1 transition font-medium"
                            :class="scrolled ? 'text-gray-800 hover:text-[var(--primary)]' : 'text-white hover:text-white/80'">
                            Media
                            <svg class="w-4 h-4 transition-transform duration-300"
                                :class="mediaOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="mediaOpen" x-transition x-cloak
                            class="absolute left-1/2 -translate-x-1/2 mt-5 w-64 bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden">
                            <div class="py-3">
                                <a href="{{ route('channel.index') }}" @click="mediaOpen = false"
                                    class="block px-8 py-4 text-gray-700 hover:bg-gray-50 hover:text-[var(--primary)] transition font-medium">
                                    Channel (All Updates)
                                </a>
                                <a href="{{ route('blog.index') }}" @click="mediaOpen = false"
                                    class="block px-8 py-4 text-gray-700 hover:bg-gray-50 hover:text-[var(--primary)] transition font-medium">
                                    Blog
                                </a>
                                <a href="{{ route('events.index') }}" @click="mediaOpen = false"
                                    class="block px-8 py-4 text-gray-700 hover:bg-gray-50 hover:text-[var(--primary)] transition font-medium">
                                    Events
                                </a>
                                <a href="{{ route('gallery.index') }}" @click="mediaOpen = false"
                                    class="block px-8 py-4 text-gray-700 hover:bg-gray-50 hover:text-[var(--primary)] transition font-medium">
                                    Photo Gallery
                                </a>
                                <a href="{{ route('videos.index') }}" @click="mediaOpen = false"
                                    class="block px-8 py-4 text-gray-700 hover:bg-gray-50 hover:text-[var(--primary)] transition font-medium">
                                    Videos
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Authentication: Dashboard (auth) or Portal (guest) -->
                    @auth
                        @if(auth()->user()->hasRole('admin|super-admin'))
                            <a href="{{ route('admin.dashboard') }}" class="nav-link transition"
                                :class="scrolled ? 'text-gray-800 hover:text-[var(--primary)]' : 'text-white hover:text-white/80'">Dashboard</a>
                        @elseif(auth()->user()->hasRole('teacher'))
                            <a href="{{ route('teacher.dashboard') }}" class="nav-link transition"
                                :class="scrolled ? 'text-gray-800 hover:text-[var(--primary)]' : 'text-white hover:text-white/80'">Dashboard</a>
                        @elseif(auth()->user()->hasRole('student'))
                            <a href="{{ route('student.dashboard') }}" class="nav-link transition"
                                :class="scrolled ? 'text-gray-800 hover:text-[var(--primary)]' : 'text-white hover:text-white/80'">Dashboard</a>
                        @endif
                    @else
                        <a href="/portal"
                            class="relative inline-flex items-center px-8 py-3.5 overflow-hidden font-bold text-white bg-[var(--accent)] rounded-full shadow-lg hover:shadow-xl group transition-all duration-500">
                            <span
                                class="absolute inset-0 bg-[var(--accent-hover)] translate-x-full group-hover:translate-x-0 transition-transform duration-500"></span>
                            <span class="relative">Portal</span>
                        </a>
                    @endauth

                    <!-- Admissions Button -->
                    <a href="/admissions"
                        class="relative inline-flex items-center px-8 py-3.5 overflow-hidden font-bold text-white bg-[var(--accent)] rounded-full shadow-lg hover:shadow-xl group transition-all duration-500">
                        <span
                            class="absolute inset-0 bg-[var(--accent-hover)] translate-x-full group-hover:translate-x-0 transition-transform duration-500"></span>
                        <span class="relative">Admissions</span>
                    </a>
                </div>

                <!-- Mobile Hamburger Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" aria-label="Toggle mobile menu" class="lg:hidden p-3">
                    <svg x-show="!mobileMenuOpen" class="w-7 h-7" :class="scrolled ? 'text-gray-800' : 'text-white'"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileMenuOpen" class="w-7 h-7" :class="scrolled ? 'text-gray-800' : 'text-white'"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Overlay + Sidebar -->
        <div x-show="mobileMenuOpen" x-cloak class="fixed inset-0 z-[9999] lg:hidden"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

            <!-- Backdrop Overlay -->
            <div @click="mobileMenuOpen = false" class="absolute inset-0 bg-black/50 backdrop-blur-sm"
                x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
            </div>

            <!-- Sidebar Panel - Full height, fixed position, white background -->
            <div class="absolute inset-y-0 left-0 w-80 bg-white shadow-2xl flex flex-col" x-show="mobileMenuOpen"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-x-[-100%]"
                x-transition:enter-end="translate-x-0" x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-[-100%]">

                <!-- Sidebar Header -->
                <div class="flex-shrink-0 px-6 py-6 border-b border-gray-100">
                    <a href="/" @click="mobileMenuOpen = false" class="flex items-center space-x-3">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12">
                        <div>
                            <div class="font-bold text-lg text-[var(--primary)]">DIVINE LIGHT</div>
                            <div class="text-xs text-gray-600">International School & Seminary</div>
                        </div>
                    </a>
                </div>

                <!-- Scrollable Menu Content -->
                <div class="flex-1 overflow-y-auto px-4 py-6 custom-scrollbar">
                    <nav class="space-y-2">
                        <a href="/" @click="mobileMenuOpen = false"
                            class="block py-3 px-4 text-lg font-medium text-gray-900 hover:bg-gray-50 hover:text-[var(--primary)] rounded-lg transition">
                            Home
                        </a>
                        <a href="/about" @click="mobileMenuOpen = false"
                            class="block py-3 px-4 text-lg font-medium text-gray-900 hover:bg-gray-50 hover:text-[var(--primary)] rounded-lg transition">
                            About
                        </a>
                        <a href="/programs" @click="mobileMenuOpen = false"
                            class="block py-3 px-4 text-lg font-medium text-gray-900 hover:bg-gray-50 hover:text-[var(--primary)] rounded-lg transition">
                            Programs
                        </a>

                        <!-- Media Accordion -->
                        <div x-data="{ mediaOpen: false }">
                            <button @click.prevent="mediaOpen = !mediaOpen"
                                class="w-full flex items-center justify-between py-3 px-4 text-lg font-medium text-gray-900 hover:bg-gray-50 hover:text-[var(--primary)] rounded-lg transition">
                                Media
                                <svg class="w-5 h-5 transition-transform duration-300"
                                    :class="mediaOpen ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div x-show="mediaOpen" x-collapse class="ml-6 mt-2 space-y-1">
                                <a href="{{ route('channel.index') }}" @click="mobileMenuOpen = false"
                                    class="block py-2.5 px-4 text-base text-gray-700 hover:text-[var(--primary)] hover:bg-gray-50 rounded-lg transition">
                                    Channel (All Updates)
                                </a>
                                <a href="{{ route('blog.index') }}" @click="mobileMenuOpen = false"
                                    class="block py-2.5 px-4 text-base text-gray-700 hover:text-[var(--primary)] hover:bg-gray-50 rounded-lg transition">
                                    Blog
                                </a>
                                <a href="{{ route('events.index') }}" @click="mobileMenuOpen = false"
                                    class="block py-2.5 px-4 text-base text-gray-700 hover:text-[var(--primary)] hover:bg-gray-50 rounded-lg transition">
                                    Events
                                </a>
                                <a href="{{ route('gallery.index') }}" @click="mobileMenuOpen = false"
                                    class="block py-2.5 px-4 text-base text-gray-700 hover:text-[var(--primary)] hover:bg-gray-50 rounded-lg transition">
                                    Photo Gallery
                                </a>
                                <a href="{{ route('videos.index') }}" @click="mobileMenuOpen = false"
                                    class="block py-2.5 px-4 text-base text-gray-700 hover:text-[var(--primary)] hover:bg-gray-50 rounded-lg transition">
                                    Videos
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>

                <!-- Sidebar Footer - Fixed at bottom -->
                <div class="flex-shrink-0 px-6 py-6 border-t border-gray-100 space-y-4 bg-white">
                    @auth
                        @if(auth()->user()->hasRole('admin|super-admin|teacher|student'))
                            <a href="{{ auth()->user()->hasRole('admin|super-admin') ? route('admin.dashboard') : (auth()->user()->hasRole('teacher') ? route('teacher.dashboard') : route('student.dashboard')) }}"
                                @click="mobileMenuOpen = false"
                                class="block w-full text-center py-3.5 font-bold text-white bg-[var(--primary)] rounded-full shadow-lg hover:bg-[var(--accent)] transition-all duration-500">
                                Dashboard
                            </a>
                        @endif
                    @else
                        <a href="/portal" @click="mobileMenuOpen = false"
                            class="block w-full text-center py-3.5 font-bold text-white bg-[var(--accent)] rounded-full shadow-lg hover:bg-[var(--accent-hover)] transition-all duration-500">
                            Portal
                        </a>
                    @endauth

                    <a href="/admissions" @click="mobileMenuOpen = false"
                        class="block w-full text-center py-3.5 font-bold text-white bg-[var(--accent)] rounded-full shadow-lg hover:bg-[var(--accent-hover)] transition-all duration-500">
                        Admissions
                    </a>
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Footer (Fully Responsive Version) -->
    <footer class="bg-[#111111] text-white">
        <div class="container max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 border-b border-gray-600 pb-12">
                <!-- Left Column -->
                <div class="space-y-12">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h4 class="text-xl sm:text-2xl font-bold mb-4">School Address</h4>
                            <p class="leading-relaxed text-sm sm:text-base">
                                KM 3 Aba-Port Harcourt Road,<br>Abayi,<br>Abia State, Nigeria.
                            </p>
                        </div>
                        <div>
                            <h4 class="text-xl sm:text-2xl font-bold mb-4">Call & Write Us</h4>
                            <p class="leading-relaxed text-sm sm:text-base">
                                +234 XXX XXX XXXX<br>+234 XXX XXX XXXX<br>
                                info@divinelight.edu.ng<br>admissions@divinelight.edu.ng
                            </p>
                        </div>
                    </div>

                    <div>
                        <p class="font-bold mb-6 text-base">Connect with us socially…</p>
                        <div class="flex flex-wrap gap-6 text-xl">
                            <a href="#" class="hover:text-[var(--accent)] transition">Facebook</a>
                            <a href="#" class="hover:text-[var(--accent)] transition">Twitter</a>
                            <a href="#" class="hover:text-[var(--accent)] transition">Instagram</a>
                            <a href="#" class="hover:text-[var(--accent)] transition">WhatsApp</a>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-12 lg:border-l lg:border-gray-600 lg:pl-12">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                        <div>
                            <h4 class="text-xl sm:text-2xl font-bold mb-4">Corporate Brief</h4>
                            <p class="leading-relaxed text-sm sm:text-base">
                                Divine Light International School & Seminary is a premier Christ-centered institution
                                providing holistic education from nursery to seminary.
                            </p>
                        </div>
                        <div class="text-center md:text-right">
                            <img src="{{ asset('images/logo.png') }}" alt="Divine Light Logo"
                                class="h-32 sm:h-36 lg:h-40 mx-auto">
                            <p class="mt-4 text-base sm:text-lg font-medium">www.divinelight.edu.ng</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Section -->
            <div class="pt-8 text-center text-xs sm:text-sm">
                <div class="flex flex-wrap justify-center gap-x-4 gap-y-2 mb-4">
                    <a href="#" class="underline hover:text-[var(--accent)]">Terms of Use</a>
                    <a href="#" class="underline hover:text-[var(--accent)]">Privacy Policy</a>
                    <a href="#" class="underline hover:text-[var(--accent)]">Disclaimer Notice</a>
                </div>
                <p>Copyright © {{ date('Y') }} Divine Light International School & Seminary. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button -->
    <button @click="window.scrollTo({top:0,behavior:'smooth'})" x-show="scrolled"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
        x-transition:enter-end="opacity-100 scale-100" class="fixed z-50 w-12 h-12 md:w-14 md:h-14 bg-[var(--primary)] text-white rounded-full shadow-2xl flex items-center justify-center hover:scale-110 transition-all duration-300
                   bottom-20 right-4 md:bottom-8 md:right-8
                   sm:bottom-24 sm:right-6">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>
   
    @stack('scripts')
</body>

</html>