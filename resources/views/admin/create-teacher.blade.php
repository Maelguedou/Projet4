<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Créer un Enseignant') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-lg mx-auto">
        <form method="POST" action="{{ route('admin.store-teacher') }}">
            @csrf
            <div>
                <x-input-label for="name" value="Nom complet" />
                <x-text-input id="name" name="name" type="text" required autofocus />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <div class="mt-4">
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" name="email" type="email" required />
                <x-input-error :messages="$errors->get('email')" />
            </div>

            <div class="mt-4">
                <x-input-label for="matricule" value="Matricule" />
                <x-text-input id="matricule" name="matricule" type="text" required />
                <x-input-error :messages="$errors->get('matricule')" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" value="Mot de passe" />
                <x-text-input id="password" name="password" type="password" required />
                <x-input-error :messages="$errors->get('password')" />
            </div>

            <div class="mt-4">
                <x-input-label for="password_confirmation" value="Confirmer le mot de passe" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" required />
            </div>

            <div class="mt-4">
                <x-primary-button>
                    {{ __('Créer Enseignant') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
