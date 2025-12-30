@extends('layouts.admin')

@section('title', 'Add Student')

@section('content')
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border p-8">
            <h1 class="text-3xl font-bold text-center mb-8 text-blue-900">DIVINE LIGHT INTERNATIONAL ACADEMY</h1>
            <p class="text-center text-gray-700 mb-8">(A Christian Rhetorical Montessori School)</p>
            <h2 class="text-2xl font-bold text-center mb-10">REGISTRATION FORM</h2>

            <form action="{{ route('admin.students.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label class="block font-medium">Name of child</label>
                        <div class="grid grid-cols-3 gap-4 mt-2">
                            <input type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}"
                                class="border rounded px-4 py-2" required>
                            <input type="text" name="other_names" placeholder="Other Names" value="{{ old('other_names') }}"
                                class="border rounded px-4 py-2">
                            <input type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}"
                                class="border rounded px-4 py-2" required>
                        </div>
                    </div>

                    <div>
                        <label class="block font-medium">Date of Birth</label>
                        <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"
                            class="w-full border rounded px-4 py-2 mt-2" required>
                    </div>

                    <div>
                        <label class="block font-medium">Mailing Address</label>
                        <textarea name="address" rows="3"
                            class="w-full border rounded px-4 py-2 mt-2">{{ old('address') }}</textarea>
                    </div>

                    <div>
                        <label class="block font-medium">Gender</label>
                        <select name="gender" class="w-full border rounded px-4 py-2 mt-2" required>
                            <option value="">Select</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium">Admission Session</label>
                        <select name="admission_session_id" class="w-full border rounded px-4 py-2 mt-2" required>
                            <option value="">Select Session</option>
                            @foreach(\App\Models\AcademicSession::orderByDesc('start_year')->get() as $session)
                                <option value="{{ $session->id }}" {{ old('admission_session_id') == $session->id ? 'selected' : '' }}>
                                    {{ $session->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-medium">Current Class</label>
                        <select name="class_id" class="w-full border rounded px-4 py-2 mt-2" required>
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                    {{ $class->display_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <h3 class="text-xl font-bold mb-4">Father</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <input type="text" name="father_name" placeholder="Name" value="{{ old('father_name') }}"
                        class="border rounded px-4 py-2">
                    <input type="text" name="father_occupation" placeholder="Occupation"
                        value="{{ old('father_occupation') }}" class="border rounded px-4 py-2">
                    <input type="text" name="father_office_phone" placeholder="Office Phone"
                        value="{{ old('father_office_phone') }}" class="border rounded px-4 py-2">
                    <input type="text" name="father_place_of_employment" placeholder="Place of Employment"
                        value="{{ old('father_place_of_employment') }}" class="border rounded px-4 py-2">
                </div>

                <h3 class="text-xl font-bold mb-4">Mother</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <input type="text" name="mother_name" placeholder="Name" value="{{ old('mother_name') }}"
                        class="border rounded px-4 py-2">
                    <input type="text" name="mother_occupation" placeholder="Occupation"
                        value="{{ old('mother_occupation') }}" class="border rounded px-4 py-2">
                    <input type="text" name="mother_office_phone" placeholder="Office Phone"
                        value="{{ old('mother_office_phone') }}" class="border rounded px-4 py-2">
                    <input type="text" name="mother_place_of_employment" placeholder="Place of Employment"
                        value="{{ old('mother_place_of_employment') }}" class="border rounded px-4 py-2">
                </div>

                <h3 class="text-xl font-bold mb-4">Guardians (if different from parents)</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <input type="text" name="guardian_name" placeholder="Name" value="{{ old('guardian_name') }}"
                        class="border rounded px-4 py-2">
                    <input type="text" name="guardian_occupation" placeholder="Occupation"
                        value="{{ old('guardian_occupation') }}" class="border rounded px-4 py-2">
                    <input type="text" name="guardian_office_phone" placeholder="Office Phone"
                        value="{{ old('guardian_office_phone') }}" class="border rounded px-4 py-2">
                    <input type="text" name="guardian_place_of_employment" placeholder="Place of Employment"
                        value="{{ old('guardian_place_of_employment') }}" class="border rounded px-4 py-2">
                </div>

                <h3 class="text-xl font-bold mb-4">Other Information</h3>
                <div class="space-y-6">
                    <textarea name="childhood_history" rows="3" placeholder="Childhood history"
                        class="w-full border rounded px-4 py-2">{{ old('childhood_history') }}</textarea>
                    <input type="text" name="last_school_attended" placeholder="Last school attended"
                        value="{{ old('last_school_attended') }}" class="w-full border rounded px-4 py-2">
                    <input type="text" name="languages_spoken_at_home"
                        placeholder="Languages child speaks / Primary language spoken at home"
                        value="{{ old('languages_spoken_at_home') }}" class="w-full border rounded px-4 py-2">
                    <textarea name="medical_history" rows="4" placeholder="Medical history (specify any chronic illness)"
                        class="w-full border rounded px-4 py-2">{{ old('medical_history') }}</textarea>
                </div>

                <div class="mt-10 flex justify-end gap-4">
                    <button type="submit"
                        class="bg-blue-600 text-white px-8 py-4 rounded-lg hover:bg-blue-700 text-lg font-medium">
                        Register Student
                    </button>
                    <a href="{{ route('admin.students.index') }}"
                        class="px-8 py-4 border rounded-lg hover:bg-gray-50 text-lg">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection