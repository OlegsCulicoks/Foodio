<section class="bg-gray-200 py-20">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8">Send us an <span class="text-yellow-400">e-mail</span></h2>
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Error!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
        <form action="{{ route('send.email') }}" method="POST" class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Your Name</label>
                <input type="text" id="name" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('name') border-red-500 @enderror" value="{{ old('name') }}">
                @error('name')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Your Email</label>
                <input type="email" id="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                @error('email')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="message" class="block text-gray-700 text-sm font-bold mb-2">Your Message</label>
                <textarea id="message" name="message" rows="4" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400 @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                @error('message')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="w-full bg-yellow-400 text-white px-4 py-2 rounded hover:bg-white hover:text-yellow-400 border border-yellow-400 transition duration-300">Send</button>
        </form>
    </div>
</section>

