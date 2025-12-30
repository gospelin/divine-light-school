{{-- resources/views/admissions.blade.php --}}
@extends('layouts.app')

@section('content')
    <!-- Hero -->
    <section class="relative w-full h-screen overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center animate-ken-burns"
            style="background-image: linear-gradient(135deg, rgba(8,56,115,0.85), rgba(131,4,11,0.65)), url('{{ asset('images/students.jpg') }}');">
        </div>
        <div class="relative h-full flex items-center">
            <div class="container max-w-7xl mx-auto px-6 sm:px-8 lg:px-16 text-center text-white">
                <h1
                    class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-8 animate-in fade-in slide-in-from-top duration-1000">
                    Admissions
                </h1>
                <p
                    class="text-xl sm:text-2xl lg:text-3xl max-w-4xl mx-auto opacity-95 font-light animate-in fade-in duration-1000 delay-200">
                    Join our Christ-centered family and give your child a strong foundation for life.
                </p>
            </div>
        </div>
    </section>

    <!-- Admissions Process -->
    <section class="py-16 sm:py-24 bg-white">
        <div class="container max-w-7xl mx-auto px-6">
            <h2 class="text-4xl sm:text-5xl font-bold text-center mb-12 text-[#083873] animate-in fade-in duration-700">
                Admissions Process
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="text-center animate-in fade-in zoom-in duration-700 delay-100">
                    <div
                        class="w-20 h-20 mx-auto bg-[#083873] text-white rounded-full flex items-center justify-center text-3xl font-bold mb-6">
                        1</div>
                    <h3 class="text-xl font-bold mb-4">Inquiry</h3>
                    <p class="opacity-90">Contact us or visit the school to learn more and schedule a tour.</p>
                </div>
                <div class="text-center animate-in fade-in zoom-in duration-700 delay-200">
                    <div
                        class="w-20 h-20 mx-auto bg-[#083873] text-white rounded-full flex items-center justify-center text-3xl font-bold mb-6">
                        2</div>
                    <h3 class="text-xl font-bold mb-4">Application</h3>
                    <p class="opacity-90">Complete and submit the admission form with required documents.</p>
                </div>
                <div class="text-center animate-in fade-in zoom-in duration-700 delay-300">
                    <div
                        class="w-20 h-20 mx-auto bg-[#083873] text-white rounded-full flex items-center justify-center text-3xl font-bold mb-6">
                        3</div>
                    <h3 class="text-xl font-bold mb-4">Assessment</h3>
                    <p class="opacity-90">Your child will take an entrance assessment or interview.</p>
                </div>
                <div class="text-center animate-in fade-in zoom-in duration-700 delay-400">
                    <div
                        class="w-20 h-20 mx-auto bg-[#083873] text-white rounded-full flex items-center justify-center text-3xl font-bold mb-6">
                        4</div>
                    <h3 class="text-xl font-bold mb-4">Enrollment</h3>
                    <p class="opacity-90">Receive offer letter, pay fees, and secure your child's place.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Requirements & CTA -->
    <section class="py-16 sm:py-24 bg-gray-50">
        <div class="container max-w-7xl mx-auto px-6 text-center">
            <h2 class="text-4xl sm:text-5xl font-bold mb-12 text-[#083873] animate-in fade-in duration-700">
                Ready to Apply?
            </h2>
            <p class="text-lg sm:text-xl max-w-3xl mx-auto mb-10 opacity-90 animate-in fade-in duration-700 delay-100">
                Download the application form or contact our admissions office for guidance.
            </p>
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="#contact"
                    class="bg-[#83040b] text-white px-10 py-4 rounded-lg font-bold hover:bg-[#083873] transition animate-in fade-in duration-700 delay-200">
                    Contact Admissions
                </a>
                <a href="#"
                    class="border-2 border-[#083873] text-[#083873] px-10 py-4 rounded-lg font-bold hover:bg-[#083873] hover:text-white transition animate-in fade-in duration-700 delay-300">
                    Download Form
                </a>
            </div>
        </div>
    </section>
@endsection