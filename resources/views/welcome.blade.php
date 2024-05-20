<!DOCTYPE html>


<html lang="zxx">


<!-- Mirrored from duruthemes.com/demo/html/renax/light/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 Apr 2024 19:09:16 GMT -->
@include('layouts.head')
@livewireStyles


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
       $('.marque').change(function () {
           var marque_id = $(this).val();
           var modele = $(this).closest('.row').find('.modele');
           modele.empty();
           modele.append('<option value="">aucune</option>');
           if (marque_id == "autre") {
                $('.marque-select .select1_wrapper').hide();
                $('.marque-autre-wrapper').show();
                $('.modele-wrapper').hide();
                $('.modele-autre-wrapper').show();
                $('.version-wrapper').hide();
                $('.version-autre-wrapper').show();
           } else {
                $('.marque-select .select1_wrapper').show();
                $('.marque-autre-wrapper').hide();
                $('.modele-wrapper').show();
                $('.modele-autre-wrapper').hide();
                $('.version-wrapper').show();
                $('.version-autre-wrapper').hide();
                $.ajax({
                    type: 'GET',
                    url: '/modele/' + marque_id,
                    success: function (response) {
                        var models = response;
                        $.each(models, function (index, model) {
                            modele.append('<option  value="' + model.id + '">' + model.nomModel + '</option>');
                        });
                        modele.append('<option value="autre">Autre</option>');
                    }
                });
           }
       });

       $('.modele').change(function () {
            var modele_id = $(this).val();
            var version = $(this).closest('.row').find('.version');
            version.empty();
            version.append('<option value="">aucune</option>');
            if (modele_id == "autre") {
                $('.modele-wrapper').hide();
                $('.modele-autre-wrapper').show();
                $('.version-wrapper').hide();
                $('.version-autre-wrapper').show();
            } else {
                $('.version-wrapper').show();
                $('.version-autre-wrapper').hide();
                $.ajax({
                    type: 'GET',
                    url: '/version/' + modele_id,
                    success: function (response) {
                        var versions = response;
                        $.each(versions, function (index, version) {
                            $('.version').append('<option value="' + version.id + '">' + version.nomVersion + '</option>');
                        });
                        $('.version').append('<option value="autre">Autre</option>');
                    }
                });
            }
        });

        $('.version').change(function () {
            var version_id = $(this).val();
            if (version_id == "autre") {
                $('.version-wrapper').hide();
                $('.version-autre-wrapper').show();
            }
        });
    });
</script>









 
<body>
    @if(Session::has('success'))
    <div class="modal-backdrop fade show"></div>
    <div class="modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Succès !</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>{{ Session::get('success') }}</p>
                </div>
            </div>
        </div>
    </div>
@endif







    <!-- Preloader -->
    <div class="preloader-bg"></div>
    <div id="preloader">
        <div id="preloader-status">
            <div class="preloader-position loader"> <span></span> </div>
        </div>
    </div>
    <!-- Progress scroll totop -->
    <div class="progress-wrap cursor-pointer">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <div class="logo-wrapper">
                <a class="logo" href="{{ route('/') }}">
                    
                    <h2><span style="color: #f5b754;">En</span>chère</h2>


                </a>
                
                <!-- <a class="logo" href="index.html"><h2>Renta<span>x</span></h2></a> -->
            </div>
            <!-- Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"><i class="fa-solid fa-bars"></i></span> </button>
            <!-- Menu -->
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown"> <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">Voitures <i class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('voitures.index') }}" class="dropdown-item "><span>Découvrir nos voitures</span></a></li>
                            @if(auth()->check())
                            <li><a  data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" href="#0"><span>Vendre une voiture</span></a></li>
                            @else
                            <li><a data-bs-toggle="" data-bs-target="" data-bs-whatever="@mdo" href="{{route('login')}}"><span>Vendre une voiture</span></a></li>
                            @endif
                        </ul>
                    </li>
                    
        
                    @if(auth()->check())
                    <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"> {{ Auth::user()->name }} <i class="ti-angle-down"></i></a>
                        <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();">
                             {{ __('Logout') }}
                         </a>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                        </li>
                        </ul>
                    </li>
                    @else
                    <li class="nav-item "> <a class="nav-link " href="{{ route('login') }}" role="button"  data-bs-auto-close="outside" aria-expanded="false"> Login </a>
                    @endif
                </ul>
                <div class="navbar-right">
                    <div class="wrap">
                        <div class="icon"> <i class="fa fa-envelope"></i> </div>
                        <div class="text">
                            <p>Besoin d'aide?</p>
                            <h5><a href="mailto:enchere@gmail.com">enchere@gmail.com</a></h5>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </nav>
    <!-- Slider -->
   
