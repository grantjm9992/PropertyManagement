<div id="{{ $gridId }}"></div>
<input type="text" hidden id="{{ $gridId }}_selectIds" value="{{ $selectIds }}">

<script>
function returnDateObject(string)
{
    var i = string.indexOf('-');
    var day = string.substring(0,i);
    string = string.slice(i+1);
    i = string.indexOf('-');
    var month = string.substring(0, i);
    string = string.slice(i+1);
    i = string.indexOf(' ');
    var year = string.substring(0, i);
    string = string.slice(i+1);
    i = string.indexOf(':');
    var hour = string.substring(0,i);
    var minute = string.slice(i+1);

    var date = new Date(year, month, day, hour, minute, 0, 0);
    return date;
}
    (function(jsGrid) {

        jsGrid.sortStrategies.fecha = function(value1, value2) {


            var d1 = returnDateObject(value2);
            var d2 = returnDateObject(value1);
            if ( d2 > d1 )
            {
                return 1;
            }
            else {
                return -1;
            }
        }

        jsGrid.locales.es = {
            grid: {
                noDataContent: "No encontrado",
                deleteConfirm: "¿Está seguro?",
                pagerFormat: "Páginas: {first} {prev} {pages} {next} {last} &nbsp;&nbsp; {pageIndex} de {pageCount}",
                pagePrevText: "Anterior",
                pageNextText: "Siguiente",
                pageFirstText: "Primero",
                pageLastText: "Último",
                loadMessage: "Por favor, espere...",
                invalidMessage: "¡Datos no válidos!"
            },

            loadIndicator: {
                message: "Cargando..."
            },

            fields: {
                control: {
                    searchModeButtonTooltip: "Cambiar a búsqueda",
                    insertModeButtonTooltip: "Cambiar a inserción",
                    editButtonTooltip: "Editar",
                    deleteButtonTooltip: "Suprimir",
                    searchButtonTooltip: "Buscar",
                    clearFilterButtonTooltip: "Borrar filtro",
                    insertButtonTooltip: "Insertar",
                    updateButtonTooltip: "Actualizar",
                    cancelEditButtonTooltip: "Cancelar edición"
                }
            },

            validators: {
                required: { message: "Campo requerido" },
                rangeLength: { message: "La longitud del valor está fuera del intervalo definido" },
                minLength: { message: "La longitud del valor es demasiado corta" },
                maxLength: { message: "La longitud del valor es demasiado larga" },
                pattern: { message: "El valor no se ajusta al patrón definido" },
                range: { message: "Valor fuera del rango definido" },
                min: { message: "Valor demasiado bajo" },
                max: { message: "Valor demasiado alto" }
            }
        };
        

    }(jsGrid, jQuery));
    $(document).ready( function() {
        $('#{{ $gridId }}').jsGrid({
            autoload: true,
            width: '{{ $ancho_tabla }}',
            height: '{{ $altura_tabla }}',
            sorting: true,
            paging: true,
            pageSize: '{{ $pageSize }}',
            fields: {!! $campos !!},
            data: {!! $data !!},
            rowClick: function(args) {
                var getData = args.item;
                var id = getData['{{ $dataID }}'];
                @if ( $detailURL != "" )
                    window.location = "{!! $detailURL !!}"+id;
                @endif
            },
            /*
                Función para arreglar el problema de seleccionar varias filas
            */
            onRefreshed: function(args) {
                var idString = $('#{{ $gridId }}_selectIds').val();
                var rows = $('#{{ $gridId }} [rowid]');
                for( var i = 0; i < rows.length; i++ )
                {
                    var id = $(rows[i]).attr('rowid');
                    if ( idString.includes( "@#"+id+"@#" ) )
                    {
                        $(rows[i]).prop('checked', true);
                    }
                    else
                    {
                        $(rows[i]).prop('checked', false);
                    }
                }
            }
        })
    });

    
            /*
                Función para arreglar el problema de seleccionar varias filas
            */
            $('#{{ $gridId }}').delegate('tr', 'click', function(e) {
            if (!$(e.target).is('input')) {               
                if ( $(this).find('[rowid]').is(':checked') )
                {
                    var id = $(this).find('[rowid]').attr('rowid');
                    var idString = $('#{{ $gridId }}_selectIds').val();
                    var new_string = idString.replace("@#"+id+"@#", "@#");
                    $('#{{ $gridId }}_selectIds').val(new_string);
                }
                else
                {
                    var id = $(this).find('[rowid]').attr('rowid');
                    var idString = $('#{{ $gridId }}_selectIds').val();
                    var new_string = idString+id+"@#";
                    $('#{{ $gridId }}_selectIds').val(new_string);                
                }
                $(this).find('[rowid]').prop('checked', function (i, value) {
                    return !value;
                }); 
            }
            else
            {
                if ( $(e.target).is(':checked') )
                {
                    var id = $(e.target).attr('rowid');
                    var idString = $('#{{ $gridId }}_selectIds').val();
                    var new_string = idString+id+"@#";
                    $('#{{ $gridId }}_selectIds').val(new_string);    
                }
                else
                {
                    var id = $(e.target).attr('rowid');
                    var idString = $('#{{ $gridId }}_selectIds').val();
                    var new_string = idString.replace("@#"+id+"@#", "@#");
                    $('#{{ $gridId }}_selectIds').val(new_string);
                }
            }
        });

        $(document).ready( function()
        {
            
            var idString = $('#{{ $gridId }}_selectIds').val();
            var rows = $('#{{ $gridId }} [rowid]');
            for( var i = 0; i < rows.length; i++ )
            {
                var id = $(rows[i]).attr('rowid');
                if ( idString.includes( "@#"+id+"@#" ) )
                {
                    $(rows[i]).prop('checked', true);
                }
                else
                {
                    $(rows[i]).prop('checked', false);
                }
            }
        })
</script>