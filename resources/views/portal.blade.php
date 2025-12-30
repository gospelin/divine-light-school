{{-- resources/views/portal.blade.php --}}
@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative w-full h-screen overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center animate-ken-burns"
            style="background-image: linear-gradient(135deg, rgba(8,56,115,0.85), rgba(131,4,11,0.65)), url('{{ asset('images/IT-classroom.jpg') }}');">
        </div>
        <div class="relative h-full flex items-center">
            <div class="container max-w-7xl mx-auto px-6 text-center text-white">
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-8">
                    School Portal
                </h1>
                <p class="text-xl sm:text-2xl lg:text-3xl max-w-4xl mx-auto opacity-95 font-light">
                    Secure access for administrators, teachers, students, and parents.
                </p>
            </div>
        </div>
    </section>

    <!-- Role Selection -->
    <section class="py-20 sm:py-32 bg-gray-50">
        <div class="container max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl sm:text-5xl font-bold mb-6 text-[#083873]">
                    Choose Your Portal
                </h2>
                <p class="text-xl text-gray-700 max-w-3xl mx-auto">
                    Select your role to access your personalized dashboard.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-5xl mx-auto">
                <!-- Admin / Staff -->
                <a href="{{ route('portal.admin.login') }}"
                    class="group block bg-white rounded-2xl shadow-xl p-10 text-center hover:shadow-2xl hover:-translate-y-3 transition-all duration-500">
                    <div
                        class="w-24 h-24 mx-auto mb-6 bg-[#083873]/10 rounded-full flex items-center justify-center group-hover:bg-[#083873]/20 transition">
                        <svg class="w-12 h-12 text-[#083873]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-[#083873]">Admin & Staff</h3>
                    <p class="text-gray-600">Manage school operations, content, users, and settings.</p>
                </a>

                <!-- Teacher -->
                <a href="{{ route('portal.teacher.login') }}"
                    class="group block bg-white rounded-2xl shadow-xl p-10 text-center hover:shadow-2xl hover:-translate-y-3 transition-all duration-500">
                    <div
                        class="w-24 h-24 mx-auto mb-6 bg-[#083873]/10 rounded-full flex items-center justify-center group-hover:bg-[#083873]/20 transition">
                        <svg class="w-12 h-12 text-[#083873]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-[#083873]">Teachers</h3>
                    <p class="text-gray-600">Record attendance, upload results, manage classes.</p>
                </a>

                <!-- Student / Parent -->
                <a href="{{ route('portal.student.login') }}"
                    class="group block bg-white rounded-2xl shadow-xl p-10 text-center hover:shadow-2xl hover:-translate-y-3 transition-all duration-500">
                    <div
                        class="w-24 h-24 mx-auto mb-6 bg-[#083873]/10 rounded-full flex items-center justify-center group-hover:bg-[#083873]/20 transition">
                        <svg class="w-12 h-12 text-[#083873]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422A12.083 12.083 0 0112 21.5c-2.694 0-5.228-1.038-7.116-2.922L12 14z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-[#083873]">Students & Parents</h3>
                    <p class="text-gray-600">View results, attendance, fees, and announcements.</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="py-20 bg-white">
        <div class="container max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-4xl sm:text-5xl font-bold mb-12 text-[#083873]">
                Secure & Easy Access
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-5xl mx-auto">
                <div class="space-y-4">
                    <svg class="w-16 h-16 mx-auto text-[#083873]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <h3 class="text-2xl font-bold">Secure Login</h3>
                    <p class="text-gray-600">Protected with modern encryption and session management.</p>
                </div>
                <div class="space-y-4">
                    <svg class="w-16 h-16 mx-auto text-[#083873]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-2xl font-bold">Role-Based Access</h3>
                    <p class="text-gray-600">See only what you need based on your role.</p>
                </div>
                <div class="space-y-4">
                    <svg class="w-16 h-16 mx-auto text-[#083873]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    <h3 class="text-2xl font-bold">Mobile Friendly</h3>
                    <p class="text-gray-600">Access your portal anytime, anywhere.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Support CTA -->
    <section class="py-16 bg-[#083873] text-white text-center">
        <div class="container max-w-7xl mx-auto px-6">
            <h2 class="text-3xl sm:text-4xl font-bold mb-8">
                Need Help Accessing Your Portal?
            </h2>
            <p class="text-xl mb-10 max-w-3xl mx-auto opacity-90">
                Contact our administration for login credentials or technical support.
            </p>
            <a href="/contact"
                class="inline-block bg-white text-[#083873] px-10 py-4 rounded-full font-bold hover:bg-gray-100 transition shadow-xl">
                Contact Administration
            </a>
        </div>
    </section>
@endsection