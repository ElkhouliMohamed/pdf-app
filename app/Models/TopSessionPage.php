<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopSessionPage extends Model
{
    use HasFactory;

    // Specify the table name (optional if it's following the Laravel naming convention)
    protected $table = 'top_session_pages';

    // Specify the primary key if it's not 'id' (optional)
    protected $primaryKey = 'id_session_page';

    // Enable timestamps (optional, depends on whether the table has created_at and updated_at columns)
    public $timestamps = true;

    // Define the fillable fields
    protected $fillable = [
        'url_page',
        'duree_moyenne',
        'id_rapport',
    ];

    // Define relationships if any (if 'id_rapport' is related to the Rapport model)
    public function rapport()
    {
        return $this->belongsTo(Rapport::class, 'id_rapport', 'id_rapport');
    }
}
