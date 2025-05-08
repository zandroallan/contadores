$(document).ready(
    function() {
        $('#_roles').addClass('active');
        $('.btn-rol-create').attr('onClick', 'confirmStore()');

        permissions();
    }
);

function permissions()
 {
    console.log('data_edit');
    $.ajax({
        type: 'GET',
        url: vURL + '/api/permisos',
        dataType: "JSON",
        data: {
            method: 'get'
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            let vhtml ='';
            for ( let vi=0; vi<vresponse.respuesta.length; vi++ ) {
                vhtml+='<div class="col-md-6">';
                vhtml+='    <div class="form-check form-block">';
                vhtml+='        <input class="form-check-input" type="checkbox" value="'+ vresponse.respuesta[vi].id +'" id="permission_'+ vi +'" name="permission[]">';
                vhtml+='        <label class="form-check-label" for="permission_'+ vi +'">';
                vhtml+='            <span class="d-flex align-items-center">';
                vhtml+='                <span class="ms-4">';
                vhtml+='                    <span class="fw-bold">'+ vresponse.respuesta[vi].name +'</span>';
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

function confirmStore()
 {
    Swal.fire({
        title: "Esta seguro de guardar el registro?",
        text: "Esta acción no se podra revertir!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, estoy seguro!",
        cancelButtonText: "No, estoy seguro!",
        reverseButtons: true
    }).then(function(result) {
        if (result.value) {         
            store();  
        }
        else if (result.dismiss === "cancel") {
            Swal.fire("Cancelado", "El usuario cancelo la acción.", "error")
        }
    });  
 }

function store()
 {
    $.ajax({
        type: "POST",
        url: vURL + '/roles',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: $('#frm-rol-store').serialize(),
        success: function(json) {
            
            Swal.fire({
                icon: "success",
                title: "Guardado",                
                text: json.msg,
                showConfirmButton: false,
                timer: 1500
            }).then(function() {                
                if(json.route_redirect!=""){ window.location = json.route_redirect; } 
            });                
        },
        error: function (json) {            
            var jsonString= json.responseJSON;                 
            verror='';

            if(json.status === 409) {                
                str_errors= jsonString.msg;                           
            }
            if(json.status === 422) {                                
                verror='';                
                verror+='<div class="alert alert-danger">';
                verror+='    <div class="d-flex flex-column">';
                verror+='        <h5 class="mb-1"><strong>Atencion!</strong> Faltan campos por llenar.</h5>';
                verror+='       <ul>';       
                $.each(jsonString.errors, function (ind, elem) { 
                verror+='           <li>'+ elem+'</li>';
                });                                          
                verror+='       </ul>';
                verror+='    </div>';
                verror+='</div>';
                $('.dvErrors').html(verror);
                close_alert();                        
            }
            if(json.status === 500) {                
                str_errors= jsonString.msg;                           
            }           
        }
    });     
 }