
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hafsa Agency</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/fontawesome.min.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto" rel="stylesheet">
        <link rel="stylesheet" href="css/output.css">
        <script src="js/tailwind.config.js"></script>
        <link rel="stylesheet" href="https://cdn.tailwindcss.com">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    </head>
    <body>
        <style>
            /* Styles personnalisés pour la barre de navigation */
            .navbar-nav .nav-link {
                padding: 0.5rem 1rem;
                color: #333;
            }
    
            .navbar-nav .nav-link:hover {
                color: #007bff;
                background-color: #007bff;
                border-radius: 5px;
            }
    
            .navbar-nav .active .nav-link {
                color: #007bff;
                font-weight: bold;
            }
    
            .navbar-brand img {
              height:180px;
              border-radius: 90px;
              background: none; 
            background-color: transparent; 
            }
            button:hover{
                background-color: #87b3e2;
            }
            /* styles.css */

.navbar {
    transition: background-color 0.3s;
}

.navbar.scrolled {
    background-color: #87b3e2 !important;
}

.navbar .navbar-brand,
.navbar .nav-link {
    color: #fff;
}

.hero {
    background: url('https://via.placeholder.com/1920x1080') no-repeat center center/cover;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    text-align: center;
}

.hero-content {
    background-color: rgba(144, 185, 228, 0.8);
    padding: 2rem;
    border-radius: 5px;
}

.btn-primary {
    background-color: #93c0ef;
    color: #fff;
    padding: 0.5rem 1rem;
    text-decoration: none;
    border-radius: 5px;
    font-size: 1rem;
}




    
            /* Styles pour le bouton de la barre de navigation sur mobile */
            .navbar-toggler {
                border-color: #007bff;
            }
    
            .navbar-toggler-icon {
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba%280, 123, 255, 0.5%29' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
            }
    
            /* Pour aligner correctement les éléments d'authentification à droite */
            .navbar-nav.ml-auto {
                margin-right: auto;
            }
    
            .navbar-nav.auth-nav {
                margin-left: auto;
            }
        </style>











