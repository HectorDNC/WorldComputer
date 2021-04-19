$(document).ready(function () {

    let table = $('#datatable').DataTable({
        serverSide: false,
        ordering: false,
        searching: true,
        ajax: {
            method: 'POST',
            url: GLOBAL.URL+'Servicio/listarPrestados'
        },
        columns: [
            { data: 'codigo' },
            { data: 'fecha' },
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
    //script mostrar servicio
    const mostrarServicio = (href, formulario, modal, action) => {
        $.ajax({
            type: "POST",
            url: href,
            success: function (response) {
                let json = JSON.parse(response);
                console.log(json);
                $('#servicio_codigo').val(json.servicio_prestado.codigo);
                $('#cliente').val(json.servicio_prestado.cliente);
                $('#cliente_documento').val(json.servicio_prestado.cliente_documento);
                $('#cliente_direccion').val(json.servicio_prestado.cliente_direccion);
                $('#empleado').val(json.servicio_prestado.empleado);
                $('#empleado_documento').val(json.servicio_prestado.empleado_documento);
                $('#empleado_direccion').val(json.servicio_prestado.empleado_direccion);
                $('#fecha').val(`${json.servicio_prestado.fecha} ${json.servicio_prestado.hora}`);
                
                $('#cuerpo').empty(); 
                $('#cuerpoServicios').empty(); 
                var dolar = parseFloat(json.servicio_prestado.dolar);

                var totalServicios = 0;

                json.servicios.forEach( element => {
                    totalServicios += parseFloat(element.precio);

                    let row = `
                        <tr>
                            <td>${element.id}</td>
                            <td>${element.nombre}</td>
                            <td>${element.precio}</td>
                            <td>${element.precio * dolar}</td>
                        </tr>
                    `;
                    $('#cuerpoServicios').append(row);
                    
                });
                // totalServicios = parseFloat(totalServicios).toFixed(2);
                var totalServiciosBss = totalServicios*dolar;
                $('#totalServicios').val(`${totalServicios.toFixed(2)} $ - ${totalServiciosBss.toFixed(2)} BSS`);
                console.log(json.venta);
                if (json.venta == null) {
                    $('.productos').hide();
                    $('#totalServicioPrestado').val(`${totalServicios.toFixed(2)} $ - ${totalServiciosBss.toFixed(2)} BSS`);
                }
                else{
                    $('.productos').show();    
                    $('#venta_codigo').val(json.venta.codigo);

                    var dolarV = parseFloat(json.venta.dolar);
                    var iva = parseFloat(json.venta.impuesto);
                    $('#iva').text(iva);
                    let subtotal = 0;
                    var total = 0;

                    json.productos.forEach( element => {
                        total += element.cantidad*element.precio;
                        subtotal += element.cantidad*element.precio;

                        let row = `
                            <tr>
                                <td>${element.cantidad}</td>
                                <td>${element.codigo}</td>
                                <td>${element.nombre}</td>
                                <td>${element.precio}</td>
                                <td>${element.precio * element.cantidad}</td>
                                <td>${element.precio * element.cantidad * dolarV}</td>
                            </tr>
                        `;

                        $('#subtotal').val(parseFloat(subtotal).toFixed(2));
                        $('#impuesto').val(parseFloat(subtotal * iva/100).toFixed(2));
                        $('#cuerpo').append(row);
                        
                    });

                    
                    total += (total * iva/100);
                    var totalBss = total * dolar;
                    $('#total').val(`${total.toFixed(2)} $ - ${totalBss.toFixed(2)} BSS`);
                    totalServicioPrestado = totalServicios+total;
                    var totalServicioPrestadoBss = totalServicioPrestado*dolarV;
                    $('#totalServicioPrestado').val(`${totalServicioPrestado.toFixed(2)} $ - ${totalServicioPrestadoBss.toFixed(2)} BSS`);
                }
                $(modal).modal('show');
    
            },
            error: function(response) {
             console.log(response.getAllResponseHeaders())
         }
        });
    }
    const cambiarEstatus = (id) => {
        $.ajax({
            type: "POST",
            url: GLOBAL.URL+"Servicio/cambiarEstatus/" + id,
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
    // Mostrar Servicio
    $('body').on('click', '.mostrar', function (e) { 
        e.preventDefault();
    
        mostrarServicio($(this).attr('href'),'form#formularioMostrarServicio','#modalMostrarServicio','mostrar');
    });

    $('body').on('click', '.estatus', function (e) {
        e.preventDefault();

        $url = $(this).attr('href');

        Swal.fire({
            title: 'Esta Seguro?',
            text: "Cambiará el estatus del servicio prestado",
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
})