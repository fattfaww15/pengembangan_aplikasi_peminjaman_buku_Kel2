<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-serif text-3xl font-light text-gray-900 tracking-tight">
                    {{ __('Detail Buku') }}
                </h2>
                <p class="mt-2 text-sm text-gray-500 max-w-2xl">
                    Informasi lengkap mengenai buku.
                </p>
            </div>
            <a href="{{ route('books.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-2xl shadow-sm transition">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $book->title }}</h3>
                        <p class="text-lg text-gray-600">by {{ $book->author->name }}</p>
                        <div class="mt-4 grid grid-cols-2 gap-4">
                            <div>
                                <span class="font-medium">Published Year:</span> {{ $book->published_year }}
                            </div>
                            <div>
                                <span class="font-medium">Stock:</span> {{ $book->stock }}
                            </div>
                        </div>
                        @if($book->description)
                            <div class="mt-4">
                                <span class="font-medium">Description:</span>
                                <p class="mt-2 text-gray-700">{{ $book->description }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>