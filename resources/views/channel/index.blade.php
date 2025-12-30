@extends('layouts.app')

@section('content')
    <!-- Hero -->
    <section class="relative w-full h-screen overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: linear-gradient(135deg, rgba(8,56,115,0.85), rgba(131,4,11,0.65)), url('{{ asset('images/classroom.jpg') }}');">
        </div>
        <div class="relative h-full flex items-center">
            <div class="container max-w-7xl mx-auto px-6 text-center text-white">
                <h1 class="text-5xl md:text-7xl font-bold mb-8">School Channel</h1>
                <p class="text-xl md:text-3xl opacity-95">Latest news, videos, and moments from Divine Light School</p>
            </div>
        </div>
    </section>

    <!-- Filters -->
    <section class="py-16 bg-white">
        <div class="container max-w-7xl mx-auto px-6">
            <div class="flex justify-center gap-8 mb-12 flex-wrap">
                <a href="{{ route('channel.index') }}"
                    class="{{ $filter ? '' : 'bg-[#083873] text-white' }} px-8 py-3 rounded-full font-bold hover:bg-[#083873] hover:text-white transition">
                    All Content
                </a>
                <a href="{{ route('channel.index', ['filter' => 'blog']) }}"
                    class="{{ $filter === 'blog' ? 'bg-[#083873] text-white' : '' }} px-8 py-3 rounded-full font-bold hover:bg-[#083873] hover:text-white transition">
                    News & Blog
                </a>
                <a href="{{ route('channel.index', ['filter' => 'video']) }}"
                    class="{{ $filter === 'video' ? 'bg-[#083873] text-white' : '' }} px-8 py-3 rounded-full font-bold hover:bg-[#083873] hover:text-white transition">
                    Videos
                </a>
                <a href="{{ route('channel.index', ['filter' => 'photo']) }}"
                    class="{{ $filter === 'photo' ? 'bg-[#083873] text-white' : '' }} px-8 py-3 rounded-full font-bold hover:bg-[#083873] hover:text-white transition">
                    Photos
                </a>
            </div>

            @if($feed->isEmpty())
                <p class="text-center text-2xl text-gray-600">No content yet. Check back soon!</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($feed as $entry)
                        @if($entry->type === 'blog')
                            <article
                                class="group bg-gray-50 rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl hover:-translate-y-3 transition">
                                @if($entry->item->featured_image)
                                    <img src="{{ Storage::url($entry->item->featured_image) }}" class="w-full h-64 object-cover">
                                @endif
                                <div class="p-8">
                                    <span class="text-sm text-[#83040b]">Blog • {{ $entry->date->format('M d, Y') }}</span>
                                    <h2 class="text-2xl font-bold mt-4">
                                        <a href="{{ route('blog.show', $entry->item) }}">{{ $entry->item->title }}</a>
                                    </h2>
                                    <p class="mt-4 line-clamp-3">{{ $entry->item->excerpt }}</p>
                                    <a href="{{ route('blog.show', $entry->item) }}"
                                        class="mt-6 inline-block text-[#083873] font-bold hover:text-[#83040b]">Read More →</a>
                                </div>
                            </article>

                        @elseif($entry->type === 'video')
                            @php
                                $embedUrl = '';
                                if (str_contains($entry->item->video_url, 'youtube.com') || str_contains($entry->item->video_url, 'youtu.be')) {
                                    preg_match("/(?:v=|\/)([a-zA-Z0-9_-]{11})/", $entry->item->video_url, $m);
                                    $embedUrl = 'https://www.youtube.com/embed/' . ($m[1] ?? '');
                                } elseif (str_contains($entry->item->video_url, 'tiktok.com')) {
                                    preg_match('/video\/(\d+)/', $entry->item->video_url, $m);
                                    $embedUrl = 'https://www.tiktok.com/embed/v2/' . ($m[1] ?? '');
                                }
                            @endphp
                            <article
                                class="group bg-gray-50 rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl hover:-translate-y-3 transition">
                                @if($embedUrl)
                                    <div class="relative pb-[56.25%] h-0 overflow-hidden">
                                        <iframe class="absolute inset-0 w-full h-full" src="{{ $embedUrl }}" frameborder="0"
                                            allowfullscreen></iframe>
                                    </div>
                                @endif
                                <div class="p-8">
                                    <span class="text-sm text-[#83040b]">Video • {{ $entry->date->format('M d, Y') }}</span>
                                    <h2 class="text-2xl font-bold mt-4">{{ $entry->item->title }}</h2>
                                    <p class="mt-4 line-clamp-3">{{ $entry->item->excerpt }}</p>
                                </div>
                            </article>

                        @elseif($entry->type === 'photo')
                            <article
                                class="group relative rounded-2xl shadow-xl overflow-hidden hover:shadow-2xl hover:-translate-y-3 transition">
                                @if($entry->item->getFirstMediaUrl('images', 'thumb'))
                                    <img src="{{ $entry->item->getFirstMediaUrl('images', 'thumb') }}" class="w-full h-96 object-cover">
                                @endif
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent p-8 flex flex-col justify-end text-white">
                                    <span class="text-sm opacity-90">Photo • {{ $entry->date->format('M d, Y') }}</span>
                                    <h2 class="text-2xl font-bold mt-2">{{ $entry->item->title }}</h2>
                                    @if($entry->item->description)
                                        <p class="mt-2 opacity-90">{{ Str::limit($entry->item->description, 100) }}</p>
                                    @endif
                                </div>
                            </article>
                        @endif
                    @endforeach
                </div>

                <!-- Pagination Links -->
                <div class="mt-16">
                    {{ $feed->appends(['filter' => $filter])->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
