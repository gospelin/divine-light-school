@extends('layouts.admin')

@section('title', 'Add New Subject')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border p-10">
            <h1 class="text-3xl font-bold mb-8 text-center text-blue-900">ADD NEW SUBJECT</h1>

            <form action="{{ route('admin.subjects.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    <div>
                        <label class="block text-lg font-semibold mb-3">Subject Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            placeholder="e.g., Mathematics, English Language, Biology"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                        @error('name')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-lg font-semibold mb-3">Category</label>
                        <select name="category" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                            required>
                            <option value="">Select Category</option>
                            <option value="Core" {{ old('category') == 'Core' ? 'selected' : '' }}>Core</option>
                            <option value="Elective" {{ old('category') == 'Elective' ? 'selected' : '' }}>Elective</option>
                        </select>
                        @error('category')
                            <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-6">
                    <button type="submit"
                        class="bg-blue-700 text-white px-10 py-4 rounded-lg hover:bg-blue-800 text-xl font-semibold shadow-lg">
                        Create Subject
                    </button>
                    <a href="{{ route('admin.subjects.index') }}"
                        class="px-10 py-4 border-2 border-gray-300 rounded-lg hover:bg-gray-50 text-xl font-medium">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection