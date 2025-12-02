<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UpdateTruckRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $truckId = $this->route('truck');
        return [
            'plate' => 'required|string|max:10|unique:trucks,plate,' . $truckId,
            'model' => 'required|string|max:45',
            'capacity' => 'required|numeric|min:0',
        ];
    }
}
