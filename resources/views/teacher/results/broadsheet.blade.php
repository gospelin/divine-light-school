@extends('layouts.teacher')

@php
    use App\Models\Result;
@endphp

@section('title', $class->display_name . ' - Broadsheet')

@section('content')
    <div class="max-w-full mx-auto px-4 pb-32">
        <!-- Header -->
        <div class="mb-8 text-center md:text-left">
            <h1 class="text-3xl md:text-4xl font-bold text-blue-900">{{ $class->display_name }} Broadsheet</h1>
            <p class="text-lg md:text-xl text-gray-600 mt-2">
                Results Entry • {{ $currentSession?->name ?? 'Current Session' }}
            </p>
            <p class="text-base md:text-lg text-gray-700 mt-3">
                Students: <strong>{{ $students->count() }}</strong> | 
                Subjects: <strong>{{ $subjects->count() }}</strong>
            </p>
            <div class="mt-4 inline-block bg-amber-100 text-amber-800 px-6 py-3 rounded-full text-sm font-semibold">
                CA: Max 40 | Exam: Max 60 | Total: 100
            </div>
        </div>

        @if($subjects->isEmpty())
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-10 text-center">
                <p class="text-2xl font-semibold text-yellow-800">No subjects assigned</p>
                <p class="text-yellow-700 mt-4">Please add subjects to this class first.</p>
                <a href="{{ route('teacher.classes.subjects.index', $class) }}"
                   class="mt-6 inline-block bg-indigo-600 text-white px-10 py-4 rounded-lg hover:bg-indigo-700 font-medium">
                    Manage Subjects
                </a>
            </div>
        @elseif($students->isEmpty())
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-10 text-center">
                <p class="text-2xl font-semibold text-yellow-800">No students enrolled</p>
            </div>
        @else
            <form action="{{ route('teacher.classes.results.store', $class) }}" method="POST">
                @csrf

                <div class="bg-white rounded-xl shadow-lg border overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full min-w-max">
                            <thead class="bg-gradient-to-b from-gray-100 to-gray-200 text-xs md:text-sm">
                                <tr>
                                    <th class="sticky left-0 bg-gray-200 z-30 px-6 py-4 text-left font-bold border-r-2 border-gray-400 w-80">
                                        Student
                                    </th>
                                    @foreach($subjects as $subject)
                                        <th colspan="3" class="px-6 py-4 text-center font-medium border-l">
                                            <div class="hidden md:block">{{ $subject->name }}</div>
                                            <div class="md:hidden text-xs">{{ Str::limit($subject->name, 12) }}</div>
                                        </th>
                                    @endforeach
                                </tr>
                                <tr class="bg-gray-300">
                                    <th class="sticky left-0 bg-gray-300 z-30"></th>
                                    @foreach($subjects as $subject)
                                        <th class="px-4 py-3 text-center border-l font-bold">CA</th>
                                        <th class="px-4 py-3 text-center font-bold">Exam</th>
                                        <th class="px-4 py-3 text-center font-bold bg-gray-400">Total</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                @foreach($students as $student)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="sticky left-0 bg-white z-20 px-6 py-5 font-medium border-r-2 border-gray-300">
                                            <div class="font-semibold text-gray-900">{{ $student->fullName() }}</div>
                                            <div class="text-xs text-gray-500 mt-1">{{ $student->admission_number }}</div>
                                        </td>

                                        @foreach($subjects as $subject)
                                            @php
                                                $pivot = $class->subjects()->where('subject_id', $subject->id)->first()?->pivot;
                                                if (!$pivot)
                                                    continue;

                                                $classSubjectId = $pivot->id;

                                                $result = Result::where('class_subject_id', $classSubjectId)
                                                    ->where('student_id', $student->id)
                                                    ->where('academic_session_id', $currentSession->id)
                                                    ->first();
                                            @endphp

                                            <td class="px-3 py-4 text-center border-l">
                                                <input type="number"
                                                       name="results[{{ $student->id }}][subjects][{{ $classSubjectId }}][ca_score]"
                                                       value="{{ $result?->ca_score ?? '' }}"
                                                       min="0" max="40"
                                                       placeholder="CA"
                                                       class="w-16 md:w-20 text-center border rounded px-2 py-2 focus:ring-2 focus:ring-blue-500">
                                            </td>

                                            <td class="px-3 py-4 text-center">
                                                <input type="number"
                                                       name="results[{{ $student->id }}][subjects][{{ $classSubjectId }}][exam_score]"
                                                       value="{{ $result?->exam_score ?? '' }}"
                                                       min="0" max="60"
                                                       placeholder="Exam"
                                                       class="w-16 md:w-20 text-center border rounded px-2 py-2 focus:ring-2 focus:ring-blue-500">
                                            </td>

                                            <td class="px-3 py-4 text-center font-bold text-base md:text-lg bg-gray-100">
                                                {{ ($result?->ca_score ?? 0) + ($result?->exam_score ?? 0) }}
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="fixed bottom-4 left-4 right-4 z-50 md:bottom-8 md:right-8 md:left-auto">
                    <button type="submit"
                            class="w-full md:w-auto bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold text-lg md:text-xl px-12 py-6 rounded-full shadow-2xl transition-all duration-300 flex items-center justify-center gap-4 mx-auto">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        Save Results
                    </button>
                </div>
            </form>
        @endif

        <!-- Back -->
        <div class="mt-32 pb-24 text-center">
            <a href="{{ route('teacher.dashboard') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 font-medium text-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Dashboard
            </a>
        </div>
    </div>
@endsection