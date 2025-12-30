{{-- resources/views/media.blade.php --}}
@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative w-full h-screen overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center animate-ken-burns"
            style="background-image: linear-gradient(135deg, rgba(8,56,115,0.85), rgba(131,4,11,0.65)), url('{{ asset('images/classroom.jpg') }}');">
        </div>
        <div class="relative h-full flex items-center">
            <div class="container max-w-7xl mx-auto px-6 sm:px-8 lg:px-16 text-center text-white">
                <h1
                    class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-8 animate-in fade-in slide-in-from-top duration-1000">
                    Media & Gallery
                </h1>
                <p
                    class="text-xl sm:text-2xl lg:text-3xl max-w-4xl mx-auto opacity-95 font-light animate-in fade-in duration-1000 delay-200">
                    Moments from school life, events, and achievements.
                </p>
            </div>
        </div>
    </section>

    <!-- Gallery Grid -->
    <section class="py-16 sm:py-24 bg-white">
        <div class="container max-w-7xl mx-auto px-6">
            <h2 class="text-4xl sm:text-5xl font-bold text-center mb-12 text-[#083873] animate-in fade-in duration-700">
                Photo Gallery
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Replace with actual image paths -->
                <div
                    class="rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition animate-in fade-in zoom-in duration-700 delay-100">
                    <img src="{{ asset('images/students.jpg') }}" alt="Students"
                        class="w-full h-80 object-cover hover:scale-110 transition duration-700">
                </div>
                <div
                    class="rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition animate-in fade-in zoom-in duration-700 delay-200">
                    <img src="{{ asset('images/classroom.jpg') }}" alt="Classroom"
                        class="w-full h-80 object-cover hover:scale-110 transition duration-700">
                </div>
                <div
                    class="rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition animate-in fade-in zoom-in duration-700 delay-300">
                    <img src="{{ asset('images/children-play.jpg') }}" alt="Playtime"
                        class="w-full h-80 object-cover hover:scale-110 transition duration-700">
                </div>
                <!-- Add more images as needed -->
                <div
                    class="rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition animate-in fade-in zoom-in duration-700 delay-100">
                    <img src="{{ asset('images/library.jpg') }}" alt="Library"
                        class="w-full h-80 object-cover hover:scale-110 transition duration-700">
                </div>
                <div
                    class="rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition animate-in fade-in zoom-in duration-700 delay-200">
                    <img src="{{ asset('images/IT-classroom.jpg') }}" alt="IT Classroom"
                        class="w-full h-80 object-cover hover:scale-110 transition duration-700">
                </div>
                <div
                    class="rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition animate-in fade-in zoom-in duration-700 delay-300">
                    <img src="{{ asset('images/school_building.jpg') }}" alt="School Building"
                        class="w-full h-80 object-cover hover:scale-110 transition duration-700">
                </div>
            </div>
        </div>
    </section>
@endsection