<header class="header slider-fade">
    <div class="owl-carousel owl-theme">
        <!-- The opacity on the image is made with "data-overlay-dark="number". You can change it using the numbers 0-9. -->
        <div class="item bg-img" data-overlay-dark="5" data-background="img/slider/11.jpg">
            <div class="v-middle caption">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-30">
                            <div class="v-middle">
                                <h6>Premium</h6>
                                <h1>Voiture</h1>
                                <h5>Vente aux enchères <span> <i></i></span></h5> <a href="{{ route('voitures.index') }}" class="button-1 mt-15 mb-15">Découvrir nos voitures <span class="ti-arrow-top-right"></span></a> 
                                @if(auth()->check())
                                <a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" href="#0" class="button-2 mt-15 mb-15">Vendre une voiture<span class="ti-arrow-top-right"></span></a>
                                @else
                                <a data-bs-toggle="" data-bs-target="#" data-bs-whatever="@mdo" href="{{route('login')}}" class="button-2 mt-15 mb-15">Vendre une voiture<span class="ti-arrow-top-right"></span></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item bg-img" data-overlay-dark="5" data-background="img/slider/12.jpg">
            <div class="v-middle caption">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-30">
                            <div class="v-middle">
                                <h6>* Premium</h6>
                                <h1>Voiture</h1>
                                <h5>Vente aux enchères <span> <i></i></span></h5> <a href="{{ route('voitures.index') }}" class="button-1 mt-15 mb-15">Découvrir nos voitures <span class="ti-arrow-top-right"></span></a> <a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" href="#0" class="button-2 mt-15 mb-15">Vendre une voiture <span class="ti-arrow-top-right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="item bg-img" data-overlay-dark="5" data-background="img/slider/14.jpg">
            <div class="v-middle caption">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-30">
                            <div class="v-middle">
                                <h6>* Premium</h6>
                                <h1>Voiture</h1>
                                <h5> <span> <i>Vente aux enchères</i></span></h5> <a href="{{ route('voitures.index') }}" class="button-1 mt-15 mb-15">Découvrir nos voitures <span class="ti-arrow-top-right"></span></a> <a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" href="#0" class="button-2 mt-15 mb-15">Vendre une voiture <span class="ti-arrow-top-right"></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
   
    <!-- About -->
    <section class="about section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-30">
                    <div class="content">
                        <div class="section-subtitle">Enchere</div>
                        <div class="section-title">Trouvez votre voiture de rêve à des prix incroyables  <span> Rejoignez nos enchères maintenant!</span></div>
                        <p class="mb-30">Rejoignez notre communauté de passionnés d'automobiles et découvrez des offres exclusives sur les voitures de vos rêves. Lancez-vous dès maintenant dans l'aventure des enchères en ligne avec nous!</p>
                        <ul class="list-unstyled list mb-30">
                            <li>
                                <div class="list-icon"> <span class="ti-check"></span> </div>
                                <div class="list-text">
                                    <p>Voitures de sport et de luxe</p>
                                </div>
                            </li>
                            <li>
                                <div class="list-icon"> <span class="ti-check"></span> </div>
                                <div class="list-text">
                                    <p>Voitures économiques</p>
                                </div>
                            </li>
                            
                        </ul> <a href="{{ route('voitures.index') }}" class="button-4">Découvrir nos voiture <span class="ti-arrow-top-right"></span></a>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1 col-md-12">
                    <div class="item"> <img src="img/cars/01.jpg" class="img-fluid" alt="">
                        <div class="curv-butn icon-bg">
                            <a href="https://youtu.be/1LxcTt1adfY" class="vid">
                                <div class="icon"> <i class="ti-control-play"></i> </div>
                            </a>
                            <div class="br-left-top">
                                <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                    <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#fff"></path>
                                </svg>
                            </div>
                            <div class="br-right-bottom">
                                <svg viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-11 h-11">
                                    <path d="M11 1.54972e-06L0 0L2.38419e-07 11C1.65973e-07 4.92487 4.92487 1.62217e-06 11 1.54972e-06Z" fill="#fff"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Booking Search -->
    <section  data-scroll-index="1" class="background bg-img bg-fixed section-padding" data-overlay-dark="5" data-background="img/slider/2.jpg">
        <div class="container">
            <div class="row">
                
            </div>
            <div class="booking-inner clearfix">
                
            </div>
        </div>
    </section>
    <!-- Cars 1 -->
    <section class="cars1 section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-30">
                   
                    <div class="section-title">Selectionner <span>votre voiture</span></div>

                </div>
            </div>
            <div class="cars1-carousel owl-theme owl-carousel">
                @foreach($voitures as $voiture)
                <div class="item">
                    <div class="img">  <a href="{{ route('voitures.show', $voiture->matricule) }}">
                        <img src="{{ $voiture->image }}" alt="">
                    </a> </div>
                    <div class="con opacity-1">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="title"><a href="{{ route('voitures.show', $voiture->matricule) }}">{{ $voiture->marque->nomMarque }}</a></div>
                                <div class="details"> <span><i class="fas fa-car"></i> {{ $voiture->marque->nomMarque }}</span><span><i class="fas fa-car"></i> {{ $voiture->model->nomModel }}</span> <span><i class="fas fa-car"></i> {{ $voiture->version->nomVersion }}</span> 
                            
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="book">
                                    
                                    @if($voiture->prix_initial == $voiture->enchere->prix_enchere )
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            Prix initial :
                                        </div>
                                        <div class="col">
                                            <h5>{{ $voiture->prix_initial }}<span>DT</span></h5>
                                        </div>
                                    </div>
                                    <p>Aucune offre d'enchère pour le moment.</p>
                                    @else
                                    
                                    <div style="display: flex; justify-content: space-between;">
                                        <span class="price">Prix initial:</span>
                                        <h4><span style="text-decoration: line-through;">{{ $voiture->prix_initial }}dt</span></h4>
                                    </div>
                                    <div style="display: flex; justify-content: space-between;">
                                        <span class="price">Prix enchère:</span>
                                        <h4><span>{{ $voiture->prixEnchere() }}dt</span></h4>
                                    </div>
                                    
                                    @endif
                                    <div>@if(auth()->check()) 
                                        <a data-bs-toggle="modal" data-bs-target="#exampleModal_{{ $voiture->matricule }}" data-bs-whatever="@mdo" href="" class="btn">
                                            <span>Participer</span>
                                        </a>
                                    @else
                                        <a data-bs-toggle="" data-bs-target="#" data-bs-whatever="@mdo" href="{{ route('login') }}" class="btn">
                                            <span>Participer</span>
                                        </a>
                                    @endif</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              
                
                @endforeach
               
                
                
            </div>
           
        </div>
    </section>
    
  
    
   
   
   
    <!-- Lets Talk -->
    <section class="lets-talk bg-img bg-fixed section-padding" data-overlay-dark="5" data-background="img/slider/3.jpg">
       
    </section>
    <!-- Clients -->
    <section class="clients">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="owl-carousel owl-theme">
                        <div class="clients-logo">
                            <a href="#0"><img src="img/clients/1.png" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="img/clients/2.png" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="img/clients/3.png" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="img/clients/4.png" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="img/clients/5.png" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="img/clients/6.png" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="img/clients/7.png" alt=""></a>
                        </div>
                        <div class="clients-logo">
                            <a href="#0"><img src="img/clients/8.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    @include('layouts.footer')
    <!-- RentNow Popup -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Vendre voiture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="booking-box">
                        <div class="booking-inner clearfix">
                      
                         
