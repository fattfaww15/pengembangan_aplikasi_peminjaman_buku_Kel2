<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-serif text-3xl font-light text-gray-900 tracking-tight">
                {{ __('Pengaturan Profil') }}
            </h2>
            <p class="mt-2 text-sm text-gray-500 max-w-2xl">
                Kelola informasi akun, ubah password, dan pengaturan keamanan lainnya.
            </p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
