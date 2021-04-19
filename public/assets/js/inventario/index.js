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
            url: 'inventario/listar'
        },
        columns: [
            { data: 'codigo' },
            { data: "nombre" },
            { data: 'categoria' },
            { data: 'precio_venta' },
            { data: 'stock' },
            { data: 'stock_min' },
            { data: 'stock_max' },
            // { data: 'estado' },
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

    const mostrarProducto = (href, formulario, modal) => {
    
        $.ajax({
            type: "POST",
            url: href,
            success: function (response) {
                let json = JSON.parse(response);
    
                if(modal == '#modalActualizarProducto'){

                    $(formulario).find('input#id').val(json.data.id);
                    $(formulario).find('input#codigo').val(json.data.codigo);
                    $(formulario).find('input#nombre').val(json.data.nombre);
                    $(formulario).find('input#precio').val(json.data.precio);
                    $(formulario).find('select#categoria').val(json.data.categoria_id);
                    $(formulario).find('select#unidad').val(json.data.unidad_id);
                    $(formulario).find('input#porcentaje').val(json.data.porcentaje);
                    $(formulario).find('textarea#descripcion').val(json.data.descripcion);
                    $(formulario).find('input#stock_min').val(json.data.stock_min);
                    $(formulario).find('input#stock_max').val(json.data.stock_max);
                    $(formulario).find('input#stock').val(json.data.stock);
                }else{
                    
                    $(formulario).find('input#id').val(json.data.id);
                    $(formulario).find('input#codigo').val(json.data.codigo);
                    $(formulario).find('input#nombre').val(json.data.nombre);
                    $(formulario).find('input#categoria').val(json.data.categoria);
                    $(formulario).find('input#unidad').val(json.data.unidad);
                    $(formulario).find('input#porcentaje').val(json.data.porcentaje);
                    $(formulario).find('textarea#descripcion').val(json.data.descripcion);
                    $(formulario).find('input#stock_min').val(json.data.stock_min);
                    $(formulario).find('input#stock_max').val(json.data.stock_max);
                    $(formulario).find('input#stock').val(json.data.stock);
                }
    
                $(modal).modal('show');
                
    
            },
            error: (response) => {
                console.log(response);
            }
        });
    }

    const eliminarProducto = (id) => {
        $.ajax({
            type: "DELETE",
            url: "producto/eliminar/" + id,
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

    const habilitarProducto = (id) => {
        $.ajax({
            type: "HABILITAR",
            url: "producto/habilitar/" + id,
            success: function (response) {
                const json = JSON.parse(response);
                if(json.tipo == 'success'){
                    Swal.fire(
                        'Activado!',
                        'El producto ha sido habilitado!',
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

    $('body').on('click', '.mostrar', function (e) { 
        e.preventDefault();
        console.log($(this).attr('href'));
        mostrarProducto($(this).attr('href'),'form#formularioMostrarProducto','#modalMostrarProducto');
    });

    // $('body').on('click', '.estatus', function (e) {
    //     e.preventDefault();
    
    //     Swal.fire({
    //         title: 'Esta Seguro?',
    //         text: "El producto será inhabilitado del sistema!",
    //         type: 'warning',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         cancelButtonText: 'Cancelar',
    //         confirmButtonText: 'Si, eliminar!'
    //         }).then((result) => {
    //         if (result.value) {
    
    //             eliminarProducto($(this).attr('href'));
                
    //         }
    //         })
    //     console.log($(this).attr('href'));
    // });

    $('body').on('click', '.estatusAnulado', function (e) {
        e.preventDefault();
    
        Swal.fire({
            title: 'Esta Seguro?',
            text: "El producto será habilitado en el sistema!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
            if (result.value) {
    
                habilitarProducto($(this).attr('href'));
                
            }
            })
        console.log($(this).attr('href'));
    });
});