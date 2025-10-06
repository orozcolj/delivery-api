<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePackageRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'address' => 'required|string|max:100',
            'package_status_id' => 'required|integer|exists:package_statuses,id',
            'dimensions' => 'required|string|max:45',
            'weight' => 'required|string|max:45',
            'merchandise_type_id' => 'required|integer|exists:merchandise_types,id',
        ];
    }
}
