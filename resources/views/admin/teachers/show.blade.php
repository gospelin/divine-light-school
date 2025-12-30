@extends('layouts.admin')

@section('title', 'Teacher Profile')

@section('content')
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border p-10">
            <div class="text-center mb-12">
                <div class="w-32 h-32 bg-gray-200 border-4 border-dashed rounded-full mx-auto mb-6"></div>
                <h1 class="text-4xl font-bold text-blue-900">{{ $teacher->user->name }}</h1>
                <p class="text-xl text-gray-700 mt-2">{{ $teacher->qualification }}</p>
                @if($teacher->specialization)
                    <p class="text-lg text-gray-600">Specialization: {{ $teacher->specialization }}</p>
                @endif
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-12">
                <div>
                    <h3 class="text-2xl font-bold mb-6 text-gray-800">Contact Information</h3>
                    <dl class="space-y-4">
                        <div class="flex justify-between border-b pb-3">
                            <dt class="text-gray-600">Email</dt>
                            <dd class="font-medium">{{ $teacher->user->email }}</dd>
                        </div>
                        <div class="flex justify-between border-b pb-3">
                            <dt class="text-gray-600">Phone</dt>
                            <dd class="font-medium">{{ $teacher->phone }}</dd>
                        </div>
                        <div class="flex justify-between border-b pb-3">
                            <dt class="text-gray-600">Address</dt>
                            <dd class="font-medium">{{ $teacher->address }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-600">Date Employed</dt>
                            <dd class="font-medium">{{ $teacher->date_employed->format('d M Y') }}</dd>
                        </div>
                    </dl>
                </div>

                <div>
                    <h3 class="text-2xl font-bold mb-6 text-gray-800">Classes Assigned (Current Session)</h3>
                    @if($teacher->currentClasses->count())
                        <div class="space-y-3">
                            @foreach($teacher->currentClasses as $assignment)
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <p class="font-semibold text-blue-900">{{ $assignment->schoolClass->display_name }}</p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 italic">No classes assigned this session.</p>
                    @endif
                </div>
            </div>

            @if($teacher->bio)
                <div class="mb-12">
                    <h3 class="text-2xl font-bold mb-4 text-gray-800">Bio</h3>
                    <p class="text-gray-700 leading-relaxed">{{ $teacher->bio }}</p>
                </div>
            @endif

            <div class="flex justify-center gap-6">
                <a href="{{ route('admin.teachers.edit', $teacher) }}"
                    class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition">
                    Edit Profile
                </a>
                <a href="{{ route('admin.teachers.index') }}"
                    class="px-8 py-3 border-2 border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    Back to List
                </a>
            </div>
        </div>
    </div>
@endsection