

    <div class="container">
       
    </div>
<!------Affichage des eval------>
    <div class="container">
    <div class="row">
        <div class="col-md-4">
                    <div class="card anim mb-4">
                        <div class="card-header">
                            Évaluation: {{ $devoir->intitule }}
                        </div>
                        <div class="card-body">
                            <p>Date: {{ $devoir->date }}</p>
                            <p>Durée: {{ $devoir->duree }}</p>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#questionsModal{{$devoir->id}}">
                                Composer
                            </button>
                        </div>
                    </div>
            </div>

            <div class="modal fade" id="questionsModal{{$devoir->id}}" tabindex="-1" role="dialog" aria-labelledby="questionsModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="questionsModalLabel">Questions</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('test2', $devoir) }}" method="POST">
                                @csrf
                                @foreach ($devoir->questions as $question)
                                    <div class="question mb-4">
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
                                    <button type="submit" class="btn btn-primary">Valider</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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