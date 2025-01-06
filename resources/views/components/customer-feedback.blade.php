<section class="bg-gray-200 py-20">
    <div class="container mx-auto px-4 flex flex-wrap items-center font-lemon">
        <div class="w-full md:w-1/2 mb-10 md:mb-0 rounded-lg shadow-md p-6 bg-white">
            <h2 class="text-3xl font-bold mb-4">Customer <span class="text-yellow-400">Feedback</span></h2>
            <p class="mb-6 text-black">
                {{ $feedback['text'] }}
            </p>
            <div class="flex items-center mb-6">
                <img src="{{ asset('images/happycostumer.jpeg') }}" alt="Customer" class="rounded-full  max-w-[90px] h-[90px] object-cover">
                <div>
                    <h6 class="font-semibold ml-5">{{ $feedback['name'] }}</h6>
                    <p class="text-sm text-yellow-400 ml-5">{{ $feedback['title'] }}</p>
                </div>
            </div>
            <div class="flex space-x-8">
                <div class="text-center">
                    <svg class="h-8 w-8 text-yellow-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <h4 class="text-2xl font-bold">{{ $stats['loves'] }}</h4>
                    <p class="text-sm text-black">Happy Customers</p>
                </div>
                <div class="text-center">
                    <svg class="h-8 w-8 text-yellow-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                    <h4 class="text-2xl font-bold">{{ $stats['awards'] }}</h4>
                    <p class="text-sm text-black">Awards Won</p>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/2 text-center">
            <img src="{{ asset('images/chef.jpg') }}" alt="Chef" class="inline-block rounded-lg shadow-lg bg-white">
        </div>
    </div>
</section>

