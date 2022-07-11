<!DOCTYPE html>
<html>
<head>
    <title>Prueba Arnau</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" defer src="{{ asset('js/tiempo/index.js') }}"></script>
    <link rel="stylesheet" href="{{asset('css/tiempo/index.css')}}">
</head>
<body>
  <div class="container mt-4">
  <div class="card">
    <div class="card-header text-center font-weight-bold">
      Prueba Arnau - Laravel 8
    </div>
    <div class="card-body">
      <form name="tiempo-search-form" id="tiempo-form">
       @csrf
        <div class="form-group">
          <label for="municipio">Buscar por municipio</label>
          <input type="text" id="municipio" name="municipio" class="form-control" required="">
        </div>
        <button id="buscar" type="button" class="btn btn-primary">Buscar</button>
      </form>
    </div>
  </div>
</div> 
<div class="container mt-4" id="contenedor-principal" style="display:none;">
  <div class="card">
    <div class="card-body" id="result">
    <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Dia</th>
            <th scope="col">Estado cielo</th>
            <th scope="col">Temperatura (ºC)</th>
            <th scope="col">Viento (km/h)</th>
            <th scope="col">Humedad (%)</th>
            <th scope="col">Prob. Precipitación</th>
            <th scope="col">Cota Nieve (m)</th>
          </tr>
        </thead>
        <tbody id="cuerpo-tabla">
        </tbody>
      </table> 
    </div>
  </div>
</div>   
</body>
</html>
