@extends('layouts.admin')

@section('title', 'Student Promotion')

@section('content')
    <div class="max-w-6xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border p-8">
            <h1 class="text-3xl font-bold mb-8">Student Promotion Tool</h1>
            <p class="text-gray-600 mb-10">Promote students from one class/session to the next at the end of the academic
                year.</p>

            <form action="{{ route('admin.promotions.promote') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                    <!-- From -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-xl font-bold mb-6 text-red-700">From (Current)</h3>

                        <div class="mb-6">
                            <label class="block text-sm font-medium mb-2">Academic Session</label>
                            <select name="from_session_id" class="w-full border rounded-lg px-4 py-3" required>
                                <option value="">Select Session</option>
                                @foreach($sessions as $session)
                                    <option value="{{ $session->id }}">{{ $session->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Class</label>
                            <select name="from_class_id" class="w-full border rounded-lg px-4 py-3" required>
                                <option value="">Select Class</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->display_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- To -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-xl font-bold mb-6 text-green-700">To (Next)</h3>

                        <div class="mb-6">
                            <label class="block text-sm font-medium mb-2">Academic Session</label>
                            <select name="to_session_id" class="w-full border rounded-lg px-4 py-3" required>
                                <option value="">Select Session</option>
                                @foreach($sessions as $session)
                                    <option value="{{ $session->id }}">{{ $session->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-2">Class</label>
                            <select name="to_class_id" class="w-full border rounded-lg px-4 py-3" required>
                                <option value="">Select Class</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->display_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center">
                    <button type="submit"
                        class="bg-blue-700 text-white px-12 py-4 rounded-lg hover:bg-blue-800 text-xl font-semibold shadow-lg">
                        Promote Students
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection