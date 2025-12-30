@extends('layouts.admin')

@section('title', 'Teachers & Staff')

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold">Teachers & Staff</h1>
            <p class="text-gray-600">Manage all teaching staff ({{ $teachers->count() }} total)</p>
        </div>
        <a href="{{ route('admin.teachers.create') }}"
            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
            Add Teacher
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left">Name</th>
                    <th class="px-6 py-4 text-left">Email</th>
                    <th class="px-6 py-4 text-left">Phone</th>
                    <th class="px-6 py-4 text-left">Qualification</th>
                    <th class="px-6 py-4 text-left">Classes Assigned</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($teachers as $teacher)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium">{{ $teacher->user->name }}</td>
                        <td class="px-6 py-4">{{ $teacher->user->email }}</td>
                        <td class="px-6 py-4">{{ $teacher->phone }}</td>
                        <td class="px-6 py-4">{{ $teacher->qualification }}</td>
                        <td class="px-6 py-4">
                            @if($teacher->currentClasses->count())
                                @foreach($teacher->classes as $assignedClass)
                                    <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm mr-2 mb-1">
                                        {{ $assignedClass->display_name }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-gray-500 italic">None assigned</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="{{ route('admin.teachers.show', $teacher) }}"
                                class="text-indigo-600 hover:underline text-sm">View</a>
                            <a href="{{ route('admin.teachers.edit', $teacher) }}"
                                class="text-blue-600 hover:underline text-sm">Edit</a>
                            <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this teacher?')"
                                    class="text-red-600 hover:underline text-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            No teachers registered yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection