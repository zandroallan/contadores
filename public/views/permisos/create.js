$(document).ready(
    function() {
        $('#_permisos').addClass('active');
        $('.btn-permiso-crate').attr('onClick', 'confirmStore()');

        permissions();
    }
);

function confirmStore()
 {
    $.confirm({
        title: 'Confirmación',
        content: "Esta seguro de guardar el registro?",
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
    //     title: "Esta seguro de guardar el registro?",
    //     text: "Esta acción no se podra revertir!",
    //     icon: "warning",
    //     showCancelButton: true,
    //     confirmButtonText: "Si, estoy seguro!",
    //     cancelButtonText: "No, estoy seguro!",
    //     reverseButtons: true
    // }).then(function(result) {
    //     if (result.value) {         
    //         store();  
    //     }
    //     else if (result.dismiss === "cancel") {
    //         Swal.fire("Cancelado", "El usuario cancelo la acción.", "error")
    //     }
    // });  
 }

function store()
 {
    $.ajax({
        type: "POST",
        url: vURL + '/permisos',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: $('#frm-permiso-crate').serialize(),
        success: function(vresponse) {
            
            switch ( vresponse.codigo ) {
                case 1:
                    // index();
                    swalFire(vresponse.icono, 'Mensaje', vresponse.mensaje, '/permisos');
                  break;
                default:
                    swalFire(vresponse.icono, 'Mensaje', vresponse.mensaje);
                  break;
            }

            // Swal.fire({
            //     icon: "success",
            //     title: "Guardado",
            //     text: json.mensaje,
            //     showConfirmButton: false,
            //     timer: 1500
            // }).then(function() {
            //     if ( json.redireccion != "" ) { window.location = json.redireccion; } 
            // });                
        },
        error: function (json) {
            // var jsonString= json.responseJSON;
            // verror='';

            // if(json.status === 409) {
            //     str_errors= jsonString.msg;
            // }
            // if(json.status === 422) {
            //     verror='';
            //     verror+='<div class="alert alert-danger">';
            //     verror+='    <div class="d-flex flex-column">';
            //     verror+='        <h5 class="mb-1"><strong>Atencion!</strong> Faltan campos por llenar.</h5>';
            //     verror+='       <ul>';       
            //     $.each(jsonString.errors, function (ind, elem) { 
            //     verror+='           <li>'+ elem+'</li>';
            //     });
            //     verror+='       </ul>';
            //     verror+='    </div>';
            //     verror+='</div>';
            //     $('.dvErrors').html(verror);
            //     close_alert();
            // }
            // if(json.status === 500) {
            //     str_errors= jsonString.msg;
            // }
        }
    });
 }