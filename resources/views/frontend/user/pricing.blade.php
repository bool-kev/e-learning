<x-root>
    @vite('resources/frontend/css/pricing.css')
    <!-- Pricing Section -->
    <section id="pricing" class="pricing section">

        <!-- Section Title -->
        <div class="" data-aos="fade-up">
            <p class="fs-2 fw-bold fst-italic">l'acces a la plateforme requiert un abonnement.Veuillez choisir un abonnement</p>
        </div><!-- End Section Title -->
        <x-error key="plan"></x-error>
        <div class="container">
            <x-session type="danger" key="error"></x-session>
            <div class="row gy-4">
    
            <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="200">
                <div class="pricing-item">
                <div class="container d-flex flex-column align-items-center py-2">
                    <h3>Offre standard</h3>
                    <h4><sup>XOF</sup>100<span> / an</span></h4>
                    <ul>
                        <li><i class="bi bi-check"></i> <span>acces exclusif aux cours</span></li>
                        <li><i class="bi bi-check"></i> <span>composer les evaluations</span></li>
                        <li><i class="bi bi-check"></i> <span>suivre son niveau </span></li>
                        <li class="na"><i class="bi bi-x"></i> <span>Acces exclusifs aux fichiers sources</span></li>
                        <li class="na"><i class="bi bi-x"></i> <span>Telchargements des ressources</span></li>
                    </ul>
                    <form action="{{route('user.subscribe')}}" method="post">
                        @csrf
                        <input type="hidden" name="plan" value="standard">
                        <button class="buy-btn">Souscrire</button>
                    </form>
                </div>
                </div>
            </div><!-- End Pricing Item -->
    
            <div class="col-lg-6" data-aos="zoom-in" data-aos-delay="300">
                <div class="pricing-item">
                    <div class="container d-flex flex-column align-items-center py-2">
                        <h3>Offre premium</h3>
                        <h4><sup>XOF</sup>150<span> / an</span></h4>
                        <ul>
                            <li><i class="bi bi-check"></i> <span>acces exclusif aux cours</span></li>
                            <li><i class="bi bi-check"></i> <span>composer les evaluations</span></li>
                            <li><i class="bi bi-check"></i> <span>suivre son niveau </span></li>
                            <li><i class="bi bi-check"></i> <span>Acces exclusifs aux fichiers sources</span></li>
                            <li><i class="bi bi-check"></i> <span>Telchargements des ressources</span></li>
                        </ul>
                        <form action="{{route('user.subscribe')}}" method="post">
                            @csrf
                            <input type="hidden" name="plan" value="premium">
                            <button class="buy-btn">Souscrire</button>
                        </form>
                    </div>
                </div>
            </div><!-- End Pricing Item -->
    
            </div>
    
        </div>
    
        </section><!-- /Pricing Section -->
</x-root>