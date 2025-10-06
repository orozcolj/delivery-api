<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePackageRequest extends FormRequest
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
            'address' => 'sometimes|required|string|max:100',
            'package_status_id' => 'sometimes|required|integer|exists:package_statuses,id',
            'dimensions' => 'sometimes|required|string|max:45',
            'weight' => 'sometimes|required|string|max:45',
            'merchandise_type_id' => 'sometimes|required|integer|exists:merchandise_types,id',
        ];
    }
}
