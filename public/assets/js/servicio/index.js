$(document).ready(function () {

    let table = $('#datatable').DataTable({
        serverSide: false,
        ordering: false,
        searching: true,
        ajax: {
            method: 'POST',
            url: 'servicio/listar'
        },
        columns: [
            { data: 'id' },
            { data: "nombre" },
            { data: 'descripcion' },
            { data: 'precio' },
            { data: 'precioBss' },
            { data: 'button' }
        ],

        language: { 
                    "decimal":        "",
                    "emptyTable":     "No hay Registros Disponibles",
                    "info":           "Mostrando _START_ de _END_ para _TOTAL_ Entradas",
                    "infoEmpty":      "Mostrando 0 de 0 para 0 Entradas",
                    "infoFiltered":   "(Filtrado de _MAX_ Entradas en Total)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing":     "Procesando...",
                    "search":         "Buscar:",
                    "zeroRecords":    "No se encontraron coincidencias",
                    "paginate": {
                        "first":      "Primero",
                        "last":       "Ultimo",
                        "next":       "Siguiente",
                        "previous":   "Atras"
                    },
                    "aria": {
                        "sortAscending":  ": activate to sort column ascending",
                        "sortDescending": ": activate to sort column descending"
                    }
        }
    });
    const registrarServicio = (datos) => {

        $.ajax({
            type: "POST",
            url: "Servicio/guardar",
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
        
                    table.ajax.reload();
        
                    $('#modalRegistroServicio').modal('hide');
                    $('#formularioRegistrarServicio').trigger('reset');
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
    //script mostrar servicio
    const mostrarServicio = (href, formulario, modal, action) => {
        $.ajax({
            type: "POST",
            url: href,
            success: function (response) {
                let json = JSON.parse(response);
            
    
                $(formulario).find('input#id').val(json.data.id);
                $(formulario).find('input#nombre').val(json.data.nombre);
                $(formulario).find('input#precio').val(json.data.precio);
                $(formulario).find('#descripcion').val(json.data.descripcion);
    
                $(modal).modal('show');
    
            },
            error: function(response) {
             console.log(response.getAllResponseHeaders())
         }
        });
    }

    const actualizarServicio = (datos) => {
        $.ajax({
            type: "POST",
            url: "Servicio/actualizar",
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
        
                    table.ajax.reload();
        
                    $('#modalActualizarServicio').modal('hide');
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
    const eliminarServicio = (id) => {
        $.ajax({
            type: "POST",
            url: "Servicio/eliminar/" + id,
            success: function (response) {
                const json = JSON.parse(response);
                if(json.tipo == 'success'){
                    Swal.fire(
                        'Eliminado!',
                        'El registro ha sido eliminado!',
                        'success'
                      )
    
                    table.ajax.reload();
                }
            },
            error: function (response) {
                console.log(response);
            }
        });
    }
    const habilitar = (id) => {
        $.ajax({
            type: "POST",
            url: "servicio/habilitar/" + id,
            success: function (response) {
                const json = JSON.parse(response);
                if(json.tipo == 'success'){
                    Swal.fire(
                        'Activado!',
                        'El servicio ha sido habilitado!',
                        'success'
                        )
    
                    table.ajax.reload();
                }
            },
            error: function (response) {
                console.log(response);
            }
        });
    }
/* Eventos */
    //Registrar Servicio
    $('#formularioRegistrarServicio').submit(function (e) { 
        e.preventDefault();

        let datos = new FormData(document.querySelector('#formularioRegistrarServicio'));
    //  console.log(datos.get('documento'));

        registrarServicio(datos);   
    });
    // Mostrar Servicio
    $('body').on('click', '.mostrar', function (e) { 
        e.preventDefault();
    
        mostrarServicio($(this).attr('href'),'form#formularioMostrarServicio','#modalMostrarServicio','mostrar');
    });

    // Actualizar Servicio
    $('body').on('click', '.editar', function (e) { 
        e.preventDefault();
    
        mostrarServicio($(this).attr('href'),'form#formularioActualizarServicio','#modalActualizarServicio','actualizar');
    });
    $('#formularioActualizarServicio').submit(function (e) {
        e.preventDefault();
    
        const datos = new FormData(document.querySelector('#formularioActualizarServicio'));
    
        // console.log(datos.get('id'));
        actualizarServicio(datos);
    });
    // Eliminar Servicio
    $('body').on('click', '.eliminar', function (e) {
        e.preventDefault();
    
        Swal.fire({
            title: 'Esta Seguro?',
            text: "El servicio sera eliminado del sistema!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
            if (result.value) {
    
                eliminarServicio($(this).attr('href'));
              
            }
          })
    });
    //Activar el registro
    $('body').on('click', '.estatusAnulado', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Esta Seguro?',
            text: "El servicio será habilitado en el sistema!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
            if (result.value) {

                habilitar($(this).attr('href'));
                
            }
            })
        console.log($(this).attr('href'));
    });
})