<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\CreatePreguntaFrecuenteRequest;

class UpdatePreguntaFrecuenteRequest extends CreatePreguntaFrecuenteRequest
{

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
