<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ url('/mainPage') }}">Medical Center</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="{{ url('/mainPage') }}">Strona główna</a></li>
            <li><a href="{{url('/doctors/visits')}}">Dzisiejsze wizyty</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
            <!-- Authentication Links -->
            @if (!Auth::guest())
                <li>
                    <a href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->username }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Wyloguj
                            </a>

                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>

    </div>
</nav>