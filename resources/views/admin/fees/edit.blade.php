@extends('layouts.admin')

@section('title', 'Edit Fee')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border p-10">
        <h1 class="text-3xl font-bold mb-8 text-center text-blue-900">EDIT FEE</h1>
        <p class="text-center text-gray-600 mb-10">
            Update the details of the fee below.
        </p>

        <form action="{{ route('admin.fees.update', $fee) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                <div>
                    <label class="block text-lg font-semibold mb-3">Fee Name</label>
                    <input type="text" name="name" value="{{ old('name', $fee->name) }}"
                           placeholder="e.g., Tuition Fee, PTA Levy"
                           class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label class="block text-lg font-semibold mb-3">Amount (₦)</label>
                    <input type="number" name="amount" step="0.01" min="0" value="{{ old('amount', $fee->amount) }}"
                           placeholder="0.00"
                           class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                </div>

                <div>
                    <label class="block text-lg font-semibold mb-3">Academic Session</label>
                    <select name="academic_session_id" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Select Session</option>
                        @foreach($sessions as $session)
                            <option value="{{ $session->id }}" 
                                    {{ old('academic_session_id', $fee->academic_session_id) == $session->id ? 'selected' : '' }}>
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
                            <option value="{{ $class->id }}" 
                                    {{ old('school_class_id', $fee->school_class_id) == $class->id ? 'selected' : '' }}>
                                {{ $class->display_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-10">
                <label class="block text-lg font-semibold mb-3">Description (Optional)</label>
                <textarea name="description" rows="4" placeholder="Any additional details about this fee..."
                          class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">{{ old('description', $fee->description) }}</textarea>
            </div>

            <div class="mb-10">
                <label class="flex items-center gap-3 text-lg">
                    <input type="checkbox" name="is_mandatory" value="1" 
                           {{ old('is_mandatory', $fee->is_mandatory) ? 'checked' : '' }}
                           class="w-6 h-6 rounded text-blue-600 focus:ring-blue-500">
                    <span class="font-semibold">This fee is mandatory</span>
                </label>
                <p class="text-sm text-gray-600 mt-2">If checked, this fee must be paid by all students in the selected class.</p>
            </div>

            <div class="flex justify-end gap-6">
                <button type="submit" class="bg-green-700 text-white px-10 py-4 rounded-lg hover:bg-green-800 text-xl font-semibold shadow-lg">
                    Update Fee
                </button>
                <a href="{{ route('admin.fees.index') }}" class="px-10 py-4 border-2 border-gray-300 rounded-lg hover:bg-gray-50 text-xl font-medium">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection