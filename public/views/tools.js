$(document).ready(
    function () {        
        // if ( window.location.pathname != '/home' ) {
        //     organismos();
        // }
    }
);

// function organismos()
//  {
//     $.ajax({
//         type: 'GET',
//         url: vURL + '/api/usuario/dependencias',
//         dataType: "JSON",
//         data: {
//             method: 'get',
//             id_usuario: document.getElementById('id_usuario').value
//         },
//         success: function(vresponse, vtextStatus, vjqXHR) {
//             var dependencias=vresponse.dependencias;

//             var vhtml ='';
//                 vhtml+='<table class="table table-hover js-dataTable dataTable">';
//                 vhtml+='    <thead class="bg-thead">';
//                 vhtml+='        <tr>';
//                 vhtml+='            <th>#</th>';
//                 vhtml+='            <th>Poder</th>';
//                 vhtml+='            <th>Dependencia</th>';
//                 vhtml+='        </tr>';
//                 vhtml+='    </thead>';
//                 vhtml+='    <tbody>';
//             for ( vi=0; vi<dependencias.length; vi++ ) {
//                 vhtml+='        <tr class="">';
//                 vhtml+='            <td>';
//                 vhtml+='                <div class="form-check">';
//                 vhtml+='                    <input class="form-check-input" type="radio" id="rbt-organismo-idOrg'+ dependencias[vi].id_dependencia +'" name="id_dependencia" onClick="confirm_select_organismo('+ dependencias[vi].id_dependencia +')">';
//                 vhtml+='                </div>';
//                 vhtml+='            </td>';
//                 vhtml+='            <td>' + dependencias[vi].poder + '</td>';
//                 vhtml+='            <td>';
//                 vhtml+='                <sapn class="badge bg-info">';
//                 vhtml+='                    <label class="form-check-label" for="rbt-organismo-'+ dependencias[vi].id_dependencia +'">' + dependencias[vi].dependencia + '</label>';
//                 vhtml+='                </span>';
//                 vhtml+='            </td>';
//                 vhtml+='        </tr>';
//             }
//                 vhtml+='    </tbody>';
//                 vhtml+='</table>';

//             $('.tbl-usuario-organismos').html(vhtml);
//             organismo_select();
//         },
//         error: function(vjqXHR, vtextStatus, verrorThrown){ }
//     });
//  }

// function organismo_select()
//  {
//     $.ajax({
//         type: 'GET',
//         url: vURL + '/api/dependencia/selected',
//         dataType: "JSON",
//         success: function(vresponse, vtextStatus, vjqXHR) {
//             switch ( vresponse.codigo ) {
//                 case 1:
//                     $('#rbt-organismo-idOrg'+ parseInt(vresponse.id_dependencia_slc)).prop('checked', true);
//                     // index_sesiones();
//                    break;
//                 default:
//                     // swalFire('warning', 'Organismo', 'El usuario no ha seleccionado ningún organismo, favor de seleccionar.');
//                     window.location = vURL + '/home';
//                   break;
//             }
//         },
//         error: function(vjqXHR, vtextStatus, verrorThrown){ }
//     });
//  }

// function confirm_select_organismo(id_dependencia)
//  {
//     Swal.fire({
//         title: "Esta seguro de usar este organismo?",
//         text: "Esta acción se podra revertir, hasta seleccionar otro organismo!",
//         icon: "warning",
//         color: '#52565e',
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
//             select_organismo(id_dependencia);  
//         }
//         else if (result.dismiss === "cancel") {
//             $('#rbt-organismo-idOrg'+ id_dependencia).prop('checked', false);
//             swalFire('error', 'Organismo', 'El usuario ha cancelo la acción.');
//             organismo_select();
//         }
//     });      
//  }

