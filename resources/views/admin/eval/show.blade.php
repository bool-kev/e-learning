<x-admin :matiere="$eval->matiere">
    <x-session key="success"></x-session>

    @php
        $questions = $eval->questions;
    @endphp
    <h3>informations de l'evaluation</h3>
    <table class="table table-striped table-bordered">
        <tbody>
            <tr>
                <th class="text-decoration-underline fst-italic">Matiere</th>
                <th class="text-decoration-underline fst-italic">Intitule</th>
                <th class="text-decoration-underline fst-italic">Duree</th>
                <th class="text-decoration-underline fst-italic">Date</th>
            </tr>
            <tr>
                <td>{{$eval->matiere->faculte->libelle}}</td>
                <td>{{$eval->intitule}}</td>
                <td>{{$eval->dureee}}</td>
                <td>{{$eval->date}}</td>
        </tbody>
    </table>
    <hr>
    <div class="label d-flex justify-content-around">
        <h3 class="fw-bold">liste des questions</h3>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#createModal"
            id="create-btn">
            Ajouter une question
        </button>

    </div>
    @if ($questions->count())
        <table class="table table-striped table-responsive-sm table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">#id</th>
                    <th scope="col">intitule</th>
                    <th scope="col" >opt1</th>
                    <th scope="col" >opt2</th>
                    <th scope="col" >opt3</th>
                    <th scope="col" >opt4</th>
                    <th scope="col">reponse</th>
                    <th scope="col" class="text-end">action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                {{-- @dd($current->matiere($current_level->id)->chapitres) --}}
                @foreach ($questions as $question)
                    <tr>
                        <th scope="row">{{ $question->id }}</th>
                        <td class="">{{ $question->enonce }}</td>
                        @if ($question->options())
                            <td >{{ $question->opt1 }}</td>
                            <td >{{ $question->opt2 }}</td>
                            <td >{{ $question->opt3 }}</td>
                            <td >{{ $question->opt4 }}</td>
                        @else
                            <td colspan="4" class="text-center fw-bold fst-italice">pas de type
                                QCM</td>
                        @endif
                        <td class="">{{ $question->reponse }}</td>
                        <td class="text-end">
                            <a href="{{route('admin.question.edit',$question)}}"><i class="bi bi-pencil-square btn btn-warning"></i></a>
                            <i class="bi bi-trash3-fill btn btn-danger mt-1 mt-md-0" data-bs-toggle="modal"
                                data-bs-target="#ModalDelete{{ $question->id }}"></i>
                        </td>

                        <!-- Modal -->
                        <div class="modal fade" id="ModalDelete{{ $question->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h3 class="modal-title fs-3">confirmation de suppression</h3>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="modal-body">
                                        <h1>Voulez-vous supprimer <span
                                                class="fw-bold fst-italic">{{ Str::limit($question->enonce, 10) }}</span>
                                            ?</h1>
                                    </div>
                                    <div class="alert alert-light d-block" role="alert">
                                        <strong class="text-center text-danger fs-4"><i
                                                class="bi bi-exclamation-circle fs-4 text-danger"></i> Action
                                            irreversible</strong>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info"
                                            data-bs-dismiss="modal">annuler</button>
                                        <form action="{{ route('admin.question.delete', $question) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="question" value="{{ $question->id }}">
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
    
    @vite('resources/backend/js/htmx.min.js')
</x-admin>


<!-- Modal -->
<div @class(['modal fade']) id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.question.store') }}" method="post">
            @csrf
            <input type="hidden" name="evaluation_id" value="{{ $eval->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModalLabel">Enregistrer une question</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <x-form-modal placeholder="new"></x-form-modal>
                <div class="p-3 text-center">
                    <button type="button" class="btn btn-danger me-4 w-25" data-bs-dismiss="modal">annuler</button>
                    <button type="submit" class="btn btn-primary w-25">enregister</button>
                </div>
        </form>
    </div>
</div>

