<x-frontend :matiere="$matiere->faculte->libelle" >
    @php
        $eleve=request()->user()->eleve->load('notes');
    @endphp
<style>
    .anim {
        transition: transform 0.5s, box-shadow 2s;
    }

    .anim:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
</style>

    <div class="container">
        <div class="row">
            <div class="col-9">
                <div class="pagetitle">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">{{'home'}}</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
<!------Affichage des eval------>
    <div class="container">
    <div class="row">
        @foreach ($matiere->evaluations as $devoir)
            <div class="col-md-4">
                <div class="card anim mb-4">
                    <div class="card-header">
                            {{ $devoir->intitule }}
                    </div>
                    <div class="card-body">
                        <p>Date: {{ $devoir->date}}</p>
                        @if ($eleve->is_composer($devoir))
                            <p class="fst-italic">Votre note  <span class="fw-bold">{{$eleve->is_composer($devoir)->note}}/{{$devoir->questions->count()}}</span></p>
                            <a href="{{route('user.eval.solution',$devoir)}}" class="btn btn-primary">Correction</a>
                            <p class="text-secondary float-end">Deja composer </p>
                        @else
                            <p>Durée: {{ $devoir->duree }}</p>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#questionsModal{{$devoir->id}}">
                                Composer
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            @if (! $eleve->is_composer($devoir))
                <div class="modal fade" id="questionsModal{{$devoir->id}}" tabindex="-1" role="dialog" aria-labelledby="questionsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-fullscreen" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="questionsModalLabel">Composition de l'evaluation <strong>{{$devoir->intitule}}</strong></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('user.eval.submit',$devoir) }}" method="POST">
                                    @csrf
                                    @foreach ($devoir->questions->shuffle() as $question)
                                        <div class="question">
                                            <h5 class="font-weight-bold" >{{ $loop->index + 1 }}. {{ $question->enonce }}</h5>
                                            @if (count($question->options()))
                                                @php
                                                    $options = $question->options();
                                                    array_push($options, $question->reponse);
                                                    shuffle($options);
                                                @endphp
                                                @foreach ($options as $opt)
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="question[{{ $question->id }}]" id="option{{ $question->id }}{{ $loop->index }}" value="{{ $opt }}">
                                                        <label class="form-check-label" for="option{{ $question->id }}{{ $loop->index }}">
                                                            {{ $opt }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @else
                                                <input type="text" class="form-control" placeholder="Saisir la réponse" name="question[{{ $question->id }}]">
                                            @endif
                                        </div>
                                        <hr>
                                    @endforeach
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-primary">soumettre</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        </div>
    </div>

    <!-- Modal -->


<style>
    .modal-body {
        max-height: 70vh;
        overflow-y: auto;
    }
    .question h5 {
        margin-bottom: 15px;
    }
    .form-check {
        margin-bottom: 10px;
    }
</style>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#evaluationForm').on('submit', function(event) {
                event.preventDefault();
                
                // Simulate successful form submission
                // You can perform actual form submission via AJAX if needed
                $('#successModal').modal('show');
            });
        });
    </script>
</x-frontend> 