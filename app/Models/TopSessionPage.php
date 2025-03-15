<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopSessionPage extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'top_session_pages';

    // Primary key
    protected $primaryKey = 'id_session_page';

    // Fillable fields for mass assignment
    protected $fillable = [
        'url_page',
        'duree_moyenne',
        'id_rapport',
    ];

    // Define relationship with Rapport
    public function rapport()
    {
        return $this->belongsTo(Rapport::class, 'id_rapport', 'id_rapport');
    }
}
