<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopKeyword extends Model
{
    use HasFactory;

    // Specify the table name (if it's not following Laravel's naming conventions)
    protected $table = 'top_keywords';

    // Specify the primary key (optional, Laravel assumes 'id' by default)
    protected $primaryKey = 'id_keyword';

    // If the table uses timestamps (created_at and updated_at)
    public $timestamps = true;

    // Define which attributes can be mass-assigned
    protected $fillable = [
        'keyword',
        'nombre_requetes',
        'id_rapport',
    ];

    // If you want to specify a custom date format for timestamps (optional)
    protected $dateFormat = 'Y-m-d H:i:s';

    // Define the relationship with Rapport (assuming 'rapport' and 'projet' relationships exist in the Rapport model)
    public function rapport()
    {
        return $this->belongsTo(Rapport::class, 'id_rapport', 'id_rapport');
    }
}
