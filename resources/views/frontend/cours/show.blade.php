<x-frontend  :chapitre="$cours->chapitre">
@section('style')
<style>
    #the-canvas {
        border: 1px solid black;
        direction: ltr;
    }
</style>

    <style>
    .hover:hover{
        background-color: rgb(99, 95, 95,0.3);                    
        color: white;
        border-radius: 15%;
    }
    .col-1 button{
        position: relative;
        z-index: 2;
        
    }
    @media (max-width: 768px) {
    canvas{
        transition: transform 0.3s ease;
        scale: 1.3;
        margin-top: 55px;
    }
    .col-1 button{
        margin-top: 50px;
    }
    }
    .marge{
    text-align: center;
    color: blue;
    }

    
</style>
 

    <div class="container">
        <h1 class="marge">{{ $cours->titre }}</h1>
    <p class="my-3 border border-2">
        {!! $cours->content !!}
    </p>
    <hr>
    <p oncontextmenu="preventDefault()">images</p>
    @if($images=$cours->getFiles('image'))
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                @foreach ($images as $img)
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$loop->index}}" @class(['active' => $loop->first]) ></button>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach ($images as $img)
                    <div @class(['carousel-item','active' => $loop->first]) id="img-{{$img->id}}">
                        <img class="d-block w-100" src="{{$img->getUrl()}}" style="width: 100%;height: 400px;object-fit: cover;"/>
                    </div>
                    <script>
                        document.getElementById('img-{{$img->id}}').addEventListener('contextmenu',(e)=>e.preventDefault())
                    </script>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
            </button>
        </div>
    @endif
    <hr>
    <p>videos</p>
    @foreach ($cours->getFiles('video') as $video)
        <div class="" id="video-container{{ $video->id }}">
            <video src="{{ $video->getUrl() }}" controls class="" type="video/mp4" style="width: 100%;height: 400px;object-fit: cover;">
            </video>
        </div>
    @endforeach
    <hr>
    <p>fichiers pdf</p>
    @foreach ($cours->getFiles('application/pdf') as $fichier)
        <div class="viewer">
            
            <div class="d-flex justify-content-center fw-bold">
                <span>Page: <span id="page_num{{$fichier->id}}"></span> / <span id="page_count{{$fichier->id}}"></span></span>
            </div>
            <div id="spin{{$fichier->id}}">
                <div class="spinner-border text-center d-block mt-5" role="status" id="spinner" >
                </div>
                <span class="">Loading...</span>
            </div>
            <div class="row" style="position:relative">
                <div class="col-1 ctl">
                    <button id="prev{{$fichier->id}}" class="btn  bi bi-caret-left fs-3"></button>
                </div>
                <div class="col-9 ">
                    <canvas id="the-canvas{{$fichier->id}}" class="w-100"></canvas>
                </div>
                <div class="col-1">
                    <button id="next{{$fichier->id}}" class="btn bi bi-caret-right fs-3"></button>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded',(e)=>{
                affichePdf(@json($fichier->id),@json($fichier->getUrl()))
            })
        </script>
    @endforeach
    
   
   
    
</div>

