@extends('base_bootstrap')
@section('content')
    <body class="container">
        <x-session key="success"></x-session>
        <x-session key="error" type="danger"></x-session>
        <h3 class="display-3">Connexion Admin</h3>
        <form class="form-floating gap-2" method="POST" action="{{route('admin.login')}}">
            @csrf
            <div class="form-group my-3">
                <input type="email" class="form-control @error('email')is-invalid  @enderror" id="floatingInputInvalid1" placeholder="email"  name="email" value="{{old('email')}}">
                @error('email')
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