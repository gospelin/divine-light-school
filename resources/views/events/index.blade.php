@extends('layouts.app')

@section('content')
    <!-- Hero -->
    <section class="relative w-full h-screen overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: linear-gradient(135deg, rgba(8,56,115,0.85), rgba(131,4,11,0.65)), url('https://www.praiseelschools.com/wp-content/uploads/2023/04/events.jpg');">
        </div>
        <div class="relative h-full flex items-center text-center text-white">
            <div class="container max-w-7xl mx-auto px-6">
                <h1 class="text-5xl md:text-7xl font-bold mb-8">School Events</h1>
                <p class="text-xl md:text-3xl opacity-95">Celebrating learning, faith, and community</p>
            </div>
        </div>
    </section>

    <!-- Upcoming Events -->
    <section class="py-16 bg-white">
        <div class="container max-w-7xl mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-12 text-[#083873]">Upcoming Events</h2>
            @if($upcoming->isEmpty())
                <p class="text-center text-xl text-gray-600">No upcoming events scheduled.</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($upcoming as $event)
                        <div class="bg-gray-50 rounded-2xl shadow-xl p-8 hover:shadow-2xl transition">
                            <h3 class="text-2xl font-bold mb-4 text-[#083873]">{{ $event->title }}</h3>
                            <p class="text-lg font-medium text-[#83040b] mb-2">
                                {{ $event->event_date->format('F j, Y \a\t g:i A') }}
                            </p>
                            @if($event->location)
                                <p class="text-gray-700 mb-4">📍 {{ $event->location }}</p>
                            @endif
                            <p class="opacity-90">{{ Str::limit($event->description, 150) }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Past Events -->
    <section class="py-16 bg-gray-100">
        <div class="container max-w-7xl mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-12 text-[#083873]">Past Events</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($past as $event)
                    <div class="bg-white rounded-2xl shadow-xl p-8 hover:shadow-2xl transition">
                        <h3 class="text-xl font-bold mb-3">{{ $event->title }}</h3>
                        <p class="text-gray-600">{{ $event->event_date->format('M j, Y') }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection