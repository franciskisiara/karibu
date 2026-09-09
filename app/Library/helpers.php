<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;

if (! function_exists('redirectRoute'))
{
    function redirectRoute(User $user, bool $named = false)
    {
        return $user->residences()->count() > 0
            ? ($named ? 'residences.index' : '/residences')
            : ($named ? 'occupancies.index' : '/occupancies');
    }
}
