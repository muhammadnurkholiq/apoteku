<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight box">
            {{ __('products') }}
        </h2>
        <a href="{{ route('admin.products.create') }}"
            class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Add Product
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="w-1/6 px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No</th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Name</th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Price</th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Category</th>
                                <th scope="col"
                                    class="w-1/6 px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($products as $index => $product)
                                <tr>
                                    <td class="w-1/6 px-6 py-4 text-center whitespace-nowrap ">
                                        {{ ($products->currentPage() - 1) * $products->perPage() + $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 text-left whitespace-nowrap flex flex-row items-center">
                                        <img src="{{ asset('/storage/products/' . $product->photo) }}"
                                            alt="{{ $product->name }}" class="w-20 rounded object-cover mr-4">

                                        <span class="text-center">{{ $product->name }}</span>
                                    </td>
                                    <td class="w-1/6 px-6 py-4 text-center whitespace-nowrap ">
                                        Rp. {{ number_format($product->price, 2) }}
                                    </td>
                                    <td class="w-1/6 px-6 py-4 text-center whitespace-nowrap ">
                                        {{ $product->category->name }}
                                    </td>
                                    <td class="w-1/6 px-6 py-4 text-center whitespace-nowrap">
                                        <div x-data="{ open: false }">
                                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                                class="bg-green-600 hover:bg-green-700 text-white py-1.5 px-3 rounded focus:outline-none focus:shadow-outline">Edit</a>
                                            <button @click="open = true"
                                                class="bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded focus:outline-none focus:shadow-outline">
                                                Delete
                                            </button>

                                            <!-- Modal -->
                                            <div x-show="open" class="fixed z-10 inset-0 overflow-y-auto"
                                                style="display:none;">
                                                <div class="flex items-center justify-center min-h-screen">
                                                    <div class="fixed inset-0 bg-black opacity-50"></div>
                                                    <div @click.away="open = false"
                                                        class="relative z-20 bg-white rounded-lg p-8">
                                                        <div class="text-center">
                                                            <p>Are you sure you want to delete this product?</p>
                                                        </div>
                                                        <div class="mt-6 flex justify-center">
                                                            <form
                                                                action="{{ route('admin.products.destroy', $product->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="bg-red-600 hover:bg-red-700 text-white py-1 px-3 rounded focus:outline-none focus:shadow-outline">
                                                                    Yes, Delete
                                                                </button>

                                                            </form>
                                                            <button @click="open = false" type="button"
                                                                class="ml-4 bg-blue-600 hover:bg-blue-700 text-white py-1 px-3 rounded focus:outline-none focus:shadow-outline">
                                                                Cancel
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-4 flex justify-between items-center">
                        <div class="flex-1 ">
                            {{ $products->links('pagination::tailwind') }}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


</x-app-layout>
