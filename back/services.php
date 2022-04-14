<?php  
    class Services {

        public function GuardarEmpleado(Empleado $empleado, $db)
        {
            $stmt = $db->prepare("INSERT INTO empleado (`nombre`, `email`, `sexo`, `area_id`, `boletin`, `descripcion`) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('sssiis', $empleado->nombre, $empleado->email, $empleado->sexo, $empleado->area, $empleado->boletin, $empleado->descripcion);

            if ($stmt->execute()) { 
                $res =  $this -> GuardarEmpleadoRol($db, $db->insert_id, $empleado->roles);
                return $res;
            } else {
                return 0;
            }
        }

        public function EditarEmpleado($empleado, $db, $id_empleado)
        {
            $stmt = $db->prepare("UPDATE `empleado` SET `nombre`= ? ,`email`= ? ,`sexo`= ? ,`area_id`= ? ,`boletin`= ? ,`descripcion`= ?  WHERE `id` = ?");
            $stmt->bind_param('sssiisi', $empleado->nombre, $empleado->email, $empleado->sexo, $empleado->area, $empleado->boletin, $empleado->descripcion, $id_empleado);

            if ($stmt->execute()) { 

                $stmt = $db->prepare("DELETE FROM empleado_rol WHERE empleado_id = ?");
                $stmt->bind_param("i", $id_empleado);
                if($stmt->execute()){
                    $res =  $this -> GuardarEmpleadoRol($db, $id_empleado, $empleado->roles);
                    return $res;
                }else{
                    return 0;
                }
            } else {
                return 0;
            }
        }

        public function GuardarEmpleadoRol($db, $idEmpleado, $roles)
        {
            $roles_ = explode(",", $roles);

            foreach ($roles_ as $key) {
                $stmt = $db->prepare("INSERT INTO empleado_rol (`empleado_id`, `rol_id`) VALUES (?, ?)");
                $stmt->bind_param('ii',$idEmpleado, $key);
                $stmt->execute();
            }
            return 1;
        }

        public function EliminarEmpleado($db, $id){
            $stmt = $db->prepare("DELETE FROM empleado WHERE id = ?");
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) { 
                return 1;
            } else {
                return 0;
            }
        }
    }

?>

