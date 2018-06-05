<style type="text/css">
    body {
        color: #8b8b8b;
        font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
    }

    .tablecompl {
        border-spacing: 0px;
    }

    .tablecompl td, .tablecompl tr {
        border-bottom: 1px solid #ececec;
    }

    .tdG { /*td de color gris*/
        background-color: #eeeeee;
        padding: 8px;
    }

    .tdB { /*td de color Blanco*/
        background-color: #fff;
        padding: 1px;
    }

    .tdV { /*td de  color verde*/
        background-color: #3c8dbc;
        color: #fff;
        padding: 8px;
    }

    .tdA { /*td de  color Amarillo*/
        background-color: #fcf7af;
        padding: 8px;
    }

    .tdN { /*td de  color Naranja*/
        background-color: #ff9400;
        color: #fff;
        text-align: center;
    }

    .Med90 {
        width: 100%;
        font-size: 16px;
        text-align: center;
    }

    .nombreJG {
        width: 100%;
    }

    .PuntosC {
        color: red;
    }

    .PuntosF {
        color: green;
    }

    .rotate1 {
        display: inline-block;
        filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
        -webkit-transform: rotate(270deg);
        -ms-transform: rotate(270deg);
        transform: rotate(270deg);
    }

    .rotate2 {
        display: inline-block;
        filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
        -webkit-transform: rotate(-270deg);
        -ms-transform: rotate(-270deg);
        transform: rotate(-270deg);
    }

    .celdas:nth-child(odd) {
        background: #f9f9f9;
    }

    input {
        border: 0px solid #e8e8e8;
        background: transparent;
    }

    ::placeholder {
        color: #b7b7b7;
        opacity: 1;
    }

    :-ms-input-placeholder {
        color: #b7b7b7;
    }

    ::-ms-input-placeholder {
        color: #b7b7b7;
    }

    .px-2 {
        padding-right: 0.5rem !important;
        padding-left: 0.5rem !important;
    }

    .Posicion {
        background-color: #ff9400;
        color: #fff;
        text-align: center;
        padding: 12px;
        margin-left: 20px;
    }

    .Posicionnombre {
        background-color: #dde0e2;
        color: #808080;
        padding: 12px;
        line-height: 30px;
    }
</style>

