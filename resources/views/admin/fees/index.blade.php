@extends('layouts.admin')

@section('title', 'Fee Management')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold">Fee Management</h1>
        <p class="text-gray-600">Manage fees for {{ $currentSession?->name ?? 'current session' }}</p>
    </div>

    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
        <div class="p-6 border-b flex justify-between">
            <h2 class="text-xl font-bold">Fee Structure</h2>
            <a href="{{ route('admin.fees.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                Add New Fee
            </a>
        </div>

        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left">Class</th>
                    <th class="px-6 py-4 text-left">Fee Name</th>
                    <th class="px-6 py-4 text-left">Amount</th>
                    <th class="px-6 py-4 text-left">Mandatory</th>
                    <th class="px-6 py-4">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($fees as $fee)
                    <tr>
                        <td class="px-6 py-4">{{ $fee->schoolClass->display_name }}</td>
                        <td class="px-6 py-4 font-medium">{{ $fee->name }}</td>
                        <td class="px-6 py-4">₦{{ number_format($fee->amount, 2) }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="px-3 py-1 rounded-full text-sm {{ $fee->is_mandatory ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                {{ $fee->is_mandatory ? 'Yes' : 'No' }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-right space-x-4">
                            <a href="{{ route('admin.fees.show', $fee) }}" class="text-indigo-600 hover:underline text-sm">View</a>
                            <a href="{{ route('admin.fees.edit', $fee) }}" class="text-blue-600 hover:underline text-sm">Edit</a>
                            <form action="{{ route('admin.fees.destroy', $fee) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete this fee?')"
                                    class="text-red-600 hover:underline text-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-gray-500">No fees defined for this session.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
