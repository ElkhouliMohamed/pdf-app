<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Erreur404 extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'erreurs_404';

    // Primary key
    protected $primaryKey = 'id_erreur_404';

    // Fillable fields for mass assignment
    protected $fillable = [
        'url',
        'timestamp',
    ];
}
