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
    }
?>