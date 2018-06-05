function verinfo_usuario(arg) {


    var urlraiz = $("#url_raiz_proyecto").val();
    var miurl = urlraiz + "/form_editar_usuario/" + arg + "";
    $("#capa_modal").show();
    $("#capa_formularios").show();
    var screenTop = $(document).scrollTop();
    $("#capa_formularios").css('top', screenTop);
    $("#capa_formularios").html($("#cargador_empresa").html());

    $.ajax({
        url: miurl
    }).done(function (resul) {
        $("#capa_formularios").html(resul);

    }).fail(function () {
        $("#capa_formularios").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
    });

}

function verinfo_league(arg) {
    var urlraiz = $("#url_raiz_proyecto").val();
    var miurl = urlraiz + "/form_editar_league/" + arg + "";
    $("#capa_modal").show();
    $("#capa_formularios").show();
    var screenTop = $(document).scrollTop();
    $("#capa_formularios").css('top', screenTop);
    $("#capa_formularios").html($("#cargador_empresa").html());

    $.ajax({
        url: miurl
    }).done(function (resul) {
        $("#capa_formularios").html(resul);

    }).fail(function () {
        $("#capa_formularios").html('<span>... Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
    });

}
function verinfo_noticia(arg) {
    var urlraiz = $("#url_raiz_proyecto").val();
    var miurl = urlraiz + "/form_editar_noticia/" + arg + "";
    $("#capa_modal").show();
    $("#capa_formularios").show();
    var screenTop = $(document).scrollTop();
    $("#capa_formularios").css('top', screenTop);
    $("#capa_formularios").html($("#cargador_empresa").html());

    $.ajax({
        url: miurl
    }).done(function (resul) {
        $("#capa_formularios").html(resul);

    }).fail(function () {
        $("#capa_formularios").html('<span>... Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
    });

}


$(document).on("click", ".div_modal", function (e) {
    $(this).hide();
    $("#capa_formularios").hide();
    $("#capa_formularios").html("");
})


function cargar_formulario(arg) {
    var urlraiz = $("#url_raiz_proyecto").val();
    $("#capa_modal").show();
    $("#capa_formularios").show();
    var screenTop = $(document).scrollTop();
    $("#capa_formularios").css('top', screenTop);
    $("#capa_formularios").html($("#cargador_empresa").html());
    if (arg == 1) {
        var miurl = urlraiz + "/form_nuevo_usuario";
    }
    if (arg == 2) {
        var miurl = urlraiz + "/form_nuevo_rol";
    }
    if (arg == 3) {
        var miurl = urlraiz + "/form_nuevo_permiso";
    }
    if (arg == 4) {
        var miurl = urlraiz + "/form_nuevo_liga";
    }
    if (arg == 5) {
        var miurl = urlraiz + "/form_editar_perfil";
    }
    if (arg == 6) {
        var miurl = urlraiz + "/form_nuevo_noticia";
    }
    if (arg == 7) {
        var miurl = urlraiz + "/form_nuevo_administrador";
    }
    if (arg == 8) {
        var miurl = urlraiz + "/form_editar_league_admin";
    }
    if (arg == 9) {
        var miurl = urlraiz + "/form_nuevo_anun";
    }

    $.ajax({
        url: miurl
    }).done(function (resul) {
        $("#capa_formularios").html(resul);

    }).fail(function () {
        $("#capa_formularios").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
    });

}


$(document).on("submit", ".formentrada", function (e) {
    e.preventDefault();
    var quien = $(this).attr("id");
    var formu = $(this);
    var varurl = "";
    if (quien == "f_crear_usuario") {
        var varurl = $(this).attr("action");
        var div_resul = "notificacion_nuevo_ajax";
    }
    if (quien == "f_crear_rol") {
        var varurl = $(this).attr("action");
        var div_resul = "capa_formularios";
    }
    if (quien == "f_crear_permiso") {
        var varurl = $(this).attr("action");
        var div_resul = "capa_formularios";
    }
    if (quien == "f_editar_usuario") {
        var varurl = $(this).attr("action");
        var div_resul = "notificacion_E2";
    }
    if (quien == "f_editar_acceso") {
        var varurl = $(this).attr("action");
        var div_resul = "notificacion_E3";
    }
    if (quien == "f_editar_league") {
        var varurl = $(this).attr("action");
        var div_resul = "notificacion_resul_cil";
    }
    if (quien == "f_borrar_usuario") {
        var varurl = $(this).attr("action");
        var div_resul = "capa_formularios";
    }
    if (quien == "f_asignar_permiso") {
        var varurl = $(this).attr("action");
        var div_resul = "capa_formularios";
    }
    if (quien == "f_crear_liga") {
        var varurl = $(this).attr("action");
        var div_resul = "capa_formularios";
    }
    if (quien == "f_cambiar_password") {
        var varurl = $(this).attr("action");
        var div_resul = "notificacion_resul_cp";
    }
    if (quien == "f_editar_perfil") {
        var varurl = $(this).attr("action");
        var div_resul = "notificacion_resul_feu";
    }
    if (quien == "f_crear_administrador") {
        var varurl = $(this).attr("action");
        var div_resul = "notificacion_resul_admin";
    }


    $.ajax({
        // la URL para la petición
        url: varurl,
        data: formu.serialize(),
        type: 'POST',
        dataType: 'html',

        beforeSend: function () {
            $("#" + div_resul + "").html($("#cargador_empresa").html());
            $('button[type=submit]').attr("disabled", "disabled");
        },

        success: function (resul) {
            $("#" + div_resul + "").html(resul);
        },
        error: function (xhr, status) {
            $("#" + div_resul + "").html('Ha ocurrido un error, revise su conexion e intentelo nuevamente');
        },
        complete: function () {
            $('button[type=submit]').removeAttr("disabled");
            /* $("#" + quien)[0].reset();*/
        }

    });


})


function asignar_rol(idusu) {
    var idrol = $("#rol1").val();
    var urlraiz = $("#url_raiz_proyecto").val();
    $("#zona_etiquetas_roles").html($("#cargador_empresa").html());
    var miurl = urlraiz + "/asignar_rol/" + idusu + "/" + idrol + "";

    $.ajax({
        url: miurl
    }).done(function (resul) {
        var etiquetas = "";
        var roles = $.parseJSON(resul);
        $.each(roles, function (index, value) {
            etiquetas += '<span class="label label-warning">' + value + '</span> ';
        })

        $("#zona_etiquetas_roles").html(etiquetas);

    }).fail(function () {
        $("#zona_etiquetas_roles").html('<span style="color:red;">...Error: Aun no ha agregado roles o revise su conexion...</span>');
    });

}


function quitar_rol(idusu) {
    var idrol = $("#rol2").val();
    var urlraiz = $("#url_raiz_proyecto").val();
    $("#zona_etiquetas_roles").html($("#cargador_empresa").html());
    var miurl = urlraiz + "/quitar_rol/" + idusu + "/" + idrol + "";

    $.ajax({
        url: miurl
    }).done(function (resul) {
        var etiquetas = "";
        var roles = $.parseJSON(resul);
        $.each(roles, function (index, value) {
            etiquetas += '<span class="label label-warning" style="margin-left:10px;" >' + value + '</span> ';
        })

        $("#zona_etiquetas_roles").html(etiquetas);

    }).fail(function () {
        $("#zona_etiquetas_roles").html('<span style="color:red;">...Error: Aun no ha agregado roles  o revise su conexion...</span>');
    });

}


function borrado_usuario(idusu) {

    var urlraiz = $("#url_raiz_proyecto").val();
    $("#capa_modal").show();
    $("#capa_formularios").show();
    var screenTop = $(document).scrollTop();
    $("#capa_formularios").css('top', screenTop);
    $("#capa_formularios").html($("#cargador_empresa").html());
    var miurl = urlraiz + "/form_borrado_usuario/" + idusu + "";


    $.ajax({
        url: miurl
    }).done(function (resul) {
        $("#capa_formularios").html(resul);

    }).fail(function () {
        $("#capa_formularios").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
    });
}


function borrar_permiso(idrol, idper) {

    var urlraiz = $("#url_raiz_proyecto").val();
    var miurl = urlraiz + "/quitar_permiso/" + idrol + "/" + idper + "";
    $("#filaP_" + idper + "").html($("#cargador_empresa").html());
    $.ajax({
        url: miurl
    }).done(function (resul) {
        $("#filaP_" + idper + "").hide();

    }).fail(function () {
        alert("No se borro correctamente, intentalo nuevamente o revisa tu conexion");
    });


}

function borrar_rol(idrol) {

    var urlraiz = $("#url_raiz_proyecto").val();
    var miurl = urlraiz + "/borrar_rol/" + idrol + "";
    $("#filaR_" + idrol + "").html($("#cargador_empresa").html());
    $.ajax({
        url: miurl
    }).done(function (resul) {
        $("#filaR_" + idrol + "").hide();

    }).fail(function () {
        alert("No se borro correctamente, intentalo nuevamente o revisa tu conexion");
    });


}


$(document).on("submit", ".formarchivo", function (e) {

    e.preventDefault();
    var nombreform = $(this).attr("id");
    if (nombreform == "f_subir_imagen") {
        var varurl = $(this).attr("action");
        var div_resul = "notificacion_resul_fci";
    }
    if (nombreform == "f_subir_logo") {
        var varurl = $(this).attr("action");
        var div_resul = "notificacion_resul_logo";
    }
    if (nombreform == "f_subir_portada") {
        var varurl = $(this).attr("action");
        var div_resul = "notificacion_resul_portada";
    }
    //información del formulario
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
            $("#" + div_resul + "").html($("#cargador_empresa").html());
        },
        //una vez finalizado correctamente
        success: function (data) {
            $("#" + div_resul + "").html(data);
        },
        error: function (data) {
            alert("ha ocurrido un error");

        }
    });
});


