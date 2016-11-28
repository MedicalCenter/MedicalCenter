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
                        <td><a href="{{url('/doctors')}}/visits/{{$var->patient_id}}/viewHistory"
                               class="btn btn-default">Historia wizyt</a></td>
                        <td><a data-toggle="modal" data-target="#edit{{$var->patient_id}}" class="btn btn-default">Zakończ
                                wizytę</a></td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="edit{{$var->patient_id}}" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Podsumowanie wizyty</h4>
                                </div>

                                <div class="col-md-12">
                                    <form action="{{url('/doctors')}}/visits/{{$var->id}}" method="POST"
                                          id="form{{$var->patient_id}}">
                                        {{ csrf_field() }}
                                        <div class="col-md-6 col-md-offset-3">
                                            <div class="form-group">
                                                <label>Cena</label>

                                                <input class="form-control" type="number" id="" name="price">
                                            </div>
                                            <div class="form-group">
                                                <label>Diagnoza</label>
                                                <textarea cols="10" rows="10" class="form-control" id="diagnosis"
                                                          name="diagnosis"></textarea>
                                            </div>
                                            <input type="hidden" name="doctor_id" value="{{$var->doctor_id}}">
                                            <input type="hidden" name="type" value="{{$var->type_visit}}">
                                            <input type="hidden" name="date" value="{{$var->date_of_visit}}">
                                            <input type="hidden" name="hour" value="{{$var->hour_of_visit}}">
                                            <input type="hidden" name="patient_id" value="{{$var->patient_id}}">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="text-center">
                                                <button type="submit"
                                                        onclick="return confirm('Czy napewno chcesz zamknąć wizytę?');"
                                                        class="btn btn-default text-center">Zakończ wizytę
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>







