@extends('layouts.teacher')

@section('title', 'Edit Student - ' . $student->fullName())

@section('content')
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border p-10">
            <h1 class="text-3xl font-bold mb-8 text-center text-blue-900">EDIT STUDENT DETAILS</h1>
            <p class="text-center text-gray-700 mb-10">
                {{ $student->fullName() }} • {{ $student->admission_number }}
            </p>

            <form action="{{ route('teacher.students.update', $student) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Same form as admin edit, but simplified -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <div class="md:col-span-2">
                        <label class="block text-lg font-semibold mb-3">Name of Child</label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <input type="text" name="first_name" value="{{ old('first_name', $student->first_name) }}"
                                   class="border rounded-lg px-4 py-3" required>
                            <input type="text" name="other_names" value="{{ old('other_names', $student->other_names) }}"
                                   class="border rounded-lg px-4 py-3">
                            <input type="text" name="last_name" value="{{ old('last_name', $student->last_name) }}"
                                   class="border rounded-lg px-4 py-3" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-lg font-semibold mb-3">Date of Birth</label>
                        <input type="date" name="date_of_birth"
                               value="{{ old('date_of_birth', $student->date_of_birth?->format('Y-m-d')) }}"
                               class="w-full border rounded-lg px-4 py-3" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                    <div>
                        <label class="block text-lg font-semibold mb-3">Gender</label>
                        <select name="gender" class="w-full border rounded-lg px-4 py-3" required>
                            <option value="Male" {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-lg font-semibold mb-3">Current Class</label>
                        <select name="class_id" class="w-full border rounded-lg px-4 py-3" required>
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}"
                                    {{ old('class_id', $currentEnrollment?->id) == $class->id ? 'selected' : '' }}>
                                    {{ $class->display_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                    <div>
                        <label class="block text-lg font-semibold mb-3">Parent Phone</label>
                        <input type="text" name="parent_phone" value="{{ old('parent_phone', $student->parent_phone) }}"
                               class="w-full border rounded-lg px-4 py-3">
                    </div>
                    <div>
                        <label class="block text-lg font-semibold mb-3">Address</label>
                        <textarea name="address" rows="3" class="w-full border rounded-lg px-4 py-3">{{ old('address', $student->address) }}</textarea>
                    </div>
                </div>

                <div class="mb-10">
                    <label class="block text-lg font-semibold mb-3">Medical History</label>
                    <textarea name="medical_history" rows="4" class="w-full border rounded-lg px-4 py-3">{{ old('medical_history', $student->medical_history) }}</textarea>
                </div>

                <div class="flex justify-end gap-6">
                    <button type="submit" class="bg-green-700 text-white px-10 py-4 rounded-lg hover:bg-green-800 text-xl font-semibold">
                        Update Student
                    </button>
                    <a href="{{ route('teacher.classes.show', $currentEnrollment) }}" class="px-10 py-4 border-2 border-gray-300 rounded-lg hover:bg-gray-50 text-xl font-medium">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection