@extends('base_bootstrap')
@section('content')
    <body>
        <div class="container">
            <p class="display-3">Definir un nouveau mot de passe</p>
            <form action="{{route('user.newPassword')}}" method="post">
                @csrf
                <div class="form-group my-3">
                    <input type="text" class="form-control p-3 @error('nom')is-invalid  @enderror" id="floatingInputInvalid1" placeholder="mot de passe"  name="password" >
                    @error('password')
                        <label for="floatingInputInvalid1" class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                <div class="form-group my-3">
                    <input type="password" class="form-control p-3 @error('password_confirmation')is-invalid  @enderror" id="floatingInputInvalid2" placeholder="confirmation de mot de passe"  name="password_confirmation" >
                    @error('password_confirmation')
                        <label for="floatingInputInvalid2" class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                <input type="submit" value="Mettre a jour" class="btn btn-primary">
            </form>
        </div>
    </body>
@endsection