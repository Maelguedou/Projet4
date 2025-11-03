<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('') }}
        </h2>
    </x-slot>
        <section class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="bg-gradient-to-r from-sky-50 to-sky-100 px-6 py-4 border-b border-slate-200">
                <h2 class="text-xl font-semibold text-sky-800 flex items-center gap-3">
                    <i class="fas fa-user-plus text-sky-600"></i>
                    Ajouter un enseignant
                </h2>
            </div>
            <div class="p-6">
                <a href="{{ route('admin.create-teacher') }}"
                   class="inline-flex items-center gap-2 bg-sky-600 hover:bg-sky-700 text-white font-medium text-sm px-6 py-3 rounded-lg shadow-md transition-all duration-200 hover:-translate-y-0.5">
                    <i class="fas fa-plus-circle"></i>
                    Créer un nouvel enseignant
                </a>
            </div>
        </section>
        <section>
            @foreach ($users as $user )
                {{ $user->name }}
            @endforeach
        </section>
</x-app-layout>