<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoriaMuebleRequest extends FormRequest
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
        // $this->reglas['nombre'] = 'required|unique:categorias_muebles,nombre,'.$this->categoriaMuebles->id.','.'id';

        return [];
    }

  
    // demo
    // public function messages()
    // {
    //     return [
    //         'student.required' => 'Agrega el nombre del estudiante.',
    //         'student.max' =>'El nombre del estudiante no puede ser mayor a :max caracteres.',
    //         'score.required' => 'Agrega la puntuación al estudiante.',
    //         'score.numeric' => 'La puntuación debe ser un número',
    //         'score.between' => 'La puntuación debe estar entre :min y :max'
    //     ];
    // }
}