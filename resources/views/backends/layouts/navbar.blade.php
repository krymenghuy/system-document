<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
            @if(session()->has('language'))
                {{ session()->get('language') == 'en' ? 'English' : 'Khmer' }}
            @else
                English
            @endif
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#">
                Khmer
            </a>
            <a class="dropdown-item" href="#">
                English
            </a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-user"></i>
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
              @csrf
          </form>
         </div>
      </li>
    </ul>
  </nav>
