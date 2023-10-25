<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Condidatures extends Model
{
    protected $fillable = [
        'job_title',
        'name',
        'email',
        'phone',
        'message',
        'cv_upload',
        'status',
        'offre_emploi_id',

    ];

    public function offreEmploi()
{
    return $this->belongsTo(OffreEmplois::class, 'offre_emploi_id');
}



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');  // Relation avec l'utilisateur
    }
    public function contrat()
    {
        return $this->hasMany(Contrats::class, 'contrat_id');  // Assuming there's a 'contrat_id' foreign key in the condidatures table
    }
}