<div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li id="home-tab" class="nav-item active">
            <a class="nav-link" data-toggle="tab" href="#juegoTab" role="tab">Juego</a>
        </li>
        <li id="profile-tab" class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#posicionTab" role="tab">Posicion de mesa </a>
        </li>
    </ul>


    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="juegoTab" role="tabpanel">
            <br>
            <script type="text/javascript">
                var juegos = $juegos;
            </script>

            <div class="table-responsive">
                <table class="tablecompl">
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        @for ($i = 0; $i < $juegos; $i++)
                            <td colspan="2" class="tdV">Juego {{$i+1}}</td>
                        @endfor
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="tdG">Pos.</td>
                        <td class="tdG">Mesa</td>
                        <td class="tdG"><span style="padding-right: 80px;"></span>Nombre<span
                                    style="padding-right: 80px;"></span>
                        </td>
                        <td class="tdG">No.</td>

                        @for ($i = 0; $i < $juegos; $i++)
                            <td class="tdG" title="Puntos a Fabor.">F</td>
                            <td class="tdG" title="Puntos en Contra.">C</td>
                        @endfor
                        <td class="tdV">J/G</td>
                        <td class="tdG">Avg.</td>
                    </tr>
                    <tr id="AgregarFila">
                        <td class="tdN"></td>
                        <td class="tdG"></td>
                        <td class="tdA"><input type="text" style="width: 100%;" id="AgregarReg" placeholder="Nuevo..."></td>
                        <td class="text-center" colspan="3">
                            <button type="button" id="BTNSig" onclick="reordenar(1)">Siguiente</button>
                        </td>
                    </tr>
                </table>
            </div>

            <br><br>
            <hr>
            <br><br>
            <div class="table-responsive">
                <table id="table_super_polla" class="tablecompl">
                    <tr>
                        <td class="tdG"><input class="input-min" type="text" value="Pos." readonly></td>
                        <td class="tdG" style="display:none;"><input class="input-min" type="text" value="IDJUGADOR" readonly></td> <!-- id del jugador -->
                        <td class="tdG"><input class="input-min" type="text" value="Nombre" readonly></td>
                        <td class="tdV"><input class="input-min" type="text" value="J/J" readonly></td>
                        <td class="tdV"><input class="input-min" type="text" value="J/G" readonly></td>
                        <td class="tdV"><input class="input-min" type="text" value="J/P" readonly></td>
                        <td class="tdV"><input class="input-min" type="text" value="PTOS P" readonly></td>
                        <td class="tdV"><input class="input-min" type="text" value="PTOS N" readonly></td>
                        <td class="tdV"><input class="input-min" type="text" value="AVG" readonly></td>
                        <td class="tdG"><input class="input-min" type="text" value="EFEC" readonly></td>
                        <td class="tdV"><input class="input-min" type="text" value="PRO" readonly></td>
                        <td class="tdV"><input class="input-min" type="text" value="Z" readonly></td>
                        <td class="tdV"><input class="input-min" type="text" value="PRO2" readonly></td>
                        <td class="tdG" style="display:none;"><input class="input-min" type="hidden" value="_token" readonly></td> <!-- prueba -->
                    </tr>
                    <tr id="AgregarFila2">
                    </tr>

                </table>
            </div>

            <div class="box-footer col-xs-12">
                <input id="submit_tabla" type="button" class="btn btn-primary" value="Guardar"/>
            </div>

        </div>
        <div class="tab-pane" id="posicionTab" role="tabpanel">
            <div>
                <br>
                <span id="AgregarFila4"></span>
                <br><br>
                <hr>
                <br><br>
                <span id="AgregarFila3"></span>

            </div>
        </div>

    </div>
</div>

<?php
    $optionNombre='<option value="0">--Seleccionar--</option>';
    foreach ($jugadores as $jugador){
        $optionNombre.= '<option valOpt="'.$jugador->id.'" value="'.$jugador->name.'">'.$jugador->name.'</option>';
    }

?>
<script>
    var optionNombre2 = '{!! $optionNombre !!} ';
</script>

<script type="text/javascript">
    var assetMesa = '{{ asset('img/mesa-domino.png') }}'
</script>

