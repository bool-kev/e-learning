<x-admin :matiere="$eval->matiere">
    <x-session key="success"></x-session>
    @php
        $questions=$eval->questions;
    @endphp
    <div class="d-flex justify-content-around fs-4">
        <p>Evaluation:{{$eval->intitule}}</p>
        <p>duree:{{$eval->duree}}</p>
        <p>date:{{$eval->date}}</p>
    </div>
    <hr>
    <div class="label d-flex justify-content-around">
        <h3 class="fw-bold">liste des questions</h3>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Ajouter une question
        </button>
    </div>
    @if ($questions->count())
    <table class="table table-striped table-hover mt-3">
        <thead>
            <tr>
                <th scope="col">#id</th>
                <th scope="col">intitule</th>
                <th scope="col">opt1</th>
                <th scope="col">opt2</th>
                <th scope="col">opt3</th>
                <th scope="col">opt4</th>
                <th scope="col">reponse</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            {{-- @dd($current->matiere($current_level->id)->chapitres) --}}
            @foreach ($eval->questions as $question)
                <tr>
                    <th scope="row">{{ $question->id }}</th>
                    <td class="">{{$question->intule}}</td>
                    <td class="">{{$question->opt1}}</td>
                    <td class="">{{$question->opt2}}</td>
                    <td class="">{{$question->opt3}}</td>
                    <td class="">{{$question->opt4}}</td>
                    <td class="">{{$question->reponse}}</td>
                    <td class="w-25">
                        <a href="{{route('admin.cours.edit',$cour)}}"><i
                                class="bi bi-pencil-square btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#ModalEdit{{$cour->id}}"></i></a>
                        <i class="bi bi-trash3-fill btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#ModalDelete{{$cour->id}}"></i>
                    </td>

                    <!-- Modal -->
                    <div class="modal fade" id="ModalDelete{{$cour->id}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title fs-5" >confirmation de suppression</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <h1>Voulez-vous supprimer <span class="fw-bold fst-italic">{{$cour->titre}}</span> ?</h1>
                                </div>
                                <div class="alert alert-light d-block" role="alert">
                                    <strong class="text-center text-danger fs-4"><i class="bi bi-exclamation-circle fs-4 text-danger"></i> Tous les fichiers associes seront supprimes</strong>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info"
                                        data-bs-dismiss="modal">annuler</button>
                                    <form action="{{route('admin.cours.delete',$cour)}}" method="post">
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
    <div class="alert alert-info text-center container mt-4 p-3 fs-3" role="alert">
        Aucune question enregister pour evaluation 
    </div>
    @endif

</x-admin>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Enregistrer une question</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row p-2">
                        <h3 class="display-5 text-center">Question #1 </h3>
                        <div class="form-group">
                            <input type="text" class="form-control py-4 fs-4 @error('intitule')is-invalid  @enderror"
                                id="intitule" placeholder="intitule" value="{{ old('intitule') }}"
                                name="intitule">
                            @error('intitule')
                                <label for="intitule" class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control py-4 fs-4 @error('opt1')is-invalid  @enderror"
                                id="opt1" placeholder="option 1" value="{{ old('opt1') }}"
                                name="opt1">
                            @error('opt1')
                                <label for="opt1" class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control py-4 fs-4 @error('opt2')is-invalid  @enderror"
                                id="opt2" placeholder="option 2" value="{{ old('opt2') }}"
                                name="opt2">
                            @error('opt2')
                                <label for="opt2" class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control py-4 fs-4 @error('opt3')is-invalid  @enderror"
                                id="opt3" placeholder="option 3" value="{{ old('opt3', $eval->opt3) }}"
                                name="opt3">
                            @error('opt3')
                                <label for="opt3" class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control py-4 fs-4 @error('opt4')is-invalid  @enderror"
                                id="opt4" placeholder="option4" value="{{ old('opt4', $eval->opt4) }}"
                                name="option 4">
                            @error('opt4')
                                <label for="opt4" class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control py-4 fs-4 @error('reponse')is-invalid  @enderror"
                                id="reponse" placeholder="Reponse" value="{{ old('reponse', $eval->reponse) }}"
                                name="reponse">
                            @error('reponse')
                                <label for="reponse" class="text-danger">{{ $message }}</label>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="p-3 text-center">
                    <button type="button" class="btn btn-danger me-4 w-25" data-bs-dismiss="modal">annuler</button>
                    <button type="submit" class="btn btn-primary w-25">enregister</button>
                </div>
        </form>
    </div>
</div>
</div>