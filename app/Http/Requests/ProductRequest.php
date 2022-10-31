<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

use Illuminate\Contracts\Validation\Validator;

class ProductRequest extends FormRequest
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
            'catagory_id'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'name'=>'required',
            'status'=>'required',
            // 'description'=>'required',
            'price'=>'required',
            'old_price'=>'required',
            'unit'=>'required',
            'barcode'=>'required',
            'weight'=>'required',
            // 'link'=>'required',
            // 'button'=>'required',
            'coast'=>'required',
            // 'note'=>'required',
        ];
    }

    public function failedValidation(Validator $validator)

    {
        throw new HttpResponseException(response()->json([
            'error'      => $validator->errors()
        ],400));

    }

    public function messages()
    {
        return [

            // catagory validate
            'catagory_id.required'        => __('messages.The catagory is required'),

            // name validate
            'name.required'        => __('messages.The name is required'),

            // image validate 
            'image.required'        => __('messages.The image is required'),
            'image.image'        => __('messages.The image must be an image'),
            'image.mimes'        => __('messages.The image is mimes'),

            // status validate 
            'status.required'        => __('messages.The status is required'),

            // // description validate 
            // 'description.required'        => __('messages.The Description is required'),

            // price validate 
            'price.required'        => __('messages.The price is required'),
            'old_price.required'        => __('messages.The old price is required'),

           // unit validate 
           'unit.required'        => __('messages.The unit is required'),

            // barcode validate 
            'barcode.required'        => __('messages.The barcode is required'),

             // weight validate 
             'weight.required'        => __('messages.The weight is required'),

            //   // link validate 
            // 'link.required'        => __('messages.The link is required'),

             // coast validate 
             'coast.required'        => __('messages.The coast is required'),

          


        
        ];
    }
}
