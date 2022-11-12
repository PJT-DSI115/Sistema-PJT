<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
  <div class="alert alert-dark" role="alert">
    <h1 class="center">Nomina de notas por curso</h1>
  </div>

    <table class="table"  width="100%" cellspacing="0">
        <thead class="thead-dark">
      <tr>
        <th scope="col">id</th>
        <th scope="col">Nombre Alumno</th>
        <th scope="col">Nota</th>
        <th scope="col">Curso</th>
      </tr>
    </thead>
    <tbody>
        @foreach($nomina as $item)
            <tr>
            <th scope="row">{{$item->id}}</th>
            <td>{{$item->nombre_alumno}}</td>
            <td>{{$item->nota}}</td>
            <td>{{$item->nombre_curso}}</td>
            </tr>
      @endforeach
    </tbody>
  </table> 
</body>

</html>