<ul class="navbar-nav  sidebar bc sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-icon ">
          hafsa Travel Agency {{--  <img src="{{asset('/imgs/logo.png')}}"  class="lg"> --}}
        
        </div>
        <div class="sidebar-brand-text mx-3"></div>
    </a>
    
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
    
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    
    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>
    
    <!-- Nav Item - Pages Collapse Menu -->
    @if( auth()->user()->type === 'admin')

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts" aria-expanded="true" aria-controls="collapseProducts">
          <i class="fas fa-fw fa-user"></i>

          <span>Gestion d'admin</span>
        </a>
        <div id="collapseProducts" class="collapse" aria-labelledby="headingProducts" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('admin.create')}}">ajouter admin</a>
            <a class="collapse-item" href="{{route('admin.index')}}">Afficher les admin</a>
          </div>
        </div>
      </li>
    

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProduct" aria-expanded="true" aria-controls="collapseProduct">
        <i class="fas fa-fw fa-user-shield"></i>
          <span>Gestion des utulisateur</span>
        </a>
        <div id="collapseProduct" class="collapse" aria-labelledby="headingProduct" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('utilisateur.create')}}">Ajouter utilisateur</a>
            <a class="collapse-item" href="{{route('utilisateur.index')}}">Afficher les utilisateur</a>
          </div>
        </div>
      </li>
      
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVehicle" aria-expanded="true" aria-controls="collapseVehicle">
          <i class="fas fa-hotel"></i>
          <span>Gestion Hotels</span>
        </a>
        <div id="collapseVehicle" class="collapse" aria-labelledby="headingVehicle" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('hotels.create')}}">Ajouter Hotel</a>
            <a class="collapse-item" href="{{route('hotels.index')}}">Afficher les  Hotels</a>
          </div>
        </div>
      </li>
      {{-- @endif --}}
     
      
    <!-- Nav Item - Utilities Collapse Menu -->
   
    
    <!-- Nav Item - Charts -->
  <!-- Menu pour le propriétaire de véhicule -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ownerMenu" aria-expanded="true" aria-controls="ownerMenu">
      <i class="fas fa-car"></i>
      <span>Gestion des Voitures</span>
    </a>
    <div id="ownerMenu" class="collapse" aria-labelledby="headingOwner" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="{{ route('voitures.create') }}">Ajouter Voiture</a>
        <a class="collapse-item" href="{{ route('voitures.index') }}">Afficher les Voitures</a>

    
      </div>
    </div>
</li>

<!-- Menu pour l'inspecteur -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#trajetMenu" aria-expanded="true" aria-controls="trajetMenu">
        <i class="fas fa-plane"></i>
        <span>Gestion des Vols</span>
    </a>
    <div id="trajetMenu" class="collapse" aria-labelledby="headingTrajet" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('voles.create') }}">Ajouter un Vol</a>
            <a class="collapse-item" href="{{ route('voles.index') }}">Afficher les Vols</a>
        </div>
    </div>
</li>
@endif

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ownerMen" aria-expanded="true" aria-controls="ownerMen">
        <i class="fas fa-car-side"></i>
        <span>Réservation Voiture</span>
    </a>
    <div id="ownerMen" class="collapse" aria-labelledby="headingOwner" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded" style="font-size:11px">
            <a class="collapse-item" href="{{ url('voituresreservation.mes_reservation') }}">Réservation Voiture</a>
            <a class="collapse-item" href="{{ url('voituresreservation.index') }}">Voitures disponibles</a>
            <a class="collapse-item"  href="{{ route('historique_reservations') }} ">Historique Réservations voitures </a>

        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ownerMessn" aria-expanded="true" aria-controls="ownerMessn">
        <i class="fas fa-ticket-alt"></i>
        <span>Réservation Vols</span>
    </a>
    <div id="ownerMessn" class="collapse" aria-labelledby="headingOwner" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded" style="font-size:11px">
            <a class="collapse-item" href="{{ url('volesreservation.mes_reservation') }}">Réservation Vol</a>
            <a class="collapse-item" href="{{ url('volesreservation.index') }}">Vols disponibles</a>
            <a class="collapse-item" href="{{ route('historique_reservations_vols') }}">Historique Réservations Vols </a>

        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ownersMessn" aria-expanded="true" aria-controls="ownersMessn">
        <i class="fas fa-hotel"></i>
        <span>Réservation Hotel</span>
    </a>
    <div id="ownersMessn" class="collapse" aria-labelledby="headingOwner" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded"  style="font-size:11px">
            <a class="collapse-item" href="{{ route('reservation_hotels') }}">Réservation Hotel</a>
            <a class="collapse-item" href="{{ route('res_hotel') }}">Hôtels disponibles</a>
            <a class="collapse-item" href="{{ route('historique_reservations') }}">Historique Réservations Hôtels </a>

        </div>
    </div>
</li>



 <li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#trajetMeasnu" aria-expanded="true" aria-controls="trajetMenu">
    <i class="fas fa-fw fa-money-check-alt"></i>
    <span>Paiement</span>
  </a>
  <div id="trajetMeasnu" class="collapse" aria-labelledby="headingTrajet" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">

          <a class="collapse-item" href="{{route('payments.index')}}">Historique des paiements</a> <!-- Lien pour ajouter un nouveau trajet -->
      </div> 
  </div>
</li>
    
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
    
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
     
      
    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        
       <p class="text-center mb-2"><strong>Gestion Voyage HFSA Agency Travel </strong> 
        <p>Notre service de bus, votre trajet en toute facilité ! Votre voyage sans souci.</p>
    </div>
    
    </ul>