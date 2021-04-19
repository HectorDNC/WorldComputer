$(document).ready(function () {
    
    /**
     * FUNCIONES
     */
    
    const buscarProducto = (codigo) => {

        let producto = productos.find( element => element.codigo === codigo);

        return producto;
    }

    const buscarCliente = (documento) => {

        let cliente = clientes.find( element => element.documento === documento);

        return cliente;
    }
    /**
     * FIN
     */

    /**
     * Eventos
     */

    $('#listadoProductos').change(function (e) { 
        e.preventDefault();
        
        let producto = buscarProducto($(this).val());

        $('#nombreProducto').val(producto.nombre);
        $('#stockProducto').val(producto.stock);
    });



    $('#agregarProducto').click(function (e) { 
        e.preventDefault();

        
        let producto = buscarProducto($('#listadoProductos').val());
        
        Toast.fire(
            producto.nombre + ' Agregado',
            'Producto Agregado correctamente',
            'success'   
        )

        let fila = `
            <tr>
                <td>
                    <input type="text" name="productos[]" class="form-control-plaintext" value="${producto.id}" hidden>
                    <input type="text" class="form-control-plaintext" value="${producto.nombre}" disabled>
                </td>
                <td>
                    <input type="number" name="cantidades[]" step="any" class="form-control cantidad" value="0" min="0" max="${producto.stock}" required>
                </td>
                <td>
                    <input type="text" class="form-control-plaintext" value="${producto.stock}" disabled>
                </td>
                <td>
                    <input type="number" class="form-control-plaintext" value="${producto.precio_venta}" disabled>
                    <input type="number" name="precios[]" step="any" class="form-control precio" value="${producto.precio_venta}" hidden min="0" required>

                </td>
                <td>
                    <input type="number" class="form-control-plaintext total" value="0" disabled>
                </td>
                <td>
                    <input type="number" class="form-control-plaintext totalBss" value="0" disabled>
                </td>
                <td>
                    <button class="btn btn-danger eliminar"><i class="fas fa-trash-alt text-white"></i></button>
                </td>
            </tr>`;

        $('#cuerpo').append(fila);
        $('#listadoProductos').val('');
        $('#tproductos').change();
    });


    // Cambio en input de labla de productos
    $('#tproductos').on('change', 'input', function(e){
        e.preventDefault();
        // alert('funciona');

        let row = $(this).closest('tr');
        let total = row.find('.cantidad').val() * row.find('.precio').val();
        let totalBss = total * dolar;
        row.find('.total').val(total.toFixed(2));
        row.find('.totalBss').val(totalBss.toFixed(2));

        let elementos = document.querySelectorAll('.total');

        total = 0;

        elementos.forEach(element => {
            total = parseFloat(total) + parseFloat(element.value);
        })

        
        let impuestos = total * (iva/100);
        

        $('#impuesto').val(impuestos.toFixed(2));
        $('#subtotal').val(total.toFixed(2));
        totalNeto = total+impuestos;
        totalNetoBss = totalNeto*dolar;
        $('#totalVenta').val(`${totalNeto.toFixed(2)} $ - ${totalNetoBss.toFixed(2)} BSS`); 
    
    });

    // Eliminar Articulo de la Lista
    $('tbody').on('click', '.eliminar',function (e) { 
        e.preventDefault();
        
        $(this).parents('tr').remove();

    });

    //Agregar Cliente
    $('#agregarCliente').click(function (e) { 
        e.preventDefault();

        Toast.fire(
            'Cliente agregado!',
            'Se ha seleccionado un cliente correctamente',
            'success'
        )

        let cliente = buscarCliente($('#listadoClientes').val());

        $('#cliente').val(cliente.id);
        $('#documentoCliente').val(cliente.documento);
        $('#nombreCliente').val(cliente.nombre+" "+cliente.apellido);

        console.log(cliente);
        
    });

    $('#formularioCompra').submit(function (e){
        e.preventDefault();
    
        var button = $(this).find("[type='submit']");
        button.attr("disabled",true);
        setTimeout(() => {
            button.removeAttr("disabled");
        }, 1000);
        /**
         * Cliente
         */
        
        if($('#cliente').val() == '' || $('#cliente').val() == null){
            Swal.fire(
                'Seleccione un Cliente',
                'Debe incluir un cliente en la Venta',
                'warning'
            )
    
            return false;
        }
    
        /**
         * Total Venta
         */
    
        let form = $(this);
    
        let totalfilas = document.querySelectorAll('.total');
        let total = 0;
        
    
        totalfilas.forEach(element => {
                // console.log(element);
                total += parseFloat(element.value);
        });    


        if(total == 0){
            Swal.fire(
                'Venta Vacia',
                'Debe seleccionar al menos un articulo',
                'warning'
            )
    
            return false;
        }

        let impuestos = total * (iva/100);

        total = total + impuestos;
    
        $('#total').val(total);
    
        console.log(total)
    
        $("#dolar").val(dolar);        
        $("#iva").val(iva);        
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: form.serialize(),
            success: function (response) {
                console.log(response);
                json = JSON.parse(response);
                console.log(json);

                
                Swal.fire(
                    json.titulo,
                    json.mensaje,
                    json.tipo
                );
                setTimeout(function(){
                    window.location = "../Venta";
                },700);
            },
            error: function (response) {
                console.log(response);
            }
        });
    });

    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-start',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: false,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
    const registrarCliente = (datos) => {

        $.ajax({
            type: "POST",
            url: "../cliente/guardar",
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
        
                    window.location.reload();
        
                    $('#modalRegistroCliente').modal('hide');
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
    

    $('#formularioRegistrarCliente').submit(function (e) { 
        e.preventDefault();
   
        let datos = new FormData(document.querySelector('#formularioRegistrarCliente'));
   
       //  console.log(datos.get('documento'));
   
        registrarCliente(datos);   
   });
});