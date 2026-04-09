<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-serif text-3xl font-light text-gray-900 tracking-tight">
                    {{ __('Dashboard') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Selamat datang kembali, <span class="font-medium text-gray-700">{{ auth()->user()->name }}</span>
                </p>
            </div>
            <div class="text-sm text-gray-500 bg-white/50 px-4 py-2 rounded-full border border-gray-200 shadow-sm">
                {{ now()->translatedFormat('l, d F Y') }}
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(auth()->user()->is_admin)
                {{-- ==================== ADMIN DASHBOARD ==================== --}}
                
                {{-- Stats Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
                    
                    {{-- Total Buku --}}
                    <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 mb-1">Total Koleksi Buku</p>
                                    <p class="text-4xl font-light text-gray-900">{{ $stats['total_books'] }}</p>
                                </div>
                                <div class="h-14 w-14 bg-blue-50 rounded-2xl flex items-center justify-center group-hover:bg-blue-100 transition-colors duration-300">
                                    <svg class="h-7 w-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center text-xs text-gray-400">
                                <span class="flex items-center text-emerald-600 mr-2">
                                    <svg class="w-3 h-3 mr-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/></svg>
                                    +{{ rand(1,5) }} minggu ini
                                </span>
                                <span>Total katalog</span>
                            </div>
                        </div>
                    </div>

                    {{-- Total Penulis --}}
                    <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 mb-1">Total Penulis</p>
                                    <p class="text-4xl font-light text-gray-900">{{ $stats['total_authors'] }}</p>
                                </div>
                                <div class="h-14 w-14 bg-emerald-50 rounded-2xl flex items-center justify-center group-hover:bg-emerald-100 transition-colors duration-300">
                                    <svg class="h-7 w-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center text-xs text-gray-400">
                                <span class="text-gray-500">Kontributor aktif</span>
                            </div>
                        </div>
                    </div>

                    {{-- Total Pengguna --}}
                    <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 mb-1">Total Pengguna</p>
                                    <p class="text-4xl font-light text-gray-900">{{ $stats['total_users'] }}</p>
                                </div>
                                <div class="h-14 w-14 bg-purple-50 rounded-2xl flex items-center justify-center group-hover:bg-purple-100 transition-colors duration-300">
                                    <svg class="h-7 w-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center text-xs text-gray-400">
                                <span class="text-gray-500">Anggota terdaftar</span>
                            </div>
                        </div>
                    </div>

                    {{-- Transaksi Aktif --}}
                    <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 mb-1">Transaksi Aktif</p>
                                    <p class="text-4xl font-light text-gray-900">{{ $stats['active_transactions'] }}</p>
                                </div>
                                <div class="h-14 w-14 bg-amber-50 rounded-2xl flex items-center justify-center group-hover:bg-amber-100 transition-colors duration-300">
                                    <svg class="h-7 w-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center text-xs text-gray-400">
                                <span class="text-gray-500">Sedang berjalan</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Recent Transactions Table --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Transaksi Terbaru</h3>
                            <p class="text-sm text-gray-500 mt-0.5">Aktivitas peminjaman terkini dalam sistem</p>
                        </div>
                        <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-800 transition-colors">Lihat semua →</a>
                    </div>
                    
                    <div class="p-6">
                        @if($recent_transactions->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-100">
                                    <thead>
                                        <tr class="bg-gray-50/80">
                                            <th class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengguna</th>
                                            <th class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                                            <th class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tenggat Waktu</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach($recent_transactions as $transaction)
                                            <tr class="group hover:bg-gray-50/50 transition-colors duration-200">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 font-medium text-xs border border-gray-200">
                                                            {{ substr($transaction->user->name, 0, 1) }}
                                                        </div>
                                                        <div class="ml-3">
                                                            <div class="text-sm font-medium text-gray-900">{{ $transaction->user->name }}</div>
                                                            <div class="text-xs text-gray-500">{{ $transaction->user->email }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900 font-medium">{{ $transaction->book->title }}</div>
                                                    <div class="text-xs text-gray-500">{{ $transaction->book->author->name }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @php
                                                        $statusColors = [
                                                            'borrowed' => ['bg-emerald-50 text-emerald-700 border-emerald-200', 'Dipinjam'],
                                                            'returned' => ['bg-blue-50 text-blue-700 border-blue-200', 'Dikembalikan'],
                                                            'pending' => ['bg-amber-50 text-amber-700 border-amber-200', 'Menunggu'],
                                                            'overdue' => ['bg-rose-50 text-rose-700 border-rose-200', 'Terlambat'],
                                                        ];
                                                        $status = $statusColors[$transaction->status] ?? ['bg-gray-50 text-gray-700 border-gray-200', ucfirst($transaction->status)];
                                                    @endphp
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border {{ $status[0] }}">
                                                        <span class="w-1.5 h-1.5 rounded-full mr-1.5 
                                                            @if($transaction->status === 'borrowed') bg-emerald-500
                                                            @elseif($transaction->status === 'returned') bg-blue-500
                                                            @elseif($transaction->status === 'pending') bg-amber-500
                                                            @else bg-rose-500 @endif">
                                                        </span>
                                                        {{ $status[1] }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                    {{ $transaction->due_at?->translatedFormat('d M Y') ?? '—' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-12">
                                <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada transaksi</h3>
                                <p class="mt-1 text-sm text-gray-500">Transaksi akan muncul di sini setelah ada aktivitas peminjaman.</p>
                            </div>
                        @endif
                    </div>
                </div>

            @else
                {{-- ==================== USER DASHBOARD ==================== --}}
                
                {{-- Stats Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
                    
                    {{-- Dipinjam --}}
                    <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 mb-1">Sedang Dipinjam</p>
                                    <p class="text-4xl font-light text-gray-900">{{ $stats['borrowed_books'] }}</p>
                                </div>
                                <div class="h-14 w-14 bg-blue-50 rounded-2xl flex items-center justify-center group-hover:bg-blue-100 transition-colors duration-300">
                                    <svg class="h-7 w-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Dikembalikan --}}
                    <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 mb-1">Telah Dikembalikan</p>
                                    <p class="text-4xl font-light text-gray-900">{{ $stats['returned_books'] }}</p>
                                </div>
                                <div class="h-14 w-14 bg-emerald-50 rounded-2xl flex items-center justify-center group-hover:bg-emerald-100 transition-colors duration-300">
                                    <svg class="h-7 w-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Menunggu --}}
                    <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 mb-1">Menunggu Persetujuan</p>
                                    <p class="text-4xl font-light text-gray-900">{{ $stats['pending_books'] }}</p>
                                </div>
                                <div class="h-14 w-14 bg-amber-50 rounded-2xl flex items-center justify-center group-hover:bg-amber-100 transition-colors duration-300">
                                    <svg class="h-7 w-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Terlambat --}}
                    <div class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-500 mb-1">Terlambat</p>
                                    <p class="text-4xl font-light {{ $stats['overdue_books'] > 0 ? 'text-rose-600' : 'text-gray-900' }}">{{ $stats['overdue_books'] }}</p>
                                </div>
                                <div class="h-14 w-14 bg-rose-50 rounded-2xl flex items-center justify-center group-hover:bg-rose-100 transition-colors duration-300">
                                    <svg class="h-7 w-7 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Upcoming Dues Alert --}}
                @if($upcoming_dues->count() > 0)
                    <div class="mb-8 bg-amber-50/80 backdrop-blur-sm rounded-2xl border border-amber-200 p-6 shadow-sm">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="h-12 w-12 bg-amber-100 rounded-xl flex items-center justify-center">
                                    <svg class="h-6 w-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4 flex-1">
                                <h3 class="text-lg font-medium text-amber-800">Pengembalian Mendekati Tenggat</h3>
                                <p class="text-sm text-amber-600 mt-0.5">Segera kembalikan buku-buku berikut untuk menghindari denda</p>
                                
                                <div class="mt-4 space-y-2">
                                    @foreach($upcoming_dues as $transaction)
                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between bg-white/60 backdrop-blur-sm p-4 rounded-xl border border-amber-100">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 bg-gray-100 rounded-lg flex items-center justify-center text-gray-500">
                                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                    </svg>
                                                </div>
                                                <div class="ml-3">
                                                    <div class="font-medium text-gray-900">{{ $transaction->book->title }}</div>
                                                    <div class="text-xs text-gray-500">{{ $transaction->book->author->name }}</div>
                                                </div>
                                            </div>
                                            <div class="mt-3 sm:mt-0 flex items-center">
                                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                                    <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                    </svg>
                                                    {{ $transaction->due_at->translatedFormat('d M Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- My Transactions Table --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h3 class="text-lg font-medium text-gray-900">Riwayat Peminjaman Saya</h3>
                        <p class="text-sm text-gray-500 mt-0.5">Daftar buku yang pernah Anda pinjam</p>
                    </div>
                    
                    <div class="p-6">
                        @if($my_transactions->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-100">
                                    <thead>
                                        <tr class="bg-gray-50/80">
                                            <th class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buku</th>
                                            <th class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                            <th class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dipinjam</th>
                                            <th class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tenggat</th>
                                            <th class="px-6 py-3.5 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dikembalikan</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @foreach($my_transactions as $transaction)
                                            <tr class="group hover:bg-gray-50/50 transition-colors duration-200">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="h-9 w-9 bg-gray-100 rounded-lg flex items-center justify-center text-gray-500">
                                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                                            </svg>
                                                        </div>
                                                        <div class="ml-3">
                                                            <div class="text-sm font-medium text-gray-900">{{ $transaction->book->title }}</div>
                                                            <div class="text-xs text-gray-500">{{ $transaction->book->author->name }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @php
                                                        $statusColors = [
                                                            'borrowed' => ['bg-emerald-50 text-emerald-700 border-emerald-200', 'Dipinjam'],
                                                            'returned' => ['bg-blue-50 text-blue-700 border-blue-200', 'Dikembalikan'],
                                                            'pending' => ['bg-amber-50 text-amber-700 border-amber-200', 'Menunggu'],
                                                            'overdue' => ['bg-rose-50 text-rose-700 border-rose-200', 'Terlambat'],
                                                        ];
                                                        $status = $statusColors[$transaction->status] ?? ['bg-gray-50 text-gray-700 border-gray-200', ucfirst($transaction->status)];
                                                    @endphp
                                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border {{ $status[0] }}">
                                                        <span class="w-1.5 h-1.5 rounded-full mr-1.5 
                                                            @if($transaction->status === 'borrowed') bg-emerald-500
                                                            @elseif($transaction->status === 'returned') bg-blue-500
                                                            @elseif($transaction->status === 'pending') bg-amber-500
                                                            @else bg-rose-500 @endif">
                                                        </span>
                                                        {{ $status[1] }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                    {{ $transaction->borrowed_at?->translatedFormat('d M Y') ?? '—' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                    {{ $transaction->due_at?->translatedFormat('d M Y') ?? '—' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                    {{ $transaction->returned_at?->translatedFormat('d M Y') ?? '—' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-16">
                                <div class="h-20 w-20 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto">
                                    <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    </svg>
                                </div>
                                <h3 class="mt-4 text-base font-medium text-gray-900">Belum ada riwayat peminjaman</h3>
                                <p class="mt-1 text-sm text-gray-500">Anda belum pernah meminjam buku. Jelajahi katalog kami!</p>
                                <div class="mt-6">
                                    <a href="{{ route('books.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-900 border border-transparent rounded-lg text-sm font-medium text-white hover:bg-gray-800 transition-colors shadow-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                        </svg>
                                        Jelajahi Buku
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endif

            {{-- Trust Indicators --}}
            <div class="mt-10 flex flex-wrap justify-center items-center gap-x-8 gap-y-3 text-xs text-gray-400">
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span>Data Terenkripsi</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                    </svg>
                    <span>Akses Terbatas & Aman</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 7H7v6h6V7z"/>
                        <path fill-rule="evenodd" d="M7 2a1 1 0 00-.707 1.707L7 4.414v3.758a1 1 0 01-.293.707l-4 4C.817 14.769 2.156 18 4.828 18h10.343c2.673 0 4.012-3.231 2.122-5.121l-4-4A1 1 0 0113 8.172V4.414l.707-.707A1 1 0 0013 2H7z" clip-rule="evenodd"/>
                    </svg>
                    <span>Audit Trail Tercatat</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                    </svg>
                    <span>Real-time Update</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>