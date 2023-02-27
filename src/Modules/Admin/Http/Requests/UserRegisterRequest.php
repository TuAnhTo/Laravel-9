<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => ['required', 'min:6'],
            'confirm_password' => ['required', 'same:password'],
            'first_name' => 'nullable|string',
            'last_name' => 'nullable|string',
            'store_country' => 'nullable|string',
            'personal_country' => 'nullable|string',
            'phone' => 'nullable|numeric',
            'business_type' => 'nullable|string',
            'monthly_revenue' => 'nullable|numeric',
            'store_id' => 'nullable|string',
            'status' => 'nullable',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
