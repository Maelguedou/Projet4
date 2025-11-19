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
        $demandes = Demande::where('statut', 'acceptee')->get();
        foreach ($demandes as $demande) {
            //On ignore la demande si elle n'a pas de date enregistrée (moment d’attribution) ou si la durée (time) n’a pas été spécifiée.
             if (!$demande->start || !$demande->time) continue;
                     
             $debut = Carbon::parse($demande->start);   // date+heure de début
             $fin = $debut->copy()->addMinutes($demande->time);//  $expiration = Carbon::parse($demande->date_demande)->addHours($demande->time);
          
             // Vérifier si nous sommes dans la periode d'attribution
             if(now()->between($debut, $fin)) {

                // Occuper la salle
                
                    $salle = Salle::find($demande->id_salle);
                    if ($salle && $salle->statut !== 'occupee') {
                        $salle->statut = 'occupee';
                        $salle->save();
                    }
                
                continue;
             }   
             // Si nous sommes à la fin 
        
             if(now()->greaterThanOrEqualTo($fin)){
                $salle = Salle::find($demande->id_salle);
                if ($salle) {
                    $salle->statut='libre';
                    $salle->save();
                }
                $demande->statut='terminee';
                
                $demande->save();
                $this->info("Salle {$salle->id_salle} libérée (Demande #{$demande->id_demande}).");
             }


        }
        $this->info('Vérification terminée.');
        return Command::SUCCESS;
    }
}
