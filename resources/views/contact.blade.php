{{-- resources/views/contact.blade.php --}}
@extends('layouts.app')

@section('content')
    <!-- Hero -->
    <section class="relative w-full h-screen overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center animate-ken-burns"
            style="background-image: linear-gradient(135deg, rgba(8,56,115,0.85), rgba(131,4,11,0.65)), url('{{ asset('images/school_building.jpg') }}');">
        </div>
        <div class="relative h-full flex items-center">
            <div class="container max-w-7xl mx-auto px-6 sm:px-8 lg:px-16 text-center text-white">
                <h1
                    class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold mb-8 animate-in fade-in slide-in-from-top duration-1000">
                    Contact Us
                </h1>
                <p
                    class="text-xl sm:text-2xl lg:text-3xl max-w-4xl mx-auto opacity-95 font-light animate-in fade-in duration-1000 delay-200">
                    We’d love to hear from you. Reach out for inquiries, tours, or admissions.
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Info & Form -->
    <section class="py-16 sm:py-24 bg-white">
        <div class="container max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div class="animate-in fade-in slide-in-from-left duration-800">
                    <h2 class="text-3xl sm:text-4xl font-bold mb-8 text-[#083873]">Get in Touch</h2>
                    <div class="space-y-6">
                        <p class="flex items-center gap-4 text-lg"><svg class="w-6 h-6 text-[#83040b]" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg> KM 3 Aba-Port Harcourt Road, Abayi, Abia State, Nigeria</p>
                        <p class="flex items-center gap-4 text-lg"><svg class="w-6 h-6 text-[#83040b]" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg> +234 XXX XXX XXXX</p>
                        <p class="flex items-center gap-4 text-lg"><svg class="w-6 h-6 text-[#83040b]" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg> info@divinelight.edu.ng</p>
                    </div>
                </div>
                <div class="animate-in fade-in slide-in-from-right duration-800 delay-100">
                    <h2 class="text-3xl sm:text-4xl font-bold mb-8 text-[#083873]">Send a Message</h2>
                    <form class="space-y-6">
                        <input type="text" placeholder="Your Name"
                            class="w-full px-6 py-4 rounded-lg border border-gray-300 focus:border-[#083873] focus:outline-none">
                        <input type="email" placeholder="Your Email"
                            class="w-full px-6 py-4 rounded-lg border border-gray-300 focus:border-[#083873] focus:outline-none">
                        <textarea placeholder="Your Message" rows="6"
                            class="w-full px-6 py-4 rounded-lg border border-gray-300 focus:border-[#083873] focus:outline-none"></textarea>
                        <button type="submit"
                            class="bg-[#83040b] text-white px-10 py-4 rounded-lg font-bold hover:bg-[#083873] transition">Send
                            Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection