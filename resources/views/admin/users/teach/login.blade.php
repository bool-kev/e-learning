@extends('base_bootstrap')
@section('content')
    <body class="container">
        <x-session key="success"></x-session>
        <x-session key="error" type="danger"></x-session>
        <h3 class="display-3">Connexion Enseignant</h3>
        <form class="form-floating gap-2" method="POST" action="{{route('login')}}">
            @csrf
            <div class="form-group my-3">
                <input type="text" class="form-control @error('matricule')is-invalid  @enderror" id="floatingInputInvalid1" placeholder="matricule"  name="matricule" value="{{old('matricule')}}">
                @error('matricule')
                    <label for="floatingInputInvalid1" class="text-danger">{{ $message }}</label>
                @enderror
            </div>
            <div class="form-group my-3">
                <input type="password" class="form-control @error('password')is-invalid  @enderror" id="password" placeholder="Mot de passe"  name="password">
                @error('password')
                    <label for="password" class="text-danger">{{ $message }}</label>
                @enderror
            </div>
            <input type="submit" value="Se connecter" class="btn btn-primary w-25">
          </form>
    </body>
@endsection