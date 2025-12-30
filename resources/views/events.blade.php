{{-- resources/views/events.blade.php --}}
@extends('layouts.app')

@section('content')
    <!-- Hero -->
    <section class="relative w-full h-screen overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center animate-ken-burns"
            style="background-image: linear-gradient(135deg, rgba(8,56,115,0.85), rgba(131,4,11,0.65)), url('https://www.praiseelschools.com/wp-content/uploads/2023/04/events.jpg');">
        </div>
        <div class="relative h-full flex items-center">
            <div class="container max-w-7xl mx-auto px-6 sm:px-8 lg:px-16 text-center text-white">
                <h1
                    class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-8 animate-in fade-in slide-in-from-top duration-1000">
                    School Events
                </h1>
                <p
                    class="text-xl sm:text-2xl lg:text-3xl max-w-4xl mx-auto opacity-95 font-light animate-in fade-in duration-1000 delay-200">
                    Celebrating learning, faith, and community throughout the year.
                </p>
            </div>
        </div>
    </section>

    <!-- Events -->
    <section class="py-16 sm:py-24 bg-white">
        <div class="container max-w-7xl mx-auto px-6">
            <h2 class="text-4xl sm:text-5xl font-bold text-center mb-12 text-[#083873] animate-in fade-in duration-700">
                Upcoming Events
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <div class="bg-gray-50 rounded-2xl shadow-xl p-8 animate-in fade-in zoom-in duration-700 delay-100">
                    <h3 class="text-2xl font-bold mb-4 text-[#083873]">Christmas Celebration</h3>
                    <p class="text-lg mb-4">December 18, 2025</p>
                    <p class="opacity-90">Annual nativity play and carol service.</p>
                </div>
                <!-- Add more event cards with increasing delay-200, delay-300, etc. -->
            </div>

            <h2
                class="text-4xl sm:text-5xl font-bold text-center mt-20 mb-12 text-[#083873] animate-in fade-in duration-700 delay-100">
                Past Events
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <!-- Past event cards -->
            </div>
        </div>
    </section>
@endsection