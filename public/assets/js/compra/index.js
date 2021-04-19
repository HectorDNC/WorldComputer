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
            url: 'compra/listar'
        },
        columns: [
            { data: 'codigo' },
            { data: "fecha" },
            { data: 'proveedor' },
            { data: 'button' },
            { data: 'estado' }
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

    const buscarCompra = (url) => {
        $.ajax({
            type: "POST",
            url: url,        
            success: function (response) {
                console.log(response);
                json = JSON.parse(response);
                console.log(JSON.parse(response));

                $('#numero_compra').val(json.compra.codigo);
                $('#documento_referencia').val(json.compra.referencia);
                $('#nombre_proveedor').val(json.compra.proveedor);
                $('#rif_proveedor').val(json.compra.rif_proveedor);
                $('#direccion_proveedor').val(json.compra.direccion);
                $('#fecha').val(`${json.compra.fecha} ${json.compra.hora}`);


                $('#cuerpo').empty();
                var dolar = parseFloat(json.compra.dolar);
                var total = 0;

                json.productos.forEach( element => {
                    
                    total += (element.costo * element.cantidad);
                    let row = `
                        <tr>
                            <td>${element.cantidad}</td>
                            <td>${element.codigo}</td>
                            <td>${element.nombre}</td>
                            <td>${element.costo}</td>
                            <td>${element.costo * element.cantidad}</td>
                            <td>${element.costo * element.cantidad * dolar}</td>
                        </tr>
                    `;

                    
                    $('#cuerpo').append(row);
                    
                });
                var totalBss = total * dolar;
                $('#total').val(`${total} $ - ${totalBss} BSS`);
                
                $('#modalDetalleCompra').modal('show');

            },
            error: function (response) {
                console.log(response);
            }
        });
    }

    const cambiarEstatus = (id) => {
        $.ajax({
            type: "POST",
            url: "compra/cambiarEstatus/" + id,
            success: function (response) {

                console.log(response);
                json = JSON.parse(response);

                Swal.fire(
                    json.titulo,
                    json.mensaje,
                    json.tipo
                );

                table.ajax.reload();
            },
            error: function (response) {
                console.log(JSON.parse(response));
            }
        });
    }


    /**
     * EVENTOS
     */
    
    $('body').on('click', '.mostrar', function (e) {
        e.preventDefault();

        $url = $(this).attr('href');

        buscarCompra($url);
    });

    $('body').on('click', '.estatus', function (e) {
        e.preventDefault();

        $url = $(this).attr('href');

        Swal.fire({
            title: 'Esta Seguro?',
            text: "Cambiara el estatus de la compra seleccionada y el stock de productos sera afectado",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Si, Cambiar!'
            }).then((result) => {
                if (result.value) {
                    cambiarEstatus($url);
                    
                }
            })

    });
});