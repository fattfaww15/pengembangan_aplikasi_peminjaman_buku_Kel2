<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-serif text-3xl font-light text-gray-900 tracking-tight">
                {{ __('Pinjam Buku') }}
            </h2>
            <p class="mt-2 text-sm text-gray-500 max-w-2xl">
                Ajukan permintaan peminjaman buku dari koleksi perpustakaan.
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                <div class="p-6">
                    <form method="POST" action="{{ route('transactions.store') }}">
                        @csrf

                        <!-- Book Selection with Search -->
                        <div class="mb-4">
                            <label for="book_search" class="block text-sm font-medium text-gray-700 mb-2">Pilih Buku</label>
                            <div class="relative" x-data="bookSearch()">
                                <input 
                                    type="text" 
                                    id="book_search" 
                                    x-model="searchQuery"
                                    @input="filterBooks()"
                                    @focus="open = true"
                                    @keydown.escape="open = false"
                                    @keydown.down="highlightedIndex = Math.min(highlightedIndex + 1, filteredBooks.length - 1)"
                                    @keydown.up="highlightedIndex = Math.max(highlightedIndex - 1, 0)"
                                    @keydown.enter="selectBook(filteredBooks[highlightedIndex])"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                    placeholder="Cari berdasarkan nama buku atau penulis..."
                                    autocomplete="off"
                                >
                                <div 
                                    x-show="open && filteredBooks.length > 0" 
                                    class="absolute top-full left-0 right-0 mt-1 bg-white border border-gray-300 rounded-lg shadow-lg z-10 max-h-64 overflow-y-auto"
                                >
                                    <template x-for="(book, index) in filteredBooks" :key="book.id">
                                        <div 
                                            @click="selectBook(book)"
                                            :class="{ 'bg-blue-50': index === highlightedIndex, 'bg-white': index !== highlightedIndex }"
                                            class="px-4 py-3 cursor-pointer hover:bg-blue-50 border-b border-gray-100 last:border-b-0 transition"
                                        >
                                            <div class="font-medium text-gray-900" x-text="book.title"></div>
                                            <div class="text-sm text-gray-600">
                                                <span x-text="`Penulis: ${book.author_name}`"></span>
                                                <span x-text="`| Stok: ${book.stock}`"></span>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                
                                <!-- Hidden input to store selected book ID -->
                                <input type="hidden" name="book_id" id="book_id" :value="selectedBook?.id" required>
                                
                                <!-- Selected Book Display -->
                                <div x-show="selectedBook" class="mt-3 p-3 bg-green-50 border border-green-200 rounded-lg">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <div class="font-medium text-gray-900" x-text="selectedBook?.title"></div>
                                            <div class="text-sm text-gray-600">
                                                <span x-text="`Penulis: ${selectedBook?.author_name}`"></span>
                                                <span x-text="`| Stok Tersedia: ${selectedBook?.stock}`"></span>
                                            </div>
                                        </div>
                                        <button 
                                            type="button"
                                            @click="selectedBook = null; searchQuery = ''"
                                            class="text-red-600 hover:text-red-800 font-medium text-sm"
                                        >
                                            Ubah
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @error('book_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Borrowing Date -->
                        <div class="mb-4">
                            <label for="borrowed_at" class="block text-sm font-medium text-gray-700">Tanggal Peminjaman</label>
                            <input 
                                type="date" 
                                name="borrowed_at" 
                                id="borrowed_at" 
                                value="{{ old('borrowed_at', date('Y-m-d')) }}" 
                                max="{{ date('Y-m-d') }}"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" 
                                required
                            >
                            @error('borrowed_at')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Due Date -->
                        <div class="mb-4">
                            <label for="due_at" class="block text-sm font-medium text-gray-700">Tanggal Jatuh Tempo</label>
                            <input type="date" name="due_at" id="due_at" value="{{ old('due_at') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                            @error('due_at')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('transactions.index') }}" class="mr-4 text-gray-600 hover:text-gray-900">Batal</a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-2xl shadow-sm transition">
                                Kirim Permintaan Peminjaman
                            </button>
                        </div>

                        <div class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        Permintaan peminjaman Anda akan dikirim sebagai "Menunggu" dan memerlukan persetujuan admin sebelum buku dapat dipinjam.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @php
        $booksData = $books->map(function ($book) {
            return [
                'id' => $book->id,
                'title' => $book->title,
                'author_name' => $book->author->name,
                'stock' => $book->stock,
                'search_text' => strtolower($book->title . ' ' . $book->author->name),
            ];
        })->toArray();
    @endphp

    <script>
        function bookSearch() {
            const booksData = @json($booksData);

            return {
                searchQuery: '',
                open: false,
                highlightedIndex: -1,
                selectedBook: null,
                allBooks: booksData,
                filteredBooks: [],

                filterBooks() {
                    const query = this.searchQuery.toLowerCase().trim();

                    if (!query) {
                        this.filteredBooks = this.allBooks;
                    } else {
                        this.filteredBooks = this.allBooks.filter(book =>
                            book.search_text.includes(query)
                        );
                    }

                    this.highlightedIndex = -1;
                    this.open = true;
                },

                selectBook(book) {
                    if (!book) return;

                    this.selectedBook = book;
                    this.searchQuery = '';
                    this.open = false;
                    this.filteredBooks = [];
                    this.highlightedIndex = -1;

                    // Update the hidden input
                    document.getElementById('book_id').value = book.id;
                }
            }
        }
    </script>
</x-app-layout>