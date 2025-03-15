<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopPage extends Model
{
    use HasFactory;

    // Table name (if not default, you can specify)
    protected $table = 'top_pages';

    // Primary key (optional if 'id' is used)
    protected $primaryKey = 'id_page';

    // Fillable fields for mass assignment
    protected $fillable = [
        'url_page',
        'nb_clicks',
        'nb_impressions',
        'avg_ctr',
        'avg_position',
        'id_rapport',
    ];

    // Define relationship with Rapport (Each TopPage belongs to a Rapport)
    public function rapport()
    {
        return $this->belongsTo(Rapport::class, 'id_rapport', 'id_rapport');
    }
}
