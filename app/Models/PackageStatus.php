<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class PackageStatus extends Model
{
    use HasFactory;
    protected $fillable = ['status'];
    public $timestamps = false;
    public function packages(): HasMany
    {
        return $this->hasMany(Package::class);
    }
}