@if(isset($message))
    <div class="alert alert-success text-center" style="font-size: 22px; margin-top: 20px">
        {{$message}}
    </div>
@endif
@if(isset($errors))
    @if (count($errors) > 0)
        <div class="alert alert-danger text-center" style="font-size: 16px; margin-top: 20px">

            @foreach ($errors->all() as $error)
                {{ $error }}<br>
            @endforeach

        </div>
    @endif
@endif
<div class="container">

    <div class="row">
        <div class="col-md-12" >
            <input class="form-control" id="search" type="text" placeholder="Wyszukaj pacjenta..." style="margin-top: 10px">
            <table class="table table-striped" id="table" style="margin-top: 30px" >
                <thead>
                <tr>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                    <th>PESEL</th>
                    <th>Data urodzenia</th>
                    <th>Adres</th>
                    <th>Wizyta</th>
                    <th>Zaplanowane wizyty</th>
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
                        <td><a href="{{url('')}}/patients/{{$patient->id}}/pending-visit" class="btn btn-default">Zaplanowane wizyty</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>

    $("#search").keyup(function(){
        _this = this;
        // Show only matching TR, hide rest of them
        $.each($("#table tbody tr"), function() {
            if($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                $(this).hide();
            else
                $(this).show();
        });
    });
</script>



