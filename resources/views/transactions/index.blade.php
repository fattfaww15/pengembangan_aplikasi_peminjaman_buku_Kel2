<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">
            <div>
                <h2 class="font-serif text-3xl font-light text-gray-900 tracking-tight">
                    {{ __('Riwayat Peminjaman') }}
                </h2>
                <p class="mt-2 text-sm text-gray-500 max-w-2xl">
                    Pantau semua transaksi peminjaman dan pengembalian buku.
                </p>
            </div>
            @if(!auth()->user()->is_admin)
                <a href="{{ route('transactions.create') }}" class="inline-flex items-center justify-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-2xl shadow-sm transition">
                    Pinjam Buku
                </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                <div class="p-6">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Book</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Borrowed At</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Due At</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($transactions as $transaction)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $transaction->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $transaction->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $transaction->book->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                @if($transaction->status === 'borrowed') bg-green-100 text-green-800
                                                @elseif($transaction->status === 'returned') bg-blue-100 text-blue-800
                                                @elseif($transaction->status === 'pending') bg-yellow-100 text-yellow-800
                                                @else bg-red-100 text-red-800 @endif">
                                                {{ ucfirst($transaction->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $transaction->borrowed_at?->format('d M Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $transaction->due_at?->format('d M Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('transactions.show', $transaction) }}" class="text-blue-600 hover:text-blue-900 mr-3">Lihat</a>

                                            @if(auth()->user()->is_admin)
                                                <!-- Admin Actions -->
                                                @if($transaction->status === 'pending')
                                                    <form method="POST" action="{{ route('transactions.update', $transaction) }}" class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="approved">
                                                        <button type="submit" class="text-green-600 hover:text-green-900 mr-3">Approve</button>
                                                    </form>
                                                    <form method="POST" action="{{ route('transactions.update', $transaction) }}" class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="rejected">
                                                        <label for="rejection_reason_{{ $transaction->id }}" class="sr-only">Rejection Reason</label>
                                                        <input type="text" id="rejection_reason_{{ $transaction->id }}" name="rejection_reason" placeholder="Reason" class="mr-2 px-2 py-1 text-xs border rounded">
                                                        <button type="submit" class="text-red-600 hover:text-red-900 mr-3">Reject</button>
                                                    </form>
                                                @elseif($transaction->status === 'borrowed')
                                                    <form method="POST" action="{{ route('transactions.update', $transaction) }}" class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="return_book" value="1">
                                                        <button type="submit" class="text-green-600 hover:text-green-900 mr-3" onclick="return confirm('Mark as returned?')">Return</button>
                                                    </form>
                                                @endif
                                            @else
                                                <!-- User Actions -->
                                                @if($transaction->status === 'borrowed' && $transaction->user_id === auth()->id())
                                                    <form method="POST" action="{{ route('transactions.update', $transaction) }}" class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="return_book" value="1">
                                                        <button type="submit" class="text-green-600 hover:text-green-900 mr-3" onclick="return confirm('Return this book?')">Return</button>
                                                    </form>
                                                @elseif($transaction->status === 'pending' && $transaction->user_id === auth()->id())
                                                    <form method="POST" action="{{ route('transactions.destroy', $transaction) }}" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Cancel this borrow request?')">Cancel</button>
                                                    </form>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tidak ada transaksi ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>