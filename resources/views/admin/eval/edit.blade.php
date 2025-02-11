<x-admin :matiere="$question->evaluation->matiere">
    <x-error key="evaluation_id"></x-error>
    <form action="{{ route('admin.question.update',$question) }}" method="post" >
        @csrf
        <input type="hidden" name="evaluation_id" value="{{$question->evaluation->id}}">
        <x-form-modal :question="$question" :placeholder="$question->id"></x-form>
        <div class="form-group ms-5">
            <button class="btn btn-primary">Modifier</button>
            <a class="btn btn-warning" href="/admin">annuler</a>
        </div>
</x-admin>