<nav id="navbar" class="navbar navbar-expand-lg navbar-light text-capitalize" style="position:fixed; width:100%;height:110px;">
    <div class="container">
                <a class="navbar-brand" href="#"><img style="width: 180px;"  src="imgs/logo.png" alt="Logo" /></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#show-menu" aria-controls="show-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
        
                <div class="collapse navbar-collapse" id="show-menu">
                    <ul class="navbar-nav ml-auto">
                        <li  class="nav-item">
                            <a class="nav-link" href="#home"   class="nav-link">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#voiture"  class="nav-link">Voiture</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#Service"  class="nav-link">Service</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#place"  class="nav-link">Place</a>
                        </li>
                        <li class="nav-item">
                            {{-- <a class="nav-link" href="#contact"  class="nav-link">Contact Us</a> --}}
                        </li>
                    </ul>
                    <ul class="navbar-nav auth-nav">
                        @if (Route::has('login'))
                            @auth
                                    <a href="{{ route('dashboard.statistics') }}" class="nav-link">Dashboard</a>
                            @else
                                    <a href="{{ route('login') }}" class="nav-link">Log in</a>
                                
                                @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="nav-link">Register</a>
                                    
                                @endif
                            @endauth
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        
          
          
       
        
        <header id="home">
            <div class="overlay">
                <div class="container">
                    <div>
                        <center>
                        <h1><span style="color:#87b3e2">Hafsa Travel Agency  </span><br> Planifier un voyage de 10 jours </h1>
                        {{-- <p>Welcome to Hafsa Travel Agency! We are thrilled to offer you an unforgettable 10-day tour to the beautiful island of Santorini. Enjoy stunning sunsets, pristine beaches, and rich history with our expertly planned itinerary.</p> --}}
                        <button><a href="/reservation_vol/index" class="text-uppercase" >Reserve maintenant</a></button>
                    </center>
                    </div>
                </div>
            </div>
        </header>
        
        
        <section class="w-full flex justify-center bg-color3 py-8 h-auto" style="background-color: rgb(244,245,248)" id="voiture">
            <div class="w-full container 2xl:px-36 h-auto">
                <div>
                    <p class="text-color4 uppercase px-5">Voiture</p>
                    <p class="text-5xl font-secondary text-color4 px-5"> Example Voiture &nbsp;<span class="text-color4">Disponible</span></p>
                    <div class="flex flex-wrap justify-center xl:justify-between gap-10 px-6 xl:px-0 py-8 lg:px-3 ">
                        @foreach ($cars as $car)
                            <figure class="w-full md:w-[45%] xl:w-[30%] h-[450px] relative transition-all duration-1000 group mb-20">
                                <div class="w-[100%] h-[100%] overflow-hidden group transition-all duration-1000 relative">
                                    <img src="{{asset($car->image) }}" alt="Car Image" class="w-[100%] h-[100%] object-cover group-hover:brightness-75 group-hover:scale-[1.2] absolute transition-all duration-1000">
                                </div>
                                
                                <div class="absolute uppercase text-white bg-color1 px-2 left-3 top-12 flex flex-col items-center">
                                    <p>{{ date('M', strtotime($car->created_at)) }}</p>
                                    <p class="font-bold">{{ date('d', strtotime($car->created_at)) }}</p>
                                </div>
                                <figcaption class="absolute h-[150px] w-[85%] bg-white bottom-[-80px] left-[8%] flex flex-col justify-center px-8 group-hover:bottom-10 transition-all duration-1000">
                                    <p class="uppercase text-color4">{{ $car->marque }}</p>
                                    <p class="capitalize text-color3 font-secondary text-2xl">{{ $car->modèle }}</p>
                                    <p class="text-color3">{{ $car->prix_par_jour }} DH/ jour</p>
                                </figcaption>
                            </figure>
                        @endforeach
                    </div>
                    <div class="flex justify-center" id="pagination-links">
                        {{ $cars->links('vendor.pagination.custom') }}
                    </div>
                </div>
            </div>
        </section>
        

        <section class="w-full flex justify-center bg-color3 py-8 h-auto" id="Service" style="background-color: #ffff">
            <div class="w-full container 2xl:px-36 h-auto">
                <div>
                    <p class="text-color4 uppercase px-5">AGENCE DE VOYAGE</p>
                    <p class="text-5xl font-secondary text-color4 px-5">Hafsa<span class="text-white"> Travel Agency</span></p>
                    <div class="flex flex-wrap justify-center xl:justify-between gap-10 px-6 xl:px-0 py-8 lg:px-3 ">
                        <figure class="w-full md:w-[45%] xl:w-[30%] h-[450px] relative transition-all duration-1000 group mb-20">
                            <div class="w-[100%] h-[100%] overflow-hidden group transition-all duration-1000 relative">
                                <img src="img/22.jpeg" alt="Travel Image 1" class="w-[100%] h-[100%] object-cover group-hover:brightness-75 group-hover:scale-[1.2] absolute transition-all duration-1000">
                            </div>
                            <div class="absolute uppercase text-white bg-color1 px-2 left-3 top-12 flex flex-col items-center">
                                <p>Aug</p>
                                <p class="font-bold">02</p>
                            </div>
                            <figcaption class="absolute h-[150px] w-[85%] bg-white bottom-[-80px] left-[8%] flex flex-col justify-center px-8 group-hover:bottom-10 transition-all duration-1000">
                                <p class="uppercase text-color4">Tours</p>
                                <p class="capitalize text-color3 font-secondary text-2xl">Explore our most popular yacht charter routes</p>
                            </figcaption>
                        </figure>
                        <figure class="w-full md:w-[45%] xl:w-[30%] h-[450px] relative transition-all duration-1000 group mb-20">
                            <div class="w-[100%] h-[100%] overflow-hidden group transition-all duration-1000 relative">
                                <img src="img/11.jpeg" alt="Travel Image 2" class="w-[100%] h-[100%] object-cover group-hover:brightness-75 group-hover:scale-[1.2] absolute transition-all duration-1000">
                            </div>
                            <div class="absolute uppercase text-white bg-color1 px-2 left-3 top-12 flex flex-col items-center">
                                <p>Aug</p>
                                <p class="font-bold">07</p>
                            </div>
                            <figcaption class="absolute h-[150px] w-[85%] bg-white bottom-[-80px] left-[8%] flex flex-col justify-center px-3 group-hover:bottom-10 transition-all duration-1000">
                                <p class="uppercase text-color4">Travel</p>
                                <p class="capitalize text-color3 font-secondary text-2xl">Practical information for traveling to Egypt</p>
                            </figcaption>
                        </figure>
                        <figure class="w-full md:w-[45%] xl:w-[30%] h-[450px] relative transition-all duration-1000 group mb-20">
                            <div class="w-[100%] h-[100%] overflow-hidden group transition-all duration-1000 relative">
                                <img src="img/18-1.jpeg" alt="Travel Image 3" class="w-[100%] h-[100%] object-cover group-hover:brightness-75 group-hover:scale-[1.2] absolute transition-all duration-1000">
                            </div>
                            <div class="absolute uppercase text-white bg-color1 px-2 left-3 top-12 flex flex-col items-center">
                                <p>Aug</p>
                                <p class="font-bold">02</p>
                            </div>
                            <figcaption class="absolute h-[150px] w-[85%] bg-white bottom-[-80px] left-[8%] flex flex-col justify-center px-5 group-hover:bottom-10 transition-all duration-1000">
                                <p class="uppercase text-color4">Destinations</p>
                                <p class="capitalize text-color3 font-secondary text-2xl">Tips for a flawless honeymoon</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </section>
        







        <section class="w-full flex justify-center bg-color7 py-8 " id="place">
            <div class="w-full container 2xl:px-36">
                <div>
                    <p class=" text-color4 uppercase px-5">Choisissez votre destination</p>
                    <p class="text-5xl font-secondary text-color3 px-5">Tours <span class="text-color1">Populaires</span></p>
                    <div class="flex flex-wrap md:justify-between gap-10 px-6 xl:px-0 py-8 lg:px-3">
                        <figure class="w-full md:w-[45%] xl:w-[30%] h-[450px] relative photo transition-all duration-1000">
                            <div class="w-[100%] h-[100%] bottom-photo absolute bg-white flex flex-col justify-center px-5">
                                <p class="text-3xl text-color3 capitalize font-secondary">Tour des Maldives</p>
                                <p class="text-color1 mb-4">25,000 DH / par personne</p>
                                <p class="text-color6">Profitez de la beauté des Maldives pendant 12 jours.</p>
                                <div class="flex flex-wrap my-4">
                                    <div class="w-[50%] flex"><i class="bi bi-clock text-color4"></i><p class="text-color6 ms-2">12 Jours</p></div>
                                    <div class="w-[50%] flex"><i class="bi bi-geo-alt text-color4"></i><p class="text-color6 ms-2">Maldives</p></div>
                                    <div class="w-[50%] flex"><i class="bi bi-person text-color4"></i><p class="text-color6 ms-2">12+</p></div>
                                    <div class="w-[50%] flex"><i class="bi bi-emoji-smile text-color4"></i><p class="text-color6 ms-2">9.8 Superbe</p></div>
                                </div>
                                <a href="" class="underline decoration-color1 text-color6 flex mb-2">Détails du tour</a>
                            </div>
                            <img src="img/maldiv.jpg" alt="" class="w-[100%] h-[100%] object-cover brightness-75 absolute">
                            <p class="absolute uppercase text-white bg-color3 px-4 py-1 right-1 top-12 rotate-[-90deg]">Maldives</p>
                            <figcaption class="absolute text-white bottom-8 right-10 fig">
                                <p class="capitalize font-secondary text-3xl">Tours des Maldives</p>
                                <p class="text-right">25,000 DH / par personne</p>
                            </figcaption>
                        </figure>
                        <figure class="w-full md:w-[45%] xl:w-[30%] h-[450px] relative photo transition-all duration-1000">
                            <div class="w-[100%] h-[100%] bottom-photo absolute bg-white flex flex-col justify-center px-5">
                                <p class="text-3xl text-color3 capitalize font-secondary">Tour de Rome</p>
                                <p class="text-color1 mb-4">13,000 DH / par personne</p>
                                <p class="text-color6">Découvrez Rome et ses merveilles pendant 6 jours.</p>
                                <div class="flex flex-wrap my-4">
                                    <div class="w-[50%] flex"><i class="bi bi-clock text-color4"></i><p class="text-color6 ms-2">6 Jours</p></div>
                                    <div class="w-[50%] flex"><i class="bi bi-geo-alt text-color4"></i><p class="text-color6 ms-2">Italie</p></div>
                                    <div class="w-[50%] flex"><i class="bi bi-person text-color4"></i><p class="text-color6 ms-2">10+</p></div>
                                    <div class="w-[50%] flex"><i class="bi bi-emoji-smile text-color4"></i><p class="text-color6 ms-2">9.5 Superbe</p></div>
                                </div>
                                <a href="" class="underline decoration-color1 text-color6 flex mb-2">Détails du tour</a>
                            </div>
                            <img src="img/roma.jpg" alt="" class="w-[100%] h-[100%] object-cover brightness-75 absolute">
                            <p class="absolute uppercase text-white bg-color3 px-4 py-1 right-1 top-12 rotate-[-90deg]">Italie</p>
                            <figcaption class="absolute text-white bottom-8 right-10 fig">
                                <p class="capitalize font-secondary text-3xl">Rome</p>
                                <p class="text-right">13,000 DH / par personne</p>
                            </figcaption>
                        </figure>
                        <figure class="w-full md:w-[45%] xl:w-[30%] h-[450px] relative photo transition-all duration-1000">
                            <div class="w-[100%] h-[100%] bottom-photo absolute bg-white flex flex-col justify-center px-5">
                                <p class="text-3xl text-color3 capitalize font-secondary">Tour de France</p>
                                <p class="text-color1 mb-4">4,000 DH / par personne</p>
                                <p class="text-color6">Explorez les sites emblématiques de la France pendant 10 jours.</p>
                                <div class="flex flex-wrap my-4">
                                    <div class="w-[50%] flex"><i class="bi bi-clock text-color4"></i><p class="text-color6 ms-2">10 Jours</p></div>
                                    <div class="w-[50%] flex"><i class="bi bi-geo-alt text-color4"></i><p class="text-color6 ms-2">France</p></div>
                                    <div class="w-[50%] flex"><i class="bi bi-person text-color4"></i><p class="text-color6 ms-2">6+</p></div>
                                    <div class="w-[50%] flex"><i class="bi bi-emoji-smile text-color4"></i><p class="text-color6 ms-2">9.5 Superbe</p></div>
                                </div>
                                <a href="" class="underline decoration-color1 text-color6 flex mb-2">Détails du tour</a>
                            </div>
                            <img src="img/france.jpg" alt="" class="w-[100%] h-[100%] object-cover brightness-75 absolute">
                            <p class="absolute uppercase text-white bg-color3 px-4 py-1 right-1 top-12 rotate-[-90deg]">France</p>
                            <figcaption class="absolute text-white bottom-8 right-10 fig">
                                <p class="capitalize font-secondary text-3xl">Tour de France</p>
                                <p class="text-right">4,000 DH / par personne</p>
                            </figcaption>
                        </figure>
                        <figure class="w-full md:w-[45%] xl:w-[30%] h-[450px] relative photo transition-all duration-1000">
                            <div class="w-[100%] h-[100%] bottom-photo absolute bg-white flex flex-col justify-center px-5">
                                <p class="text-3xl text-color3 capitalize font-secondary">Tour de Grèce</p>
                                <p class="text-color1 mb-4">5,000 DH / par personne</p>
                                <p class="text-color6">Découvrez les merveilles de la Grèce pendant 10 jours.</p>
                                <div class="flex flex-wrap my-4">
                                    <div class="w-[50%] flex"><i class="bi bi-clock text-color4"></i><p class="text-color6 ms-2">10 Jours</p></div>
                                    <div class="w-[50%] flex"><i class="bi bi-geo-alt text-color4"></i><p class="text-color6 ms-2">Grèce</p></div>
                                    <div class="w-[50%] flex"><i class="bi bi-person text-color4"></i><p class="text-color6 ms-2">12+</p></div>
                                    <div class="w-[50%] flex"><i class="bi bi-emoji-smile text-color4"></i><p class="text-color6 ms-2">9.3 Superbe</p></div>
                                </div>
                                <a href="#" class="underline decoration-color1 text-color6 flex mb-2">Détails du tour</a>
                            </div>
                            <img src="img/greece.jpg" alt="Greece Tour Image" class="w-[100%] h-[100%] object-cover brightness-75 absolute">
                            <p class="absolute uppercase text-white bg-color3 px-4 py-1 right-[-15px] top-12 rotate-[-90deg]">Grèce</p>
                            <figcaption class="absolute text-white bottom-8 right-10 fig">
                                <p class="capitalize font-secondary text-3xl">Tours de Grèce</p>
                                <p class="text-right">5,000 DH / par personne</p>
                            </figcaption>
                        </figure>
                        <figure class="w-full md:w-[45%] xl:w-[30%] h-[450px] relative photo transition-all duration-1000">
                            <div class="w-[100%] h-[100%] bottom-photo absolute bg-white flex flex-col justify-center px-5">
                                <p class="text-3xl text-color3 capitalize font-secondary">Tour du Maroc</p>
                                <p class="text-color1 mb-4">5,000 DH / par personne</p>
                                <p class="text-color6">Découvrez les merveilles du Maroc pendant 10 jours.</p>
                                <div class="flex flex-wrap my-4">
                                    <div class="w-[50%] flex"><i class="bi bi-clock text-color4"></i><p class="text-color6 ms-2">10 Jours</p></div>
                                    <div class="w-[50%] flex"><i class="bi bi-geo-alt text-color4"></i><p class="text-color6 ms-2">Maroc</p></div>
                                    <div class="w-[50%] flex"><i class="bi bi-person text-color4"></i><p class="text-color6 ms-2">12+</p></div>
                                    <div class="w-[50%] flex"><i class="bi bi-emoji-smile text-color4"></i><p class="text-color6 ms-2">9.3 Superbe</p></div>
                                </div>
                                <a href="#" class="underline decoration-color1 text-color6 flex mb-2">Détails du tour</a>
                            </div>
                            <img src="img/morocco.jpg" alt="Morocco Tour Image" class="w-[100%] h-[100%] object-cover brightness-75 absolute">
                            <p class="absolute uppercase text-white bg-color3 px-4 py-1 right-[-15px] top-12 rotate-[-90deg]">Maroc</p>
                            <figcaption class="absolute text-white bottom-8 right-10 fig">
                                <p class="capitalize font-secondary text-3xl">Tours du Maroc</p>
                                <p class="text-right">5,000 DH / par personne</p>
                            </figcaption>
                        </figure>
                        
                        <figure class="w-full md:w-[45%] xl:w-[30%] h-[450px] relative photo transition-all duration-1000">
                            <div class="w-[100%] h-[100%] bottom-photo absolute bg-white flex flex-col justify-center px-5">
                                <p class="text-3xl text-color3 capitalize font-secondary">Tour de Turquie</p>
                                <p class="text-color1 mb-4">5,000 DH / par personne</p>
                                <p class="text-color6">Découvrez les merveilles de la Turquie pendant 10 jours.</p>
                                <div class="flex flex-wrap my-4">
                                    <div class="w-[50%] flex"><i class="bi bi-clock text-color4"></i><p class="text-color6 ms-2">10 Jours</p></div>
                                    <div class="w-[50%] flex"><i class="bi bi-geo-alt text-color4"></i><p class="text-color6 ms-2">Turquie</p></div>
                                    <div class="w-[50%] flex"><i class="bi bi-person text-color4"></i><p class="text-color6 ms-2">12+</p></div>
                                    <div class="w-[50%] flex"><i class="bi bi-emoji-smile text-color4"></i><p class="text-color6 ms-2">9.3 Superbe</p></div>
                                </div>
                                <a href="#" class="underline decoration-color1 text-color6 flex mb-2">Détails du tour</a>
                            </div>
                            <img src="img/turk.jpg" alt="Turkey Tour Image" class="w-[100%] h-[100%] object-cover brightness-75 absolute">
                            <p class="absolute uppercase text-white bg-color3 px-4 py-1 right-[-15px] top-12 rotate-[-90deg]">Turquie</p>
                            <figcaption class="absolute text-white bottom-8 right-10 fig">
                                <p class="capitalize font-secondary text-3xl">Tours de Turquie</p>
                                <p class="text-right">5,000 DH / par personne</p>
                            </figcaption>
                        </figure>
                        
                        
                        
                    </div>
                </div>
            </div>
        </section>
     
        
        <div class="statistiques text-uppercase text-center font-weight-bold">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-12">
                        <i class="fas fa-plane fa-3x text-primary"></i>
                        <h3>200</h3>
                        <p>Vols</p>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <i class="fas fa-hotel fa-3x text-primary"></i>
                        <h3>300</h3>
                        <p>Hôtels</p>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <i class="fas fa-car fa-3x text-primary"></i>
                        <h3>150</h3>
                        <p>Voitures</p>
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <i class="fas fa-umbrella-beach fa-3x text-primary"></i>
                        <h3>425</h3>
                        <p>Touristes</p>
                    </div>
                </div>
            </div>
        </div>
        
        <footer style="background-color:#86a4c7; padding: 40px 0; color: #fff;">
            <div class="container text-center">
                <p style="font-size: 1.2em; margin-bottom: 20px;">Copyright &copy; 2024 Hafsa Travel Agency. All rights reserved.</p>
                <ul style="list-style: none; padding: 0; display: flex; justify-content: center; gap: 20px;">
                    <li><a href="#" style="color: #fff; text-decoration: none; font-size: 1.5em; transition: color 0.3s;"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#" style="color: #fff; text-decoration: none; font-size: 1.5em; transition: color 0.3s;"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#" style="color: #fff; text-decoration: none; font-size: 1.5em; transition: color 0.3s;"><i class="fab fa-linkedin-in"></i></a></li>
                    <li><a href="#" style="color: #fff; text-decoration: none; font-size: 1.5em; transition: color 0.3s;"><i class="fab fa-google-plus-g"></i></a></li>
                </ul>
                <p style="margin-top: 20px;">Developed by <a href="#" style="color: #fff; text-decoration: none; font-weight: bold;">Hafsa</a></p>
            </div>
        </footer>
        
        
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            $(function () {
                
                'use strict';
                
                var winH = $(window).height();
                
                $('header').height(winH);  
                
                $('header .container > div').css('top', (winH / 2) - ( $('header .container > div').height() / 2));
                
                $('.navbar ul li a.search').on('click', function (e) {
                    e.preventDefault();
                });
                $('.navbar a.search').on('click', function () {
                    $('.navbar form').fadeToggle();
                });
                
                $('.navbar ul.navbar-nav li a').on('click', function (e) {
                    
                    var getAttr = $(this).attr('href');
                    
                    e.preventDefault();
                    $('html').animate({scrollTop: $(getAttr).offset().top}, 1000);
                });
            })
           
window.addEventListener('scroll', () => {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

        </script>
        
    </body>
</html>