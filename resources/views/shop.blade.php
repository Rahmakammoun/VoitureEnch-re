<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from duruthemes.com/demo/html/renax/light/cars.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 Apr 2024 19:09:52 GMT -->
@include("layouts.head")
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
                <a class="logo" href="{{route('/')}}"> <h2><span style="color: #f5b754;">En</span>chère</h2> </a>
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
    <!-- Header Banner -->
  @include("layouts.header")
    <!-- divider line -->
    <div class="line-vr-section"></div>
    <!-- Cars -->
    <section class="cars1 section-padding">
        <div class="container">
            
            <div class="row">
                
                <div class="col-lg-12 col-md-6 mb-40">
                    @foreach($voitures as $voiture)
    <div class="item">
        <div class="img">
            <a href="{{ route('voitures.show', $voiture->matricule) }}">
                <img src="{{ $voiture->image }}" alt="">
            </a>
        </div>
        <div class="con active">
            <div class="row">
                <div class="col-md-4">
                    <div class="title">
                        <a href="{{ route('voitures.show', $voiture->matricule) }}">{{ $voiture->marque->nomMarque }}</a>
                    </div>
                    <div class="details">
                        <span><i class="fas fa-car"></i> {{ $voiture->model->nomModel }}</span>
                        <span><i class="fas fa-car"></i> {{ $voiture->version->nomVersion }}</span>
                        
                    </div>
                    <br>
                    <div>
                        <strong><h6><span>&ensp;&ensp;&ensp;&ensp;&ensp;Temps restant :</span> <span class="time">{{ $voiture->tempsRestantEnchere() }}</span></h6></strong>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="book">
                        @if($voiture->prix_initial == $voiture->enchere->prix_enchere )
                        <div>
                            <span>Prix initial</span><span class="price">{{ $voiture->prix_initial }}dt</span>
                        </div>
                        <p>Aucune offre d'enchère pour le moment.</p>
                        


                        <br>
                        <div>
                            @if(auth()->check()) 
                                <a data-bs-toggle="modal" data-bs-target="#exampleModal_{{ $voiture->matricule }}" data-bs-whatever="@mdo" href="" class="btn">
                                    <span>Participer</span>
                                </a>
                            @else
                                <a data-bs-toggle="" data-bs-target="#" data-bs-whatever="@mdo" href="{{ route('login') }}" class="btn">
                                    <span>Participer</span>
                                </a>
                            @endif
                        </div>
                        @else
                        <div>
                            <span>Prix initial</span><span style="text-decoration: line-through;"
                            class="price">{{ $voiture->prix_initial }}dt</span>
                        </div>
                    
                        <br>
                        <div>
                            @if(auth()->check()) 
                                <a data-bs-toggle="modal" data-bs-target="#exampleModal_{{ $voiture->matricule }}" data-bs-whatever="@mdo" href="" class="btn">
                                    <span>Participer</span>
                                </a>
                            @else
                                <a data-bs-toggle="" data-bs-target="#" data-bs-whatever="@mdo" href="{{ route('login') }}" class="btn">
                                    <span>Participer</span>
                                </a>
                            @endif
                        </div>
                        <div>
                            <span>Prix enchère</span><span class="price">{{ $voiture->prixEnchere() }}dt</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- RentNow Popup -->
    @if(auth()->check()) 
    <div class="modal fade" id="exampleModal_{{ $voiture->matricule }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $voiture->matricule }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="booking-box">
                        <div class="booking-inner clearfix">
                            <form method="POST" action="{{ route('update.enchere') }}" class="" enctype="multipart/form-data">
                                @csrf
                                
                                <input type="hidden" name="matricule" value="{{ $voiture->matricule }}">
                                <div class="row">
                                    <div class="col-lg-12 col-md-6 text-center">
                                        <input name="prix" type="number" placeholder="Nouveau prix *" min="{{ $voiture->prixEnchere() + 1 }}" required class="form-control">
                                        <input name="utilisateur" type="hidden" value="{{ Auth::user()->id }}">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 text-center">
                                    <button type="submit" class="booking-button mt-15">Valider</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endforeach

            </div>
            <!-- Pagination -->
           
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
    @include("layouts.footer")
    <!-- jQuery -->
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/jquery-migrate-3.4.1.min.js"></script>
    <script src="js/modernizr-2.6.2.min.js"></script>
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
   
    <script src="js/YouTubePopUp.js"></script>
    <script src="js/custom.js"></script>
</body>

<!-- Mirrored from duruthemes.com/demo/html/renax/light/cars.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 Apr 2024 19:09:52 GMT -->
</html>