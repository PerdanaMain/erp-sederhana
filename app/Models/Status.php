<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;
    protected $table = 'statuses';
    protected $primaryKey = 'statusId';
    protected $fillable = ['name'];

    public function materials(): HasMany
    {
        return $this->hasMany(Material::class, 'statusId', 'statusId');
    }
}
