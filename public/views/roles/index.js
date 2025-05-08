var table;

$(document).ready(
    function() {
        $('._roles').addClass('active');
        index();
    }
);

function index()
 {
    $.ajax({
        type: 'GET',
        url: vURL + '/api/roles',
        dataType: "JSON",
        data: {
            method: 'get'
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            var vrespuesta=vresponse.respuesta;
            var vhtml ='';
                vhtml+='<table class="table table-hover js-dataTable dataTable">';
                vhtml+='    <thead>';
                vhtml+='        <tr>';
                vhtml+='            <th><strong>#</strong></th>';
                vhtml+='            <th><strong>Nombre</strong></th>';
                vhtml+='            <th class="text-center"><strong>Accion</strong></th>';
                vhtml+='        </tr>';
                vhtml+='    </thead>';
                vhtml+='    <tbody>';
            for ( vi=0; vi<vrespuesta.length; vi++ ) { 
                vhtml+='        <tr>';             
                vhtml+='            <td><span class="badge bg-black-50">' + (vi + 1) + '</span></td>';
                vhtml+='            <td>' + vrespuesta[vi].name + '</td>';
                vhtml+='            <td class="text-center">';

                vhtml+='                <div class="dropdown">';
                vhtml+='                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">';
                vhtml+='                        ';
                vhtml+='                    </button>';
                vhtml+='                    <div class="dropdown-menu">';
                vhtml+='                        <a class="dropdown-item" href="'+ vURL +'/roles/'+ vrespuesta[vi].id +'">Detalles</a>';
                if ( _permissionEdit ) {
                    vhtml+='                    <a class="dropdown-item" href="'+ vURL +'/roles/'+ vrespuesta[vi].id +'/edit">Editar</a>';
                }
                if ( _permissionDelete ) {
                    vhtml+='                    <a class="dropdown-item" href="javascript:void(0)" onClick="confirmDestroy('+ vrespuesta[vi].id +')">Eliminar</a>';
                }
                vhtml+='                    </div>';
                vhtml+='                </div>';


                // vhtml+='                <div class="btn-group">';
                // vhtml+='                    <a href="'+ vURL + '/roles/'+ vrespuesta[vi].id +'" class="btn btn-sm btn-alt-secondary js-bs-tooltip-enabled" title="Detalles">';
                // vhtml+='                        <i class="fa fa-eye mr-5"></i>';
                // vhtml+='                    </a>';
                // if ( _permissionEdit == true ) {
                //     vhtml+='                <a href="'+ vURL + '/roles/'+ vrespuesta[vi].id +'/edit" class="btn btn-sm btn-alt-info js-bs-tooltip-enabled" title="Editar">';
                //     vhtml+='                    <i class="fa fa-pencil"></i>';
                //     vhtml+='                </a>';
                // }
                // if ( _permissionDelete == true ) {
                //     vhtml+='                <a href="#" onclick="confirmDestroy('+ vrespuesta[vi].id +')" class="btn btn-sm btn-alt-danger js-bs-tooltip-enabled" title="Eliminar">';
                //     vhtml+='                    <i class="fa fa-trash mr-5"></i>';
                //     vhtml+='                </a>';
                // }
                // vhtml+='                </div>';

                
                vhtml+='            </td>';                          
                vhtml+='        </tr>';
            }
                vhtml+='    </tbody>';
                vhtml+='</table>';

            $('.tbl-roles').html(vhtml);  
            configTableBasic();

            var _table = $('.dataTable').DataTable();
    
            $("#DataTables_Table_0_filter").hide();
            $('#search').on( 'keyup', 
                function () {
                    _table.search( this.value ).draw();
                    var buscar=document.getElementById("search").value;
                    if ( buscar != "" ) {
                        document.getElementById("search").style.border="1px solid #eee";
                    }
                    else {
                        document.getElementById("search").style.border="";
                    }
                }
            );
          
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });   
 }

function confirmDestroy(id_)
 {
    Swal.fire({
        title: "Esta seguro de eliminar el registro?",
        text: "Esta acción no se podra revertir!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Si, estoy seguro!",
        cancelButtonText: "No, estoy seguro!",
        reverseButtons: true
    }).then(function(result) {
        if (result.value) {         
            destroy(id_);  
        }
        else if (result.dismiss === "cancel") {
            Swal.fire("Cancelado", "La accion fue cancelada.", "error")
        }
    });      
}

function destroy(id_){   
   $.ajax({
        type: 'DELETE',
        url: vURL + '/roles/' + id_,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        dataType: "JSON",        
        success: function(vresponse, vtextStatus, vjqXHR) {            
            Swal.fire({
                icon: "success",
                title: "¡ Eliminado !",                
                text: vresponse.respuesta,
                showConfirmButton: false,
                timer: 1500
            })
            index();            
        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    }); 
}