var _id_usuario=0;
$(document).ready(
    function () {
        
        _id_usuario=document.getElementById('id_user').value;
        $('.btn-usuario-update').attr('onClick', 'confirmUpdate('+ _id_usuario +')');
        data_edit(_id_usuario);

        $('._usuarios').addClass('active');
    }
);

function data_edit(_id_usuario)
 {
    $.ajax({
        type: 'GET',
        url: vURL + '/api/usuarios',
        dataType: "JSON",
        data: {
            method: 'show',
            id_usuario: _id_usuario
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            document.getElementById('name').value=vresponse.usuarios.name;
            document.getElementById('rfc').value=vresponse.usuarios.rfc;
            document.getElementById('telefono').value=vresponse.usuarios.telefono;
            document.getElementById('direccion').value=vresponse.usuarios.direccion;
            document.getElementById('email').value=vresponse.usuarios.email;
            
            let arrayCheck=[];
            let vhtml ='';
            for ( let vi=0; vi<vresponse.roles.length; vi++ ) {
                vhtml+='<div class="col-md-6">';
                vhtml+='    <div class="form-check form-block">';
                vhtml+='        <input class="form-check-input" type="checkbox" value="'+ vresponse.roles[vi].name +'" id="roles_'+ vi +'" name="roles[]">';
                vhtml+='        <label class="form-check-label" for="roles_'+ vi +'">';
                vhtml+='            <span class="d-flex align-items-center">';
                vhtml+='                <span class="ms-4">';
                vhtml+='                    <span class="fw-bold">'+ vresponse.roles[vi].name +'</span>';
                vhtml+='                </span>';
                vhtml+='            </span>';
                vhtml+='        </label>';
                vhtml+='    </div>';
                vhtml+='</div>';

                for ( let vj=0; vj<vresponse.usuarios.roles.length; vj++ ) {
                    if ( vresponse.roles[vi].name ==  vresponse.usuarios.roles[vj] ) {
                        arrayCheck.push('roles_' + vi);
                    }
                }
            }
            $('.div-rol').html(vhtml);

            for ( let vi=0; vi<arrayCheck.length; vi++ ) {
                $('#'+ arrayCheck[vi]).prop('checked', true);
            }
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });
 }

function confirmUpdate(id_usuario)
 {
    $.confirm({
        title: 'Confirmación',
        content: 'Esta seguro de actualizar el usuario?',
        type: 'orange',
        theme: 'material',
        // autoClose: 'Cancelar|3000',
        buttons: {
            Aceptar: function() {
                update(id_usuario); 
            },
            Cancelar: function() {
                swalFire('', 'Mensaje', '¡El usuario ha cancelo la acción!');
            }
        }
    });

    // Swal.fire({
    //     title: "Esta seguro de actualizar el usuario?",
    //     text: "Esta acción no se podra revertir!",
    //     icon: "warning",
    //     showCancelButton: true,
    //     confirmButtonText: "Si, estoy seguro!",
    //     cancelButtonText: "No, estoy seguro!",
    //     reverseButtons: true,
    //     showClass: {
    //         popup: 'animate__animated animate__fadeInDown'
    //     },
    //     hideClass: {
    //         popup: 'animate__animated animate__fadeOutUp'
    //     }

    // }).then(function(result) {
    //     if ( result.value ) {
    //         update(id_usuario);  
    //     }
    //     else if (result.dismiss === "cancel") {
    //         swalFire('info', 'Usuario', 'El usuario ha cancelo la acción.')
    //     }
    // });
 }

function update(id_usuario)
 {   
   $.ajax({
        type: 'PUT',
        url: vURL + '/usuarios/'+ id_usuario,
        dataType: "JSON",
        data: $('#frm-usuario-update').serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            let vRedirect=null;
            if ( vresponse.codigo == 1 ) vRedirect = '/usuarios';
            swalFire(vresponse.icono, 'Usuario', vresponse.mensaje, vRedirect);
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    }); 
 }

function roles()
 {
    $.ajax({
        type: 'GET',
        url: vURL + '/api/roles',
        dataType: "JSON",
        success: function(vresponse, vtextStatus, vjqXHR) {
            let vhtml ='';
            for ( vi=0; vi<vresponse.roles.length; vi++ ) {
                vhtml+='<div class="col-md-6">';
                vhtml+='    <div class="form-check form-block">';
                vhtml+='        <input class="form-check-input" type="checkbox" value="'+ vresponse.roles[vi].name +'" id="roles_'+ vi +'" name="roles[]">';
                vhtml+='        <label class="form-check-label" for="roles_'+ vi +'">';
                vhtml+='            <span class="d-flex align-items-center">';
                // vhtml+='                <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar1.jpg" alt="">';
                vhtml+='                <span class="ms-4">';
                vhtml+='                    <span class="fw-bold">'+ vresponse.roles[vi].name +'</span>';
                vhtml+='                </span>';
                vhtml+='            </span>';
                vhtml+='        </label>';
                vhtml+='    </div>';
                vhtml+='</div>';
            }
            $('.div-rol').html(vhtml);
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });
 }