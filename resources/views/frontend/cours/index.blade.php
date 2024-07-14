<x-frontend  :chapitre="$chapitre" >
  <style>
    .active{
            color:black !important;
        }

    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: scale(1.2);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
  </style> 
    <div class="">
      <div class="row">
        <div class="col-9">
          <div class="pagetitle">
            <nav>
              <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#">{{$chapitre->matiere->faculte->libelle}}</a></li>
                <li class="breadcrumb-item"><a href="#">{{$chapitre->titre}}</a></li>
              </ol>
            </nav>
          </div>
        </div>

       <div class="col-6">
          <select class="form-select" aria-label="Default select example">
              @forelse ($chapitre->matiere->chapitres as $chap)
              <option @class([ 'text-light']) @selected($chapitre->id===$chap->id)>{{ $chap->titre }}</option>
              @empty
              <option value=""></option>
              @endforelse
            </select>
       </div>
        
                
          
        <div class="col-6">
          <form class="d-flex" role="search" method="GET" action="{{-- route('cours.search') --}}">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success d-none" type="submit">Search</button>
          </form>
        </div>

      </div>
    </div>
    <!---Affichage cours----->
    <div class="container mt-5">
    @if ($chapitre->cours->isEmpty())
        <h3 class="text-center">Aucun cours trouvé pour ce chapitre</h3>
    @else
        <div class="row">
            @foreach ($chapitre->cours as $cour)
                <div class="col-md-4 mb-4">
                    <div class="card h-80">
                        <img src="{{ $cour->getCover() }}" class="card-img-top" alt="{{ $cour->titre }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate">
                                <a href="{{ route('user.cours.show', $cour) }}" class="text-dark text-decoration-none">{{ $cour->titre }}</a>
                            </h5>
                            <p class="card-text text-truncate">
                                <small class="text-muted">{{ $cour->description }}</small>
                            </p>
                            <hr>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted">Publié le {{ $cour->created_at->format('d M Y') }}</small>
                                    <small class="text-muted">{{ $cour->vues }} vue(s)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

    
</x-frontend>
