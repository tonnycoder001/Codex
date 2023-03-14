<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {

        $userModel = get_class(new user());

        return [
        'user_id'=>"required|exists:{$userModel},id",
        'name'=>"nullable",
        'is_private'=>"nullable|boolean",
        ];
    }
}
