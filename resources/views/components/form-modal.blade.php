@php
    use App\Models\Question;
@endphp
@props(['question'=>new Question(),'placeholder']);
<div class="modal-body">
    <x-error key="opts"></x-error>
    <div class="row p-2">
        <h3 class="display-5 text-center">Question #{{$placeholder}} </h3>
        <div class="form-group">
            <input type="text" class="form-control py-4 fs-4 text-black @error('enonce')is-invalid  @enderror"
                id="enonce" placeholder="enonce" value="{{ old('enonce',$question->enonce) }}"
                name="enonce">
            @error('enonce')
                <label for="enonce" class="text-danger">{{ $message }}</label>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <input type="text" class="form-control py-4 fs-4 text-black @error('opt1')is-invalid  @enderror"
                id="opt1" placeholder="option 1" value="{{ old('opt1',$question->opt1) }}"
                name="opt1">
            @error('opt1')
                <label for="opt1" class="text-danger">{{ $message }}</label>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <input type="text" class="form-control py-4 fs-4 text-black @error('opt2')is-invalid  @enderror"
                id="opt2" placeholder="option 2" value="{{ old('opt2',$question->opt2) }}"
                name="opt2">
            @error('opt2')
                <label for="opt2" class="text-danger">{{ $message }}</label>
            @enderror
        </div>
        
        <div class="form-group col-md-6">
            <input type="text" class="form-control py-4 fs-4 text-black @error('opt3')is-invalid  @enderror"
                id="opt3" placeholder="option 3" value="{{ old('opt3', $question->opt3) }}"
                name="opt3">
            @error('opt3')
                <label for="opt3" class="text-danger">{{ $message }}</label>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <input type="text" class="form-control py-4 fs-4 text-black @error('opt4')is-invalid  @enderror"
                id="opt4" placeholder="option 4" value="{{ old('opt4', $question->opt4) }}"
                name="opt4">
            @error('opt4')
                <label for="opt4" class="text-danger">{{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <input type="text" class="form-control py-4 fs-4 text-black @error('reponse')is-invalid  @enderror"
                id="reponse" placeholder="Reponse" value="{{ old('reponse', $question->reponse) }}"
                name="reponse">
            @error('reponse')
                <label for="reponse" class="text-danger">{{ $message }}</label>
            @enderror
        </div>
    </div>
</div>