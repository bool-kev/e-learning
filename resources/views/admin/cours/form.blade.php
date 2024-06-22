<x-admin-base >
    {{-- @dd($chap->id) --}}
    <div class="container">
        <x-session type="danger" key="error"></x-session>
        <x-session type="success" key="success"></x-session>
        <h1 class="diplay-3 my-4">{{$cours->id?'Modifier le chapitre':'Enregistrer un nouvel chapitre'}}</h1>
        <form action="" method="post" class="mt-md-5">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control  @error('titre')is-invalid  @enderror" id="floatingInputInvalid1"
                    placeholder="titre..." value="{{ old('titre',$cours->titre) }}" name="titre">
                @error('titre')
                    <label for="floatingInputInvalid1" class="text-danger">{{ $message }}</label>
                @enderror
            </div> 
            <div class="form-group">
                <textarea class="form-control  @error('description')is-invalid  @enderror" id="description"
                    placeholder="Description du cours"  name="titre">{{ old('titre',$cours->titre) }}</textarea>
                @error('description')
                    <label for="description" class="text-danger">{{ $message }}</label>
                @enderror
            </div> 
            <div class="form-group">
                <textarea class="form-control  @error('content')is-invalid  @enderror" id="content"
                    placeholder="content du cours"  name="titre">{{ old('titre',$cours->titre) }}</textarea>
                @error('content')
                    <label for="content" class="text-danger">{{ $message }}</label>
                @enderror
            </div> 
            <div class="quill-editor-default">
                <p>Hello World!</p>
                <p>This is Quill <strong>default</strong> editor</p>
            </div>
            <button class="btn btn-primary ms-3 ">{{$cours->id?'Mettre a jour':'Creer'}}</button>
            <a class="btn btn-info" href="/admin">retour</a>
        </form>
    </div>
</x-admin-base>
