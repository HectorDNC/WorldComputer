$(document).ready(function () {
    const actualizarUsuario = (datos) => {
        $.ajax({
            type: "POST",
            url: "Usuario/actualizar",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log("R:"+response);
                let json = JSON.parse(response);
                
                if( json.tipo == 'success'){
    
                    Swal.fire(
                        json.titulo,
                        json.mensaje,
                        json.tipo
                    );
                    setTimeout(function(){
                        window.location.reload();
                    },1000);
                    $('#modalActualizarUsuario').modal('hide');
                }else{
                    Swal.fire(
                        json.titulo,
                        json.mensaje,
                        json.tipo
                    );
                }
            },
            error(response){
                console.log(response);
            }
        });
    }
    
    $('#formularioActualizarUsuario').submit(function (e) {
        e.preventDefault();
    
        const datos = new FormData(document.querySelector('#formularioActualizarUsuario'));
        console.log(datos.get('perfil'));
        if(datos.get('contrasena')==datos.get('confirmarContrasena')){
            console.log(datos.get('contrasena'));
            actualizarUsuario(datos);
        }
        else{
            Swal.fire(
                "Error",
                "Las Contraseñas no coinciden",
                "warning"
            );
        }
        
    });
});