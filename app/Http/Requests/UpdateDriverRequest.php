<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UpdateDriverRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $driverId = $this->route('driver');
        return [
            'first_name' => 'required|string|max:45',
            'last_name' => 'required|string|max:45',
            'document' => 'required|string|max:10|unique:truckers,document,' . $driverId,
            'birth_date' => 'required|date',
            'license_number' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
        ];
    }
}
