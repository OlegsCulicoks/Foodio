@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 font-lemon">
        <h1 class="text-3xl font-bold mb-6">Make a Reservation</h1>

        @include('reservations.stepper', ['currentStep' => 1])

        <div class="step-content active" data-step="1">
            <form action="{{ route('reservations.postStep1') }}" method="POST" class="max-w-md mx-auto">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-black text-sm font-bold mb-2">Name</label>
                    <input type="text" name="name" id="name" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('name') }}">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-black text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" id="email" required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ old('email') }}">
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-white hover:text-yellow-400 border border-yellow-400 transition duration-300 next-step">
                        Next
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

