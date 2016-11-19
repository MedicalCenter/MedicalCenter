<div class="container">

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>PESEL</th>
                    <th>Birth</th>
                    <th>Address</th>
                    <th>Wizyta</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $patient)
                    <tr>
                        <td>{{$patient->first_name}}</td>
                        <td>{{$patient->last_name}}</td>
                        <td>{{$patient->pesel}}</td>
                        <td>{{$patient->date_of_birth}}</td>
                        <td>{{$patient->address}}</td>
                        <td><a href="{{url('')}}/patients/{{$patient->id}}/register-visit" class="btn btn-default">Umów wizytę</a> </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



