@extends('layouts.teacher')

@section('title', 'Teacher Dashboard')

@section('content')
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-10">
            <h1 class="text-4xl font-bold text-blue-900">Welcome back, {{ auth()->user()->name }}!</h1>
            <p class="text-xl text-gray-600 mt-2">
                Teacher Dashboard • {{ $currentSession?->name ?? 'Current Session' }}
            </p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Classes Assigned</p>
                        <p class="text-3xl font-bold text-blue-700 mt-2">{{ $teacher->classes->count() }}</p>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-full">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M3 10V7a1 1 0 011-1h16a1 1 0 011 1v3" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Total Students</p>
                        <p class="text-3xl font-bold text-green-700 mt-2">{{ $totalStudents }}</p>
                    </div>
                    <div class="bg-green-100 p-4 rounded-full">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Specialization</p>
                        <p class="text-xl font-semibold text-purple-700 mt-2">
                            {{ $teacher->specialization ?? 'General' }}
                        </p>
                    </div>
                    <div class="bg-purple-100 p-4 rounded-full">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-600">Date Employed</p>
                        <p class="text-xl font-semibold text-gray-700 mt-2">
                            {{ $teacher->date_employed->format('d M Y') }}
                        </p>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-full">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- My Classes -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">My Classes This Session</h2>

            @if($teacher->classes->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($teacher->classes as $class)
                        @php
                            $classStudents = $class->students()
                                ->wherePivot('academic_session_id', $currentSession?->id)
                                ->count();
                        @endphp
                        <div class="bg-white border rounded-xl shadow-sm p-6 hover:shadow-md transition">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-bold text-blue-800">
                                    {{ $class->display_name }}
                                </h3>
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                    {{ $classStudents }} students
                                </span>
                            </div>

                            <p class="text-gray-600 mb-6">
                                You are assigned to teach this class for the current session.
                            </p>

                            <div class="flex gap-3">
                                <a href="{{ route('teacher.classes.show', $class) }}"
                                    class="flex-1 text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition text-sm">
                                    View Students
                                </a>
                                <a href="{{ route('teacher.classes.subjects.index', $class) }}"
                                    class="flex-1 text-center bg-var(--accent) text-white py-2 rounded-lg hover:bg-var(--accent-hover) transition text-sm font-medium">
                                    Manage Subjects
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-8 text-center">
                    <svg class="w-16 h-16 text-yellow-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <p class="text-xl text-yellow-800 font-medium">No classes assigned yet</p>
                    <p class="text-yellow-700 mt-2">Contact the administrator to assign you to classes for this session.</p>
                </div>
            @endif
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl p-8 shadow-lg">
                <h3 class="text-2xl font-bold mb-3">Take Attendance</h3>
                <p class="mb-6 opacity-90">Mark daily attendance for your classes</p>
                <a href="#" class="bg-white text-blue-600 px-6 py-3 rounded-lg hover:bg-gray-100 transition font-medium">
                    Open Attendance →
                </a>
            </div>

            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl p-8 shadow-lg">
                <h3 class="text-2xl font-bold mb-3">Enter Results</h3>
                <p class="mb-6 opacity-90">Record test and exam scores</p>
                <a href="#" class="bg-white text-green-600 px-6 py-3 rounded-lg hover:bg-gray-100 transition font-medium">
                    Enter Scores →
                </a>
            </div>

            <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-xl p-8 shadow-lg">
                <h3 class="text-2xl font-bold mb-3">View Reports</h3>
                <p class="mb-6 opacity-90">Performance analytics and broadsheets</p>
                <a href="#" class="bg-white text-purple-600 px-6 py-3 rounded-lg hover:bg-gray-100 transition font-medium">
                    View Reports →
                </a>
            </div>
        </div>
    </div>
@endsection