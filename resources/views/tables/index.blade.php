@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-200 py-12 font-lemon">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-extrabold text-black mb-6">Restaurant Table Plan</h2>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-[#edece8] border-b border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($tables as $table)
                            <div class="relative p-4 bg-gray-200 rounded-lg shadow-md">
                                <div class="flex justify-between items-center mb-2">
                                    <h3 class="text-lg font-semibold">Table {{ $table->table_number }}</h3>
                                    <span class="px-2 py-1 text-sm rounded-full {{ $table->is_reserved ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $table->is_reserved ? 'Reserved' : 'Available' }}
                                </span>
                                </div>
                                <div class="relative">
                                    <!-- Table and Chairs Layout -->
                                    <div class="flex justify-center items-center my-4">
                                        @if($table->seats <= 2)
                                            <!-- Circular table for 2 seats -->
                                            <div class="relative">
                                                <!-- Chair Top -->
                                                <div class="absolute -top-6 left-1/2 transform -translate-x-1/2">
                                                    <i class="bx bx-chair text-2xl {{ $table->is_reserved ? 'text-red-300' : 'text-green-300' }}"></i>
                                                </div>
                                                <!-- Table -->
                                                <div class="w-16 h-16 rounded-full {{ $table->is_reserved ? 'bg-red-100' : 'bg-green-100' }} border-2 border-gray-300 flex items-center justify-center">
                                                    {{ $table->table_number }}
                                                </div>
                                                <!-- Chair Bottom -->
                                                <div class="absolute -bottom-6 left-1/2 transform -translate-x-1/2">
                                                    <i class="bx bx-chair text-2xl {{ $table->is_reserved ? 'text-red-300' : 'text-green-300' }}"></i>
                                                </div>
                                            </div>
                                        @elseif($table->seats <= 4)
                                            <!-- Square table for 4 seats -->
                                            <div class="relative">
                                                <!-- Top Chairs -->
                                                <div class="absolute -top-6 left-0 right-0 flex justify-around">
                                                    @for($i = 0; $i < 2; $i++)
                                                        <i class="bx bx-chair text-2xl {{ $table->is_reserved ? 'text-red-300' : 'text-green-300' }}"></i>
                                                    @endfor
                                                </div>
                                                <!-- Table -->
                                                <div class="w-24 h-24 {{ $table->is_reserved ? 'bg-red-100' : 'bg-green-100' }} border-2 border-gray-300 flex items-center justify-center">
                                                    {{ $table->table_number }}
                                                </div>
                                                <!-- Bottom Chairs -->
                                                <div class="absolute -bottom-6 left-0 right-0 flex justify-around">
                                                    @for($i = 0; $i < 2; $i++)
                                                        <i class="bx bx-chair text-2xl {{ $table->is_reserved ? 'text-red-300' : 'text-green-300' }}"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        @else
                                            <!-- Rectangle table for 6+ seats -->
                                            <div class="relative">
                                                <!-- Top Chairs -->
                                                <div class="absolute -top-6 left-0 right-0 flex justify-around">
                                                    @for($i = 0; $i < ($table->seats > 8 ? 4 : min(floor($table->seats/2), 5)); $i++)
                                                        <i class="bx bx-chair text-2xl {{ $table->is_reserved ? 'text-red-300' : 'text-green-300' }}"></i>
                                                    @endfor
                                                </div>
                                                <!-- Table -->
                                                <div class="w-40 h-24 {{ $table->is_reserved ? 'bg-red-100' : 'bg-green-100' }} border-2 border-gray-300 flex items-center justify-center">
                                                    {{ $table->table_number }}
                                                </div>
                                                <!-- Bottom Chairs -->
                                                <div class="absolute -bottom-6 left-0 right-0 flex justify-around">
                                                    @for($i = 0; $i < ($table->seats > 8 ? 4 : min(ceil($table->seats/2), 5)); $i++)
                                                        <i class="bx bx-chair text-2xl {{ $table->is_reserved ? 'text-red-300' : 'text-green-300' }}"></i>
                                                    @endfor
                                                </div>
                                                <!-- Side Chairs for tables with more than 8 seats -->
                                                @if($table->seats > 8)
                                                    <!-- Left Side Chair -->
                                                    <div class="absolute top-1/2 -left-6 transform -translate-y-1/2">
                                                        <i class="bx bx-chair text-2xl {{ $table->is_reserved ? 'text-red-300' : 'text-green-300' }}"></i>
                                                    </div>
                                                    <!-- Right Side Chair -->
                                                    <div class="absolute top-1/2 -right-6 transform -translate-y-1/2">
                                                        <i class="bx bx-chair text-2xl {{ $table->is_reserved ? 'text-red-300' : 'text-green-300' }}"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mt-4 text-sm text-yellow-400">
                                    Seats: {{ $table->seats }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

