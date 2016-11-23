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
                            <th>Edytuj wizytę</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($visits as $visit)
                            <tr>
                                <td>{{$visit->date_of_visit}}</td>
                                <td>{{$visit->hour_of_visit}}</td>
                                <td>{{$visit->type_visit}}</td>
                                <td>{{$visit->first_name}} {{$visit->last_name}}</td>
                                <td><a href="{{url('')}}/patients/{{$visit->id}}/remove-visit" class="btn btn-default">Odwołaj
                                        wizytę</a></td>
                                <td>
                                    <button data-toggle="modal" data-target="#edit{{$visit->id}}" class="btn btn-default">Edytuj
                                        wizytę
                                    </button>
                                </td>

                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="edit{{$visit->id}}" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Edycja wizyty</h4>
                                        </div>

                                           <div class="col-md-12">
                                               <form action="{{url('')}}/patients/{{$patient->id}}/edit-visit" method="POST" id="form{{$visit->id}}">
                                                   {{ csrf_field() }}
                                                   <div class="col-md-6">
                                                       <div class="form-group">
                                                           <label>Lekarz</label>

                                                           <select class="form-control" id="doctors{{$visit->id}}">
                                                               @foreach($doctors as $doctor)
                                                                   <option value="{{$doctor->id}}">{{$doctor->first_name}} {{$doctor->last_name}}</option>
                                                               @endforeach
                                                           </select>
                                                           <input type="hidden" id="doctor{{$visit->id}}" name="doctor">
                                                       </div>
                                                       <div class="form-group">
                                                           <label>Typ wizyty</label>
                                                           <input type="text" class="form-control" id="type" name="type">
                                                       </div>

                                                   </div>
                                                   <div class="col-md-6">
                                                       <div class="form-group">
                                                           <div class="col-md-6"><label>Data</label>
                                                               <input type="text" class="form-control" id="datepicker{{$visit->id}}" name="datepicker"></div>
                                                           <div class="col-md-6"><label>Time</label>
                                                               <input type="hidden" id="time{{$visit->id}}" name="timepicker" class="form-control">
                                                               <select class="form-control" id="timepicker{{$visit->id}}">
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
                                                       <div class="text-center">
                                                           <button type="submit" class="btn btn-default text-center">Umów wizytę</button>
                                                       </div>
                                                   </div>
                                                <input hidden value="{{$visit->id}}" name="visitId" id="visitId">
                                               </form>
                                           </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <script>
                                $(function () {
                                    $("#datepicker{{$visit->id}}").datepicker();
                                });

                                $('#datepicker{{$visit->id}}').change(function () {

                                    var choosenDate = $('#datepicker{{$visit->id}}').val();
                                    var doc = $("#doctors{{$visit->id}} option:selected").val();
                                    console.log(choosenDate+" "+doc);
                                    $.ajax({
                                        url: "{{url('')}}/ajaxdate",
                                        type: "GET",
                                        data: {freeDate: choosenDate, doctor: doc},
                                        success: function (data) {
                                            var hourArray = JSON.parse(data);


                                            $('#timepicker{{$visit->id}} > option').each(function () {
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
                                $('#form{{$visit->id}}').submit(function () {

                                    $('#doctor{{$visit->id}}').val($("#doctors{{$visit->id}} option:selected").val());
                                    $('#time{{$visit->id}}').val($("#timepicker{{$visit->id}} option:selected").text());

                                });
                            </script>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>






