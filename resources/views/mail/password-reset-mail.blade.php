<x-mail::message>
# Lien de renitialisation de mot de passe

Bonjour **{{$user->prenom}} {{$user->nom}}** <br>
cliquez  ici pour renitialiser votre mot de passe.

<x-mail::button :url="route('user.request.check',$token)">
Renitialiser mon mot de passe
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
