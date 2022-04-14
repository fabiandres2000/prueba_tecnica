<?php 
    include("back/conexion.php");
    include("back/consultas.php");
    $controllerConsultas = new consultas();
    $empleados =  $controllerConsultas -> ConsultarEmpleados($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar - Empleados</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="front/css/registro.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-10"><h2>Lista de empleados</h2></div>
            <div class="col-2">
                <a href="front/registrar_editar.php?tipo=Crear" class="btn btn-success">Crear</a>
            </div>
        </div>
        <br>
        <hr>
        <div class="row">
            <div class="col-12">
                <table id="myTable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Sexo</th>
                            <th>Area</th>
                            <th>Boletin</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
    <script src="front/js/datatable.js"></script>
</body>
</html>