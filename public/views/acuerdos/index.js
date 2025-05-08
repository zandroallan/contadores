$(document).ready(
    function () {

        index_follow();
        $('.flatpickr').flatpickr({dateFormat: 'd/m/Y'});
        $('._nv_acuerdo').addClass('active');
    }
);

function index_follow()
 {
    $.ajax({
        type: 'GET',
        url: vURL + '/api/sesiones/od',
        dataType: "JSON",
        data: { 
            method: 'get',
            type: 'seguimientos',
            status: 3
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            switch (vresponse.codigo) {
                case 1:
                    tbl_asuntos_generales(vresponse.asuntos_generales);

                    tbl_cedulas_problematicas(vresponse.cedulas_problematicas);

                    configTableBasic('dataTable');
                  break;
                default:
                  break;
            }
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });
 }

function tbl_asuntos_generales(datos)
 {
    var vhtml ='';
        vhtml+='<table class="_tbl-asuntos-generales table table-hover dataTable">';
        vhtml+='    <thead class="bg-thead">';
        vhtml+='        <tr>';
        vhtml+='            <th>N. Acuerdo</th>';
        vhtml+='            <th>Acuerdo</th>';
        vhtml+='            <th>Asunto</th>';        
        vhtml+='            <th>Responsable</th>';
        vhtml+='            <th>Compromiso</th>';
        vhtml+='            <th><i class="si si-graph"></i></th>';
        vhtml+='        </tr>';
        vhtml+='    </thead>';
        vhtml+='    <tbody>';
    for ( vi=0; vi<datos.length; vi++ ) {
        vhtml+='        <tr>';
        vhtml+='            <td>' + datos[vi].n_acuerdo + '</td>';
        vhtml+='            <td>' +  datos[vi].acuerdo + '</td>';
        vhtml+='            <td>' +  datos[vi].asunto + '</td>';
        vhtml+='            <td>' +  datos[vi].area_responsable + '</td>';
        vhtml+='            <td>' +  datos[vi].fecha_compromiso + '</td>';
        vhtml+='            <td>';
        vhtml+='                <button class="btn btn-sm btn-success me-1 mb-3" title="Seguimientos" onClick="agreementFollows('+ datos[vi].id_sesion_orden_dia_asunto_acuerdo +', 1);">';
        vhtml+='                    <i class="si si-graph"></i>';
        vhtml+='                </button>';
        vhtml+='            </td>';
        vhtml+='        </tr>';
    }
        vhtml+='    </tbody>';
        vhtml+='</table>';

    $('.tbl-asuntos-generales').html(vhtml);
 }

function tbl_cedulas_problematicas(datos)
 {
    var vhtml ='';
        vhtml+='<table class="_tbl-cedulas-problematicas table table-hover dataTable">';
        vhtml+='    <thead class="bg-thead">';
        vhtml+='        <tr>';
        vhtml+='            <th>N. Acuerdo</th>';
        vhtml+='            <th>Acuerdo</th>';
        vhtml+='            <th>Area responsable</th>';
        vhtml+='            <th>Fecha compromiso</th>';
        vhtml+='            <th><i class="si si-graph"></i></th>';
        vhtml+='        </tr>';
        vhtml+='    </thead>';
        vhtml+='    <tbody>';
    for ( vi=0; vi<datos.length; vi++ ) {
        vhtml+='        <tr>';
        vhtml+='            <td>' + datos[vi].n_acuerdo + '</td>';
        vhtml+='            <td>' + datos[vi].acuerdo + '</td>';
        vhtml+='            <td>' +  datos[vi].area_responsable + '</td>';
        vhtml+='            <td>' +  datos[vi].fecha_compromiso + '</td>';
        vhtml+='            <td>';
        vhtml+='                <button class="btn btn-sm btn-success me-1 mb-3" title="Seguimientos" onClick="agreementFollows('+ datos[vi].id_sesion_orden_dia_cedula_acuerdo +', 2);">';
        vhtml+='                    <i class="si si-graph"></i>';
        vhtml+='                </button>';
        vhtml+='            </td>';
        vhtml+='        </tr>';
    }
        vhtml+='    </tbody>';
        vhtml+='</table>';

    $('.tbl-cedulas-problematicas').html(vhtml);
 }

// function setId(_datoId, _tipo_acuerdo)
//  {
//     document.getElementById('id_sesion_orden_dia_acuerdo').value=0;
//     document.getElementById('id_sesion_orden_dia_asunto_acuerdo').value=0;
//     document.getElementById('id_sesion_orden_dia_cedula_acuerdo').value=0;
    
//     switch (parseInt(_tipo_acuerdo)) {
//         case 1:            
//             document.getElementById('id_sesion_orden_dia_asunto_acuerdo').value=_datoId;
//           break;
//         case 2:
//             document.getElementById('id_sesion_orden_dia_cedula_acuerdo').value=_datoId;
//           break;
//         case 3: 
//             document.getElementById('id_sesion_orden_dia_acuerdo').value=_datoId;
//           break;
//     }
//  }

function agreementFollows(_datoId, _tipo_acuerdo)
 {  

    console.log(_datoId);
    console.log(_tipo_acuerdo);

    let dataSend={};
    switch (parseInt(_tipo_acuerdo)) {
        case 1:
            dataSend={"id_sesion_orden_dia_asunto_acuerdo": _datoId};
          break;
        case 2:
            dataSend={"id_sesion_orden_dia_cedula_acuerdo": _datoId};
          break;
        case 3:
            dataSend={"id_sesion_orden_dia_acuerdo": _datoId};
          break;
    }

    $('#mdl-lista-seguimiento').modal('show');
    $.ajax({
        type: 'GET',
        url: vURL + '/api/sesiones/od/seguimiento/acuerdos',
        dataType: "JSON",
        data: dataSend,
        success: function(vresponse, vtextStatus, vjqXHR) {
            switch (vresponse.codigo) {
                case 1:
                    let vhtml ='';
                        vhtml+='<table class="table table-striped table-vcenter">';
                        vhtml+='    <thead>';
                        vhtml+='        <tr>';
                        vhtml+='            <th>Seguimientos</th>';
                        vhtml+='        </tr>';
                        vhtml+='    </thead>';
                        vhtml+='    <tbody>';
                        for ( vi=0; vi<vresponse.respuesta.length; vi++ ) {
                            let statusSeguimiento='';
                            let colorStatusSeguimiento='';
                            if (vresponse.respuesta[vi].status == 1) {
                                statusSeguimiento='Pendiente';
                                colorStatusSeguimiento='danger';
                            }
                            if (vresponse.respuesta[vi].status == 2) {
                                statusSeguimiento='Proceso';
                                colorStatusSeguimiento='warning';
                            }
                            if (vresponse.respuesta[vi].status == 3) {
                                statusSeguimiento='Terminado';
                                colorStatusSeguimiento='success';
                            }

                            vhtml+='    <tr>';
                            vhtml+='        <td>';
                            vhtml+='            <span class="fw-semibold d-inline-block py-1 px-3 bg-'+ colorStatusSeguimiento +'-light text-'+ colorStatusSeguimiento +' fs-sm">';
                            vhtml+='                '+ statusSeguimiento;
                            vhtml+='            </span>';
                            vhtml+='            <p class="d-none d-sm-block text-muted">';
                            vhtml+='                '+ vresponse.respuesta[vi].avance;
                            vhtml+='            </p>';
                            vhtml+='        </td>';
                            vhtml+='    </tr>';
                        }
                        vhtml+='    </tbody>';
                        vhtml+='</table>';

                        $('.tbl-lista-seguimiento').html(vhtml);                    
                  break;
                default:                    
                    $('.tbl-lista-seguimiento').html('<h3 class="fw-normal mt-5 mb-3">No tiene seguimientos agregados.</h3>');
                  break;
            }
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    }); 
 }