{{-- @dd($matiere); --}}
<x-admin :matiere="$matiere">

    <hr>
    <div class="label d-flex justify-content-around ">

        <div class="col-lg-8">
            <ul class="nav nav-pills d-inline-flex text-center mb-1 ">
                <li class="nav-item">
                    <a class="d-flex m-2 py-2 bg-light rounded-pill link-underline link-underline-opacity-0 active"
                        data-bs-toggle="pill" href="#tab-1">
                        <span class="text-dark" style="width: 130px;">Cours</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex py-2 m-2 bg-light rounded-pill link-underline link-underline-opacity-0"
                        data-bs-toggle="pill" href="#tab-2">
                        <span class="text-dark" style="width: 130px;">Evaluations</span>
                    </a>
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
        <div id="tab-1" class="tab-pane fade show p-0 active">
            <!---kill --->
            <hr>
            <div class="d-flex justify-content-around">
                <h3 class="fst-italic">Chapitres</h3>
                <a href="{{ route('admin.chapitre.create', $matiere) }}" class="btn btn-primary">Ajouter un chapitre</a>
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
                                        <a href="{{ route('admin.chapitre.edit', $chapitre) }}"><i
                                                class="bi bi-pencil-square btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#ModalEdit{{ $chapitre->id }}"></i></a>
                                        <i class="bi bi-trash3-fill btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#ModalDelete{{ $chapitre->id }}"></i>
                                    </div>
                                </td>

                                <!-- Modal -->
                                <div class="modal fade" id="ModalDelete{{ $chapitre->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5">confirmation de suppression</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h3>Voulez-vous supprimer <span
                                                        class="fw-bold fst-italic">{{ $chapitre->titre }}</span> ?</h3>
                                            </div>
                                            <div class="alert alert-light d-block" role="alert">
                                                <strong class="text-center text-danger fs-4"><i
                                                        class="bi bi-exclamation-circle fs-4 text-danger"></i> Tous les
                                                    cours associes seront supprimer</strong>
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
                    Aucun chapitre enregistrer pour cette matiere
                </div>
            @endif
            <!---endkill --->

        </div>
        <div id="tab-2" class="tab-pane fade show p-0">
            <hr>
            <div class="d-flex justify-content-around">
                <h3 class="fst-italic">Evaluation</h3>
                <a href="{{ route('admin.eval.create', $matiere) }}" class="btn btn-primary">programmer</a>
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
                                <td class=""><a href="{{route('admin.eval.show',$eval)}}">{{ $eval->intitule }}</a>
                                </td>
                                <td scope="row">{{ $eval->duree }}</td>
                                <td scope="row">{{ $eval->date }}</td>
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
                                                <h3 class="modal-title fs-5">confirmation de suppression</h3>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h1>Voulez-vous supprimer <span
                                                        class="fw-bold fst-italic">{{ $eval->intitule }}</span> ?</h1>
                                            </div>
                                            <div class="alert alert-light d-block" role="alert">
                                                <strong class="text-center text-danger fs-4"><i
                                                        class="bi bi-exclamation-circle fs-4 text-danger"></i> Cette
                                                    action est irreversible</strong>
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
