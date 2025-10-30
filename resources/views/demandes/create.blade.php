<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Créer une demande
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-6">
                <form action="{{ route('demandes.store') }}" method="post">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200" for="type">Type (salle / matériel):</label>
                        <input type="text" name="type" class="border rounded w-full p-2" required><br><br>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200" for="besoin">Description du besoin :</label>
                        <textarea name="besoin" class="border rounded w-full p-2" rows="3" required></textarea><br><br>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200" for="classe">Classe concernée :</label>
                        <input type="text" name="classe" class="border rounded w-full p-2" required><br><br>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-3 hover:bg-blue-700" >Soumettre la demande</button>
                    </div>
                    <br>
                    <a href="{{ route('demandes.index') }}">Voir mes demandes</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
