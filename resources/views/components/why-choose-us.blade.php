<section class="bg-gray-200 py-20">
    <div class="container mx-auto px-4 flex flex-wrap items-center">
        <div class="w-full md:w-1/2 mb-10 md:mb-0">
            <img src="{{ asset('images/plate.png') }}" alt="plate" class="mx-auto ">
        </div>
        <div class="w-full md:w-1/2 md:pl-10 font-lemon">
            <h2 class="text-3xl font-bold mb-8 text-yellow-400">Why People Choose Us?</h2>
            @foreach($reasons as $reason)
                <div class="flex items-start mb-6">
                    <div class="bg-yellow-400 rounded-full p-2 mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-2 text-yellow-500">{{ $reason['title'] }}</h3>
                        <p class="text-black">{{ $reason['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

