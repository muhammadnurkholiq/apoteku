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
                                            <p class="text-gray-700">Price:
                                                Rp. {{ number_format($item->product->price, 2) }}</p>
                                        </div>
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700">
                                                Remove
                                            </button>
                                        </form>
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

                        <form action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf


                            <div class="mb-4">
                                <label for="address" class="block text-gray-700 font-semibold mb-2">Address:</label>
                                <input type="text" name="address" id="address"
                                    class="border border-gray-300 rounded-lg p-2 w-full" placeholder="enter adress"
                                    required>
                            </div>

                            <input type="number" name="total_amount" id="total_amount"
                                class="border border-gray-300 rounded-lg p-2 w-full" value="{{ old('name', $total) }}"
                                placeholder="enter adress" required>

                            <div class="mb-4">
                                <label for="city" class="block text-gray-700 font-semibold mb-2">City:</label>
                                <input type="text" name="city" id="city"
                                    class="border border-gray-300 rounded-lg p-2 w-full" placeholder="enter city"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label for="post_code" class="block text-gray-700 font-semibold mb-2">Post Code:</label>
                                <input type="text" name="post_code" id="post_code"
                                    class="border border-gray-300 rounded-lg p-2 w-full" placeholder="enter post code"
                                    required>
                            </div>

                            <div class="mb-4">
                                <label for="phone_number" class="block text-gray-700 font-semibold mb-2">Phone
                                    Number:</label>
                                <input type="tel" name="phone_number" id="phone_number"
                                    class="border border-gray-300 rounded-lg p-2 w-full"
                                    placeholder="enter phone number" required>
                            </div>

                            <div class="mb-4">
                                <label for="notes" class="block text-gray-700 font-semibold mb-2">Notes:</label>
                                <textarea name="notes" id="notes" class="border border-gray-300 rounded-lg p-2 w-full" rows="3"
                                    placeholder="enter notes"></textarea>
                            </div>

                            <div class="mb-4">
                                <label for="proof" class="block text-gray-700 font-semibold mb-2">Upload Payment
                                    Proof:</label>
                                <input type="file" name="proof" id="proof"
                                    class="border border-gray-300 rounded-lg p-2 w-full" required>
                            </div>

                            <button type="submit"
                                class="w-full py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                                Submit Payment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
