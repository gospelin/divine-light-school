{{-- resources/views/blog/index.blade.php --}}
@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative w-full h-screen overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center animate-ken-burns"
            style="background-image: linear-gradient(135deg, rgba(8,56,115,0.85), rgba(131,4,11,0.65)), url('{{ asset('images/classroom.jpg') }}');">
        </div>
        <div class="relative h-full flex items-center">
            <div class="container max-w-7xl mx-auto px-6 sm:px-8 lg:px-16 text-center text-white">
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-8" data-aos="fade-up">
                    School Blog
                </h1>
                <p class="text-xl sm:text-2xl lg:text-3xl max-w-4xl mx-auto opacity-95 font-light" data-aos="fade-up"
                    data-aos-delay="200">
                    News, insights, and stories from the Divine Light community.
                </p>
            </div>
        </div>
    </section>

    <!-- Blog Posts Grid -->
    <section class="py-16 sm:py-24 bg-white">
        <div class="container max-w-7xl mx-auto px-6">
            @if($posts->count() === 0)
                <p class="text-center text-xl opacity-90">No blog posts yet. Check back soon!</p>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach($posts as $post)
                        <article
                            class="group bg-gray-50 rounded-2xl shadow-xl overflow-hidden transition-all duration-500 hover:shadow-2xl hover:-translate-y-3"
                            data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            @if($post->featured_image)
                                <div class="h-64 overflow-hidden">
                                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                </div>
                            @endif
                            <div class="p-8">
                                <!-- Fixed: Use PHP date() instead of ->format() -->
                                <time class="text-sm text-[#83040b] font-medium">
                                    {{ $post->published_at ? date('M d, Y', strtotime($post->published_at)) : '—' }}
                                </time>

                                <h2 class="text-2xl font-bold mt-4 mb-4 text-[#083873] group-hover:text-[#83040b] transition">
                                    <a href="{{ route('blog.show', $post) }}">{{ $post->title }}</a>
                                </h2>
                                <p class="text-base opacity-90 mb-6 line-clamp-3">{{ $post->excerpt }}</p>
                                <a href="{{ route('blog.show', $post) }}"
                                    class="inline-flex items-center gap-2 text-[#083873] font-bold hover:text-[#83040b] transition">
                                    Read More
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="mt-16">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection