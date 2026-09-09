<?php

namespace App\Http\Requests;

use App\Models\Visit;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class VisitUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $visit = $this->route('visit');

        return Visit::where('id', $visit->id)
            ->whereHas(
                'occupancy.residentialUnit.residence.custodians',
                function ($query) {
                    $query->where('custodians.user_id', $this->user()->id);
                }
            )
            ->where('welcomed_at', null)
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
            'passcode' => [
                'string',
                'numeric',
                function ($attribute, $value, $fail) {
                    $visit = $this->route('visit');

                    if (! Hash::check($value, $visit->passcode)) {
                        $fail('Sorry! You are an impostor.');
                    }
                }
            ],
        ];
    }
}
