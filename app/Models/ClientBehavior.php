<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientBehavior extends Model
{
    use HasFactory;
    protected $table = 'cli_behavior_mast';

    public function clientForm(): BelongsTo
    {
        return $this->belongsTo(ClientForm::class, 'form_id');
    }
}
