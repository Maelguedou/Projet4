<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Créer une demande
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-xl p-6 sm:p-8 transition-all duration-200 transform hover:shadow-xl animate-scale-fade-in">
                <form action="{{ route('demandes.store') }}" id="form-demande" method="post" class="space-y-6">
                    @csrf

                    <div class="mb-8 animate-fade-in-up" style="animation-delay: 0.1s">
                        <label class="block text-gray-700 dark:text-gray-200 text-lg font-semibold mb-3">Type de demande</label>
                        <div class="flex flex-wrap items-center gap-6 mt-2">
                            <label class="group inline-flex items-center text-sm cursor-pointer p-4 bg-gray-50 rounded-lg border-2 border-transparent hover:border-green-200 transition-all duration-200">
                                <input type="radio" id="type_salle" name="type[]" value="Salle" class="h-5 w-5 text-green-600 border-gray-300 rounded focus:ring-green-500 transition-colors">
                                <span class="ml-3 font-medium group-hover:text-green-600 transition-colors">Salle</span>
                            </label>
                            <label class="group inline-flex items-center text-sm cursor-pointer p-4 bg-gray-50 rounded-lg border-2 border-transparent hover:border-green-200 transition-all duration-200">
                                <input type="radio" id="type_materiel" name="type[]" value="Materiel" class="h-5 w-5 text-green-600 border-gray-300 rounded focus:ring-sky-500 transition-colors">
                                <span class="ml-3 font-medium group-hover:text-green-600 transition-colors">Matériel</span>
                            </label>
                        </div>
                    </div>

            <div id="besoins-sections"
                class="mb-8 opacity-0 hidden transform scale-95 transition-all duration-300 ease-out animate-fade-in-up"
                style="animation-delay: 0.2s">
                <label class="block text-gray-700 dark:text-gray-200 text-lg font-semibold mb-3">
                    Matériel nécessaire
                </label>

                <label class="flex items-center space-x-3">
                    <input type="checkbox" name="materiels[]" value="Projecteur" id="projecteur" class="text-green-600 focus:ring-green-500 border-gray-300 rounded">
                    <span class="text-gray-700 dark:text-gray-200">Projecteur</span>
                </label>

                <label class="flex items-center space-x-3">
                    <input type="checkbox" name="materiels[]" value="Ordinateur" id="ordinateur" class="text-green-600 focus:ring-green-500 border-gray-300 rounded">
                    <span class="text-gray-700 dark:text-gray-200">Ordinateur</span>
                </label>

                <label class="flex items-center space-x-3">
                    <input type="checkbox" name="materiels[]" value="Haut-parleur" id="haut_parleur" class="text-green-600 focus:ring-green-500 border-gray-300 rounded">
                    <span class="text-gray-700 dark:text-gray-200">Haut-parleur</span>
                </label>

                <label class="flex items-center space-x-3">
                    <input type="checkbox" name="materiels[]" value="Autre" id="autre" class="text-green-600 focus:ring-green-500 border-gray-300 rounded">
                    <span class="text-gray-700 dark:text-gray-200">Autre matériel</span>
                </label>

                <!-- Champ texte pour "autre" -->
                <input type="text" name="autre_materiel" id="autre_materiel" class="hidden" placeholder="Précisez le matériel">


                    <!-- Section "Autre" qui s'affiche uniquement si cochée -->
                    <div id="autre-section"
                        class="mt-4 opacity-0 hidden transform -translate-y-2 transition-all duration-300 ease-out">
                        <label for="autre_materiel"
                            class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">
                            Précisez le matériel nécessaire
                        </label>
                        <input type="text" name="autre_materiel" id="autre_materiel"
                            class="block w-full rounded-lg border-gray-300 shadow-sm p-3 bg-white dark:bg-gray-700 dark:text-gray-200
                                    focus:ring-green-500 focus:border-green-500 transition-all duration-200 hover:border-green-300"
                            placeholder="Ex: Micros, câbles HDMI...">
                    </div>
                </div>
            </div>

            <!-- description du besoin (salle uniquement) -->
                    <div class="mb-8 animate-fade-in-up hidden" id="besoin_salle" style="animation-delay: 0.2s">
                        <label class="block text-gray-700 dark:text-gray-200 text-lg font-semibold mb-3" for="salle_b">Détails de la salle</label>
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                            <textarea name="salle_b" id="salle_b"
                                        class="block w-full rounded-lg border-gray-300 shadow-sm p-3 bg-gray-50 dark:bg-gray-700 dark:text-gray-200
                                                resize-none transition-all duration-200"
                                        rows="3" readonly>Rien à préciser</textarea>
                        </div>
                    </div>
                    
                    <div class="mb-8 animate-fade-in-up" style="animation-delay: 0.3s">
                        <label class="block text-gray-700 dark:text-gray-200 text-lg font-semibold mb-3" for="classe">Classe concernée</label>
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                            <input type="text" name="classe" id="classe" value="{{ old('classe') }}"
                                   class="block w-full rounded-lg border-gray-300 shadow-sm p-3 bg-white dark:bg-gray-700 dark:text-gray-200
                                          focus:ring-green-500 focus:border-emerald-500 transition-all duration-200 hover:border-green-300
                                          @error('classe') border-red-500 @enderror"
                                   required placeholder="Ex: GL2">
                            @error('classe')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @else
                                <p class="mt-2 text-sm text-gray-500">Indiquez la classe pour laquelle vous faites la demande</p>
                            @enderror
                        </div>
                    </div>

            {{-- la durée du cours --}}
                    <div class="mb-8 animate-fade-in-up" style="animation-delay: 0.4s">
                        <label class="block text-gray-700 dark:text-gray-200 text-lg font-semibold mb-3" for="time">Durée du cours</label>
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                            <input type="text" name="time" id="time" value="{{ old('time') }}"
                                   class="block w-full rounded-lg border-gray-300 shadow-sm p-3 bg-white dark:bg-gray-700 dark:text-gray-200
                                          focus:ring-green-500 focus:border-green-500 transition-all duration-200 hover:border-green-300
                                          @error('time') border-red-500 @enderror"
                                   required placeholder="Ex: 2h, 1h30">
                            @error('time')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @else
                                <p class="mt-2 text-sm text-gray-500">Indiquez la durée prévue du cours</p>
                            @enderror
                        </div>
                    </div>

            {{-- date du cours et heure --}}
                    <div class="mb-8 animate-fade-in-up" style="animation-delay: 0.5s">
                        <label class="block text-gray-700 dark:text-gray-200 text-lg font-semibold mb-3" for="start">Heure du cours</label>
                        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
                            <input type="datetime-local" name="start" id="start"
                                   class="block w-full rounded-lg border-gray-300 shadow-sm p-3 bg-white dark:bg-gray-700 dark:text-gray-200
                                          focus:ring-green-500 focus:border-green-500 transition-all duration-200 hover:border-green-300
                                          @error('start') border-red-500 @enderror"
                                   required>
                            @error('start')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @else
                                <p class="mt-2 text-sm text-gray-500">Sélectionnez l'heure de début du cours</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                        <a href="{{ route('demandes.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-[#0E8345] transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Retour à mes demandes
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-[#0E8345] to-[#15803D]
                                                   text-white font-medium rounded-lg shadow-md transform hover:scale-105 hover:shadow-lg
                                                   active:scale-95 transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Soumettre la demande
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const elements = {
        typeSalle: document.getElementById('type_salle'),
        typeMateriel: document.getElementById('type_materiel'),
        salleBlock: document.getElementById('besoin_salle'),
        besoinSection: document.getElementById('besoins-sections'),
        autreCheckbox: document.getElementById('autre'),
        autreSection: document.getElementById('autre-section'),
        salleField: document.getElementById('salle_b'),
        form: document.getElementById('form-demande')
    };

    const requiredElements = ['typeSalle', 'typeMateriel', 'salleBlock', 'besoinSection'];
    const missingElements = requiredElements.filter(el => !elements[el]);
    if (missingElements.length > 0) {
        console.error('Éléments manquants:', missingElements);
        return;
    }

    function animateElement(element, show) {
        if (!element) return;

        if (show) {
            element.classList.remove('hidden', 'opacity-0', 'scale-95');
        } else {
            element.classList.add('hidden');
        }
    }

    function updateVisibility() {
        const salleChecked = elements.typeSalle.checked;
        const materielChecked = elements.typeMateriel.checked;

        // affiche section materiel uniquement si materiel coche
        animateElement(elements.besoinSection, materielChecked);

        //afiche section salle seulement si salle coche
        animateElement(elements.salleBlock, salleChecked);

        // Gestion du champ salle
        if (salleChecked) {
            elements.salleField.value = 'Rien à préciser';
            elements.salleField.readOnly = true;
            elements.salleField.classList.add('bg-gray-50');
        } else {
            elements.salleField.value = '';
            elements.salleField.readOnly = false;
            elements.salleField.classList.remove('bg-gray-50');
        }

        // Afficher la section "Autre matériel" si la case "autre" est cochée
        if (elements.autreCheckbox && elements.autreSection) {
            animateElement(elements.autreSection, elements.autreCheckbox.checked);
        }
    }

    let timeout;
    function debounce(func, wait = 100) {
        return (...args) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    const debouncedUpdate = debounce(updateVisibility);

    // écouteurs d'événements
    elements.typeSalle.addEventListener('change', debouncedUpdate);
    elements.typeMateriel.addEventListener('change', debouncedUpdate);

    //écoute la case "autre"
    if (elements.autreCheckbox) {
        elements.autreCheckbox.addEventListener('change', debouncedUpdate);
    }

    // Initialisation
    elements.salleBlock.classList.add('hidden');
    updateVisibility();
});
</script>
</x-app-layout>