$(document).on("submit", ".formentrada_noticias_liga", function (e) {
    e.preventDefault();
    var quien = $(this).attr("id");
    var formu = $(this);
    var varurl = "";
    if (quien == "f_nuevo_noticia") {
        var varurl = $(this).attr("action");
        var div_resul = "notificacion_nuevo_noticia";
        $("#submit_noticias_crear").attr("disabled", "disabled");
    }
    if (quien == "f_editar_noticia") {
        var varurl = $(this).attr("action");
        var div_resul = "notificacion_editar_noticia";
        $("#submit_editar_noticia").attr("disabled", "disabled");
    }

    //información del formulario
    var formData = new FormData($("#" + quien + "")[0]);
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
            $("#" + div_resul + "").html($("#cargador_empresa").html());
        },
        //una vez finalizado correctamente
        success: function (data) {
            $("#" + div_resul + "").html(data);

            if (quien == "f_editar_noticia") {
                $("#submit_noticias_crear").removeAttr("disabled");
            }
            if (quien == "f_editar_noticia") {
                $("#submit_editar_noticia").removeAttr("disabled");
            }
        },
        error: function (data) {
            alert("ha ocurrido un error" + data);

        }
    });

})

$(document).on("submit", ".submit_super_polla", function (e) {
    e.preventDefault();

    var quien = $(this).attr("id");
    var formu = $(this);
    var varurl = "";
    if (quien == "f_super_polla") {
        var varurl = $(this).attr("action");
        var div_resul = "game_super_polla";
        //$("#submit_noticias_crear").attr("disabled", "disabled");
    }

    $.ajax({
        url: varurl,
        type: 'POST',
        data: formu.serialize(),
        dataType: 'html',

        beforeSend: function () {
            $("#" + div_resul + "").html($("#cargador_empresa").html());
        },

        success: function (data) {
            $("#" + div_resul + "").html(data);

            /*if (quien == "f_editar_noticia") {
             $("#submit_noticias_crear").removeAttr("disabled");
             }*/
        },
        error: function (data) {
            alert("ha ocurrido un error" + data);

        }
    });
});


function borrado_anun(idanun) {

   // $("#capa_formularios").html($("#cargador_empresa").html());
    var div_resul = "notificacion_eliminar_anun";
    var urlraiz = $("#url_raiz_proyecto").val();
    var miurl = urlraiz + "/form_borrado_anun/" + idanun + "";

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: miurl,
        type: 'POST',
        dataType: 'html'
    }).done(function (resul) {
        $("#" + div_resul + "").html(resul);
        //setTimeout("alert('Boom!');", 9000);
        setTimeout(ocultarDiv, 7000);

    }).fail(function () {
        $("#" + div_resul + "").html('<span>...Ha ocurrido un error, revise su conexión y vuelva a intentarlo...</span>');
    });

    function  ocultarDiv(){
        $("#" + div_resul + "").html("");
        window.location.href = window.location.pathname;
    }

}