<!-- In your form -->
<form method="POST" action="{{ url('voitures/') }}" class="" enctype="multipart/form-data">
    {!! csrf_field() !!}
    
    <!-- form message -->
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
        </div>
    </div>
    <!-- form elements -->
    <div class="row">
        <div class="col-lg-6 col-md-12">
            <input name="matricule" id="matricule" class="form-control @error('matricule') is-invalid @enderror" type="text" placeholder="Matricule *" required>
            @error('matricule')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="marque-select">
                <div class="select1_wrapper">
                    <label>Choisir Marque</label>
                    <div class="select1_inner">
                        <select name="idMarque" id="marque" class="select2 select marque @error('idMarque') is-invalid @enderror" style="width: 100%">
                            <option value="">aucune</option>
                            @foreach($marques as $m)
                                <option value="{{ $m->id }}">{{ $m->nomMarque }}</option> 
                            @endforeach
                            <option value="autre">Autre</option>
                        </select>
                        @error('idMarque')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="marque-autre-wrapper" style="display:none;">
                    <label for="marque_autre">Autre Marque</label>
                    <input type="text" id="marque_autre" name="marque_autre" class="form-control">
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="select1_wrapper modele-wrapper" style="display:none;">
                <label>Choisir Modèle</label>
                <div class="select1_inner">
                    <select name="idModel" id="modele" class="select2 select modele @error('idModel') is-invalid @enderror" style="width: 100%">
                        <option value="">aucune</option>
                        <option value="autre">Autre</option>
                    </select>
                    @error('idModel')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="modele-autre-wrapper" style="display:none;">
                <label for="modele_autre">Autre Modèle</label>
                <input type="text" id="modele_autre" name="modele_autre" class="form-control">
            </div>
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="select1_wrapper version-wrapper" style="display:none;">
                <label>Choisir Version</label>
                <div class="select1_inner">
                    <select name="idVersion" id="version" class="select2 select version @error('idVersion') is-invalid @enderror" style="width: 100%">
                        <option value="">aucune</option>
                        <option value="autre">Autre</option>
                    </select>
                    @error('idVersion')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="version-autre-wrapper" style="display:none;">
                <label for="version_autre">Autre Version</label>
                <input type="text" id="version_autre" name="version_autre" class="form-control">
            </div>
        </div>


        <div class="col-lg-6 col-md-12">
            <input name="annee" type="text" id="annee" placeholder="Année de fabrication *" class="form-control @error('annee') is-invalid @enderror" required>
            @error('annee')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-lg-6 col-md-12">
            <input name="prix" id="prix" type="text" placeholder="Prix *" class="form-control @error('prix') is-invalid @enderror" required>
            @error('prix')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="col-lg-6 col-md-12">
            <div class="input1_wrapper">
                <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror" placeholder="Photo de la voiture">
                @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-3 col-md-12">
            <input name="nb_jours" id="nb_jours" type="text" placeholder="Nombre de jours" class="form-control @error('nb_jours') is-invalid @enderror">
            @error('nb_jours')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-lg-3 col-md-12">
            <input name="nb_heures" id="nb_heures" type="text" placeholder="Nombre d'heures" class="form-control @error('nb_heures') is-invalid @enderror">
            @error('nb_heures')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <div class="col-lg-12 col-md-12 form-group">
            <textarea name="description" id="description" cols="30" rows="4" placeholder="Description" class="form-control @error('description') is-invalid @enderror"></textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
        <div class="col-lg-12 col-md-12">
            <button type="submit" class="booking-button mt-15">Valider</button>
        </div>
    </div>
</form>


@push('scripts')

@endpush





                            

                            
                            
                            
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="js/jquery-3.7.1.min.js"></script>
    <script>
    </script>
    <script src="js/imagesloaded.pkgd.min.js"></script>
    <script src="js/jquery.isotope.v3.0.2.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scrollIt.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>
    <script src="js/jquery.magnific-popup.js"></script>
    <script src="js/select2.js"></script>
    <script src="js/datepicker.js"></script>
    <script src="js/YouTubePopUp.js"></script>
    <script src="js/custom.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery-min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.mIn.js"></script>
</body>

<!-- Mirrored from duruthemes.com/demo/html/renax/light/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 Apr 2024 19:09:44 GMT -->
</html>