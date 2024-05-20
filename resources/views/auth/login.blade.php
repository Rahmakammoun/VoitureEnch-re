<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from duruthemes.com/demo/html/renax/light/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 Apr 2024 19:09:58 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>RENAX</title>
    <link rel="shortcut icon" href="img/favicon.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&amp;display=swap">
    <link rel="stylesheet" href="css/plugins.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>
<body class="bg-gray">
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
    <!-- Header Banner -->
    <section class="lets-talk bg-img bg-fixed section-padding" data-overlay-dark="5" data-background="img/slider/3.jpg">
        <div class="v-middle">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h6>Get in touch</h6>
                        <h1>Log <span>In</span></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Box -->
    
    <!-- Contact -->
    <section class="contact section-padding">
        <div class="container">
            <div class="row">
                <!-- Form -->
                <div class="col-md-12  text-center">
                    <div class="form-box">
                        <h5>Se connecter</h5>
                        <form method="post" class="contact__form" action="{{ route('login') }}">
                            @csrf
                            <!-- form message -->
                           <!-- <div class="row">
                                <div class="col-12">
                                    <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                                </div>
                            </div>-->
                            <!-- form elements -->
                            <div class="row">

                                <div class="col-md-6 form-group">
                                    <input  name="email" type="email" placeholder="Your Email *" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                


                                <div class="col-md-6 form-group">
                                    <input   name="password" type="password" placeholder="Mot de passe *" class="form-control @error('password') is-invalid @enderror"  autocomplete="current-password"  required>
                                    @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>

                               
                                <div class="col-md-4 offset-md-4">
                                    <input name="submit" type="submit" value="Se connecter">
                                    <a data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" href="{{ route('register') }}" class="button-2 mt-15 mb-15 custom-button">S'inscrire <span class="ti-arrow-top-right"></span></a>
                                </div>
                                <div class="row mb-0">
                                    <div class="col-md-5 offset-md-4">
                                        
        
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>


                            </div>
                        </form>
                    </div>
                </div>
               
                
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
                    <h5 class="modal-title" id="exampleModalLabel">S'inscrire</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="booking-box">
                        <div class="booking-inner clearfix">
                            <form method="POST" action="{{ route('register') }}" class="form1 contact__form clearfix">
                                @csrf
                                <!-- form message -->
                                <!--<div class="row">
                                    <div class="col-12">
                                        <div class="alert alert-success contact__msg" style="display: none" role="alert"> Your message was sent successfully. </div>
                                    </div>
                                </div>-->
                                <!-- form elements -->
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <input name="name" type="text" placeholder="Votre nom *"  class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus required>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <input id="email" name="email" type="email" placeholder="Email *" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                    
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <input name="phone" type="text" placeholder="Phone *" required>
                                    </div>
                                    <div class="col-lg-6 col-md-12"></div>
                                    <div class="col-lg-6 col-md-12">
                                        <input name="password" type="password" placeholder="Mot de passe *" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"  required>
                                    @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                            <input id="password-confirm" type="password"  placeholder="Confirmer mot de passe *" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                    
                                    
                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit" class="booking-button mt-15">s'inscrire</button>
                                        
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

<!-- Mirrored from duruthemes.com/demo/html/renax/light/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 Apr 2024 19:09:58 GMT -->
</html>