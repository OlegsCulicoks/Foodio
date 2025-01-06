@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 font-lemon">
        <h1 class="text-3xl font-bold mb-6">Reservation Confirmed</h1>

        <div class="max-w-2xl mx-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <p class="text-xl mb-4">Thank you for your reservation!</p>
            <p>Your reservation has been successfully confirmed. We look forward to seeing you at our restaurant.</p>
            <a href="{{ route('home') }}" class="mt-6 inline-block bg-yellow-400 text-white px-4 py-2 rounded hover:bg-white hover:text-yellow-400 border border-yellow-400 transition duration-300">
                Return to Home
            </a>
        </div>
    </div>
@endsection

