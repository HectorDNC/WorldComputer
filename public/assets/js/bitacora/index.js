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
        url: 'bitacora/listar'
    },
    columns: [
        { data: 'modulo' },
        { data: "accion" },
        { data: 'usuario' },
        { data: 'fecha' },
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

const mostrarBitacora = (href, formulario, modal) => {
    
    $.ajax({
        type: "POST",
        url: href,
        success: function (response) {
            let json = JSON.parse(response);

            console.log(json);

            $(formulario).find('input#usuario_nombre').val(json.data.usuario_nombre);
            $(formulario).find('input#usuario_username').val(json.data.usuario_username);
            $(formulario).find('input#usuario_documento').val(json.data.usuario_documento);
            $(formulario).find('input#usuario_rol').val(json.data.usuario_rol);
            $(formulario).find('input#fecha').val(json.data.fecha);
            $(formulario).find('input#hora').val(json.data.hora);
            $(formulario).find('input#modulo').val(json.data.modulo);
            $(formulario).find('#accion').html(json.data.accion);
            $(formulario).find('#descripcion').html(json.data.descripcion);
            if(json.data.descripcion==null){
                $('#descripcionDiv').hide();
            }
            else{
                $('#descripcionDiv').show();
            }
            console.log(json.data.descripcion);

            $(modal).modal('show');
            

        },
        error: (response) => {
            console.log(response);
        }
    });
}

/**
 * Eventos
 */



// Mostrar Bitacora
$('body').on('click', '.mostrar', function (e) { 
    e.preventDefault();

    mostrarBitacora($(this).attr('href'),'form#formularioMostrarBitacora','#modalMostrarBitacora');
});

$("#buscarB").click(function(){
    table.ajax.url("bitacora/listar/"+$("#fechaB").val()+"&"+$("#usuarioB").val()+"&"+$("#moduloB").val());    
    table.ajax.reload();
});

$('[name="datatable_length"]').val(50);
$('[name="datatable_length"]').change();
});
