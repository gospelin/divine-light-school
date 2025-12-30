@extends('layouts.admin')

@section('title', 'Classes & Sections')

@section('content')
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Classes & Sections</h1>
                <p class="text-gray-600">Manage all school classes and arms.</p>
            </div>
            <a href="{{ route('admin.classes.create') }}"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                Add New Class
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Section</th>
                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Class Name</th>
                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Display</th>
                    <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Order</th>
                    <th class="px-6 py-4 text-right text-sm font-medium text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($classes as $class)
                    <tr>
                        <td class="px-6 py-4">{{ $class->section }}</td>
                        <td class="px-6 py-4">{{ $class->name }}</td>
                        <td class="px-6 py-4 font-medium">{{ $class->display_name }}</td>
                        <td class="px-6 py-4">{{ $class->order }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.classes.edit', $class) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.classes.destroy', $class) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this class?')"
                                    class="text-red-600 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
