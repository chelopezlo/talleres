<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\Iglesia;

class CreateIglesiaRequest extends Request
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
        return Iglesia::$rules;
    }
}