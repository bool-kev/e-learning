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
        <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#createModal" id="create-btn">
            Ajouter une question
        </button>
        
    </div>
    @if ($questions->count())
    <table class="table table-striped table-hover table-bordered mt-3">
        <thead>
            <tr>
                <th scope="col">#id</th>
                <th scope="col">intitule</th>
                <th scope="col" class="d-none d-md-table-cell">opt1</th>
                <th scope="col" class="d-none d-md-table-cell">opt2</th>
                <th scope="col" class="d-none d-md-table-cell">opt3</th>
                <th scope="col" class="d-none d-md-table-cell">opt4</th>
                <th scope="col">reponse</th>
                <th scope="col" class="text-end">action</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            {{-- @dd($current->matiere($current_level->id)->chapitres) --}}
            @foreach ($questions as $question)
                <tr>
                    <th scope="row">{{ $question->id }}</th>
                    <td class="" >{{$question->enonce}}</td>
                    @if ($question->is_qcm())
                        <td class="d-none d-md-table-cell">{{$question->opt1}}</td>
                        <td class="d-none d-md-table-cell">{{$question->opt2}}</td>
                        <td class="d-none d-md-table-cell">{{$question->opt3}}</td>
                        <td class="d-none d-md-table-cell">{{$question->opt4}}</td>
                    @else
                        <td colspan="4" class="text-center fw-bold fst-italic d-none d-md-table-cell">pas de type QCM</td>
                    @endif
                    <td class="">{{$question->reponse}}</td>
                    <td class="text-end">
                        <a href="#"><i
                                class="bi bi-pencil-square btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{$question->id}}"></i></a>
                        <i class="bi bi-trash3-fill btn btn-danger mt-1 mt-md-0" data-bs-toggle="modal"
                            data-bs-target="#ModalDelete{{$question->id}}"></i>
                    </td>

                    <!-- Modal -->
                    <div class="modal fade" id="ModalDelete{{$question->id}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title fs-3" >confirmation de suppression</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <h1>Voulez-vous supprimer <span class="fw-bold fst-italic">{{Str::limit($question->enonce,10)}}</span> ?</h1>
                                </div>
                                <div class="alert alert-light d-block" role="alert">
                                    <strong class="text-center text-danger fs-4"><i class="bi bi-exclamation-circle fs-4 text-danger"></i> Action irreversible</strong>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info"
                                        data-bs-dismiss="modal">annuler</button>
                                    <form action="{{route('admin.question.delete')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="question" value="{{$question->id}}">
                                        @method('DELETE')
                                        <button class="btn btn-danger">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 

                    <!-- Modal Edit-->
                    <div @class(['modal fade']) id="editModal{{$question->id}}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" >
                        
                        <div class="modal-dialog">
                            <form action="{{route('admin.question.update')}}" method="post">
                                @csrf
                                <input type="hidden" name="evaluation_id" value="{{$question->id}}">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="editModalLabel">Modifier ma question</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <x-form-modal :placeholder="$question->id" :question="$question"></x-form-modal>
                                    <div class="p-3 text-center">
                                        <button type="button" class="btn btn-danger me-4 w-25" data-bs-dismiss="modal">annuler</button>
                                        <button type="submit" class="btn btn-primary w-25">modifier</button>
                                    </div>
                            </form>
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
    @if ($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded',(e)=>{
            document.getElementById('create-btn').dispatchEvent(new Event('click'));
            })
        </script>
    @endif
    @vite('resources/backend/js/htmx.min.js')
</x-admin>


<!-- Modal -->
<div @class(['modal fade']) id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true" >
    
    <div class="modal-dialog">
        <form action="{{route('admin.question.store')}}" method="post">
            @csrf
            <input type="hidden" name="evaluation_id" value="{{$eval->id}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModalLabel">Enregistrer une question</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <x-form-modal :placeholder="$questions->count()"></x-form-modal>
                <div class="p-3 text-center">
                    <button type="button" class="btn btn-danger me-4 w-25" data-bs-dismiss="modal">annuler</button>
                    <button type="submit" class="btn btn-primary w-25">enregister</button>
                </div>
        </form>
    </div>
</div>


