@extends('base_bootstrap')
@section('title')
    Inscription
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
                        <h2 class="heading-section">Login #10</h2>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="login-wrap p-0">
                            <h3 class="mb-4 text-center">Have an account?</h3>
                            <form action="#" class="signin-form">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="nom" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="prenom" required>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="email" required>
                                </div>

                                <div class="form-group">
                                    <input id="password-field" type="password" class="form-control" placeholder="Password"
                                        required>
                                    <span toggle="#password-field"
                                        class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
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
