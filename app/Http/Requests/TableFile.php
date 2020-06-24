<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TableFile extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'table_file' => 'required|file|mimes:xlsx,xls,csv|max:2024'
        ];
    }
}
