<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Category') }}
        </h2>
        <a href="{{ route('admin.categories.index') }}"
            class="text-blue-700 outline-blue-700 hover:bg-blue-800 hover:text-white font-bold py-2 px-4 rounded outline outline-2 hover:outline-none">
            Back
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                            <input type="text" name="name" id="name"
                                class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                value="{{ old('name', $category->name) }}" placeholder="Enter name">
                            @error('name')
                                <div class="alert alert-danger text-red-500 mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div x-data="{ open: false }" class="text-center">
                            <button @click="open = true" type="button"
                                class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline cursor-pointer">
                                Submit
                            </button>

                            <!-- Modal -->
                            <div x-show="open" class="fixed z-10 inset-0 overflow-y-auto" style="display:none;">
                                <div class="flex items-center justify-center min-h-screen">
                                    <div class="fixed inset-0 bg-black opacity-50"></div>
                                    <div @click.away="open = false" class="relative z-20 bg-white rounded-lg p-8">
                                        <div class="text-center">
                                            <p>Are you sure you want to update this category?</p>
                                        </div>
                                        <div class="mt-6 flex justify-center">
                                            <button type="submit"
                                                class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Yes,
                                                Update</button>
                                            <button @click="open = false" type="button"
                                                class="ml-4 text-blue-700 outline-blue-700  font-bold py-2 px-4 rounded outline outline-1 cursor-pointer">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
