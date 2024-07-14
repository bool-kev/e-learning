<x-admin  :matiere="$matiere">
    {{-- @dd($cours->files->count()) --}}
    <div class="container">
        <x-session type="danger" key="error"></x-session>
        <x-session type="success" key="success"></x-session>
        <div id="cover2"></div>
        <h1 class="diplay-3 my-4">{{ $cours->id ? 'Modifier le chapitre' : 'Enregistrer un nouvel chapitre' }}</h1>
        <form action="" method="post" class="" id="form" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-10 mt-5">
                    <div class="form-group">
                        <label for="titre" class="form-label text-black">Titre du cours</label>
                        <input type="text" class="form-control  @error('titre')is-invalid  @enderror" id="titre"
                            placeholder="titre..." value="{{ old('titre', $cours->titre) }}" name="titre">
                        @error('titre')
                            <label for="titre" class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="description" class="form-label text-black">Description du cours</label>
                        <textarea class="form-control  @error('description')is-invalid  @enderror" id="description"
                            placeholder="Description du cours" name="description">{{ old('description', $cours->description) }}</textarea>
                        @error('description')
                            <label for="description" class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group">
                        <!-- Include stylesheet -->
                        {{-- <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" /> --}}
                        @vite('resources/backend/css/quill.snow.css')

                        <!-- Create the editor container -->
                        <label for="editor" class="form-label">Contenu</label>
                        <textarea name="content" cols="30" rows="10" class="d-none" id="name"></textarea>
                        <div id="editor" class="mb-3" style="height: 100px">
                            {{-- content  --}}
                            {!! $cours->content !!}
                        </div>
                        @error('content')
                            <label for="" class="text-danger">{{ $message }}</label>
                        @enderror


                        <!-- Include the Quill library -->
                        {{-- <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script> --}}
                        @vite('resources/backend/js/quill.js')

                        <!-- Initialize Quill editor -->
                        <script>
                            window.addEventListener('load', (e) => {
                                const quill = new Quill('#editor', {
                                    theme: 'snow'
                                });
                            });
                            document.querySelector('#form')?.addEventListener('submit', (e) => {
                                document.querySelector('#name').value = document.querySelector('.ql-editor').innerHTML;
                                if (document.getElementById('files').files.length > 5) {
                                    alert('vous ne pouvez pas choisir plus de 5 fichiers');
                                    document.getElementById('files').value = '';
                                    e.preventDefault();
                                }
                            });
                        </script>
                    </div>
                    
                </div>
                <div class="col-md-2">
                    <label for="cover" class="form-label">Cover</label>
                    @if ($cours->cover)
                        <div class="card mb-2" id="card">
                            <img src="{{ $cours->getCover() }}" alt="" class="img-card mb-1"
                                style="width: 100%;height: 100px; object-fit: cover">
                            <button class="btn btn-danger w-100"
                                hx-post="{{ route('admin.cours.cover.delete', $cours) }}" hx-swap="outerHTML"
                                hx-target="#cover2">Supprimer</button>
                        </div>
                    @endif
                    <div class="form-group my-2">
                        <input type="file" class="form-control" name="cover" id="cover">
                        @error('cover')
                            <label for="cover" class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <hr>
                    <label for="files" class="form-label">Fichiers joint au cours</label>
                    @if ($cours->files->count())
                        <div class="fichier" style="overflow: auto;height: 200px;" >
                            @foreach ($cours->files as $fichier)
                                <div class="card mb-2" id="file-{{$fichier->id}}">
                                    <img src="{{ $fichier->getPreview() }}" alt="" class="img-card mb-1"
                                        style="width: 100%;height: 100px; object-fit: cover">
                                        <button class="btn btn-danger w-100"
                                        hx-post="{{ route('admin.cours.file.delete', $fichier) }}" hx-swap="outerHTML"
                                        hx-target="#cover2">Supprimer</button>
                                </div>
                            @endforeach
                        </div>
                    @endif
                    <div class="form-group my-md-4">
                        <input type="file" class="form-control" name="files[]" id="files" multiple>
                        @error('files')
                            <label for="vendu" class="text-danger">{{ $message }}</label>
                        @enderror
                        @error('files.*')
                            <label for="files" class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>
            <button class="btn btn-primary ms-3 ">{{ $cours->id ? 'Mettre a jour' : 'Creer' }}</button>
            <a class="btn btn-info" onclick="history.back()">retour</a>
            @vite('resources/backend/js/htmx.min.js')
        </form>
    </div>
</x-admin>
