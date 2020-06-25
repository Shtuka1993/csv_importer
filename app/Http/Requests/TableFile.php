<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TableFile extends FormRequest
{

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
