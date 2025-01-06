@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-100 py-12 bg-gray-200">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-black text-center mb-12 font-lemon text-yellow-400">Select Meals</h1>

            <form action="{{ route('reservations.postStep3') }}" method="POST">
                @csrf
                @for ($guestNumber = 1; $guestNumber <= $guestCount; $guestNumber++)
                    <h2 class="text-2xl md:text-3xl font-bold mb-6 text-yellow-400 font-lemon">Guest {{ $guestNumber }}</h2>

                    @foreach ($menuItems as $category => $items)
                        <h3 class="text-xl md:text-2xl font-bold mb-4 text-yellow-400 font-lemon">{{ $category }}</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
                            @foreach ($items as $item)
                                <div class="menu-item group border-2 border-yellow-400 transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-105 duration-300 rounded-t-lg">

                                    <img src="{{ asset('storage/images/' . $item->image) }}" alt="{{ $item['name'] }}" class="w-full h-48 object-cover rounded-t-lg">

                                    <div class="p-4 bg-gray-200 rounded-b-lg">
                                        <h4 class="font-bold text-lg mb-1 font-lemon">{{ $item->name }}</h4>
                                        <p class="text-sm text-black mb-2 font-lemon">{{ $item->description }}</p>
                                        <p class="text-red-600 font-bold font-lemon">€{{ number_format($item->price, 2) }}</p>
                                        <div class="mt-2">
                                            <label class="inline-flex items-center">
                                                <input type="checkbox"
                                                       name="meals[{{ $guestNumber }}][]"
                                                       value="{{ $item->id }}"
                                                       class="form-checkbox text-yellow-400">
                                                <span class="ml-2 text-sm font-lemon">Select</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                    @if ($guestNumber < $guestCount)
                        <hr class="my-8 border-yellow-400">
                    @endif
                @endfor

                <div class="flex flex-col sm:flex-row justify-between mt-8">
                    <a href="{{ route('reservations.step2') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-white hover:text-gray-500 border border-gray-400 transition duration-300 font-lemon mb-4 sm:mb-0 text-center">
                        Back
                    </a>
                    <button type="submit" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-white hover:text-yellow-400 border border-yellow-400 transition duration-300 font-lemon text-center">
                        Next
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

