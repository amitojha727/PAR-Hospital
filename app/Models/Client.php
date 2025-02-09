<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'client_mast';
    protected $primaryKey = 'client_id';
    public $incrementing = false;
    protected $keyType = 'string';
}
