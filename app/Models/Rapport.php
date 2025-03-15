<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'rapports';

    // Primary key (optional if 'id' is used)
    protected $primaryKey = 'id_rapport';

    // Fillable fields for mass assignment
    protected $fillable = [
        'id_projet',
        'nom_rapport',
        'periode',
        'total_clicks',
        'total_impressions',
        'avg_ctr',
        'avg_position',
        'nb_sessions',
        'nb_active_users',
        'nb_new_users',
        'page_speed',
        'performance',
        'accessibility',
        'best_practices',
        'seo',
        'nb_backlinks',
        'nb_orders',
        'nb_cart',
    ];

    // Define relationship with Projet
    public function projet()
    {
        return $this->belongsTo(Projet::class, 'id_projet', 'id_projet');
    }

    // Define relationship with TopSessionPage (One to Many)
    public function topSessionPages()
    {
        return $this->hasMany(TopSessionPage::class, 'id_rapport', 'id_rapport');
    }

    // Casting the 'periode' field as a datetime (Carbon instance)
    protected $casts = [
        'periode' => 'datetime',
    ];
}
