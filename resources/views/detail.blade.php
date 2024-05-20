<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from duruthemes.com/demo/html/renax/light/car-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 Apr 2024 19:09:52 GMT -->
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>enChere</title>
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&amp;display=swap">

    <link rel="stylesheet" href="{{ asset('css/plugins.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
    @include('layouts.head')
    <script src="{{ asset('js/script.js')}}"></script>
</head>


<body>
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
    <section class="banner-header section-padding bg-img" data-overlay-dark="5" data-background="{{$voiture->image}}">
        <div class="v-middle">
            <div class="container">
                <div class="col-md-12">
                    
                    <h1>{{$voiture->marque->nomMarque}}</h1>
                    <h5 style="color: #f5b754;">&ensp; &ensp;&ensp;{{$voiture->model->nomModel}} | {{$voiture->version->nomVersion}}</h5>
                </div>
            </div>
        </div>
    </section>
    <!-- Details -->
    <section class="car-details section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        <div class="col-md-12 mb-60">
                            <h3>Description de voiture</h3>
                            <p class="mb-30">{{$voiture->description}}</p>
                           
                        </div>
                    </div>
                   
                    <!-- FAQs -->
                   
                    
                </div>
                <!-- Sidebar -->
                <div class="col-lg-4 col-md-12">
                    <div class="sidebar-car">
                        <div class="title">
                            @if($voiture->prix_initial == $voiture->enchere->prix_enchere )
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <p>Prix initial :</p>
                                </div>
                                <div class="col">
                                    <h5>{{ $voiture->prix_initial }}<span>DT</span></h5>
                                </div>
                            </div>
                            <p>Aucune offre d'enchère pour le moment.</p>
                            @else
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <p>Prix initiale :</p>
                                </div>
                                <div class="col">
                                    <h5 style="text-decoration: line-through;">{{ $voiture->prix_initial }}<span>DT</span></h5>
                                </div>
                            </div>
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <p>Prix enchère:</p>
                                </div>
                                <div class="col">
                                    <h5 >{{ $voiture->enchere->prix_enchere }}<span>DT</span></h5>
                                </div>
                            </div>
                                
                            @endif
                            
                        </div>
                        <div class="item">
                            <div class="features"><span><i class="fas fa-car"></i>Marque </span>
                                <p><strong>{{$voiture->marque->nomMarque}}</strong></p>
                            </div>
                            <div class="features"><span><i class="fas fa-car"></i>Modèle</span>
                                <p><strong>{{$voiture->model->nomModel}}</strong></p>
                            </div>
                            <div class="features"><span><i class="fas fa-car"></i> Version</span>
                                <p><strong>{{$voiture->version->nomVersion}}</strong></p>
                            </div>
                            <div class="features"><span><i class="fas fa-car"></i>A.fabrication</span>
                                <p><strong>{{$voiture->annee}}</strong></p>
                            </div>
                            
                            
                            @if(auth()->check()) 
                            <a data-bs-toggle="modal" data-bs-target="#exampleModal_{{ $voiture->matricule }}" data-bs-whatever="@mdo" href="" class="booking-button mt-10">
                                <div class="text-center">Participer à l'enchère</div>
                            </a>
                        @else
                            <a data-bs-toggle="" data-bs-target="#" data-bs-whatever="@mdo" href="{{ route('login') }}" class="booking-button mt-10">
                                <div class="text-center">Participer à l'enchère</div>
                            </a>
                        @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Lets Talk -->
   
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
    <footer class="footer clearfix">
        <div class="container">
            <!-- premier footer -->
            <div class="first-footer">
                <div class="row">
                    <div class="col-md-12">
                        <div class="links dark footer-contact-links">
                            <div class="footer-contact-links-wrapper">
                                <div class="footer-contact-link-wrapper">
                                    <div class="image-wrapper footer-contact-link-icon">
                                        <div class="icon-footer"> <i class="flaticon-phone-call"></i> </div>
                                    </div>
                                    <div class="footer-contact-link-content">
                                        <h6>Appelez-nous</h6>
                                        <p>+21623568974</p>
                                    </div>
                                </div>
                                <div class="footer-contact-links-divider"></div>
                                <div class="footer-contact-link-wrapper">
                                    <div class="image-wrapper footer-contact-link-icon">
                                        <div class="icon-footer"> <i class="omfi-envelope"></i> </div>
                                    </div>
                                    <div class="footer-contact-link-content">
                                        <h6>Gmail</h6>
                                        <p>enchere@gmail.com</p>
                                    </div>
                                </div>
                                <div class="footer-contact-links-divider"></div>
                                <div class="footer-contact-link-wrapper">
                                    <div class="image-wrapper footer-contact-link-icon">
                                        <div class="icon-footer"> <i class="omfi-location"></i> </div>
                                    </div>
                                    <div class="footer-contact-link-content">
                                        <h6>Adresse</h6>
                                        <p>Mahdia, Rue hadi chaker</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- deuxième footer -->
            <div class="second-footer">
                <div class="row">
                    <!-- à propos & icônes sociales -->
                    <div class="col-md-4 widget-area">
                        <div class="widget clearfix">
                            <div class="footer-logo"><a class="logo" href="{{ route('/') }}">
                        
                                <h2><span style="color: #f5b754;">En</span>chère</h2>
            
            
                            </a></div>
                            <!-- <div class="footer-logo"><h2>CARE<span>X</span></h2></div> -->
                            <div class="widget-text">
                                <p>Rejoignez nos enchères maintenant!</p>
                                <div class="social-icons">
                                    <ul class="list-inline">
                                        <li><a href="#"><i class="fa-brands fa-whatsapp"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                        <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- liens rapides -->
                    <div class="col-md-3 offset-md-1 widget-area">
                        <div class="widget clearfix usful-links">
                            <h3 class="widget-title">Liens Rapides</h3>
                            <ul>
                            
                                <li><a href="{{ route('voitures.index') }}">Voitures</a></li>
                               
                            </ul>
                        </div>
                    </div>
                    <!-- s'abonner -->
                    
                </div>
            </div>
            <!-- bas de page -->
            <div class="bottom-footer-text">
                <div class="row copyright">
                    <div class="col-md-12">
                        <p class="mb-0">&copy;2024-Tous droits réservés.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- RentNow Popup -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Booking Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="booking-box">
                        <div class="booking-inner clearfix">
                            <form method="post" action="#0" class="form1 contact__form clearfix">
                                <!-- form message -->
                                <div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                                    </div>
                                </div>
                                <!-- form elements -->
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <input name="name" type="text" placeholder="Full Name *" required>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <input name="email" type="email" placeholder="Email *" required>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <input name="phone" type="text" placeholder="Phone *" required>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="select1_wrapper">
                                            <label>Choose Car Type</label>
                                            <div class="select1_inner">
                                                <select class="select2 select" style="width: 100%">
                                                    <option value="0">Choose Car Type</option>
                                                    <option value="1">All</option>
                                                    <option value="2">Luxury Cars</option>
                                                    <option value="3">Sport Cars</option>
                                                    <option value="4">SUVs</option>
                                                    <option value="5">Convertible</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="select1_wrapper">
                                            <label>Pick Up Location</label>
                                            <div class="select1_inner">
                                                <select class="select2 select" style="width: 100%">
                                                    <option value="0">Pick Up Location</option>
                                                    <option value="1">Dubai</option>
                                                    <option value="2">Abu Dhabi</option>
                                                    <option value="3">Sharjah</option>
                                                    <option value="4">Alain</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="input1_wrapper">
                                            <label>Pick Up Date</label>
                                            <div class="input1_inner">
                                                <input type="text" class="form-control input datepicker" placeholder="Pick Up Date" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="select1_wrapper">
                                            <label>Drop Off Location</label>
                                            <div class="select1_inner">
                                                <select class="select2 select" style="width: 100%">
                                                    <option value="0">Drop Off Location</option>
                                                    <option value="1">Alain</option>
                                                    <option value="2">Sharjah</option>
                                                    <option value="3">Abu Dhabi</option>
                                                    <option value="4">Dubai</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="input1_wrapper">
                                            <label>Return Date</label>
                                            <div class="input1_inner">
                                                <input type="text" class="form-control input datepicker" placeholder="Return Date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 form-group">
                                        <textarea name="message" id="message" cols="30" rows="4" placeholder="Additional Note"></textarea>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit" class="booking-button mt-15">Rent Now</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
    <!-- jQuery -->
    
 <script src="{{ asset('js/jquery-3.7.1.min.js')}}"></script>
   
 <script src="{{ asset('js/imagesloaded.pkgd.min.js')}}"></script>
 <script src="{{ asset('js/jquery.isotope.v3.0.2.js')}}"></script>
 <script src="{{ asset('js/popper.min.js')}}"></script>
 <script src="{{ asset('js/bootstrap.min.js')}}"></script>
 <script src="{{ asset('js/scrollIt.min.js')}}"></script>
 <script src="{{ asset('js/jquery.waypoints.min.js')}}"></script>
 <script src="{{ asset('js/owl.carousel.min.js')}}"></script>
 <script src="{{ asset('js/jquery.stellar.min.js')}}"></script>
 <script src="{{ asset('js/jquery.magnific-popup.js')}}"></script>
 <script src="{{ asset('js/select2.js')}}"></script>
 <script src="{{ asset('js/datepicker.js')}}"></script>
 <script src="{{ asset('js/YouTubePopUp.js')}}"></script>
 <script src="{{ asset('js/custom.js')}}"></script>
 
</body>

<!-- Mirrored from duruthemes.com/demo/html/renax/light/car-details.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 Apr 2024 19:09:52 GMT -->
</html>