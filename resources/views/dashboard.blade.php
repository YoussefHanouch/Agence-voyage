@extends('layouts.app')
  
@section('title')
  
@section('contents')
{{-- @if( auth()->user()->type === 'admin')
<h1> Dashboard -  Admin   Busma </h1>
@else
<h1> Bonjour  utilisateur {{ auth()->user()->nom }} {{ auth()->user()->prenom }}</h1>

@endif
{{--  --}} 
  <div class="row">
    
    @if( auth()->user()->type === 'admin')

    <!-- Earnings (Monthly) Card Example -->
   
  
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                         Nombre d'utilisateurs  </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $clientCount }}</div>
                    </div>
                    <div class="col-auto">
                        <!-- <i class="fas fa-dollar-sign fa-2x text-gray-300"></i> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Nombre des admin </div>
                           <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $adminCount }}</div>
                        </div>
                    <div class="col-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            voiture Reservations: </div>
                           <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $carReservationsCount }}</div>
                        </div>
                    <div class="col-auto">
                        <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            vols Reservations: </div>
                           <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $flightReservationsCount }}</div>
                        </div>
                    <div class="col-auto">
                        <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Hotel Reservations:</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$hotelReservationsCount}}</div>
                        </div>
                       
                        
                    <div class="col-auto">
                                      
                </div>
            </div>
        </div>
    </div>
</div>
  </div>
  @else
    <style>
     

.container-scroller {
    width: 100%;
    max-width: 1200px;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 20px;
}

.h2_font {
    text-align: center;
    font-size: 32px;
    font-family: 'Courier New', Courier, monospace;
    color: #333;
    margin-bottom: 20px;
}

.btn-container {
    text-align: center;
    margin-bottom: 20px;
}

.btn-ajouter {
    text-decoration: none;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    background-color: #69A1D2;
    color: #fff;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-ajouter:hover {
    background-color: #357ABD;
}






.detail-link {
    text-decoration: none;
    color: #007bff;
}

.btndetail:hover {
    background-color: darkblue;
}

.user-orders-container {
  padding: 20px;
  width: 100%;
  
}

.orders-list{
    display: grid;
  grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); /* Utilisez auto-fill */
  gap: 10px;
  margin-right: 0%;
  
}
.order-card {
  display: flex; /* Utilisez flexbox pour aligner les elements en ligne */
  align-items: center; /* Alignez les elements sur l'axe vertical */
  background-color: #ffffff;
  border-radius: 8px;
  box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
  padding: 20px;
  margin-bottom: 10px;
  box-shadow: 0 30px 38px rgba(0, 0, 0, 0.228), 0 1px 10px rgba(0, 0, 0, 0.137);
}
.order-info {
  flex-grow: 1; 
 width: 300%;
}
.image-produitdet {
    border-radius: 5px;
  width: 100%;
  height:130px; /* Ajustez la taille de l'image selon vos besoins */
  margin-right: 2px; /* Ajoutez une marge à droite pour separer les images des autres elements */
  box-shadow: 0 30px 38px rgba(255, 250, 255, 0.228), 0 0px 50px rgba(255, 255, 255, 0.137);
}
.img_size{
    width:219px;
  height:120px; /* Ajustez la taille de l'image selon vos besoins */
 
        }
    </style>

  

    <div class="user-orders-container">
        <div class="main-panel">
            <div class="content-wrapper">
                <h2 class="h2_font">Voles Disponibles</h2>
                <div class="btn-container">
                    <a class="btn-ajouter" href="{{url('volesreservation.mes_reservation')}}">Mes reservation </a>
                </div>
               
                <div class="orders-list">
                    @csrf
                    @foreach($voles as $vol)
                    
                        <div class="order-card">
                        <a class="detail-link" href="{{url('volesreservation.info', $vol->id)}}">
                        <div  className="product-infodet">

                         @if(!empty($vol->image))
                            <img src="{{asset($vol->image)}}" alt="photo"  class="img_size" /> <br>
                             @else
                              <img src="{{asset('image/no-image.jpg')}}" alt="no-image"  class="img_size" /><br> 
                        @endif 


          </div>
                        <div class="order-info">
                            
                            <div>
                        <strong>Compagnie  :</strong> {{$vol->compagnie_aerienne}}
                             </div>
                            <div>
                        <strong>Numero de vol :</strong> {{$vol->numero_de_vol}}
                             </div>
                             <div>
                        <strong>Date depart :</strong> {{$vol->date_depart}}
                             </div>
                             <div>
                        <strong>Date arrivee :</strong> {{$vol->date_arrivee}}
                             </div>
                             <div>
                        <strong>Lieu depart :</strong> {{$vol->lieu_depart}}
                             </div>
                             <div>
                        <strong>Lieu arrivee :</strong> {{$vol->lieu_arrivee}}
                             </div>
                             <div>
                        <strong>Places disponibles :</strong> {{$vol->places_disponibles}}
                             </div>
                             <div>
                        <strong>Prix :</strong> {{$vol->prix}}
                             </div>
                           
                         
                           
                            </div> 
    </a>                        
</div>

@endforeach
</div>
                   
                        
                        
                           
                            
                           
                           
                            
                      
                   
    

  <div >
@endif
@endsection