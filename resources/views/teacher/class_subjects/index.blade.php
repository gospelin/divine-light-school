@extends('layouts.teacher')

@section('title', $class->display_name . ' - Subjects')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-blue-900">{{ $class->display_name }} Subjects</h1>
        <p class="text-xl text-gray-600">Select subjects offered in this class</p>
    </div>

    <!-- Add Subjects (Checkbox Grid) -->
    <div class="bg-white rounded-xl shadow-sm border p-8 mb-8">
        <h2 class="text-2xl font-bold mb-6">Add Subjects</h2>
        <form action="{{ route('teacher.classes.subjects.store', $class) }}" method="POST">
            @csrf

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-h-96 overflow-y-auto p-4 bg-gray-50 rounded-lg">
                @foreach($availableSubjects as $subject)
                    <label class="flex items-center gap-3">
                        <input type="checkbox" name="subject_ids[]" value="{{ $subject->id }}"
                               {{ in_array($subject->id, $assignedSubjectIds) ? 'checked disabled' : '' }}
                               class="rounded text-blue-600 focus:ring-blue-500 h-5 w-5">
                        <span class="text-sm {{ in_array($subject->id, $assignedSubjectIds) ? 'text-gray-500' : 'text-gray-800' }}">
                            {{ $subject->name }}
                        </span>
                    </label>
                @endforeach
            </div>

            <div class="mt-8 text-right">
                <button type="submit" class="bg-blue-700 text-white px-10 py-4 rounded-lg hover:bg-blue-800 text-xl font-semibold shadow-lg">
                    Save Selected Subjects
                </button>
            </div>
        </form>
    </div>

    <!-- Current Subjects -->
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <h2 class="text-2xl font-bold p-6 border-b">Current Subjects ({{ $classSubjects->count() }})</h2>
        @if($classSubjects->count() > 0)
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left">Subject Name</th>
                        <th class="px-6 py-4 text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($classSubjects as $subject)
                        <tr>
                            <td class="px-6 py-4 font-medium">{{ $subject->name }}</td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('teacher.classes.subjects.destroy', [$class, $subject]) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Remove {{ $subject->name }}?')"
                                        class="text-red-600 hover:underline text-sm">
                                        Remove
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-center py-12 text-gray-500">
                No subjects assigned yet. Use the form above to add subjects.
            </div>
        @endif
    </div>

    <div class="mt-8">
        <a href="{{ route('teacher.dashboard') }}" class="text-blue-600 hover:underline">
            ← Back to Dashboard
        </a>
    </div>
</div>
@endsection