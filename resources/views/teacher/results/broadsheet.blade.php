@extends('layouts.teacher')

@push('styles')
    <style>
        .scrollbar-thin::-webkit-scrollbar {
            height: 6px;
            width: 6px;
        }

        .scrollbar-thin::-webkit-scrollbar-track {
            background: #f3f4f6;
        }

        .scrollbar-thin::-webkit-scrollbar-thumb {
            background-color: #9ca3af;
            border-radius: 10px;
        }

        .status-indicator {
            min-height: 20px;
            font-size: 0.75rem;
            font-weight: 500;
            text-align: center;
            margin-top: 4px;
            transition: opacity 0.5s ease;
        }

        input:invalid {
            border-color: #ef4444 !important;
            box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.2);
        }

        input:valid:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.2);
        }

        /* Total cell styling */
        .total {
            transition: all 0.3s ease;
            font-weight: bold;
        }

        .total-excellent {
            background-color: #d4edda !important;
            color: #155724;
        }

        .total-good {
            background-color: #d1ecf1 !important;
            color: #0c5460;
        }

        .total-average {
            background-color: #fff3cd !important;
            color: #856404;
        }

        .total-below {
            background-color: #f8d7da !important;
            color: #721c24;
        }

        .total-fail {
            background-color: #f5c6cb !important;
            color: #721c24;
            font-weight: bold;
        }

        /* Grade cell styling */
        .grade {
            font-weight: bold;
            color: #4c1d95;
            background-color: #f3e8ff;
        }

        /* Active row highlight */
        tr.active-row {
            background-color: #f0f9ff !important;
            box-shadow: inset 0 0 0 2px #3b82f6;
            transition: all 0.2s ease;
        }

        /* Save notice */
        #save-notice .notice-inner {
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        #save-notice.show .notice-inner {
            opacity: 1;
        }
    </style>
@endpush

@section('title', $class->display_name . ' - Broadsheet')

