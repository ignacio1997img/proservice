<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sistema</title>



    <link href="https://fonts.googleapis.com/css?family=Noto+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    {!! Form::open(['route' => 'beneficiary.store','class' => 'was-validated', 'method'=>'POST', 'enctype' => 'multipart/form-data'])!!}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Razon Social:</b></span>
                </div>
                <input type="text" class="form-control" id="name" name="name" required>
            </div> 
            <div class="col-md-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Responsable:</b></span>
                </div>
                <input type="text" class="form-control" id="responsible" name="responsible" required>
            </div> 
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Telefono 1:</b></span>
                </div>
                <input type="number" step="any" class="form-control" id="phone1" name="phone1" >
            </div>
            <div class="col-md-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Telefono 2:</b></span>
                </div>
                <input type="number" class="form-control" id="phone2" name="phone2">
            </div> 
            <div class="col-md-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Sitio Web:</b></span>
                </div>
                <input type="text" class="form-control" id="website" name="website">
            </div> 
            <div class="col-md-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>foto:</b></span>
                </div>
                <input type="file" class="form-control" id="image" name="image">
            </div> 
        </div>
        <div class="row">    
                                 
            <div class="col-md-12">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Direccion:</b></span>
                </div>
                <textarea id="address" class="form-control" name="address" cols="77" rows="3"></textarea>
            </div>                
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="input-group-prepend">
                <span class="input-group-text"><b>Usuario:</b></span>
                </div>
                <input type="email" class="form-control" id="email" name="email" >
            </div>
            <div class="col-md-3">
                <div class="input-group-prepend">
                    <span class="input-group-text"><b>Contraseña:</b></span>
                </div>
                <input type="password" class="form-control" id="password" name="password">
            </div> 
        </div>
        
        <div class="modal-footer justify-content-between">
            <button type="button text-left" class="btn btn-default" data-dismiss="modal" data-toggle="tooltip" title="Volver">Cancelar
            </button>
            <button type="submit" class="btn btn-primary btn-sm" title="Registrar..">
                Registrar
            </button>
        </div>
        
    </div>


    {!! Form::close()!!} 
    

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

  
</body>
</html>
