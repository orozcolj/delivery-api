<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Truck extends Model
{
    use HasFactory;
    protected $fillable = ['plate', 'model'];

    public function truckers(): BelongsToMany
    {
        return $this->belongsToMany(Trucker::class, 'trucker_truck');
    }
}