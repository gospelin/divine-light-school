@extends('layouts.admin')

@section('title', 'Record Fee Payment')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border p-8">
            <h1 class="text-3xl font-bold mb-8">Record Fee Payment</h1>
            <p class="text-gray-700 mb-8">
                Student: <strong>{{ $student->fullName() }}</strong>
                ({{ $student->admission_number }})
                — Current Class: <strong>{{ $student->current_class?->display_name ?? 'Not assigned' }}</strong>
            </p>
            <p class="text-gray-600 mb-10">Session: {{ $currentSession?->name ?? 'Not set' }}</p>

            <form action="{{ route('admin.fees.pay', $student) }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label class="block text-sm font-medium mb-2">Fee Type</label>
                        <select name="fee_id" class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                            required>
                            <option value="">Select Fee</option>
                            @foreach($fees as $fee)
                                <option value="{{ $fee->id }}">
                                    {{ $fee->name }} — ₦{{ number_format($fee->amount, 2) }}
                                    {{ $fee->is_mandatory ? '(Mandatory)' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">Amount Paid</label>
                        <input type="number" name="amount_paid" step="0.01" min="0.01"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" placeholder="0.00"
                            required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">Payment Date</label>
                        <input type="date" name="payment_date" value="{{ old('payment_date', now()->format('Y-m-d')) }}"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">Notes (Optional)</label>
                        <textarea name="notes" rows="3"
                            class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                            placeholder="e.g., Paid in cash, balance remaining...">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="bg-green-600 text-white px-8 py-3 rounded-lg hover:bg-green-700">
                        Record Payment
                    </button>
                    <a href="{{ route('admin.students.index') }}" class="px-8 py-3 border rounded-lg hover:bg-gray-50">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection