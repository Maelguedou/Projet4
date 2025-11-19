<?php

namespace App\Console\Commands;

use App\Models\Demande;
use Illuminate\Console\Command;
use App\Models\Materiel;
use Carbon\Carbon;
class FreeExpiredMateriaux extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'materiaux:free-expired';

    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Libère automatiquement les matériaux après expiration du temps de cours.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // On récupère toutes les demandes approuvées avec une salle attribuée
        $demandes = Demande::where('statut', 'acceptee')->get();
        foreach ($demandes as $demande) {
            //Vérifier que start et time existent
             if (!$demande->start || !$demande->time) continue;

            $debut = Carbon::parse($demande->start); ;
            $fin = $debut->copy()->addMinutes($demande->time);

            // Si on se retrouve dans la période
            if (now()->between($debut, $fin)) { 
                $materiel = Materiel::find($demande->id_materiel);
                if ($materiel && $materiel->statut !== 'occupee') {
                    $materiel->statut = 'occupee';
                    $materiel->save();
                }
                continue;
            }

             // Si la durée est écoulée
             if(now()->greaterThanOrEqualTo($fin)){
                $materiel = Materiel::find($demande->id_materiel);
                if ($materiel) {
                    $materiel->statut='libre';
                    $materiel->save();
                }

                $demande->statut='terminee';
                $demande->save();
                $this->info("Le matériel {$materiel->id_materiel} libéré (Demande #{$demande->id_demande}).");
             }


        }
        $this->info('Vérification terminée.');
        return Command::SUCCESS;
    }
}
