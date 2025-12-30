@extends('layouts.teacher')

@section('title', $student->fullName() . ' - Profile')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <!-- Header with Photo -->
        <div class="h-48 bg-gradient-to-r from-blue-500 to-blue-700 relative">
            <div class="absolute -bottom-16 left-1/2 transform -translate-x-1/2">
                <div class="w-32 h-32 bg-white rounded-full border-8 border-white shadow-xl overflow-hidden">
                    <div class="w-full h-full bg-gray-200 border-4 border-dashed rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Student Info -->
        <div class="pt-20 pb-10 px-10 text-center">
            <h1 class="text-4xl font-bold text-blue-900">{{ $student->fullName() }}</h1>
            <p class="text-2xl text-gray-700 mt-2">{{ $student->admission_number }}</p>
            <div class="mt-4 flex justify-center gap-6 text-lg">
                <span class="bg-blue-100 text-blue-800 px-5 py-2 rounded-full font-medium">
                    {{ $currentClass?->display_name ?? 'Not assigned' }}
                </span>
                <span class="bg-green-100 text-green-800 px-5 py-2 rounded-full font-medium">
                    {{ $student->gender }}
                </span>
                @if($student->date_of_birth)
                    <span class="bg-purple-100 text-purple-800 px-5 py-2 rounded-full font-medium">
                        {{ $student->date_of_birth->age }} years old
                    </span>
                @endif
            </div>
        </div>

        <!-- Details Grid -->
        <div class="px-10 pb-10 grid grid-cols-1 md:grid-cols-2 gap-10">
            <!-- Personal Info -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Personal Information</h2>
                <dl class="space-y-5">
                    <div class="flex justify-between border-b pb-3">
                        <dt class="text-gray-600">Date of Birth</dt>
                        <dd class="font-medium">
                            {{ $student->date_of_birth?->format('d M Y') ?? 'Not provided' }}
                        </dd>
                    </div>
                    <div class="flex justify-between border-b pb-3">
                        <dt class="text-gray-600">Parent Phone</dt>
                        <dd class="font-medium">{{ $student->parent_phone ?? 'Not provided' }}</dd>
                    </div>
                    <div class="flex justify-between border-b pb-3">
                        <dt class="text-gray-600">Address</dt>
                        <dd class="font-medium text-right">{{ $student->address ?? 'Not provided' }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Parent/Guardian Info -->
            <div>
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Parent & Guardian</h2>
                <dl class="space-y-5">
                    <div class="flex justify-between border-b pb-3">
                        <dt class="text-gray-600">Father</dt>
                        <dd class="font-medium text-right">{{ $student->father_name ?? 'Not provided' }}</dd>
                    </div>
                    <div class="flex justify-between border-b pb-3">
                        <dt class="text-gray-600">Mother</dt>
                        <dd class="font-medium text-right">{{ $student->mother_name ?? 'Not provided' }}</dd>
                    </div>
                    <div class="flex justify-between border-b pb-3">
                        <dt class="text-gray-600">Guardian</dt>
                        <dd class="font-medium text-right">{{ $student->guardian_name ?? 'Same as parents' }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Medical & Other -->
            <div class="md:col-span-2">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Medical & Other Information</h2>
                <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                    <h3 class="font-semibold text-red-800 mb-3">Medical History</h3>
                    <p class="text-red-700">
                        {{ $student->medical_history ?: 'No known chronic illnesses or conditions reported.' }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-2">Last School Attended</h3>
                        <p class="text-gray-700">{{ $student->last_school_attended ?: 'First school' }}</p>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-2">Languages Spoken at Home</h3>
                        <p class="text-gray-700">{{ $student->languages_spoken_at_home ?: 'Not specified' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="border-t bg-gray-50 px-10 py-6 flex justify-center gap-6">
            <a href="{{ route('teacher.students.edit', $student) }}"
               class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition font-medium">
                Edit Details
            </a>
            <a href="{{ route('teacher.classes.show', $currentClass) }}"
               class="px-8 py-3 border-2 border-gray-300 rounded-lg hover:bg-gray-100 transition font-medium">
                Back to Class
            </a>
        </div>
    </div>
</div>
@endsection
