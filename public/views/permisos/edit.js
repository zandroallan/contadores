function data_edit(_id)
 {
    $.ajax({
        type: 'GET',
        url: vURL + '/api/permisos',
        dataType: "JSON",
        data: {
            method: 'show',
            id: _id
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            document.getElementById('name').value=vresponse.respuesta.name;
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });
 }

function confirmUpdate(_id)
 {
    Swal.fire({
        title: "Esta seguro de actualizar el registro?",
        text: "Esta acción no se podra revertir!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, estoy seguro!",
        cancelButtonText: "No, estoy seguro!",
        reverseButtons: true
    }).then(function(result) {        
        if (result.value) {              
            update(_id);  
        }
        else if (result.dismiss === "cancel") {
            Swal.fire("Cancelado", "El usuario cancelo la acción.", "error")
        }
    });  
 }

function update(_id)
 { 
    $.ajax({
        type: "PUT",
        url: vURL + '/permisos/'+ _id,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: $('#frm-permiso-update').serialize(),
        success: function(vresponse) {            
            Swal.fire({
                icon: vresponse.icono,
                title: "Notificación",                
                text: vresponse.mensaje,
                showConfirmButton: false,
                timer: 1500
            }).then(function() {                
                if ( vresponse.redireccion != "" ) {
                    window.location = vresponse.redireccion;
                }
            });                
        },
        error: function ( vresponse ) {            
//             var vresponseString= vresponse.responsevresponse;
//             if ( vresponse.status === 409 ) {
//                 str_errors= vresponseString.msg;
//             }
            
//             if ( vresponse.status === 422 ) {
//                 verror='';                
//                 verror+='<div class="alert alert-danger">';
//                 verror+='    <div class="d-flex flex-column">';
//                 verror+='        <h5 class="mb-1"><strong>Atencion!</strong> Faltan campos por llenar.</h5>';
//                 verror+='       <ul>';       
//                 $.each(vresponseString.errors, function (ind, elem) { 
//                     verror+='           <li>'+ elem+'</li>';
//                 });                                          
//                 verror+='       </ul>';
//                 verror+='    </div>';
//                 verror+='</div>';
//                 $('.dvErrors').html(verror);
//                 close_alert();                        
//             }

//             if ( vresponse.status === 500 ) {
//                 str_errors= vresponseString.msg;
//             }           
        }
    });
}