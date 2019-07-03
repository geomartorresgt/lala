<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMuebleRequest extends FormRequest
{
    protected $reglas = [
        'codigo' => 'required',
        'nombre' => 'required',
        'dimensiones' => 'required',
        'precio' => 'required|numeric',
        'categoria_mueble_id' => 'required',
        'directorio_url' => 'required',
        'foto_url' => 'required',
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
        return $this->reglas;
    }
}