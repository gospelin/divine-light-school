{{-- resources/views/auth/login.blade.php --}}
@extends('layouts.app')

@section('content')
    <section class="relative py-24 sm:py-32 bg-white min-h-screen flex items-center justify-center">
        <div class="container max-w-7xl mx-auto px-6">
            <div class="max-w-md mx-auto">
                <div class="bg-gray-50 rounded-2xl shadow-2xl p-10 text-center animate-in fade-in duration-700">
                    <!-- Dynamic Title Based on Route -->
                    <h1 class="text-4xl font-bold mb-8 text-[#083873]">
                        @if(request()->routeIs('portal.admin.login'))
                            Admin & Staff Login
                        @elseif(request()->routeIs('portal.teacher.login'))
                            Teacher Login
                        @elseif(request()->routeIs('portal.student.login'))
                            Student & Parent Login
                        @else
                            Login
                        @endif
                    </h1>

                    <!-- Error Message -->
                    @if(session('status'))
                        <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <!-- Login Form -->
                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <div>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                autocomplete="username"
                                class="w-full px-6 py-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#083873] focus:border-[#083873] transition"
                                placeholder="Email Address">
                        </div>

                        <div>
                            <input type="password" name="password" required autocomplete="current-password"
                                class="w-full px-6 py-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-[#083873] focus:border-[#083873] transition"
                                placeholder="Password">
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center gap-3 cursor-pointer">
                                <input type="checkbox" name="remember"
                                    class="h-5 w-5 text-[#083873] rounded focus:ring-[#083873]">
                                <span class="text-base text-gray-700">Remember me</span>
                            </label>
                            <a href="{{ route('password.request') }}"
                                class="text-[#83040b] hover:underline font-medium text-base">Forgot Password?</a>
                        </div>

                        <button type="submit"
                            class="w-full bg-[#83040b] hover:bg-[#083873] text-white py-4 rounded-lg font-bold transition shadow-xl hover:shadow-2xl">
                            Login
                        </button>
                    </form>

                    <!-- Back to Portal Link -->
                    <div class="mt-8 text-center">
                        <a href="{{ route('portal') }}" class="text-[#083873] hover:underline font-medium">
                            ← Back to Portal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection