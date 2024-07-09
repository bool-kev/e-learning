@extends('base_bootstrap')
@section('content')
    <body class="container">
        <div class="container">
            <x-session key="success"></x-session>
            <x-session key="error" type="danger"></x-session>

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
              <div class="container">
                <div class="row justify-content-center">
                  <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">
                    <div class="card mb-3">
                      <div class="card-body">
                        <div class="pt-4 pb-2">
                          <h5 class="card-title text-center pb-0 fs-4">Connexion espace admin</h5>
                        </div>
      
                        <form class="row g-3 needs-validation" action="{{route('admin.login')}}" method="POST">
                            @csrf
                          <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group has-validation">
                              <span class="input-group-text" id="inputGroupPrepend">@</span>
                              <input type="email" name="email" class="form-control @error('email')is-invalid  @enderror" id="email" required>
                              <div class="invalid-feedback">email</div>
                              @error('email')
                                <label for="email" class="text-danger">{{ $message }}</label>
                              @enderror
                            </div>
                          </div>
      
                          <div class="col-12">
                            <label for="password" class="form-label">mot de passe</label>
                            <input type="password" name="password" class="form-control @error('password')is-invalid  @enderror" id="password" required>
                            <div class="invalid-feedback">Please enter your password!</div>
                            @error('password')
                                <label for="password" class="text-danger">{{ $message }}</label>
                            @enderror
                          </div>
      
                          <div class="col-12">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                              <label class="form-check-label" for="rememberMe">se souvenir de moi</label>
                            </div>
                          </div>
                          <div class="col-12">
                            <button class="btn btn-primary w-100" type="submit">se connecter</button>
                          </div>
                        </form>
      
                      </div>
                    </div>
      
      
                  </div>
                </div>
              </div>
      
            </section>
      
          </div>
    </body>
@endsection
