<?php  
    include("../Models/empleado.php");
    include("services.php");
    include("consultas.php");
    include("conexion.php");

    $tipo_peticion = $_POST['tipo_peticion'];

    switch ($tipo_peticion) {
        case "Crear":
            $empleado = new Empleado($_POST["nombre"], $_POST["email"], $_POST["sexo"], $_POST["area"], $_POST["boletin"], $_POST["desc"],  $_POST["roles"]);

            $a = new Services();
            $respuesta = $a -> GuardarEmpleado($empleado, $db);
        
            if($respuesta == 1){
                echo json_encode(array('success' => $respuesta, 'mensaje' => "Datos guardados correctamente!"));
            }else{
                echo json_encode(array('success' => $respuesta, 'mensaje' => "Ocurrio un error, intente nuevamente!"));
            }
            break;
        case "Eliminar":
            $a = new Services();
            $id_empleado = $_POST["id_empleado"];

            $respuesta = $a -> EliminarEmpleado($db, $id_empleado);
        
            if($respuesta == 1){
                echo json_encode(array('success' => $respuesta, 'mensaje' => "Datos eliminados correctamente!"));
            }else{
                echo json_encode(array('success' => $respuesta, 'mensaje' => "Ocurrio un error, intente nuevamente!"));
            }
            break;
        case "Consultar":
            $a = new consultas();
            $id_empleado = $_POST["id_empleado"];
            $respuesta = $a -> DatosEmpleado($db, $id_empleado);
            echo $respuesta;
            break;
        case "Editar":
            $empleado = new Empleado($_POST["nombre"], $_POST["email"], $_POST["sexo"], $_POST["area"], $_POST["boletin"], $_POST["desc"],  $_POST["roles"]);

            $a = new Services();
            $respuesta = $a -> EditarEmpleado($empleado, $db, $_POST["id_empleado"]);
        
            if($respuesta == 1){
                echo json_encode(array('success' => $respuesta, 'mensaje' => "Datos modificados correctamente!"));
            }else{
                echo json_encode(array('success' => $respuesta, 'mensaje' => "Ocurrio un error, intente nuevamente!"));
            }
            break;
    }

?>
