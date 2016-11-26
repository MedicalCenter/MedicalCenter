<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{url('')}}">Medical Center</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="{{ url('/') }}">Strona główna</a></li>
            <li><a href="{{url('/patients')}}">Zarządzanie pacjentami</a></li>
            <li><a href="{{url('/patients/insert')}}">Dodawanie pacjenta</a></li>
        </ul>

        @if (Auth::guest())
            <li><a href="{{ url('/login') }}">Login</a></li>
           <!-- <li><a href="{{ url('/register') }}">Register</a></li> -->
        @else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <ul class="dropdown-menu" role="menu">
                    <li>
                        <a href="{{ url('/logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        @endif

    </div>
</nav>