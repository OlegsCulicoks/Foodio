@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 py-12 bg-gray-200">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-black text-center mb-12 font-lemon text-yellow-400">Reservation Summary</h1>

            <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                <h2 class="text-2xl md:text-3xl font-bold mb-6 text-yellow-400 font-lemon">Reservation Details</h2>
                <p class="mb-2 font-lemon"><strong>Name:</strong> {{ $reservationData['name'] }}</p>
                <p class="mb-2 font-lemon"><strong>Email:</strong> {{ $reservationData['email'] }}</p>
                <p class="mb-2 font-lemon"><strong>Number of Guests:</strong> {{ $reservationData['guest_count'] }}</p>
                <p class="mb-2 font-lemon"><strong>Reservation Date:</strong> {{ $reservationData['reservation_date'] }}</p>
                <p class="mb-2 font-lemon"><strong>Reservation Time:</strong> {{ $reservationData['reservation_time'] }}</p>
                <p class="mb-2 font-lemon"><strong>Selected Table:</strong> Table {{ $table->table_number }} ({{ $table->seats }} seats)</p>
            </div>

            <h2 class="text-2xl md:text-3xl font-bold mb-6 text-yellow-400 font-lemon">Selected Meals</h2>

            @php
                $totalPrice = 0;
            @endphp

            @for ($i = 1; $i <= $reservationData['guest_count']; $i++)
                <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                    <h3 class="text-xl md:text-2xl font-bold mb-4 text-yellow-400 font-lemon">Guest {{ $i }}</h3>
                    @if (isset($reservationData['meals'][$i]) && !empty($reservationData['meals'][$i]))
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            @foreach($reservationData['meals'][$i] as $menuItemId)
                                @php
                                    $menuItem = $menuItems->firstWhere('id', $menuItemId);
                                    if ($menuItem) {
                                        $totalPrice += $menuItem->price;
                                    }
                                @endphp
                                @if ($menuItem)
                                    <div class="border-2 border-yellow-400 rounded-lg overflow-hidden">
                                        @if (file_exists(public_path('images/' . $menuItem->image)))
                                            <img src="{{ asset('images/' . $menuItem->image) }}" alt="{{ $menuItem->name }}" class="w-full h-48 object-cover">
                                        @else
                                            <img src="{{ asset('images/placeholder.jpg') }}" alt="{{ $menuItem->name }}" class="w-full h-48 object-cover">
                                        @endif
                                        <div class="p-4 bg-gray-200">
                                            <h4 class="font-bold text-lg mb-1 font-lemon">{{ $menuItem->name }}</h4>
                                            <p class="text-sm text-black mb-2 font-lemon">{{ $menuItem->description }}</p>
                                            <p class="text-red-600 font-bold font-lemon">€{{ number_format($menuItem->price, 2) }}</p>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <p class="text-red-600 font-lemon">No meals selected for this guest.</p>
                    @endif
                </div>
            @endfor

            <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                <h3 class="text-xl md:text-2xl font-bold mb-4 text-yellow-400 font-lemon">Total Price</h3>
                <p class="text-2xl md:text-3xl font-bold text-red-600 font-lemon">€{{ number_format($totalPrice, 2) }}</p>
            </div>

            <form action="{{ route('reservations.store') }}" method="POST" class="mt-8">
                @csrf
                <div class="flex flex-col sm:flex-row justify-between">
                    <a href="{{ route('reservations.step3') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-white hover:text-gray-500 border border-gray-400 transition duration-300 font-lemon mb-4 sm:mb-0 text-center">
                        Back
                    </a>
                    <button type="submit" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-white hover:text-yellow-400 border border-yellow-400 transition duration-300 font-lemon text-center">
                        Confirm Reservation
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

