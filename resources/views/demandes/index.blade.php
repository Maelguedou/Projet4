<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Mes Commandes</title>
    </head>
    <body>
        <h2>Mes demandes de réservations</h2>

        <table border="1" cellpading="5">
            <tr>
                <th>Type</th>
                <th>Besoin</th>
                <th>Classe</th>
                <th>Date</th>
                <th>Statut</th>
            </tr>

            @foreach ($demandes as $demande )
                <tr>
                    <td>{{ $demande->type }}</td>
                    <td>{{ $demande->besoin }}</td>
                    <td>{{ $demande->classe }}</td>
                    <td>{{ $demande->date_demande }}</td>
                    <td>{{ $demande->statut }}</td>
                </tr>
            @endforeach
        </table>

        <br>
        <a href="{{ route('demandes.create') }}">Créer une nouvelle demande</a>
    </body>
</html>
