<?php  
    include("../Models/empleado.php");
    include("services.php");
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
        case "Editar":
            echo "i es igual a 2";
            break;
    }

?>
