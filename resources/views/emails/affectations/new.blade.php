@component('mail::message')
# Nouvelle Affection de Matériels informatique

<p>
    Bonjour.
</p>
<p>
    Une nouvelle affectation de Matériels informatique a été programmé pour vous
</p>
<p>
    Objet: <strong>{{ $affectation->objet  }}</strong>
</p>

## Liste de Matériels
@component('mail::table')
    | Type      | Référence     | Marque    |
    |:--------- |:------------- |:--------- |
    @foreach($articles as $atc)
        | {{$atc->typeArticle->libelle}}     | {{$atc->reference}} |        {{$atc->marqueArticle->nom}} |
    @endforeach
@endcomponent

@component('mail::panel')
    The information contained in this website is for general information purposes only. The information is provided by Gamesstation, while we endeavour to keep the information up to date and correct, we make no representations or warranties of any kind. Any reliance you place on such information is strictly at your own risk.
@endcomponent

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
