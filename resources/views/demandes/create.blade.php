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
                                <input type="checkbox" id="type_salle" name="type[]" value="Salle" class="h-5 w-5 text-green-600 border-gray-300 rounded focus:ring-green-500 transition-colors">
                                <span class="ml-3 font-medium group-hover:text-green-600 transition-colors">Salle</span>
                            </label>
                            <label class="group inline-flex items-center text-sm cursor-pointer p-4 bg-gray-50 rounded-lg border-2 border-transparent hover:border-green-200 transition-all duration-200">
                                <input type="checkbox" id="type_materiel" name="type[]" value="Matériel" class="h-5 w-5 text-green-600 border-gray-300 rounded focus:ring-sky-500 transition-colors">
                                <span class="ml-3 font-medium group-hover:text-green-600 transition-colors">Matériel</span>
                            </label>
                        </div>
                    </div>

    <div id="besoins-sections" class="mb-8 opacity-0 hidden transform scale-95 transition-all duration-300 ease-out animate-fade-in-up" style="animation-delay: 0.2s">
        <label class="block text-gray-700 dark:text-gray-200 text-lg font-semibold mb-3" for="besoin_m">Matériel nécessaire</label>
        <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
            <select name="besoin_m" id="besoin_m" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm p-3 focus:ring-green-500 focus:border-green-500 bg-white dark:bg-gray-700 dark:text-gray-200 transition-all duration-200 hover:border-green-300">
                <option value="">-- Sélectionnez le matériel --</option>
                <option value="projecteur">Projecteur</option>
                <option value="ordinateur">Ordinateur</option>
                <option value="haut_parleur">Haut-parleur</option>
                <option value="autre">Autre matériel</option>
            </select>

            <div id="autre-section" class="mt-4 opacity-0 hidden transform -translate-y-2 transition-all duration-300 ease-out">
                <label for="autre_materiel" class="block text-sm font-medium text-gray-600 dark:text-gray-300 mb-2">Précisez le matériel nécessaire</label>
                <input type="text" name="autre_materiel" id="autre_materiel"
                       class="block w-full rounded-lg border-gray-300 shadow-sm p-3 bg-white dark:bg-gray-700 dark:text-gray-200
                              focus:ring-green-500 focus:border-green-500 transition-all duration-200 hover:border-green-300"
                       placeholder="Ex: Micros, câbles HDMI...">
            </div>
        </div>
    </div>

                    <!-- description du besoin (salle uniquement) -->
                            <div class="mb-8 animate-fade-in-up" id="besoin_salle" style="animation-delay: 0.2s">
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
                            <input type="text" name="classe" id="classe"
                                   class="block w-full rounded-lg border-gray-300 shadow-sm p-3 bg-white dark:bg-gray-700 dark:text-gray-200
                                          focus:ring-sky-500 focus:border-sky-500 transition-all duration-200 hover:border-green-300"
                                   required placeholder="Ex: GL2">
                            <p class="mt-2 text-sm text-gray-500">Indiquez la classe pour laquelle vous faites la demande</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                        <a href="{{ route('demandes.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-green-600 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Retour à mes demandes
                        </a>
                        <button type="submit" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600
                                                   text-white font-medium rounded-lg shadow-md transform hover:scale-105 hover:shadow-lg
                                                   active:scale-95 transition-all duration-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Soumettre la demande
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Elements sélection sécurisée avec vérification d'existence
            const elements = {
                typeSalle: document.getElementById('type_salle'),
                typeMateriel: document.getElementById('type_materiel'),
                salleBlock: document.getElementById('besoin_salle'),
                besoinSection: document.getElementById('besoins-sections'),
                besoinSelect: document.getElementById('besoin_m'),
                autreSection: document.getElementById('autre-section'),
                salleField: document.getElementById('salle_b'),
                form: document.getElementById('form-demande')
            };

            // Vérifie si tous les éléments requis sont présents
            const requiredElements = ['typeSalle', 'typeMateriel', 'salleBlock', 'besoinSection'];
            const missingElements = requiredElements.filter(el => !elements[el]);
            if (missingElements.length > 0) {
                console.error('Éléments manquants:', missingElements);
                return; // Arrête l'exécution si des éléments essentiels manquent
            }

            function animateElement(element, show) {
                if (!element) return;
                
                // Première étape : Afficher/cacher l'élément
                if (show) {
                    element.classList.remove('hidden');
                    // Force un reflow pour que la transition fonctionne
                    element.offsetHeight;
                    requestAnimationFrame(() => {
                        element.classList.remove('opacity-0', 'scale-95', '-translate-y-2');
                    });
                } else {
                    element.classList.add('opacity-0', 'scale-95');
                    // Attendre la fin de l'animation avant de cacher
                    element.addEventListener('transitionend', () => {
                        if (!element.classList.contains('opacity-0')) return;
                        element.classList.add('hidden');
                    }, { once: true });
                }
            }

            function updateVisibility() {
                const salleChecked = elements.typeSalle.checked;
                const materielChecked = elements.typeMateriel.checked;

                // Animation des sections
                animateElement(elements.besoinSection, materielChecked);
                animateElement(elements.salleBlock, !materielChecked);

                // Gestion du champ salle
                if (elements.salleField) {
                    const shouldBeReadonly = salleChecked && !materielChecked;
                    elements.salleField.value = shouldBeReadonly ? 'Rien à préciser' : '';
                    elements.salleField.readOnly = shouldBeReadonly;
                    elements.salleField.classList.toggle('bg-gray-50', shouldBeReadonly);
                }

                // Animation de la section "autre"
                if (elements.besoinSelect && elements.autreSection) {
                    animateElement(elements.autreSection, elements.besoinSelect.value === 'autre');
                }
            }

            // Gestionnaires d'événements avec debounce
            let timeout;
            function debounce(func, wait = 100) {
                return (...args) => {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), wait);
                };
            }

            const debouncedUpdate = debounce(updateVisibility);

            // Attacher les écouteurs d'événements
            elements.typeSalle.addEventListener('change', debouncedUpdate);
            elements.typeMateriel.addEventListener('change', debouncedUpdate);
            if (elements.besoinSelect) {
                elements.besoinSelect.addEventListener('change', debouncedUpdate);
            }

            // Validation du formulaire
            if (elements.form) {
                elements.form.addEventListener('submit', (e) => {
                    const isValid = elements.typeSalle.checked || elements.typeMateriel.checked;
                    if (!isValid) {
                        e.preventDefault();
                        alert('Veuillez sélectionner au moins un type de demande (Salle ou Matériel)');
                    }
                });
            }

            // Initialisation
            updateVisibility();
        });
    </script>
</x-app-layout>
