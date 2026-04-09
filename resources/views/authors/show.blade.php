<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-serif text-3xl font-light text-gray-900 tracking-tight">
                    {{ __('Detail Penulis') }}
                </h2>
                <p class="mt-2 text-sm text-gray-500 max-w-2xl">
                    Informasi penulis dan daftar karya-karya mereka.
                </p>
            </div>
            <a href="{{ route('authors.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-2xl shadow-sm transition">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-900">{{ $author->name }}</h3>
                        @if($author->biography)
                            <p class="mt-2 text-gray-600">{{ $author->biography }}</p>
                        @endif
                    </div>

                    <div class="border-t pt-6">
                        <h4 class="text-md font-medium text-gray-900 mb-4">Books by this Author</h4>
                        @if($author->books->count() > 0)
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                @foreach($author->books as $book)
                                    <div class="border rounded-lg p-4">
                                        <h5 class="font-medium">{{ $book->title }}</h5>
                                        <p class="text-sm text-gray-600">Published: {{ $book->published_year }}</p>
                                        <p class="text-sm text-gray-600">Stock: {{ $book->stock }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">No books found for this author.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>