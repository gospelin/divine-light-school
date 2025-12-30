@extends('layouts.admin')

@section('title', 'Edit Student')

@section('content')
    <div class="max-w-6xl mx-auto">
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
            <div class="text-center mb-10">
                <h1 class="text-4xl font-bold text-blue-900">DIVINE LIGHT INTERNATIONAL ACADEMY</h1>
                <p class="text-lg text-gray-700 mt-2">(A Christian Rhetorical Montessori School)</p>
                <p class="text-sm text-gray-600 mt-1">Day Care • Activity • Nursery • Primary • Secondary</p>
                <h2 class="text-3xl font-bold text-blue-800 mt-6">EDIT STUDENT REGISTRATION</h2>
                <p class="text-lg text-gray-600 mt-4">Admission Number: <strong>{{ $student->admission_number }}</strong></p>
            </div>

            <div class="mb-8 bg-gray-50 p-6 rounded-lg">
                <label class="block text-lg font-semibold mb-3 text-gray-700">Admission Number (Auto-generated)</label>
                <input type="text" value="{{ $student->admission_number }}"
                    class="w-full bg-gray-100 border border-gray-300 rounded-lg px-4 py-3 text-gray-700" readonly>
                <p class="text-sm text-gray-600 mt-2">This number was auto-generated and cannot be changed.</p>
            </div>

            <form action="{{ route('admin.students.update', $student) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Student Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <div class="md:col-span-2">
                        <label class="block text-lg font-semibold mb-3">Name of Child</label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <input type="text" name="first_name" placeholder="First Name" 
                                   value="{{ old('first_name', $student->first_name) }}"
                                   class="border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                            <input type="text" name="other_names" placeholder="Other Names" 
                                   value="{{ old('other_names', $student->other_names) }}"
                                   class="border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                            <input type="text" name="last_name" placeholder="Last Name" 
                                   value="{{ old('last_name', $student->last_name) }}"
                                   class="border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-lg font-semibold mb-3">Date of Birth</label>
                        <input type="date" name="date_of_birth" 
                               value="{{ old('date_of_birth', $student->date_of_birth?->format('Y-m-d')) }}"
                               class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                    <div>
                        <label class="block text-lg font-semibold mb-3">Mailing Address</label>
                        <textarea name="address" rows="4" 
                                  class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">{{ old('address', $student->address) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-lg font-semibold mb-3">Gender</label>
                        <select name="gender" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                            <option value="">Select Gender</option>
                            <option value="Male" {{ old('gender', $student->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $student->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>

                        <label class="block text-lg font-semibold mt-6 mb-3">Admission Session</label>
                        <select name="admission_session_id" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                            <option value="">Select Session</option>
                            @foreach($sessions as $session)
                                <option value="{{ $session->id }}" 
                                        {{ old('admission_session_id', $student->admission_session_id) == $session->id ? 'selected' : '' }}>
                                    {{ $session->name }}
                                </option>
                            @endforeach
                        </select>

                        <label class="block text-lg font-semibold mt-6 mb-3">Current Class</label>
                        <select name="class_id" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
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

                <!-- Father -->
                <h3 class="text-2xl font-bold text-blue-800 mb-6 mt-12">Father</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                    <input type="text" name="father_name" placeholder="Name" 
                           value="{{ old('father_name', $student->father_name) }}" class="border rounded-lg px-4 py-3">
                    <input type="text" name="father_occupation" placeholder="Occupation" 
                           value="{{ old('father_occupation', $student->father_occupation) }}" class="border rounded-lg px-4 py-3">
                    <input type="text" name="father_office_phone" placeholder="Office Phone" 
                           value="{{ old('father_office_phone', $student->father_office_phone) }}" class="border rounded-lg px-4 py-3">
                    <input type="text" name="father_place_of_employment" placeholder="Place of Employment" 
                           value="{{ old('father_place_of_employment', $student->father_place_of_employment) }}" class="border rounded-lg px-4 py-3">
                </div>

                <!-- Mother -->
                <h3 class="text-2xl font-bold text-blue-800 mb-6 mt-12">Mother</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                    <input type="text" name="mother_name" placeholder="Name" 
                           value="{{ old('mother_name', $student->mother_name) }}" class="border rounded-lg px-4 py-3">
                    <input type="text" name="mother_occupation" placeholder="Occupation" 
                           value="{{ old('mother_occupation', $student->mother_occupation) }}" class="border rounded-lg px-4 py-3">
                    <input type="text" name="mother_office_phone" placeholder="Office Phone" 
                           value="{{ old('mother_office_phone', $student->mother_office_phone) }}" class="border rounded-lg px-4 py-3">
                    <input type="text" name="mother_place_of_employment" placeholder="Place of Employment" 
                           value="{{ old('mother_place_of_employment', $student->mother_place_of_employment) }}" class="border rounded-lg px-4 py-3">
                </div>

                <!-- Guardian -->
                <h3 class="text-2xl font-bold text-blue-800 mb-6 mt-12">Guardian (if different from parents)</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                    <input type="text" name="guardian_name" placeholder="Name" 
                           value="{{ old('guardian_name', $student->guardian_name) }}" class="border rounded-lg px-4 py-3">
                    <input type="text" name="guardian_occupation" placeholder="Occupation" 
                           value="{{ old('guardian_occupation', $student->guardian_occupation) }}" class="border rounded-lg px-4 py-3">
                    <input type="text" name="guardian_office_phone" placeholder="Office Phone" 
                           value="{{ old('guardian_office_phone', $student->guardian_office_phone) }}" class="border rounded-lg px-4 py-3">
                    <input type="text" name="guardian_place_of_employment" placeholder="Place of Employment" 
                           value="{{ old('guardian_place_of_employment', $student->guardian_place_of_employment) }}" class="border rounded-lg px-4 py-3">
                </div>

                <!-- Other Information -->
                <h3 class="text-2xl font-bold text-blue-800 mb-6 mt-12">Other Information</h3>
                <div class="space-y-8">
                    <div>
                        <label class="block text-lg font-semibold mb-3">Childhood History</label>
                        <textarea name="childhood_history" rows="4" 
                                  class="w-full border rounded-lg px-4 py-3">{{ old('childhood_history', $student->childhood_history) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-lg font-semibold mb-3">Last School Attended</label>
                        <input type="text" name="last_school_attended" 
                               value="{{ old('last_school_attended', $student->last_school_attended) }}" 
                               class="w-full border rounded-lg px-4 py-3">
                    </div>

                    <div>
                        <label class="block text-lg font-semibold mb-3">Languages Child Speaks / Primary Language Spoken at Home</label>
                        <input type="text" name="languages_spoken_at_home" 
                               value="{{ old('languages_spoken_at_home', $student->languages_spoken_at_home) }}" 
                               class="w-full border rounded-lg px-4 py-3">
                    </div>

                    <div>
                        <label class="block text-lg font-semibold mb-3">Medical History (specify any chronic illness)</label>
                        <textarea name="medical_history" rows="5" 
                                  class="w-full border rounded-lg px-4 py-3">{{ old('medical_history', $student->medical_history) }}</textarea>
                    </div>
                </div>

                <!-- Submit -->
                <div class="mt-12 flex justify-end gap-6">
                    <button type="submit" class="bg-green-700 text-white px-10 py-4 rounded-lg hover:bg-green-800 text-xl font-semibold shadow-lg">
                        Update Student
                    </button>
                    <a href="{{ route('admin.students.index') }}" class="px-10 py-4 border-2 border-gray-300 rounded-lg hover:bg-gray-50 text-xl font-medium">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection