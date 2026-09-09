<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Occupancy extends Model
{
    use SoftDeletes;

    #[Scope]
    protected function custodian(Builder $query): void
    {
        $query->whereHas('residentialUnit', function ($query) {
            $query->custodian();
        });
    }

    public function residentialUnit(): BelongsTo
    {
        return $this->belongsTo(ResidentialUnit::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
