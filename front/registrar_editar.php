<?php 
    $tipo = $_GET['tipo'];
    include("../back/conexion.php");
    include("../back/consultas.php");
    $controllerConsultas = new consultas();
    $areas =  $controllerConsultas -> ConsultarAreas($db);
    $roles =  $controllerConsultas -> ConsultarRoles($db);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registro de Empleado</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/registro.css">
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <form id="form_ge" action="../back/controller.php" method="post">
        <div class="container">
            <h1><?php echo $tipo; ?> empleado</h1>
            <div class="alert alert-primary" role="alert">
                Loa campos con asteriscos (*) son obligatorios.
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-3"><h4>Nombre completo *</h4></div>
                <div class="col-9"><input type="text" class="form-control" id="nombre_c" name="nombre_c" placeholder="Nombre Completo del empleado" required></div>
            </div>
            <br>
            <div class="row">
                <div class="col-3"><h4>Correo electronico *</h4></div>
                <div class="col-9"><input type="email" class="form-control" id="email" name="email" placeholder="Correo electronico del empleado" required></div>
            </div>
            <br>
            <div class="row">
                <div class="col-3"><h4>Sexo *</h4></div>
                <div class="col-9">
                    <input required type="radio" id="sexo1" name="sexo" value="M"> <label for="sexo1"> Masculino</label>
                    <br>
                    <input required type="radio" id="sexo1" name="sexo" value="F"> <label for="sexo1"> Femenino</label>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-3"><h4>Área *</h4></div>
                <div class="col-9">
                    <select name="area" id="area" class="form-control" required>
                        <option value="">Seleccione....</option>
                        <?php while ($item = $areas->fetch_assoc()) { ?>
                            <option value="<?php echo $item['id'] ?>"><?php echo $item['nombre'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-3"><h4>Descripción *</h4></div>
                <div class="col-9"><textarea required id="desc" name="desc" id="" class="form-control" cols="30" rows="3" placeholder="Descripción de la experiencia del empleado"></textarea></div>
            </div>
            <br>
            <div class="row">
                <div class="col-3">

                </div>
                <div class="col-9">
                    <label><input  name="boletin" type="checkbox" id="boletin" value="1"> Deseo recibir boletín informaivo</label><br>
                </div>
            </div>
            <br>
            <div class="row">
            <div class="col-3"><h4>Roles *</h4></div>
                <div class="col-9" id="list">
                    <?php while ($item = $roles->fetch_assoc()) { ?>
                        <label><input name="roles[]" type="checkbox" id="cbox1" value="<?php echo $item['id'] ?>"> <?php echo $item['nombre'] ?></label><br>
                    <?php } ?>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-3"></div>
                <div class="col-3">
                    <button type="submit" class="btn btn-info">Guardar</button>
                </div>
                <div class="col-3">
                    <a href="../index.php" class="btn btn-danger">Volver</a>
                </div>
                <div class="col-3"></div>
            </div>
            <input type="hidden" id="tipo_peticion" name="tipo_peticion" value="<?php echo $tipo ?>">
        </div>
    </form>
    <script src="js/empleado.js"></script>
    <script src="js/cargar_data_editar.js"></script>
    <script type="text/javascript">
        var tipo = ("<?php echo $tipo; ?>");
        if(tipo == "Editar"){
            var id_empleado = "<?php echo $_GET['id']; ?>";
            cargar_data(id_empleado);
        }
    </script>
</body>
</html>