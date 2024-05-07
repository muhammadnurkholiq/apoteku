<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight my-2">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container mx-auto p-6">
                    <h1 class="text-2xl font-bold mb-4">Product List</h1>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        @foreach ($products as $product)
                            <div class="border p-4 rounded">
                                <img src="{{ asset('/storage/products/' . $product->photo) }}" alt="{{ $product->name }}"
                                    class="w-full h-48 object-cover rounded">
                                <h2 class="text-xl font-semibold mt-2">{{ $product->name }}</h2>
                                <p class="text-gray-700">{{ Str::limit($product->about, 100) }}</p>
                                <p class="mt-2 font-bold">Price: Rp. {{ number_format($product->price, 2) }}</p>

                                @unless (auth()->user()->hasRole('owner'))
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="mt-4 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">
                                            Add to Cart
                                        </button>
                                    </form>
                                @endunless
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
