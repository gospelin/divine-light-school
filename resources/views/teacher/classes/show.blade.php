@extends('layouts.teacher')

@section('title', $class->display_name . ' - Students')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Header with Action Buttons -->
        <div class="mb-10 flex flex-col md:flex-row md:justify-between md:items-start gap-6">
            <div>
                <h1 class="text-4xl font-bold text-blue-900">{{ $class->display_name }}</h1>
                <p class="text-xl text-gray-600 mt-2">
                    Student List • {{ $currentSession?->name ?? 'Current Session' }}
                </p>
                <p class="text-lg text-gray-700 mt-4">
                    Total Students: <strong>{{ $students->count() }}</strong>
                </p>
            </div>

            <!-- Action Buttons (Stacked on mobile, side-by-side on desktop) -->
            <div class="flex flex-col sm:flex-row gap-4">
                <a href="{{ route('teacher.classes.subjects.index', $class) }}"
                    class="inline-flex items-center justify-center gap-3 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold px-8 py-4 rounded-xl shadow-lg hover:shadow-xl hover:from-indigo-700 hover:to-indigo-800 transition duration-300 transform hover:-translate-y-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add / Manage Subjects
                </a>

                <a href="{{ route('teacher.classes.results.index', $class) }}"
                    class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold px-8 py-4 rounded-xl shadow-lg hover:shadow-xl hover:from-green-700 hover:to-green-800 transition duration-300 transform hover:-translate-y-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2" />
                    </svg>
                    Enter Results (Broadsheet)
                </a>
            </div>
        </div>

        @if($students->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach($students as $student)
                    <div class="bg-white rounded-xl shadow-sm border overflow-hidden hover:shadow-lg transition duration-300">
                        <div class="h-32 bg-gradient-to-br from-blue-400 to-blue-600"></div>
                        <div class="p-6 -mt-16">
                            <div
                                class="w-24 h-24 bg-white rounded-full border-4 border-white shadow-lg mx-auto mb-4 overflow-hidden">
                                <div class="w-full h-full bg-gray-200 border-2 border-dashed rounded-full"></div>
                            </div>
                            <div class="text-center">
                                <h3 class="text-lg font-bold text-gray-800">{{ $student->fullName() }}</h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $student->admission_number }}</p>
                                <div class="mt-4 flex justify-center gap-3">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">
                                        {{ $student->gender }}
                                    </span>
                                    @if($student->date_of_birth)
                                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs">
                                            {{ $student->date_of_birth->age }} yrs
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="border-t px-6 py-4 bg-gray-50">
                            <div class="flex justify-between text-sm">
                                <a href="{{ route('teacher.students.show', $student) }}"
                                    class="text-indigo-600 hover:underline font-medium">
                                    View Profile
                                </a>
                                <a href="{{ route('teacher.students.edit', $student) }}"
                                    class="text-blue-600 hover:underline font-medium">
                                    Edit Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-12 text-center">
                <svg class="w-20 h-20 text-yellow-600 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <p class="text-2xl font-semibold text-yellow-800">No students enrolled</p>
                <p class="text-yellow-700 mt-3">This class has no students for the current session.</p>
            </div>
        @endif

        <div class="mt-12 text-center">
            <a href="{{ route('teacher.dashboard') }}"
                class="inline-flex items-center gap-2 text-blue-600 hover:underline font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Dashboard
            </a>
        </div>
    </div>
@endsection
