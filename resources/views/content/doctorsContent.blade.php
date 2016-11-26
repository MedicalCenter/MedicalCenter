<div class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Secjalization</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $doctor)
                    <tr>
                        <td>{{$doctor->first_name}}</td>
                        <td>{{$doctor->last_name}}</td>
                        <td>{{$doctor->specialization}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>







