<x-admin :matiere="$chapitre->matiere">
    <x-session key="success"></x-session>
    <div class="label d-flex justify-content-around">
        <h3>Cours</h3>
        <a href="{{route('admin.cours.create',$chapitre)}}" class="btn btn-primary">
            <i class="bi bi-folder-plus"></i>
            cours
        </a>
    </div>
    <table class="table table-striped table-hover mt-3">
        <thead>
            <tr>
                <th scope="col">#id</th>
                <th scope="col">intitule</th>
                <th scope="col">description</th>
                <th scope="col">Vues</th>
                <th scope="col" class="text-end">action</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            {{-- @dd($current->matiere($current_level->id)->chapitres) --}}
            @forelse ($chapitre->cours as $cour)
                <tr>
                    <th scope="row">{{ $cour->id }}</th>
                    <td class="">{{ $cour->titre }}</td>
                    <td scope="row">{{ Str::limit($cour->description,30)??'Aucune description' }}</td>
                    <td scope="col">{{$cour->vues}}</td>
                    <td class="float-end">
                        <a href="{{route('admin.cours.edit',$cour)}}"><i
                                class="bi bi-pencil-square btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#ModalEdit{{$cour->id}}"></i></a>
                        <i class="bi bi-trash3-fill btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#ModalDelete{{$cour->id}}"></i>
                    </td>

                    <!-- Modal -->
                    <x-delete-modal :model="$cour" route="cours" message="Tous les fichiers associes seront supprimer"></x-delete-modal>
                    
                </tr>
            @empty
            @endforelse
        </tbody>
    </table>
</x-admin>