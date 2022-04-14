<?php  
    include("../Models/empleado.php");
    include("conexion.php");

    class Services {

        public function GuardarEmpleado(Empleado $empleado, $db)
        {
            $stmt = $db->prepare("INSERT INTO empleado (`nombre`, `email`, `sexo`, `area_id`, `boletin`, `descripcion`) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('sssiis', $empleado->nombre, $empleado->email, $empleado->sexo, $empleado->area, $empleado->boletin, $empleado->descripcion);

            if ($stmt->execute()) { 
               return 1;
            } else {
                return 0;
            }
        }

        public function EditarEmpleado($roles)
        {
           
        }

        public function GuardarEmpleadoRol($db, $idEmpleado, $idRol)
        {
            
        }
    }


   
    $empleado = new Empleado($_POST["nombre"], $_POST["email"], $_POST["sexo"], $_POST["area"], $_POST["boletin"], $_POST["desc"],  $_POST["roles"]);

    $a = new Services();
    $respuesta = $a -> GuardarEmpleado($empleado, $db);

    if($respuesta == 1){
        echo json_encode(array('success' => $respuesta, 'mensaje' => "Datos guardados correctamente!"));
    }else{
        echo json_encode(array('success' => $respuesta, 'mensaje' => "Ocurrio un error, intente nuevamente!"));
    }


?>

