<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
     */

    'accepted'             => 'O campo :attribute deve ser aceito.',
    'active_url'           => 'O valor de :attribute não é uma URL válida.',
    'after'                => 'O valor de :attribute deve ser uma data posterior a :date.',
    'after_or_equal'       => 'O valor de :attribute deve ser uma data posterior ou igual a :date.',
    'alpha'                => 'O campo :attribute deve conter apenas letras.',
    'alpha_dash'           => 'O campo :attribute deve conter apenas letras, números, e traços.',
    'alpha_num'            => 'O campo :attribute deve conter apenas letras e números.',
    'array'                => 'O valor de :attribute deve ser um array.',
    'before'               => 'O valor de :attribute deve ser uma data anterior a :date.',
    'before_or_equal'      => 'O valor de :attribute deve ser uma data anterior ou igual a :date.',
    'between'              => [
        'numeric' => 'O valor de :attribute deve ser entre :min e :max.',
        'file'    => 'O tamanho de :attribute deve ser entre :min e :max kbytes.',
        'string'  => 'O valor de :attribute deve ter entre :min e :max caracteres.',
        'array'   => 'O array :attribute deve conter entre :min e :max items.'
    ],
    'boolean'              => 'O valor de :attribute deve ser true ou false.',
    'confirmed'            => 'A confirmação de :attribute não corresponde.',
    'date'                 => 'O valor de :attribute não é uma data válida.',
    'date_equals'          => 'O valor de :attribute deve ser uma data igual a :date.',
    'date_format'          => 'O valor de :attribute não corresponde ao formato :format.',
    'different'            => 'O valor de :attribute e :other devem ser diferentes.',
    'digits'               => 'O valor de :attribute deve conter :digits dígitos.',
    'digits_between'       => 'O valor de :attribute deve conter entre :min e :max dígitos.',
    'dimensions'           => 'A imagem :attribute contém dimensões inválidas.',
    'distinct'             => 'O campo :attribute contém um valor duplicado.',
    'email'                => 'O valor de :attribute deve ser um e-mail válido.',
    'exists'               => 'O valor selecionado de :attribute é inválido.',
    'file'                 => 'O valor de :attribute deve ser um arquivo.',
    'filled'               => 'O campo :attribute deve ser preenchido.',
    'gt'                   => [
        'numeric' => 'O valor de :attribute deve ser maior que :value.',
        'file'    => 'O valor de :attribute deve ser maior que :value kilobytes.',
        'string'  => 'O valor de :attribute deve ser maior que :value characters.',
        'array'   => 'O valor de :attribute deve ser maior que :value items.'
    ],
    'gte'                  => [
        'numeric' => 'O valor de :attribute deve ser maior ou igual a :value.',
        'file'    => 'O valor de :attribute deve ser maior ou igual a :value kilobytes.',
        'string'  => 'O valor de :attribute deve ser maior ou igual a :value caracteres.',
        'array'   => 'O valor de :attribute deve ter mais que :value items ou mais.'
    ],
    'image'                => 'O valor de :attribute deve ser uma imagem.',
    'in'                   => 'O valor de :attribute é inválido.',
    'in_array'             => 'O campo :attribute não existe em :other.',
    'integer'              => 'O valor de :attribute deve ser um número inteiro.',
    'ip'                   => 'O valor de :attribute deve ser um endereço IP válido.',
    'ipv4'                 => 'O valor de :attribute deve ser um endereço IPv4 válido.',
    'ipv6'                 => 'O valor de :attribute deve ser um endereço IPv6 válido.',
    'json'                 => 'O valor de :attribute deve ser uma string válida de JSON.',
    'lt'                   => [
        'numeric' => 'O valor de :attribute deve ser menor que :value.',
        'file'    => 'O valor de :attribute deve ser menor que :value kilobytes.',
        'string'  => 'O valor de :attribute deve ser menor que :value characters.',
        'array'   => 'O valor de :attribute deve ser menor que :value items.'
    ],
    'lte'                  => [
        'numeric' => 'O valor de :attribute deve ser menor ou igual a :value.',
        'file'    => 'O valor de :attribute deve ser menor ou igual a :value kilobytes.',
        'string'  => 'O valor de :attribute deve ser menor ou igual a :value characters.',
        'array'   => 'O valor de :attribute nao deve conter mais que :value items.'
    ],
    'max'                  => [
        'numeric' => 'O valor de :attribute não deve ser maior que :max.',
        'file'    => 'O arquivo :attribute não deve ser maior que :max kbytes.',
        'string'  => 'O valor de :attribute não deve conter mais que :max caracteres.',
        'array'   => 'O array :attribute não deve ter mais que :max itens.'
    ],
    'mimes'                => 'O valor de :attribute deve ser um arquivo do tipo: :values.',
    'mimetypes'            => 'O valor de :attribute deve ser um arquivo do tipo: :values.',
    'min'                  => [
        'numeric' => 'O valor de :attribute deve ser de no mínimo :min.',
        'file'    => 'O arquivo :attribute deve conter no mínimo :min kbytes.',
        'string'  => 'O valor de :attribute deve conter no mínimo :min caracteres.',
        'array'   => 'O array :attribute deve conter no mínimo :min itens.'
    ],
    'not_in'               => 'O valor selecionado para :attribute é inválido.',
    'not_regex'            => 'O formato de :attribute é inválido.',
    'numeric'              => 'O valor de :attribute deve ser um número.',
    'present'              => 'O campo :attribute deve estar presente.',
    'regex'                => 'O formato de :attribute é inválido.',
    'required'             => 'O campo :attribute é obrigatório.',
    'required_if'          => 'O campo :attribute é requerido quando :other é :value.',
    'required_unless'      => 'O campo :attribute é requerido a menos que :other seja :values.',
    'required_with'        => 'O campo :attribute é requerido quando :values está presente.',
    'required_with_all'    => 'O campo :attribute é requerido quando :values estão presentes.',
    'required_without'     => 'O campo :attribute é requerido quando :values não está presente.',
    'required_without_all' => 'O campo :attribute é requerido quando nenhum :values está presente.',
    'same'                 => 'O valor de :attribute e :other devem ser idênticos.',
    'size'                 => [
        'numeric' => 'O valor de :attribute deve ser de :size.',
        'file'    => 'O arquivo :attribute deve ser de :size kbytes.',
        'string'  => 'O valor de :attribute deve conter :size caracteres.',
        'array'   => 'O array :attribute deve conter :size itens.'
    ],
    'starts_with'          => 'O valor de :attribute deve começar com um dos seguintes valores: :values.',
    'string'               => 'O valor de :attribute deve ser uma string.',
    'timezone'             => 'O valor de :attribute deve ser uma timezone válida.',
    'unique'               => 'O valor de :attribute já está sendo utilizado.',
    'uploaded'             => 'O upload de :attribute falhou.',
    'url'                  => 'O formato da URL :attribute é inválido.',
    'uuid'                 => 'O valor de :attribute deve ser um UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
     */

    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
     */

    'attributes'           => []

];
