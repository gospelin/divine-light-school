@extends('layouts.admin')

@section('content')
    <section class="py-16 bg-white min-h-screen">
        <div class="container max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center mb-12">
                <h1 class="text-4xl font-bold text-[#083873]">Manage Gallery</h1>
                <a href="{{ route('admin.gallery.create') }}"
                    class="bg-[#83040b] text-white px-8 py-4 rounded-lg font-bold hover:bg-[#083873]">
                    Add New Photo
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-8">{{ session('success') }}</div>
            @endif

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @foreach($items as $item)
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden group">
                        @if($item->getFirstMediaUrl('images'))
                            <img src="{{ $item->getFirstMediaUrl('images', 'thumb') }}" alt="{{ $item->title }}"
                                class="w-full h-64 object-cover group-hover:scale-110 transition duration-500">
                        @else
                            <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-500">No Image</span>
                            </div>
                        @endif

                        <div class="p-6">
                            <h3 class="font-bold text-lg mb-2">{{ Str::limit($item->title, 30) }}</h3>
                            <p class="text-sm text-gray-600 mb-4">
                                <span class="{{ $item->published ? 'text-green-600' : 'text-gray-500' }}">
                                    {{ $item->published ? 'Published' : 'Draft' }}
                                </span>
                            </p>

                            <div class="flex justify-between">
                                <a href="{{ route('admin.gallery.edit', $item) }}"
                                    class="text-[#083873] hover:underline">Edit</a>
                                <form action="{{ route('admin.gallery.destroy', $item) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this photo?')"
                                        class="text-red-600 hover:underline">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">{{ $items->links() }}</div>
        </div>
    </section>
@endsection