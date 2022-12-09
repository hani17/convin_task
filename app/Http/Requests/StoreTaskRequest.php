<?php

namespace App\Http\Requests;

use App\Rules\MustBeAdminRule;
use App\Rules\MustBeOrdinaryUserRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'min:1', 'max:255'],
            'description' => ['nullable', 'string'],
            'assigned_to_id' => ['required', 'integer', 'exists:users,id', new MustBeOrdinaryUserRule],
            'assigned_by_id' => ['required', 'integer', 'exists:users,id', new MustBeAdminRule]
        ];
    }
}
