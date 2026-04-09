<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-serif text-3xl font-light text-gray-900 tracking-tight">
                {{ __('Ubah Data Penulis') }}
            </h2>
            <p class="mt-2 text-sm text-gray-500 max-w-2xl">
                Perbarui informasi penulis dalam database.
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                <div class="p-6">
                    <form method="POST" action="{{ route('authors.update', $author) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $author->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="biography" class="block text-sm font-medium text-gray-700">Biography</label>
                            <textarea name="biography" id="biography" rows="4" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('biography', $author->biography) }}</textarea>
                            @error('biography')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('authors.index') }}" class="mr-4 text-gray-600 hover:text-gray-900">Batal</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-2xl shadow-sm transition">
                                Perbarui Penulis
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>