<x-frontend :chapitre="$cours->chapitre">
    <style>
        #the-canvas {
            border: 1px solid black;
            direction: ltr;
        }

        .rounded-pill.active {
            background-color: #4070f4 !important;
        }

        .hover:hover {
            background-color: rgb(99, 95, 95, 0.3);
            color: white;
            border-radius: 15%;
        }

        .col-1 button {
            position: relative;
            z-index: 2;

        }

        @media (max-width: 768px) {
            canvas {
                transition: transform 0.3s ease;
                scale: 1.3;
                margin-top: 55px;
            }

            .col-1 button {
                margin-top: 50px;
            }
        }

        .marge {
            opacity: 1 !important;
            color: black;
            z-index: 1;
        }

        .page-header {
            position: relative;
            background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3));
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>



    <div class="container-fluid page-header py-5" style="background-image: url({{ $cours->getCover() }})">
        <h1 class="text-center text-white display-6">{{ $cours->titre }}</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">cours</a></li>
            <li class="breadcrumb-item text-white">{{$cours->titre}}</li>
        </ol>
    </div>

    <div class="container">

        <p class="my-3 border border-2">
            {!! $cours->content !!}
        </p>
        <hr>
        <div class="label d-flex justify-content-around ">

            <div class="">
                <ul class="nav nav-pills d-inline-flex text-center mb-1 ">
                    <li class="nav-item ">
                        <a class="d-flex m-2 py-2 bg-light rounded-pill border link-underline link-underline-opacity-0 active"
                            data-bs-toggle="pill" href="#tab-1">
                            <span class="text-dark" style="width: 100px;">images</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex py-2 m-2 bg-light rounded-pill border link-underline link-underline-opacity-0 @if (request()->tab === 'eval') active @endif"
                            data-bs-toggle="pill" href="#tab-2">
                            <span class="text-dark" style="width: 100px;" id="eval">videos</span>
                        </a>

                    </li>
                    <li class="nav-item">
                        <a class="d-flex m-2 py-2 bg-light rounded-pill border link-underline link-underline-opacity-0"
                            data-bs-toggle="pill" href="#tab-3">
                            <span class="text-dark" style="width: 100px;">pdf</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="d-flex m-2 py-2 bg-light rounded-pill border link-underline link-underline-opacity-0"
                            data-bs-toggle="pill" href="#tab-4">
                            <span class="text-dark" style="width: 100px;">Questions</span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="tab-content">
            <div id="tab-1" class="tab-pane fade  p-0 show active">
                @if (count($images = $cours->getFiles('image')))
                    <div id="carouselExampleCaptions" class="carousel slide">
                        <div class="carousel-indicators">
                            @foreach ($images as $img)
                                <button type="button" data-bs-target="#carouselExampleCaptions"
                                    data-bs-slide-to="{{ $loop->index }}" @class(['active' => $loop->first])></button>
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach ($images as $img)
                                <div @class(['carousel-item', 'active' => $loop->first]) id="img-{{ $img->id }}">
                                    <img class="d-block w-100" src="{{ $img->getUrl() }}"
                                        style="width: 100%;height: 400px;object-fit: cover;" />
                                </div>
                                <script>
                                    document.getElementById('img-{{ $img->id }}').addEventListener('contextmenu', (e) => e.preventDefault())
                                </script>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    @if(request()->user()->eleve->is_admin)
                        @foreach ($images as $img)
                            <a href="{{$img->getPublicUrl()}}" class="btn btn-primary me-2 mt-2 rounded-pill" target="blank" download="document{{$img->id}}">Telecharger</a>
                        @endforeach
                    @endif
                @else
                    <p class="text-center mt-3 fw-bold">Aucune image associée à cet cours</p>
                @endif
            </div>
            <div id="tab-2" class="tab-pane fade p-0">
                @forelse ($videos=$cours->getFiles('video') as $video)
                    <div class="" id="video-container{{ $video->id }}">
                        <video src="{{ $video->getUrl() }}" controls class="" type="video/mp4"
                            style="width: 100%;height: 400px;object-fit: cover;">
                        </video>
                    </div>

                @empty
                    <p class="text-center mt-3 fw-bold">Aucune video associée à cet cours</p>
                @endforelse
                @if(request()->user()->eleve->is_admin)
                    @foreach ($videos as $video)
                        <a href="{{$video->getPublicUrl()}}" class="btn btn-primary me-2 mt-2 rounded-pill" target="blank" download="document{{$video->id}}">Telecharger</a>
                    @endforeach
                @endif
            </div>
            <div id="tab-3" class="tab-pane fade p-0">
                @forelse ($cours->getFiles('application/pdf') as $fichier)
                    <div class="viewer mt-5 py-3">

                        <div class="d-flex justify-content-center fw-bold">
                            @if(request()->user()->eleve->is_admin)
                                <a href="{{$fichier->getPublicUrl()}}" class="btn btn-primary me-3 mb-3 rounded-pill" target="blank" download="document{{$fichier->id}}">Telecharger</a>
                            @endif
                            <span>Page: <span id="page_num{{ $fichier->id }}"></span> / <span
                                    id="page_count{{ $fichier->id }}"></span></span>
                                
                        </div>
                        <div id="spin{{ $fichier->id }}">
                            <div class="spinner-border text-center d-block mt-5" role="status" id="spinner">
                            </div>
                            <span class="">Loading...</span>
                        </div>
                        <div class="row" style="position:relative">
                            <div class="col-1 ctl">
                                <button id="prev{{ $fichier->id }}" class="btn  bi bi-caret-left fs-3"></button>
                            </div>
                            <div class="col-9">
                                <canvas id="the-canvas{{ $fichier->id }}" class="w-100"></canvas>
                            </div>
                            <div class="col-1">
                                <button id="next{{ $fichier->id }}" class="btn bi bi-caret-right fs-3"></button>
                            </div>
                        </div>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', (e) => {
                            affichePdf(@json($fichier->id), @json($fichier->getUrl()))
                        })
                    </script>
                @empty
                    <p class="text-center mt-3 fw-bold">Aucun fichier pdf associée à cet cours</p>
                @endforelse
            </div>
            <div id="tab-4" class="tab-pane fade p-0">
                <section class="gradient-custom">
                    <div class="container-fluid my-5 py-5 ">
                        <div class="row d-flex">
                            <div class="col-md-12 ">
                                <div class="card">
                                    <div class="card-body p-4">
                                        <h4 class="text-center mb-4 pb-2">Questions</h4>

                                        <div class="row">

                                            <div class="col">
                                                @forelse ($cours->commentaires as $comment)
                                                    <div
                                                        class="d-flex flex-start @if (!$loop->first) mt-4 @endif">
                                                        <img class="rounded-circle shadow-1-strong me-3"
                                                                src="{{$comment->user->getAvatar()}}"
                                                                alt="avatar" width="45" height="45" />
                                                        <div class="flex-grow-1 flex-shrink-1">
                                                            <div>
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <p class="mb-1 small">
                                                                        {{ $comment->getUser(request()->user()) }} - <span
                                                                            class="small d-block d-md-inline fst-italic">
                                                                            {{ $comment->updated_at->diffForHumans() }}</span>
                                                                            @if ($comment->user->is_staff())
                                                                                <span class="bg-primary">{{$comment->user->statut}}</span>
                                                                            @endif
                                                                    </p>
                                                                    <p style="cursor: pointer"><i
                                                                            class="bi bi-reply-all-fill"></i><span
                                                                            class="small text-primary"
                                                                            id="send-{{ $comment->id }}">
                                                                            repondre</span></p>
                                                                    <script>
                                                                        document.getElementById("send-{{ $comment->id }}").addEventListener('click', (e) => {
                                                                            let alert = document.getElementById("alert")
                                                                            alert.innerText = "Reponse à {{ $comment->getUser(request()->user()) }}"
                                                                            alert.parentNode.classList.remove("d-none");
                                                                            document.getElementById("reponse").value = "{{ $comment->id }}"
                                                                            document.getElementById("content2").focus()
                                                                        });
                                                                    </script>
                                                                </div>
                                                                <p class="small mb-0 ms-3">
                                                                    {{ $comment->content }}
                                                                </p>
                                                            </div>
                                                            @foreach ($comment->reponses as $reponse)
                                                                <div class="d-flex flex-start mt-4">
                                                                    <a class="me-3" href="#">
                                                                        <img class="rounded-circle shadow-1-strong"
                                                                            src="{{$reponse->user->getAvatar()}}"
                                                                            alt="avatar" width="45" height="45" />
                                                                    </a>
                                                                    <div class="flex-grow-1 flex-shrink-1">
                                                                        <div>
                                                                            <div
                                                                                class="d-flex justify-content-between align-items-center">
                                                                                <p class="mb-1 small">
                                                                                    {{ $reponse->getUser(request()->user()) }} -
                                                                                    <span
                                                                                        class="small d-block d-md-inline fst-italic">
                                                                                        {{ $reponse->updated_at->diffForHumans() }}</span>
                                                                                        @if ($reponse->user->is_staff())
                                                                                            <span class="bg-primary">{{$reponse->user->statut}}</span>
                                                                                        @endif   
                                                                                </p>
                                                                            </div>
                                                                            <p class="small mb-0 ms-2">
                                                                                {{ $reponse->content }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                @empty
                                                    <h4 class="ms-5">Aucune question n'a été poser</h4>
                                                @endforelse

                                            </div>
                                        </div>
                                    </div>

                                    <div class="ms-5">
                                        <hr>
                                        <div class="alert alert-info alert-dismissible d-none " role="alert">
                                            <button class="btn-close" 
                                                id="closer"></button>
                                            <span id="alert"></span>
                                            <script>
                                                document.getElementById('closer').addEventListener('click',(e)=>{
                                                    document.getElementById("reponse").value=" ";
                                                    document.getElementById("alert").parentNode.classList.add("d-none");
                                                })
                                            </script>
                                        </div>
                                        <form action="{{ route('user.cours.comment.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="cours_id" value="{{ $cours->id }}">
                                            <input type="hidden" name="reponse" id="reponse">
                                            <div class="w-100 ">
                                                <div data-mdb-input-init class="form-outline me-5">
                                                    <textarea class="form-control" id="content2" name="content" rows="2"
                                                        style="background: #fff; padding-right:100px;" placeholder="Votre commentaire..."></textarea>
                                                </div>
                                            </div>
                                            <div class="float-end mt-2 pt-1 my-5 me-5">
                                                <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                                    class="btn btn-primary btn-sm">Envoyer</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>



    <script src="{{ asset('/pdf/pdf.min.js') }}"></script>
    <script>
        function affichePdf(elt, fichier) {
            // Add the link to your PDF FILE.
            const pdfUrl = fichier;

            // Get the container element
            const container = document.getElementById('pdf-container');

            var pdfDoc = null,
                pageNum = 1,
                pageRendering = false,
                pageNumPending = null,
                scale = 2,
                canvas = document.getElementById('the-canvas' + elt),
                ctx = canvas.getContext('2d');

            /**
             * Get page info from document, resize canvas accordingly, and render page.
             * @param num Page number.
             */
            function renderPage(num) {
                pageRendering = true;
                document.getElementById('spin' + elt)?.classList.remove('d-none');
                // Using promise to fetch the page
                pdfDoc.getPage(num).then(function(page) {
                    var viewport = page.getViewport({
                        scale: scale
                    });
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    document.querySelectorAll(`#prev${elt},#next${elt}`).forEach((elt) => {
                        elt.style.top = (canvas.offsetHeight / 2) + "px";
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
                        document.getElementById('spin' + elt)?.classList.add('d-none');
                        if (pageNumPending !== null) {
                            // New page rendering is pending
                            renderPage(pageNumPending);
                            pageNumPending = null;
                        }
                    });
                });

                // Update page counters
                document.getElementById('page_num' + elt).textContent = num;
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
            document.getElementById('prev' + elt).addEventListener('click', onPrevPage);

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
            document.getElementById('next' + elt).addEventListener('click', onNextPage);

            /**
             * Asynchronously downloads PDF.
             */
            pdfjsLib.getDocument(pdfUrl).promise.then(function(pdfDoc_) {
                pdfDoc = pdfDoc_;
                document.getElementById('page_count' + elt).textContent = pdfDoc.numPages;
                // Initial/first page rendering
                renderPage(pageNum);
            });
        }
    </script>
</x-frontend>
