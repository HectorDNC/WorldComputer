$(document).ready(function () {

/**
 * DataTable
 */



/**
 * FUNCIONES
 */

const actualizarConfiguracion = (datos)=>{
    $.ajax({
        type: "POST",
        url: "configuracion/actualizar",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            let json = JSON.parse(response);
            
            if( json.tipo == 'success'){

                Swal.fire(
                    json.titulo,
                    json.mensaje,
                    json.tipo
                );
                setTimeout(function(){
                    window.location.reload();
                },700);
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
;}
/**
 * Eventos
 */


$("#formConfiguracion").submit(function (e) { 
    e.preventDefault();
    // var nombre = $("#nombre_sistema");
    var dolar = $("#dolar");
    var iva = $("#iva");
    // if (nombre.val()=="" || dolar.val()=="" || iva.val()=="") {
    if (dolar.val()=="" || iva.val()=="") {
        Swal.fire(
            'Error',
            'Ninguno de los campos puede estar vacío',
            'warning'
        );
        return 0;
    }

    // if(nombre.val().length >30){
    //     Swal.fire(
    //         'Error',
    //         'El Nombre de Sistema indicado es muy largo',
    //         'warning'
    //     );
    //     return 0;
    // }
    if(isNaN(dolar.val()) || dolar.val()<0){
        Swal.fire(
            'Error',
            'El Precio del Dolar debe ser un número positivo',
            'warning'
        );
        return 0;
    }
    if(isNaN(iva.val()) || iva.val()<0 || iva.val()>100){
        Swal.fire(
            'Error',
            'El Porcentaje de IVA debe ser un número entre 0 y 100',
            'warning'
        );
        return 0;
    }
    let datos = new FormData(document.querySelector('#formConfiguracion'));
    actualizarConfiguracion(datos);
});

});
