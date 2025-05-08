$(document).ready(
    function () {
        roles();
        
        $('.btn-usuario-store').attr('onClick', 'confirmStore()');
        $('._usuarios').addClass('active');
    }
);

function confirmStore()
 {
    $.confirm({
        title: 'Confirmación',
        content: 'Esta seguro de guardar el registro?',
        type: 'orange',
        theme: 'material',
        // autoClose: 'Cancelar|3000',
        buttons: {
            Aceptar: function() {
                store(); 
            },
            Cancelar: function() {
                swalFire('', 'Mensaje', '¡El usuario ha cancelo la acción!');
            }
        }
    });

    // Swal.fire({
    //     title: "Esta seguro de eliminar el registro?",
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
    //         store();  
    //     }
    //     else if (result.dismiss === "cancel") {
    //         swalFire('info', 'Usuario', 'El usuario ha cancelo la acción.')
    //     }
    // });
 }

function store()
 {   
   $.ajax({
        type: 'POST',
        url: vURL + '/usuarios',
        dataType: "JSON",
        data: $('#frm-usuario-store').serialize(),
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
        data: {
            method: 'get'
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            let vhtml ='';
            for ( vi=0; vi<vresponse.respuesta.length; vi++ ) {
                vhtml+='<div class="col-md-6">';
                vhtml+='    <div class="form-check form-block">';
                vhtml+='        <input class="form-check-input" type="checkbox" value="'+ vresponse.respuesta[vi].name +'" id="roles_'+ vi +'" name="roles[]">';
                vhtml+='        <label class="form-check-label" for="roles_'+ vi +'">';
                vhtml+='            <span class="d-flex align-items-center">';
                // vhtml+='                <img class="img-avatar img-avatar48" src="assets/media/avatars/avatar1.jpg" alt="">';
                vhtml+='                <span class="ms-2">';
                vhtml+='                    <span class="d-block fs-sm">'+ vresponse.respuesta[vi].name +'</span>';
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