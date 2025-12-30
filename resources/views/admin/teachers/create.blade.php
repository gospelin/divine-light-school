@extends('layouts.admin')

@section('title', 'Add New Teacher')

@section('content')
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border p-10">
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-6 mb-8">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-medium text-red-800">Please correct the errors below:</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
            <h1 class="text-3xl font-bold mb-8 text-center text-blue-900">ADD NEW TEACHER</h1>

            <form action="{{ route('admin.teachers.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    <div>
                        <label class="block text-lg font-semibold mb-3">Full Name</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-lg font-semibold mb-3">Email Address</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-lg font-semibold mb-3">Phone Number</label>
                        <input type="text" name="phone" value="{{ old('phone') }}"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-lg font-semibold mb-3">Qualification</label>
                        <input type="text" name="qualification" value="{{ old('qualification') }}"
                            placeholder="e.g., B.Sc Education, NCE"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                    </div>
                    <div>
                        <label class="block text-lg font-semibold mb-3">Specialization (Optional)</label>
                        <input type="text" name="specialization" value="{{ old('specialization') }}"
                            placeholder="e.g., Mathematics, English Language"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-lg font-semibold mb-3">Date Employed</label>
                        <input type="date" name="date_employed" value="{{ old('date_employed') }}"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>

                <div class="mb-10">
                    <label class="block text-lg font-semibold mb-3">Home Address</label>
                    <textarea name="address" rows="4"
                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                        required>{{ old('address') }}</textarea>
                </div>

                <div class="mb-10">
                    <label class="block text-lg font-semibold mb-3">Bio / Notes (Optional)</label>
                    <textarea name="bio" rows="5"
                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">{{ old('bio') }}</textarea>
                </div>

                <div class="mb-10">
                    <label class="block text-lg font-semibold mb-3">Assign Classes (Current Session:
                        {{ $currentSession?->name ?? 'Not set' }})</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-h-96 overflow-y-auto p-4 bg-gray-50 rounded-lg">
                        @foreach($classes as $class)
                            <label class="flex items-center gap-3">
                                <input type="checkbox" name="class_ids[]" value="{{ $class->id }}"
                                    class="rounded text-blue-600 focus:ring-blue-500">
                                <span class="text-sm">{{ $class->display_name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end gap-6">
                    <button type="submit"
                        class="bg-blue-700 text-white px-10 py-4 rounded-lg hover:bg-blue-800 text-xl font-semibold shadow-lg">
                        Create Teacher Account
                    </button>
                    <a href="{{ route('admin.teachers.index') }}"
                        class="px-10 py-4 border-2 border-gray-300 rounded-lg hover:bg-gray-50 text-xl font-medium">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection