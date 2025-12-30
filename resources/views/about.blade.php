{{-- resources/views/about.blade.php --}}
@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative w-full h-screen overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center animate-ken-burns"
            style="background-image: linear-gradient(135deg, rgba(8,56,115,0.85), rgba(131,4,11,0.65)), url('{{ asset('images/school_building.jpg') }}');">
        </div>
        <div class="relative h-full flex items-center">
            <div class="container max-w-7xl mx-auto px-6 sm:px-8 lg:px-16 text-center text-white">
                <h1
                    class="text-4xl sm:text-5xl md:text-6xl lg:text-6xl font-bold mb-8 animate-in fade-in slide-in-from-top duration-1000">
                    About Us
                </h1>
                <p
                    class="text-xl sm:text-2xl lg:text-3xl max-w-4xl mx-auto opacity-95 font-light animate-in fade-in duration-1000 delay-200">
                    Founded in 2004, we are a Christ-centered institution providing quality education from nursery to
                    secondary, nurturing young minds with academic excellence, Christian values, and preparation for life's
                    challenges.
                </p>
            </div>
        </div>
    </section>

    <!-- History & Founder's Message -->
    <section class="py-16 sm:py-24 bg-white">
        <div class="container max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="order-2 lg:order-1 animate-in fade-in slide-in-from-left duration-800 delay-100">
                    <h2 class="text-3xl sm:text-4xl font-bold mb-6 text-[#083873]">
                        Message from the Director
                    </h2>
                    <hr class="border-t-2 border-[#83040b] w-20 mb-8">
                    <p class="text-base sm:text-lg mb-6 italic">
                        "Divine Light Academy and Seminary is one of the leading and most sought after Nursery/Primary and
                        Secondary School in Aba, imparting quality education at an affordable cost...
                    </p>
                    <p class="text-base sm:text-lg mb-6">
                        As we advance in technology and globalization we march our children ahead with Divine Light ethos of
                        moral value and Christian principles...
                    </p>
                    <p class="text-base sm:text-lg mb-6">
                        We fortunately have a committed, supportive and dedicated teachers, caring and co-operative parents
                        which blends harmoniously to create a child-centric school...
                    </p>
                    <p class="text-base sm:text-lg font-bold">
                        — Dr. Mrs. E.C. Ogbansiegbe(JP), Director
                    </p>
                </div>
                <div class="order-1 lg:order-2 animate-in fade-in slide-in-from-right duration-800">
                    <img src="{{ asset('images/directors.jpg') }}" alt="Dr. Mrs. E.C. Ogbansiegbe, Director"
                        class="w-full rounded-lg shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- History Timeline -->
    <section class="py-16 sm:py-24 bg-gray-50">
        <div class="container max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-4xl sm:text-5xl font-bold mb-12 text-[#083873] animate-in fade-in duration-700">
                Our Journey Since 2004
            </h2>
            <p class="text-lg sm:text-xl max-w-4xl mx-auto mb-12 opacity-90 animate-in fade-in duration-800 delay-100">
                Founded in 2004 with just 27 pupils, Divine Light has grown remarkably...
            </p>
            <p class="text-base sm:text-lg max-w-5xl mx-auto opacity-90 animate-in fade-in duration-800 delay-200">
                We implement a well-balanced curriculum...
            </p>
        </div>
    </section>

    <!-- Vision, Mission, Values -->
    <section class="py-16 sm:py-24 bg-white">
        <div class="container max-w-7xl mx-auto px-6">
            <h2 class="text-4xl sm:text-5xl font-bold text-center mb-12 text-[#083873] animate-in fade-in duration-700">
                Our Vision, Mission & Core Values
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div
                    class="bg-gray-50 rounded-2xl shadow-xl p-8 text-center animate-in fade-in zoom-in duration-700 delay-100">
                    <h3 class="text-2xl sm:text-3xl font-bold mb-4 text-[#083873]">Vision</h3>
                    <p class="text-base sm:text-lg opacity-90">
                        To make enlightened and empowered children under the Light of Christ.
                    </p>
                </div>
                <div
                    class="bg-gray-50 rounded-2xl shadow-xl p-8 text-center animate-in fade-in zoom-in duration-700 delay-200">
                    <h3 class="text-2xl sm:text-3xl font-bold mb-4 text-[#083873]">Mission</h3>
                    <p class="text-base sm:text-lg opacity-90">
                        To provide quality, affordable Christ-centered education...
                    </p>
                </div>
                <div
                    class="bg-gray-50 rounded-2xl shadow-xl p-8 text-center animate-in fade-in zoom-in duration-700 delay-300">
                    <h3 class="text-2xl sm:text-3xl font-bold mb-4 text-[#083873]">Core Values</h3>
                    <p class="text-base sm:text-lg opacity-90">
                        Christian Principles, Moral Integrity, Academic Excellence...
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Campus -->
    <section class="relative py-24 sm:py-32 bg-cover bg-center"
        style="background-image: url('https://www.praiseelschools.com/wp-content/uploads/2022/12/pes-index-insert-01a.jpg');">
        <div class="absolute inset-0 bg-black/60"></div>
        <div class="relative container max-w-7xl mx-auto px-6 text-center text-white">
            <h2 class="text-4xl sm:text-5xl font-bold mb-8 animate-in fade-in duration-800">
                Our Modern Campus
            </h2>
            <p
                class="text-lg sm:text-xl lg:text-2xl max-w-4xl mx-auto mb-12 opacity-90 animate-in fade-in duration-800 delay-200">
                A safe and inspiring environment equipped with state-of-the-art classrooms...
            </p>
            <a href="#contact"
                class="inline-block border border-white text-white px-8 py-4 font-bold rounded-lg hover:bg-white hover:text-black transition-all duration-500 animate-in fade-in duration-800 delay-300">
                Schedule a Campus Tour
            </a>
        </div>
    </section>

    <!-- Philosophy -->
    <section class="py-20 sm:py-28 bg-[#151519] text-white">
        <div class="container max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-10 animate-in fade-in duration-800">
                Our Educational Philosophy
            </h2>
            <p class="text-xl sm:text-2xl max-w-5xl mx-auto opacity-90 mb-12 animate-in fade-in duration-800 delay-200">
                "It is better to be a man of value than a man of success." ...
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mt-16">
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 animate-in fade-in zoom-in duration-700 delay-300">
                    <h3 class="text-2xl font-bold mb-4">Faith & Moral Values</h3>
                    <p class="opacity-90">Rooted in Christian principles for character development.</p>
                </div>
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 animate-in fade-in zoom-in duration-700 delay-400">
                    <h3 class="text-2xl font-bold mb-4">Critical Thinking</h3>
                    <p class="opacity-90">Teaching how to think, not what to think.</p>
                </div>
                <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 animate-in fade-in zoom-in duration-700 delay-500">
                    <h3 class="text-2xl font-bold mb-4">Child-Centric Approach</h3>
                    <p class="opacity-90">Supported by dedicated teachers and cooperative parents.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 sm:py-20 bg-[#83040b] text-white text-center">
        <div class="container max-w-7xl mx-auto px-6">
            <h2 class="text-3xl sm:text-4xl font-bold mb-8 animate-in fade-in duration-700">
                Join the Divine Light Family
            </h2>
            <p class="text-xl mb-10 max-w-3xl mx-auto opacity-90 animate-in fade-in duration-700 delay-100">
                Experience quality, affordable Christ-centered education that has transformed thousands of lives since 2004.
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="#admissions"
                    class="bg-white text-[#083873] px-10 py-4 rounded-lg font-bold hover:bg-gray-100 transition animate-in fade-in duration-700 delay-200">
                    Start Admissions Process
                </a>
                <a href="#contact"
                    class="border-2 border-white px-10 py-4 rounded-lg font-bold hover:bg-white hover:text-[#83040b] transition animate-in fade-in duration-700 delay-300">
                    Contact Us
                </a>
            </div>
        </div>
    </section>
@endsection