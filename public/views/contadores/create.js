$(document).ready(
    function () {
        // especialidades();
        
        $('.btn-rtec-store').attr('onClick', 'confirmStore()');
        $('._rtecs').addClass('active');

        $('#telefono').mask('(999) 999-9999');
        // $('#fecha_expedicion').mask('99/99/9999');

    }
);

function confirmStore()
 {
    $.confirm({
        title: 'Advertencia',
        content: '¿Está seguro de guardar el registro del <b>RTEC</b>?<br /> Esta acción no podrá ser revertida.',
        type: 'orange',
        theme: 'material',
        // autoClose: 'Cancelar|3000',
        buttons: {
            Guardar: function() {
                store(); 
            },
            Cancelar: function() {
                swalFire('', 'Mensaje', '¡El usuario ha cancelo la acción!');
            }
        }
    });
 }

function store()
 {   
   $.ajax({
        type: 'POST',
        url: vURL + '/contadores',
        dataType: "JSON",
        data: $('#frm-rtec-store').serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            
            let vRedirect=null;
            switch (vresponse.codigo) {
                case 1:
                    swalFire(vresponse.icono, 'Mensaje', vresponse.mensaje, '/contadores');
                  break;
                default:
                    // let _vhtml='';
                    // let _empty_input=JSON.stringify(vresponse.mensaje);
                    // for (let _inputEmty in _empty_input) {
                    //     if (_empty_input.hasOwnProperty(_inputEmty)) {
                    //         console.log(_inputEmty + ": " + _empty_input[_inputEmty]);
                    //     }
                    // }

                    swalFire(vresponse.icono, 'Mensaje', vresponse.mensaje);

                  break;
            }
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    }); 
 }

// function especialidades()
//  {
//     $.ajax({
//         type: 'GET',
//         url: vURL + '/api/especialidades',
//         dataType: "JSON",
//         data: {
//             method: 'get',
//             id_sujeto: 1
//         },
//         success: function(vresponse, vtextStatus, vjqXHR) {
//             let vhtml ='';
//             for ( vi=0; vi<vresponse.data.length; vi++ ) {
//                 vhtml+='<div class="col-md-6">';
//                 vhtml+='    <div class="form-check form-block">';
//                 vhtml+='        <input class="form-check-input" type="checkbox" value="'+ vresponse.data[vi].id +'" id="especialidades_'+ vi +'" name="especialidades[]">';
//                 vhtml+='        <label class="form-check-label" for="especialidades_'+ vi +'">';
//                 vhtml+='            <span class="d-flex align-items-center">';
//                 vhtml+='                <span class="ms-2">';
//                 vhtml+='                    <span class="d-block fs-sm"><b>'+ vresponse.data[vi].clave +'</b> '+ vresponse.data[vi].especialidad +'</span>';
//                 vhtml+='                </span>';
//                 vhtml+='            </span>';
//                 vhtml+='        </label>';
//                 vhtml+='    </div>';
//                 vhtml+='</div>';
//             }
//             $('.div-especialidades').html(vhtml);
//         },
//         error: function(vjqXHR, vtextStatus, verrorThrown){ }
//     });
//  }