<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight my-2">
            {{ __('Cart') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2">
                        @if ($cartItems->count() > 0)
                            <ul>
                                @foreach ($cartItems as $item)
                                    <li class="mb-4 flex">
                                        <div class="w-16 h-16 bg-gray-200 rounded-md mr-4">
                                            <img src="{{ asset('/storage/products/' . $item->product->photo) }}"
                                                alt="{{ $item->product->name }}"
                                                class="w-full h-full object-cover rounded">
                                        </div>
                                        <div>
                                            <h2 class="font-semibold">{{ $item->product->name }}</h2>
                                            <p class="text-gray-700">Price: Rp.
                                                {{ number_format($item->product->price, 2) }}</p>

                                            <!-- Tombol Hapus -->
                                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700">
                                                    Remove
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>Your cart is empty.</p>
                        @endif
                    </div>

                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold mb-4">Payment Details</h3>

                        <div class="flex justify-between mb-2">
                            <p>Sub Total:</p>
                            <p>Rp. {{ number_format($subTotal, 2) }}</p>
                        </div>

                        <div class="flex justify-between mb-2">
                            <p>PPN 11%:</p>
                            <p>Rp. {{ number_format($ppn, 2) }}</p>
                        </div>

                        <div class="flex justify-between mb-2">
                            <p>Delivery Fee:</p>
                            <p>Rp. {{ number_format($deliveryFee, 2) }}</p>
                        </div>

                        <div class="flex justify-between font-bold mb-4">
                            <p>Total:</p>
                            <p>Rp. {{ number_format($total, 2) }}</p>
                        </div>


                        <h3 class="text-lg font-semibold mb-2">Payment Form</h3>
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label for="paymentProof" class="block text-gray-700 font-semibold mb-2">Upload Payment
                                    Proof:</label>
                                <input type="file" name="paymentProof" id="paymentProof"
                                    class="border border-gray-300 rounded-lg p-2 w-full" required>
                            </div>
                            <button type="submit"
                                class="w-full py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                Pay Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
