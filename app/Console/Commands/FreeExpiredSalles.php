<?php

namespace App\Console\Commands;

use App\Models\Demande;
use Illuminate\Console\Command;
use App\Models\Salle;
use Carbon\Carbon;
class FreeExpiredSalles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'salles:free-expired';

    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Libère automatiquement les salles après expiration du temps de cours.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // On récupère toutes les demandes approuvées avec une salle attribuée
        $demandes = Demande::where('statut', 'acceptee')
            ->whereNotNull('id_salle')
            ->get();
        foreach ($demandes as $demande) {
            //On ignore la demande si elle n'a pas de date_demande enregistrée (moment d’attribution) ou si la durée (time) n’a pas été spécifiée.
             if (!$demande->date_demande || !$demande->time) continue;
             //On crée un objet date/heure d’expiration.
            //  $expiration = Carbon::parse($demande->date_demande)->addHours($demande->time);
            $expiration = Carbon::parse($demande->date_demande)->addMinutes($demande->time);
             // Si la durée est écoulée
             if(now()->greaterThanOrEqualTo($expiration)){
                $salle = Salle::find($demande->id_salle);
                if ($salle) {
                    $salle->statut='libre';
                    $salle->save();
                }

                $demande->statut='terminee';
                $demande->classe=null;
                $demande->save();
                $this->info("Salle {$salle->id_salle} libérée (Demande #{$demande->id_demande}).");
             }


        }
        $this->info('Vérification terminée.');
        return Command::SUCCESS;
    }
}
