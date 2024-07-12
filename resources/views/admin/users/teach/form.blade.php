<x-admin>
    <x-session key="error" type="danger"></x-session>
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">{{!$user->id?'Enregistrer un enseignat':'Mis a jour enseignant'}}</h5>
                  </div>

                  <form class="row g-3 needs-validation" method="POST">
                    @csrf
                    <div class="form-group my-3">
                        <input type="text" class="form-control p-3  @error('matricule')is-invalid  @enderror" id="matricule" placeholder="matricule"  name="matricule" value="{{old('matricule',$user->matricule)}}">
                        @error('matricule')
                            <label for="matricule" class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <input type="text" class="form-control p-3  @error('nom')is-invalid  @enderror" id="nom" placeholder="nom"  name="nom" value="{{old('nom',$user->nom)}}">
                        @error('nom')
                            <label for="nom" class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <input type="text" class="form-control p-3  @error('prenom')is-invalid  @enderror" id="prenom" placeholder="prenom"  name="prenom" value="{{old('prenom',$user->prenom)}}">
                        @error('prenom')
                            <label for="prenom" class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <input type="text" class="form-control p-3  @error('email')is-invalid  @enderror" id="email" placeholder="email"  name="email" value="{{old('email',$user->email)}}">
                        @error('email')
                            <label for="email" class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    @if (! $user->id)
                    <div class="form-group my-3">
                        <input type="password" class="form-control p-3  @error('password')is-invalid  @enderror" id="floatingInputInvalid2" placeholder="Mot de passe"  name="password">
                        @error('password')
                            <label for="floatingInputInvalid2" class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <input type="password" class="form-control p-3  @error('password_confirmation')is-invalid  @enderror" id="floatingInputInvalid2" placeholder="Confirmation de mot de passe"  name="password_confirmation">
                        @error('password_confirmation')
                            <label for="floatingInputInvalid2" class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    @endif
                    <input type="submit" value="{{$user->id?'modifier':'Enregistrer'}}" class="btn btn-primary ">
                    <a href="{{route('admin.enseignant.index')}}" class="btn btn-info w-100">Retour</a>
                   </div>
                  </form>

                </div>
              </div>
            </div>
          </div>

      </section>
</x-admin>