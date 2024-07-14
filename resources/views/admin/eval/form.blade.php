@php
    $matiere=$eval->matiere??$matiere;
@endphp
<x-admin :matiere="$matiere">

    <div class="container">
        @error('matiere_id')
            <div class="alert alert-danger" role="alert">
                {{ $message }} Vous serez rediriger
            </div>
            <script>
                document.location="{{route('admin.root')}}";
            </script>
        @enderror
        <x-session type="danger" key="error"></x-session>
        <x-session type="success" key="success"></x-session>
        <div id="cover2"></div>
        <h1 class="diplay-3 my-4">{{ $eval->id ? 'Modifier une evaluation' : 'Programmer une evaluation' }}</h1>
        <form action="{{ route('admin.eval.store') }}" method="post" class="" id="form">
            @csrf
            <input type="hidden" name="matiere_id" value="{{ $matiere->id }}">
            <div class=" mt-5">
                <div class="form-group ">
                    <label for="intitule" class="form-label text-black">Intutile de l'evaluation</label>
                    <input type="text" class="form-control my-2 @error('intitule')is-invalid  @enderror"
                        id="intitule" placeholder="intitule" value="{{ old('intitule', $eval->intitule) }}"
                        name="intitule">
                    @error('intitule')
                        <label for="intitule" class="text-danger">{{ $message }}</label>
                    @enderror
                </div>

                <div class="row">
                    <div class="form-group col-6 ">
                        <label for="duree" class="form-label text-black">duree</label>
                            <select name="duree" id="duree" class="form-select">
                                <option value="5" >5 min</option>
                                <option value="10">10 min</option>
                                <option value="15">15 min</option>
                                <option value="30">30 min</option>
                            </select>
                        @error('duree')
                            <label for="duree" class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                    <div class="form-group col-6 my-2">
                        <label for="date" class="form-label text-black">date</label>
                        <input type="datetime-local" class="form-control @error('date')is-invalid  @enderror"
                            id="date" placeholder="date..." value="{{ old('date', $eval->date) }}" name="date">
                        @error('date')
                            <label for="date" class="text-danger">{{ $message }}</label>
                        @enderror
                    </div>
                </div>
            </div>
            <button class="btn btn-primary ms-3 ">{{ $eval->id ? 'Mettre a jour' : 'Creer' }}</button>
            <a class="btn btn-info" onclick="history.back()">retour</a>
        </form>
    </div>
</x-admin>


