<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Doktor</th>
                    <th>Data</th>
                    <th>Godzina</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $var)
                    <tr>
                        <td>{{$var->first_name}} {{$var->last_name}}</td>
                        <td>{{$var->date_of_visit}}</td>
                        <td>{{$var->hour_of_visit}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>







