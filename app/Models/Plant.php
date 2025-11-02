<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\CareSchedule;
use App\Models\CareLog;

class Plant extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'species', 'photo', 'notes', 'category'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function careSchedules() {
        return $this->hasMany(CareSchedule::class);
    }

    public function careLogs(): HasMany {
        return $this->hasMany(CareLog::class);
    }
}
