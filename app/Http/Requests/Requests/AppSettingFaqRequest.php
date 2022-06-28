<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use phpDocumentor\Reflection\Types\True_;

class AppSettingFaqRequest extends FormRequest
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


        return [
            'en_title' => 'required',
            'ar_title' => 'required',
            'ar_content' => 'required',
            'en_content' => 'required',
        ];
    }public function messages(){

    return [
        'required'  => 'هذا الحقل مطلوب '];}
}
