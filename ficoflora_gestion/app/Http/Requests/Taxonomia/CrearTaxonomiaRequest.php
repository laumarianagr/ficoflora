<?php

namespace App\Http\Requests\Taxonomia;

use App\Http\Requests\Request;
use Illuminate\Routing\Route;

class CrearTaxonomiaRequest extends Request
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

        $taxo = $this->route('taxo');


        $rules = ['phylum' => 'required'];

        if($taxo != 'phylum'){
            $rules['clase'] = 'required';

            if($taxo != 'clase' && $taxo != 'subclase'){
                $rules['orden'] = 'required';

                if($taxo != 'orden'){
                    $rules['familia'] = 'required';

                    if($taxo != 'familia'){
                        $rules['genero'] = 'required';
                    }
                }
            }
        }

  //        dd($taxo);
        return $rules;
    }

    /**
     * Personalizción de mensajes.
     *
     * @return array
     */
    public function messages()
    {
        return[
            'required' => 'El campo :attribute es obligatorio',

        ];

    }
}
