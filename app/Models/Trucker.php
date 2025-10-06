<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Trucker extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'document', 'first_name', 'last_name', 
        'birth_date', 'license_number', 'phone'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function packages(): HasMany
    {
        return $this->hasMany(Package::class);
    }

    public function trucks(): BelongsToMany
    {
        return $this->belongsToMany(Truck::class, 'trucker_truck');
    }
}