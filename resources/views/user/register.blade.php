@extends('base_bootstrap')
@section('content')
    <body class="container">
        <x-session key="success"></x-session>
        <x-session key="error" type="danger"></x-session>
        <h3 class="display-3">Inscripton</h3>
        <form class="form-floating gap-2" method="POST" action="{{route('user.register')}}">
            @csrf
            <div class="row">
                <div class="form-group my-3 col-6">
                    <input type="text" class="form-control p-3 fs-4 @error('nom')is-invalid  @enderror" id="floatingInputInvalid1" placeholder="nom"  name="nom" value="{{old('nom')}}">
                    @error('nom')
                        <label for="floatingInputInvalid1" class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group my-3 col-6">
                    <input type="text" class="form-control p-3 fs-4 @error('prenom')is-invalid  @enderror" id="floatingInputInvalid1" placeholder="prenom"  name="prenom" value="{{old('prenom')}}">
                    @error('prenom')
                        <label for="floatingInputInvalid1" class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group my-3 col-6">
                    <input type="text" class="form-control p-3 fs-4 @error('telephone')is-invalid  @enderror" id="floatingInputInvalid1" placeholder="telephone"  name="telephone" value="{{old('telephone')}}">
                    @error('telephone')
                        <label for="floatingInputInvalid1" class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group my-3 col-6">
                    <select  class="form-control p-3 fs-4 @error('niveau')is-invalid  @enderror" id="niveau"  name="niveau">  
                        <option value="">Niveau</option>
                        @foreach ($niveaux as $niveau)
                            <option value="{{$niveau->id}}">{{ $niveau->libelle }}</option>
                        @endforeach
                    </select>
                    @error('niveau')
                        <label for="floatingInputInvalid4" class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <input type="email" class="form-control p-3 fs-4 @error('email')is-invalid  @enderror" id="floatingInputInvalid1" placeholder="email"  name="email" value="{{old('email')}}">
                    @error('email')
                        <label for="floatingInputInvalid1" class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <input type="password" class="form-control p-3 fs-4 @error('password')is-invalid  @enderror" id="floatingInputInvalid2" placeholder="Mot de passe"  name="password">
                    @error('password')
                        <label for="floatingInputInvalid2" class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <input type="password" class="form-control p-3 fs-4 @error('password_confirmation')is-invalid  @enderror" id="floatingInputInvalid2" placeholder="Confirmation de mot de passe"  name="password_confirmation">
                    @error('password_confirmation')
                        <label for="floatingInputInvalid2" class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
            </div>
            <p class="mt-2 text-center">Vous avez deja un compte? <a href="{{route('user.login.form')}}">Se connecter</a></p>
            <input type="submit" value="Sign UP" class="btn btn-primary w-100 fs-4">
            {{-- <a href="{{route('blog.index')}}" class="btn btn-info w-25">Retour</a> --}}
          </form>
    </body>
    
@endsection