<script type="text/javascript">


    var CantJue = '<?php echo $juegos;?>';
    var PosLis = 1; //posicion en la lista
    var IdNum = 1;//posicion en la mesa
    var Puesto = 1;//puesto en la mesa

    $('#BTNSig').click(function(){
        $(".numeros").each(function(){
            if($('#PuntosF'+cont+''+IdNum).val() && $('#PuntosC'+cont+''+IdNum).val()){
                if (parseInt($('#PuntosF'+cont+''+IdNum).val())>=100) {
                    CantJG++;
                }
                if (parseInt($('#PuntosF'+cont+''+IdNum).val())==0) {
                    ZC++;
                }else if (parseInt($('#PuntosC'+cont+''+IdNum).val())==0) {
                    ZF++;
                }

                CantEfec=parseInt(CantEfec)+(parseInt($('#PuntosF'+cont+''+IdNum).val())-parseInt($('#PuntosC'+cont+''+IdNum).val()));
                PuntF=PuntF+parseInt($('#PuntosF'+cont+''+IdNum).val());
                PuntC=PuntC+parseInt($('#PuntosC'+cont+''+IdNum).val());
                JueJug++;
            }
            cont++;
        });
    });

    $('#AgregarReg').click(function () {//Click para crear nuevo registro
        var Cant = $('.nombreJG').length;//busco la cantidad de input nombres que hay en la tabla
        if ($('#nombreJG' + Cant).val() != '') {//si el ultimo nombre y otros campos necesarios estan lleno creo otro
            RegSupPol();
            // $.get('regSupPol.php',function(res){//envio la peticion al codigo
            /*$('#AgregarFila').before('<tr>'+res+'</tr>');
             $('#nombreJG'+(Cant+1)).focus();*/
            // });
        } else {
            //alert('campo vcio');
            $('#nombreJG' + Cant).focus();
        }
    });
    function RegSupPol(){
        for (var y =4; y > 0; y--) {
            PM=IdNum%4;//posicion en mesa
            if (PM==1) {
                PosMesa=Puesto+"A";
                $('#AgregarFila3').before('<table style="background-image: url(\'{{asset('img/mesa-domino.png')}}\'); background-size:100%; background-repeat: no-repeat; width: 300px; height: 300px; float: left;"><tr><td></td><td style="text-align: center;"><h3><span type="text" id="Sillanombre'+IdNum+'"></span><br> '+Puesto+'A</h3></td><td></td></tr><tr >	<td style="text-align: center;"><h3 class="rotate1"><span type="text" id="Sillanombre'+(IdNum+1)+'"></span><br> '+Puesto+'B</h3></td>	<td ></td>	<td style="text-align: center;"><h3 class="rotate2"><span type="text" id="Sillanombre'+(IdNum+3)+'"></span><br> '+Puesto+'D</h3></td></tr><tr>	<td></td>	<td style="text-align: center;"><h3><span type="text" id="Sillanombre'+(IdNum+2)+'"></span><br> '+Puesto+'C</h3></td>	<td></td></tr></table>');

                $('#AgregarFila4').before('<div class="contentMesas"><div class="mesaNombre"><span class="Posicion">'+Puesto+'A </span><span class="Posicionnombre" id="Snombre'+IdNum+'"></span></div> <div class="mesaNombre"><span class="Posicion">'+Puesto+'B </span> <span class="Posicionnombre" id="Snombre'+(IdNum+1)+'"></span></div> <div class="mesaNombre"><span  class="Posicion">'+Puesto+'C </span><span class="Posicionnombre" id="Snombre'+(IdNum+2)+'"></span></div> <div class="mesaNombre"><span  class="Posicion">'+Puesto+'D </span><span class="Posicionnombre" id="Snombre'+(IdNum+3)+'"></span></div></div>');
            }else if (PM==2) {
                PosMesa=Puesto+"B";
            }else if (PM==3) {
                PosMesa=Puesto+"C";
            }else if (PM==0) {
                PosMesa=Puesto+"D";
                Puesto++;//contador de 4 en 4
            }
            // TrIni='<tr class="celdas TablaPrin" id="TR'+IdNum+'"><td class="tdN">'+IdNum+'</td><td class="tdG">'+PosMesa+'</td><td class="px-2"><input type="text" name="nombreJG'+IdNum+'" class="nombre nombreJG" id="nombreJG'+IdNum+'" placeholder="Identificacion" IdNum="'+IdNum+'"></td><td class="tdG"><input type="text" name="No'+IdNum+'" class="No Med90" id="No'+IdNum+'" No="F'+IdNum+'" maxlength="3" placeholder="No."></td>';
            TrIni='<tr class="celdas TablaPrin" id="TR'+IdNum+'"><td class="tdN">'+IdNum+'</td><td class="tdG">'+PosMesa+'</td><td class="px-2"><select id="nombreJG'+IdNum+'" IdNum="'+IdNum+'" name="nombreJG'+IdNum+'" class="nombre cienPor">'+ optionNombre2 +'</select></td><td class="tdG"><input type="text" name="No'+IdNum+'" class="No Med90" id="No'+IdNum+'" No="F'+IdNum+'" maxlength="3" placeholder="No." readonly></td>';
            Bucle='';
            for (var i = 1; i <= CantJue; i++) {
                Bucle=Bucle+'<td><input type="text" name="PuntosF'+IdNum+'" class="numeros PuntosF Med90" id="PuntosF'+i+''+IdNum+'" placeholder="F'+i+'" maxlength="3" Conti="'+i+'" IdNum="'+IdNum+'"></td><td><input type="text" name="PuntosC'+i+''+IdNum+'" class="numeros PuntosC Med90" id="PuntosC'+i+''+IdNum+'" placeholder="C'+i+'" maxlength="3" Conti="'+i+'" IdNum="'+IdNum+'"></td>';
            }
            TrFin='<td class="tdV"><input type="text" class="JG Med90" id="JG'+IdNum+'" value="0" disabled></td><td class="tdG"><input type="text" class="Efec Med90" id="Efec'+IdNum+'" value="0" readonly></td></tr>';

            $('#AgregarFila').before(TrIni+Bucle+TrFin);//imprimo el nuevo registro
            //$('#AgregarFila2').before('<tr class="celdas" id="posiciones'+IdNum+'"><td>'+IdNum+'</td><td><span style="padding-right: 80px;"><input type="text" name="CnombreJG'+IdNum+'" id="CnombreJG'+IdNum+'" disabled></td><td><input type="number" class="Med90" id="CJJ'+IdNum+'" value="0" disabled></td><td><input type="number" class="Med90" id="CJG'+IdNum+'" value="0" disabled></td><td><input type="number" class="Med90" id="CJP'+IdNum+'" value="0" disabled></td><td><input type="number" class="Med90" id="PuntF'+IdNum+'" value="0" disabled></td><td><input type="number" class="Med90" id="PuntC'+IdNum+'" value="0" disabled></td><td><input type="number" class="Med90" id="AVE'+IdNum+'" value="0" disabled></td><td class="tdG"><input type="number" class="Med90" id="CEfec'+IdNum+'" value="0" disabled></td><td><input type="number" class="Med90" id="Pro1'+IdNum+'" value="0" disabled></td><td><input type="number" class="Med90" id="ZF'+IdNum+'" value="0" disabled></td><td><input type="number" class="Med90" id="Pro2'+IdNum+'" value="0" disabled></td>/tr>');
            $('#AgregarFila2').before('<tr class="celdas" id="posiciones'+IdNum+'"><td>'+IdNum+'</td><td class="tdG" style="display:none;"><input name="CnombreId'+IdNum+'" id="CnombreId'+IdNum+'" class="input-min" type="text" readonly></td><td><span style="padding-right: 80px;"><input type="text" name="CnombreJG'+IdNum+'" id="CnombreJG'+IdNum+'" readonly></td><td><input type="number" class="Med90" id="CJJ'+IdNum+'" value="0" readonly></td><td><input type="number" class="Med90" id="CJG'+IdNum+'" value="0" readonly></td><td><input type="number" class="Med90" id="CJP'+IdNum+'" value="0" readonly></td><td><input type="number" class="Med90" id="PuntF'+IdNum+'" value="0" readonly></td><td><input type="number" class="Med90" id="PuntC'+IdNum+'" value="0" readonly></td><td><input type="number" class="Med90" id="AVE'+IdNum+'" value="0" readonly></td><td class="tdG"><input type="number" class="Med90" id="CEfec'+IdNum+'" value="0" readonly></td><td><input type="number" class="Med90" id="Pro1'+IdNum+'" value="0" readonly></td><td><input type="number" class="Med90" id="ZF'+IdNum+'" value="0" readonly></td><td><input type="number" class="Med90" id="Pro2'+IdNum+'" value="0" readonly></td><td><input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>" readonly></td></tr>');

            IdNum++;//incremento el numero de la lista en 1
        };
        $('#nombreJG'+(parseInt(IdNum)-parseInt(4))).focus();//foco al nuevo registro a llenar
        recargaCod();
    }

    function recargaCod() {//reinstancia de cod
        $('.numeros').on({//validacion numericos
            "change": function (event) {
                $(event.target).val(function (index, value) {
                    return value.replace(/\D/g, "");
                });
                if (($(this).attr('IdNum') % 4) == 1) {
                    autoCompletado($(this).attr('Conti'), $(this).attr('IdNum'))
                }
                CuentaReg($(this).attr('Conti'), $(this).attr('IdNum'));
            }

        });
        $('.nombre').on({//replicar
            "change": function (event) {
                //console.log( $(this).attr('IdNum') );
                //$('#CnombreJG' + $(this).attr('IdNum')).val( $(this).text() + " " );
                var str = "";
                var str1 = "";
                $( '#nombreJG' + $(this).attr('IdNum') + ' option:selected' ).each(function() { str += $( this ).text() + ''; str1 += $( this ).attr('valOpt') + ''; });
                $('#CnombreJG' + $(this).attr('IdNum') ).val( str );
                $('#CnombreId' + $(this).attr('IdNum') ).val( str1 );
                $('#No' + $(this).attr('IdNum') ).val( str1 );
                $('#Sillanombre' + $(this).attr('IdNum')).text($(this).val());
                $('#Snombre' + $(this).attr('IdNum')).text($(this).val());//Si se quiere mostrar el nombre
                // $('#Snombre'+$(this).attr('IdNum')).text($("#No"+$(this).attr('IdNum')).val());//Si se quiere mostrar el no
            }
        });

    };

    function CuentaReg(Conti, IdNum) {
        // alert(Conti+','+IdNum);
        CantJG = 0;
        cont = 1;
        CantEfec = 0;
        JueJug = 0;
        PuntF = 0;
        PuntC = 0;
        ZF = 0;
        ZC = 0;
        PuntoFinal = 0;
        $(".numeros").each(function () {
            if ($('#PuntosF' + cont + '' + IdNum).val() && $('#PuntosC' + cont + '' + IdNum).val()) {
                if (parseInt($('#PuntosF' + cont + '' + IdNum).val()) >= 100) {
                    CantJG++;
                }
                if (parseInt($('#PuntosF' + cont + '' + IdNum).val()) == 0) {
                    ZC++;
                } else if (parseInt($('#PuntosC' + cont + '' + IdNum).val()) == 0) {
                    ZF++;
                }

                CantEfec = parseInt(CantEfec) + (parseInt($('#PuntosF' + cont + '' + IdNum).val()) - parseInt($('#PuntosC' + cont + '' + IdNum).val()));
                PuntF = PuntF + parseInt($('#PuntosF' + cont + '' + IdNum).val());
                PuntC = PuntC + parseInt($('#PuntosC' + cont + '' + IdNum).val());
                JueJug++;
            }
            cont++;
        });
        $('#JG' + IdNum).val(CantJG);//juegos ganados
        $('#CJG' + IdNum).val(CantJG);
        $('#CJP' + IdNum).val(JueJug - CantJG);//juegos perdidos
        $('#Efec' + IdNum).val(CantEfec);//efecto causado
        $('#AVE' + IdNum).val(CantEfec);
        $('#CJJ' + IdNum).val(JueJug);//juegos jugados
        $('#CEfec' + IdNum).val(CantJG * 1000 / JueJug);//efect
        $('#PuntF' + IdNum).val(PuntF);//puntos+
        $('#PuntC' + IdNum).val(PuntC);//puntos-
        $('#Pro1' + IdNum).val(Math.round(PuntF / JueJug));//Pro1
        $('#ZF' + IdNum).val(ZF);//Z+
        $('#ZC' + IdNum).val(ZC);//Z-
        if (IdNum == 1) {
            PuntoFinal = 6;
        } else if (IdNum == 2) {
            PuntoFinal = 5;
        } else if (IdNum == 3) {
            PuntoFinal = 4;
        } else if (IdNum == 4) {
            PuntoFinal = 3;
        } else if (IdNum == 5) {
            PuntoFinal = 2.5;
        } else if (IdNum == 6) {
            PuntoFinal = 2;
        } else if (IdNum == 7) {
            PuntoFinal = 1.5;
        } else if (IdNum == 8) {
            PuntoFinal = 1;
        } else if (IdNum == 9) {
            PuntoFinal = 0.5;
        }
        $('#Pro2' + IdNum).val(1 + (CantJG * 2) + ((JueJug - CantJG) * (-1)) + (ZF * 1) + PuntoFinal);//Z-
    }


    function reordenar(vCon) {
        var Con = 0;
        var Mayor = -10000;
        var PerMayor = 0;
        $(".TablaPrin").each(function () {
            Con++;
            if (Con >= vCon) {
                //if (Mayor<parseInt($("#Efec"+Con).val())) {
                if (Mayor < ((parseInt($("#CJG" + Con).val()) * 100) % parseInt($("#CJJ" + Con).val())) + parseInt($("#Pro1" + Con).val()) + parseInt($("#AVE" + Con).val())) {
                    // alert($("#Efec"+Con).val());
                    // alert(Mayor);
                    //alert(Math.round(((parseInt($("#CJG"+Con).val())*100)%parseInt($("#CJJ"+Con).val()))+parseInt($("#Pro1"+Con).val())+parseInt($("#AVE"+Con).val())));
                    Mayor = Math.round(((parseInt($("#CJG" + Con).val()) * 100) % parseInt($("#CJJ" + Con).val())) + parseInt($("#Pro1" + Con).val()) + parseInt($("#AVE" + Con).val()));
                    PerMayor = Con;
                }
            }
        });
        // alert(vCon+"/"+Con+"/"+PerMayor);
        CJJ = $("#CJJ" + vCon).val();
        CJG = $("#CJG" + vCon).val();
        CJP = $("#CJP" + vCon).val();
        PuntF = $("#PuntF" + vCon).val();
        PuntC = $("#PuntC" + vCon).val();
        AVE = $("#AVE" + vCon).val();
        Med9 = $("#Med9" + vCon).val();
        Pro1 = $("#Pro1" + vCon).val();
        ZF = $("#ZF" + vCon).val();
        Pro2 = $("#Pro2" + vCon).val();

        $("#CJJ" + vCon).val($("#CJJ" + PerMayor).val());
        $("#CJG" + vCon).val($("#CJG" + PerMayor).val());
        $("#CJP" + vCon).val($("#CJP" + PerMayor).val());
        $("#PuntF" + vCon).val($("#PuntF" + PerMayor).val());
        $("#PuntC" + vCon).val($("#PuntC" + PerMayor).val());
        $("#AVE" + vCon).val($("#AVE" + PerMayor).val());
        $("#Med9" + vCon).val($("#Med9" + PerMayor).val());
        $("#Pro1" + vCon).val($("#Pro1" + PerMayor).val());
        $("#ZF" + vCon).val($("#ZF" + PerMayor).val());
        $("#Pro2" + vCon).val($("#Pro2" + PerMayor).val());

        $("#CJJ" + PerMayor).val(CJJ);
        $("#CJG" + PerMayor).val(CJG);
        $("#CJP" + PerMayor).val(CJP);
        $("#PuntF" + PerMayor).val(PuntF);
        $("#PuntC" + PerMayor).val(PuntC);
        $("#AVE" + PerMayor).val(AVE);
        $("#Med9" + PerMayor).val(Med9);
        $("#Pro1" + PerMayor).val(Pro1);
        $("#ZF" + PerMayor).val(ZF);
        $("#Pro2" + PerMayor).val(Pro2);

        Efec = $("#Efec" + vCon).val();
        JG = $("#JG" + vCon).val();
        nombreJG = $("#nombreJG" + vCon).val();
        No = $("#No" + vCon).val();
        PuntosF1 = $("#PuntosF1" + vCon).val();
        PuntosC1 = $("#PuntosC1" + vCon).val();
        PuntosF2 = $("#PuntosF2" + vCon).val();
        PuntosC2 = $("#PuntosC2" + vCon).val();
        PuntosF3 = $("#PuntosF3" + vCon).val();
        PuntosC3 = $("#PuntosC3" + vCon).val();
        PuntosF4 = $("#PuntosF4" + vCon).val();
        PuntosC4 = $("#PuntosC4" + vCon).val();
        PuntosF5 = $("#PuntosF5" + vCon).val();
        PuntosC5 = $("#PuntosC5" + vCon).val();

        $("#Efec" + vCon).val($("#Efec" + PerMayor).val());
        $("#JG" + vCon).val($("#JG" + PerMayor).val());
        $("#nombreJG" + vCon).val($("#nombreJG" + PerMayor).val());
        $("#No" + vCon).val($("#No" + PerMayor).val());
        $("#PuntosF1" + vCon).val($("#PuntosF1" + PerMayor).val());
        $("#PuntosC1" + vCon).val($("#PuntosC1" + PerMayor).val());
        $("#PuntosF2" + vCon).val($("#PuntosF2" + PerMayor).val());
        $("#PuntosC2" + vCon).val($("#PuntosC2" + PerMayor).val());
        $("#PuntosF3" + vCon).val($("#PuntosF3" + PerMayor).val());
        $("#PuntosC3" + vCon).val($("#PuntosC3" + PerMayor).val());
        $("#PuntosF4" + vCon).val($("#PuntosF4" + PerMayor).val());
        $("#PuntosC4" + vCon).val($("#PuntosC4" + PerMayor).val());
        $("#PuntosF5" + vCon).val($("#PuntosF5" + PerMayor).val());
        $("#PuntosC5" + vCon).val($("#PuntosC5" + PerMayor).val());

        $("#Efec" + PerMayor).val(Efec);
        $("#JG" + PerMayor).val(JG);
        $("#nombreJG" + PerMayor).val(nombreJG);
        $("#No" + PerMayor).val(No);
        $("#PuntosF1" + PerMayor).val(PuntosF1);
        $("#PuntosC1" + PerMayor).val(PuntosC1);
        $("#PuntosF2" + PerMayor).val(PuntosF2);
        $("#PuntosC2" + PerMayor).val(PuntosC2);
        $("#PuntosF3" + PerMayor).val(PuntosF3);
        $("#PuntosC3" + PerMayor).val(PuntosC3);
        $("#PuntosF4" + PerMayor).val(PuntosF4);
        $("#PuntosC4" + PerMayor).val(PuntosC4);
        $("#PuntosF5" + PerMayor).val(PuntosF5);
        $("#PuntosC5" + PerMayor).val(PuntosC5);
        //Modificando tabla 2 y silla

        $('#CnombreJG' + vCon).val($("#nombreJG" + vCon).val());
        $('#Sillanombre' + vCon).text($("#nombreJG" + vCon).val());
//$('#Snombre'+vCon).text($("#No"+vCon).val());//si se quiere mostrar el no
        $('#Snombre' + vCon).text($("#nombreJG" + vCon).val());//Si se quiere mostrar el nombre
//CuentaReg($("#PuntosF1"+vCon).attr('Conti'),$("#PuntosF1"+vCon).attr('IdNum'));




        if (Con > vCon) {
            vCon++;
            reordenar(vCon);
        }
    }


    function autoCompletado(C, N) {
        $("#PuntosF" + C + "" + N).val();
        $("#PuntosC" + C + "" + N).val();

        $("#PuntosF" + C + "" + Math.round(parseInt(N) + parseInt(1))).val($("#PuntosC" + C + "" + N).val());
        $("#PuntosC" + C + "" + Math.round(parseInt(N) + parseInt(1))).val($("#PuntosF" + C + "" + N).val());
        CuentaReg("", $("#PuntosF1" + Math.round(parseInt(N) + parseInt(1))).attr('IdNum'));
        $("#PuntosF" + C + "" + Math.round(parseInt(N) + parseInt(2))).val($("#PuntosF" + C + "" + N).val());
        $("#PuntosC" + C + "" + Math.round(parseInt(N) + parseInt(2))).val($("#PuntosC" + C + "" + N).val());
        CuentaReg("", $("#PuntosF1" + Math.round(parseInt(N) + parseInt(2))).attr('IdNum'));
        $("#PuntosF" + C + "" + Math.round(parseInt(N) + parseInt(3))).val($("#PuntosC" + C + "" + N).val());
        $("#PuntosC" + C + "" + Math.round(parseInt(N) + parseInt(3))).val($("#PuntosF" + C + "" + N).val());
        CuentaReg("", $("#PuntosF1" + Math.round(parseInt(N) + parseInt(3))).attr('IdNum'));

    }



</script>


<script src="{{asset('js/juegos.js')}}"></script>

