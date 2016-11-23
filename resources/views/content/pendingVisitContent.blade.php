@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="container">

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 bg-warning">
                    <h2><strong>PACJENT:</strong></h2>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Imię</th>
                            <th>Nazwisko</th>
                            <th>PESEL</th>
                            <th>Data urodzenia</th>
                            <th>Adres</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td>{{$patient->first_name}}</td>
                            <td>{{$patient->last_name}}</td>
                            <td>{{$patient->pesel}}</td>
                            <td>{{$patient->date_of_birth}}</td>
                            <td>{{$patient->address}}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Data wizyty</th>
                            <th>Godzina wizyty</th>
                            <th>Typ wizyty</th>
                            <th>Doktor</th>
                            <th>Odwołaj wizytę</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($visits as $visit)
                            <tr>
                                <td>{{$visit->date_of_visit}}</td>
                                <td>{{$visit->hour_of_visit}}</td>
                                <td>{{$visit->type_visit}}</td>
                                <td>{{$visit->first_name}} {{$visit->last_name}}</td>
                                <td><a href="{{url('')}}/patients/{{$patient->id}}/register-visit" class="btn btn-default">Odwołaj wizytę</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>







