
$(document).ready(
    function () {

        $('._rtecs').addClass('active');
    }
);

function show( _id )
 {
    $.ajax({
        type: 'GET',
        url: vURL + '/api/rtecs',
        dataType: "JSON",
        data: {
            method: 'show',
            id: _id

        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            let _html_espds ='';
                _html_espds+='  <ul class="fa-ul mb-lg-4 mb-0">';
                $.each(vresponse.espds, function(index, value) {
                    _html_espds+='  <li>';
                    _html_espds+='      <i class="fa fa-li fa-angle-right"></i><b>'+ value.clave +'</b> '+ value.especialidad;
                    _html_espds+='  </li>';
                });
                _html_espds+='  </ul>';
            
            let _html ='';
                _html+='<h2 class="text-center">'+ vresponse.data.nombre +'</br><small>'+ vresponse.data.colegio +'</small></h2>';

                _html+='<div class="text-center" style="padding: 10px">';
                _html+='    <img id="qr-image" style="display:none;" alt="Código QR" /><br />';
                _html+='    <a href="'+ vURL +'/dowload/'+ vresponse.data.id +'/qr" class="btn btn-inverse btn-theme btn-sm">Descargar Qr</a>';
                _html+='</div>';
                
                _html+='<div class="table-responsive tbl-response">';
                _html+='    <table class="table table-payment-summary">';
                _html+='        <tbody>';
                _html+='            <tr>';
                _html+='                <td class="field">Folio</td>';
                _html+='                <td class="value">'+ vresponse.data.folio +'</td>';
                _html+='            </tr>';
                _html+='            <tr>';
                _html+='                <td class="field">Dirección</td>';
                _html+='                <td class="value">'+ vresponse.data.direccion +'</td>';
                _html+='            </tr>';
                _html+='            <tr>';
                _html+='                <td class="field">Teléfono</td>';
                _html+='                <td class="value">'+ vresponse.data.telefono +'</td>';
                _html+='            </tr>';
                _html+='            <tr>';
                _html+='                <td class="field">Correo electrónico</td>';
                _html+='                <td class="value">'+ vresponse.data.correo +'</td>';
                _html+='            </tr>';
                _html+='            <tr>';
                _html+='                <td class="field">Número de cedula profesional</td>';
                _html+='                <td class="value">'+ vresponse.data.no_cedula_profesional +'</td>';
                _html+='            </tr>';
                _html+='            <tr>';
                _html+='                <td class="field">Número de RTEC interno</td>';
                _html+='                <td class="value">'+ vresponse.data.no_rtec_interno +'</td>';
                _html+='            </tr>';
                _html+='            <tr>';
                _html+='                <td class="field">Fecha expedición</td>';
                _html+='                <td class="value">'+ vresponse.data.fecha_expedicion +'</td>';
                _html+='            </tr>';
                _html+='            <tr>';
                _html+='                <td class="field">Especialidades</td>';
                _html+='                <td class="value">';
                _html+=                     _html_espds;
                _html+='                </td>';
                _html+='            </tr>';
                _html+='        </tbody>';
                _html+='    </table>';
                _html+='</div>';

                $('._response').html(_html);


                $('#qr-image').attr('src', 'data:image/png;base64,' + vresponse.qr_code).show();
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });
 }