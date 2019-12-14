<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\CreatePublicacionRequest;

class UpdatePublicacionRequest extends CreatePublicacionRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->reglas['titulo'] = 'required|unique:publicaciones,titulo,'.$this->publicacion->id.','.'id';
        return $this->reglas;
    }
}
