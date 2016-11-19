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
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>PESEL</th>
                            <th>Birth</th>
                            <th>Address</th>
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
                <h2>Umów wizytę</h2>
                <form action="{{url('')}}/patients/{{$patient->id}}/register-visit" method="POST" id="form">
                    {{ csrf_field() }}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Lekarz</label>
                            <select class="form-control" id="doctors">
                                @foreach($doctors as $doctor)
                                    <option>{{$doctor->first_name}} {{$doctor->last_name}}</option>
                                @endforeach
                            </select>
                            <input type="hidden" id="doctor" name="doctor">
                        </div>
                        <div class="form-group">
                            <label>Typ wizyty</label>
                            <input type="text" class="form-control" id="type" name="type">
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data</label>
                            <input type="text" class="form-control" id="datepicker" name="datepicker">

                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="text-center">
                            <button type="submit" class="btn btn-default text-center">Umów wizytę</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script>

    $( function() {
        $( "#datepicker" ).datepicker();
    } );

    $('#form').submit(function () {

        $('#doctor').val( $("#doctors option:selected").text());

    });



</script>