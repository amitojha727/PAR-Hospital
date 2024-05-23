<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Site extends Model
{
    use HasFactory;
    protected $table = 'site_mast';
    protected $primaryKey = 'site_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function doctors(): HasMany
    {
        return $this->hasMany(Employee::class, 'site_id', 'site_id');
    }
}
