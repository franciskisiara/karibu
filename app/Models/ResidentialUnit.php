<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

/**
 * @method static Builder custodian(int $residenceId)
 */
class ResidentialUnit extends Model
{
    #[Scope]
    protected function custodian(Builder $query, int $residenceId): void
    {
        $query->whereHas('residence', function ($query) use($residenceId) {
            $query->where('residences.id', $residenceId)
                ->whereHas('custodians', function ($query) {
                    $query->where('custodians.user_id', Auth::id());
                });
        });
    }

    public function occupancies(): HasMany
    {
        return $this->hasMany(Occupancy::class);
    }

    public function residence(): BelongsTo
    {
        return $this->belongsTo(Residence::class);
    }
}
