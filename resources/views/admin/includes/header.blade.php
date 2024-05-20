<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      

      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <div class="user-panel d-flex nav-link" style="height: 50px" data-toggle="dropdown">
            <div class="info">
                
            </div>
            <i class="right fas fa-angle-down" style="margin-top:10px"></i>
            <br>
        </div>
        
        
        
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
         
          <div class="dropdown-divider"></div>
          <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="nav-link">
            <span>
                Déconnecter
            </span>
            </a>
        
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
            
            
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
    </ul>
  </nav>