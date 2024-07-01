@extends('base_bootstrap')
@section('title')
    connexion
@endsection
@section('style')
    @vite(['resources/css/form/style.css'])
@endsection
@section('content')

    <body class="img js-fullheight " style="background-image: url({{ asset('images/bg.jpg') }});">
        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center mb-5">
                        <h2 class="heading-section">Connexion</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="login-wrap p-0">
                            <form action="#" class="signin-form">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Username" required>
									<x-error key="username"></x-error>
                                </div>
                                <div class="form-group">
                                    <input id="password-field" type="password" class="form-control " placeholder="Password"
                                        required>
                                    <span toggle="#password-field"
                                        class="fa fa-fw fa-eye field-icon toggle-password"></span>
									<x-error key="password"></x-error>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
                                </div>
                                <div class="">
                                    <h4 class="text-light">Vous etes nouveau <a href="#" class="text-info">Creer un
                                            compte</a></h4>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-50">
                                        <label class="checkbox-wrap checkbox-primary">Remember Me
                                            <input type="checkbox" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="w-50 text-md-right">
                                        <a href="#" style="color: #fff">Forgot Password</a>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>


    </body>
@endsection
@section('script')
    @vite(['resources/js/form/main.js', 'resources/js/form/jquery.min.js', 'resources/js/app.js'])
@endsection

</html>
