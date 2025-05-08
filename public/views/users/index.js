var _id_usuario=0;

$(document).ready(
    function () {
        index();

        $('._usuarios').addClass('active');
    }
);

function index()
 {
    $.ajax({
        type: 'GET',
        url: vURL + '/api/usuarios',
        dataType: "JSON",
        data: {
            method: 'get'
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            var vdocumentacion=vresponse.usuarios;
            tableUsuarios(vresponse.usuarios);
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });
 }

function tableUsuarios(usuarios)
 {
    var vhtml ='';
        vhtml+='<table class="table table-hover js-dataTable dataTable">';
        vhtml+='    <thead class="bg-thead">';
        vhtml+='        <tr>';
        vhtml+='            <th>#</th>';
        // vhtml+='            <th class="text-center">';
        // vhtml+='                <i class="far fa-images"></i>';
        // vhtml+='            </th>';
        vhtml+='            <th>Nombre</th>';
        vhtml+='            <th>Teléfono</th>';
        vhtml+='            <th>Correo electrónico</th>';
        vhtml+='            <th>Rol</th>';
        vhtml+='            <th><i class="fa fa-list"></i></th>';
        vhtml+='        </tr>';
        vhtml+='    </thead>';
        vhtml+='    <tbody>';
    for ( vi=0; vi<usuarios.length; vi++ ) {
        let _rutaImagen=vURL +'/template/image/user.jpg';
        if ( usuarios[vi].foto != null ) _rutaImagen=vURL + usuarios[vi].foto;

        vhtml+='        <tr class="_tr_'+ usuarios[vi].id +'">';
        vhtml+='            <td><span class="badge bg-black-50">' + (vi + 1) + '</span></td>';
        vhtml+='            <td class="fs-sm">';
        vhtml+='                <p class="fw-semibold mb-1"><b>'+ usuarios[vi].name +'</b></p>';
        vhtml+='            </td>';
        vhtml+='            <td class="fs-sm">' + usuarios[vi].telefono + '</td>';
        vhtml+='            <td class="fs-sm">' + usuarios[vi].email + '</td>';
        vhtml+='            <td class="fs-sm">';

        let rol=usuarios[vi].roles;
        for ( vj=0; vj<rol.length; vj++ ) {
            vhtml+='            <span class="badge bg-info">'+ rol[vj] +'</span>';
        }
        
        vhtml+='            </td>';
        vhtml+='            <td>';
        vhtml+='                <div class="dropdown">';
        vhtml+='                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">';
        vhtml+='                        ';
        vhtml+='                    </button>';
        vhtml+='                    <div class="dropdown-menu">';
        vhtml+='                        <a class="dropdown-item" href="'+ vURL +'/usuarios/'+ usuarios[vi].id +'">Detalles</a>';
        if ( _permissionEdit ) {
            vhtml+='                    <a class="dropdown-item" href="'+ vURL +'/usuarios/'+ usuarios[vi].id +'/edit">Editar</a>';
        }
        if ( _permissionDelete ) {
            vhtml+='                    <a class="dropdown-item" href="javascript:void(0)" onClick="confirmDestroy('+ usuarios[vi].id +')">Eliminar</a>';
        }
        vhtml+='                    </div>';
        vhtml+='                </div>';
        vhtml+='            </td>';
        vhtml+='        </tr>';
    }
        vhtml+='    </tbody>';
        vhtml+='</table>';

    $('.tbl-usuarios').html(vhtml);
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

function setUsuario(id_usuario)
 {
    _id_usuario=id_usuario;
 }

function confirmDestroy(id_usuario)
 {
    $.confirm({
        title: 'Confirmación',
        content: 'Esta seguro de eliminar el registro?',
        type: 'orange',
        theme: 'material',
        // autoClose: 'Cancelar|3000',
        buttons: {
            Eliminar: function() {
                destroy(id_usuario);
            },
            Cancelar: function() {
                swalFire('', 'Mensaje', '¡El usuario ha cancelo la acción!');
            }
        }
    });
 }

function destroy(id_usuario)
 {   
   $.ajax({
        type: 'DELETE',
        url: vURL + '/usuarios/' + id_usuario,
        dataType: "JSON",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            swalFire(vresponse.icono, 'Usuario', vresponse.mensaje);            
            $('._tr_' + id_usuario).remove();
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    }); 
 }

// function confirmStoreUsuarioDependencia()
//  {
//     Swal.fire({
//         title: "Esta seguro de agregar el registro?",
//         text: "Esta acción no se podra revertir!",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonText: "Si, estoy seguro!",
//         cancelButtonText: "No, estoy seguro!",
//         reverseButtons: true,
//         showClass: {
//             popup: 'animate__animated animate__fadeInDown'
//         },
//         hideClass: {
//             popup: 'animate__animated animate__fadeOutUp'
//         }

//     }).then(function(result) {
//         if ( result.value ) {
//             storeUsuarioDependencia();  
//         }
//         else if (result.dismiss === "cancel") {
//             swalFire('error', 'Usuario', 'El usuario ha cancelo la acción.')
//         }
//     });      
//  }

// function storeUsuarioDependencia()
//  {   
//    $.ajax({
//         type: 'POST',
//         url: vURL + '/usuario/dependencias',
//         dataType: "JSON",
//         data: $('#frm-usuario-dependencia-store').serialize() + "&id_usuario=" + _id_usuario,
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         success: function(vresponse, vtextStatus, vjqXHR) {
//             swalFire(vresponse.icono, 'Usuario', vresponse.mensaje);
            
//             if ( vresponse.codigo == 1) {
//                 $('#id_poder').val(0).trigger('change');
//                 $('#id_dependencia').val(0).trigger('change');
//                 $('#mdl-usuario-dependencia').modal('hide');
//             }
            
//         },
//         error: function(vjqXHR, vtextStatus, verrorThrown){ }
//     }); 
//  }