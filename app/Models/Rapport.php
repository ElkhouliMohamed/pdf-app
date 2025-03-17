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
    protected $guarded = [];
    protected $dates = ['periode', 'created_at', 'updated_at'];

    // Relationship with Projet
    public function projet()
    {
        return $this->belongsTo(Projet::class, 'id_projet');
    }

    // Relationship with TopKeyword


    // Relationship with TopPage
    public function topPages()
    {
        return $this->hasMany(TopPage::class, 'id_rapport');
    }

    // Relationship with TopSessionPage
    public function topSessionPages()
    {
        return $this->hasMany(TopSessionPage::class, 'id_rapport');
    }
    public function topKeywords()
    {
        return $this->hasMany(TopKeyword::class, 'id_rapport'); // Adjust the relation according to your schema
    }
    public function erreurs404()
    {
        return $this->hasMany(Erreur404::class, 'id_rapport');
    }

    // Casting the 'periode' field as a datetime (Carbon instance)
    protected $casts = [
        'periode' => 'datetime',
    ];
}
