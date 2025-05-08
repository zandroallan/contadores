$(document).ready(
    function () {
        // show_od();

        // $('.btn-sesion-conclude').attr('onClick', 'confirmConclude()');
        $('._grupos').addClass('active');

        index();
    }
);

function show_od()
 {
    $.ajax({
        type: 'GET',
        url: vURL + '/api/sesiones',
        dataType: "JSON",
        data: { 
            method: 'show',
            id_sesion: document.getElementById('id_sesion').value
        },
        success: function(vresponse, vtextStatus, vjqXHR) {
            $('._sesion').html(vresponse.sesion.descripcion);
            $('._dependencia').html(vresponse.sesion.dependencia);
            $('._fechaSesion').html(formatDate(vresponse.sesion.fecha));
            $('._fechaCarpeta').html(formatDate(vresponse.sesion.fecha_carpeta));
            
            let arrayIdOrdenDia=[];
            let _ordenDia=vresponse.orden_dia_padres;
            let _ordenDiaSelected=vresponse.orden_dia_selected;
            
            let vhtml ='';
            for ( var vi=0; vi<_ordenDiaSelected.length; vi++ ) {
                let iconSelect='';
                let esPadreClass='d-block fs-sm';
                if ( parseInt(_ordenDiaSelected[vi].id_padre) == 0 ) esPadreClass='fw-bold';                
                
                if ( parseInt(_ordenDiaSelected[vi].id_padre) > 0 ) {
                    $.each( _ordenDia, 
                        function( key, data ) {
                            if ( data.id == parseInt(_ordenDiaSelected[vi].id_padre) ) {
                                let _print_orden_dia_padre=true;
                                for ( var vj=0; vj<arrayIdOrdenDia.length; vj++ ) {
                                    if ( parseInt(arrayIdOrdenDia[vj]) == data.id ) {
                                        _print_orden_dia_padre=false;
                                    }
                                }

                                if ( _print_orden_dia_padre ) {
                                    vhtml+='    <div class="form-check form-block mb-2">';
                                    vhtml+='        <label class="form-check-label bg-body" for="orden_dia_'+ data.id +'">';
                                    vhtml+='            <span class="d-flex align-items-center">';
                                    vhtml+='                <span class="ms-2">';
                                    vhtml+='                    <i class="fa fa-angle-down ms-1 fs-base text-secondary"></i>';
                                    vhtml+='                    <span class="fw-bold">'+ iconSelect +' '+ data.inciso +' '+ data.orden_dia +'</span>';
                                    vhtml+='                </span>';
                                    vhtml+='            </span>';
                                    vhtml+='        </label>';
                                    vhtml+='    </div>';
                                }
                                arrayIdOrdenDia.push(data.id);
                            }
                            
                        }
                    );                    
                }

                let _colorIcon='warning';
                let _bgColorLabel='bg-warning-light';
                let _iconPuntoOrdenDia='hourglass-start';
                if ( _ordenDiaSelected[vi].id_status == 4 ) { _iconPuntoOrdenDia='circle-check'; _colorIcon='success'; _bgColorLabel='bg-success-light' }
                
                vhtml+='    <div class="form-check form-block mb-2">';
                vhtml+='        <label class="form-check-label '+ _bgColorLabel +'" for="orden_dia_'+ _ordenDiaSelected[vi].id +'">';
                vhtml+='            <span class="d-flex align-items-center">';
                vhtml+='                <span class="ms-2">';
                vhtml+='                    <span class="'+ esPadreClass +'">';
                vhtml+='                        <i class="fa fa-'+ _iconPuntoOrdenDia +' ms-1 fs-base text-'+ _colorIcon +'"></i>';
                // vhtml+='                        <a class="fw-semibold" href="'+ vURL +'/sesiones/od/'+ _ordenDiaSelected[vi].id +'/'+ _ordenDiaSelected[vi].type +'">';
                vhtml+=                              _ordenDiaSelected[vi].inciso +' '+ _ordenDiaSelected[vi].orden_dia;
                // vhtml+='                        </a>';
                vhtml+='                    </span>';
                vhtml+='                </span>';
                vhtml+='            </span>';
                vhtml+='        </label>';
                vhtml+='    </div>';
            }
                vhtml+='    <hr />';
            $('.div-orden-dia').html(vhtml);

        },
        error: function(vjqXHR, vtextStatus, verrorThrown){ }
    });
 }

function index()
 {
    $.ajax({
        type: 'GET',
        url: vURL + '/api/cursos',
        dataType: "JSON",
        data: {
            method: 'get',
            status: 1
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
        vhtml+='            <th>Cursos</th>';
        vhtml+='            <th class="text-center">';
        vhtml+='                <i class="fa fa-list"></i>';
        vhtml+='            </th>';
        vhtml+='        </tr>';
        vhtml+='    </thead>';
        vhtml+='    <tbody>';
    for ( vi=0; vi<datos.length; vi++ ) {
        vhtml+='        <tr class="tr-id_sesion-' + datos[vi].id + '">';
       
        vhtml+='            <td><b>' + (vi + 1) + '</b></td>';        
        vhtml+='            <td>';
        vhtml+='                <label for="chqb_select_'+ datos[vi].id +'" style="text-align: justify">';
        vhtml+='                    <b>' + datos[vi].curso + '</b><br />'+ datos[vi].descripcion;
        vhtml+='                </label>';
        vhtml+='            </td>';
        vhtml+='            <td class="text-center">';
        vhtml+=                 buttonAction(datos[vi]);
        vhtml+='            </td>';
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
    var vhtml ='';
        vhtml+='<div class="dropdown">';
        vhtml+='    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-expanded="false">';
        vhtml+='    </button>';
        vhtml+='    <div class="dropdown-menu">';
        vhtml+='                        <a class="dropdown-item" href="'+ vURL +'/sesiones/'+ data.id +'">Detalles</a>';       
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