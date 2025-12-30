@extends('layouts.admin')

@section('content')
    <section class="py-16 bg-white min-h-screen">
        <div class="container max-w-7xl mx-auto px-6">
            <div class="flex justify-between items-center mb-12">
                <h1 class="text-4xl font-bold text-[#083873]">Manage Videos</h1>
                <a href="{{ route('admin.videos.create') }}" class="bg-[#83040b] text-white px-8 py-4 rounded-lg font-bold hover:bg-[#083873]">
                    Add New Video
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded-lg mb-8">{{ session('success') }}</div>
            @endif

            <div class="bg-gray-50 rounded-2xl shadow-xl overflow-hidden">
                <table class="w-full">
                    <thead class="bg-[#083873] text-white">
                        <tr>
                            <th class="px-8 py-6 text-left">Title</th>
                            <th class="px-8 py-6 text-left">Published</th>
                            <th class="px-8 py-6 text-left">Date</th>
                            <th class="px-8 py-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($videos as $video)
                            <tr class="border-b hover:bg-white">
                                <td class="px-8 py-6">{{ Str::limit($video->title, 50) }}</td>
                                <td class="px-8 py-6">
                                    <span class="{{ $video->published ? 'text-green-600' : 'text-gray-500' }}">
                                        {{ $video->published ? 'Yes' : 'Draft' }}
                                    </span>
                                </td>
                                <td class="px-8 py-6">{{ $video->created_at->format('M d, Y') }}</td>
                                <td class="px-8 py-6 text-center">
                                    <a href="{{ route('admin.videos.edit', $video) }}" class="text-[#083873] hover:underline mr-4">Edit</a>
                                    <form action="{{ route('admin.videos.destroy', $video) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Delete this video?')" class="text-red-600 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-10">{{ $videos->links() }}</div>
        </div>
    </section>
@endsection