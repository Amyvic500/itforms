<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class groupReq extends FormRequest
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
			'firstName'=>'required',
			'lastName'=>'required',
			'company'=>'required',
			'location'=>'required',
			'dept'=>'required',
			'position'=>'required',
			'status'=>'required',	
			'req'=>'required',	
			'selFile' => 'file|mimes:doc,xls,pdf,jpg,jpeg,bmp,svg,dwg|max:2048',
			
            /*
			'itemType'=>'required',
			'invUom'=>'required',
			'purUom'=>'required',
			'comp'=>'required',
			'subCat'=>'required',
			'category'=>'required',
			'subClass'=>'required',
			'warehouse'=>'required',	
*/

			
        ];
    }

	public function messages(){
		return[

		/*
		'itemType.required'=>'Item Type is required, shouldn\'t be empty.',
		'invUom.required'=>'Inventory UOM is required',
		'purUom.required'=>'Purchasing UOM is required',
		'comp.required'=>'select company is required',
		'subCat.required'=>'select family is required',
		'category.required'=>'select category is required',
		'subClass.required'=>'select subcategory is required',
		'warehouse.required'=>'select item warehouse is required',	
		*/		
		];
	}
}
