@extends('base_bootstrap')
@section('content')
    <body class="container">
        <x-session key="success"></x-session>
        <x-session key="error" type="danger"></x-session>
        <h3 class="display-3">Connexion</h3>
        <form class="form-floating gap-2" method="POST" action="{{route('user.login')}}">
            @csrf
            <div class="form-group my-3">
                <input type="email" class="form-control @error('email')is-invalid  @enderror" id="floatingInputInvalid1" placeholder="email"  name="email" value="{{old('email')}}">
                @error('email')
                    <label for="floatingInputInvalid1" class="text-danger">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group my-3">
                <input type="password" class="form-control @error('password')is-invalid  @enderror" id="floatingInputInvalid2" placeholder="Mot de passe"  name="password">
                @error('password')
                    <label for="floatingInputInvalid2" class="text-danger">{{ $message }}</label>
                @enderror
            </div>
            <p class="mt-2 ms-2">Vous etes nouveau? <a href="{{route('user.register')}}">Creer un compte</a></p>
            <input type="submit" value="Se connecter" class="btn btn-primary w-25">
            {{-- <a href="{{route('blog.index')}}" class="btn btn-info w-25">Retour</a> --}}
          </form>
    </body>
@endsection