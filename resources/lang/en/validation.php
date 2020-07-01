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

    'accepted' => 'Le champs :attribute doit etre accepté.',
    'active_url'           => ':attribute url nest pas valide.',
    'after'                => 'Le champs :attribute doit etre date apres la :date.',
    'after_or_equal'       => 'Le champs :attribute doit être une date après ou égale à :date.',
    'alpha'                => 'Le champs :attribute ne peut contenir que des lettres.',
    'alpha_dash'           => 'Le champs :attribute ne peut contenir que des lettres, des chiffres, des tirets et des traits de soulignement.',
    'alpha_num'            => 'Le champs :attribute ne peut contenir que des lettres et des chiffres.',
    'array'                => 'Le champs :attribute doit être un tableau.',
    'before'               => 'Le champs :attribute doit être une date avant :date.',
    'before_or_equal'      => 'Le champs :attribute doit être une date antérieure ou égale à :date.',
    'between'              => [
        'numeric' => 'Le champs :attribute Doit être entre :min and :max.',
        'file'    => 'Le champs :attribute Doit être entre :min and :max kilobytes.',
        'string'  => 'Le champs :attribute Doit être entre :min and :max characters.',
        'array'   => 'Le champs :attribute doit avoir entre :min and :max items.',
    ],
    'boolean'              => 'Le champs :attribute doit être vrai ou faux.',
    'confirmed'            => 'Le champs :attribute la confirmation ne correspond pas.',
    'date'                 => 'Le champs :attribute  nest pas une date valide.',
    'date_format'          => 'Le champs :attribute ne correspond pas au format  :format.',
    'different'            => 'Le champs :attribute and :lautre doit être différent.',
    'digits'               => 'Le champs :attribute doit etre :digits digits.',
    'digits_between'       => 'Le champs :attribute Doit être entre:min and :max digits.',
    'dimensions'           => 'Le champs :attributea des dimensions dimage non valides.',
    'distinct'             => 'Le champs :attribute a une valeur en double.',
    'email'                => 'Le champs :attribute Doit être une adresse e-mail valide.',
    'exists'               => 'The selected :attribute est invalide.',
    'file'                 => 'Le champs :attribute doit etre un fichier.',
    'filled'               => 'Le champs :attribute doit avoir une valeur.',
    'gt'                   => [
        'numeric' => 'Le champs :attribute doit être supérieur à :value.',
        'file'    => 'Le champs :attribute doit être supérieur à :value kilobytes.',
        'string'  => 'Le champs :attribute doit être supérieur àn :value characters.',
        'array'   => 'Le champs :attribute doit avoir plus de:value items.',
    ],
    'gte'                  => [
        'numeric' => 'Le champs :attribute doit être supérieur ou égal :value.',
        'file'    => 'Le champs :attribute doit être supérieur ou égal :value kilobytes.',
        'string'  => 'Le champs :attribute doit être supérieur ou égal :value characters.',
        'array'   => 'Le champs :attribute doit avoir :value items or more.',
    ],
    'image'                => 'Le champs :attribute doi etre une image.',
    'in'                   => 'The selected :attribute est invalide.',
    'in_array'             => 'Le champs :attribute nexiste pas in :other.',
    'integer'              => 'Le champs :attribute doit etre un entier.',
    'ip'                   => 'Le champs :attribute doit être une adresse IP valide.',
    'ipv4'                 => 'Le champs :attributedoit être une adresse IPv4 valide.',
    'ipv6'                 => 'Le champs :attribute doit être une adresse IPv6 valide.',
    'json'                 => 'Le champs :attribut doit être une chaîne JSON valide.',
    'lt'                   => [
        'numeric' => 'Le champs :attributedoit être inférieur à :value.',
        'file'    => 'Le champs :attribute doit être inférieur à :value kilobytes.',
        'string'  => 'Le champs :attribute doit être inférieur à :value characters.',
        'array'   => 'Le champs :attribute doit avoir moins de :value items.',
    ],
    'lte'                  => [
        'numeric' => 'Le champs :attribute doit être inférieur ou égal :value.',
        'file'    => 'Le champs :attribute doit être inférieur ou égal :value kilobytes.',
        'string'  => 'Le champs :attribute doit être inférieur ou égal :value characters.',
        'array'   => 'Le champs :attribute ne doit pas avoir plus de :value items.',
    ],
    'max'                  => [
        'numeric' => 'Le champs :attribute peut ne pas être plus grand than :max.',
        'file'    => 'Le champs :attribute peut ne pas être plus grand :max kilobytes.',
        'string'  => 'Le champs :attribute peut ne pas être plus grand :max characters.',
        'array'   => 'Le champs :attribute peut ne pas être plus grand :max items.',
    ],
    'mimes'                => 'Le champs :attribute doit être un fichier de type: :values.',
    'mimetypes'            => 'Le champs :attribute doit être un fichier de type: :values.',
    'min'                  => [
        'numeric' => 'Le champs :attribute doit être au moins :min.',
        'file'    => 'Le champs :attribute doit être au moins :min kilobytes.',
        'string'  => 'Le champs :attribute doit être au moins :min characters.',
        'array'   => 'Le champs :attribute doit avoir au moins :min items.',
    ],
    'not_in'               => 'la selection de :attribute est invalide.',
    'not_regex'            => 'Le champs :attribute le format est invalide.',
    'numeric'              => 'Le champs :attribute doit être un nombre.',
    'present'              => 'le champ :attribute doit être présent.',
    'regex'                => 'Le champs :attribute le format est invalide.',
    'required'             => 'le champ :attribute est obligatoire.',
    'required_if'          => 'le champ :attribute est obligatoire :other is :value.',
    'required_unless'      => 'Le champs :attribute est obligatoire sauf si :other is in :values.',
    'required_with'        => 'Le champs :attribute est obligatoire lorsque :values is present.',
    'required_with_all'    => 'Le champs :attribute est obligatoire lorsque :values is present.',
    'required_without'     => 'Le champs :attribute est obligatoire lorsque :values is not present.',
    'required_without_all' => 'Le champs :attribute est requis lorsqu aucun :values est présent.',
    'same'                 => 'Le champs :attribute et :other doit correspondre.',
    'size'                 => [
        'numeric' => 'Le champs :attribute doit être :size.',
        'file'    => 'Le champs :attribute doit être :size kilobytes.',
        'string'  => 'Le champs :attribute doit être :size characters.',
        'array'   => 'Le champs :attribute doit contenir:size items.',
    ],
    'string'               => 'Le champs :attribute doit être une chaîne de caractere.',
    'timezone'             => 'Le champs :attribute doit être une zone valide.',
    'unique'               => 'Le champs :attribute a déjà été pris.',
    'uploaded'             => 'Le champs :attribute échec du téléchargement.',
    'url'                  => 'Le champs :attribute le format est invalide.',

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

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];

