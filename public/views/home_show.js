$(document).ready(
    function () {    
        $('._inicio').addClass('active');
    }
);

function index(id_curso)
 {
    $.ajax({
        type: 'GET',
        url: vURL + '/api/cursos/users',
        dataType: "JSON",
        data: {
            method: 'get',
            id_curso: id_curso
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            var vdocumentacion=vresponse.usuarios;
            tableUsuarios(vresponse.data);
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
        vhtml+='            <th>Nombre</th>';
        vhtml+='            <th>Correo electrónico</th>';
        vhtml+='        </tr>';
        vhtml+='    </thead>';
        vhtml+='    <tbody>';
    for ( vi=0; vi<usuarios.length; vi++ ) {
        let _rutaImagen=vURL +'/template/image/user.jpg';
        if ( usuarios[vi].foto != null ) _rutaImagen=vURL + usuarios[vi].foto;

        vhtml+='        <tr class="_tr_'+ usuarios[vi].id +'">';
        vhtml+='            <td><span class="badge bg-black-50">' + (vi + 1) + '</span></td>';
        vhtml+='            <td class="fs-sm">';
        vhtml+='                <p class="fw-semibold mb-1"><b>'+ usuarios[vi].name +'</b><br /> '+ usuarios[vi].adscripcion +'</p>';
        vhtml+='            </td>';
        vhtml+='            <td class="fs-sm">' + usuarios[vi].email + '</td>';
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