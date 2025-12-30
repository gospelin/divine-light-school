{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="container max-w-7xl mx-auto px-6 py-4">
        <h1 class="text-5xl font-bold mb-6 text-[#083873]">Admin Dashboard</h1>
        <p class="text-xl mb-10">Welcome back, {{ auth()->user()->name }}!</p>
    </div>

    <!-- Quick Actions Grid -->
    <section class="py-4 bg-gray-50">
        <div class="container max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <a href="{{ route('admin.blog.index') }}"
                    class="bg-white rounded-2xl shadow-xl p-8 text-center hover:shadow-2xl hover:-translate-y-2 transition">
                    <svg class="w-16 h-16 mx-auto mb-6 text-[#083873]" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <h3 class="text-2xl font-bold mb-3">Manage Blog</h3>
                    <p class="opacity-80">Create, edit, and publish school news & updates</p>
                </a>

                <!-- Add more quick actions as you build features -->
                <div class="bg-white rounded-2xl shadow-xl p-8 text-center opacity-50">
                    <svg class="w-16 h-16 mx-auto mb-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <h3 class="text-2xl font-bold mb-3">Manage Users</h3>
                    <p class="opacity-80">Coming soon</p>
                </div>

                <div class="bg-white rounded-2xl shadow-xl p-8 text-center opacity-50">
                    <svg class="w-16 h-16 mx-auto mb-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="text-2xl font-bold mb-3">Result Broadsheet</h3>
                    <p class="opacity-80">Coming soon</p>
                </div>
            </div>
        </div>
    </section>
@endsection