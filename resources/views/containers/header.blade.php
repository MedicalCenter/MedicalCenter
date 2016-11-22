<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{url('')}}">Medical Center</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="{{url('')}}">Home</a></li>
            <li><a href="{{url('doctors')}}">Doctors</a></li>
            <li><a href="{{url('/patients')}}">Patients</a></li>
            <li><a href="{{url('/patients/insert')}}">Add patient</a> </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
    </div>
</nav>