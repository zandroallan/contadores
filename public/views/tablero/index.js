$(document).ready(
    function () {
        tablero();    
        $('._tablero').addClass('active');
        $('.btn-reporte').attr('onclick', 'reporte()');
    }
);

function tablero()
 {
    $.ajax({
        type: 'GET',
        url: vURL + '/api/tablero',
        dataType: "JSON",
        data: {
            method: 'get'
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            $('._proceso').html(vresponse.proceso.length);
            $('._concluidos').html(vresponse.concluidos.length);
            $('._cancelados').html(vresponse.cancelados.length);

            var vhtml ='';
                vhtml+='<table class="_tbl_usuario_dependencia table table-hover dataTable">';
                vhtml+='    <thead class="bg-thead">';
                vhtml+='        <tr>';
                vhtml+='            <th>#</th>';
                vhtml+='            <th>Folio</th>';
                vhtml+='            <th class="text-center">Nombre</th>';
                vhtml+='            <th class="text-center">Colegio</th>';
                vhtml+='        </tr>';
                vhtml+='    </thead>';
                vhtml+='    <tbody>';
            for ( vi=0; vi<vresponse.data.length; vi++ ) {

                vhtml+='        <tr class="">';
                vhtml+='            <td>' + (vi + 1) + '</td>';
                vhtml+='            <td>' + vresponse.data[vi].folio + '</td>';
                vhtml+='            <td class="text-center">' + vresponse.data[vi].nombre + '</td>';
                vhtml+='            <td class="text-center">' + vresponse.data[vi].colegio + '</td>';
                vhtml+='        </tr>';
            }
                vhtml+='    </tbody>';
                vhtml+='</table>';

            $('.tbl-tablero-response').html(vhtml);

            // configTableBasic('tbl-tablero-sesiones', false);
            // index_selectOrganismo();
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });
 }

function mdl_sesion(id_dependencia, tipo)
 {
    $('.mdl-sesiones').modal('show');

    $.ajax({
        type: 'GET',
        url: vURL + '/api/sesiones/'+ id_dependencia +'/dependencia',
        dataType: "JSON",
        success: function(vresponse, vtextStatus, vjqXHR) {
            // let _title='';
            // let _data=null;
            // switch ( tipo ) {
            //     case 1: 
            //         _title='Sesiones ordinarias';
            //         _data=vresponse.ordinarias;
            //       break;
            //     case 2: 
            //         _title='Sesiones extraordinarias';
            //         _data=vresponse.extraordinarias;
            //       break;
            // }
            // $('.mdl-title').html(_title);

            // var vhtml ='';
            //     vhtml+='<table class="_tbl_sesion_dependencia table table-hover dataTable">';
            //     vhtml+='    <thead class="bg-thead">';
            //     vhtml+='        <tr>';
            //     vhtml+='            <th>#</th>';
            //     vhtml+='            <th>No Sesión</th>';
            //     vhtml+='            <th class="text-center">Estatus carpeta</th>';
            //     vhtml+='            <th class="text-center">Estatus sesión</th>';
            //     vhtml+='            <th class="text-center">Fecha carpeta</th>';
            //     vhtml+='            <th class="text-center">Fecha sesión</th>';
            //     vhtml+='        </tr>';
            //     vhtml+='    </thead>';
            //     vhtml+='    <tbody>';
            // for ( vi=0; vi<_data.length; vi++ ) {
            //     vhtml+='        <tr class="">';
            //     vhtml+='            <td>' + (vi + 1) + '</td>';
            //     vhtml+='            <td>' + _data[vi].descripcion + '</td>';
            //     vhtml+='            <td class="text-center">' + _data[vi].status_carpeta + '</td>';
            //     vhtml+='            <td class="text-center">' + _data[vi].status_sesion + '</td>';
            //     vhtml+='            <td class="text-center">' + _data[vi].fecha_carpeta + '</td>';
            //     vhtml+='            <td class="text-center">' + _data[vi].fecha + '</td>';
            //     vhtml+='        </tr>';
            // }
            //     vhtml+='    </tbody>';
            //     vhtml+='</table>';

            // $('._sesiones_dependencias').html(vhtml);
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });
 }

function reporte()
{
    window.location.href = vURL + '/reporte/colegios';
}