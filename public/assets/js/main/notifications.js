$(document).ready(function() {


    // INTERACCION
    var down = false;

    $('#bell').click(function(e) {

        var color = $(this).text();
        if (down) {
            $('#box').fadeOut();
            down = false;
        } else {
            var pantalla = $(window).height();
            var navbar = $('#navbar').height();
            pantalla = pantalla - navbar-10;
            $('#box').css('height', pantalla+'px');
            $('#box').slideDown();     
            down = true;

        }

    });

    $('#getout').click(function(e) {
        $('#box').fadeOut();
        down = false;
    });


    // PETICIONES
    const getNotifications = () => {
        console.log("GetNotifications");
        $.ajax({
            type: "POST",
            url: GLOBAL.URL+"notificacion/listar",
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);

                console.log(response.data.length);

                if (response.data.length !== 0) {

                    $('.notifications-item').remove();

                    response.data.forEach((e) => {
                        $('#box').append(`<div class="notifications-item" id="notificacion-${e.id}"> <img src="https://freeiconshop.com/wp-content/uploads/edd/box-flat-128x128.png" alt="img">
                            <div class="text">
                                <h4>${e.titulo.toUpperCase()}</h4>
                                <p>${e.mensaje}</p>
                            </div>
                            <div class="notifications-item__close" onClick="dismissNotificacion(${e.id})">x</div>
                        </div>`);
                    })
                    $('#cantidadNotificaciones').show()
                    $('#cantidadNotificaciones').text(response.data.length);
                } else {

                }
            },
            error: (response) => {
                console.log(response);

            }
        });
    }

    getNotifications();

    setInterval(getNotifications, 15000);
});

function dismissNotificacion (id) {
    let idNotificacion = id;
    $.ajax({
            type: "POST",
            url: GLOBAL.URL+"notificacion/dismissNotificacion",
            data: { id: idNotificacion },
            dataType: "json",
            success: function(response) {

                if (response) {
                    $(`#notificacion-${id}`).fadeOut(200)
                    let nuevaCantidad = parseInt($('#cantidadNotificaciones').text() - 1)
                    if (nuevaCantidad > 0) {
                        $('#cantidadNotificaciones').text(nuevaCantidad)
                    } else {
                        $('#cantidadNotificaciones').hide()
                    }

                } else {
                    console.log('no');
                }
            },
            error: (response) => {
                console.log(response);
            }
        });
}