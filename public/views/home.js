$(document).ready(
    function () {
        // index();
    
        $('._inicio').addClass('active');
    }
);

// function index()
//  {
//     $.ajax({
//         type: 'GET',
//         url: vURL + '/api/cursos/estadisticas',
//         dataType: "JSON",
//         data: {
//             method: 'get',
//             status: 1
//         },
//         success: function(vresponse, vtextStatus, vjqXHR) {
            
//             $('._all').html(vresponse.data_users_all);
//             $('._on').html(vresponse.data_users_on);
//             $('._off').html(vresponse.data_users_off);

//             tbl(vresponse.data);

//         },
//         error: function(vjqXHR, vtextStatus, verrorThrown){ }
//     });
//  }

// function tbl(datos)
//  {
//     var vhtml ='';
//         vhtml+='<table class="table table-hover js-dataTable dataTable">';
//         vhtml+='    <thead class="bg-thead">';
//         vhtml+='        <tr>';
//         vhtml+='            <th>#</th>';
//         vhtml+='            <th>Cursos</th>';
//         vhtml+='            <th class="text-center">';
//         vhtml+='                <i class="fa fa-signal"></i>';
//         vhtml+='            </th>';
//         vhtml+='        </tr>';
//         vhtml+='    </thead>';
//         vhtml+='    <tbody>';
//     for ( vi=0; vi<datos.length; vi++ ) {
//         vhtml+='        <tr class="tr-id_sesion-' + datos[vi].id + '">';
//         vhtml+='            <td><b>' + (vi + 1) + '</b></td>';     
//         vhtml+='            <td>';
//         vhtml+='                <label for="chqb_select_'+ datos[vi].id +'" style="text-align: justify">';
//         vhtml+='                    <b><a href="'+ vURL + '/home/' + datos[vi].id + '/show' +'">' + datos[vi].curso + '</b></a>';
//         vhtml+='                </label>';
//         vhtml+='            </td>';
//         vhtml+='            <td class="text-center">';
//         if ( datos[vi].ttl_inscritos != null ) {
//             vhtml+='            <b class="text-success">'+ datos[vi].ttl_inscritos +'</b>';
//         }
//         else {
//             vhtml+='            <b class="text-danger">'+ '0' +'</b>';
//         }
        
//         vhtml+='            </td>';
//         vhtml+='        </tr>';
//     }
//         vhtml+='    </tbody>';
//         vhtml+='</table>';

//     $('.tbl-cursos').html(vhtml);
//     configTableBasic();

//     var _table = $('.dataTable').DataTable();
    
//     $("#DataTables_Table_0_filter").hide();
//     $('#txt-search').on( 'keyup', 
//         function () {
//             _table.search( this.value ).draw();
//             var buscar=document.getElementById("txt-search").value;
//             if ( buscar != "" ) {
//                 document.getElementById("txt-search").style.border="1px solid #eee";
//             }
//             else {
//                 document.getElementById("txt-search").style.border="";
//             }
//         }
//     );
//  }