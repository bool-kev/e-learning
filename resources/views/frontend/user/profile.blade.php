@extends('base_bootstrap')
@php($user=request()->user())
@section('style')
    <style>

        .container {
            max-width: 500px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 50px;
        }

        .profile-img {
            position: relative;
            overflow: hidden;
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
            margin-left: auto;
            margin-right: auto;
        }

        .profile-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        .camera-icon {
            position: absolute;
            bottom:0;
            right: 0;
            background: rgb(255, 255, 255);
            border-radius: 20%;
        }

        .camera-icon i {
            font-size: 20px;
            color: #6a11cb;
            cursor: pointer;
        }

        .file-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #6a11cb;
        }

        .profile-button {
            background: #6a11cb;
            border: none;
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: bold;
        }

        .profile-button:hover {
            background: #2575fc;
        }

        .profile-button:focus {
            background: #2575fc;
            box-shadow: none;
        }

        .custom-file-label::after {
            content: "Parcourir";
        }

        .back:hover {
            color: #2575fc;
            cursor: pointer;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .section-title {
            text-align: center;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group-prepend .input-group-text, .form-control {
            height: 40px;
        }

        .profile-img {
            width: 80px;
            height: 80px;
        }

        .profile-img img {
            border-radius: 50%;
        }

        .camera-icon i {
            font-size: 20px;
        }
    </style>
@endsection

@section('content')
    <body>
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center p-3 py-1">
                        <div class="profile-img">
                            <img class="rounded-circle" src="{{ $user->getAvatar() }}" alt="Photo de profil" id="foto">
                            <label class="camera-icon" for="photo">
                                <i class="bi bi-camera-fill"></i>
                                
                            </label>
                        </div>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-3 py-5">
                        <div class="form-section">
                            <h6 class="section-title">Modifier le profil</h6>
                            <form action="{{ route('user.profile.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @error('photo')
                                    <label for="photo" class="text-danger">{{$message}}👇</label>     
                                @enderror
                                <input type="file" class="file-input" id="photo" name="photo" accept="image/*">
                                @error('nom')
                                    <label for="nom" class="text-danger">{{$message}}👇</label>     
                                @enderror
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('nom')is-invalid @enderror" placeholder="Nom" name="nom" value="{{ $user->nom }}">
                                    </div>
                                </div>
                                @error('prenom')
                                    <label for="prenom" class="text-danger">{{$message}}👇</label>     
                                @enderror
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('prenom') is-invalid @enderror" placeholder="Prénom" name="prenom" value="{{ $user->prenom }}">
                                    </div>
                                </div>
                                @error('telephone')
                                    <label for="telephone" class="text-danger">{{$message}}👇</label>     
                                @enderror
                                <div class="form-group ">
                                    <div class="input-group mb-5">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                        </div>
                                        <input type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ $user->telephone }}" required>
                                    </div>
                                </div>
                                @error('current_password')
                                    <label for="current_password" class="text-danger">{{$message}}👇</label>     
                                @enderror
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                        </div>
                                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" value="" placeholder="Mot de passe actuel ">
                                    </div>
                                </div>

                                @error('password')
                                    <label for="password" class="text-danger">{{$message}}👇</label>     
                                @enderror
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                        </div>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror " name="password" value="" placeholder="nouveau mot de passe ">
                                    </div>
                                </div>
                                @error('password_confirmation')
                                    <label for="password_confirmation" class="text-danger">{{$message}}👇</label>     
                                @enderror
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                                        </div>
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" value=""  placeholder="confirmer">
                                    </div>
                                </div>
                                <div class="mt-5 text-center">
                                    <button class="btn btn-primary profile-button" type="submit">Mettre a jour</button>
                                </div>
                                <div class=" text-center">
                                    <a class="btn btn-secondary mt-2" href="{{route('user.cours.root')}}">quitter</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.querySelector('#photo').addEventListener('change', function (e) {
                var fileName = document.getElementById("photo").files[0];
                document.getElementById("foto").src=URL.createObjectURL(fileName);
            });
        </script>
    </body>
@endsection
