$(document).ready(function () {
    
    /**
     * DataTable
     */
    
    let table = $('#datatable').DataTable({
        serverSide: false,
        ordering: false,
        searching: true,
        ajax: {
            method: 'POST',
            url: 'rol/listar'
        },
        columns: [
            { data: 'id' },
            { data: 'nombre' },
            { data: 'descripcion' },
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
    
    
    
    /**
     * FUNCIONES
     */
    const mostrarRol = (href, formulario, modal) => {
    
        $.ajax({
            type: "POST",
            url: href,
            success: function (response) {
                
                let json = JSON.parse(response);
                var permisos = $('#formularioActualizarRol').find('input[name="permisos[]"]');
                // $.each(permisos, function (j, element) { 
                //     // $(element).click();
                //     $(element).removeData('s');
                // }); 
                $(formulario).trigger('reset');
                $(formulario).find('input#nombre').val(json.data[0].nombre);
                $(formulario).find('textarea#descripcion').val(json.data[0].descripcion);
                if(modal == '#modalActualizarRol'){
                    $(formulario).find('input#id').val(json.data[0].id); 
                    $.each(json.data, function (j, element) { 
                        var permiso = $('#formularioActualizarRol').find('input[value="'+element.permiso_id+'"]');
                        permiso.click();
                        permiso.data('s',true);
                        console.log(permiso);
                    });
                }else{
                    $('#listaPermisos').html('');
                    $.each(json.data, function (j, element) { 
                        var li = $('<li>');
                        li.text(element.permiso);
                        $('#listaPermisos').append(li);
                    });
    
                }     
                $(modal).modal('show');                
    
            },
            error: (response) => {
                console.log(response);
            }
        });
    }
    
    const registrarRol = (datos) => {
    
        $.ajax({
            type: "POST",
            url: "rol/guardar",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                let json = JSON.parse(response);
                
                if( json.tipo == 'success'){
    
                    Swal.fire(
                        json.titulo,
                        json.mensaje,
                        json.tipo
                    );
        
                    table.ajax.reload();
        
                    $('#modalRegistroRol').modal('hide');
                    $('#formularioRegistrarRol').trigger('reset');
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
    
    const actualizarRol = (datos) => {
        $.ajax({
            type: "POST",
            url: "rol/actualizar",
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
        
                    $('#modalActualizarRol').modal('hide');
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
    
    const eliminarRol = (id) => {
        $.ajax({
            type: "POST",
            url: "rol/eliminar/" + id,
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
            url: "rol/habilitar/" + id,
            success: function (response) {
                const json = JSON.parse(response);
                if(json.tipo == 'success'){
                    Swal.fire(
                        'Activado!',
                        'El rol ha sido habilitado!',
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
    /**
     * Eventos
     */
    
    $('#formularioRegistrarRol').submit(function (e) { 
        e.preventDefault();
        var ba = false;
        var permisos = $(this).find('input[name="permisos[]"]');                   
        $.each(permisos, function (j, element) {  
                      
            if(element.checked==true){
                ba = true;
            }
        });
        if (!ba) {
            Swal.fire(
                'Indique los Permisos',
                'Debe seleccionar al menos 1 permiso',
                'warning'
            );
            return false;
        }
    
        let datos = new FormData(document.querySelector('#formularioRegistrarRol'));

    //  console.log(datos.get('documento'));

        registrarRol(datos);   
    });
    
    // Mostrar Rol
    $('body').on('click', '.mostrar', function (e) { 
        e.preventDefault();
    
        mostrarRol($(this).attr('href'),'form#formularioMostrarRol','#modalMostrarRol');
    });
    
    // Editar Rol
    
    $('body').on('click', '.editar', function (e) {
        e.preventDefault();
        console.log($(this).attr('href'));
    
        mostrarRol($(this).attr('href'), 'form#formularioActualizarRol', '#modalActualizarRol');
    });
    
    $('#formularioActualizarRol').submit(function (e) {
        e.preventDefault();
        var ba = false;
        var permisos = $(this).find('input[name="permisos[]"]');                   
        $.each(permisos, function (j, element) {  
                      
            if(element.checked==true){
                ba = true;
            }
        });
        if (!ba) {
            Swal.fire(
                'Indique los Permisos',
                'Debe seleccionar al menos 1 permiso',
                'warning'
            );
            return false;
        }
        const datos = new FormData(document.querySelector('#formularioActualizarRol'));
    
        console.log(datos.get('id'));
    
        actualizarRol(datos);
    });
    
    
    // Eliminar Rol
    $('body').on('click', '.eliminar', function (e) {
        e.preventDefault();
    
        Swal.fire({
            title: 'Esta Seguro?',
            text: "El cliente sera eliminado del sistema!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, eliminar!'
          }).then((result) => {
            if (result.value) {
    
                eliminarRol($(this).attr('href'));
              
            }
          })
        console.log($(this).attr('href'));
    });
    //Función para marcar varias casillas de permisos
    $('#formularioRegistrarRol').find('[name="permisos[]"]').on('click',function () {  
        var hermano = $(this).siblings();
        var padre = $(this).parent();
        var abuelo = $(padre).parent();
        var otros = $(abuelo).siblings();
        var label = $(hermano).children();
        var actual = $(this);
        if ($(this).data('s')) {
            $(this).removeData('s');
        }
        else{
            $(this).data('s',true);
        }
        if (label.text() != "") {
            var per = $(otros).find('[name="permisos[]"]');
            $(per).each(function (index, element) {
                if ($(actual).data('s') != $(element).data('s')) {
                    $(element).click();  
                }                
            });           
        }        
    });
    //Activar el registro
    $('body').on('click', '.estatusAnulado', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Esta Seguro?',
            text: "El cliente será habilitado en el sistema!",
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
    
});
    