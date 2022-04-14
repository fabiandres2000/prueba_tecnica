$('#form_ge').submit(function (ev) {

    if($("#tipo_peticion" ).val() == "Crear"){
        guardar_empleado();
    }else{
        alert ("editar");
    }
    ev.preventDefault();
});


function guardar_empleado(){
    if(valiar_data()){
        let data = armar_form_data();
        $.ajax({
            type: $('#form_ge').attr('method'), 
            url: $('#form_ge').attr('action'),
            contentType: false,
            processData: false,
            cache: false, 
            data: data,
            beforeSend: function(){
                let timerInterval
                Swal.fire({
                    title: 'Guardando datos',
                    html: 'Espere un momento...',
                    timer: 400000,
                    timerProgressBar: true,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                        
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                    }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer) {
                    }
                });          
            },
            success: function (data) { 
                var jsonData = JSON.parse(data);
                var icono = "";
                if (jsonData.success == 1) {
                    icono = "success";
                    setTimeout(function(){ 
                        location.reload();
                    }, 2500);
                }else{
                    icono = "error";
                }
                Swal.fire({
                    position: 'center',
                    icon: icono,
                    title: jsonData.mensaje,
                    showConfirmButton: false,
                    timer: 2500
                });
            } 
        });
    }else{
        Swal.fire({
            position: 'center',
            icon: "error",
            title: "Debe llenar todos los campos.",
            showConfirmButton: false,
            timer: 2500
        });
    }
}

function valiar_data(){ 

    let nombre =  $( "#nombre_c" ).val();
    let email = $( "#email" ).val();
    let sexo = $( "input[type=radio][name=sexo]:checked" ).val();
    let area = $( "select#area" ).val();
    let descripcion = $( "#desc" ).val();
    let boletin = $( "input[type=checkbox][name=boletin]:checked" ).val();
    let roles = $('[name="roles[]"]:checked').map(function(){
        return this.value;
    }).get();

    roles = roles.join(',');    

    if(nombre != "" && email != "" && sexo  != "" && area  != "" && descripcion  != "" && roles.length > 0 ){
        if(boletin == undefined){
            document.getElementById('boletin').value = 0;
        }
       return true; 
    }
   
    return false;
}

function armar_form_data(){ 
    let paqueteDeDatos = new FormData();
    
    paqueteDeDatos.append('nombre', $( "#nombre_c" ).val());
    paqueteDeDatos.append('email',$( "#email" ).val());
    paqueteDeDatos.append('sexo', $( "input[type=radio][name=sexo]:checked" ).val());
    paqueteDeDatos.append('area', $( "select#area" ).val());
    paqueteDeDatos.append('desc', $( "#desc" ).val());
    
    let boletin = $( "input[type=checkbox][name=boletin]:checked" ).val();
    let roles = $('[name="roles[]"]:checked').map(function(){
        return this.value;
    }).get();

    roles = roles.join(',');    

    if(boletin == undefined){ 
       boletin = 0;
    }

    paqueteDeDatos.append('boletin', boletin);
    paqueteDeDatos.append('roles', roles);
    paqueteDeDatos.append('tipo_peticion', $("#tipo_peticion" ).val());

    return paqueteDeDatos;
}

function mensaje_eliminar(id){
    Swal.fire({
        title: 'Esta seguro de eliminar a este empleado?',
        text: "No podra revertir esta accion",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si',
        cancelButtonText: 'No',
      }).then((result) => {
        if (result.isConfirmed) {
          eliminar_empleado(id);
        }
    })
}


function eliminar_empleado(id){
    let paqueteDeDatos = new FormData(); 
    paqueteDeDatos.append('id_empleado', id);
    paqueteDeDatos.append('tipo_peticion', "Eliminar");

    $.ajax({
        type: "POST", 
        url: "back/controller.php",
        contentType: false,
        processData: false,
        cache: false, 
        data: paqueteDeDatos,
        beforeSend: function(){
            let timerInterval
            Swal.fire({
                title: 'Guardando datos',
                html: 'Espere un momento...',
                timer: 400000,
                timerProgressBar: true,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                    
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
                }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {
                }
            });          
        },
        success: function (data) { 
            var jsonData = JSON.parse(data);
            var icono = "";
            if (jsonData.success == 1) {
                icono = "success";
                setTimeout(function(){ 
                    location.reload();
                }, 2500);
            }else{
                icono = "error";
            }
            Swal.fire({
                position: 'center',
                icon: icono,
                title: jsonData.mensaje,
                showConfirmButton: false,
                timer: 2500
            });
        } 
    });
}