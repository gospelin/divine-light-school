@extends('layouts.app')

@section('content')
    <!-- Hero -->
    <section class="relative w-full h-screen overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center"
            style="background-image: linear-gradient(135deg, rgba(8,56,115,0.85), rgba(131,4,11,0.65)), url('{{ asset('images/classroom.jpg') }}');">
        </div>
        <div class="relative h-full flex items-center text-center text-white">
            <div class="container max-w-7xl mx-auto px-6">
                <h1 class="text-5xl md:text-7xl font-bold mb-8">Photo Gallery</h1>
                <p class="text-xl md:text-3xl opacity-95">Capturing moments from school life</p>
            </div>
        </div>
    </section>

    <!-- Gallery -->
    <section class="py-16 bg-white">
        <div class="container max-w-7xl mx-auto px-6">
            @if($photos->count() === 0)
                <p class="text-center text-2xl text-gray-600">No photos yet.</p>
            @else
                <!-- Use Tailwind + Masonry plugin or CSS columns (best for responsiveness) -->
                <div class="columns-2 sm:columns-3 lg:columns-4 gap-6 space-y-6">
                    @foreach($photos as $photo)
                        <a href="{{ $photo->getFirstMediaUrl('images') }}" data-lightbox="gallery"
                            data-title="{{ $photo->title }}<br>{{ $photo->description ?? '' }}" class="block break-inside-avoid mb-6 group">
                            <img src="{{ $photo->getFirstMediaUrl('images', 'thumb') }}" alt="{{ $photo->title }}"
                                class="w-full rounded-xl shadow-lg hover:shadow-2xl transition duration-300 object-cover">
                            <div class="mt-3 text-center">
                                <h3 class="font-semibold text-lg">{{ $photo->title }}</h3>
                                <p class="text-sm text-gray-600">{{ $photo->published_at->format('M Y') }}</p>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="mt-12">{{ $photos->links() }}</div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': "Image %1 of %2"
        })
    </script>
@endpush