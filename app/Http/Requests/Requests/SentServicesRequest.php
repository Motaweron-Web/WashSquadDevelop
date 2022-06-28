<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SentServicesRequest extends FormRequest
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

                'date' => 'required',
                'ar_title' => 'require',
                'number_of_cars' => 'required',
                'full_name' =>'required',
                'phone' => 'required',
                'total_price' => 'required',//
                'package_id'=>'required',//


        ];
    } public function messages()
{
    return [

        'required' => 'هذا الحقل مطلوب',//


    ];

}}



