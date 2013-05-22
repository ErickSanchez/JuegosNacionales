<html>
	
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/cedula.css" type="text/css" />
</head>
<body>
<center>
<div id="wp-doc">
<table id="header">
	<tr>
		<td class="logo" rowspan="6"><img src="<?php echo base_url(); ?>images/logo-interprefecos.png" width="100"/></td>
		<td colspan="3"><h3>IX JUEGOS NACIONALES INTERPREFECOS MORELIA 2012</h3></td>
		<td class="logo" rowspan="6"><img src="<?php echo base_url(); ?>images/logo-prefeco-oficial.png" width="100"/></td>
	</tr>
	<tr><td colspan="3">CREDENCIALES DE EQUIPO</td></tr>
	<tr><td colspan="3" ><?php echo $team->sportName.' - '.$team->sportCategoryName; ?></td></tr>
	<tr><td colspan="3"> <b><?php echo $team->campusName.' ('.$team->idcampus.')'; ?></b></td></tr>
	<tr><td colspan="3"><?php echo $team->cityName.', '.$team->stateName; ?></td></tr>
</table>
<table id="content"   cellspacing="0">
<?php
	foreach($participants as $row){	
		if(!$row->filePhoto || $row->filePhoto=='')
			$img = base_url().'images/nophoto-cred.gif';
		else
			$img = base_url().'Files/'.$row->idparticipant.'/'.$row->filePhoto;
	echo'<tr> 
		<td width="290">
			<table class="credencial back" width="290" cellspacing="0">	
                                	
				<tr><td><span class="label"> Plantel:</span><br />'.$team->campusName.'</td></tr>
				<tr><td><span class="label"> Procedencia:</span><br />'.$team->cityName.', '.$team->stateName.'</td></tr>
				<tr><td><span class="label"> Emergencias:</span><br />'.$row->emergencyName.'<br />TEL. '.$row->emergencyPhone.' </td></tr>
				<tr><td  height="1" ></td></tr>
				
			</table>
		</td>
		<td  width="290">
			<table class="credencial front" width="290" cellspacing="0" >	
				<tr>
					<td rowspan="4" class="photo" ><img src="'.$img.'" width="100" height="100" /></td>
					<td width="70"></td>
					<td width="130"><span class="label">Matrícula:</span> <b>'.$row->schoolEnrollment.'</b></td>
				</tr>
				<tr>
					<td colspan="2" class="name"><b>'.$row->lastName.' '.$row->sureName.'<br />'.$row->firstName.'</b></td>
				</tr>
				<tr>
					<td><span class="label">Deporte:</span> <br />'.$team->sportName.' '.'</td>		
					<td><span class="label"> Categoría:</span> <br/>'.$team->sportCategoryName.'</td>
				</tr>	
				<tr>
					<td class="line"><span class="label">Camiseta:</span> '.$row->jerseyNumber.'</td>		
					<td class="line"><span class="label">Fec. Nac.:</span> <b>'.date("d/m/Y", strtotime($row->birthdate)).'</b></td>
				</tr>		
			</table>
		</td>
	</tr>';
	}
?>
</table>
<table id="footer">
	<tr>
		<td>
			<p>
<?php
date_default_timezone_set('America/Mexico_City');
$mes[0]="-";
$mes[1]="enero";
$mes[2]="febrero";
$mes[3]="marzo";
$mes[4]="abril";
$mes[5]="mayo";
$mes[6]="junio";
$mes[7]="julio";
$mes[8]="agosto";
$mes[9]="septiembre";
$mes[10]="octubre";
$mes[11]="noviembre";
$mes[12]="diciembre";

$dia[0]="Domingo";
$dia[1]="Lunes";
$dia[2]="Martes";
$dia[3]="Miércoles";
$dia[4]="Jueves";
$dia[5]="Viernes";
$dia[6]="Sábado";

$gisett=(int)date("w");
$mesnum=(int)date("m");

echo $dia[$gisett].", ".date("d")." de ".$mes[$mesnum]." de ".date("Y");

?>
			<br />Sistema Informático de Administración de los Juegos Nacionales (SIAJ)</p>
		</td>
	</tr>
</table>
</div>
</center>
</body>
</html>