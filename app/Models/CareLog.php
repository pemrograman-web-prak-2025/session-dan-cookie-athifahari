<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'plant_id', 'action_type', 'date', 'notes'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }
}