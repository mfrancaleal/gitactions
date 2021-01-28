<?php

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;
use Illuminate\Validation\Rule;

class AuthorUpdateInputValidator extends Validator
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
                Rule::unique('authors', 'name')->ignore($this->arg('id'), 'id'),
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
