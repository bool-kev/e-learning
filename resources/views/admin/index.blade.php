{{-- @dd($matiere); --}}
<x-admin :matiere="$matiere">
    <form action="" method="get">
        <div class="row justify-content-around">
            <div class="col-8">
                <div class="form-group form-floating">
                    <select name="niveau" id="niveau" class="form-select">
                        @foreach ($matiere->faculte->classes ?? [] as $niveau)
                            <option value="{{ $niveau->id }}" @selected($matiere->niveau_id === $niveau->id)>{{ $niveau->libelle }}
                            </option>
                        @endforeach
                    </select>
                    <label for="niveau" class="niveau">Niveau</label>
                    <script>
                        document.querySelector('#niveau').addEventListener('change', (e) => {
                            let url = `{{ route('admin.index', ['faculte' => $matiere->faculte, 'niveau' => 'LEVEL']) }} `;
                            url = url.replace('LEVEL', e.target.selectedOptions[0].value);
                            document.location = url;
                        })
                    </script>
                </div>
            </div>
            
        </div>
    </form>
    <hr>
    <div class="label d-flex justify-content-around flex-nowrap">

        <div class="col-lg-8 text-end">
            <ul class="nav nav-pills d-inline-flex text-center mb-1">
                <li class="nav-item">
                    <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-1">
                        <span class="text-dark" style="width: 130px;">Cours</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-2">
                        <span class="text-dark" style="width: 130px;">Evaluations</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                        <span class="text-dark" style="width: 130px;">Exercices</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <div class="tab-content">
        <div id="tab-1" class="tab-pane fade show p-0 active">
            <!---kill --->
            <hr>
            <div class="d-flex justify-content-around">
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
                            <td class=""><a
                                    href="{{ route('admin.cours.index', ['slug' => Str::slug($chapitre->titre), 'chapitre' => $chapitre]) }}">{{ $chapitre->titre }}</a>
                            </td>
                            <td class="pe-0">
                                <a href="{{ route('admin.chapitre.edit', $chapitre) }}"><i
                                        class="bi bi-pencil-square btn btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#ModalEdit{{ $chapitre->id }}"></i></a>
                                <i class="bi bi-trash3-fill btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#ModalDelete{{ $chapitre->id }}"></i>
                            </td>

                            <!-- Modal -->
                            <div class="modal fade" id="ModalDelete{{ $chapitre->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">confirmation de suppression</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h1>Voulez-vous supprimer <span
                                                    class="fw-bold fst-italic">{{ $chapitre->titre }}</span> ?</h1>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-info"
                                                data-bs-dismiss="modal">annuler</button>
                                            <form action="{{ route('admin.chapitre.delete', $chapitre) }}"
                                                method="post">
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
                        <tr>
                            <td colspan="3">Aucun chapitre enregistrer pour cette matiere</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <!---endkill --->

        </div>
        <div id="tab-2" class="tab-pane fade show p-0">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="rounded position-relative fruite-item">
                                <div class="fruite-img">
                                    <img src="img/fruite-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                                </div>
                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                    style="top: 10px; left: 10px;">Fruits</div>
                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                    <h4>Grapes</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te
                                        incididunt</p>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                        <a href="#"
                                            class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="rounded position-relative fruite-item">
                                <div class="fruite-img">
                                    <img src="img/fruite-item-2.jpg" class="img-fluid w-100 rounded-top" alt="">
                                </div>
                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                    style="top: 10px; left: 10px;">Fruits</div>
                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                    <h4>Raspberries</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te
                                        incididunt</p>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                        <a href="#"
                                            class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="tab-3" class="tab-pane fade show p-0">
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="row g-4">
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="rounded position-relative fruite-item">
                                <div class="fruite-img">
                                    <img src="img/fruite-item-1.jpg" class="img-fluid w-100 rounded-top"
                                        alt="">
                                </div>
                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                    style="top: 10px; left: 10px;">Fruits</div>
                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                    <h4>Oranges</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te
                                        incididunt</p>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                        <a href="#"
                                            class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="rounded position-relative fruite-item">
                                <div class="fruite-img">
                                    <img src="img/fruite-item-6.jpg" class="img-fluid w-100 rounded-top"
                                        alt="">
                                </div>
                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                    style="top: 10px; left: 10px;">Fruits</div>
                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                    <h4>Apple</h4>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod te
                                        incididunt</p>
                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                        <p class="text-dark fs-5 fw-bold mb-0">$4.99 / kg</p>
                                        <a href="#"
                                            class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                                class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


</x-admin>
