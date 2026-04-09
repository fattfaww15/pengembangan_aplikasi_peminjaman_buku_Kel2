<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-serif text-3xl font-light text-gray-900 tracking-tight">
                    {{ __('Penulis') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">Kelola daftar penulis dan kontributor konten</p>
            </div>
            <a href="{{ route('authors.create') }}" class="inline-flex items-center px-6 py-3 bg-gray-900 border border-transparent rounded-md font-medium text-sm text-white hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 transition-all duration-200 shadow-sm">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Penulis Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Success Notification --}}
            @if(session('success'))
                <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-md shadow-sm">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-emerald-800">{{ session('success') }}</p>
                        </div>
                        <div class="ml-auto pl-3">
                            <button @click="show = false" class="text-emerald-500 hover:text-emerald-600">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Main Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                
                {{-- Table Container --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead>
                            <tr class="bg-gray-50/80">
                                <th scope="col" class="px-8 py-5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-16">ID</th>
                                <th scope="col" class="px-8 py-5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Penulis</th>
                                <th scope="col" class="px-8 py-5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Biografi Singkat</th>
                                <th scope="col" class="px-8 py-5 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($authors as $author)
                                <tr class="group hover:bg-gray-50/50 transition-colors duration-200">
                                    <td class="px-8 py-6 whitespace-nowrap text-sm font-mono text-gray-500">
                                        #{{ str_pad($author->id, 4, '0', STR_PAD_LEFT) }}
                                    </td>
                                    
                                    <td class="px-8 py-6 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 font-medium border border-gray-200">
                                                {{ substr($author->name, 0, 1) }}
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">{{ $author->name }}</div>
                                                <div class="text-xs text-gray-500">{{ $author->books_count ?? 0 }} karya</div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="px-8 py-6">
                                        <p class="text-sm text-gray-600 line-clamp-2 leading-relaxed">
                                            {{ $author->biography ? Str::limit($author->biography, 80) : '—' }}
                                        </p>
                                    </td>
                                    
                                    <td class="px-8 py-6 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex items-center justify-end space-x-1">
                                            {{-- View --}}
                                            <a href="{{ route('authors.show', $author) }}" class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-150" title="Lihat Detail">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </a>
                                            
                                            {{-- Edit --}}
                                            <a href="{{ route('authors.edit', $author) }}" class="p-2 text-gray-500 hover:text-amber-600 hover:bg-amber-50 rounded-lg transition-colors duration-150" title="Ubah Data">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                            </a>
                                            
                                            {{-- Delete --}}
                                            <form method="POST" action="{{ route('authors.destroy', $author) }}" class="inline-flex">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" onclick="return confirm('Anda yakin ingin menghapus penulis \'{{ $author->name }}\'? Tindakan ini tidak dapat dibatalkan.')" class="p-2 text-gray-500 hover:text-rose-600 hover:bg-rose-50 rounded-lg transition-colors duration-150" title="Hapus Permanen">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-16 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-12 h-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                                            <h3 class="text-lg font-medium text-gray-900">Belum ada penulis</h3>
                                            <p class="mt-1 text-sm text-gray-500">Mulai dengan menambahkan penulis baru ke dalam koleksi.</p>
                                            <div class="mt-6">
                                                <a href="{{ route('authors.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800">
                                                    Tambah Penulis Pertama
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                {{-- Footer dengan Pagination --}}
                @if($authors->hasPages())
                    <div class="border-t border-gray-100 px-8 py-5 bg-gray-50/30">
                        {{ $authors->links() }}
                    </div>
                @endif
            </div>
            
            {{-- Indikator Kepercayaan (Trust Badge) --}}
            <div class="mt-8 flex justify-center items-center space-x-6 text-xs text-gray-400">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    <span>Data Terenkripsi</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/></svg>
                    <span>Akses Terbatas</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path d="M13 7H7v6h6V7z"/><path fill-rule="evenodd" d="M7 2a1 1 0 00-.707 1.707L7 4.414v3.758a1 1 0 01-.293.707l-4 4C.817 14.769 2.156 18 4.828 18h10.343c2.673 0 4.012-3.231 2.122-5.121l-4-4A1 1 0 0113 8.172V4.414l.707-.707A1 1 0 0013 2H7z" clip-rule="evenodd"/></svg>
                    <span>Audit Trail Aktif</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>