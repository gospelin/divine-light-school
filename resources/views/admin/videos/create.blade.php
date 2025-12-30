@extends('layouts.admin')

@section('title', 'Add Video')

@section('content')
    <section class="py-16 bg-white min-h-screen">
        <div class="container max-w-7xl mx-auto px-6">
            <h1 class="text-4xl font-bold mb-12 text-[#083873]">Add New Video</h1>

            <form action="{{ route('admin.videos.store') }}" method="POST" class="max-w-4xl">
                @csrf
                <div class="bg-gray-50 rounded-2xl shadow-xl p-10 space-y-8">
                    <div>
                        <label class="block text-lg font-medium mb-3">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                            class="w-full px-6 py-4 rounded-lg border">
                    </div>

                    <div>
                        <label class="block text-lg font-medium mb-3">Excerpt (Short Description)</label>
                        <textarea name="excerpt" rows="4" required
                            class="w-full px-6 py-4 rounded-lg border">{{ old('excerpt') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-lg font-medium mb-3">Video URL (YouTube or TikTok)</label>
                        <input type="url" name="video_url" value="{{ old('video_url') }}" required
                            placeholder="https://www.youtube.com/watch?v=..." class="w-full px-6 py-4 rounded-lg border">
                    </div>

                    <div class="flex items-center gap-4">
                        <input type="checkbox" name="published" id="published" value="1" {{ old('published') ? 'checked' : '' }} class="w-6 h-6 text-[#083873]">
                        <label for="published" class="text-lg">Publish immediately</label>
                    </div>

                    <div class="flex gap-6">
                        <button type="submit"
                            class="bg-[#83040b] text-white px-10 py-4 rounded-lg font-bold hover:bg-[#083873]">Save
                            Video</button>
                        <a href="{{ route('admin.videos.index') }}"
                            class="px-10 py-4 border-2 border-gray-400 rounded-lg font-bold hover:bg-gray-100">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection