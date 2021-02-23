<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGalleryRequest extends FormRequest
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
            'title'=>'sometimes|min:2|max:255',
            'description'=>'sometimes|max:1000',
            'user_id'=> 'sometimes|numeric',
            'images'=>'sometimes|min:1',
            'images.*.url'=>['regex:/^(http)?s?:?(\/\/[^\']*\.(?:png|jpg|jpeg))/']
        ];
    }
}
