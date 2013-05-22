<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="http://prefeco.sitiosclick.com/css/cedula.css" type="text/css" />
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
	<tr><td colspan="3">CÉDULA DE EQUIPO</td></tr>
	<tr><td colspan="3"><?php echo $team->sportName.' - '.$team->sportCategoryName; ?></td></tr>
	<tr><td colspan="3"><b><?php echo $team->campusName.' ('.$team->idcampus.')'; ?></b></td></tr>
	<tr><td colspan="3"><?php echo $team->cityName.', '.$team->stateName; ?></td></tr>
</table>
<table id="content" cellspacing="0">
<?php
	$i=0;
	foreach($participants as $row){
		if($i%2==0)
			echo '<tr>';
		echo'
	<td>
		<table class="cedula" cellspacing="0">	
			<tr>
				<td rowspan="3" class="photo"><img src="'.base_url(); if($row->filePhoto) echo 'Files/'.$row->idparticipant.'/'.$row->filePhoto; else echo 'images/nophoto-cred.gif'; echo '" width="100" height="100"/></td>
				<td>No. '.($i+1).'</td>
				<td width="135">Matrícula: <b>'.$row->schoolEnrollment.'</b></td>
			</tr>
			<tr>
				<td colspan="2" class="name"><b>'.$row->lastName.' '.$row->sureName.'<br />'.$row->firstName.'</b></td>
			</tr>
			<tr>
				<td>Camiseta: '.$row->jerseyNumber.'</td>		
				<td>Fec. Nac.: <b>'.date("d/m/Y", strtotime($row->birthdate)).'</b></td>
			</tr>		
		</table>
	</td>
		';
		if($i%2!=0)
			echo '</tr>';
		$i++;
	}
?>
</table>
<table id="footer">
	<tr>
		<td>Total de Participantes: <?php echo $i; ?></td>
	</tr>
</table>
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
</div>
</center>
</body>
</html>