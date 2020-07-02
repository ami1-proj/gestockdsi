@component('mail::message')
    # Nouvelle Affection de Matériels informatique

    <p>
        Bonjour.
    </p>
    <p>
        Une nouvelle affectation de Matériels informatique a été programmée pour {{ beneficiaire->denomination ?? '' }}.
    </p>
    <p>
        <u>Objet:</u> <strong>{{ $affectation->objet  }}</strong>
    </p>

    ## Liste de Matériels
    @component('mail::table')
        | Type      | Référence     | Marque    |
        |:--------- |:------------- |:--------- |
        @foreach($articles as $atc)
            | {{$atc->typeArticle->libelle}}     | {{$atc->reference}} |        {{$atc->marqueArticle->nom}} |
        @endforeach
    @endcomponent

    @component('mail::button', ['url' => $ficheretour_url])
        Enregistrer Fiche Retour
    @endcomponent

    Cordialement,<br>
    {{ config('app.name') }}
@endcomponent
