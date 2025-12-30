@extends('layouts.app')

@section('content')
    <!-- Hero -->
    <section class="relative w-full h-screen overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: linear-gradient(135deg, rgba(8,56,115,0.85), rgba(131,4,11,0.65)), url('{{ asset('images/classroom.jpg') }}');"></div>
        <div class="relative h-full flex items-center text-center text-white">
            <div class="container max-w-7xl mx-auto px-6">
                <h1 class="text-5xl md:text-7xl font-bold mb-8">School Videos</h1>
                <p class="text-xl md:text-3xl opacity-95">Watch highlights, events, and messages from Divine Light School</p>
            </div>
        </div>
    </section>

    <!-- Videos Grid -->
    <section class="py-16 bg-white">
        <div class="container max-w-7xl mx-auto px-6">
            @if($videos->count() === 0)
                <p class="text-center text-2xl text-gray-600">No videos yet. Check back soon!</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($videos as $video)
                        @php
                            $embedUrl = '';
                            if (str_contains($video->video_url, 'youtube')) {
                                preg_match("/(?:v=|\/)([a-zA-Z0-9_-]{11})/", $video->video_url, $m);
                                $embedUrl = 'https://www.youtube.com/embed/' . ($m[1] ?? '');
                            } elseif (str_contains($video->video_url, 'tiktok')) {
                                preg_match('/video\/(\d+)/', $video->video_url, $m);
                                $embedUrl = 'https://www.tiktok.com/embed/v2/' . ($m[1] ?? '');
                            }
                        @endphp

                        <div class="group bg-gray-50 rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl transition">
                            @if($embedUrl)
                                <div class="relative pb-[56.25%] h-0 overflow-hidden">
                                    <iframe class="absolute inset-0 w-full h-full" src="{{ $embedUrl }}" frameborder="0" allowfullscreen></iframe>
                                </div>
                            @endif
                            <div class="p-8">
                                <time class="text-sm text-[#83040b]">{{ $video->published_at->format('M d, Y') }}</time>
                                <h2 class="text-2xl font-bold mt-4">{{ $video->title }}</h2>
                                <p class="mt-4 line-clamp-3">{{ $video->excerpt }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-12">{{ $videos->links() }}</div>
            @endif
        </div>
    </section>
@endsection
