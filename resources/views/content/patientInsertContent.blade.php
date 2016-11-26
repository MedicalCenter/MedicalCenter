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
                <h2>Dodaj pacjenta</h2>
                <form action="{{url('')}}/patients/insert" method="POST" id="form">
                    {{ csrf_field() }}
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Imię pacjenta</label>
                            <input type="text" class="form-control" id="firstName" name="firstName">
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Nazwisko pacjenta</label>
                            <input type="text" class="form-control" id="lastName" name="lastName">
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label>PESEL pacjenta</label>
                            <input type="text" class="form-control" id="pesel" name="pesel">
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Data urodzenia</label>
                            <input type="text" class="form-control" id="datepicker" name="datepicker">
                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Adres pacjenta</label>
                            <input type="text" class="form-control" id="address" name="address">
                        </div>

                    </div>

                    <div class="col-md-12">
                        <div class="text-center">
                            <button type="submit" class="btn btn-default">Dodaj pacjenta</button>
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




//    $('#form').submit(function () {
//
//        /*$('#doctor').val( $("#doctors option:selected").val());
//        $('#time').val($("#timepicker option:selected").text());*/
//
//    });



</script>