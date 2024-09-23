<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    use HasFactory;
    protected $primaryKey = 'purchaseId';
    protected $fillable = ['materialId', 'supplierId', 'code', 'statusId', 'quantity', 'price', "total", "created_at", "updated_at"];

    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'materialId');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplierId');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class, 'statusId');
    }
}
