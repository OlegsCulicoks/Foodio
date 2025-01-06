@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 font-lemon">
        <h1 class="text-3xl font-bold mb-6">Make a Reservation</h1>

        @include('reservations.stepper', ['currentStep' => 2])

        <div class="step-content active" data-step="2">
            <form action="{{ route('reservations.postStep2') }}" method="POST" class="max-w-md mx-auto">
                @csrf
                <div class="mb-4">
                    <label for="guest_count" class="block text-gray-black text-sm font-bold mb-2">Number of Guests</label>
                    <input type="number" name="guest_count" id="guest_count" required min="1" max="10" class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline" value="{{ old('guest_count', session('reservation_data.guest_count', 1)) }}">
                </div>
                <div class="mb-4">
                    <label for="table_id" class="block text-black text-sm font-bold mb-2">Select a Table</label>
                    <select name="table_id" id="table_id" required class="shadow appearance-none border rounded w-full py-2 px-3 text-black leading-tight focus:outline-none focus:shadow-outline">
                        <option value="">Choose a table</option>
                        @foreach ($tables as $table)
                            <option value="{{ $table->id }}" {{ old('table_id', session('reservation_data.table_id')) == $table->id ? 'selected' : '' }}>
                                Table {{ $table->table_number }} ({{ $table->seats }} seats)
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-center justify-between">
                    <a href="{{ route('reservations.create') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-white hover:text-gray-500 border border-gray-400 transition duration-300 prev-step">
                        Back
                    </a>
                    <button type="submit" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-white hover:text-yellow-400 border border-yellow-400 transition duration-300 next-step">
                        Next
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

