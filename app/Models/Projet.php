<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    // Table name (optional if the table is named in the plural form)
    protected $table = 'projets';

    // Primary key (optional if 'id' is used)
    protected $primaryKey = 'id_projet';

    // Define fillable fields for mass assignment
    protected $fillable = [
        'nom_projet',
        'nom_siteweb',
        'objectif',
        'image_path',
    ];

    // Define relationships with other models
    public function rapports()
    {
        return $this->hasMany(Rapport::class, 'id_projet');
    }
    // Define relationships with other models
    public function projet()
    {
        return $this->belongsTo(Projet::class, 'id_projet', 'id_projet');
    }
}
