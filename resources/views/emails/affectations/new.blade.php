@component('mail::message')
# Nouvelle Affection

Bonjour.
Une nouvelle affectation de Matériels informatique a été programmé pour vous

## Liste du Matériels

@component('mail::panel')
    The information contained in this website is for general information purposes only. The information is provided by Gamesstation, while we endeavour to keep the information up to date and correct, we make no representations or warranties of any kind. Any reliance you place on such information is strictly at your own risk.
@endcomponent

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
