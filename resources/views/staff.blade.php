{{-- resources/views/staff.blade.php --}}
@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative w-full h-screen overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center animate-ken-burns"
            style="background-image: linear-gradient(135deg, rgba(8,56,115,0.85), rgba(131,4,11,0.65)), url('{{ asset('images/directors.jpg') }}');">
        </div>
        <div class="relative h-full flex items-center">
            <div class="container max-w-7xl mx-auto px-6 sm:px-8 lg:px-16 text-center text-white">
                <h1
                    class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-8 animate-in fade-in slide-in-from-top duration-1000">
                    Meet Our Dedicated Staff
                </h1>
                <p
                    class="text-xl sm:text-2xl lg:text-3xl max-w-4xl mx-auto opacity-95 font-light animate-in fade-in duration-1000 delay-200">
                    Passionate educators and leaders committed to nurturing every child with academic excellence, moral
                    values, and Christian faith.
                </p>
            </div>
        </div>
    </section>

    <!-- Leadership Section -->
    <section class="py-16 sm:py-24 bg-white">
        <div class="container max-w-7xl mx-auto px-6">
            <h2 class="text-4xl sm:text-5xl font-bold text-center mb-12 text-[#083873] animate-in fade-in duration-700">
                School Leadership
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <div
                    class="bg-gray-50 rounded-2xl shadow-2xl overflow-hidden text-center transition-all duration-500 hover:shadow-3xl hover:-translate-y-3 animate-in fade-in zoom-in duration-700 delay-100">
                    <img src="{{ asset('images/directors.jpg') }}" alt="Dr. Mrs. E.C. Ogbansiegbe (JP)"
                        class="w-full h-96 object-cover">
                    <div class="p-8">
                        <h3 class="text-2xl sm:text-3xl font-bold mb-2 text-[#083873]">Dr. Mrs. E.C. Ogbansiegbe (JP)</h3>
                        <p class="text-lg text-[#83040b] font-bold mb-4">Director & Proprietress</p>
                        <p class="text-base opacity-90">
                            Visionary founder with over two decades of dedication to Christ-centered education, guiding
                            Divine Light since 2004 to empower children under the Light of Christ.
                        </p>
                    </div>
                </div>
                <!-- Add more leadership cards with increasing delay-200, delay-300, etc. -->
            </div>
        </div>
    </section>

    <!-- Teaching & Support Staff -->
    <section class="py-16 sm:py-24 bg-gray-50">
        <div class="container max-w-7xl mx-auto px-6">
            <h2 class="text-4xl sm:text-5xl font-bold text-center mb-12 text-[#083873] animate-in fade-in duration-700">
                Our Teachers & Support Team
            </h2>
            <p
                class="text-lg sm:text-xl text-center max-w-5xl mx-auto mb-16 opacity-90 animate-in fade-in duration-800 delay-100">
                Highly qualified, compassionate, and faith-driven professionals who create a nurturing, child-centric
                environment for learning and growth.
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <!-- Example Teacher Cards -->
                <div
                    class="bg-white rounded-2xl shadow-xl p-6 text-center transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 animate-in fade-in zoom-in duration-700 delay-100">
                    <div class="w-40 h-40 mx-auto bg-gray-300 rounded-full mb-6 border-4 border-[#083873]"></div>
                    <h3 class="text-xl font-bold mb-1">Mrs. Grace Adebayo</h3>
                    <p class="text-[#83040b] font-medium">Head of Nursery</p>
                </div>
                <div
                    class="bg-white rounded-2xl shadow-xl p-6 text-center transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 animate-in fade-in zoom-in duration-700 delay-200">
                    <div class="w-40 h-40 mx-auto bg-gray-300 rounded-full mb-6 border-4 border-[#083873]"></div>
                    <h3 class="text-xl font-bold mb-1">Mr. John Okeke</h3>
                    <p class="text-[#83040b] font-medium">Primary Science Teacher</p>
                </div>
                <div
                    class="bg-white rounded-2xl shadow-xl p-6 text-center transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 animate-in fade-in zoom-in duration-700 delay-300">
                    <div class="w-40 h-40 mx-auto bg-gray-300 rounded-full mb-6 border-4 border-[#083873]"></div>
                    <h3 class="text-xl font-bold mb-1">Mrs. Chioma Nwosu</h3>
                    <p class="text-[#83040b] font-medium">Secondary English Teacher</p>
                </div>
                <div
                    class="bg-white rounded-2xl shadow-xl p-6 text-center transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 animate-in fade-in zoom-in duration-700 delay-400">
                    <div class="w-40 h-40 mx-auto bg-gray-300 rounded-full mb-6 border-4 border-[#083873]"></div>
                    <h3 class="text-xl font-bold mb-1">Mr. Emmanuel Chukwu</h3>
                    <p class="text-[#83040b] font-medium">ICT Coordinator</p>
                </div>
                <!-- Add more staff cards as needed -->
            </div>
        </div>
    </section>

    <!-- Join Team CTA -->
    <section class="py-16 sm:py-20 bg-[#83040b] text-white text-center">
        <div class="container max-w-7xl mx-auto px-6">
            <h2 class="text-3xl sm:text-4xl font-bold mb-8 animate-in fade-in duration-700">
                Become Part of Our Team
            </h2>
            <p class="text-xl mb-10 max-w-3xl mx-auto opacity-90 animate-in fade-in duration-700 delay-100">
                If you are a passionate educator sharing our Christian values, we’d love to hear from you.
            </p>
            <a href="#contact"
                class="inline-block bg-white text-[#083873] px-10 py-4 rounded-lg font-bold hover:bg-gray-100 transition shadow-2xl animate-in fade-in duration-700 delay-200">
                Submit Your Application
            </a>
        </div>
    </section>
@endsection
