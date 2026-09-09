<?php

namespace App\Http\Requests;

use App\Models\Occupancy;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class VisitStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $occupancy = Occupancy::where('id', $this->occupancy_id)
            ->where('user_id', $this->user()->id)
            ->first();

        $occupancyExists = !is_null($occupancy);

        if ($occupancyExists) {
            $this->attributes->set('occupancy', $occupancy->load([
                'residentialUnit.residence',
            ]));
        }

        return $occupancyExists;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'occupancy_id' => [
                'required',
            ],

            'email' => [
                'required',
                Rule::notIn([$this->user()->email]),
                function ($attribute, $value, $fail) {
                    $user = User::where('email', $value)->first();

                    if (is_null($user)) {
                        $fail('The user does not exist.');
                    } else {
                        $this->attributes->set('visitor', $user);
                    }
                }
            ],
        ];
    }
}
