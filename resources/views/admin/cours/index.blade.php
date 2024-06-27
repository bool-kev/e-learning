<x-admin :matiere="$chapitre->matiere">
    <x-session key="success"></x-session>
    <div class="label d-flex justify-content-around">
        <h3>Cours</h3>
        <a href="{{route('admin.cours.create',$chapitre)}}" class="btn btn-primary">Ajouter un cours</a>
    </div>
    <table class="table table-striped table-hover mt-3">
        <thead>
            <tr>
                <th scope="col">#id</th>
                <th scope="col">intitule</th>
                <th scope="col">description</th>
                <th scope="col">Vues</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            {{-- @dd($current->matiere($current_level->id)->chapitres) --}}
            @forelse ($chapitre->cours as $cour)
                <tr>
                    <th scope="row">{{ $cour->id }}</th>
                    <td class=""><a href="{{route('admin.cours.index',['slug'=>Str::slug($cour->titre),'chapitre'=>$chapitre])}}">{{ $cour->titre }}</a></td>
                    <td scope="row">{{ Str::limit($cour->description)??'Aucune description' }}</td>
                    <td scope="col">{{$cour->vues}}</td>
                    <td class="w-25">
                        <a href="{{route('admin.cours.edit',$cour)}}"><i
                                class="bi bi-pencil-square btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#ModalEdit{{$cour->id}}"></i></a>
                        <i class="bi bi-trash3-fill btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#ModalDelete{{$cour->id}}"></i>
                    </td>

                    <!-- Modal -->
                    <div class="modal fade" id="ModalDelete{{$cour->id}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title fs-5" >confirmation de suppression</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <h1>Voulez-vous supprimer <span class="fw-bold fst-italic">{{$cour->titre}}</span> ?</h1>
                                </div>
                                <div class="alert alert-light d-block" role="alert">
                                    <strong class="text-center text-danger fs-4"><i class="bi bi-exclamation-circle fs-4 text-danger"></i> Tous les fichiers associes seront supprimes</strong>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info"
                                        data-bs-dismiss="modal">annuler</button>
                                    <form action="{{route('admin.cours.delete',$cour)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
</x-admin>