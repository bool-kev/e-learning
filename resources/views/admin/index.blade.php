{{-- @dd($matiere); --}}
<x-admin-base :matiere="$matiere">
    <form action="" method="get">
        <div class="row justify-content-around">
            <div class="col-8">
                <div class="form-group form-floating">
                    <select name="niveau" id="niveau" class="form-select">
                        @foreach ($matiere->faculte->classes??[] as $niveau)
                            <option value="{{ $niveau->id }}" @selected($matiere->niveau_id===$niveau->id)>{{ $niveau->libelle }}</option>
                        @endforeach
                    </select>
                    <label for="niveau" class="niveau">Niveau</label>
                    <script>
                        document.querySelector('#niveau').addEventListener('change',(e)=>{
                            let url=`{{route('admin.index',['faculte'=>$matiere->faculte,'niveau'=>'LEVEL'])}} `;
                            url=url.replace('LEVEL',e.target.selectedOptions[0].value);
                            document.location=url;
                        })
                    </script>
                </div>
            </div>
            {{-- <div class="col-5">
                <div class="form-group form-floating">
                    <select name="chapitre" id="chapitre" class="form-select">
                        @foreach ([2, 4, 5, 6, 7] as $item)
                            <option value="">Chapitre</option>
                        @endforeach
                    </select>
                    <label for="chapitre" class="niveau">Chapitre</label>
                </div>
            </div> --}}
        </div>
    </form>
    <hr>
    <div class="label d-flex justify-content-around">
        <h3>Chapitres</h3>
        <a href="{{ route('admin.chapitre.create', $matiere) }}" class="btn btn-primary">Ajouter un chapitre</a>
    </div>
    <table class="table table-striped table-hover mt-3">
        <thead>
            <tr>
                <th scope="col">#id</th>
                <th scope="col">intitule</th>
                <th scope="col">action</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            {{-- @dd($current->matiere($current_level->id)->chapitres) --}}
            @forelse ($matiere->chapitres as $chapitre)
                <tr>
                    <th scope="row">{{ $chapitre->id }}</th>
                    <td class=""><a href="{{route('admin.cours.index',['slug'=>Str::slug($chapitre->titre),'chapitre'=>$chapitre])}}">{{ $chapitre->titre }}</a></td>
                    <td class="w-25">
                        <a href="{{ route('admin.chapitre.edit', $chapitre) }}"><i
                                class="bi bi-pencil-square btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#ModalEdit{{$chapitre->id}}"></i></a>
                        <i class="bi bi-trash3-fill btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#ModalDelete{{$chapitre->id}}"></i>
                    </td>

                    <!-- Modal -->
                    <div class="modal fade" id="ModalDelete{{$chapitre->id}}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" >confirmation de suppression</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h1>Voulez-vous supprimer <span class="fw-bold fst-italic">{{$chapitre->titre}}</span> ?</h1>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-info"
                                        data-bs-dismiss="modal">annuler</button>
                                    <form action="{{route('admin.chapitre.delete',$chapitre)}}" method="post">
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
            <tr><td colspan="3">Aucun chapitre enregistrer pour cette matiere</td></tr>
            @endforelse
        </tbody>
    </table>
</x-admin-base>



