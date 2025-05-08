var _id=0;
$(document).ready(
    function () {
        
        _id=document.getElementById('id').value;
        $('._rtecs').addClass('active');
        $('.btn-usuario-update').attr('onClick', 'confirmUpdate('+ _id +')');
        data_edit(_id);

        $('#telefono').mask('(999) 999-9999');
        // $('#fecha_expedicion').mask('99/99/9999');
    }
);

function data_edit(_id)
 {
    $.ajax({
        type: 'GET',
        url: vURL + '/api/rtecs',
        dataType: "JSON",
        data: {
            method: 'edit',
            id: _id
        },
        success: function(vresponse, vtextStatus, vjqXHR) {

            document.getElementById('nombre').value=vresponse.data.nombre;
            document.getElementById('direccion').value=vresponse.data.direccion;
            document.getElementById('telefono').value=vresponse.data.telefono;
            document.getElementById('correo').value=vresponse.data.correo;
            document.getElementById('no_cedula_profesional').value=vresponse.data.no_cedula_profesional;
            document.getElementById('no_rtec_interno').value=vresponse.data.no_rtec_interno;
            document.getElementById('fecha_expedicion').value=vresponse.data.fecha_expedicion;

            let arrayCheck=[];
            let vhtml ='';
            for ( let vi=0; vi<vresponse.espds.length; vi++ ) {
                vhtml+='<div class="col-md-6">';
                vhtml+='    <div class="form-check form-block">';
                vhtml+='        <input class="form-check-input" type="checkbox" value="'+ vresponse.espds[vi].id +'" id="especialidades_'+ vi +'" name="especialidades[]">';
                vhtml+='        <label class="form-check-label" for="especialidades_'+ vi +'">';
                vhtml+='            <span class="d-flex align-items-center">';
                vhtml+='                <span class="ms-2">';
                vhtml+='                    <span class="d-block fs-sm"><b>'+ vresponse.espds[vi].clave +'</b> '+ vresponse.espds[vi].especialidad +'</span>';
                vhtml+='                </span>';
                vhtml+='            </span>';
                vhtml+='        </label>';
                vhtml+='    </div>';
                vhtml+='</div>';

                for ( let vj=0; vj<vresponse.espds_select.length; vj++ ) {
                    if ( vresponse.espds[vi].id == vresponse.espds_select[vj].id_especialidad ) {
                        arrayCheck.push('especialidades_' + vi);
                    }
                }
            }
            $('.div-especialidades').html(vhtml);

            for ( let vk=0; vk<arrayCheck.length; vk++ ) {
                console.log(arrayCheck[vk]);
                $('#'+ arrayCheck[vk]).prop('checked', true);
            }
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });
 }

function confirmUpdate(id)
 {
    $.confirm({
        title: 'Confirmación',
        content: 'Esta seguro de actualizar el usuario?',
        type: 'orange',
        theme: 'material',
        // autoClose: 'Cancelar|3000',
        buttons: {
            Aceptar: function() {
                update(id); 
            },
            Cancelar: function() {
                swalFire('', 'Mensaje', '¡El usuario ha cancelo la acción!');
            }
        }
    });
 }

function update(id)
 {   
   $.ajax({
        type: 'PUT',
        url: vURL + '/rtecs/'+ id,
        dataType: "JSON",
        data: $('#frm-rtec-update').serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            let vRedirect=null;
            if ( vresponse.codigo == 1 ) vRedirect = '/usuarios';
            swalFire('', 'Mensaje', vresponse.mensaje, vRedirect);
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    }); 
 }