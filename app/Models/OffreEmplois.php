<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffreEmplois extends Model
{
    use HasFactory;

    protected $fillable = [
    'titre',
    'emplacement',
    'Type',
    'apropos',
    'salaire',
    'societe_id'
];
  public function societe()
  {
  return $this->belongsTo(Societe::class, 'societe_id');
  }



  public function condidatures()
  {
      return $this->hasMany(Condidatures::class);
  }
}

