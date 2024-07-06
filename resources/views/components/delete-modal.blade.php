@props([
    'model',
    'key'=>'titre',
    'route'=>'chapitre',
    'message'=>'Tous les cours associes seront supprimer'
])

<div class="modal fade" id="ModalDelete{{ $model->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">confirmation de suppression</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h3>Voulez-vous supprimer <span
                        class="fw-bold fst-italic">{{ $model->$key }}</span> ?</h3>
            </div>
            <div class="alert alert-light d-block" role="alert">
                <strong class="text-center text-danger fs-5"><i
                        class="bi bi-exclamation-circle fs-4 text-danger"></i>{{$message}}</strong>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">annuler</button>
                <form action="{{ route("admin.$route.delete", $model) }}"
                    method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </div>
    </div>
</div>