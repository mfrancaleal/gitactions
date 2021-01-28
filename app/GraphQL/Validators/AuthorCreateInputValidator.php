<?php

namespace App\GraphQL\Validators;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Validation\Validator;

class AuthorCreateInputValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                Rule::unique('authors', 'name'),
            ],
            'nationality' => [
                'required',
                'min:5'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'nationality.min' => 'O campo Nacionalidade deve conter no mínimo 5 caracteres.',
            'nationality.required' => 'O campo Nacionalidade é obrigatório.',
            'name.unique' => 'Author já cadastrado'
        ];
    }
}
