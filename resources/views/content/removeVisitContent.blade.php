<div class="container">

    <form action="{{url('')}}/patients/unregister" method="POST" id="form">

            <label>Nazwisko pacjenta</label>
            <input type="text" class="form-control" id="lastName" name="lastName">
            <button type="submit" class="btn btn-default">Dodaj pacjenta</button>

    </form>
    @if(!empty($data))
        <div class="row">
            <div class="col-md-12">
                <input class="form-control" id="search" type="text" placeholder="Wyszukaj pacjenta...">
                <table class="table table-striped" id="table">
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
                            <td><a href="{{url('')}}/patients/{{$patient->id}}/register-visit" class="btn btn-default">Umów
                                    wizytę</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>


<script>

    $("#search").keyup(function () {
        _this = this;
        // Show only matching TR, hide rest of them
        $.each($("#table tbody tr"), function () {
            if ($(this).text().toLowerCase().indexOf($(_this).val().toLowerCase()) === -1)
                $(this).hide();
            else
                $(this).show();
        });
    });
</script>



