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
    </div>
</nav>