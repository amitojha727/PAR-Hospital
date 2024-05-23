<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appoinment_mast';
    protected $primaryKey = 'appoinment_id';
    public $incrementing = false;
    protected $keyType = 'string';
}
