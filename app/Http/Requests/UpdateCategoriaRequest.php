<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\CreateCategoriaRequest;

class UpdateCategoriaRequest extends CreateCategoriaRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->reglas['nombre'] = 'required|unique:categorias,nombre,'.$this->categoria->id.','.'id';
        $this->reglas['clave'] = 'required|unique:categorias,clave,'.$this->categoria->id.','.'id';
        
        return $this->reglas;
    }
}
