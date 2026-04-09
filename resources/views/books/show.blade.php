<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Book Details') }}
            </h2>
            <a href="{{ route('books.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Books
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
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