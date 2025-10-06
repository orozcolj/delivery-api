<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class MerchandiseType extends Model
{
    use HasFactory;
    protected $fillable = ['type'];
    public $timestamps = false;
    public function packageDetails(): HasMany
    {
        return $this->hasMany(PackageDetail::class);
    }
}