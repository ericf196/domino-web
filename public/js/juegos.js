$(document).ready(function () {

    $(document).on('change', '.select', function () {

        var number = $('option:selected', this).attr('valopt');
        $(this).parent().parent().find("td:eq(3)").children().val(number);

        console.log($('option:selected', this).val());
        var selected = [];

        $(".select").each(function () {
            $(this).each(function () {
                if (($('option:selected', this).val())!=0) {
                    selected.push(($('option:selected', this).val()));
                    console.log(($('option:selected', this).val()));
                }
            });
        });

        $("option").prop("disabled", false);
        for (var index in selected) {
            $('option[value="' + selected[index] + '"]').prop("disabled", true);
        }
    });


    $(document).on('click', '#submit_tabla', function () {
        // $('#submit_tabla').click(function () {
        var myTab = document.getElementById('table_super_polla');

        var values = [];
        var currentRow = 0;
        var obj = '[';

        var header = 1;

        var rowLength = myTab.rows.length - 1;

        for (row = 1; row < rowLength; row++) {

            obj = obj + '{';
            var cellLength = myTab.rows[row].cells.length - 1;
            for (c = 1; c < myTab.rows[row].cells.length; c++) {
                var headers = myTab.rows.item(0).cells[header];
                var element = myTab.rows.item(row).cells[c];
                header++;
                obj = obj + '"' + headers.childNodes[0].value + '" : "' + element.childNodes[0].value + '"';
                console.log(element.childNodes[0].value);
                if (header <= cellLength) {
                    obj = obj + ','
                }
            }
            if (row != rowLength - 1) {
                obj = obj + '},';
                header = 1;
            } else {
                obj = obj + '}';
            }

        }
        obj = obj + ']';


        var div_resul = "notificacion_tabla";
        // $("#submit_tabla").attr("disabled", "disabled");

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // console.log(obj);
        $.ajax({
            // la URL para la petición
            url: '/sent_table',
            data: obj,
            type: 'POST',
            dataType: 'json',

            /*beforeSend: function () {
             $("#" + div_resul + "").html($("#cargador_empresa").html());
             $('button[type=submit]').attr("disabled", "disabled");
             },*/
            success: function (resul) {
                $("#" + div_resul + "").html(resul);
            },
            error: function (xhr, status) {
                $("#" + div_resul + "").html('Ha ocurrido un error, revise su conexion e intentelo nuevamente');
            },
            complete: function () {
                window.location.href = window.location.pathname;

                /*$('button[type=submit]').removeAttr("disabled");
                 $("#" + quien)[0].reset();*/
            }

        });
    });


    $(document).on("submit", ".formentrada_anun", function (e) {
        e.preventDefault();
        var idAnum = $(this).find('input[name="id_anun"]').val();
        var nombreform = $(this).attr("id");
        var varurl = $(this).attr("action");
        var div_resul = "notificacion_nueva_publicidad-" + idAnum;

        var formData = new FormData($("#" + nombreform + "")[0]);
        $.ajax({
            url: varurl,
            type: 'POST',
            // Form data
            data: formData,
            //necesario para subir archivos via ajax
            cache: false,
            contentType: false,
            processData: false,
            //mientras enviamos el archivo
            beforeSend: function () {
                //$("#submit_nueva_publicidad" + idAnum + "").attr("disabled", "disabled");
                $("#" + div_resul + "").html($("#cargador_empresa").html());
            },
            success: function (data) {
                $("#" + div_resul + "").html(data);
                setTimeout(ocultarDiv, 7000);
                //$("#submit_nueva_publicidad").removeAttr("disabled");
            },
            error: function (data) {
                alert("ha ocurrido un error" + data);

            }
        });

        function ocultarDiv() {
            $("#" + div_resul + "").html("");
        }

    })

});