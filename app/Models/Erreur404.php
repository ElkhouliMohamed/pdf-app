<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Erreur404 extends Model
{
    protected $table = 'erreurs_404';
    protected $primaryKey = 'id_404';
    public $timestamps = true;

    protected $fillable = [
        'nb_404',
        'file_data',
        'id_rapport'
    ];

    // Relationship with Rapport
    public function rapport()
    {
        return $this->belongsTo(Rapport::class, 'id_rapport');
    }
}
