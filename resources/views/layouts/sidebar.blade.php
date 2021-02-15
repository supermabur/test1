
  @include('layouts.topbar')

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar elevation-4 sidebar-light-success  " >
      <!-- Brand Logo -->
      <a href="/" class="brand-link navbar-success bg-color1" style="padding: 1.1rem .5rem;">
        <img src="{{ url('images/TLogo.png') }}" alt="AdminLTE Logo" 
            class="brand-image img elevation-0"
            style="opacity: 1"
            {{-- style="height: 39px;" --}}
            >
        <span class="brand-text font-weight-bold text-white">{{ str_replace('_', ' ', config('app.name', 'Backoffice')) }}</span>
      </a>

      

      <!-- Sidebar -->
      <div class="sidebar" style="background-image: url({{ url('images/sidebarbg.png') }});background-repeat: no-repeat;background-size: cover;">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{ url('images/users/noimage.jpg') }}" class="img-circle elevation-2 profileimg" alt="User Image">
          </div>
          <div class="info" style="width: 100%">

            <form id="logout-form" action="{{ route('logout') }}" method="POST">
              @csrf
              <div class="">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>

                <button type="submit" class="btn btn-danger btn-sm" id="logoutBtn">
                  <i class="fa fa-sign-out-alt" style="margin-right: 4px;"></i>
                  Logout
                </button>
              </div>
            </form>
          </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column text-sm" data-widget="treeview" role="menu" data-accordion="false">

            {{-- <li class="nav-header">LAPORAN</li>
            <li class="nav-item">
              <a href="/rptpersediaan" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>Persediaan</p>
              </a>
            </li> --}}

            @foreach ($composer_stmemenu_h as $h)
              <li class="nav-item has-treeview menu-open">
                <a href="#" class="nav-link">
                  <i class="nav-icon {{$h->icon}}"></i>
                  <p>
                    {{$h->name}}
                    <i class="fas fa-angle-left right"></i>
                    {{-- <span class="badge badge-info right">6</span> --}}
                  </p>
                </a>


                <ul class="nav nav-treeview" style="padding-left: 20px;font-weight: 200;line-height: 1;">
                  @foreach ($composer_stmemenu_d as $d)
                    @if ($h->id == $d->parentid)
                      
                      <li class="nav-item">
                        @if ($d->useglobreport == 0)
              
                          @if (strpos(url()->current(), $d->links) > 0 )
                            <a href="/{{$d->links}}" class="nav-link active">
                          @else
                            <a href="/{{$d->links}}" class="nav-link">
                          @endif                        
                            <i class="nav-icon far {{$d->icon}}" style="font-size: 1rem;"></i>
                            <p>{{$d->name}}</p>
                          </a>
                        @else
                          @if (route('grctrl.show', $d->id) == url()->current())
                            <a href="{{ route('grctrl.show', $d->id) }}" class="nav-link active">
                          @else
                            <a href="{{ route('grctrl.show', $d->id) }}" class="nav-link">                              
                          @endif

                            <i class="nav-icon far {{$d->icon}}" style="font-size: 1rem;"></i>
                            <p>{{$d->name}}</p>
                          </a>
                        @endif

                        {{-- <a onClick="GoMenu(this)" data-id="{{$d->id}}" class="nav-link">
                          <i class="nav-icon far fa-circle" style="font-size: 1rem;"></i>
                          <p>{{$d->name}}</p>
                        </a> --}}
                      </li>                
                    @endif
                  @endforeach
                </ul>
              </li>
            @endforeach



            {{-- <li class="nav-header">MISCELLANEOUS</li>
            <li class="nav-item">
              <a href="https://adminlte.io/docs/3.0" class="nav-link">
                <i class="nav-icon fas fa-file"></i>
                <p>Documentation</p>
              </a>
            </li>
            <li class="nav-header">MULTI LEVEL EXAMPLE</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Level 1</p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-circle"></i>
                <p>
                  Level 1
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Level 2</p>
                  </a>
                </li>
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Level 2
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Level 3</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Level 3</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Level 3</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Level 2</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="fas fa-circle nav-icon"></i>
                <p>Level 1</p>
              </a>
            </li>
            <li class="nav-header">LABELS</li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-circle text-danger"></i>
                <p class="text">Important</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-circle text-warning"></i>
                <p>Warning</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon far fa-circle text-info"></i>
                <p>Informational</p>
              </a>
            </li>  --}}


          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>