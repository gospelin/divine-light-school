@extends('layouts.admin')

@section('title', 'Fee Details')

@section('content')
<div class="max-w-6xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border p-10">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-blue-900">FEE DETAILS</h1>
            <p class="text-2xl text-gray-700 mt-4">{{ $fee->name }}</p>
            <p class="text-lg text-gray-600 mt-2">
                {{ $fee->schoolClass->display_name }} • {{ $fee->session->name }}
            </p>
        </div>

        <!-- Fee Information -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
            <div class="bg-gray-50 p-6 rounded-lg">
                <h3 class="text-xl font-bold mb-4 text-gray-800">Fee Information</h3>
                <dl class="space-y-4">
                    <div class="flex justify-between">
                        <dt class="text-gray-600">Amount</dt>
                        <dd class="font-semibold text-xl">₦{{ number_format($fee->amount, 2) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-600">Mandatory</dt>
                        <dd>
                            <span class="px-4 py-2 rounded-full text-sm font-medium {{ $fee->is_mandatory ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $fee->is_mandatory ? 'Yes' : 'No' }}
                            </span>
                        </dd>
                    </div>
                    @if($fee->description)
                        <div>
                            <dt class="text-gray-600 mb-2">Description</dt>
                            <dd class="text-gray-700">{{ $fee->description }}</dd>
                        </div>
                    @endif
                </dl>
            </div>

            <div class="bg-blue-50 p-6 rounded-lg">
                <h3 class="text-xl font-bold mb-4 text-blue-800">Payment Summary</h3>
                <div class="space-y-4">
                    <div class="flex justify-between text-lg">
                        <span class="text-gray-700">Total Expected</span>
                        <span class="font-bold">₦{{ number_format($totalExpected, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-lg">
                        <span class="text-gray-700">Total Paid</span>
                        <span class="font-bold text-green-700">₦{{ number_format($totalPaid, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-xl border-t pt-4">
                        <span class="font-semibold text-gray-800">Outstanding Balance</span>
                        <span class="font-bold text-red-600">₦{{ number_format($totalExpected - $totalPaid, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-center gap-6 mb-12">
            <a href="{{ route('admin.fees.edit', $fee) }}"
               class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition">
                Edit Fee
            </a>
            <a href="{{ route('admin.fees.index') }}"
               class="px-8 py-3 border-2 border-gray-300 rounded-lg hover:bg-gray-50 transition">
                Back to Fees
            </a>
        </div>

        <!-- Payment History -->
        <h3 class="text-2xl font-bold text-center mb-8 text-gray-800">Payment History</h3>
        @if($fee->payments->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Student</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Admission No</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Amount Paid</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Date</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Receipt No</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Recorded By</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($fee->payments as $payment)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.students.edit', $payment->student) }}" class="text-blue-600 hover:underline">
                                        {{ $payment->student->fullName() }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-sm">{{ $payment->student->admission_number }}</td>
                                <td class="px-6 py-4 font-medium">₦{{ number_format($payment->amount_paid, 2) }}</td>
                                <td class="px-6 py-4 text-sm">{{ $payment->payment_date->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-sm font-mono">{{ $payment->receipt_number }}</td>
                                <td class="px-6 py-4 text-sm">{{ $payment->recorder->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center text-gray-500 py-12">No payments recorded yet for this fee.</p>
        @endif
    </div>
</div>
@endsection