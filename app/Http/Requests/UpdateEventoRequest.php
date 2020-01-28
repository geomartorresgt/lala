<?php

namespace App\Http\Requests;

use App\Http\Requests\CreateEventoRequest;
use Illuminate\Foundation\Http\FormRequest;

class UpdateEventoRequest extends CreateEventoRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->reglas['titulo'] = 'required|unique:eventos,titulo,'.$this->evento->id.','.'id';
        return $this->reglas;
    }
}
