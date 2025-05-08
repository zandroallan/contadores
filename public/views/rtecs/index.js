var _id=0;

$(document).ready(
    function () {
        index();

        $('._rtecs').addClass('active');
        $('.btn-constancia-store').attr('onClick', 'storeFileConfirm()');
    }
);

function index()
 {
    $.ajax({
        type: 'GET',
        url: vURL + '/api/rtecs',
        dataType: "JSON",
        data: {
            method: 'get'
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            tbl_response(vresponse.data);
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });
 }

function tbl_response(data)
 {
    var vhtml ='';
        vhtml+='<table class="table table-hover js-dataTable dataTable">';
        vhtml+='    <thead class="bg-thead">';
        vhtml+='        <tr>';
        vhtml+='            <th>#</th>';
        vhtml+='            <th><i class="fa fa-clipboard"></i> FOLIO</th>';
        vhtml+='            <th><i class="fa fa-user"></i> SUJETO</th>';
        vhtml+='            <th><i class="fa fa-home"></i> COLEGIO</th>';
        vhtml+='            <th><i class="fa fa-calendar"></i> EXPEDICIÓN</th>';
        vhtml+='            <th><i class="fa fa-phone"></i> TELÉFONO</th>';
        // vhtml+='            <th>Correo electrónico</th>';
        vhtml+='            <th class="text-center"><i class="fa fa-download"></i></th>';
        vhtml+='            <th><i class="fa fa-th-list"></i></th>';
        vhtml+='        </tr>';
        vhtml+='    </thead>';
        vhtml+='    <tbody>';
    for ( vi=0; vi<data.length; vi++ ) {

        let file ='';
        if ( data[vi].anexo_path != null) {
            file+='<a class="item-title text-color" href="' + vURL + '/constancia/'+ data[vi].id +'/download" target="_blank">';
            file+='    <span title="'+ data[vi].anexo +'">';
            file+='        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-paperclip mx-2">';
            file+='            <path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"></path>';
            file+='        </svg>';
            file+='    </span>';
            file+='</a>';
        }
        else {
            file+='<span class="badge badge-circle text-warning"></span>';
            file+='<small class="text-muted" title="Sin anexo cargado"> s/a</small>';
        }

        vhtml+='        <tr class="_tr_'+ data[vi].id +'">';
        vhtml+='            <td><span class="badge bg-black-50">' + (vi + 1) + '</span></td>';
        vhtml+='            <td class="fs-sm"><b>'+ data[vi].folio +'</b></td>';
        vhtml+='            <td class="fs-sm"><b>'+ data[vi].sujeto +'</b></td>';
        vhtml+='            <td class="fs-sm"><b>'+ data[vi].nombre +'</b><br />'+ data[vi].colegio +'</td>';
        vhtml+='            <td class="fs-sm">';
        vhtml+='                <p class="fw-semibold mb-1">'+ data[vi].fecha_expedicion +'</p>';
        vhtml+='            </td>';
        vhtml+='            <td class="fs-sm">' + data[vi].telefono + '</td>';
        // vhtml+='            <td class="fs-sm">' + data[vi].correo + '</td>';
        vhtml+='            <td class="fs-sm text-center">'+ file +'</td>';
        vhtml+='            <td>';
        vhtml+='                <div class="dropdown">';
        vhtml+='                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">';
        vhtml+='                        ';
        vhtml+='                    </button>';
        vhtml+='                    <div class="dropdown-menu">';
        vhtml+='                        <a class="dropdown-item" href="'+ vURL +'/rtecs/'+ data[vi].id +'">Detalles</a>';
        if ( data[vi].anexo_path == null) {
            vhtml+='                        <a class="dropdown-item" href="#" onClick="openModal('+ data[vi].id +')">Cargar constancia</a>';
        }
        if ( _permissionEdit ) {
            vhtml+='                    <a class="dropdown-item" href="'+ vURL +'/rtecs/'+ data[vi].id +'/edit">Editar</a>';
        }
        if ( _permissionDelete ) {
            vhtml+='                    <a class="dropdown-item" href="javascript:void(0)" onClick="confirmDestroy('+ data[vi].id +')">Eliminar</a>';
        }
        vhtml+='                    </div>';
        vhtml+='                </div>';
        vhtml+='            </td>';
        vhtml+='        </tr>';
    }
        vhtml+='    </tbody>';
        vhtml+='</table>';

    $('.tbl-rtecs').html(vhtml);
    configTableBasic();

    var _table = $('.dataTable').DataTable();
    
    $("#DataTables_Table_0_filter").hide();
    $('#txt-search').on( 'keyup', 
        function () {
            _table.search( this.value ).draw();
            var buscar=document.getElementById("txt-search").value;
            if ( buscar != "" ) {
                document.getElementById("txt-search").style.border="1px solid #eee";
            }
            else {
                document.getElementById("txt-search").style.border="";
            }
        }
    );
 }

function openModal(id)
 {
    _id=id;
    $('.mdl-anexo').modal('show');
 }

function storeFileConfirm()
 {
    $.confirm({
        title: 'Advertencia',
        content: 'Esta seguro que desea guardar este registro?',
        type: 'orange',
        theme: 'material',
        buttons: {
            Subir: function() {
                storeFile();
            },
            Cancelar: function() {
                swalFire('', 'Mensaje', '¡El usuario ha cancelado la acción!');
            }
        }
    });
 }

function storeFile()
 {
    var vformularioFile=document.getElementById("frm-constancia-store");
    var vformData = new FormData(vformularioFile);
        vformData.append("id", _id);

    $.ajax({
        type: "POST",
        url: vURL + '/constancia/upload',
        data: vformData,
        processData:    false,
        contentType:    false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function( vresponse ) {

            console.log(vresponse);

            switch ( parseInt(vresponse.codigo)) {
                case 1:
                    $('#file').val('');
                    $('.mdl-anexo').modal('hide');
                    swalFire('', 'Mensaje', vresponse.mensaje );
                     index();
                  break;
                default:
                    swalFire('', 'Mensaje', vresponse.mensaje );
                  break;
            }
        },
        error: function(json) {
            // if(json.status === 422) {
            //     validar_formulario(null, false);
            //     str_errors= 'Hay campos pendientes o han sido llenados con informaciÃ³n incorreta. <br> Porfavor verifique la informaciÃ³n.';
            //     validar_formulario(json.responseJSON.errors, true);
            // }
        }           
    });
 }

function confirmDestroy(id)
 {
    $.confirm({
        title: 'Advertencia',
        content: 'Esta seguro de <b>eliminar</b> el registro?',
        type: 'orange',
        theme: 'material',
        buttons: {
            Eliminar: function() {
                destroy(id);
            },
            Cancelar: function() {
                swalFire('', 'Mensaje', '¡El usuario ha cancelado la acción!');
            }
        }
    });
 }

function destroy(id)
 {   
   $.ajax({
        type: 'DELETE',
        url: vURL + '/rtecs/' + id,
        dataType: "JSON",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            swalFire(vresponse.icono, 'Mensaje', vresponse.mensaje);            
            $('._tr_' + id).remove();
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    }); 
 }