function data_edit(_id)
 {
    console.log('data_edit');
    $.ajax({
        type: 'GET',
        url: vURL + '/api/roles',
        dataType: "JSON",
        data: {
            method: 'show',
            id: _id
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            document.getElementById('name').value=vresponse.rol_usuario.name;            
            let arrayCheck=[];
            let vhtml ='';
            for ( let vi=0; vi<vresponse.permisos.length; vi++ ) {
                vhtml+='<div class="col-md-6">';
                vhtml+='    <div class="form-check form-block">';
                vhtml+='        <input class="form-check-input" type="checkbox" value="'+ vresponse.permisos[vi].id +'" id="permission_'+ vi +'" name="permission[]">';
                vhtml+='        <label class="form-check-label" for="permission_'+ vi +'">';
                vhtml+='            <span class="d-flex align-items-center">';
                vhtml+='                <span class="ms-4">';
                vhtml+='                    <span class="fw-bold">'+ vresponse.permisos[vi].name +'</span>';
                vhtml+='                </span>';
                vhtml+='            </span>';
                vhtml+='        </label>';
                vhtml+='    </div>';
                vhtml+='</div>';

                for ( let vj=0; vj<vresponse.permisos_usuario.length; vj++ ) {
                    if ( vresponse.permisos[vi].id ==  vresponse.permisos_usuario[vj].permission_id ) {
                        arrayCheck.push('permission_' + vi);
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

function confirmUpdate(_id)
 {
    $.confirm({
        title: 'Confirmación',
        content: 'Esta seguro de actualizar el registro?',
        type: 'orange',
        theme: 'material',
        // autoClose: 'Cancelar|3000',
        buttons: {
            Aceptar: function() {
                update(_id);
            },
            Cancelar: function() {
                swalFire('', 'Mensaje', '¡El usuario ha cancelo la acción!');
            }
        }
    });
 }

function update(_id)
 { 
    $.ajax({
        type: "PUT",
        url: vURL + '/roles/'+ _id,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: $('#frm-rol-update').serialize(),
        success: function(vresponse) {

            let vRedirect=null;
            if ( vresponse.codigo == 1 ) vRedirect = '/roles';
            swalFire(vresponse.icono, 'Mensaje', vresponse.mensaje, vRedirect);              
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