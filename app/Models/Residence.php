<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class Residence extends Model
{
    #[Scope]
    protected function custodian(Builder $query): void
    {
        $query->whereHas('custodians', function ($query) {
            $query->where('custodians.user_id', Auth::id());
        });
    }

    public function custodians(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'custodians');
    }
}
