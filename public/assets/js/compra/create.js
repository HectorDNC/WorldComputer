$(document).ready(function () {

    /**
     * FUNCIONES
     */
    console.log(dolar);
    const buscarProducto = (codigo) => {

        let producto = productos.find( element => element.codigo === codigo);

        return producto;
    }

    const buscarProveedor = (documento) => {

        let proveedor = proveedores.find( element => element.documento === documento);

        return proveedor;
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
                    <input type="number" name="cantidades[]" step="any" class="form-control cantidad" value="1" min="0" required>
                </td>
                <td>
                    <input type="text" class="form-control-plaintext" value="${producto.stock}" disabled>
                </td>
                <td>
                    <input type="number" name="precios[]" step="any" class="form-control precio" value="0" min="0" required>
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

    });


    // Cambio en input de labla de productos
    $('#tproductos').on('change', 'input', function(e){
    e.preventDefault();
    // alert('funciona');

    let row = $(this).closest('tr');
    let total = row.find('.cantidad').val() * row.find('.precio').val();
    let totalBss = total*dolar;

    row.find('.total').val(total);
    row.find('.totalBss').val(totalBss);

    let elementos = document.querySelectorAll('.total');

    total = 0;

    elementos.forEach(element => {
        total = parseFloat(total) + parseFloat(element.value);
    })
    totalBss = total*dolar;
    $('#totalVenta').val(`${total} $ - ${totalBss} BSS`);    
    
    });

    // Eliminar Articulo de la Lista
    $('tbody').on('click', '.eliminar',function (e) { 
        e.preventDefault();
        
        $(this).parents('tr').remove();

    });

    //Agregar Proveedor
    $('#agregarProveedor').click(function (e) { 
        e.preventDefault();
        if($('#listadoProveedores').val() == '' || $('#listadoProveedores').val() == null){
            Toast.fire(
                'Seleccione un Proveedor',
                'Debe incluir un proveedor en la compra',
                'warning'
            )
    
            return false;
        }
        Toast.fire(
            'Proveedor agregado!',
            'Se ha seleccionado un proveedor correctamente',
            'success'
        )

        let proveedor = buscarProveedor($('#listadoProveedores').val());

        $('#proveedor').val(proveedor.id);
        $('#documentoProveedor').val(proveedor.documento);
        $('#nombreProveedor').val(proveedor.razon_social);

        console.log(proveedor);
        
    });

    $('#formularioCompra').submit(function (e){
        e.preventDefault();
        var button = $(this).find("[type='submit']");
        button.attr("disabled",true);
        setTimeout(() => {
            button.removeAttr("disabled");
        }, 1000);
        /**
         * Proveedor
         */
    
        if($('#proveedor').val() == '' || $('#proveedor').val() == null){
            Swal.fire(
                'Seleccione un Proveedor',
                'Debe incluir un proveedor en la compra',
                'warning'
            )
    
            return false;
        }
    
        /**
         * Total Venta
         */
    
        let form = $(this)
    
        let totalfilas = document.querySelectorAll('.total');
        let total = 0;
    
        totalfilas.forEach(element => {
                // console.log(element);
                total += parseFloat(element.value);
        });
    
        if(total == 0){
            Swal.fire(
                'Compra Vacia',
                'Debe selecciona al menos un articulo',
                'warning'
            )
    
            return false;
        }
    
        $('#total').val(total);
    
        console.log(total)
    
    
        $("#dolar").val(dolar);
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
                    window.location = "../Compra";
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
      const registrarProveedor = (datos) => {
        $.ajax({
            type: "POST",
            url: "../proveedor/guardar",
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
        
                    $('#agregarProveedor').modal('hide');
                }else{
                    Swal.fire(
                        json.titulo,
                        json.mensaje,
                        json.tipo
                    );
                }
                console.log(response);
            },
            error: (response) => {
                console.log(response);
                
            }
        });
     }
      // Registrar Proveedor
    $('#formularioRegistrarProveedor').submit(function (e) { 
        e.preventDefault();

        let datos = new FormData(document.querySelector('#formularioRegistrarProveedor'));
        registrarProveedor(datos);   
    });

});