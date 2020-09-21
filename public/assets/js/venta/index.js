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
            url: '/WorldComputer/venta/listar'
        },
        columns: [
            { data: 'codigo' },
            { data: "fecha" },
            { data: 'cliente' },
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

    const buscarVenta = (url) => {
        $.ajax({
            type: "POST",
            url: url,        
            success: function (response) {
                console.log(response);
                json = JSON.parse(response);
                console.log(JSON.parse(response));

                $('#numero_venta').val(json.venta.codigo);
                $('#nombre_cliente').val(json.venta.cliente);
                $('#rif_cliente').val(json.venta.rif_cliente);
                $('#direccion_cliente').val(json.venta.direccion);


                $('#cuerpo').empty();
                
                let subtotal = 0;
                var total = 0;

                json.productos.forEach( element => {
                    total += element.cantidad * element.precio;
                    subtotal += element.cantidad * element.precio;

                    let row = `
                        <tr>
                            <td>${element.cantidad}</td>
                            <td>${element.codigo}</td>
                            <td>${element.nombre}</td>
                            <td>${element.precio}</td>
                            <td>${parseFloat(element.precio * element.cantidad).toFixed(2)}</td>
                        </tr>
                    `;

                    $('#subtotal').val(parseFloat(subtotal).toFixed(2));
                    $('#impuesto').val(parseFloat(subtotal * 0.16).toFixed(2))
                    $('#cuerpo').append(row);
                    
                });

                total += (total * 0.16);

                $('#total').val(parseFloat(total).toFixed(2));

                
                
                $('#modalDetalleVenta').modal('show');

            },
            error: function (response) {
                console.log(response);
            }
        });
    }

    const cambiarEstatus = (id) => {
        $.ajax({
            type: "POST",
            url: "/WorldComputer/venta/cambiarEstatus/" + id,
            success: function (response) {
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

        buscarVenta($url);
    });

    $('body').on('click', '.estatus', function (e) {
        e.preventDefault();

        $url = $(this).attr('href');

        Swal.fire({
            title: 'Esta Seguro?',
            text: "Cambiara el estatus de la venta seleccionada y el stock de productos sera afectado",
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