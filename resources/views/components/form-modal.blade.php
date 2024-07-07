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
                name="enonce" required>
            @error('enonce')
                <label for="enonce" class="text-danger">{{ $message }}</label>
            @enderror
        </div>
        <div class="form-group">
            <input type="text" class="form-control py-4 fs-4 text-black @error('reponse')is-invalid  @enderror"
                id="reponse" placeholder="Reponse" value="{{ old('reponse', $question->reponse) }}"
                name="reponse" required>
            @error('reponse')
                <label for="reponse" class="text-danger">{{ $message }}</label>
            @enderror
        </div>
        <div id="options-container" class="row">
        <hr>
        <p class="text-secondary">Options de reponses pour les QCM ( <strong>le reponse est la premiere option </strong>)</p>
        @error('options')
            <label for="#" class="text-danger">{{ $message }}</label>
        @enderror
        @error('options.*')
            <label for="#" class="text-danger">{{ $message }}</label>
        @enderror
        </div>
    </div>
    
    <i class="bi bi-plus-circle-fill text-success mt-2 ms-2 fs-2 me-2" id="add-option-btn" style="cursor: pointer"></i>
    <i class="bi bi-dash-circle text-danger mt-2 ms-2 fs-2" id="remove-option-btn" style="cursor: pointer"></i>
</div>
<script>
    

    document.addEventListener('DOMContentLoaded', () => {
        function addOption(opt="") {
        optionCount++;
        const newOption = document.createElement('div');
        newOption.classList.add(`option-field${optionCount}`,'col-md-6','mt-2');
        newOption.innerHTML = `
            <label for="option${optionCount}" class="form-label">Option ${optionCount+1}</label>
            <input type="text" class="form-control text-black" id="option${optionCount}" name="options[]" value="${opt}"required>
            {{--<button onclick="document.querySelector('.option-field${optionCount}').remove()" type="button">X</button>--}}
        `;
        optionsContainer.appendChild(newOption);
    }
        const optionsContainer = document.getElementById('options-container');
        const addOptionBtn = document.getElementById('add-option-btn');
        const removeOptionBtn = document.getElementById('remove-option-btn');
        let optionCount = 0;
        let options=@json(old('options')??$question->options());
        console.log(options);
        options.forEach(element => {
            addOption(element);
        });
        if(optionCount>=3) addOptionBtn.classList.add('d-none');
        else if(optionCount<=0) removeOptionBtn.classList.add('d-none');
        addOptionBtn.addEventListener('click', () => {
            if (optionCount < 3) {
                addOption();
                removeOptionBtn.classList.remove('d-none');
            }
            if(optionCount>=3) addOptionBtn.classList.add('d-none');
        });
        removeOptionBtn.addEventListener('click', () => {
            if (optionCount > 0) {
                const Option = document.querySelector(`.option-field${optionCount}`);
                Option.remove();
                optionCount--;
                addOptionBtn.classList.remove('d-none');
            }
            if(optionCount<=0) removeOptionBtn.classList.add('d-none');
        });
    });
</script>