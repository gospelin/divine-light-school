@extends('layouts.admin')

@section('title', 'Create New Fee')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border p-10">
        <h1 class="text-3xl font-bold mb-8 text-center text-blue-900">CREATE NEW FEE</h1>
        <p class="text-center text-gray-600 mb-10">
            Define a new fee that applies to a specific class in a specific academic session.
        </p>

        <form action="{{ route('admin.fees.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                <div>
                    <label class="block text-lg font-semibold mb-3">Fee Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           placeholder="e.g., Tuition Fee, PTA Levy, Uniform Fee"
                           class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label class="block text-lg font-semibold mb-3">Amount (₦)</label>
                    <input type="number" name="amount" step="0.01" min="0" value="{{ old('amount') }}"
                           placeholder="0.00"
                           class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label class="block text-lg font-semibold mb-3">Academic Session</label>
                    <select name="academic_session_id" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Select Session</option>
                        @foreach($sessions as $session)
                            <option value="{{ $session->id }}" {{ old('academic_session_id') == $session->id ? 'selected' : '' }}>
                                {{ $session->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-lg font-semibold mb-3">Class</label>
                    <select name="school_class_id" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Select Class</option>
                        @foreach($classes as $class)
                            <option value="{{ $class->id }}" {{ old('school_class_id') == $class->id ? 'selected' : '' }}>
                                {{ $class->display_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-10">
                <label class="block text-lg font-semibold mb-3">Description (Optional)</label>
                <textarea name="description" rows="4" placeholder="Any additional details about this fee..."
                          class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
            </div>

            <div class="mb-10">
                <label class="flex items-center gap-3 text-lg">
                    <input type="checkbox" name="is_mandatory" value="1" 
                           {{ old('is_mandatory', 1) ? 'checked' : '' }}
                           class="w-6 h-6 rounded text-blue-600 focus:ring-blue-500">
                    <span class="font-semibold">This fee is mandatory</span>
                </label>
                <p class="text-sm text-gray-600 mt-2">If checked, this fee must be paid by all students in the selected class.</p>
            </div>

            <div class="flex justify-end gap-6">
                <button type="submit" class="bg-blue-700 text-white px-10 py-4 rounded-lg hover:bg-blue-800 text-xl font-semibold shadow-lg">
                    Create Fee
                </button>
                <a href="{{ route('admin.fees.index') }}" class="px-10 py-4 border-2 border-gray-300 rounded-lg hover:bg-gray-50 text-xl font-medium">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection