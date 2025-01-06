<section class="bg-gray-200 py-20">
    <div class="container mx-auto px-4 font-lemon bg-gray-200">
        <h2 class="text-3xl font-bold text-center mb-12 text-yellow-400">Featured Items</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6 rounded-lg shadow-md bg-white">
                <img src="{{ asset('images/Beef steak burger .png') }}" alt="Steak burger" class="mx-auto mb-4 w-40 h-40 object-cover rounded-full">
                <h3 class="text-xl font-semibold mb-2">Steak burger</h3>
                <p class="text-black mb-4">Juicy steak burger with fresh vegetables</p>
                <a href="{{ route('menu') }}" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-white hover:text-yellow-400 border border-yellow-400 transition duration-300">
                    See Menu
                </a>

            </div>
            <div class="text-center p-6 rounded-lg shadow-md bg-white">
                <img src="{{ asset('images/Pork shashlik with cherry tomato sauce.png') }}" alt="Pork shashlik" class="mx-auto mb-4 w-40 h-40 object-cover rounded-full">
                <h3 class="text-xl font-semibold mb-2">Pork shashlik</h3>
                <p class="text-black mb-4">Tender pork shashlik with special marinade</p>
                <a href="{{ route('menu') }}" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-white hover:text-yellow-400 border border-yellow-400 transition duration-300">
                    See Menu
                </a>
            </div>
            <div class="text-center p-6 rounded-lg shadow-md bg-white">
                <img src="{{ asset('images/fried onion rings.png') }}" alt="Fried onion rings" class="mx-auto mb-4 w-40 h-40 object-cover rounded-full">
                <h3 class="text-xl font-semibold mb-2">Fried onion rings</h3>
                <p class="text-black mb-4">Crispy fried onion rings</p>
                <a href="{{ route('menu') }}" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-white hover:text-yellow-400 border border-yellow-400 transition duration-300">
                    See Menu
                </a>
            </div>
        </div>
    </div>
</section>

