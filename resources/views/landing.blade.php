{{-- resources/views/landing.blade.php --}}
@extends('layouts.app')

@section('content')
    <style>
        @keyframes ken-burns {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }

        .animate-ken-burns {
            animation: ken-burns 20s ease-out infinite alternate;
        }

        [x-cloak] { display: none !important; }
    </style>

    <!-- Hero Carousel -->
    <section class="relative w-full h-screen overflow-hidden">
        <div x-data="heroCarousel()" x-init="init()" x-cloak class="relative w-full h-full">
            <template x-for="(slide, index) in slides" :key="index">
                <div x-show="currentSlide === index"
                     x-transition:enter="transition ease-out duration-1000"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     class="absolute inset-0">
                    <div class="absolute inset-0 bg-cover bg-center animate-ken-burns"
                         :style="`background-image: linear-gradient(135deg, rgba(8,56,115,0.85), rgba(131,4,11,0.65)), url('${slide.image}')`">
                    </div>

                    <div class="relative h-full flex items-center">
                        <div class="container max-w-7xl mx-auto px-6 sm:px-8 lg:px-16">
                            <div class="grid lg:grid-cols-2 items-center">
                                <div class="text-white animate-in fade-in slide-in-from-left duration-1000">
                                    <h1 x-text="slide.title"
                                        class="text-3xl sm:text-3xl md:text-3xl lg:text-4xl font-bold leading-tight mb-6 sm:mb-8">
                                    </h1>
                                    <p x-text="slide.subtitle"
                                        class="text-base sm:text-lg md:text-xl lg:text-2xl opacity-95 font-light mb-8 max-w-2xl">
                                    </p>
                                    <a :href="slide.ctaLink"
                                        class="inline-flex items-center gap-3 bg-white text-[#083873] hover:bg-gray-100 font-bold py-3 px-6 sm:py-4 sm:px-8 rounded-full shadow-2xl transition hover:scale-105 text-sm sm:text-base">
                                        <span x-text="slide.ctaText"></span>
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                                                  d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </a>
                                </div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Navigation Arrows -->
            <div class="hidden lg:flex absolute inset-y-0 left-0 right-0 items-center justify-between px-2 pointer-events-none">
                <button @click="prevSlide()"
                        class="pointer-events-auto bg-white/10 backdrop-blur hover:bg-white/20 w-14 h-14  flex items-center justify-center shadow-xl transition hover:scale-110">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button @click="nextSlide()"
                        class="pointer-events-auto bg-white/10 backdrop-blur hover:bg-white/20 w-14 h-14 flex items-center justify-center shadow-xl transition hover:scale-110">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <!-- Scroll Down Indicator -->
            <a href="#welcome" class="absolute bottom-10 left-1/2 -translate-x-1/2">
                <svg class="w-8 h-12 text-white animate-bounce" viewBox="0 0 30 45">
                    <path fill="none" stroke="currentColor" stroke-width="2"
                          d="M15,1.118c12.352,0,13.967,12.88,13.967,12.88v18.76c0,0-1.514,11.204-13.967,11.204S0.931,32.966,0.931,32.966V14.05C0.931,14.05,2.648,1.118,15,1.118z" />
                </svg>
            </a>
        </div>
    </section>

    <!-- Welcome Section -->
    <section id="welcome" class="py-16 sm:py-20 bg-white">
        <div class="container max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Image Side -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-1 gap-6 animate-in fade-in slide-in-from-left duration-800">
                    <img src="{{ asset('images/directors.jpg') }}"
                         alt="Divine Light International School & Seminary Campus"
                         class="w-full rounded-lg shadow-lg hidden lg:block">
                </div>

                <!-- Text Side -->
                <div class="animate-in fade-in slide-in-from-right duration-800 delay-200">
                    <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold mb-6 sm:mb-8 leading-tight text-[#083873]">
                        We understand how vital the formative years are and the impact on our communities…
                    </h3>
                    <hr class="border-t-2 border-[#83040b] w-16 mb-6">

                    <p class="text-base sm:text-lg mb-6">
                        Welcome to Divine Light International School & Seminary, a unique Christ-centered institution
                        dedicated to nurturing young minds in a rich, supportive learning environment.
                    </p>

                    <p class="text-base sm:text-lg mb-6">
                        Our vision is to “Educate, Enlighten and Empower a child under the Light of Christ”. We believe that
                        true education goes beyond academics—it shapes character, instills moral values, and prepares students to
                        shine as beacons of hope in their communities.
                    </p>

                    <p class="text-base sm:text-lg mb-6">
                        At Divine Light, we combine rigorous academic excellence with spiritual growth, fostering holistic
                        development through dedicated teachers, modern facilities, and a curriculum rooted in Christian principles.
                    </p>

                    <p class="text-base sm:text-lg mb-8">
                        Whether your child is taking their first steps in early education or preparing for higher pursuits
                        in our seminary secondary program, we are committed to partnering with families to guide each student
                        toward their God-given potential.
                    </p>

                    <div class="flex flex-col sm:flex-row flex-wrap gap-4 sm:gap-6">
                        <a href="#about"
                            class="text-center border-2 border-black text-black px-8 py-4 rounded-lg font-bold hover:bg-[#83040b] hover:text-white hover:border-[#83040b] transition">
                            Learn More About Us
                        </a>
                        <a href="#admissions"
                            class="text-center bg-[#83040b] text-white px-8 py-4 rounded-lg font-bold hover:bg-[#083873] transition">
                            Want to Join Us? Start Admissions
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modern Facilities Section -->
    <section class="relative py-24 sm:py-32 bg-cover bg-center"
             style="background-image: url('https://www.praiseelschools.com/wp-content/uploads/2022/12/pes-index-insert-01a.jpg');">
        <div class="absolute inset-0 bg-black/60"></div>

        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none">
            <svg class="relative block w-full h-24 sm:h-32 lg:h-64" viewBox="0 0 1000 300" preserveAspectRatio="none" fill="#151519">
                <path d="M 1014 264 v 122 h -808 l -172 -86 s 310.42 -22.84 402 -79 c 106 -65 154 -61 268 -12 c 107 46 195.11 5.94 275 137 z"></path>
                <path d="M -302 55 s 235.27 208.25 352 159 c 128 -54 233 -98 303 -73 c 92.68 33.1 181.28 115.19 235 108 c 104.9 -14 176.52 -173.06 267 -118 c 85.61 52.09 145 123 145 123 v 74 l -1306 10 z"></path>
                <path d="M -286 255 s 214 -103 338 -129 s 203 29 384 101 c 145.57 57.91 178.7 50.79 272 0 c 79 -43 301 -224 385 -63 c 53 101.63 -62 129 -62 129 l -107 84 l -1212 12 z"></path>
                <path d="M -24 69 s 299.68 301.66 413 245 c 8 -4 233 2 284 42 c 17.47 13.7 172 -132 217 -174 c 54.8 -51.15 128 -90 188 -39 c 76.12 64.7 118 99 118 99 l -12 132 l -1212 12 z"></path>
                <path d="M -12 201 s 70 83 194 57 s 160.29 -36.77 274 6 c 109 41 184.82 24.36 265 -15 c 55 -27 116.5 -57.69 214 4 c 49 31 95 26 95 26 l -6 151 l -1036 10 z"></path>
            </svg>
        </div>

        <div class="relative container max-w-7xl mx-auto px-6 text-center text-white">
            <div class="mb-8 animate-in fade-in duration-700">
                <i class="fas fa-school text-4xl sm:text-5xl lg:text-6xl"></i>
            </div>
            <h2 class="text-4xl sm:text-5xl font-bold mb-8 animate-in fade-in slide-in-from-top duration-800 delay-100">
                State-of-the-Art Facilities
            </h2>
            <p class="text-lg sm:text-xl lg:text-2xl max-w-3xl mx-auto mb-12 opacity-90 animate-in fade-in duration-800 delay-200">
                Our campus features modern classrooms, well-equipped science and computer labs, a spacious library, sports
                fields, and safe play areas designed to support engaging and effective learning experiences.
            </p>
            <a href="#about"
               class="inline-block border border-white text-white px-6 py-4 text-base sm:text-md font-bold rounded-lg hover:bg-white hover:text-black transition-all duration-500 animate-in fade-in duration-800 delay-300">
                Explore Our Campus
            </a>
        </div>
    </section>

    <!-- Feature Cards -->
    <section class="py-20 sm:py-24 bg-[#151519]">
        <div class="container max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="group relative bg-white/10 backdrop-blur-lg rounded-2xl overflow-hidden shadow-2xl transition-all duration-500 hover:shadow-3xl hover:-translate-y-3 animate-in fade-in zoom-in duration-700 delay-100">
                <div class="h-80 overflow-hidden">
                    <img src="https://www.praiseelschools.com/wp-content/uploads/2023/04/enroll.jpg" alt="How to Enroll"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                </div>
                <div class="p-8 sm:p-10 text-white">
                    <h3 class="text-2xl sm:text-3xl font-bold mb-4">How to Enroll</h3>
                    <p class="mb-6 opacity-90 text-sm sm:text-base">Guided steps and procedures to secure admission.</p>
                    <a href="#admissions" class="text-white font-bold inline-flex items-center gap-2 group">
                        Learn More
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="group relative bg-white/10 backdrop-blur-lg rounded-2xl overflow-hidden shadow-2xl transition-all duration-500 hover:shadow-3xl hover:-translate-y-3 animate-in fade-in zoom-in duration-700 delay-200">
                <div class="h-80 overflow-hidden">
                    <img src="https://www.praiseelschools.com/wp-content/uploads/2023/04/essentials.jpg" alt="The Essentials"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                </div>
                <div class="p-8 sm:p-10 text-white">
                    <h3 class="text-2xl sm:text-3xl font-bold mb-4">The Essentials</h3>
                    <p class="mb-6 opacity-90 text-sm sm:text-base">Required items for your child during school hours.</p>
                    <a href="#parents" class="text-white font-bold inline-flex items-center gap-2 group">
                        Read More
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="group relative bg-white/10 backdrop-blur-lg rounded-2xl overflow-hidden shadow-2xl transition-all duration-500 hover:shadow-3xl hover:-translate-y-3 animate-in fade-in zoom-in duration-700 delay-300">
                <div class="h-80 overflow-hidden">
                    <img src="https://www.praiseelschools.com/wp-content/uploads/2023/04/events.jpg" alt="Events Hub"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                </div>
                <div class="p-8 sm:p-10 text-white">
                    <h3 class="text-2xl sm:text-3xl font-bold mb-4">Events Hub</h3>
                    <p class="mb-6 opacity-90 text-sm sm:text-base">Upcoming and past school events.</p>
                    <a href="#events" class="text-white font-bold inline-flex items-center gap-2 group">
                        View Events
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Philosophy Section -->
    <section class="relative py-24 sm:py-32 bg-cover bg-center"
             style="background-image: url('https://www.praiseelschools.com/wp-content/uploads/2023/04/praiseel-index.insert-bg-a.jpg');">
        <div class="absolute inset-0 bg-black/70"></div>
        <div class="relative container max-w-7xl mx-auto px-6 text-center text-white">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold mb-8 animate-in fade-in duration-800">
                Our Philosophy
            </h2>
            <p class="text-xl sm:text-xl lg:text-2xl max-w-5xl mx-auto mb-12 opacity-90 animate-in fade-in duration-800 delay-200">
                We believe in and employ systems and methodologies that engage our children while encouraging participation
                in learning.
            </p>
            <a href="#about"
               class="inline-block border border-white px-6 sm:px-8 py-3 sm:py-4 text-lg sm:text-xl font-bold rounded-lg hover:bg-white hover:text-black transition-all duration-500 animate-in fade-in duration-800 delay-300">
                Learn More
            </a>
        </div>
    </section>

    <!-- Quality Statement -->
    <section class="py-4 bg-[#83040b] text-white text-center">
        <h4 class="text-lg sm:text-xl lg:text-3xl font-bold">
            At all times, we bring you quality <em class="underline decoration-white">service</em> in education.
        </h4>
    </section>
@endsection

@push('scripts')
    <script>
        function heroCarousel() {
            return {
                currentSlide: 0,
                slides: [
                    {
                        image: "{{ asset('images/students.jpg') }}",
                        title: "Christ-Centered Education from Nursery to Secondary",
                        subtitle: "A faith-based school offering quality learning from early years through secondary, focused on academic excellence, strong character, and spiritual growth under the Light of Christ.",
                        ctaText: "Start Admissions",
                        ctaLink: "admissions"
                    },
                    {
                        image: "https://www.praiseelschools.com/wp-content/uploads/2023/08/slider01bb.jpg",
                        title: "Nurturing Young Minds Across All Levels",
                        subtitle: "We provide a supportive, Christian environment where students from nursery to secondary develop knowledge, moral values, and confidence to become compassionate leaders.",
                        ctaText: "Discover More",
                        ctaLink: "about"
                    },
                    {
                        image: "{{ asset('images/school_building.jpg') }}",
                        title: "Safe and Modern Campus Environment",
                        subtitle: "Our secure facilities include up-to-date classrooms and labs where child safety, spiritual development, and strong academics remain our main focus.",
                        ctaText: "Schedule a Tour",
                        ctaLink: "contact"
                    },
                    {
                        image: "{{ asset('images/library.jpg') }}",
                        title: "Education That Builds Lasting Values",
                        subtitle: "Students learn in a Christ-centered setting that equips them with skills and faith to make positive contributions to their families and communities.",
                        ctaText: "Learn About Our Vision",
                        ctaLink: "about"
                    },
                    {
                        image: "{{ asset('images/IT-classroom.jpg') }}",
                        title: "Rich and Balanced Curriculum",
                        subtitle: "Our program combines the British National Curriculum with the Nigerian National Curriculum, enriched by Christian teachings, technology, and practical activities.",
                        ctaText: "Explore Curriculum",
                        ctaLink: "about"
                    },
                    {
                        image: "{{ asset('images/classroom.jpg') }}",
                        title: "Active and Engaging Teaching Methods",
                        subtitle: "We use child-focused approaches that encourage students to participate fully, think critically, and enjoy learning within a faith-based framework.",
                        ctaText: "Our Approach",
                        ctaLink: "about"
                    },
                    {
                        image: "{{ asset('images/children-play.jpg') }}",
                        title: "Strong Foundation for Future Success",
                        subtitle: "Early experiences shape a child's growth. We create a positive, Christ-centered atmosphere where children build good habits, language skills, and lifelong confidence.",
                        ctaText: "Enroll Today",
                        ctaLink: "admissions"
                    },
                ],
                intervalId: null,
                init() { this.startAutoPlay(); },
                startAutoPlay() { this.intervalId = setInterval(() => this.nextSlide(), 8000); },
                stopAutoPlay() { if (this.intervalId) clearInterval(this.intervalId); },
                nextSlide() { this.currentSlide = (this.currentSlide + 1) % this.slides.length; },
                prevSlide() { this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length; }
            }
        }
    </script>
@endpush