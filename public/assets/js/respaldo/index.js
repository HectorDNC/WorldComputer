$(document).ready(function () {

    const respaldar = ()=>{
        Toast.fire({
            title: 'Espere!',
            html: 'Se está creando el respaldo',// add html attribute if you want or remove
            allowOutsideClick: false,
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
        $.ajax({
            type: "POST",
            url: "respaldo/respaldar",
            data: {'respaldo': "respaldar"},
            success: function (response) {
                // console.log(response);
                let json = JSON.parse(response); 
                if (json.success) {
                    controlarMax();
                    Swal.fire(
                        "Excelente!",
                         "El Respaldo se creó correctamente",
                         "success"
                     );
                     setTimeout(function(){
                        window.location.reload();
                    },700);
                }
                else{
                    Swal.fire(
                        "Error!",
                         "Ocurrió un error durante la creación del respaldo",
                         "error"
                     );
                }
              
            },
            error: (response) => {
                console.log("Error: "+response);
                Swal.fire(
                    "Error!",
                     "Ocurrió un error durante la creación del respaldo",
                     "error"
                 );
            }
        });
    }
    const restaurar = ()=>{
        Toast.fire({
            title: 'Espere!',
            html: 'Se está realizando la restauración',// add html attribute if you want or remove
            allowOutsideClick: false,
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
        $.ajax({
            type: "POST",
            url: "respaldo/restaurar",
            data: {'respaldo': $('[name="respaldo"]').val()},
            success: function (response) {
                // console.log(response);
                // let json = JSON.parse(response); 
                // console.log(response);
                // response = response.toString();
                var result = response.search('{"success":true}');
                // console.log("Result es "+result);
                if (result!=-1) {
                    Swal.fire(
                        "Excelente!",
                         "La Restauración se realizó correctamente",
                         "success"
                     );
                    //  setTimeout(function(){
                    //     window.location.reload();
                    // },700);
                }
                else{
                    Swal.fire(
                        "Error!",
                         "Ocurrió un error durante la restauración",
                         "error"
                     );
                }
              
            },
            error: (response) => {
                console.log("Error: "+response);
                Swal.fire(
                    "Error!",
                     "Ocurrió un error durante la restauración",
                     "error"
                 );
            }
        });
    }

    const controlarMax = ()=>{
        $.ajax({
            type: "POST",
            url: "respaldo/controlarMax",
            data: {'respaldo': "controlarMax"},
            success: function (response) {
                console.log(response);
                let json = JSON.parse(response);
                // if (json.deleted) {
                //     window.location.reload();
                // }
            },
            error: (response) => {
                console.log("Error: "+response);
            }
        });
    }
    // controlarMax();

    $('body').on('click', '#respaldar', function (e) { 
        e.preventDefault();
        
        Swal.fire({
            title: 'Confirme la acción',
            input: 'password',
            inputPlaceholder: 'Contraseña',
            inputAttributes: {
                autocapitalize: 'off'
            },
            showCancelButton: true,
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            preConfirm: (login) => {
                Toast.fire({
                    title: 'Espere!',
                    html: 'Los datos están siendo procesados',// add html attribute if you want or remove
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading()
                    },
                });
                $.ajax({
                    type: "POST",
                    url: "respaldo/verificarPassword",
                    data: {'password': login},
                    success: function (response) {
                        console.log(response);
                        if (response.success) {
                            respaldar();
                        }
                        else{
                            Swal.fire(
                                "Incorrecto!",
                                 "Contraseña incorrecta",
                                 "warning"
                             );
                             $('#respaldar').click();
                             Swal.showValidationMessage(
                                `Contraseña Incorrecta`
                              )
                        }
                      
                    },
                    error: (response) => {
                        console.log("Error: "+response);
                        Swal.fire(
                            "Error!",
                             "Ocurrió un error durante la verificación",
                             "error"
                         );
                    }
                });
                
            },
            allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                // console.log(result.isConfirmed);
        });
        $(".swal2-content").append(`<span class="text-center m-2 spanRespaldar">Nota: Se creará un archivo de respaldo, solo puede haber un máximo de 10 archivos. 
            Cuando se exceda el límite se eliminarán los más antiguos</span>`);
    });
    // Elegir Restaurar
    $('body').on('click', '#restaurar', function (e) { 
       $(".spanRespaldar").remove();
       $('#modalRestaurar').modal('show');
       $('#formularioRestaurar').submit(function (e) {  
            e.preventDefault();
            $('#modalRestaurar').modal('hide');
            Swal.fire({
                title: 'Confirme la acción',
                input: 'password',
                inputPlaceholder: 'Contraseña',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonText: 'Confirmar',
                showLoaderOnConfirm: true,
                preConfirm: (login) => {
                    Toast.fire({
                        title: 'Espere!',
                        html: 'Los datos están siendo procesados',// add html attribute if you want or remove
                        allowOutsideClick: false,
                        onBeforeOpen: () => {
                            Swal.showLoading()
                        },
                    });
                    $.ajax({
                        type: "POST",
                        url: "respaldo/verificarPassword",
                        data: {'password': login},
                        success: function (response) {
                            console.log(response);
                            if (response.success) {
                                restaurar();
                            }
                            else{
                                Swal.fire(
                                    "Incorrecto!",
                                     "Contraseña incorrecta",
                                     "warning"
                                 );
                                 $('#formularioRestaurar').submit();
                                 Swal.showValidationMessage(
                                    `Contraseña Incorrecta`
                                  )
                            }
                          
                        },
                        error: (response) => {
                            console.log("Error: "+response);
                            Swal.fire(
                                "Error!",
                                 "Ocurrió un error durante la verificación",
                                 "error"
                             );
                        }
                    });
                    
                },
                allowOutsideClick: () => !Swal.isLoading()
                }).then((result) => {
                    console.log(result.isConfirmed);
            });
       });
    });

    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-start',
        showConfirmButton: false,
        
      });

});
