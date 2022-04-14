function cargar_data(id){
   
    let paqueteDeDatos = new FormData(); 
    paqueteDeDatos.append('id_empleado', id);
    paqueteDeDatos.append('tipo_peticion', "Consultar");

    $.ajax({
        type: "POST", 
        url: "../back/controller.php",
        contentType: false,
        processData: false,
        cache: false, 
        data: paqueteDeDatos,
        success: function (data) { 
            var jsonData = JSON.parse(data);
            var dataUsuario = jsonData.DatosUsuario[0];
            var rolesUsuario = jsonData.Roles;
            
            setearValores(dataUsuario, rolesUsuario); 
        } 
    });
}

function setearValores(json, roles){
    $("#nombre_c").val(json.nombre)
    $("#email").val(json.email)
    $("input[name=sexo][value='"+json.sexo+"']").prop("checked",true);	
    $("#area").val(json.area_id)
    $("#desc").val(json.descripcion)
    $("#id_empleado").val(json.id)

    if(json.boletin == 1){
        $( "#boletin" ).prop( "checked", true );
    }

    var roles_ = [];

    roles.forEach(element => {
        roles_.push(element.rol_id);
    });

    $("#list").find('[value=' + roles_.join('], [value=') + ']').prop("checked", true);
}