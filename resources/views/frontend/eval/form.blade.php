<x-frontend  :matiere="$eval->matiere->faculte->libelle">
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
        <div class="head border border-2 p-3 text-center mb-3">
            <h3>Correction de l'evaluation</h3>
        </div>
        @foreach ($eval->questions as $question)
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
                            <input class="form-check-input" type="checkbox" name="question[{{ $question->id }}]"   id="option{{ $question->id }}{{ $loop->index }}" readonly @checked(($reponses[$question->id]??'')===$opt)>
                            <label @class(['form-check-label', 'text-success fw-bold fst-italic' => $question->reponse===$opt]) for="option{{ $question->id }}{{ $loop->index }}">
                                {{ $opt }}
                            </label>
                        </div>
                    @endforeach
                @else
                    <div class="row">
                        <div class="col-md-6">
                            <p class="ms-3">reponse: <span class="text-success fw-bold fst-italic">{{$question->reponse}}</span></p>
                        </div>
                    </div>
                @endif
            </div>
            <hr>
        @endforeach
        <a href="{{route('user.eval.index',$eval->matiere)}}" class="btn btn-secondary w-75 mx-5">fermer</a>
    </div>
</x-frontend> 