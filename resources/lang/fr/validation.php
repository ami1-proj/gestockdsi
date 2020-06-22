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

    'accepted' => 'le champ :attribute doit etre accepté.',
    'active_url'           => ':attribute url nest pas valide.',
    'after'                => 'lattribute doit etre date apres la :date.',
    'after_or_equal'       => 'le champ:attribute doit être une date après ou égale à :date.',
    'alpha'                => 'le champ :attribute ne peut contenir que des lettres.',
    'alpha_dash'           => 'le champ :attribute ne peut contenir que des lettres, des chiffres, des tirets et des traits de soulignement.',
    'alpha_num'            => 'le champ :attribute ne peut contenir que des lettres et des chiffres.',
    'array'                => 'le champ:attribute doit être un tableau.',
    'before'               => 'The :attribute doit être une date avant :date.',
    'before_or_equal'      => 'The :attribute doit être une date antérieure ou égale à :date.',
    'between'              => [
        'numeric' => 'la valeur de :attribute Doit être entre :min and :max.',
        'file'    => 'le fichier :attribute Doit être entre :min and :max kilobytes.',
        'string'  => 'le texte :attribute Doit être entre :min and :max characters.',
        'array'   => 'le tableau :attribute doit avoir entre :min and :max items.',
    ],
    'boolean'              => 'le champ :attribute le champ doit être vrai ou faux.',
    'confirmed'            => 'le champ :attribute la confirmation ne correspond pas.',
    'date'                 => 'le champ :attribute  nest pas une date valide.',
    'date_format'          => 'le champe :attribute ne correspond pas au format  :format.',
    'different'            => 'le champ :attribute and :lautre doit être différent.',
    'digits'               => 'le champ :attribute doit etre :digits digits.',
    'digits_between'       => 'le champ :attribute Doit être entre:min and :max digits.',
    'dimensions'           => 'le champ :attributea des dimensions dimage non valides.',
    'distinct'             => 'le champ :attribute le champ a une valeur en double.',
    'email'                => 'le champ :attribute Doit être une adresse e-mail valide.',
    'exists'               => 'le champ selected :attribute est invalide.',
    'file'                 => 'le champ :attribute doit etre un fichier.',
    'filled'               => 'le champ :attribute le champ doit avoir une valeur.',
    'gt'                   => [
        'numeric' => 'la valeur :attribute doit être supérieur à :value.',
        'file'    => 'le fichier :attribute doit être supérieur à :value kilobytes.',
        'string'  => 'le texte :attribute doit être supérieur àn :value characters.',
        'array'   => 'le tableau :attribute doit avoir plus de:value items.',
    ],
    'gte'                  => [
        'numeric' => 'la valeur :attribute doit être supérieur ou égal :value.',
        'file'    => 'le fichier :attribute doit être supérieur ou égal :value kilobytes.',
        'string'  => 'le texte :attribute doit être supérieur ou égal :value characters.',
        'array'   => 'le tableau :attribute doit avoir :value items or more.',
    ],
    'image'                => 'le champ :attribute doi etre une image.',
    'in'                   => 'le champ selected :attribute est invalide.',
    'in_array'             => 'le champ :attribute le champ nexiste pas in :other.',
    'integer'              => 'le champ :attribute doit etre un entier.',
    'ip'                   => 'le champ :attribute doit être une adresse IP valide.',
    'ipv4'                 => 'le champ :attributedoit être une adresse IPv4 valide.',
    'ipv6'                 => 'le champ :attribute doit être une adresse IPv6 valide.',
    'json'                 => 'le champ :attribut doit être une chaîne JSON valide.',
    'lt'                   => [
        'numeric' => 'la valeur :attributedoit être inférieur à :value.',
        'file'    => 'le fichier :attribute doit être inférieur à :value kilobytes.',
        'string'  => 'le texte :attribute doit être inférieur à :value characters.',
        'array'   => 'le tableau :attribute doit avoir moins de :value items.',
    ],
    'lte'                  => [
        'numeric' => 'la valeur :attribute doit être inférieur ou égal :value.',
        'file'    => 'le fichier :attribute doit être inférieur ou égal :value kilobytes.',
        'string'  => 'le texte :attribute doit être inférieur ou égal :value characters.',
        'array'   => 'le tableau :attribute ne doit pas avoir plus de :value items.',
    ],
    'max'                  => [
        'numeric' => 'la valeur :attribute peut ne pas être plus grand than :max.',
        'file'    => 'le fichier :attribute peut ne pas être plus grand :max kilobytes.',
        'string'  => 'le texte :attribute peut ne pas être plus grand :max characters.',
        'array'   => 'le tableau :attribute peut ne pas être plus grand :max items.',
    ],
    'mimes'  => 'le champ:attribute doit être un fichier de type: :values.',
    'mimetypes'=> 'le champ :attribute doit être un fichier de type: :values.',
    'min'                  => [
        'numeric' => 'la valeur :attribute doit être au moins :min.',
        'file'    => 'le fichier :attribute doit être au moins :min kilobytes.',
        'string'  => 'le texte  :attribute doit être au moins :min characters.',
        'array'   => 'le tableau :attribute doit avoir au moins :min items.',
    ],
    'not_in'               => 'la selection de :attribute est invalide.',
    'not_regex'            => 'le champ :attribute le format est invalide.',
    'numeric'              => 'la valeur :attribute doit être un nombre.',
    'present'              => 'le champ :attribute le champ doit être présent.',
    'regex'                => 'le champ :attribute le format est invalide.',
    'required'             => 'le champ :attribute le champ est obligatoire.',
    'required_if'          => 'le champ:attribute le champ est obligatoire :other is :value.',
    'required_unless'      => 'le champ :attribute Ce champ est obligatoire sauf si :other is in :values.',
    'required_with'        => 'le champ :attribute champ est obligatoire lorsque :values is present.',
    'required_with_all'    => 'le champ :attribute champ est obligatoire lorsque :values is present.',
    'required_without'     => 'le champ :attribute champ est obligatoire lorsque :values is not present.',
    'required_without_all' => 'le champ :attribute Ce champ est requis lorsquaucun des :values are present.',
    'same'                 => 'le champ :attribute et :other doit correspondre.',
    'size'                 => [
        'numeric' => 'la valeur :attribute doit être :size.',
        'file'    => 'le fichier:attribute doit être :size kilobytes.',
        'string'  => 'le texte:attribute doit être :size characters.',
        'array'   => 'le tableau:attribute doit contenir:size items.',
    ],
    'string'               => 'le texte:attribute doit être une chaîne de caractere.',
    'timezone'             => 'le champ :attribute doit être une zone valide.',
    'unique'               => 'la valeur du champ a déjà été utilisé.',
    'uploaded'             => 'le champ:attribute échec du téléchargement.',
    'url'                  => 'le format de l’url est invalide.',

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

