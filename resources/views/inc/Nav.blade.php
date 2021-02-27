
<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark primary-color py-2">
  <div class="container">


    <!-- Navbar brand -->
    <a class="navbar-brand ml-3 font-weight-bold mr-4" href='/'>Rim Logistics</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
              aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Collapsible content -->

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="basicExampleNav">

        <!-- Links -->
        <ul class="navbar-nav mr-auto ml-lg-4">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">Invoices</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="{{route('invoices')}}">All</a>
                    <a class="dropdown-item" href="{{route('invoice.create')}}">Add</a>

                </div>
            </li>
            <li class="nav-item dropdown ml-lg-5">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink2" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">Fuel</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink2">
                    <a class="dropdown-item" href="{{route('fuel')}}">All</a>
                    <a class="dropdown-item" href="{{route('fuel.create')}}">Add</a>

                </div>
            </li>

    <li class="nav-item ml-lg-5">
        <a class="nav-link" href="{{route('invoice.weekly')}}">Paycheck</a>
    </li>
            <li class="nav-item ml-lg-5">
        <a class="nav-link" href="{{route('ifta.import')}}">Iftas</a>
    </li>


            <!-- Dropdown -->


        </ul>
        <div class="nav-item dropdown float-right">
            <a id="navbarDropdown" class="nav-link text-white dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
        <!-- Links -->

    </div>
    <!-- Collapsible content -->
  </div>
</nav>
<!--/.Navbar-->
