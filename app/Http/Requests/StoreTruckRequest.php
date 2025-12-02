<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StoreTruckRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'plate' => 'required|string|max:10|unique:trucks',
            'model' => 'required|string|max:45',
            'capacity' => 'required|numeric|min:0',
        ];
    }
}
