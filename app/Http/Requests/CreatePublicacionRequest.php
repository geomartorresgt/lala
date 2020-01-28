<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePublicacionRequest extends FormRequest
{
    protected $reglas = [
        'titulo' => 'required|unique:publicaciones',
        'contenido' => 'required',
    ];
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
        $this->reglas['banner'] = 'required';
        return $this->reglas;
    }
}
