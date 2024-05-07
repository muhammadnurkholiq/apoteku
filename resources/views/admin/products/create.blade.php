<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Product') }}
        </h2>
        <a href="{{ route('admin.products.index') }}"
            class="text-blue-700 outline-blue-700 hover:bg-blue-800 hover:text-white font-bold py-2 px-4 rounded outline outline-2 hover:outline-none">
            Back
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                            <input type="text" name="name" id="name"
                                class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('name')
                                <div class="alert alert-danger text-red-500 mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
                            <input type="number" name="price" id="price"
                                class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('price')
                                <div class="alert alert-danger text-red-500 mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="about" class="block text-gray-700 text-sm font-bold mb-2">About:</label>
                            <textarea name="about" id="about"
                                class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                            @error('about')
                                <div class="alert alert-danger text-red-500 mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="category_id"
                                class="block text-gray-700 text-sm font-bold mb-2">Category:</label>
                            <select name="category_id" id="category_id"
                                class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                <option value="">Choose Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                                @error('category_id')
                                    <div class="alert alert-danger text-red-500 mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="photo" class="block text-gray-700 text-sm font-bold mb-2">Photo:</label>
                            <input type="file" name="photo" id="photo"
                                class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @error('photo')
                                <div class="alert alert-danger text-red-500 mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="flex items-center justify-center">
                            <button type="submit"
                                class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
