<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StoreDriverRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:45',
            'last_name' => 'required|string|max:45',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'document' => 'required|string|max:10|unique:truckers',
            'birth_date' => 'required|date',
            'license_number' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
        ];
    }
}
