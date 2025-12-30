@extends('layouts.admin')

@section('title', 'Create Event')

@section('content')
    <section class="py-16 sm:py-24 bg-white min-h-screen">
        <div class="container max-w-7xl mx-auto px-6">
            <h1 class="text-4xl font-bold mb-12 text-[#083873]">Create New Event</h1>

            <form action="{{ route('admin.events.store') }}" method="POST" class="max-w-4xl">
                @csrf
                <div class="bg-gray-50 rounded-2xl shadow-xl p-10 space-y-8">
                    <div>
                        <label class="block text-lg font-medium mb-3">Title</label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                            class="w-full px-6 py-4 rounded-lg border focus:border-[#083873]">
                        @error('title')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-lg font-medium mb-3">Description</label>
                        <textarea name="description" rows="6" required
                            class="w-full px-6 py-4 rounded-lg border focus:border-[#083873]">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-lg font-medium mb-3">Event Date & Time</label>
                        <input type="datetime-local" name="event_date" value="{{ old('event_date') }}" required
                            class="w-full px-6 py-4 rounded-lg border focus:border-[#083873]">
                        @error('event_date')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-lg font-medium mb-3">Location (Optional)</label>
                        <input type="text" name="location" value="{{ old('location') }}"
                            placeholder="School Hall, Online, etc."
                            class="w-full px-6 py-4 rounded-lg border focus:border-[#083873]">
                        @error('location')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-4">
                        <input type="checkbox" name="published" id="published" value="1" {{ old('published') ? 'checked' : '' }}
                            class="w-6 h-6 text-[#083873]">
                        <label for="published" class="text-lg">Publish immediately</label>
                    </div>

                    <div class="flex gap-6">
                        <button type="submit"
                            class="bg-[#83040b] text-white px-10 py-4 rounded-lg font-bold hover:bg-[#083873] transition">
                            Create Event
                        </button>
                        <a href="{{ route('admin.events.index') }}"
                            class="px-10 py-4 border-2 border-gray-400 rounded-lg font-bold hover:bg-gray-100 transition">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection