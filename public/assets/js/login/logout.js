$(document).ready(function() {

    $('#logout').on('click', function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: GLOBAL.URL+"login/logout",
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);

                window.location = GLOBAL.URL;
                // window.location.reload();

                // if( json.tipo == 'success'){

                //     Swal.fire(
                //         json.titulo,
                //         json.mensaje,
                //         json.tipo
                //     );


                // }else{
                //     Swal.fire(
                //         json.titulo,
                //         json.mensaje,
                //         json.tipo
                //     );
                // }

            },
            error: (response) => {
                console.log(response);

            }
        });
    });



});