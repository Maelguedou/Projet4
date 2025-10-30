<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Créer une demande
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded shadow">
                <form action="{{ route('demandes.store') }}" method="post">
                    @csrf

                    <label for="type">Type (salle / matériel):</label>
                    <input type="text" name="type" class="border rounded w-full" required><br><br>

                    <label for="besoin">Besoin :</label>
                    <textarea name="besoin" class="border rounded w-full" required></textarea><br><br>

                    <label for="classe">Classe concernée :</label>
                    <input type="text" name="classe" class="border rounded w-full" required><br><br>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-3" >Soumettre</button>

                    <br>
                    <a href="{{ route('demandes.index') }}">Voir mes demandes</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
