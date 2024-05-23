<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClientForm extends Model
{
    use HasFactory;
    protected $table = 'cli_form_mast';
    protected $primaryKey = 'form_id';
    public $incrementing = false;
    protected $keyType = 'string';

    public function clientHealthStatus(): HasOne
    {
        return $this->hasOne(ClientHealthStatus::class, 'form_id');
    }
    
    public function clientDailyRoutine(): HasOne
    {
        return $this->hasOne(ClientDailyRoutine::class, 'form_id');
    }
    
    public function clientSocialWellBeing(): HasOne
    {
        return $this->hasOne(ClientSocialWellBeing::class, 'form_id');
    }
    
    public function clientGeneralObservation(): HasOne
    {
        return $this->hasOne(ClientGeneralObservation::class, 'form_id');
    }
    
    public function clientBehavior(): HasOne
    {
        return $this->hasOne(ClientBehavior::class, 'form_id');
    }
    
    public function clientInapporiateBehavior(): HasMany
    {
        return $this->hasMany(ClientInapporiateBehavior::class, 'form_id');
    }
}
