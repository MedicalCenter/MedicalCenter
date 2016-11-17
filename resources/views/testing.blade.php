<!-- This class is just for testing purposes, delete if necessary-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eloquent Bears</title>

    <!-- CSS -->
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <style>
        body { padding-top:50px; } /* add some padding to the top of our site */
    </style>
</head>
<body class="container">
<div class="col-sm-8 col-sm-offset-2">

    <table class="table-bordered">
        <thead>
        <tr class>
            <th>Id</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data as $row)
        <tr>
            <td><?php echo $row->id?></td>
        </tr>
        @endforeach
        </tbody>
    </table>

</div>
</body>
</html>