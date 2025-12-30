@extends('layouts.admin')

@section('title', 'Students')

@section('content')
    <div class="mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold">Students</h1>
                <p class="text-gray-600">Manage all registered students ({{ $students->total() }} total)</p>
            </div>
            <a href="{{ route('admin.students.create') }}"
                class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition inline-block">
                Add Student
            </a>
        </div>
    </div>

    <!-- Search & Filters -->
    <div class="bg-white rounded-xl shadow-sm border p-6 mb-8">
        <form method="GET" action="{{ route('admin.students.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium mb-2">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Name or Admission No"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Current Class</label>
                <select name="class_id" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">All Classes</option>
                    @foreach($classes as $class)
                        <option value="{{ $class->id }}" {{ request('class_id') == $class->id ? 'selected' : '' }}>
                            {{ $class->display_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Gender</label>
                <select name="gender" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">All</option>
                    <option value="Male" {{ request('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ request('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2">Admission Session</label>
                <select name="admission_session_id"
                    class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                    <option value="">All Sessions</option>
                    @foreach($sessions as $session)
                        <option value="{{ $session->id }}" {{ request('admission_session_id') == $session->id ? 'selected' : '' }}>
                            {{ $session->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-4 flex gap-3 mt-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    Apply Filters
                </button>
                <a href="{{ route('admin.students.index') }}" class="px-6 py-2 border rounded-lg hover:bg-gray-50">
                    Clear
                </a>
            </div>
        </form>
    </div>

    <!-- Bulk Actions Form -->
    <form method="POST" action="{{ route('admin.students.bulk-action') }}" id="bulkActionForm">
        @csrf
        <input type="hidden" name="action" id="bulkActionType">

        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <div class="p-4 border-b bg-gray-50 flex justify-between items-center">
                <div>
                    <select id="bulkActionSelect" class="border rounded-lg px-4 py-2 text-sm">
                        <option value="">Bulk Actions</option>
                        <option value="delete">Delete Selected</option>
                        <option value="promote">Promote Selected</option>
                    </select>
                    <button type="button" id="applyBulkAction"
                        class="ml-2 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm disabled:opacity-50 disabled:cursor-not-allowed"
                        disabled>
                        Apply
                    </button>
                </div>
                <p class="text-sm text-gray-600">
                    Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }} students
                </p>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left">
                                <input type="checkbox" id="selectAll" class="rounded">
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Admission No</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Name</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Gender</th>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-700">Current Class</th>
                            <th class="px-6 py-4 text-right text-sm font-medium text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($students as $student)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <input type="checkbox" name="student_ids[]" value="{{ $student->id }}"
                                        class="rounded student-checkbox">
                                </td>
                                <td class="px-6 py-4 text-sm">{{ $student->admission_number }}</td>
                                <td class="px-6 py-4 font-medium">{{ $student->fullName() }}</td>
                                <td class="px-6 py-4 text-sm">{{ $student->gender }}</td>
                                <td class="px-6 py-4 text-sm">
                                    {{ $student->current_class?->display_name ?? 'Not assigned' }}
                                </td>
                                <td class="px-6 py-4 text-right space-x-3">
                                    <a href="{{ route('admin.students.edit', $student) }}"
                                        class="text-blue-600 hover:underline text-sm">Edit</a>
                                    <a href="{{ route('admin.fees.pay', $student) }}" 
                                        class="text-green-600 hover:underline text-sm">Pay Fees</a>
                                    <form action="{{ route('admin.students.destroy', $student) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" onclick="return confirm('Delete this student?')"
                                            class="text-red-600 hover:underline text-sm">Delete</button>
                                    </form>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    No students found matching your filters.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-gray-50 px-6 py-4 border-t">
                {{ $students->links() }}
            </div>
        </div>
    </form>
@endsection

@push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const selectAll = document.getElementById('selectAll');
                const checkboxes = document.querySelectorAll('.student-checkbox');
                const bulkSelect = document.getElementById('bulkActionSelect');
                const applyBtn = document.getElementById('applyBulkAction');
                const bulkType = document.getElementById('bulkActionType');

                // Select all checkbox
                selectAll.addEventListener('change', function () {
                    checkboxes.forEach(cb => cb.checked = this.checked);
                    toggleApplyButton();
                });

                checkboxes.forEach(cb => {
                    cb.addEventListener('change', toggleApplyButton);
                });

                // Bulk action select
                bulkSelect.addEventListener('change', toggleApplyButton);

                // Apply button
                applyBtn.addEventListener('click', function () {
                    if (!bulkSelect.value) return;

                    const checked = document.querySelectorAll('.student-checkbox:checked');
                    if (checked.length === 0) {
                        alert('Please select at least one student.');
                        return;
                    }

                    if (bulkSelect.value === 'delete') {
                        if (!confirm('Are you sure you want to delete the selected students? This cannot be undone.')) {
                            return;
                        }
                    }

                    bulkType.value = bulkSelect.value;
                    document.getElementById('bulkActionForm').submit();
                });

                function toggleApplyButton() {
                    const checkedCount = document.querySelectorAll('.student-checkbox:checked').length;
                    applyBtn.disabled = checkedCount === 0 || !bulkSelect.value;
                }
            });
        </script>
    @endpush