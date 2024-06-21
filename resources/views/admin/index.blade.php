<x-admin-base :facultes="$facultes">

    <form action="" method="get">
        <div class="row justify-content-around">
            <div class="col-8">
                <div class="form-group form-floating">
                    <select name="niveau" id="niveau" class="form-select">
                        @foreach ($current->classes as $niveau)
                            <option value="{{$niveau->id}}">{{$niveau->libelle}}</option>
                        @endforeach
                    </select>
                    <label for="niveau" class="niveau">Niveau</label>
                </div>
            </div>
            {{-- <div class="col-5">
                <div class="form-group form-floating">
                    <select name="chapitre" id="chapitre" class="form-select">
                        @foreach ([2,4,5,6,7] as $item)
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
        <a href="{{route('admin.chapitre.create')}}" class="btn btn-primary">Ajouter un chapitre</a>
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
          @forelse ($current->matiere($current_level->id)->chapitres as $chapitre)
          <tr>
            <th scope="row">{{$chapitre->id}}</th>
            <td class="w-md-75">{{$chapitre->libelle}}</td>
            <td class="">
                <i class="bi bi-pencil-square btn btn-warning"></i>
                <i class="bi bi-trash3-fill btn btn-danger"></i>
            </td>
        </tr>
          @empty
              
          @endforelse
        </tbody>
      </table>
</x-admin-base>