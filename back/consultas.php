<?php 
    class consultas {
        public function ConsultarAreas($db)
        {
            $stmt = $db->prepare("SELECT * FROM areas");
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

        public function ConsultarRoles($db)
        {
            $stmt = $db->prepare("SELECT * FROM roles");
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

        public function ConsultarEmpleados($db)
        {
            $stmt = $db->prepare("SELECT e.id, e.nombre, e.email, IF( e.sexo = 'M', 'Masculino', 'Femenino') as sexo, a.nombre as area, IF( e.boletin = 1 , 'Si', 'No') as boletin FROM `empleado` e INNER JOIN areas a ON a.id = e.area_id");
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        }

        public function DatosEmpleado($db, $id)
        {
            $stmt = $db->prepare("SELECT * FROM `empleado` where id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
           
            $userData = array();

            while ($row = $result->fetch_assoc()){
                $userData["DatosUsuario"][] = $row;
            }

            $stmt = $db->prepare("SELECT rol_id FROM `empleado_rol` where empleado_id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result2 = $stmt->get_result();

            while ($row = $result2->fetch_assoc()){
                $userData["Roles"][] = $row;
            }
            return json_encode($userData);
        }
    }
?>