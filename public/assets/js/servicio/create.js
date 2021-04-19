$(document).ready(function () {


    const buscarCliente = (id) => {

        let cliente = clientes.find( element => element.id === id);

        return cliente;
    }
    const buscarEmpleado = (id) => {

        let empleado = empleados.find( element => element.id === id);

        return empleado;
    }

    const buscarServicio = (id) => {

        let servicio = servicios.find( element => element.id === id);

        return servicio;
    }
    const buscarProducto = (codigo) => {

        let producto = productos.find( element => element.codigo === codigo);

        return producto;
    }

    /**EVENTOS */

    //Agregar Cliente
    $('#agregarCliente').click(function (e) { 
        e.preventDefault();
        if($('#listadoClientes').val() == '' || $('#listadoClientes').val() == null){
            Toast.fire(
                'Seleccione un Cliente',
                'Debe incluir un cliente',
                'warning'
            )
    
            return false;
        }
        Toast.fire(
            'Cliente agregado!',
            'Se ha seleccionado un cliente correctamente',
            'success'
        )
        let cliente = buscarCliente($('#listadoClientes').val());

        $('#cliente').val(cliente.id);
        $('#nombreCliente').val(cliente.nombre +' '+cliente.apellido);
        $('#documentoCliente').val(cliente.documento);

        
    });

    //Agregar Empleado
    $('#agregarEmpleado').click(function (e) { 
        e.preventDefault();
        if($('#listadoEmpleados').val() == '' || $('#listadoEmpleados').val() == null){
            Toast.fire(
                'Seleccione un Empleado',
                'Debe incluir un empleado',
                'warning'
            )
    
            return false;
        }
        Toast.fire(
            'Empleado agregado!',
            'Se ha seleccionado un empleado correctamente',
            'success'
        )
        let empleado = buscarEmpleado($('#listadoEmpleados').val());

        $('#empleado').val(empleado.id);
        $('#nombreEmpleado').val(empleado.nombre);
        $('#cedulaEmpleado').val(empleado.documento);

        
    });

    $('#listadoServicios').change(function (e) { 
        e.preventDefault();
        
        let servicio = buscarServicio($(this).val());
        

        $('#servicio').val(servicio.id);
        $('#descripcionServicio').val(servicio.descripcion);
        $('#precioServicio').val(servicio.precio);
    });
    $('#listadoProductos').change(function (e) { 
        e.preventDefault();
        
        let producto = buscarProducto($(this).val());

        $('#nombreProducto').val(producto.nombre);
        $('#stockProducto').val(producto.stock);
    });

    //Agregar servicio a tabla
    $('#agregarServicio').click(function (e) { 
        e.preventDefault();

        
        let servicio = buscarServicio($('#listadoServicios').val());
        
        Toast.fire(
            servicio.nombre + ' Agregado',
            'Servicio Agregado correctamente',
            'success'   
        )

        let fila = `
            <tr>
                <td>
                    <input type="hidden" name="servicios[]" class="form-control-plaintext" value="${servicio.id}" >
                    <input type="text" class="form-control-plaintext" value="${servicio.nombre}" disabled>
                </td>
                <td>
                    <input type="text" class="form-control-plaintext precio_servicio" value="${servicio.precio}" disabled>
                    <input type="hidden" name="servicios_precio[]" class="form-control-plaintext " value="${servicio.precio}" >
                </td>
                <td>
                    <input type="text" class="form-control-plaintext precio_servicioBss" value="${(servicio.precio*dolar).toFixed(2)}" disabled>
                </td>
                
                <td>
                    <button class="btn btn-danger eliminar"><i class="fas fa-trash-alt text-white"></i></button>
                </td>
            </tr>`;

        $('#cuerpoServicios').append(fila);
        $('#listadoServicios').val('');
        actualizarTotal();

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

        actualizarTotal();
    
    });

    // Eliminar Articulo de la Lista
    $('tbody').on('click', '.eliminar',function (e) { 
        e.preventDefault();
        
        $(this).parents('tr').remove();
        actualizarTotal();

    });
    function actualizarTotal() {
        var totalServicios, totalProductos;
        //total servicios
        let elementos = document.querySelectorAll('.precio_servicio');
        totalServicios = 0;

        elementos.forEach(element => {
            totalServicios = parseFloat(totalServicios) + parseFloat(element.value);
        });
        $('#totalServicios').val(`${totalServicios.toFixed(2)} $ - ${(totalServicios*dolar).toFixed(2)} BSS`); 

        //total productos
        let elementosP = document.querySelectorAll('.total');
        totalProductos = 0;
        elementosP.forEach(element => {
            totalProductos = parseFloat(totalProductos) + parseFloat(element.value);
        });      
        let impuestos = totalProductos * (iva/100);
        $('#impuesto').val(impuestos.toFixed(2));
        $('#subtotal').val(totalProductos.toFixed(2));
        totalProductos = totalProductos + impuestos;
        var totalProductosBss = totalProductos * dolar;
        $('#totalVenta').val(`${totalProductos.toFixed(2)} $ - ${totalProductosBss.toFixed(2)} BSS`);
        //total
        var totalServicioPrestado = totalServicios+totalProductos;
        var totalServicioPrestadoBss = totalServicioPrestado * dolar;
        $('#totalServicioPrestado').val(`${totalServicioPrestado.toFixed(2)} $ - ${totalServicioPrestadoBss.toFixed(2)} BSS`);
    }

    $('#formularioServicio').submit(function (e){
        e.preventDefault();
        var button = $(this).find("[type='submit']");
        button.attr("disabled",true);
        setTimeout(() => {
            button.removeAttr("disabled");
        }, 1000);

        let empleado = buscarEmpleado($('#listadoEmpleados').val());
        let cliente = buscarCliente($('#listadoClientes').val());
        
        if($('#cliente').val() == '' || $('#cliente').val() == null){
            Swal.fire(
                'Seleccione un Cliente',
                'Debe incluir un cliente',
                'warning'
            )           
            return false;
        }
        if($('#empleado').val() == '' || $('#empleado').val() == null){
            Swal.fire(
                'Seleccione un Empleado',
                'Debe incluir un empleado',
                'warning'
            )    
            return false;
        }
        let form = $(this);
        let cantidadServicios = 0;
        let totalfilas = document.querySelectorAll('.precio_servicio');
        
        totalfilas.forEach(element => {
                cantidadServicios++;
        });  
        if(cantidadServicios == 0){
            Swal.fire(
                'Servicio Vacío',
                'Debe seleccionar al menos un servicio',
                'warning'
            )
    
            return false;
        }  

        actualizarTotal();
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
                if (json.tipo=="success") {
                    setTimeout(function(){
                        location="./ProvidedServices";
                    },700);
                }
                
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