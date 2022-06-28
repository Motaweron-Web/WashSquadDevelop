<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppSettingDriversRequest extends FormRequest
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

              'logo' => 'required_without:id|mimes:jpg,jpeg,png,gif',
               'name' => 'required|string|max:100',
               'driver_name' => 'required|string|max:100',
               'worker_name' => 'required|string|max:100',
               'full_name' => 'required|max:100',
                'phone' =>'required|max:100',

              'commission'   => 'required',
             'password'   => 'required_without:id'

        ];
    }public function messages(){

    return [
        'required'  => 'هذا الحقل مطلوب ',
       'max'  => 'هذا الحقل طويل',
      'name.string'  =>'الاسم لابد ان يكون حروف او حروف وارقام ',
        'logo.required_without'  => 'الصوره مطلوبة',
     'phone.unique' => 'رقم الهاتف مستخدم من قبل ',

    ];
}
}
