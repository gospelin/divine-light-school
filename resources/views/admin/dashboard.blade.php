@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Page Header -->
    <div class="mb-8 sm:mb-10">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Welcome back, {{ auth()->user()->name }}!</h1>
        <p class="text-base sm:text-lg text-gray-600">Here's what's happening at Divine Light School today.</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-blue-50 rounded-lg">
                    <svg class="w-7 h-7 sm:w-8 sm:h-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <span class="text-xs sm:text-sm font-medium text-green-600 bg-green-50 px-2 py-1 rounded-full">+12%</span>
            </div>
            <h3 class="text-2xl sm:text-3xl font-bold text-gray-900">1,245</h3>
            <p class="text-sm sm:text-base text-gray-600 mt-1">Total Students</p>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-green-50 rounded-lg">
                    <svg class="w-7 h-7 sm:w-8 sm:h-8 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <span class="text-xs sm:text-sm font-medium text-green-600 bg-green-50 px-2 py-1 rounded-full">+5%</span>
            </div>
            <h3 class="text-2xl sm:text-3xl font-bold text-gray-900">89</h3>
            <p class="text-sm sm:text-base text-gray-600 mt-1">Teachers & Staff</p>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-amber-50 rounded-lg">
                    <svg class="w-7 h-7 sm:w-8 sm:h-8 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />
                    </svg>
                </div>
                <span class="text-xs sm:text-sm font-medium text-red-600 bg-red-50 px-2 py-1 rounded-full">-2%</span>
            </div>
            <h3 class="text-2xl sm:text-3xl font-bold text-gray-900">12</h3>
            <p class="text-sm sm:text-base text-gray-600 mt-1">Pending Fee Payments</p>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="p-3 bg-purple-50 rounded-lg">
                    <svg class="w-7 h-7 sm:w-8 sm:h-8 text-purple-700" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <span class="text-xs sm:text-sm font-medium text-green-600 bg-green-50 px-2 py-1 rounded-full">+18%</span>
            </div>
            <h3 class="text-2xl sm:text-3xl font-bold text-gray-900">24</h3>
            <p class="text-sm sm:text-base text-gray-600 mt-1">Upcoming Events</p>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-10">
        <!-- Attendance Overview -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <h2 class="text-xl sm:text-2xl font-bold mb-4">Monthly Attendance</h2>
            <div class="h-64 bg-gray-50 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300">
                <p class="text-gray-500">Line Chart Placeholder (e.g., 95% average this month)</p>
            </div>
        </div>

        <!-- Student Performance -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <h2 class="text-xl sm:text-2xl font-bold mb-4">Performance Summary</h2>
            <div class="h-64 bg-gray-50 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300">
                <p class="text-gray-500">Pie Chart Placeholder (e.g., Excellent: 45%, Good: 35%, Average: 20%)</p>
            </div>
        </div>
    </div>

    <!-- Bottom Row: Recent Activity, Upcoming Events, Fee Collection, Quick Links -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Activity -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <h2 class="text-xl sm:text-2xl font-bold mb-5">Recent Activity</h2>
            <div class="space-y-5 text-sm">
                <!-- Items as before, slightly smaller text -->
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-4 h-4 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium">New student enrollment</p>
                        <p class="text-gray-600">John Doe joined Grade 8A</p>
                        <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                    </div>
                </div>
                <!-- Add more as needed -->
            </div>
        </div>

        <!-- Upcoming Events + Fee Collection -->
        <div class="space-y-6">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                <h2 class="text-xl sm:text-2xl font-bold mb-5">Upcoming Events</h2>
                <div class="space-y-4 text-sm">
                    <!-- Items as before -->
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                <h2 class="text-xl sm:text-2xl font-bold mb-4">Fee Collection This Term</h2>
                <div
                    class="h-48 bg-gray-50 rounded-lg flex items-center justify-center border-2 border-dashed border-gray-300">
                    <p class="text-gray-500">Bar Chart Placeholder (e.g., Collected: 78%)</p>
                </div>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
            <h2 class="text-xl sm:text-2xl font-bold mb-5">Quick Actions</h2>
            <div class="grid grid-cols-2 gap-4 text-sm">
                <a href="{{ route('admin.blog.index') }}"
                    class="p-4 bg-blue-50 rounded-lg text-center hover:bg-blue-100 transition">
                    <svg class="w-8 h-8 mx-auto mb-2 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Manage Blog
                </a>
                <a href="{{ route('admin.events.index') }}"
                    class="p-4 bg-green-50 rounded-lg text-center hover:bg-green-100 transition">
                    <svg class="w-8 h-8 mx-auto mb-2 text-green-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Manage Events
                </a>
                <!-- Add more quick actions -->
            </div>
        </div>
    </div>
@endsection