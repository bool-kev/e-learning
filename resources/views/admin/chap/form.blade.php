<x-admin  :matiere="$chap->matiere">
    {{-- @dd($chap->id) --}}
    <div class="container">
        <x-session type="danger" key="error"></x-session>
        <x-session type="success" key="success"></x-session>
        <h1 class="diplay-3 my-4">{{$chap->id?'Modifier le chapitre':'Enregistrer un nouvel chapitre'}}</h1>
        <form action="" method="post" class="mt-md-5">
            @csrf
            <div class="form-group col-md-10">
                <input type="text" class="form-control fs-4 fw-bold fst-italic @error('titre')is-invalid  @enderror" id="floatingInputInvalid1"
                    placeholder="titre..." value="{{ old('titre',$chap->titre) }}" name="titre">
                @error('titre')
                    <label for="floatingInputInvalid1" class="text-danger">{{ $message }}</label>
                @enderror
            </div> 
            <button class="btn btn-primary ms-3 ">{{$chap->id?'Mettre a jour':'Creer'}}</button>
            <a class="btn btn-info" href="/admin">retour</a>
        </form>
    </div>
</x-admin>
