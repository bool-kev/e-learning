{{-- @dd() --}}
<x-admin :matiere="$matiere">

    <hr>
    <x-session key="success"></x-session>
    <x-session key="error" type="danger"></x-session>
    <div class="label d-flex justify-content-around ">

        <div class="col-lg-8">
            <ul class="nav nav-pills d-inline-flex text-center mb-1 ">
                <li class="nav-item">
                    <a class="d-flex m-2 py-2 bg-light rounded-pill link-underline link-underline-opacity-0 @if( request()->tab!=='eval')active @endif"
                        data-bs-toggle="pill" href="#tab-1">
                        <span class="text-dark" style="width: 130px;">Cours</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex py-2 m-2 bg-light rounded-pill link-underline link-underline-opacity-0 @if(request()->tab==='eval')active @endif"
                        data-bs-toggle="pill" href="#tab-2">
                        <span class="text-dark" style="width: 130px;" id="eval">Evaluations</span>
                    </a>
                    <script>
                        document.getElementById('eval').addEventListener('click',(e)=>{
                            url=document.location.href+"?tab=eval";
                            history.replaceState('','',url);
                        })
                    </script>
                </li>
                {{-- <li class="nav-item">
                    <a class="d-flex m-2 py-2 bg-light rounded-pill link-underline link-underline-opacity-0"
                        data-bs-toggle="pill" href="#tab-3">
                        <span class="text-dark" style="width: 130px;">Exercices</span>
                    </a>
                </li> --}}

            </ul>
        </div>
    </div>
    <div class="tab-content">
        <div id="tab-1" class="tab-pane fade  p-0 @if(request()->tab!=='eval')show active @endif">
            <!---kill --->
            <hr>
            <div class="d-flex justify-content-around">
                <h3 class="fst-italic">Chapitres</h3>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#Modalcreate">
                    <i class="bi bi-folder-plus"></i>
                    Ajouter
                  </button>
            </div>
            @if ($matiere->chapitres->count())
                <table class="table table-striped table-hover mt-3">
                    <thead>
                        <tr>
                            <th scope="col">#id</th>
                            <th scope="col">intitule</th>
                            <th scope="col" class="text-end">action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        {{-- @dd($current->matiere($current_level->id)->chapitres) --}}
                        @foreach ($matiere->chapitres as $chapitre)
                            <tr>
                                <th scope="row">{{ $chapitre->id }}</th>
                                <td class=""><a
                                        href="{{ route('admin.cours.index', ['slug' => Str::slug($chapitre->titre), 'chapitre' => $chapitre]) }}">{{ $chapitre->titre }}</a>
                                </td>
                                <td class="pe-0 w-25">
                                    <div class="float-end">
                                        <a href="#"><i
                                                class="bi bi-pencil-square btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#ModalEdit{{ $chapitre->id }}"></i></a>
                                        <i class="bi bi-trash3-fill btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#ModalDelete{{ $chapitre->id }}"></i>
                                    </div>
                                </td>

                                <!-- Modal delete-->
                                <x-delete-modal :model="$chapitre" key="titre" route="chapitre"></x-delete-modal>
                                {{-- Modal edit --}}
                                <div class="modal fade" id="ModalEdit{{ $chapitre->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">Modification chapitre</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <label for="titre"></label>
                                                <form action="{{route('admin.chapitre.edit',$chapitre)}}" method="post">
                                                    @csrf
                                                    <div class="form-group col-md-10">
                                                        <input type="text" class="form-control fs-4 fw-bold fst-italic @error('titre')is-invalid  @enderror" id="titre"
                                                            placeholder="intitule du chapitre" value="{{ old('titre',$chapitre->titre) }}" name="titre">
                                                        @error('titre')
                                                            <label for="titre" class="text-danger">{{ $message }}</label>
                                                        @enderror
                                                    </div> 
                                            </div>
                                            
                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">annuler</button>
                                                <button class="btn btn-primary" type="submit">modifier</button>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-light text-center container mt-4 p-3 fs-3" role="alert">
                    Aucun chapitre enregistrer pour cette matiere
                </div>
            @endif
            <!---endkill --->
            {{-- create Modal --}}
            <div class="modal fade" id="Modalcreate" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Ajoutez une nouveau chapitre</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="titre"></label>
                            <form action="{{route('admin.chapitre.create',$matiere)}}" method="post">
                                @csrf
                                <div class="form-group col-md-10">
                                    <input type="text" class="form-control fs-4 fw-bold fst-italic @error('titre')is-invalid  @enderror" id="titre"
                                        placeholder="intitule du chapitre" name="titre">
                                    @error('titre')
                                        <label for="titre" class="text-danger">{{ $message }}</label>
                                    @enderror
                                </div> 
                        </div>
                        
                        <div class="modal-footer">

                            <button type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">annuler</button>
                            <button class="btn btn-primary" type="submit">Ajouter</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="tab-2" class="tab-pane fade p-0 @if(request()->tab==='eval')show active @endif">
            <hr>
            <div class="d-flex justify-content-around">
                <h3 class="fst-italic">Evaluation</h3>
                <a href="{{ route('admin.eval.create', $matiere) }}" class="btn btn-primary"><i class="bi bi-file-earmark-plus"></i>programmer</a>
            </div>
            @if ($matiere->evaluations->count())
                <table class="table table-striped table-hover mt-3">
                    <thead>
                        <tr>
                            <th scope="col">#id</th>
                            <th scope="col">intitule</th>
                            <th scope="col">duree</th>
                            <th scope="col">date</th>
                            <th scope="col" class="text-end">action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        {{-- @dd($current->matiere($current_level->id)->chapitres) --}}
                        @foreach ($matiere->evaluations as $eval)
                            <tr>
                                <th scope="row">{{ $eval->id }}</th>
                                <td class=""><a
                                        href="{{ route('admin.eval.show', $eval) }}">{{ $eval->intitule }}</a>
                                </td>
                                <td scope="row">{{ $eval->duree }}</td>
                                <td scope="row">{{ $eval->date }}</td>
                                <td class="pe-0 w-25">
                                    <div class="float-end">
                                        <a href="{{ route('admin.eval.edit', $eval) }}"><i
                                                class="bi bi-pencil-square btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#ModalEdit{{ $eval->id }}"></i></a>
                                        <i class="bi bi-trash3-fill btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#ModalDelete{{ $eval->id }}"></i>
                                    </div>
                                </td>

                                <!-- Modal -->
                                <x-delete-modal :model="$eval" key="intitule" route="eval" message="Cette
                                action est irreversible"></x-delete-modal>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-light text-center container mt-4 p-3 fs-3" role="alert">
                    Aucune evaluation programme pour cette matiere
                </div>
            @endif
        </div>
        {{-- <div id="tab-3" class="tab-pane fade show p-0">
            <hr>
            <div class="d-flex justify-content-around">
                <h3 class="fst-italic">Exercices</h3>
                <a href="{{ route('admin.chapitre.create', $matiere) }}" class="btn btn-primary">Ajouter </a>
            </div>
            @if ($matiere->evaluations->count())
                <table class="table table-striped table-hover mt-3">
                    <thead>
                        <tr>
                            <th scope="col">#id</th>
                            <th scope="col">intitule</th>
                            <th scope="col">duree</th>
                            <th scope="col">date</th>
                            <th scope="col" class="text-end">action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        
                        @foreach ($matiere->evaluations as $eval)
                            <tr>
                                <th scope="row">{{ $eval->id }}</th>
                                <td class=""><a
                                        href="{{ route('admin.cours.index', ['slug' => Str::slug($chapitre->titre), 'chapitre' => $chapitre]) }}">{{ $chapitre->titre }}</a>
                                </td>
                                <td class="pe-0 w-25">
                                    <div class="float-end">
                                        <a href="{{ route('admin.chapitre.edit', $chapitre) }}"><i
                                                class="bi bi-pencil-square btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#ModalEdit{{ $eval->id }}"></i></a>
                                        <i class="bi bi-trash3-fill btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#EvalModalDelete{{ $eval->id }}"></i>
                                    </div>
                                </td>

                                <!-- Modal -->
                                <div class="modal fade" id="EvalModalDelete{{ $eval->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">confirmation de suppression</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h1>Voulez-vous supprimer <span
                                                        class="fw-bold fst-italic">{{ $eval->intitule }}</span> ?</h1>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-info"
                                                    data-bs-dismiss="modal">annuler</button>
                                                <form action="{{ route('admin.chapitre.delete', $chapitre) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger">Supprimer</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="alert alert-light text-center container mt-4 p-3 fs-3" role="alert">
                    Aucune evaluation programme pour cette matiere
                </div>
            @endif
        </div> --}}

    </div>


</x-admin>
