$(document).ready(function () {

    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-start',
        showConfirmButton: true,
    });

    const ToastAlert = Swal.mixin({
        toast: true,
        position: 'bottom-start',
        timer: 2000,
        showConfirmButton: false,
    });

    $('#formularioRecuperarContrasena').on('submit', function (e) {
        e.preventDefault();

        let newPass = $("[name='password']").val()
        let confirmPass = $("[name='password_confirm']").val()

        if (newPass == confirmPass) {
            let datos = new FormData(document.querySelector('#formularioRecuperarContrasena'));
    
            recuperarContrasena(datos);
        } else {
            ToastAlert.fire("¡Error!", "Contraseñas no coinciden", "error");
        }

    })

    const recuperarContrasena = (datos) => {
        cambioUrl = baseURL + 'Login/cambioContrasena';
        $.ajax({
            type: "POST",
            url: cambioUrl,
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                let json = JSON.parse(response);
  
                console.log(json);
                
                if(!json.error){
                    ToastAlert.fire({
                        icon: 'success',
                        title: json.titulo,
                        html: json.mensaje,
                        allowOutsideClick: false,
                    })
                    .then(function () {
                        console.log('redireccion..')
                        window.location.replace(baseURL);
                    });
                }else{
                    Swal.fire(
                        json.titulo,
                        json.mensaje,
                        json.tipo
                    );
                }
  
            },
            error: (response) => {
                console.log(response);
                
            }
        });
    }

});