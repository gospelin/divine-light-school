{{-- resources/views/programs.blade.php --}}
@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative w-full h-screen overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center animate-ken-burns"
            style="background-image: linear-gradient(135deg, rgba(8,56,115,0.85), rgba(131,4,11,0.65)), url('{{ asset('images/children-play.jpg') }}');">
        </div>
        <div class="relative h-full flex items-center">
            <div class="container max-w-7xl mx-auto px-6 sm:px-8 lg:px-16 text-center text-white">
                <h1
                    class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-8 animate-in fade-in slide-in-from-top duration-1000">
                    Our Academic Programs
                </h1>
                <p
                    class="text-xl sm:text-2xl lg:text-3xl max-w-4xl mx-auto opacity-95 font-light animate-in fade-in duration-1000 delay-200">
                    Quality Christ-centered education from Nursery through Secondary, designed to nurture academic
                    excellence, moral values, and spiritual growth.
                </p>
            </div>
        </div>
    </section>

    <!-- Programs Overview -->
    <section class="py-16 sm:py-24 bg-white">
        <div class="container max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl sm:text-5xl font-bold mb-6 text-[#083873] animate-in fade-in duration-700">
                    Stages of Learning at Divine Light
                </h2>
                <p class="text-lg sm:text-xl max-w-4xl mx-auto opacity-90 animate-in fade-in duration-800 delay-100">
                    We offer a seamless educational journey from early childhood through secondary school, blending the
                    British and Nigerian curricula with strong Christian principles.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Nursery Program -->
                <div
                    class="bg-gray-50 rounded-2xl shadow-xl overflow-hidden transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 animate-in fade-in zoom-in duration-700 delay-100">
                    <div class="h-64 bg-cover bg-center"
                        style="background-image: url('{{ asset('images/children-play.jpg') }}');"></div>
                    <div class="p-8">
                        <h3 class="text-2xl sm:text-3xl font-bold mb-4 text-[#083873]">Nursery (Early Years)</h3>
                        <p class="text-base sm:text-lg mb-6 opacity-90">
                            Ages 2–5: Play-based learning in a safe, loving environment that builds foundational skills,
                            social interaction, creativity, and introduces Christian values.
                        </p>
                        <ul class="space-y-3 text-sm sm:text-base opacity-90">
                            <li class="flex items-start gap-3"><svg class="w-5 h-5 text-[#83040b] flex-shrink-0 mt-0.5"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg> Phonics & Literacy</li>
                            <li class="flex items-start gap-3"><svg class="w-5 h-5 text-[#83040b] flex-shrink-0 mt-0.5"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg> Numeracy Basics</li>
                            <li class="flex items-start gap-3"><svg class="w-5 h-5 text-[#83040b] flex-shrink-0 mt-0.5"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg> Bible Stories & Moral Lessons</li>
                            <li class="flex items-start gap-3"><svg class="w-5 h-5 text-[#83040b] flex-shrink-0 mt-0.5"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg> Arts, Music & Play</li>
                        </ul>
                    </div>
                </div>

                <!-- Primary Program -->
                <div
                    class="bg-gray-50 rounded-2xl shadow-xl overflow-hidden transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 animate-in fade-in zoom-in duration-700 delay-200">
                    <div class="h-64 bg-cover bg-center"
                        style="background-image: url('{{ asset('images/classroom.jpg') }}');"></div>
                    <div class="p-8">
                        <h3 class="text-2xl sm:text-3xl font-bold mb-4 text-[#083873]">Primary</h3>
                        <p class="text-base sm:text-lg mb-6 opacity-90">
                            Years 1–6: Building strong academic foundations with a balanced curriculum that encourages
                            curiosity, critical thinking, and character development.
                        </p>
                        <ul class="space-y-3 text-sm sm:text-base opacity-90">
                            <li class="flex items-start gap-3"><svg class="w-5 h-5 text-[#83040b] flex-shrink-0 mt-0.5"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg> English, Mathematics & Science</li>
                            <li class="flex items-start gap-3"><svg class="w-5 h-5 text-[#83040b] flex-shrink-0 mt-0.5"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg> Social Studies & Nigerian Languages</li>
                            <li class="flex items-start gap-3"><svg class="w-5 h-5 text-[#83040b] flex-shrink-0 mt-0.5"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg> Christian Religious Knowledge</li>
                            <li class="flex items-start gap-3"><svg class="w-5 h-5 text-[#83040b] flex-shrink-0 mt-0.5"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg> ICT, Arts & Physical Education</li>
                        </ul>
                    </div>
                </div>

                <!-- Secondary Program -->
                <div
                    class="bg-gray-50 rounded-2xl shadow-xl overflow-hidden transition-all duration-500 hover:shadow-2xl hover:-translate-y-2 animate-in fade-in zoom-in duration-700 delay-300">
                    <div class="h-64 bg-cover bg-center"
                        style="background-image: url('{{ asset('images/students.jpg') }}');"></div>
                    <div class="p-8">
                        <h3 class="text-2xl sm:text-3xl font-bold mb-4 text-[#083873]">Secondary</h3>
                        <p class="text-base sm:text-lg mb-6 opacity-90">
                            Junior & Senior Secondary: Preparing students for WAEC, NECO, and higher education with rigorous
                            academics, leadership training, and deepened faith formation.
                        </p>
                        <ul class="space-y-3 text-sm sm:text-base opacity-90">
                            <li class="flex items-start gap-3"><svg class="w-5 h-5 text-[#83040b] flex-shrink-0 mt-0.5"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg> Core Subjects & Electives</li>
                            <li class="flex items-start gap-3"><svg class="w-5 h-5 text-[#83040b] flex-shrink-0 mt-0.5"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg> Advanced Science & Technology</li>
                            <li class="flex items-start gap-3"><svg class="w-5 h-5 text-[#83040b] flex-shrink-0 mt-0.5"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg> Bible Study & Ethics</li>
                            <li class="flex items-start gap-3"><svg class="w-5 h-5 text-[#83040b] flex-shrink-0 mt-0.5"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg> Clubs, Sports & Leadership</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Curriculum Highlights -->
    <section class="py-16 sm:py-24 bg-gray-50">
        <div class="container max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-4xl sm:text-5xl font-bold mb-12 text-[#083873] animate-in fade-in duration-700">
                Our Blended Curriculum
            </h2>
            <p class="text-lg sm:text-xl max-w-5xl mx-auto mb-12 opacity-90 animate-in fade-in duration-800 delay-100">
                We combine the best of the British National Curriculum and the Nigerian National Curriculum, enriched with
                Christian teachings and modern technology integration.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="bg-white rounded-2xl shadow-xl p-8 animate-in fade-in zoom-in duration-700 delay-200">
                    <h3 class="text-xl font-bold mb-4 text-[#083873]">Academic Excellence</h3>
                    <p class="opacity-90">Rigorous standards preparing students for national and international exams.</p>
                </div>
                <div class="bg-white rounded-2xl shadow-xl p-8 animate-in fade-in zoom-in duration-700 delay-300">
                    <h3 class="text-xl font-bold mb-4 text-[#083873]">Faith Integration</h3>
                    <p class="opacity-90">Daily Bible study and moral lessons woven into all subjects.</p>
                </div>
                <div class="bg-white rounded-2xl shadow-xl p-8 animate-in fade-in zoom-in duration-700 delay-400">
                    <h3 class="text-xl font-bold mb-4 text-[#083873]">Technology & Innovation</h3>
                    <p class="opacity-90">Computer labs and ICT skills for the digital age.</p>
                </div>
                <div class="bg-white rounded-2xl shadow-xl p-8 animate-in fade-in zoom-in duration-700 delay-500">
                    <h3 class="text-xl font-bold mb-4 text-[#083873]">Holistic Development</h3>
                    <p class="opacity-90">Sports, arts, clubs, and community service opportunities.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 sm:py-20 bg-[#83040b] text-white text-center">
        <div class="container max-w-7xl mx-auto px-6">
            <h2 class="text-3xl sm:text-4xl font-bold mb-8 animate-in fade-in duration-700">
                Enroll Your Child Today
            </h2>
            <p class="text-xl mb-10 max-w-3xl mx-auto opacity-90 animate-in fade-in duration-700 delay-100">
                Give your child the gift of quality Christ-centered education that prepares them for success in academics
                and in life.
            </p>
            <a href="#admissions"
                class="inline-block bg-white text-[#083873] px-10 py-4 rounded-lg font-bold hover:bg-gray-100 transition shadow-xl animate-in fade-in duration-700 delay-200">
                Start Admissions Process
            </a>
        </div>
    </section>
@endsection