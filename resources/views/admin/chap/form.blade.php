<x-admin-base :facultes="$facultes">
    <div class="container">
        <h1 class="diplay-3 my-4">{{$chap->id?'Modifier le chapitre':'Enregistrer un nouvel chapitre'}}</h1>
        <form action="" method="post" class="mt-md-5">
            <div class="row">
                <div class="form-group col-md-8">
                    <input type="text" class="form-control @error('libelle')is-invalid  @enderror" id="floatingInputInvalid1"
                        placeholder="libelle..." value="{{ old('libelle') }}" name="libelle">
                    @error('libelle')
                        <label for="floatingInputInvalid1" class="text-danger">{{ $message }}</label>
                    @enderror
                </div>
                <div class="col-md-4">
                    <button class="btn btn-primary">{{$chap->id?'Mettre a jour':'Creer'}}</button>
                    <a class="btn btn-info" href="/admin">retour</a>
                </div>
            </div>
        </form>
    </div>
</x-admin-base>
