@extends('layouts.admin')

@section('title', 'School Subjects')

@section('content')
    <div class="mb-8 flex justify-between">
        <div>
            <h1 class="text-3xl font-bold">School Subjects</h1>
            <p class="text-gray-600">Master list of all subjects in the school</p>
        </div>
        <a href="{{ route('admin.subjects.create') }}"
            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
            Add Subject
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left">Subject Name</th>
                    <th class="px-6 py-4 text-left">Category</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($subjects as $subject)
                    <tr>
                        <td class="px-6 py-4 font-medium">{{ $subject->name }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-4 py-1 rounded-full text-sm {{ $subject->category == 'Core' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                {{ $subject->category }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-4">
                            <a href="{{ route('admin.subjects.edit', $subject) }}"
                                class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.subjects.destroy', $subject) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete subject?')"
                                    class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-8 text-gray-500">No subjects yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
