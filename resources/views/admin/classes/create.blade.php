@extends('layouts.admin')

@section('title', isset($class) ? 'Edit Class' : 'Add Class')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border p-8">
        <h1 class="text-2xl font-bold mb-6">{{ isset($class) ? 'Edit' : 'Add New' }} Class</h1>

        <form action="{{ isset($class) ? route('admin.classes.update', $class) : route('admin.classes.store') }}" method="POST">
            @csrf
            @if(isset($class)) @method('PUT') @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Section</label>
                    <select name="section" class="w-full border rounded-lg px-4 py-3" required>
                        <option value="Nursery" {{ old('section', $class->section ?? '') == 'Nursery' ? 'selected' : '' }}>Nursery</option>
                        <option value="Primary" {{ old('section', $class->section ?? '') == 'Primary' ? 'selected' : '' }}>Primary</option>
                        <option value="Secondary" {{ old('section', $class->section ?? '') == 'Secondary' ? 'selected' : '' }}>Secondary</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Class Name</label>
                    <input type="text" name="name" value="{{ old('name', $class->name ?? '') }}" class="w-full border rounded-lg px-4 py-3" placeholder="e.g. JSS 1" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Group/Arm (Optional)</label>
                    <input type="text" name="group" value="{{ old('group', $class->group ?? '') }}" class="w-full border rounded-lg px-4 py-3" placeholder="A, B, C..." maxlength="1">
                    <p class="text-xs text-gray-500 mt-1">Leave empty for no group (e.g. just "JSS 1")</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                    <input type="number" name="order" value="{{ old('order', $class->order ?? 0) }}" class="w-full border rounded-lg px-4 py-3" required>
                </div>
            </div>

            <div class="mt-8 flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700">
                    {{ isset($class) ? 'Update' : 'Create' }} Class
                </button>
                <a href="{{ route('admin.classes.index') }}" class="px-8 py-3 border rounded-lg hover:bg-gray-50">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection