<div class="container">
    <div class="col-md-12">
        <table class="table table-striped" id="table">
            <thead>
            <tr>

                <th>Data wizyty</th>
                <th>Godzina wizyty</th>
                <th>Cena</th>
                <th>Typ</th>
                <th>Diagnoza</th>
            </tr>
            </thead>
            <tbody>

                <tr>
                    <td>{{$data->date_of_visit}}</td>
                    <td>{{$data->hour_of_visit}}</td>
                    <td>{{$data->price}}</td>
                    <td>{{$data->type}}</td>
                    <td>{{$data->diagnosis}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>



