@extends('layouts.admin')

@section('title', 'Academic Sessions')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold">Academic Sessions</h1>
        <p class="text-gray-600">Manage school years and set the current session.</p>
    </div>

    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Create New Session -->
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <h2 class="text-xl font-bold mb-4">Create New Session</h2>
            <form action="{{ route('admin.sessions.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <input type="number" name="start_year" placeholder="Start Year" class="border rounded-lg px-4 py-2" required min="2000" max="2100">
                    <input type="number" name="end_year" placeholder="End Year" class="border rounded-lg px-4 py-2" required min="2000" max="2100">
                </div>
                <label class="flex items-center gap-2 mb-4">
                    <input type="checkbox" name="is_current" value="1" class="rounded">
                    <span>Make this the current session</span>
                </label>
                <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Create Session</button>
            </form>
        </div>

        <!-- Your Current View -->
        <!-- Your Current View -->
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <h2 class="text-xl font-bold mb-4">Your Current View</h2>
            <p class="text-lg font-semibold text-blue-700">
                {{ $currentSessionName }}
            </p>
            @if($isPersonalSessionView)
                <p class="text-amber-600 text-sm mt-2">You're viewing a different session than the school default.</p>
            @endif

            <form action="{{ route('admin.sessions.preferred') }}" method="POST" class="mt-4">
                @csrf
                <select name="session_id" class="w-full border rounded-lg px-4 py-2 mb-3">
                    <option value="">→ Use school default</option>
                    @foreach(\App\Models\AcademicSession::orderByDesc('start_year')->get() as $s)
                        <option value="{{ $s->id }}" {{ auth()->user()->preferred_academic_session_id == $s->id ? 'selected' : '' }}>
                            {{ $s->name }} {{ $s->is_current ? '(Official Current)' : '' }}
                        </option>
                    @endforeach
                </select>
                <button class="w-full bg-green-600 text-white py-2 rounded-lg hover:bg-green-700">Update My View</button>
            </form>
        </div>

        <!-- Global Current -->
        <div class="bg-white rounded-xl shadow-sm border p-6">
            <h2 class="text-xl font-bold mb-4">Official Current Session</h2>
            <p class="text-lg font-semibold text-green-700">
                {{ $globalSessionName }}
            </p>
        </div>

    </div>

    <!-- All Sessions List -->
    <div class="mt-10 bg-white rounded-xl shadow-sm border overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-4 text-left">Session</th>
                    <th class="px-6 py-4 text-left">Status</th>
                    <th class="px-6 py-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sessions as $session)
                <tr class="border-t">
                    <td class="px-6 py-4 font-medium">{{ $session->name }}</td>
                    <td class="px-6 py-4">
                        @if($session->is_current)
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Current</span>
                        @else
                            <span class="text-gray-500 text-sm">Inactive</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if(!$session->is_current)
                            <form action="{{ route('admin.sessions.make-current', $session) }}" method="POST" class="inline">
                                @csrf
                                <button class="text-blue-600 hover:underline text-sm">Make Current</button>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection