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
                        <label class="block text-gray-700 dark:text-gray-200">Type (salle / matériel):</label>
                        <div class="flex items-center space-x-4">
                            <label for="type" class="flex items-center">
                                <input type="checkbox" id="type_salle" name="type[]" value="Salle" class="mr-2">Salle
                            </label>
                            <label class="flex items-center">
                                <input type="checkbox" id="type_materiel" name="type[]" value="Matériel" class="mr-2">Matériel
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200" for="besoin">Description du besoin :</label>
                        <textarea name="besoin" id="besoin" class="border rounded w-full p-2 bg-gray-50 dark:bg-gray-700 dark:text-gray-200" rows="3" placeholder="Projecteur, Ordinateur..."></textarea><br><br>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-200" for="classe">Classe concernée :</label>
                        <input type="text" name="classe" class="border rounded w-full p-2 bg-gray-50 dark:bg-gray-700 dark:text-gray-200" required placeholder="GL">
                    </div>

                    <div class="mb-4">
                        <label for="time">Durée du cours</label>
                        <input type="number" name="time" id="time" min="1"  required>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-3 hover:bg-blue-700" >Soumettre la demande</button>
                    </div>
                    <br>
                    <a href="{{ route('demandes.index') }}" class="text-blue-500 hover:underline">Voir mes demandes</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeSalle = document.getElementById('type_salle');
            const typeMateriel = document.getElementById('type_materiel');
            const besoin = document.getElementById('besoin');

            function updateStateBesoin() {
                if (typeSalle.checked && !typeMateriel.checked) {
                    //seulement salle
                    besoin.value = "Rien à préciser";
                    besoin.readOnly = true;
                    besoin.classList.add('bg-gray-200');
                } else if (typeMateriel.checked) {
                    //materiem ou les deux
                    besoin.readOnly = false;
                    besoin.classList.remove('bg-gray-200');
                    if (besoin.value === "Rien à préciser") 
                        besoin.value = "";
                        besoin.placeholder = "Ex : Projecteur, Ordinateur...";
                } else {
                    //aucune coché
                    besoin.value ="";
                    besoin.readOnly = true;
                    besoin.classList.add('bg-gray-200');
                    besoin.placeholder = "Veuillez choisir un type";
                }
            }

            //initialisation de letat au chargement
            typeSalle.addEventListener('change', updateStateBesoin);
            typeMateriel.addEventListener('change', updateStateBesoin);
        });
    </script>
</x-app-layout>
