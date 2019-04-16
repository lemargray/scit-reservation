<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="{{asset('/images/faces/face1.jpg')}}" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name">{{ Auth::user()->name }}</p>
                  <div>
                    <small class="designation text-muted">{{ Auth::user()->role->description }}</small>
                    <span class="status-indicator online"></span>
                    <div style="margin-top:5px;" class="logout-button">
                      <a style="padding:5px !important" class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }} <i class="fas fa-sign-out-alt"></i>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <button class="btn btn-success btn-block">New Project
                <i class="mdi mdi-plus"></i>
              </button> -->
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">
              <i class="menu-icon mdi mdi-television"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#reservations" aria-expanded="false" aria-controls="reservations">
              <i class="menu-icon mdi mdi-calendar-multiple"></i>
              <span class="menu-title">Reservations</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="reservations">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('reservations.index')}}">View Reservations</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('reservations.create')}}">Reserve a Computer</a>
                </li>
              </ul>
            </div>
          </li>
          @if(auth()->user()->role->name == 'admin')
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users">
              <i class="menu-icon mdi mdi-account-multiple-plus"></i>
              <span class="menu-title">User Management</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="users">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('users')}}">View Users</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('register')}}">Add User</a>
                </li>
              </ul>
            </div>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#faults" aria-expanded="false" aria-controls="faults">
              <i class="menu-icon fas fa-exclamation-triangle"></i>
              <span class="menu-title">Faults</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="faults">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('faults.index')}}">Faults</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('faults.create')}}">Report a fault</a>
                </li>
              </ul>
            </div>
          </li>
          @if(auth()->user()->role->name == 'admin')
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#labs" aria-expanded="false" aria-controls="labs">
              <i class="menu-icon fas fa-building"></i>
              <span class="menu-title">Lab Management</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="labs">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('labs.index')}}">Labs</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('labs.create')}}">New Lab</a>
                </li>
              </ul>
            </div>
          </li>
          @endif 
          @if(auth()->user()->role->name == 'admin')
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#computers" aria-expanded="false" aria-controls="computers">
              <i class="menu-icon fas fa-desktop"></i>
              <span class="menu-title">Computer Management</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="computers">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="{{route('computers.index')}}">Computers</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('computers.create')}}">New Computer</a>
                </li>
              </ul>
            </div>
          </li>
          @endif 
          @if(auth()->user()->role->name == 'admin')
          <li class="nav-item">
            <a class="nav-link" href="{{route('courses.index')}}">
              <i class="menu-icon fas fa-book"></i>
              <span class="menu-title">Courses</span>
            </a>
          </li>
          @endif
          @if(auth()->user()->role->name == 'admin')
          <li class="nav-item">
            <a class="nav-link" href="{{route('closures.index')}}">
              <i class="menu-icon fas fa-door-closed"></i>
              <span class="menu-title">Closures</span>
            </a>
          </li>
          @endif
          @if(auth()->user()->role->name == 'admin')
          <li class="nav-item">
            <a class="nav-link" href="{{route('computer-hours.index')}}">
              <i class="menu-icon far fa-clock"></i>
              <span class="menu-title">Reservation Hours</span>
            </a>
          </li>
        @endif
        </ul>        
      </nav>