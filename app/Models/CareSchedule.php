<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareSchedule extends Model {
    use HasFactory;

     protected $fillable = [
        'plant_id', 'type', 'interval_days', 'next_date', 'notes'
    ];

    protected $casts = [
        'next_date' => 'date',
    ];

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }
}