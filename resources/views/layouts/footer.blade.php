<footer class="bg-gray-200 py-8 sm:py-12 border-t-2 border-yellow-400">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 font-lemon">
            <div class="flex flex-col items-center sm:items-start">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-24 w-24 sm:h-32 sm:w-32 lg:h-40 lg:w-40 mb-4">
                <address class="not-italic text-center sm:text-left">
                    <p>Email: culicoksolegs@gmail.com</p>
                    <p>Phone: +371 28015570</p>
                </address>
            </div>
            <div class="flex flex-col justify-center items-center lg:items-start">
                <h3 class="font-semibold mb-2 text-yellow-400">Opening Hours</h3>
                <p>Monday - Friday: 11:00 AM - 10:00 PM</p>
                <p>Saturday - Sunday: 10:00 AM - 11:00 PM</p>
            </div>
            <div class="flex flex-col justify-center items-center lg:items-end">
                <h2 class="text-lg sm:text-xl font-bold text-center lg:text-right">
                    © {{ date('Y') }} Olegs Culicoks
                    <br>
                    <em>All rights reserved.</em>
                </h2>
            </div>
        </div>
    </div>
</footer>

