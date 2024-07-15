<x-admin>
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
                                                                alert.innerText = "Reponse à {{ $comment->user->full_name() }}"
                                                                alert.parentNode.classList.remove("d-none");
                                                                document.getElementById("reponse").value = "{{ $comment->id }}"
                                                                document.getElementById("content").focus()
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
                                <button class="btn-close" data-bs-dismiss="alert"
                                    onclick='document.getElementById("reponse").value=" " '></button>
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
                                        <textarea class="form-control" id="content" name="content" rows="2"
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
</x-admin>