<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>jQuery UI Example Page</title>
		<link type="text/css" href="jqueryui/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="jqueryui/js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="jqueryui/js/jquery-ui-1.8.16.custom.min.js"></script>
        <script language="javascript" src="js/jquery.timers-1.0.0.js"></script> 
		
		<script type="text/javascript">
			$(function(){

				// Dialogo de situacion del dia width: 315, 				height: 230,			
				$('#dialog_st_dia').dialog({
					autoOpen: true,	
					width: 315,				
					resizable: false
					
				});
				
				
				$('#dialog_Buque').dialog({
					autoOpen: true,	
					width: 315,				
					resizable: false,
					buttons: { "Ver mas": function() { $(this).dialog({height: 600,  }); }, 
					"Ocultar": function() { $(this).dialog({height: 250, }); } }
					
				});
				
				$("#dialog_st_dia").dialog('option', 'position', [20,10]); 
				
				// Dialogo de Buques
				$('#dialog_buques').dialog({
					autoOpen: true,
					width: 400
					
				});
				
				// Dialogo de historico
				$('#dialog_historico').dialog({
					autoOpen: true,
					width: 400
					
				});
				
				// Dialogo actividad reciente
				$('#dialog_act_reci').dialog({
					autoOpen: true,
					width: 325
					
				});
				
				// Dialog Link
				$('#dialog_link').click(function(){
					$('#dialog_st_dia').dialog('open');
					return false;
				});

		
				
			});
		</script>
      
		<style type="text/css">
			/*demo page css*/
			body{ font: 62.5% "Trebuchet MS", sans-serif; margin: 50px;}
			.demoHeaders { margin-top: 2em; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
		</style>	
    
     <style type="text/css">   
        tr:hover{
   			 background-color: #FFFFCC; /* amarillo */
		}
    
	</style>		


	</head>
	<body background="images/background.png">
	<h1>&nbsp;</h1>
	<div id="tabs"> </div>
<?php	
    include("bd/conexion.php");
	$conex=conectarse();
	//<p><a href="#" id="dialog_link" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>Open Dialog</a></p>
?>
	<!-- Dialog NOTE: Dialog is not generated by UI in this demo so it can be visually styled in themeroller-->
		
		<!-- Ventana de situacion del dia de mercancia -->
		<div id="dialog_st_dia" title="Situaci?n General del dia">
		  	
            <p>
			<div ><label><a href="diarial.php">Situaci?n General del dia</a></label>
		    <table width="300" height="17" border="0" cellpadding="0" cellspacing="0" >
              <tr>
                <td width="110">Producto</td>
                <td width="102">Manifestado(KG)</td>
                <td width="90">Pesado(KG)</td>
              </tr>
               <?php
			  	
			  	$cont=0;
				$sql = "SP_SITUACION_GENERAL";
				$rs=odbc_exec($conex,$sql)or die(exit("Error en odbc_exec"));
				while ( odbc_fetch_row($rs) )  
				{ 
					$ds_producto=odbc_result($rs,"ds_producto");
					$sumatoria=odbc_result($rs,"sumatoria");
					$pesada=odbc_result($rs,"pesada");
					if ($cont%2!=0)
						echo(" <tr><td>$ds_producto</td><td>".number_format($sumatoria, 2, ",", ".")."</td><td>".number_format($pesada, 2, ",", ".")."</td> </tr>");
					else
						echo(" <tr><td id=\"azul\">$ds_producto</td><td id=\"azul\">".number_format($sumatoria, 2, ",", ".")."</td><td id=\"azul\">".number_format($pesada, 2, ",", ".")."</td> </tr>");
					$cont++;
				}
				
			?>
            </table>
		    </div>
            
            </p>
		</div>
		
        
        <!--Ventana de Buques en operaicon  
		<div id="dialog_st_dia" title="Buques en operaci?n">
		  	
            <p>
			<div >
	 <?php
				if (isset($_GET['id_buque']))
					$id_buque2=$_GET['id_buque'];
				else
					$id_buque2=0;	
				$sql = "exec SP_BUQUE";
				$rs=odbc_exec($conex,$sql)or die(exit("Error en odbc_exec"));
				while ( odbc_fetch_row($rs) )
				{ 
					$nb_buque=odbc_result($rs,"nb_buque");
					$nb_muelle=odbc_result($rs,"nb_muelle");
					$atraque=odbc_result($rs,"fecha_hora_real_atraque");
					$id_buque=odbc_result($rs,"id_buque");
					if($id_buque==$id_buque2)
						$class="\"current\"";
					else
						$class="";
					echo("<li><span class=$class><a href=\"javascript:void(0);\" id=\"link-opciones\">$nb_buque</a></span>");
					echo("<ul>");
					echo("<li><a href=\"#\" class=\"bullet\">Muelle: $nb_muelle</a></li>");
					echo("<li><a href=\"#\" class=\"bullet\">Atraque: $atraque</a></li>");
					echo("<li><a href=\"today.php?id_buque=$id_buque\" class=\"bullet\">Detalles del D?a</a></li>");
					echo("<li><a href=\"today.php?id_buque=$id_buque&link=graficajquery/examples/grafica.php\" class=\"bullet\">Graficas</a></li>");
					echo("</ul></li>");
				}
			?>
		    </div>
            
            </p>
		</div>	-->
		
        <!-- Ventana de situacion del dia de buques ROB -->
		<div id="dialog_buques" title="Buques">
		  	
         <label><a href="buques.php?cerrar=0">Buques</a></label>
			<div align="center">
				<table width="300" height="17" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="110">Buque</td>
                <td width="102">Muelle</td>
                <td width="90">Atraque</td>
              </tr>
               <?php
			  	
			  	$cont=0;
				$sql = "SP_BUQUES";
				$rs=odbc_exec($conex,$sql)or die(exit("Error en odbc_exec"));
				while ( odbc_fetch_row($rs) )  
				{ 
					$nb_buque=odbc_result($rs,"nb_buque");
					$nb_muelle=odbc_result($rs,"nb_muelle");
					$atraque=odbc_result($rs,"atraque");
					if ($cont%2!=0)
						echo(" <tr><td>$nb_buque</td><td>$nb_muelle</td><td>$atraque</td> </tr>");
					else
						echo(" <tr><td id=\"azul\">$nb_buque</td><td id=\"azul\">$nb_muelle</td><td id=\"azul\">$atraque</td> </tr>");
					$cont++;
				}
				
			?>
            </table>
			</div>
            
            </p>
		</div>
        		
			
            <!-- Ventana de Historico  -->
		<div id="dialog_historico" title="Hist&oacute;rico">
			<label><a href="#">Hist&oacute;rico</a></label>
			<div align="center">
				<table width="300" height="17" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="110">Buque</td>
                <td width="102">Muelle</td>
                <td width="90">Atraque</td>
              </tr>
               <?php
			  	
			  	$cont=0;
				$sql = "SP_BUQUES";
				$rs=odbc_exec($conex,$sql)or die(exit("Error en odbc_exec"));
				while ( odbc_fetch_row($rs) )  
				{ 
					$nb_buque=odbc_result($rs,"nb_buque");
					$nb_muelle=odbc_result($rs,"nb_muelle");
					$atraque=odbc_result($rs,"atraque");
					if ($cont%2!=0)
						echo(" <tr><td>$nb_buque</td><td>$nb_muelle</td><td>$atraque</td> </tr>");
					else
						echo(" <tr><td id=\"azul\">$nb_buque</td><td id=\"azul\">$nb_muelle</td><td id=\"azul\">$atraque</td> </tr>");
					$cont++;
				}
				
			?>
            </table>
			</div>
            
            </p>
		</div>	
        
         	<!-- Ventana Actividad Reciente -->
        <div id="dialog_act_reci" title="Actvidad Reciente">
		
        	<label>Actividad Reciente </label>
			<?php
				$sql = "SP_ORDENES_INTERNET 0";
				$rs=odbc_exec($conex,$sql)or die(exit("Error en odbc_exec"));
				while ( odbc_fetch_row($rs) )
				{ 
					$ordenes_total=odbc_result($rs,"ordenes");
					
				}
				$sql = "SP_ORDENES_INTERNET 1";
				$rs=odbc_exec($conex,$sql)or die(exit("Error en odbc_exec"));
				while ( odbc_fetch_row($rs) )
				{ 
					$ordenes_tara=odbc_result($rs,"ordenes");
					
				}
				$sql = "SP_ORDENES_INTERNET 2";
				$rs=odbc_exec($conex,$sql)or die(exit("Error en odbc_exec"));
				while ( odbc_fetch_row($rs) )
				{ 
					$ordenes_full=odbc_result($rs,"ordenes");
					
				}
				$sql = "SP_ORDENES_INTERNET 3";
				$rs=odbc_exec($conex,$sql)or die(exit("Error en odbc_exec"));
				while ( odbc_fetch_row($rs) )
				{ 
					$ultima_orden=odbc_result($rs,"ordenes");
					
				}
				$sql = "SP_ORDENES_INTERNET 4";
				$rs=odbc_exec($conex,$sql)or die(exit("Error en odbc_exec"));
				while ( odbc_fetch_row($rs) )
				{ 
					$iltima_tara=odbc_result($rs,"ordenes");
					
				}
				$sql = "SP_ORDENES_INTERNET 5";
				$rs=odbc_exec($conex,$sql)or die(exit("Error en odbc_exec"));
				while ( odbc_fetch_row($rs) )
				{ 
					$ultima_pesada=odbc_result($rs,"ordenes");
					
				}
			
			?>
			<table width="300" height="116" border="1" cellpadding="0" cellspacing="0">
              <tr>
                <td width="118" id="titulo">Ordenes de Carga </td>
                <td width="100" id="titulo">Peso Tara </td>
                <td width="84" id="titulo">Despacho</td>
              </tr>
              <tr>
                <td id="conte"><?php echo $ordenes_total; ?></td>
                <td id="conte"><?php echo $ordenes_tara; ?></td>
                <td id="conte"><?php echo $ordenes_full; ?></td>
              </tr>
              <tr>
                <td id="titulo">Ult. Orden de C. </td>
                <td id="titulo">Ult. Tara </td>
                <td id="titulo">Ult. Desp. </td>
              </tr>
              <tr>
                <td id="conte"><?php echo $ultima_orden; ?></td>
                <td id="conte"><?php echo $iltima_tara; ?></td>
                <td id="conte"><?php echo $ultima_pesada; ?></td>
              </tr>
            </table>
		</div>	
	
	</body>
</html>


