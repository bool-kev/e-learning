<x-frontend  >
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
            <p class="fst-italic">Votre avez obtenu la node de  <span class="fw-bold">{{$note}}/{{$eval->questions->count()}}</span></p>
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
                            <label @class(['form-check-label', 'text-success' => $question->reponse===$opt,'text-danger text-decoration-line-through'=>($reponses[$question->id]??'')===$opt && $question->reponse!==$opt]) for="option{{ $question->id }}{{ $loop->index }}">
                                {{ $opt }}
                            </label>
                        </div>
                    @endforeach
                @else
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" @class(['form-control', 'text-success' => $question->reponse===$reponses[$question->id]??'','text-danger text-decoration-line-through' => $question->reponse!==$reponses[$question->id]??'']) value="{{$reponses[$question->id]??''}}" readonly>
                            </div>
                            @if ($question->reponse!==$reponses[$question->id]??'')
                                <div class="col-md-6">
                                    <p>reponse: <span class="text-success">{{$question->reponse}}</span></p>
                                </div>
                            @endif
                        </div>
                @endif
            </div>
            <hr>
        @endforeach
    </div>
    </x-frontend> 