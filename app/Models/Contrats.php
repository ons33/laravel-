<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrats extends Model
{
    protected $fillable = [
        'type',
        'duree',
        'salaire',
        'date_debut',
        'date_fin',
        'description',
        'etat',
       
    ];

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id');  // Relation avec l'utilisateur
    // }

    public function offreEmploi(): BelongsTo
    {
        return $this->belongsTo(OffreEmplois::class, 'offre_emploi_id');
    }
    
    public function condidatures()
    {
        return $this->belongsTo(Condidatures::class, 'condidature_id');
    }
}
