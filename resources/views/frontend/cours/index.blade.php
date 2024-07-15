<x-frontend  :chapitre="$chapitre" >
  @php
    Carbon\Carbon::setLocale('fr');
  @endphp
  <style>
    .active{
            color:black !important;
        }

    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: scale(1.05);
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
            @foreach ($chapitre->cours->sortByDesc('created_at') as $cour)
                <div class="col col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <img src="{{ $cour->getCover() }}" class="card-img-top" alt="{{ $cour->titre }}" style="width: 100%;height: 10rem;object-fit: cover">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-truncate">
                                <a href="{{ route('user.cours.show', $cour) }}" class="text-dark text-decoration-none text-decoration-underline">{{ $cour->titre }}</a>
                            </h5>
                            <p class="card-text" style="height:3rem;">
                                <small class="text-muted">{{ Str::limit($cour->description,40) }}</small>
                            </p>
                            <hr>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between">
                                    <small class="text-muted fst-italic fw-bold">{{ $cour->created_at->diffForHumans() }}</small>
                                    <small class="text-muted">{{ $cour->vues }} lecture(s)</small>
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