@section('content')
    <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8 pb-32">
        <!-- Header -->
        <div class="mb-6 text-center md:text-left">
            <h1 class="text-2xl sm:text-3xl md:text-4xl font-bold text-blue-900">{{ $class->display_name }} Broadsheet</h1>
            <p class="text-base sm:text-lg md:text-xl text-gray-600 mt-2">
                {{ $selectedSession->name }} • {{ $selectedTerm }} Term
            </p>
            <p class="text-sm sm:text-base md:text-lg text-gray-700 mt-2">
                Students: <strong>{{ $students->count() }}</strong> • Subjects: <strong>{{ $subjects->count() }}</strong>
            </p>
            <div
                class="mt-4 inline-block bg-amber-100 text-amber-800 px-4 py-2 rounded-full text-xs sm:text-sm font-semibold">
                CA: max 40 • Exam: max 60 • Total: 100
            </div>
        </div>

        <!-- Filters -->
        <div class="mb-6 bg-white rounded-xl shadow-md p-5 sm:p-6 border">
            <form action="{{ route('teacher.results.broadsheet', $class) }}" method="GET"
                class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Session</label>
                    <select name="session_id" onchange="this.form.submit()"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 text-sm">
                        @foreach($sessions as $s)
                            <option value="{{ $s->id }}" {{ $s->id == $selectedSession->id ? 'selected' : '' }}>
                                {{ $s->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Term</label>
                    <select name="term" onchange="this.form.submit()"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 text-sm">
                        @foreach($terms as $t)
                            <option value="{{ $t }}" {{ $t === $selectedTerm ? 'selected' : '' }}>
                                {{ $t }} Term
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="hidden lg:flex lg:items-end">
                    <div
                        class="bg-gradient-to-r from-indigo-100 to-purple-100 text-indigo-800 px-4 py-2 rounded-lg text-sm font-medium">
                        {{ $selectedTerm }} • {{ $selectedSession->name }}
                    </div>
                </div>
            </form>
        </div>

        <!-- School Dates Input Form -->
        <div class="mb-8 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl shadow-md p-6 border border-blue-200">
            <h3 class="text-lg font-semibold text-blue-900 mb-4">School Resumption & Closure Dates</h3>
            <form id="term-dates-form" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @csrf
                <input type="hidden" name="session_id" value="{{ $selectedSession->id }}">
                <input type="hidden" name="term" value="{{ $selectedTerm }}">

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">School Closes</label>
                    <input type="date" name="school_closes" id="school_closes"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        value="{{ $students->first()?->termSummaries->firstWhere('academic_session_id', $selectedSession->id)?->firstWhere('term', $selectedTerm)?->school_closes ?? '' }}">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">School Reopens</label>
                    <input type="date" name="school_reopens" id="school_reopens"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                        value="{{ $students->first()?->termSummaries->firstWhere('academic_session_id', $selectedSession->id)?->firstWhere('term', $selectedTerm)?->school_reopens ?? '' }}">
                </div>

                <div class="flex items-end">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-medium transition">
                        Save Dates for All Students
                    </button>
                </div>
            </form>
            <div id="dates-status" class="mt-3 text-sm font-medium text-center"></div>
        </div>

        @if($subjects->isEmpty() || $students->isEmpty())
            <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-8 text-center">
                <p class="text-xl font-semibold text-yellow-800">
                    {{ $subjects->isEmpty() ? 'No subjects assigned' : 'No students enrolled' }}
                </p>
                @if($subjects->isEmpty())
                    <a href="{{ route('teacher.classes.subjects.index', $class) }}"
                        class="mt-4 inline-block bg-indigo-600 text-white px-6 py-3 rounded-lg hover:bg-indigo-700 text-sm font-medium">
                        Manage Subjects
                    </a>
                @endif
            </div>
        @else
            <div class="bg-white rounded-xl shadow-lg border overflow-hidden">
                <div class="overflow-x-auto scrollbar-thin">
                    <table class="w-full min-w-max text-sm">
                        <thead>
                            <tr class="bg-gradient-to-b from-gray-100 to-gray-200">
                                <th rowspan="2"
                                    class="sticky left-0 bg-gray-200 z-30 px-4 sm:px-6 py-3 text-left font-bold border-r border-gray-400 min-w-[140px]">
                                    Subjects
                                </th>
                                @foreach($students as $student)
                                    <th colspan="4"
                                        class="px-3 sm:px-6 py-3 text-center font-medium border-x border-gray-300 min-w-[160px]">
                                        <div class="hidden sm:block">{{ $student->fullName() }}</div>
                                        <div class="sm:hidden text-xs">{{ Str::limit($student->fullName(), 12) }}</div>
                                        <div class="text-xs text-gray-600">{{ $student->admission_number }}</div>
                                    </th>
                                @endforeach
                            </tr>
                            <tr class="bg-gray-300">
                                @foreach($students as $student)
                                    <th class="px-2 sm:px-4 py-2 font-bold border-x text-xs sm:text-sm">CA</th>
                                    <th class="px-2 sm:px-4 py-2 font-bold border-x text-xs sm:text-sm">Exam</th>
                                    <th class="px-2 sm:px-4 py-2 font-bold bg-gray-400 text-xs sm:text-sm">Total</th>
                                    <th class="px-2 sm:px-4 py-2 font-bold bg-purple-200 text-xs sm:text-sm">Grade</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($subjects as $subject)
                                @php
        $classSubjectId = $classSubjectIds[$subject->id] ?? null;
        if (!$classSubjectId)
            continue;
                                @endphp
                                <tr>
                                    <td class="sticky left-0 bg-white z-20 px-4 sm:px-6 py-4 font-medium border-r border-gray-300">
                                        {{ $subject->name }}
                                    </td>

                                    @foreach($students as $student)
                                        @php
            $result = $student->results->firstWhere('class_subject_id', $classSubjectId);
                                        @endphp

                                        <!-- CA -->
                                        <td class="px-2 sm:px-3 py-4 text-center border-x">
                                            <div class="flex flex-col items-center">
                                                <input type="number" min="0" max="40" step="1" placeholder="0-40"
                                                    class="ca-score w-14 sm:w-20 text-center border border-gray-300 rounded px-1 sm:px-2 py-1.5 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                                    value="{{ $result?->ca_score ?? '' }}" data-student-id="{{ $student->id }}"
                                                    data-class-subject-id="{{ $classSubjectId }}"
                                                    data-status-id="status_{{ $student->id }}_{{ $classSubjectId }}">
                                                <div class="status-indicator" id="status_{{ $student->id }}_{{ $classSubjectId }}">
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Exam -->
                                        <td class="px-2 sm:px-3 py-4 text-center">
                                            <div class="flex flex-col items-center">
                                                <input type="number" min="0" max="60" step="1" placeholder="0-60"
                                                    class="exam-score w-14 sm:w-20 text-center border border-gray-300 rounded px-1 sm:px-2 py-1.5 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                                    value="{{ $result?->exam_score ?? '' }}" data-student-id="{{ $student->id }}"
                                                    data-class-subject-id="{{ $classSubjectId }}"
                                                    data-status-id="status_{{ $student->id }}_{{ $classSubjectId }}">
                                                <div class="status-indicator" id="status_{{ $student->id }}_{{ $classSubjectId }}">
                                                </div>
                                            </div>
                                        </td>

                                        <!-- Total -->
                                        <td class="total px-2 sm:px-3 py-4 text-center font-bold bg-gray-100 border-x">
                                            {{ $result && $result->total > 0 ? $result->total : '' }}
                                        </td>

                                        <!-- Grade -->
                                        <td class="grade px-2 sm:px-3 py-4 text-center font-bold bg-purple-50 border-x">
                                            {{ $result && $result->total > 0 ? $result->grade : '' }}
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach

                            <!-- Grand Total Row -->
                            <tr class="bg-amber-50 font-bold">
                                <td class="sticky left-0 bg-amber-100 z-20 px-4 sm:px-6 py-4 border-r border-gray-400">
                                    Grand Total
                                </td>
                                @foreach($students as $student)
                                    @php
        $summary = $student->termSummaries
            ->where('academic_session_id', $selectedSession->id)
            ->where('term', $selectedTerm)
            ->first();
                                    @endphp
                                    <td colspan="4" class="px-4 py-4 text-center text-lg">
                                        {{ $summary && $summary->total_score > 0 ? $summary->total_score : '' }}
                                    </td>
                                @endforeach
                            </tr>

                            <!-- Term's Average Row -->
                            <tr class="bg-indigo-50 font-bold">
                                <td class="sticky left-0 bg-indigo-100 z-20 px-4 sm:px-6 py-4 border-r border-gray-400">
                                    Term's Average
                                </td>
                                @foreach($students as $student)
                                    @php
        $summary = $student->termSummaries
            ->where('academic_session_id', $selectedSession->id)
            ->where('term', $selectedTerm)
            ->first();
                                    @endphp
                                    <td colspan="4" class="px-4 py-4 text-center text-xl text-indigo-700">
                                        {{ $summary && $summary->average > 0 ? number_format($summary->average, 2) : '' }}
                                    </td>
                                @endforeach
                            </tr>

                            <!-- Principal Comment Row -->
                            <tr class="bg-purple-50">
                                <td
                                    class="sticky left-0 bg-purple-100 z-20 px-4 sm:px-6 py-4 border-r border-gray-400 font-medium">
                                    Principal Comment
                                </td>
                                @foreach($students as $student)
                                    @php
        $summary = $student->termSummaries
            ->where('academic_session_id', $selectedSession->id)
            ->where('term', $selectedTerm)
            ->first();
                                    @endphp
                                    <td colspan="4" class="px-4 py-4 text-left italic text-purple-900">
                                        {{ $summary && $summary->total_score > 0 ? $summary->principal_comment : '' }}
                                    </td>
                                @endforeach
                            </tr>

                            <!-- Form Teacher Comment Row -->
                            <tr class="bg-green-50">
                                <td
                                    class="sticky left-0 bg-green-100 z-20 px-4 sm:px-6 py-4 border-r border-gray-400 font-medium">
                                    Form Teacher Comment
                                </td>
                                @foreach($students as $student)
                                    @php
        $summary = $student->termSummaries
            ->where('academic_session_id', $selectedSession->id)
            ->where('term', $selectedTerm)
            ->first();
                                    @endphp
                                    <td colspan="4" class="px-4 py-4 text-left italic text-green-900">
                                        {{ $summary && $summary->total_score > 0 ? $summary->class_teacher_comment : '' }}
                                    </td>
                                @endforeach
                            </tr>

                            <!-- School Closes Row -->
                            <tr class="bg-teal-50">
                                <td
                                    class="sticky left-0 bg-teal-100 z-20 px-4 sm:px-6 py-4 border-r border-gray-400 font-medium">
                                    School Closes
                                </td>
                                @foreach($students as $student)
                                    @php
        $summary = $student->termSummaries
            ->where('academic_session_id', $selectedSession->id)
            ->where('term', $selectedTerm)
            ->first();
                                    @endphp
                                    <td colspan="4" class="px-4 py-4 text-center font-medium text-teal-800">
                                        {{ $summary?->school_closes?->format('jS F, Y') ?? '' }}
                                    </td>
                                @endforeach
                            </tr>

                            <!-- School Reopens Row -->
                            <tr class="bg-orange-50">
                                <td
                                    class="sticky left-0 bg-orange-100 z-20 px-4 sm:px-6 py-4 border-r border-gray-400 font-medium">
                                    School Reopens
                                </td>
                                @foreach($students as $student)
                                    @php
        $summary = $student->termSummaries
            ->where('academic_session_id', $selectedSession->id)
            ->where('term', $selectedTerm)
            ->first();
                                    @endphp
                                    <td colspan="4" class="px-4 py-4 text-center font-medium text-orange-800">
                                        {{ $summary?->school_reopens?->format('jS F, Y') ?? '' }}
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Mobile hint -->
            <div class="md:hidden fixed bottom-20 left-0 right-0 text-center pointer-events-none z-40">
                <div class="inline-block bg-black/70 text-white px-6 py-3 rounded-full text-sm font-medium animate-pulse">
                    ← Swipe to view all students →
                </div>
            </div>

            <!-- Dynamic save notice -->
            <div class="fixed bottom-4 right-4 z-50" id="save-notice">
                <div
                    class="notice-inner bg-green-600 text-white px-5 py-3 rounded-full shadow-2xl text-sm font-medium flex items-center gap-3">
                    <div class="w-2 h-2 bg-white rounded-full animate-pulse"></div>
                    <span id="save-text">All changes saved</span>
                </div>
            </div>
        @endif

        <!-- Back button -->
        <div class="mt-12 text-center">
            <a href="{{ route('teacher.dashboard') }}"
                class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-800 font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Dashboard
            </a>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const updateUrl = '{{ route("teacher.results.update_field", $class) }}';
        const csrfToken = '{{ csrf_token() }}';
        const classId = {{ $class->id }};
        const sessionId = {{ $selectedSession->id }};
        const term = '{{ $selectedTerm }}';

        const pendingRequests = new Map();
        const saveNotice = document.getElementById('save-notice');
        const saveText = document.getElementById('save-text');

        // Auto-save on input
        document.addEventListener('input', function (e) {
            if (!e.target.matches('.ca-score, .exam-score')) return;

            const input = e.target;
            const studentId = input.dataset.studentId;
            const classSubjectId = input.dataset.classSubjectId;
            const statusId = input.dataset.statusId;

            if (!studentId || !classSubjectId) return;

            const field = input.classList.contains('ca-score') ? 'ca_score' : 'exam_score';
            const value = input.value.trim() === '' ? null : parseInt(input.value, 10);
            const key = `${studentId}_${classSubjectId}_${field}`;

            if (pendingRequests.has(key)) clearTimeout(pendingRequests.get(key));

            const statusEl = document.getElementById(statusId);
            statusEl.textContent = 'Saving...';
            statusEl.style.color = '#d97706';
            statusEl.style.opacity = '1';

            saveText.textContent = 'Saving...';
            saveNotice.classList.add('show');

            const timeoutId = setTimeout(() => {
                fetch(updateUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        student_id: studentId,
                        class_subject_id: classSubjectId,
                        class_id: classId,
                        session_id: sessionId,
                        term: term,
                        field: field,
                        value: value
                    })
                })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            // Update subject total
                            const currentTd = input.closest('td');
                            const totalTd = input.classList.contains('ca-score')
                                ? currentTd.nextElementSibling?.nextElementSibling
                                : currentTd.nextElementSibling;

                            const gradeTd = totalTd?.nextElementSibling;

                            if (totalTd && totalTd.classList.contains('total')) {
                                const total = data.total;
                                totalTd.textContent = total > 0 ? total : '';

                                totalTd.className = totalTd.className.replace(/total-(excellent|good|average|below|fail)/g, '').trim();
                                if (total >= 80) totalTd.classList.add('total-excellent');
                                else if (total >= 70) totalTd.classList.add('total-good');
                                else if (total >= 50) totalTd.classList.add('total-average');
                                else if (total >= 40) totalTd.classList.add('total-below');
                                else if (total > 0) totalTd.classList.add('total-fail');
                            }

                            if (gradeTd && gradeTd.classList.contains('grade')) {
                                gradeTd.textContent = data.grade ?? '';
                            }

                            // Update Grand Total, Average, and Comments (only if there's score)
                            const row = input.closest('tr');
                            const allTdsInRow = Array.from(row.querySelectorAll('td'));
                            const caTdIndex = allTdsInRow.findIndex(td => td.querySelector('input.ca-score'));

                            if (caTdIndex !== -1) {
                                const grandTotalRow = document.querySelector('tr.bg-amber-50');
                                const averageRow = document.querySelector('tr.bg-indigo-50');
                                const principalRow = document.querySelector('tr.bg-purple-50');
                                const teacherRow = document.querySelector('tr.bg-green-50');

                                if (grandTotalRow && averageRow && principalRow && teacherRow) {
                                    const grandTotalCells = Array.from(grandTotalRow.querySelectorAll('td'));
                                    const averageCells = Array.from(averageRow.querySelectorAll('td'));
                                    const principalCells = Array.from(principalRow.querySelectorAll('td'));
                                    const teacherCells = Array.from(teacherRow.querySelectorAll('td'));

                                    const studentGrandTotalCell = grandTotalCells[caTdIndex];
                                    const studentAverageCell = averageCells[caTdIndex];
                                    const studentPrincipalCell = principalCells[caTdIndex];
                                    const studentTeacherCell = teacherCells[caTdIndex];

                                    const hasScore = data.total_score > 0;

                                    if (studentGrandTotalCell) {
                                        studentGrandTotalCell.textContent = hasScore ? data.total_score : '';
                                    }
                                    if (studentAverageCell) {
                                        studentAverageCell.textContent = hasScore ? Number(data.average).toFixed(2) : '';
                                    }
                                    if (studentPrincipalCell) {
                                        studentPrincipalCell.textContent = hasScore ? data.principal_comment : '';
                                    }
                                    if (studentTeacherCell) {
                                        studentTeacherCell.textContent = hasScore ? data.class_teacher_comment : '';
                                    }
                                }
                            }

                            statusEl.textContent = '✓ Saved';
                            statusEl.style.color = '#16a34a';
                            saveText.textContent = '✓ Saved';
                            setTimeout(() => {
                                statusEl.style.opacity = '0';
                                saveNotice.classList.remove('show');
                            }, 2000);
                        } else {
                            statusEl.textContent = data.message || '✗ Failed';
                            statusEl.style.color = '#dc2626';
                            saveText.textContent = '✗ Failed';
                            setTimeout(() => saveNotice.classList.remove('show'), 3000);
                        }
                    })
                    .catch(() => {
                        statusEl.textContent = '✗ Failed';
                        statusEl.style.color = '#dc2626';
                        saveText.textContent = '✗ Failed';
                    });
            }, 800);

            pendingRequests.set(key, timeoutId);
        });

        // Active row highlight
        document.addEventListener('focusin', function (e) {
            if (e.target.matches('.ca-score, .exam-score')) {
                const row = e.target.closest('tr');
                document.querySelectorAll('tr.active-row').forEach(r => r.classList.remove('active-row'));
                row.classList.add('active-row');
            }
        });

        // Keyboard navigation
        document.addEventListener('keydown', function (e) {
            if (!['ArrowUp', 'ArrowDown', 'ArrowLeft', 'ArrowRight'].includes(e.key)) return;
            if (!e.target.matches('.ca-score, .exam-score')) return;

            const inputs = Array.from(document.querySelectorAll('.ca-score, .exam-score'));
            const currentIndex = inputs.indexOf(e.target);
            if (currentIndex === -1) return;

            let nextIndex = currentIndex;

            if (e.key === 'ArrowLeft') nextIndex--;
            else if (e.key === 'ArrowRight') nextIndex++;
            else if (e.key === 'ArrowUp') nextIndex -= 2;
            else if (e.key === 'ArrowDown') nextIndex += 2;

            if (nextIndex >= 0 && nextIndex < inputs.length) {
                inputs[nextIndex].focus();
                inputs[nextIndex].select();
                e.preventDefault();
            }
        });

        // School dates form submission
            document.getElementById('term-dates-form')?.addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(this);
                const statusEl = document.getElementById('dates-status');

                statusEl.textContent = 'Saving...';
                statusEl.style.color = '#d97706';

                fetch('{{ route("teacher.results.update_term_dates", $class) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: formData
                })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            statusEl.textContent = '✓ Dates saved for all students!';
                            statusEl.style.color = '#16a34a';

                            // Update all displayed dates
                            const closesDate = document.getElementById('school_closes').value;
                            const reopensDate = document.getElementById('school_reopens').value;

                            document.querySelectorAll('tr.bg-teal-50 td:not(:first-child)').forEach(cell => {
                                cell.textContent = closesDate ? new Date(closesDate).toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' }).replace(/(\d+) (\w+) (\d+)/, '$1 $2, $3') : '';
                            });

                            document.querySelectorAll('tr.bg-orange-50 td:not(:first-child)').forEach(cell => {
                                cell.textContent = reopensDate ? new Date(reopensDate).toLocaleDateString('en-GB', { day: 'numeric', month: 'long', year: 'numeric' }).replace(/(\d+) (\w+) (\d+)/, '$1 $2, $3') : '';
                            });

                            setTimeout(() => statusEl.textContent = '', 3000);
                        } else {
                            statusEl.textContent = data.message || '✗ Failed to save';
                            statusEl.style.color = '#dc2626';
                        }
                    })
                    .catch(() => {
                        statusEl.textContent = '✗ Failed to save';
                        statusEl.style.color = '#dc2626';
                    });
            });
    </script>
@endpush