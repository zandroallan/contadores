
$(document).ready(
    function() { 
        $('._mi_perfil').addClass('active');
        $('.btn-update-data').attr('onClick', 'confirmUpdateData()');
        $('.btn-update-password').attr('onClick', 'confirmUpdatePassword()');

        mi_perfil();
    }
);

function mi_perfil()
 {
    $.ajax({
        type: 'GET',
        url: vURL + '/perfil/datos',
        dataType: "JSON",
        success: function(vresponse, vtextStatus, vjqXHR) {
            // let _foto_perfil='/template/image/user.jpg';
            // if ( vresponse.data.foto != null ) {
            //     _foto_perfil=vresponse.data.foto;
            // }

            // $('._nombre').html(vresponse.data.nombre_usuario);
            // $('._area').html(vresponse.data.dependencia);

            // $('#nombre').val(vresponse.data.nombre_usuario);             
            // $('#puesto').val(vresponse.data.puesto);             
            // $('#profesion').val(vresponse.data.profesion);             
            // $('#telefono_ext').val(vresponse.data.telefono_ext);             
            // $('#correo').val(vresponse.data.correo);

            let data = vresponse.data;

            for (const key in data) {
                if (document.getElementById(key)) {
                    document.getElementById(key).value = data[key];
                }
            }



            // let vimgHtml0 ='';
            //     vimgHtml0+='<img class="img-avatar img-avatar-thumb" src="'+ vURL + _foto_perfil +'" alt="">';
            //     $('._img_perfil_0').html(vimgHtml0);

            // let vimgHtml1 ='';
            //     vimgHtml1+='<img class="img-fluid" src="'+ vURL + _foto_perfil +'" alt="">';
            //     $('._img_perfil_1').html(vimgHtml1);
        },
        error: function(vjqXHR, vtextStatus, verrorThrown) { }
    });
 }

function confirmUpdateData( )
 {
    $.confirm({
        title: 'Advertencia',
        content: '¿Esta seguro de actualizar los datos?',
        type: 'orange',
        theme: 'material',
        // autoClose: 'Cancelar|3000',
        buttons: {
            Guardar: function() {
                updateData();
            },
            Cancelar: function() {
                swalFire('', 'Mensaje', '¡El usuario ha cancelo la acción!');
            }
        }
    });





    // Swal.fire({
    //     title: "Esta seguro de actualizar los datos?",
    //     text: "Esta acción no se podra revertir!",
    //     icon: "warning",
    //     showCancelButton: true,
    //     confirmButtonText: "Si, estoy seguro!",
    //     cancelButtonText: "No, estoy seguro!",
    //     reverseButtons: true
    // }).then(function(result) {
    //     if (result.value) {         
    //         updateData();  
    //     }
    //     else if (result.dismiss === "cancel") {
    //         Swal.fire("Cancelado", "La accion fue cancelada.", "error")
    //     }
    // });
 }

function updateData()
 {
    $.ajax({
        type: 'POST',
        url: vURL + '/mis/datos/update',
        dataType: "JSON",
        data: new FormData(document.getElementById("frm-data")),
        processData:    false,
        contentType:    false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(vresponse, vtextStatus, vjqXHR) {

            swalFire(vresponse.icono, 'Mensaje', vresponse.mensaje);

            // Swal.fire({
            //     icon: vresponse.icon,
            //     title: "¡ Mensaje !",
            //     text: vresponse.respuesta,
            //     showConfirmButton: false,
            //     timer: 1500
            // }).then(function(result) {
            //     mi_perfil();
            // }); 
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });  
 }

function confirmUpdatePassword()
 {
    $.confirm({
        title: 'Advertencia',
        content: '¿Esta seguro de actualizar la contraseña?',
        type: 'orange',
        theme: 'material',
        // autoClose: 'Cancelar|3000',
        buttons: {
            Guardar: function() {
                updatePassword();
            },
            Cancelar: function() {
                swalFire('', 'Mensaje', '¡El usuario ha cancelo la acción!');
            }
        }
    });





    // Swal.fire({
    //     title: "Esta seguro de actualizar la contraseña?",
    //     text: "Esta acción no se podra revertir!",
    //     icon: "warning",
    //     showCancelButton: true,
    //     confirmButtonText: "Si, estoy seguro!",
    //     cancelButtonText: "No, estoy seguro!",
    //     reverseButtons: true
    // }).then(function(result) {
    //     if (result.value) {         
    //         updatePassword();  
    //     }
    //     else if (result.dismiss === "cancel") {
    //         Swal.fire("Cancelado", "La accion fue cancelada.", "error")
    //     }
    // });
 }

function updatePassword()
 {
    $.ajax({
        type: 'POST',
        url: vURL + '/mi/password/update',
        dataType: "JSON",
        data: $('.frm-password').serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            Swal.fire({
                icon: vresponse.icon,
                title: "¡ Mensaje !",
                text: vresponse.respuesta,
                showConfirmButton: false,
                timer: 1500
            }); 
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });  
 }