// function select_organismo(id_dependencia)
//  {   
//    $.ajax({
//         type: 'POST',
//         url: vURL + '/dependencia/selected',
//         dataType: "JSON",
//         data: {
//             id_dependencia: id_dependencia
//         },
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         success: function(vresponse, vtextStatus, vjqXHR) {
//             swalFire(vresponse.icono, 'Organismo', vresponse.mensaje, '/home');
//         },
//         error: function(vjqXHR, vtextStatus, verrorThrown){ }
//     }); 
//  }

/**
 * ----------------------------------------------------
 * */

function swalFire(icon, title, text, _return=null)
 {
    $.alert({ 
        title: title,
        content: text, 
        type: 'blue',
        theme: 'material',
        // autoClose: 3000,
        // autoClose: 'ok|3000'
        buttons: {
            ok: function() {
                if ( _return != null ) {
                    window.location = vURL + _return;
                }
            } 
        }       
    });

    // Swal.fire({
    //     icon: icon,
    //     title: title,
    //     text: text,
    //     showConfirmButton: false,
    //     timer: 3000,
    //     showClass: {
    //         popup: 'animate__animated animate__fadeInDown'
    //     },
    //     hideClass: {
    //         popup: 'animate__animated animate__fadeOutUp'
    //     }
    // }).then((result) => {
    //     if ( _return != null ) {
    //         window.location = vURL + _return;
    //     }
    // });
 }

function formatDate( _fecha, _hora=0 ) 
 {
    var vresponse="s/f";
    if ( ( _fecha != "" ) || ( _fecha != null ) ) {
        var vfecha_request=_fecha.split(" ");
        var vfecha_response=vfecha_request[0].split("-");

        switch ( _hora ) {
            case 0:
                vresponse=vfecha_response[2] + "/" + vfecha_response[1] + "/" + vfecha_response[0];
              break;
            case 1:
                vresponse=vfecha_response[2] + "/" + vfecha_response[1] + "/" + vfecha_response[0] + " " + vfecha_request[1];
              break;
        }        
    }
    return vresponse;
 }

// function poderes_opt(vdataSelect=0)
//  {      
//     $.ajax({
//         type: "GET",
//         url: vURL + '/api/poderes',
//         data: {
//             method: 'get'
//         },
//         success: function(vresponse) {
//             let vhtml='';
//                 vhtml+= '<option value="">--- Seleccionar ---</option>';
//             for ( let vi=0; vi<vresponse.poderes.length; vi++ ) {
//                 vhtml+= '<option value='+ vresponse.poderes[vi].id +'>'+ vresponse.poderes[vi].poder +'</option>';
//             }
//             $('#id_poder').html(vhtml);

//             if ( vdataSelect != 0 ) {
//                 $('#id_poder').val(vdataSelect).trigger('change');
//             }
            
//             $('#id_poder').attr('onChange', 'depdendencias_opt(0, 0)');
           
//         },
//         error: function(vresponse) { }
//     });
//  }

// function depdendencias_opt(vdataSelect=0, vidPoder=0)
//  {
//     $('#id_dependencia').html('');
//     $.ajax({
//         type: "GET",
//         url: vURL + '/api/dependencias',
//         data: {
//             method: 'get',
//             id_poder: $("#id_poder").val()
//         },
//         success: function(vresponse) {
//             let vhtml='';
//                 vhtml+= '<option value="">--- Seleccionar ---</option>';
//             for ( let vi=0; vi<vresponse.dependencias.length; vi++ ) {
//                 vhtml+= '<option value='+ vresponse.dependencias[vi].id +'>'+ vresponse.dependencias[vi].dependencia +'</option>';
//             }
//             $('#id_dependencia').html(vhtml);

//             if ( vdataSelect != 0 ) {
//                 $('#id_dependencia').val(vdataSelect).trigger('change');
//             }
//         },
//         error: function(vresponse) { }
//     });
//  }

function configTable()
 {
    jQuery.extend(!0, jQuery.fn.DataTable.defaults, {
        language: {
            lengthMenu: "_MENU_",
            search: "_INPUT_",
            searchPlaceholder: "Search..",
            info: "Pagina <strong>_PAGE_</strong> de <strong>_PAGES_</strong>",
            paginate: {
                first: '<i class="fa fa-angle-double-left"></i>',
                previous: '<i class="fa fa-angle-left"></i>',
                next: '<i class="fa fa-angle-right"></i>',
                last: '<i class="fa fa-angle-double-right"></i>'
            }
        }
    }),
    jQuery.extend(!0, jQuery.fn.DataTable.Buttons.defaults, {
        dom: {
            button: {
                className: "btn"
            }
        }
    }),
    jQuery(".js-dataTable-buttons").DataTable({
        pageLength: 30,
        searching: false,
        // dom: "Bfrtip",
        // autoWidth: !1,
        bLengthChange: false,
        buttons: [
            {
                extend: 'csv',
                text: '<i class="fa fa-file-csv" style="color:#fff;"></i><br/> <h5 class="fw-normal"> CSV </h5>',
                titleAttr: 'CSV',
                className: 'btn btn-info'
            },
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel" style="color:#fff;"></i><br /> <h5 class="fw-normal"> EXCEL </h5>',
                titleAttr: 'EXCEL',
                className: 'btn btn-success'
            },
            {
                extend: 'pdf',
                text: '<i class="fa fa-file-pdf" style="color:#fff;"></i><br /> <h5 class="fw-normal"> PDF </h5>',
                titleAttr: 'PDF',
                className: 'btn btn-danger'
            }
        ]
    });
 }

function configTableBasic(className='js-dataTable', searching=true)
 {
    let vhtml ='';
        vhtml+='<div class="alert alert-light alert-dismissible" role="alert">';
        vhtml+='    <h3 class="alert-heading h4 my-2">Lo sentimos !...</h3>';
        vhtml+='    <p class="mb-0">No se encontraron registros que mostrar.</p>';
        vhtml+='</div>';

    jQuery('.' + className).DataTable({
        pageLength: 30,
        bInfo: false,
        searching: searching,
        dom: "Bfrtip",
        language: {
            "emptyTable": vhtml,
            "zeroRecords": vhtml,
            lengthMenu: "_MENU_",
            search: "_INPUT_",
            searchPlaceholder: "Search..",
            info: "Pagina <strong>_PAGE_</strong> de <strong>_PAGES_</strong>",
            paginate: {
                first: '<i class="fa fa-angle-double-left"></i>',
                previous: '<i class="fa fa-angle-left"></i>',
                next: '<i class="fa fa-angle-right"></i>',
                last: '<i class="fa fa-angle-double-right"></i>'
            }
        }
    });
 }