{{-- resources/views/blog/show-maximalist-refined.blade.php --}}
@extends('layouts.app')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,900&family=Cormorant+Garamond:wght@500;600&family=Libre+Baskerville:ital@0;1&display=swap');

        .ornament {
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 10"><path d="M0 5 Q25 0 50 5 T100 5" stroke="%23b8975b" stroke-width="2" fill="none"/></svg>');
            background-repeat: repeat-x;
            height: 12px;
            background-position: center;
            background-size: 50px 10px;
        }

        .frame-border {
            border-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><rect x="1" y="1" width="8" height="8" fill="none" stroke="%23b8975b" stroke-width="1.5"/></svg>') 20 stretch;
            border-image-width: 12px;
        }

        @keyframes ken-burns {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }

        .animate-ken-burns {
            animation: ken-burns 20s ease-out infinite alternate;
        }

        [x-cloak] { display: none !important; }
    </style>

    <!-- Hero: Opulent but Balanced -->
    <section class="relative min-h-[80vh] flex items-end pb-20 bg-cover bg-center animate-ken-burns"
        style="background-image: linear-gradient(135deg, rgba(8,56,115,0.85), rgba(131,4,11,0.65)), url('{{ $post->featured_image ? Storage::url($post->featured_image) : asset('images/classroom.jpg') }}');">
        <div class="container max-w-6xl mx-auto px-8">
            <div class="max-w-4xl">
                <div class="ornament mb-6"></div>
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-serif leading-tight text-white drop-shadow-2xl"
                    style="font-family: 'Playfair Display', serif; font-style: italic;">
                    {{ $post->title }}
                </h1>
                <p class="text-xl md:text-2xl mt-6 text-amber-200 font-light italic"
                    style="font-family: 'Libre Baskerville', serif;">
                    By {{ $post->author->name }} — {{ $post->published_at?->format('F j, Y') }}
                </p>
                <div class="ornament mt-8 transform scale-y-[-1]"></div>
            </div>
        </div>
    </section>

    <!-- Main Content: Luxurious Frame -->
    <section class="py-16 md:py-24 bg-gradient-to-b from-amber-50/50 to-white">
        <div class="container max-w-4xl mx-auto px-8">
            <div class="bg-white shadow-2xl p-10 md:p-16 frame-border">
                <!-- Lead Excerpt -->
                <div
                    class="text-xl md:text-2xl font-serif italic leading-relaxed text-amber-900 mb-10 border-l-8 border-double border-amber-700 pl-10">
                    {{ $post->excerpt }}
                </div>

                <!-- Article Body -->
                <article
                    class="prose prose-lg max-w-none
                                   prose-headings:font-serif prose-headings:text-amber-900
                                   prose-h1:text-3xl md:prose-h1:text-5xl prose-h1:leading-tight prose-h1:my-12 prose-h1:text-center prose-h1:italic
                                   prose-h2:text-2xl md:prose-h2:text-4xl prose-h2:my-10 prose-h2:border-b-4 prose-h2:border-double prose-h2:border-amber-700 prose-h2:pb-4
                                   prose-h3:text-xl md:prose-h3:text-3xl prose-h3:font-semibold prose-h3:my-8
                                   prose-p:text-lg md:prose-p:text-xl prose-p:leading-relaxed prose-p:my-7 prose-p:font-serif prose-p:text-gray-800
                                   prose-strong:font-semibold prose-strong:text-amber-900 
                                   prose-a:text-amber-800 prose-a:font-medium prose-a:no-underline hover:prose-a:underline hover:prose-a:text-amber-900
                                   prose-blockquote:border-l-8 prose-blockquote:border-double prose-blockquote:border-amber-700 prose-blockquote:pl-10 prose-blockquote:py-6 prose-blockquote:text-xl prose-blockquote:italic prose-blockquote:font-serif prose-blockquote:text-amber-900 prose-blockquote:bg-amber-50/30 prose-blockquote:rounded-r-lg
                                   prose-ul:my-8 prose-ol:my-8 prose-li:my-4 prose-li:text-lg
                                   prose-img:rounded-none prose-img:border-8 prose-img:border-amber-800 prose-img:my-14 prose-img:shadow-xl
                                   prose-figcaption:text-center prose-figcaption:italic prose-figcaption:text-amber-900 prose-figcaption:text-lg prose-figcaption:mt-6 prose-figcaption:font-serif"
                    data-aos="fade-up">
                    {!! $post->body !!}
                </article>

                <!-- Back to Blog -->
                <div class="mt-20 pt-12 text-center border-t-4 border-double border-amber-700">
                    <div class="ornament mb-6"></div>
                    <a href="{{ route('blog.index') }}"
                        class="text-2xl md:text-3xl font-serif italic text-amber-900 hover:text-amber-700 transition duration-300">
                        ← Return to view all articles
                    </a>
                    <div class="ornament mt-6 transform scale-y-[-1]"></div>
                </div>
            </div>
        </div>
    </section>
@endsection