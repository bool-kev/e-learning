@extends('base_bootstrap')
@section('style')
    @vite('resources/css/otp/style.css')
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
@endsection
@section('content')

    <body>

        <div class="container2">
            <header>
                <i class="bx bxs-check-shield"></i>
            </header>
            <x-session type="danger" key="error"></x-session>
            <x-session key="success"></x-session>
            <div class="alert alert-primary " role="alert">
                un email avec un OTP vous a ete envoyer afin de verifier votre mail
            </div>

            <h4>Enter OTP Code</h4>
            <form action="" method="POST">
                @csrf
                <div class="input-field">
                    <input type="number" name="fields[]" value="" />
                    <input type="number" name="fields[]" value="" disabled />
                    <input type="number" name="fields[]" value="" disabled />
                    <input type="number" name="fields[]" value="" disabled />
                    <input type="number" name="fields[]" value="" disabled />
                    <input type="number" name="fields[]" value="" disabled />
                </div>
                <button class="">Verify OTP</button>
                <a class="btn btn-info mt-3" onclick="history.back()">retour</a>

            </form>
        </div>
        @vite('resources/css/otp/script.js')
    </body>
@endsection
