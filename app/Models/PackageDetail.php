<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PackageDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'package_id', 'merchandise_type_id', 'dimensions', 'weight', 'delivery_date'
    ];

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function merchandiseType(): BelongsTo
    {
        return $this->belongsTo(MerchandiseType::class);
    }
}