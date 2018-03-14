<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        $files = count($this->input('file'));
        foreach (range(0,$files) as $index){
            $rules['file.'.$index] = 'image|mimes:jpeg,bmp,png,gif|between:100,2000';
        }
        return $rules;
    }
}
