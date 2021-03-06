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
                <h2>Umów wizytę</h2>
                <form action="{{url('')}}/patients/{{$patient->id}}/register-visit" method="POST" id="form">
                    {{ csrf_field() }}
                    <div class="col-md-6">
                        <div class="form-group" style="margin-top: 20px">
                            <label>Lekarz</label>

                            <select class="form-control" id="doctors">
                                @foreach($doctors as $doctor)
                                    <option value="{{$doctor->id}}">{{$doctor->first_name}} {{$doctor->last_name}}</option>
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
                            <div class="col-md-6" style="margin-top: 20px"><label>Data</label>
                                <input type="text" class="form-control" id="datepicker" name="datepicker"></div>
                            <div class="col-md-6" style="margin-top: 20px"><label>Godzina wizyty</label>
                                <input type="hidden" id="time" name="timepicker" class="form-control">
                                <select class="form-control" id="timepicker">
                                    <option>8:00</option>
                                    <option>8:30</option>
                                    <option>9:00</option>
                                    <option>9:30</option>
                                    <option>10:00</option>
                                    <option>10:30</option>
                                    <option>11:00</option>
                                    <option>11:30</option>
                                    <option>12:00</option>
                                    <option>12:30</option>
                                    <option>13:00</option>
                                    <option>13:30</option>
                                    <option>14:00</option>
                                    <option>14:30</option>
                                    <option>15:00</option>
                                    <option>15:30</option>
                                    <option>16:00</option>
                                </select></div>

                        </div>

                    </div>
                    <div class="col-md-12">
                        <div class="text-center" style="margin-top: 10px">
                            <button type="submit" onclick="return confirm('Czy na pewno chcesz umówić wizytę?');" class="btn btn-default text-center">Umów wizytę</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<script>

    $(function () {
        $("#datepicker").datepicker();
    });

    $('#datepicker').change(function () {

        var choosenDate = $('#datepicker').val();
        var doc = $("#doctors option:selected").val();

        $.ajax({
            url: "{{url('')}}/ajaxdate",
            type: "GET",
            data: {freeDate: choosenDate, doctor: doc},
            success: function (data) {
                var hourArray = JSON.parse(data);


                $('#timepicker> option').each(function () {
                    for (var i = 0; i < hourArray.length; i++) {
                        if (hourArray[i].hour_of_visit === $(this).text()) {
                            console.log($(this).text());
                            console.log(hourArray[i]);
                            $(this).attr('disabled', 'disabled');
                        }
                    }

                });
            },
            error: function () {
                console.log('error')
            }
        });
    });
    $('#form').submit(function () {

        $('#doctor').val($("#doctors option:selected").val());
        $('#time').val($("#timepicker option:selected").text());

    });


</script>