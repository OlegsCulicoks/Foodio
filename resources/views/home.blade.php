@extends('layouts.app')

@section('content')
    <div class="bg-gray-200 font-lemon">
        <div class="container mx-auto px-4 py-20 font-lemon">
            <div class="flex flex-wrap items-center font-lemon">
                <div class="w-full md:w-1/2 mb-10 md:mb-0 font-lemon">
                    <h1 class="text-4xl font-bold mb-4 font-lemon">
                        Enjoy <span class="text-yellow-400 underline decoration-black font-lemon">Delicious Food and Fresh Drinks</span> In our restaurant.
                    </h1>
                    <p class="mb-6 text-black font-lemon">
                        Indulge in a culinary journey where every dish is crafted with passion and every drink is served fresh to elevate your dining experience.
                    </p>
                    <a href="{{ route('reservations.create') }}" class="bg-yellow-400 text-white px-6 py-3 rounded hover:bg-white hover:text-yellow-400 border border-yellow-400 transition duration-300 font-lemon">
                        Book Now
                    </a>
                </div>
                <div class="w-full md:w-1/2 text-center font-lemon">
                    <img src="{{ asset('images/featured-dish.jpg') }}" alt="Featured dish">
                </div>
            </div>
        </div>

        @include('components.featured-items')

        <x-why-choose-us :reasons="$reasons" />

        <x-customer-feedback :feedback="$feedback" :stats="$stats" />

        <x-email-form />
    </div>
@endsection

