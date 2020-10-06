  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: lightblue;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

      <li class="nav-item d-none d-sm-inline-block">
        <h4 class="nav-link">{{ $title ?? '' ?? '' }}</h4>
        {{-- <h4 class="nav-link metitle"></h4> --}}
        {{-- <a class="nav-link"><h3>{{ $title ?? '' }}</h3></a> --}}
      </li>
      
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="adminlte3/index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
    </ul>

    <!-- SEARCH FORM -->
    {{-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> --}}




    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" style="    display: inline-flex;align-items: center;">
          <div class="image-cropper mr-2" style="max-height: 40px; max-width: 40px;">
            <img src="{{ url('images/users/noimage.jpg') }}" class="profileimg profile-pic">
          </div> 
          <span class="" style="font-style: normal;">{{ $composer_cur_user->name }}</span>
          {{-- <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span> --}}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="max-width: 500px;">
          {{-- <a href="#" class="dropdown-item"> --}}
            <!-- Message Start -->
            <form class="px-4 py-3" style="text-align-last: center;">
              <div class="image-cropper" style="margin: auto;">
                <img src="{{ url('images/users/noimage.jpg') }}" class="profileimg profile-pic">
              </div> 
              {{-- <img src="{{ url('adminlte3/dist/img/user1-128x128.jpg') }}" class="img-size-150 img-circle profileimg"> --}}
            
              <h3 class="dropdown-item">
                {{ $composer_cur_user->name }}
              </h3>
              <p class="text-sm"><i class="far fa-envelope mr-1"></i>{{ $composer_cur_user->email }}</p>
              <p class="text-sm">{{ $composer_cur_user->username }}</p>
            </form>
            
            <!-- Message End -->
          {{-- </a> --}}
          {{-- <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="adminlte3/dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="adminlte3/dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a> --}}
          <div class="dropdown-divider"></div>
          

          <div class="dropdown-item dropdown-footer">       
            @if (!str_contains($title ?? '', 'USER'))       
              <button class="btn btn-primary btn-sm EditProfileBtn" id="EditProfileBtn">
                <i class="fa fa-user-edit" style="margin-right: 4px;"></i>
                Edit Profile
              </button>
            @endif

            <button type="submit" class="btn btn-danger btn-sm" id="logoutBtn" form="logout-form">
              <i class="fa fa-sign-out-alt" style="margin-right: 4px;"></i>
              Logout
            </button>
          </div>

          <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
          </form>
        </div>
      </li>


      <!-- Notifications Dropdown Menu -->
      {{-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> --}}
    </ul>


  </nav>
  <!-- /.navbar -->