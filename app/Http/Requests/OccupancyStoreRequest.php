<?php

namespace App\Http\Requests;

use App\Models\ResidentialUnit;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class OccupancyStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return ResidentialUnit::where('id', $this->residential_unit_id)
            ->whereHas('residence.custodians', function ($query) {
                $query->where('users.id', $this->user()->id);
            })
            ->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'residential_unit_id' => [
                'required',
            ],

            'email' => [
                'required',
                function ($attribute, $value, $fail) {
                    $user = User::where('email', $value)->first();

                    if (is_null($user)) {
                        $fail('The user does not exist.');
                    } else {
                        $this->attributes->set('user', $user);
                    }
                }
            ],
        ];
    }
}
