$(document).ready(
    function () {
        index();
       
        $('.btn-seleccion-curso-store').attr('onClick', 'confirmStore()');
        $('._especialidades').addClass('active');
    }
);

function index()
 {
    $.ajax({
        type: 'GET',
        url: vURL + '/api/especialidades',
        dataType: "JSON",
        data: {
            method: 'get'
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            
            tbl(vresponse.data);

        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });
 }

function tbl(datos)
 {
    var vhtml ='';
        vhtml+='<table class="table table-hover js-dataTable dataTable">';
        vhtml+='    <thead class="bg-thead">';
        vhtml+='        <tr>';
        vhtml+='            <th>#</th>';
        vhtml+='            <th>Clave</th>';
        vhtml+='            <th>Especialidad</th>';
        vhtml+='            <th>Sujeto</th>';
        // vhtml+='            <th class="text-center">';
        // vhtml+='                <i class="fa fa-list"></i>';
        // vhtml+='            </th>';
        vhtml+='        </tr>';
        vhtml+='    </thead>';
        vhtml+='    <tbody>';
    for ( vi=0; vi<datos.length; vi++ ) {
        vhtml+='        <tr class="tr-id_sesion-' + datos[vi].id + '">';
        vhtml+='            <td><b>' + (vi + 1) + '</b></td>';
        vhtml+='            <td>';
        vhtml+='                ' + datos[vi].clave;
        vhtml+='            </td>';
        vhtml+='            <td>';
        vhtml+='                ' + datos[vi].especialidad;
        vhtml+='            </td>';
        vhtml+='            <td>';
        vhtml+='                ' + datos[vi].sujeto;
        vhtml+='            </td>';
        // vhtml+='            <td class="text-center">';
        // vhtml+=                 buttonAction(datos[vi]);
        // vhtml+='            </td>';
        vhtml+='        </tr>';
    }
        vhtml+='    </tbody>';
        vhtml+='</table>';

    $('.tbl-cursos').html(vhtml);
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

function buttonAction(data)
 {
    let _status=1;
    let _txt_status='Activar';
    if ( data.status == 1 ) {
        _status=0;
        _txt_status='Desactivar';
    }

    var vhtml ='';
        vhtml+='<div class="dropdown">';
        vhtml+='    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-expanded="false">';
        vhtml+='    </button>';
        vhtml+='    <div class="dropdown-menu">';
        vhtml+='                        <a class="dropdown-item" onClick="confirmOnOff('+ _status +','+ data.id +')">'+ _txt_status +'</a>';        
        vhtml+='                        <a class="dropdown-item" href="'+ vURL +'/grupos/'+ data.id +'">Detalles</a>';       
        if ( _permissionEdit ) {
            vhtml+='                    <a class="dropdown-item" href="'+ vURL +'/sesiones/'+ data.id +'/edit">Editar</a>';
        }
        if ( _permissionDelete ) {
            vhtml+='                    <a class="dropdown-item" href="javascript:void(0)" onClick="confirmDestroy('+ data.id +')">Eliminar</a>';
        }
        vhtml+='    </div>';
        vhtml+='</div>';

    return vhtml;
 }

function verify_chk()
 {
    var selected = $('input[name="chqb_select[]"]:checked');
    if ( selected.length > 3) {
        event.preventDefault();
        swalFire('', 'Advertencia', 'Solo puedes seleccionar hasta tres opciones. Si deseas realizar otra selección, desmarca alguna de las opciones anteriores.!');
    }
 }

function confirmStore()
 {

    let vhtml ='';
        vhtml+='    <p class="text">';
        vhtml+='        <b>¿Está seguro de que desea guardar los datos? </b><br />';
        vhtml+='    </p>';
        vhtml+='    <div class="form-group">';
        vhtml+='        <label style="text-align: justify">Si tiene alguna sugerencia, no dude en compartirla. Será cuidadosamente considerada.</label>';
        vhtml+='        <input type="text" placeholder="Sugenrencia de curso" class="form-control" id="txt-sugerencia" />';
        vhtml+='    </div>';

    $.confirm({
        title: 'Confirmación',
        content: vhtml,
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
 }

function store()
 {   
   $.ajax({
        type: 'POST',
        url: vURL + '/cursos',
        dataType: "JSON",
        data: $('.frm-seleccion-curso-store').serialize() + "&txt-sugerencia=" + document.getElementById('txt-sugerencia').value,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(vresponse, vtextStatus, vjqXHR) {           
            switch ( vresponse.codigo ) {
                case 1:
                    index();
                    // swalFire(vresponse.icono, 'Mensaje', vresponse.mensaje, '/cursos');
                  break;
                default:
                    swalFire(vresponse.icono, 'Mensaje', vresponse.mensaje);
                  break;
            }            
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    }); 
 }

function confirmDestroy(id_sesion)
 {
    Swal.fire({
        title: "Esta seguro de eliminar el registro?",
        text: "Esta acción no se podra revertir!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, estoy seguro!",
        cancelButtonText: "No, estoy seguro!",
        reverseButtons: true,
        showClass: {
            popup: 'animate__animated animate__fadeInDown'
        },
        hideClass: {
            popup: 'animate__animated animate__fadeOutUp'
        }

    }).then(function(result) {
        if ( result.value ) {
            destroy(id_sesion);  
        }
        else if (result.dismiss === "cancel") {
            swalFire('error', 'Usuario', 'El usuario ha cancelo la acción.')
        }
    });      
 }

function destroy(id_grupo)
 {   
   $.ajax({
        type: 'DELETE',
        url: vURL + '/grupos/' + id_grupo,
        dataType: "JSON",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            swalFire(vresponse.icono, 'Usuario', vresponse.mensaje);
            index()
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    }); 
 }

function confirmOnOff(status, id_grupo)
 {
    $.confirm({
        title: 'Confirmación',
        content: 'Esta seguro que desea cambiar de estatus?',
        type: 'orange',
        theme: 'material',
        // autoClose: 'Cancelar|3000',
        buttons: {
            Cambiar: function() {
                OnOff(status, id_grupo);
            },
            Cancelar: function() {
                swalFire('', 'Mensaje', '¡El usuario ha cancelo la acción!');
            }
        }
    });   
 }

function OnOff(status, id_grupo)
 {   
   $.ajax({
        type: 'GET',
        url: vURL + '/grupos/'+ id_grupo +'/on/' + status + '/off',
        dataType: "JSON",
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
        success: function(vresponse, vtextStatus, vjqXHR) {
            swalFire(vresponse.icono, 'Mensaje', vresponse.mensaje);
            index();
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    }); 
 }