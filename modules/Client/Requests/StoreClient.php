<?php

namespace Modules\Client\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClient extends FormRequest
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
        switch ( $this->method() ) {
            case 'PUT':
                return [
                    'name' => 'required|max:255|unique:clients,id,'.$this->get('id')
                ];
                break;
            
            default:
                # code...
                break;
        }
        return [
            'name' => 'required|unique:clients|max:255'
        ];
    }
}
