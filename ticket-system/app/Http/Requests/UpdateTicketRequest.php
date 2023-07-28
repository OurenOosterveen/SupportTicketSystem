<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTicketRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:100'],
            'content' => ['required', 'string', 'max:500'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'status_id' => ['required', Rule::exists('statuses', 'id')],
            'assignee_id' => ['required', Rule::exists('users', 'id')],
        ];
    }
}
