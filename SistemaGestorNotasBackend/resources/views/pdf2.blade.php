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
    <h3 class="center">Notas acumuladas</h3>
  </div>
  <div class="col-12">
  </div>
    <table class="table"  width="100%" cellspacing="0">
        <thead class="thead-dark">
<tr>
  <th colspan="6" class="text-center">Carga Académica</th>
</tr>
      <tr>
        <th scope="col">Código</th>
        <th scope="col">Nombre Completo</th>
        <th scope="col">Actividades</th>
        <th scope="col">Porcentaje</th>
        <th scope="col">Nota</th>
        <th scope="col">Promedio</th>        

      </tr>
    </thead>
    <tbody>

      {{-- "cargasAcademicas": [
    {
      "id": 1,
      "codigo_alumno": "MA17092",
      "nombre_alumno": "Jason Saul",
      "apellido_alumno": "Martinez Argueta",
      "actividades": [
        {
          "id": 1,
          "codigo_actividad": "A1",
          "porcentaje_actividad": "50.00",
          "notaTotal": 10
        }
      ],
      "promedioActual": 5
    }
  ],
  "infoGeneral": [
      "nombre_curso": "MATEMATICA"
    },
      "codigo_nivel": "NI"
    },
    "Periodo": "P2022",
    "Mes": "MES1"
  ] --}}
  {{$cargasAcademicas = $notaAcumulada["cargasAcademicas"] }}


        @foreach($cargasAcademicas as $item)
            <tr>
            <th scope="row">{{$item->codigo_alumno}}</th>
            <th scope="row">{{$item->nombre_alumno."  ".$item->apellido_alumno}}</th>
            @foreach($item->actividades as $actividades)
            <th scope="row">{{$actividades->codigo_actividad}}</th>
            <th scope="row">{{$actividades->porcentaje_actividad}}</th>
            <th scope="row">{{$actividades->notaTotal}}</th>
            @endforeach
            <th scope="row">{{$item->promedioActual}}</th>
      @endforeach


    </tr>
    </tbody>
  </table> 
</body>

</html>