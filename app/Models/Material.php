<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    use HasFactory;
    protected $primaryKey = 'materialId';
    protected $fillable = ['name', 'stock', "created_at", "updated_at"];

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class, 'materialId');
    }

}
