<x-mail::message>
# Verification de votre email

Bonjour **{{$user->prenom}} {{$user->nom}}** <br>
voici votre code OTP veuillez verifier dans les 5 minutes  qui suivent


<x-mail::layout># {{implode("  ",str_split($user->eleve->token))}}</x-mail::layout>
<x-mail::button url="{{route('user.otp.form')}}">verifier</x-mail::button>
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
