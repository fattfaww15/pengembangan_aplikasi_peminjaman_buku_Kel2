<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Transaction Details') }}
            </h2>
            <a href="{{ route('transactions.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                Back to Transactions
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Transaction Information</h3>
                            <div class="space-y-3">
                                <div>
                                    <span class="font-medium">Transaction ID:</span> {{ $transaction->id }}
                                </div>
                                <div>
                                    <span class="font-medium">Status:</span>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ml-2
                                        @if($transaction->status === 'borrowed') bg-green-100 text-green-800
                                        @elseif($transaction->status === 'returned') bg-blue-100 text-blue-800
                                        @elseif($transaction->status === 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </div>
                                <div>
                                    <span class="font-medium">Borrowed At:</span> {{ $transaction->borrowed_at?->format('d M Y H:i') }}
                                </div>
                                <div>
                                    <span class="font-medium">Due At:</span> {{ $transaction->due_at?->format('d M Y') }}
                                </div>
                                @if($transaction->returned_at)
                                    <div>
                                        <span class="font-medium">Returned At:</span> {{ $transaction->returned_at?->format('d M Y H:i') }}
                                    </div>
                                @endif
                                @if($transaction->rejection_reason)
                                    <div>
                                        <span class="font-medium">Rejection Reason:</span> {{ $transaction->rejection_reason }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900 mb-4">User & Book Information</h3>
                            <div class="space-y-3">
                                <div>
                                    <span class="font-medium">User:</span> {{ $transaction->user->name }} ({{ $transaction->user->nis }})
                                </div>
                                <div>
                                    <span class="font-medium">Book:</span> {{ $transaction->book->title }}
                                </div>
                                <div>
                                    <span class="font-medium">Author:</span> {{ $transaction->book->author->name }}
                                </div>
                                <div>
                                    <span class="font-medium">Published Year:</span> {{ $transaction->book->published_year }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>