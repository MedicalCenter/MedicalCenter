<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Pacjent</th>
                    <th>Godzina</th>
                    <th>Historia wizyt</th>
                    <th>Zakończ wizytę</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $var)
                <tr>
                    <td>{{$var->first_name}} {{$var->last_name}}</td>
                    <td>{{$var->hour_of_visit}}</td>
                    <td><a href="{{url('/doctors')}}/visits/{{$var->patient_id}}/viewHistory" class="btn btn-default">Historia wizyt</a> </td>
                    <td><a href="{{url('/doctors')}}/visits/{{$var->patient_id}}/viewHistory" class="btn btn-default">Zakończ wizytę</a> </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>







