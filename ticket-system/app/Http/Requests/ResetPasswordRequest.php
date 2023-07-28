<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
            ],
            'token' => ['required',
            Rule::exists('password_resets', 'token')
                ->where(function ($query) {
                    $date = Carbon::now()->subMinutes(60);
                    return $query->where('email', $this->email)->where('created_at', '>', $date);
                }),
            ],
            'password' => 'required|min:8|max:255|confirmed',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Vul een e-mailadres in',
            'email' => 'Vul een correct e-mailadres in',
            'password.confirmed' => 'Wachtwoorden komen niet overeen',
            'password.required' => 'Voer een nieuw wachtwoord in',
            'password.min' => 'Het wachtwoord moet minstens :min karakters zijn.',
            'password.max' => 'Het wachtwoord mag niet langer zijn dan :max karakters',
            'token.required' => 'Geen geldig token aanwezig',
            'token.exists' => 'Token is niet meer geldig. Ga naar de login en stuur opnieuw een wachtwoord vergeten verzoek',
        ];
    }
}
