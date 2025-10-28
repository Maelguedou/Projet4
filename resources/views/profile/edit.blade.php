<x-app-layout>
    @section('title', 'Mon Profil')

    <div class="container my-4">
        <!-- En-tête -->
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="display-6 fw-bold">
                    <i class="bi bi-person-circle text-primary"></i>
                    Mon Profil
                </h1>
                <p class="text-muted">Gérez vos informations personnelles et paramètres de sécurité</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- Informations du profil -->
                <div class="glass-card p-4 mb-4">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- Mise à jour du mot de passe -->
                <div class="glass-card p-4 mb-4">
                    @include('profile.partials.update-password-form')
                </div>

                <!-- Suppression du compte -->
                <div class="glass-card p-4">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
