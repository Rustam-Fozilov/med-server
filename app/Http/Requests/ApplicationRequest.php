<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
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
            'f_name' => ['required', 'string'],
            'l_name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'doctor_id' => ['required', 'exists:doctors,id'],
            'time' => ['required', 'date_format:H:i'],
        ];
    }
}
