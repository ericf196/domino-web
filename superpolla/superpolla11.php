<?php session_start();
// $_SESSION['IdNum']=1;
// $_SESSION['Puesto']=1;
$_SESSION['CantJue']=$_POST['CantJue']; //Cantidad de partidas a jugar

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.tdG{/*td de color gris*/
			background-color: #777;
			padding: 10px;
			border: solid;
			border-width: 1px;
		}
		.tdB{/*td de color Blanco*/
			background-color: #fff;
			padding: 1px;
			border: solid;
			border-width: 1px;
		}
		.tdV{/*td de  color verde*/
			background-color: #99ffcc;
			padding: 10px;
			border: solid;
			border-width: 1px;
		}
		.tdA{/*td de  color Amarillo*/
			background-color: #ffee00;
			padding: 10px;
			border: solid;
			border-width: 1px;
		}
		.tdN{/*td de  color Naranja*/
			background-color: #cc7700;
			padding: 10px;
			border: solid;
			border-width: 1px;
		}
		.Med90{
			width: 90%;
			font-size: 20px;
		}
		.nombreJG{
			width: 100%;
		}
		.PuntosC{
			color: red;
		}
		.PuntosF{
			color: green;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			
			<?php //cantidad de juegos Duplicados en bucle PHP
			for ($i=1; $i <= $_SESSION['CantJue'] ; $i++) { 
				echo '<td colspan="2" class="tdV">Juego '.$i.'</td>';
				}
			 ?>

			<td></td>
			<td></td>
		</tr>
		<tr>
			<td class="tdG">Pos.</td>
			<td class="tdG">Mesa</td>
			<td class="tdG"><span style="padding-right: 80px;"></span>Nombre<span style="padding-right: 80px;"></span></td>
			<td class="tdG">No.</td>
			<?php //cantidad de juegos Duplicados en bucle PHP
			for ($i=1; $i <= $_SESSION['CantJue'] ; $i++) { 
				echo '
					<td class="tdG" title="Puntos a Fabor.">F</td>
					<td class="tdG" title="Puntos en Contra.">C</td>
					';
				}
			 ?>
			<td class="tdV">J/G</td>
			<td class="tdG">Efec.</td>
		</tr>
		
		<tr id="AgregarFila">
		<td class="tdN"></td>
			<td class="tdG"></td>
			<td class="tdA"><input type="text" style="width: 100%;" id="AgregarReg" placeholder="Nuevo..." ></td>
			<td class="tdG" colspan="3"><button type="button">Guardar</button></td>
		</tr>
	</table>
	<hr>
	<table>
		<tr>
			<td class="tdG">Pos.</td>
			<td class="tdG"><span style="padding-right: 80px;"></span>Nombre y Apellido<span style="padding-right: 80px;"></span></td>
			<td class="tdV">J/J</td>
			<td class="tdV">J/G</td>
			<td class="tdV">J/P</td>
			<td class="tdV">PTOS +</td>
			<td class="tdV">PTOS -</td>
			<td class="tdV">AVE</td>
			<td class="tdG">Efec.</td>
			<td class="tdV">Pro</td>
			<td class="tdV">Z+</td>
			<td class="tdV">Pro</td>
		</tr>
		<tr id="AgregarFila2">
		</tr>
	</table>
</body>
<script type="text/javascript" src="jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	var CantJue=<?php echo $_SESSION['CantJue']; ?>;
	var PosLis=1;//posicion en la lista
	var IdNum=1;//posicion en la mesa
	var	Puesto=1;//puesto en la mesa

	$('#AgregarReg').click(function(){//Click para crear nuevo registro
		var Cant=$('.nombreJG').length;//busco la cantidad de input nombres que hay en la tabla
		if ($('#nombreJG'+Cant).val()!='') {//si el ultimo nombre y otros campos necesarios estan lleno creo otro 
			RegSupPol();
			// $.get('regSupPol.php',function(res){//envio la peticion al codigo
				/*$('#AgregarFila').before('<tr>'+res+'</tr>');
				$('#nombreJG'+(Cant+1)).focus();*/
			// });
		}else{
			//alert('campo vcio');
			$('#nombreJG'+Cant).focus();
		}
	});
	function RegSupPol(){
	PM=IdNum%4;//posicion en mesa
	 if (PM==1) {
		PosMesa=Puesto+"A";
	 }else if (PM==2) {
		PosMesa=Puesto+"B";
	 }else if (PM==3) {
		PosMesa=Puesto+"C";
	 }else if (PM==0) {
		PosMesa=Puesto+"D";
		Puesto++;//contador de 4 en 4
	 }
		TrIni='<tr id="TR'+IdNum+'"><td class="tdN">'+IdNum+'</td><td class="tdG">'+PosMesa+'</td><td class="tdA"><input type="text" name="nombreJG'+IdNum+'" class="nombre nombreJG" id="nombreJG'+IdNum+'" placeholder="Identificacion" IdNum="'+IdNum+'"></td><td class="tdG"><input type="text" name="No'+IdNum+'" class="No Med90" id="No'+IdNum+'" No="F'+IdNum+'" maxlength="3" placeholder="No."></td>';
		Bucle='';
		for (var i = 1; i <= CantJue; i++) {
			Bucle=Bucle+'<td class="tdB"><input type="text" name="PuntosF'+IdNum+'" class="numeros PuntosF Med90" id="PuntosF'+i+''+IdNum+'" placeholder="F'+i+'" maxlength="3" Conti="'+i+'" IdNum="'+IdNum+'"></td><td class="tdB"><input type="text" name="PuntosC'+i+''+IdNum+'" class="numeros PuntosC Med90" id="PuntosC'+i+''+IdNum+'" placeholder="C'+i+'" maxlength="3" Conti="'+i+'" IdNum="'+IdNum+'"></td>';
		}
		TrFin='<td class="tdV"><input type="number" class="JG Med90" id="JG'+IdNum+'" value="0" disabled></td><td class="tdG"><input type="number" class="Efec Med90" id="Efec'+IdNum+'" value="0" disabled></td></tr>';
		
	$('#AgregarFila').before(TrIni+Bucle+TrFin);//imprimo el nuevo registro
	$('#AgregarFila2').before('<tr id="posiciones'+IdNum+'"><td class="tdG">'+IdNum+'</td><td class="tdG"><span style="padding-right: 80px;"><input type="text" name="CnombreJG'+IdNum+'" id="CnombreJG'+IdNum+'" disabled></td><td class="tdV"><input type="number" class="Med90" id="CJJ'+IdNum+'" value="0" disabled></td><td class="tdV"><input type="number" class="Med90" id="CJG'+IdNum+'" value="0" disabled></td><td class="tdV"><input type="number" class="Med90" id="CJP'+IdNum+'" value="0" disabled></td><td class="tdV"><input type="number" class="Med90" id="PuntF'+IdNum+'" value="0" disabled></td><td class="tdV"><input type="number" class="Med90" id="PuntC'+IdNum+'" value="0" disabled></td><td class="tdV"><input type="number" class="Med90" id="AVE'+IdNum+'" value="0" disabled></td><td class="tdG"><input type="number" class="Med90" id="CEfec'+IdNum+'" value="0" disabled></td><td class="tdV"><input type="number" class="Med90" id="Pro1'+IdNum+'" value="0" disabled></td><td class="tdV"><input type="number" class="Med90" id="ZF'+IdNum+'" value="0" disabled></td><td class="tdV"><input type="number" class="Med90" id="Pro2'+IdNum+'" value="0" disabled></td>/tr>');
	$('#nombreJG'+IdNum).focus();//foco al nuevo registro a llenar 
	IdNum++;//incremento el numero de la lista en 1
	recargaCod();
	}
		function recargaCod(){//reinstancia de cod
				$('.numeros').on({//validacion numericos
				    "change": function (event) {
				        $(event.target).val(function (index, value ) {
				            return value.replace(/\D/g, "");
				        });
				        CuentaReg($(this).attr('Conti'),$(this).attr('IdNum'));
				    }

				});
				$('.nombre').on({//replicar
				    "change": function (event) {
				     $('#CnombreJG'+$(this).attr('IdNum')).val($(this).val());
				    }
				});
		};
	function CuentaReg(Conti,IdNum){
		CantJG=0;
		cont=1;
		CantEfec=0;
		JueJug=0;
		PuntF=0;
		PuntC=0;
		ZF=0;
		ZC=0;
		PuntoFinal=0;
		$(".numeros").each(function(){
			if($('#PuntosF'+cont+''+IdNum).val() && $('#PuntosC'+cont+''+IdNum).val()){
				if (parseInt($('#PuntosF'+cont+''+IdNum).val())>=100) {
					CantJG++;
				}
				if (parseInt($('#PuntosF'+cont+''+IdNum).val())==0) {
					ZC=1;
				}else if (parseInt($('#PuntosC'+cont+''+IdNum).val())==0) {
					ZF=1;
				}
					CantEfec=parseInt(CantEfec)+(parseInt($('#PuntosF'+cont+''+IdNum).val())-parseInt($('#PuntosC'+cont+''+IdNum).val()));
					PuntF=PuntF+parseInt($('#PuntosF'+cont+''+IdNum).val());
					PuntC=PuntC+parseInt($('#PuntosC'+cont+''+IdNum).val());
			JueJug++;
			}
			cont++;
		});
		$('#JG'+IdNum).val(CantJG);//juegos ganados
		$('#CJG'+IdNum).val(CantJG);
		$('#CJP'+IdNum).val(JueJug-CantJG);//juegos perdidos
		$('#Efec'+IdNum).val(CantEfec);//efecto causado
		$('#AVE'+IdNum).val(CantEfec);
		$('#CJJ'+IdNum).val(JueJug);//juegos jugados
		$('#CEfec'+IdNum).val(CantJG*1000/JueJug);//efect
		$('#PuntF'+IdNum).val(PuntF);//puntos+
		$('#PuntC'+IdNum).val(PuntC);//puntos-
		$('#Pro1'+IdNum).val(Math.round(PuntF/JueJug));//Pro1
		$('#ZF'+IdNum).val(ZF);//Z+
		$('#ZC'+IdNum).val(ZC);//Z-
		if (IdNum==1) {PuntoFinal=6;}else if(IdNum==2){PuntoFinal=5;}else if(IdNum==3){PuntoFinal=4;}else if(IdNum==4){PuntoFinal=3;}else if(IdNum==5){PuntoFinal=2.5;}else if(IdNum==6){PuntoFinal=2;}else if(IdNum==7){PuntoFinal=1.5;}else if(IdNum==8){PuntoFinal=1;}else if(IdNum==9){PuntoFinal=0.5;}
		$('#Pro2'+IdNum).val(1+(CantJG*2)+((JueJug-CantJG)*(-1))+(ZF*1)+PuntoFinal);//Z-

	}
</script>
</html>