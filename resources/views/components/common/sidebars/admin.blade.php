  <!-- Left Sidebar Start -->
  <div class="app-sidebar-menu">
      <div class="h-100" data-simplebar>

          <!--- Sidemenu -->
          <div id="sidebar-menu">

              <div class="logo-box">
                  <a class='logo logo-light' href='index.html'>
                      <span class="logo-sm">
                          <img src="assets/images/logo-sm.png" alt="" height="22">
                      </span>
                      <span class="logo-lg">
                          <img src="assets/images/logo-light.png" alt="" height="24">
                      </span>
                  </a>
                  <a class='logo logo-dark' href='index.html'>
                      <span class="logo-sm">
                          <img src="assets/images/logo-sm.png" alt="" height="22">
                      </span>
                      <span class="logo-lg">
                          <img src="assets/images/logo-dark.png" alt="" height="24">
                      </span>
                  </a>
              </div>

              <ul id="side-menu">
                  @foreach ($menus as $menu)
                      @if (!empty($menu['children']))
                          <li class="menu-title">{{ $menu['name'] }}</li>
                          @foreach ($menu['children'] as $child)
                              @if (!empty($child['children']))
                                  <li>
                                      <a href="#sidebarDashboards" data-bs-toggle="collapse">
                                          <i data-feather="home"></i>
                                          <span> {{ $child['children']['name'] }} </span>
                                          <span class="menu-arrow"></span>
                                      </a>
                                      <div class="collapse" id="sidebarDashboards">
                                          <ul class="nav-second-level">
                                              <li>
                                                  <a class='tp-link' href='index.html'>Analytical</a>
                                              </li>
                                              <li>
                                                  <a class='tp-link' href='ecommerce.html'>E-commerce</a>
                                              </li>
                                          </ul>
                                      </div>
                                  </li>
                              @else
                                  <li>
                                      <a class='tp-link' href='{{ $child['route'] }}'>
                                          <i data-feather="calendar"></i>
                                          <span> {{ $child['name'] }} </span>
                                      </a>
                                  </li>
                              @endif
                          @endforeach
                      @else
                          <li>
                              <a class='tp-link' href="{{ $child['route'] }}">
                                  <i data-feather="calendar"></i>
                                  <span> {{ $menu['name'] }} </span>
                              </a>
                          </li>
                      @endif
                  @endforeach
              </ul>
          </div>
          <!-- End Sidebar -->

          <div class="clearfix"></div>

      </div>
  </div>
  <!-- Left Sidebar End -->
