<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory;
    protected $fillable = ['address', 'trucker_id', 'package_status_id'];

    public function trucker(): BelongsTo
    {
        return $this->belongsTo(Trucker::class);
    }

    public function packageStatus(): BelongsTo
    {
        return $this->belongsTo(PackageStatus::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(PackageDetail::class);
    }
}