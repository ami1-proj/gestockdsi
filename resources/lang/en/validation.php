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

    'accepted' => 'The :attribute doit etre accepté.',
    'active_url'           => ':attribute url nest pas valide.',
    'after'                => 'The :attribute doit etre date apres la :date.',
    'after_or_equal'       => 'The :attribute doit être une date après ou égale à :date.',
    'alpha'                => 'The :attribute ne peut contenir que des lettres.',
    'alpha_dash'           => 'The :attribute ne peut contenir que des lettres, des chiffres, des tirets et des traits de soulignement.',
    'alpha_num'            => 'The :attribute ne peut contenir que des lettres et des chiffres.',
    'array'                => 'The :attribute doit être un tableau.',
    'before'               => 'The :attribute doit être une date avant :date.',
    'before_or_equal'      => 'The :attribute doit être une date antérieure ou égale à :date.',
    'between'              => [
        'numeric' => 'The :attribute Doit être entre :min and :max.',
        'file'    => 'The :attribute Doit être entre :min and :max kilobytes.',
        'string'  => 'The :attribute Doit être entre :min and :max characters.',
        'array'   => 'The :attribute doit avoir entre :min and :max items.',
    ],
    'boolean'              => 'The :attribute le champ doit être vrai ou faux.',
    'confirmed'            => 'The :attribute la confirmation ne correspond pas.',
    'date'                 => 'The :attribute  nest pas une date valide.',
    'date_format'          => 'The :attribute ne correspond pas au format  :format.',
    'different'            => 'The :attribute and :lautre doit être différent.',
    'digits'               => 'The :attribute doit etre :digits digits.',
    'digits_between'       => 'The :attribute Doit être entre:min and :max digits.',
    'dimensions'           => 'The :attributea des dimensions dimage non valides.',
    'distinct'             => 'The :attribute le champ a une valeur en double.',
    'email'                => 'The :attribute Doit être une adresse e-mail valide.',
    'exists'               => 'The selected :attribute est invalide.',
    'file'                 => 'The :attribute doit etre un fichier.',
    'filled'               => 'The :attribute le champ doit avoir une valeur.',
    'gt'                   => [
        'numeric' => 'The :attribute doit être supérieur à :value.',
        'file'    => 'The :attribute doit être supérieur à :value kilobytes.',
        'string'  => 'The :attribute doit être supérieur àn :value characters.',
        'array'   => 'The :attribute doit avoir plus de:value items.',
    ],
    'gte'                  => [
        'numeric' => 'The :attribute doit être supérieur ou égal :value.',
        'file'    => 'The :attribute doit être supérieur ou égal :value kilobytes.',
        'string'  => 'The :attribute doit être supérieur ou égal :value characters.',
        'array'   => 'The :attribute doit avoir :value items or more.',
    ],
    'image'                => 'The :attribute doi etre une image.',
    'in'                   => 'The selected :attribute est invalide.',
    'in_array'             => 'The :attribute le champ nexiste pas in :other.',
    'integer'              => 'The :attribute doit etre un entier.',
    'ip'                   => 'The :attribute doit être une adresse IP valide.',
    'ipv4'                 => 'The :attributedoit être une adresse IPv4 valide.',
    'ipv6'                 => 'The :attribute doit être une adresse IPv6 valide.',
    'json'                 => 'The :attribut doit être une chaîne JSON valide.',
    'lt'                   => [
        'numeric' => 'The :attributedoit être inférieur à :value.',
        'file'    => 'The :attribute doit être inférieur à :value kilobytes.',
        'string'  => 'The :attribute doit être inférieur à :value characters.',
        'array'   => 'The :attribute doit avoir moins de :value items.',
    ],
    'lte'                  => [
        'numeric' => 'The :attribute doit être inférieur ou égal :value.',
        'file'    => 'The :attribute doit être inférieur ou égal :value kilobytes.',
        'string'  => 'The :attribute doit être inférieur ou égal :value characters.',
        'array'   => 'The :attribute ne doit pas avoir plus de :value items.',
    ],
    'max'                  => [
        'numeric' => 'The :attribute peut ne pas être plus grand than :max.',
        'file'    => 'The :attribute peut ne pas être plus grand :max kilobytes.',
        'string'  => 'The :attribute peut ne pas être plus grand :max characters.',
        'array'   => 'The :attribute peut ne pas être plus grand :max items.',
    ],
    'mimes'                => 'The :attribute doit être un fichier de type: :values.',
    'mimetypes'            => 'The :attribute doit être un fichier de type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute doit être au moins :min.',
        'file'    => 'The :attribute doit être au moins :min kilobytes.',
        'string'  => 'The :attribute doit être au moins :min characters.',
        'array'   => 'The :attribute doit avoir au moins :min items.',
    ],
    'not_in'               => 'la selection de :attribute est invalide.',
    'not_regex'            => 'The :attribute le format est invalide.',
    'numeric'              => 'The :attribute doit être un nombre.',
    'present'              => 'The :attribute le champ doit être présent.',
    'regex'                => 'The :attribute le format est invalide.',
    'required'             => 'The :attribute le champ est obligatoire.',
    'required_if'          => 'The :attribute le champ est obligatoire :other is :value.',
    'required_unless'      => 'The :attribute Ce champ est obligatoire sauf si :other is in :values.',
    'required_with'        => 'The :attribute champ est obligatoire lorsque :values is present.',
    'required_with_all'    => 'The :attribute champ est obligatoire lorsque :values is present.',
    'required_without'     => 'The :attribute champ est obligatoire lorsque :values is not present.',
    'required_without_all' => 'The :attribute Ce champ est requis lorsquaucun des :values are present.',
    'same'                 => 'The :attribute et :other doit correspondre.',
    'size'                 => [
        'numeric' => 'The :attribute doit être :size.',
        'file'    => 'The :attribute doit être :size kilobytes.',
        'string'  => 'The :attribute doit être :size characters.',
        'array'   => 'The :attribute doit contenir:size items.',
    ],
    'string'               => 'The :attribute doit être une chaîne de caractere.',
    'timezone'             => 'The :attribute doit être une zone valide.',
    'unique'               => 'The :attribute a déjà été pris.',
    'uploaded'             => 'The :attribute échec du téléchargement.',
    'url'                  => 'The :attribute le format est invalide.',

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

