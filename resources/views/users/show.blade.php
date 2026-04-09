<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User Details') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('users.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Users
                </a>
                <a href="{{ route('users.edit', $user) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Ubah Pengguna
                </a>
                @if(!$user->is_admin && $user->id !== auth()->id())
                    <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                            Hapus Pengguna
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h3>
                        <div class="mt-4 grid grid-cols-2 gap-4">
                            <div>
                                <span class="font-medium">NIS:</span> {{ $user->nis }}
                            </div>
                            <div>
                                <span class="font-medium">Role:</span>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ml-2
                                    {{ $user->is_admin ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                    {{ $user->is_admin ? 'Administrator' : 'User' }}
                                </span>
                            </div>
                            <div>
                                <span class="font-medium">Status:</span>
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ml-2
                                    {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $user->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </div>
                            <div>
                                <span class="font-medium">Joined:</span> {{ $user->created_at?->format('d M Y') }}
                            </div>
                        </div>
                    </div>

                    <div class="border-t pt-6">
                        <h4 class="text-md font-medium text-gray-900 mb-4">Borrowing History</h4>
                        @if($user->transactions->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Book</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Borrowed</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Due</th>
                                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Returned</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($user->transactions->take(10) as $transaction)
                                            <tr>
                                                <td class="px-4 py-2 text-sm text-gray-900">{{ $transaction->book->title }}</td>
                                                <td class="px-4 py-2">
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                        @if($transaction->status === 'borrowed') bg-green-100 text-green-800
                                                        @elseif($transaction->status === 'returned') bg-blue-100 text-blue-800
                                                        @elseif($transaction->status === 'pending') bg-yellow-100 text-yellow-800
                                                        @else bg-red-100 text-red-800 @endif">
                                                        {{ ucfirst($transaction->status) }}
                                                    </span>
                                                </td>
                                                <td class="px-4 py-2 text-sm text-gray-900">{{ $transaction->borrowed_at?->format('d M Y') }}</td>
                                                <td class="px-4 py-2 text-sm text-gray-900">{{ $transaction->due_at?->format('d M Y') }}</td>
                                                <td class="px-4 py-2 text-sm text-gray-900">{{ $transaction->returned_at?->format('d M Y') ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @if($user->transactions->count() > 10)
                                <p class="text-sm text-gray-600 mt-2">Showing last 10 transactions. Total: {{ $user->transactions->count() }}</p>
                            @endif
                        @else
                            <p class="text-gray-500">Tidak ada riwayat peminjaman ditemukan.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>