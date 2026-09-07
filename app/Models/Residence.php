<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Residence extends Model
{
    public function custodians(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'custodians');
    }
}