<section class="gradient-custom">
  <div class="container-fluid my-5 py-5 ">
    <div class="row d-flex justify-content-center ">
      <div class="col-md-12 ">
        <div class="card">
          <div class="card-body p-4">
            <h4 class="text-center mb-4 pb-2">Commentaire</h4>

            <div class="row">

              <div class="col">
               @forelse ($cours->commentaires as $comment)
               <div class="d-flex flex-start @if(! $loop->first)mt-4 @endif">
                  <img class="rounded-circle shadow-1-strong me-3"
                    src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(10).webp" alt="avatar" width="65"
                    height="65" />
                  <div class="flex-grow-1 flex-shrink-1">
                    <div>
                      <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-1">
                          {{ $comment->user->full_name() }} - <span class="small d-block d-md-inline fst-italic"> {{$comment->updated_at->diffForHumans() }}</span>
                        </p>
                        <a href="#!"><i class="fas fa-reply fa-xs"></i><span class="small" id="send-{{ $comment->id }}"> repondre</span></a>
                        <script>
                            document.getElementById("send-{{ $comment->id }}").addEventListener('click',(e)=>{
                                let alert=document.getElementById("alert")
                                alert.innerText="Reponse à {{ $comment->user->full_name() }}"
                                alert.parentNode.classList.remove("d-none");
                                document.getElementById("reponse").value="{{ $comment->id }}"
                                document.getElementById("content").focus()
                            });
                        </script>
                      </div>
                      <p class="small mb-0">
                        {{ $comment->content }}
                      </p>
                    </div>
                    @foreach ($comment->reponses as $reponse)
                        <div class="d-flex flex-start mt-4">
                        <a class="me-3" href="#">
                            <img class="rounded-circle shadow-1-strong"
                            src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(11).webp" alt="avatar"
                            width="65" height="65" />
                        </a>
                        <div class="flex-grow-1 flex-shrink-1">
                            <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <p class="mb-1">
                                    {{ $reponse->user->full_name() }} - <span class="small d-block d-md-inline fst-italic"> {{$reponse->updated_at->diffForHumans() }}</span>
                                </p>
                            </div>
                            <p class="small mb-0">
                                {{ $reponse->content }}
                            </p>
                            </div>
                        </div>
                        </div>
                    @endforeach
                  </div>
                </div>
               @empty
                   <h4 class="ms-5">Accun commentaire</h4>
               @endforelse
                
              </div>
            </div>
          </div>
                
          <div class="ms-5" >
                <hr>
                <div class="alert alert-info alert-dismissible d-none " role="alert">
                    <button class="btn-close" data-bs-dismiss="alert" onclick='document.getElementById("reponse").value=" " '></button>
                    <span id="alert"></span>
                </div>
                <form action="{{ route('user.cours.comment.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="cours_id" value="{{ $cours->id }}">
                    <input type="hidden" name="reponse" id="reponse">
                    <div class="w-100 ">
                        <div data-mdb-input-init class="form-outline me-5">
                            <textarea class="form-control" id="content" name="content" rows="2" style="background: #fff; padding-right:100px;" placeholder="Votre commentaire..."></textarea>
                        </div>
                    </div>
                    <div class="float-end mt-2 pt-1 my-5 me-5">
                        <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-sm" >Envoyer</button>
                        <button  type="reset" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary btn-sm">Annuler</button>
                    </div>
                </form>
                    
            </div>
        </div>
      </div>
    </div>
  </div>
</section>
        
    <script src="{{ asset('/pdf/pdf.min.js') }}"></script>
    <script>
       function affichePdf(elt,fichier){
            // Add the link to your PDF FILE.
            const pdfUrl = fichier;

            // Get the container element
            const container = document.getElementById('pdf-container');

            var pdfDoc = null,
            pageNum = 1,
            pageRendering = false,
            pageNumPending = null,
            scale = 2,
            canvas = document.getElementById('the-canvas'+elt),
            ctx = canvas.getContext('2d');

        /**
        * Get page info from document, resize canvas accordingly, and render page.
        * @param num Page number.
        */
        function renderPage(num) {
            pageRendering = true;
            document.getElementById('spin'+elt)?.classList.remove('d-none');
            // Using promise to fetch the page
            pdfDoc.getPage(num).then(function(page) {
            var viewport = page.getViewport({scale: scale});
            canvas.height = viewport.height;
            canvas.width = viewport.width;

            document.querySelectorAll(`#prev${elt},#next${elt}`).forEach((elt)=>{
                elt.style.top=(canvas.offsetHeight/2)+"px";
            });
            // document.querySelector(`#the-canvas${elt}`).style.marginTop="100 px"
            // Render PDF page into canvas context
            var renderContext = {
            canvasContext: ctx,
            viewport: viewport
            };
            var renderTask = page.render(renderContext);

            // Wait for rendering to finish
            renderTask.promise.then(function() {
            pageRendering = false;
                document.getElementById('spin'+elt)?.classList.add('d-none');
                if (pageNumPending !== null) {
                    // New page rendering is pending
                    renderPage(pageNumPending);
                    pageNumPending = null;
                }
                });
                });

                // Update page counters
                document.getElementById('page_num'+elt).textContent = num;
                }

                /**
                * If another page rendering in progress, waits until the rendering is
                * finised. Otherwise, executes rendering immediately.
                */
            function queueRenderPage(num) {
                if (pageRendering) {
                    pageNumPending = num;
                } else {
                    renderPage(num);
                }
                }

                /**
                * Displays previous page.
                */
                function onPrevPage() {
                    if (pageNum <= 1) {
                    return;
                    }
                        pageNum--;
                        queueRenderPage(pageNum);
                    }
                    document.getElementById('prev'+elt).addEventListener('click', onPrevPage);

            /**
            * Displays next page.
            */
            function onNextPage() {
                if (pageNum >= pdfDoc.numPages) {
                return;
                }
                pageNum++;
                queueRenderPage(pageNum);
                }
                document.getElementById('next'+elt).addEventListener('click', onNextPage);

                /**
                * Asynchronously downloads PDF.
                */
                pdfjsLib.getDocument(pdfUrl).promise.then(function(pdfDoc_) {
                pdfDoc = pdfDoc_;
                document.getElementById('page_count'+elt).textContent = pdfDoc.numPages;
                // Initial/first page rendering
                renderPage(pageNum);
                });
            }
    </script>
</x-frontend>
