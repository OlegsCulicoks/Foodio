@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 font-lemon">


        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h2 class="text-2xl font-semibold mb-4 text-yellow-400">Our Story</h2>
                <p class="mb-4">
                    Welcome to our restaurant, where culinary excellence meets warm hospitality. Established in 2010, we have been serving our community with passion and dedication for over a decade.
                </p>
                <p class="mb-4">
                    Our mission is to provide an unforgettable dining experience by combining innovative cuisine, exceptional service, and a welcoming atmosphere. We source the finest ingredients locally and prepare each dish with care and creativity.
                </p>
                <p>
                    Whether you're joining us for a romantic dinner, a family celebration, or a business lunch, we strive to make every visit special. Our team of experienced chefs and friendly staff are committed to ensuring your satisfaction.
                </p>
            </div>
        </div>

        <div class="mt-12">
            <h2 class="text-2xl font-semibold mb-4 text-yellow-400">Our Team</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <img src="{{ asset('images/chef1.png') }}" alt="Head Chef" class="rounded-full w-[200px] h-[200px] border-2 border-yellow-400 mx-auto mb-4">
                    <h3 class="font-semibold">Janis Berzins</h3>
                    <p class="text-gray-600">Head Chef</p>
                </div>
                <div class="text-center">
                    <img src="{{ asset('images/me.jpg') }}" alt="Restaurant Manager" class="rounded-full w-[200px] h-[200px] border-2 border-yellow-400 mx-auto mb-4">
                    <h3 class="font-semibold">Olegs Culicoks</h3>
                    <p class="text-gray-600">Restaurant Manager</p>
                </div>
                <div class="text-center">
                    <img src="{{ asset('images/chef3.png') }}" alt="Manager Assistant" class="rounded-full w-[200px] h-[200px] border-2 border-yellow-400 mx-auto mb-4">
                    <h3 class="font-semibold">Oskars Kreisais</h3>
                    <p class="text-gray-600">Manager Assistant</p>
                </div>
            </div>
        </div>

        <div class="mt-12">
            <h2 class="text-2xl font-semibold mb-4 text-yellow-400">Visit Us</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h3 class="font-semibold mb-2">Address</h3>
                    <p>Valmieras iela</p>
                    <p>Cesis, Latvia</p>
                    <p class="mt-4">
                        <strong>Phone:</strong> +371 22367849<br>
                        <strong>Email:</strong> info@foodiorestaurant.com
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

