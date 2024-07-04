<x-admin>
    <x-session key="success"></x-session>
    <div class="d-flex justify-content-around mb-3">
        <h5 class="">Liste des enseignant</h5>
        <a href="{{route('admin.enseignant.create')}}" class="btn btn-primary">enregistrer un enseignant</a>
    </div>
    <table class="table table-hover table-striped table-responsive-sm">
        <thead>
            <th>#id</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>matricule</th>
            <th class="text-end">action</th>
        </thead>
        <tbody>
            @foreach ($enseignants as $enseignant)
                <tr>
                    <td>#{{$enseignant->id}}</td>
                    <td>{{$enseignant->nom}}</td>
                    <td>{{$enseignant->prenom}}</td>
                    <td>{{$enseignant->matricule}}</td>
                    <td class="btn-group float-end">
                        <a href="{{route('admin.enseignant.update',$enseignant)}}"><i class="bi bi-pencil-square btn btn-warning"></i></a>
                            <i class="bi bi-trash3-fill btn btn-danger mt-1 mt-md-0" data-bs-toggle="modal"
                                data-bs-target="#ModalDelete"></i>
                    </td>
                    <!-- Modal -->
                    <div class="modal fade" id="ModalDelete" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title fs-5">confirmation de suppression</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <h1>Voulez-vous supprimer <span
                                            class="fw-bold fst-italic">lol</span>
                                        ?</h1>
                                </div>
                                <div class="alert alert-light d-block" role="alert">
                                    <strong class="text-center text-danger "><i
                                            class="bi bi-exclamation-circle  text-danger"></i> Action
                                        irreversible</strong>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info"
                                        data-bs-dismiss="modal">annuler</button>
                                    <form action="{{route('admin.enseignant.delete',$enseignant)}}" method="post">
                                        @csrf
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
</x-admin>