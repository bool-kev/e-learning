
<x-root>
    @vite('resources/frontend/css/form.css')
    <section class="wrapper @if(request()->route()->getName()==='user.login.form')active @endif">
      <div class="form signup">
        <header>Signup</header>
        <form action="{{route('user.register')}}" method="post">
          @csrf
          <div class="row">
            <div class="col-md-6 ">
              <input name="nom" type="text" placeholder="Nom" class="w-100 @error('nom') is-invalid @enderror"  value="{{old('nom')}}"/>
              @error('nom')
                <label for="nom" class="text-danger">{{$message}}</label>
              @enderror
            </div>
            <div class="col-md-6 mt-3 mt-md-0">
              <input name="prenom" type="text" placeholder="Prenom" class="w-100 @error('prenom') is-invalid @enderror"  value="{{old('prenom')}}"/>
              @error('prenom')
                <label for="prenom" class="text-danger">{{$message}}</label>
              @enderror
            </div>
          </div>

          <input name="email" type="email" placeholder="Email address"  required value="{{old('email')}}"/>
          @error('email')
            <label for="email" class="text-danger">{{$message}}</label>
          @enderror

          <input name="telephone" type="text" placeholder="numero de telephone" required value="{{old('telephone')}}"/>
          @error('telephone')
            <label for="telephone" class="text-danger">{{$message}}</label>
          @enderror

          <select name="niveau"  class="form-control @error('niveau')is-invalid  @enderror" name="niveau">  
            <option value="">Niveau</option>
            @foreach ($niveaux as $niveau)
                <option value="{{$niveau->id}}" @selected($eleve->niveau_id===$niveau->id)>{{ $niveau->libelle }}</option>
            @endforeach
          </select>

          <input  name="password" type="password" placeholder="mot de passe" required />
          @error('telephone')
            <label for="telephone" class="text-danger">{{$message}}</label>
          @enderror

          <input  name="password_confirmation" type="password" placeholder="confirmation de mot de passe" required />
          @error('telephone')
            <label for="telephone" class="text-danger">{{$message}}</label>
          @enderror
          <p class="text-center text-light" style="cursor: pointer">Vous avez deja un compte ?<a class="text-black"  onclick="document.querySelector('.login header').dispatchEvent(new Event('click'));">se connecter</a></p>

          {{-- <div class="checkbox">
            <input type="checkbox" id="signupCheck" />
            <label for="signupCheck">I accept all terms & conditions</label>
          </div> --}}
          <input type="submit" value="Signup" />
        </form>
      </div>

      <div class="form login">
        <header>Login</header>
        <form action="{{route('user.login')}}" method="post" class="mt-3">
          @csrf
          @error('fields')
              <div class="alert alert-danger">! {{$message}}</div>
          @enderror
          <x-session key="error" type="danger"></x-session>
          <x-session key="success"></x-session>
          <x-error key="email"></x-error>
          <x-error key="telephone"></x-error>
          <ul class="nav nav-pills d-inline-flex text-center">
            <li class="nav-item">
                <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-1">
                    <span class="text-dark" style="width: 100px;">Email</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-2">
                    <span class="text-dark" style="width: 100px;">Telephone</span>
                </a>
            </li>
            
          </ul>
          <div class="tab-content">
            <div id="tab-1" class="tab-pane fade show p-0 active">
              <input id="email" name="email" type="email" class="w-100" placeholder="Email address" value="{{old('email')}}"/>
              @error('email')
                <label for="email" class="text-danger">{{$message}}</label>
              @enderror
            </div>
            <div id="tab-2" class="tab-pane fade show p-0">
              <input id="telephone" name="telephone" type="text" class="w-100" placeholder="numero de telephone" />
              @error('telephone')
                <label for="telephone" class="text-danger">{{$message}}</label>
              @enderror
            </div>
            
        </div>

          <input name="password" type="password" placeholder="Password" required />
          @error('password')
              <label for="password" class="text-danger">{{$message}}</label>
          @enderror
          <div class="checkbox mb-2">
            <input type="checkbox" id="remember" name="remember"/>
            <label for="remember" class="text-black">rester connecter</label>
            <a href="#" class="ms-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop"  role="button">mot de passe oublie?</a>

          </div>
          <p class="text-center m-0 p-0">Vous etes nouveau ?<a class="text-primary" style="cursor: pointer" onclick="document.querySelector('.signup header').dispatchEvent(new Event('click'));">s'inscrire</a></p>
          <input type="submit" value="Login" class="m-0 p-0"/>
        </form>
       
      </div>

      <script>
        const wrapper = document.querySelector(".wrapper"),
          signupHeader = document.querySelector(".signup header"),
          loginHeader = document.querySelector(".login header");

        loginHeader.addEventListener("click", () => {
          wrapper.classList.add("active");
          history.pushState(null,'','login');
        });
        signupHeader.addEventListener("click", () => {
          wrapper.classList.remove("active");
          history.pushState(null,'','register');

        });
      </script>
    </section>
    
</x-root>
 <!-- Modal -->
 <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="{{route('user.request.send')}}" method="post">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Mot de passe oublie</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input class="form-control" name="email" type="email" placeholder="email" required />
            @error('email')
                <label for="email" class="text-danger">{{$message}}</label>
            @enderror
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">annuler</button>
          <button type="submit" class="btn btn-primary">renitialiser</button>
        </div>
      </div>
    </form>
  </div>
</div> 