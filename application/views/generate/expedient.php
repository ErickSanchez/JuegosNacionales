<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="http://prefeco.sitiosclick.com/css/expedient.css" type="text/css" />
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
	<tr><td colspan="3">REGISTRO DE PARTICIPANTE</td></tr>
	<tr><td colspan="3"></td></tr>
	<tr><td colspan="3"></td></tr>
	<tr><td colspan="3"></tr>
</table>
<table id="content" cellspacing="0">
	<tr>
		<td colspan="2">
			<table>
				<tr>
					<td rowspan="5" class="photo"><?php echo ($participant->filePhoto)? '<img src="'.base_url().'Files/'.$participant->idparticipant.'/'.$participant->filePhoto.'" />' : '<img src="'.base_url().'images/nophoto-cred.gif" />';?></td>
					<td><b>Estado:</b> <?php echo $participant->stateName;?></td>
					<td width="150"><b>Ciudad:</b> <?php echo $participant->cityName;?></td>
				</tr>
				<tr>
					<td colspan="2"><b>Plantel:</b> <?php echo $participant->campusName;?> (<?php echo $participant->idcampus;?>)</td>
				</tr>
				<tr>
					<td><b>CCT:</b> <?php echo $participant->cct;?></td>
					<td><b>Clave:</b> <?php echo $participant->idcampus;?></td>
				</tr>
				<tr>
					<td><b>Deporte:</b> <?php echo $participant->sportName;?></td>
					<td><b>Categoria:</b> <?php echo $participant->sportCategoryName;?></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<tr colspan="2"></td>
	</tr>
	<tr class="subtitle">
		<td colspan="2">PERSONALES</td>
	</tr>
	<tr>
		<td colspan="2"><b>Nombre:</b> <?php echo $participant->lastName.$participant->sureName.$participant->firstName;?></td>
	</tr>
	<tr>
		<td><b>CURP:</b> <?php echo $participant->curp;?></td>
		<td><b>Fec. Nac:</b> <?php echo $participant->birthdate;?></td>
	</tr>
	<tr class="subtitle">
		<td colspan="2">INFORMACIÓN DE CONTACTO</td>
	</tr>
	<tr>
		<td><b>Teléfono:</b> <?php echo $participant->phone;?></td>
		<td><b>Celular:</b> <?php echo $participant->cellphone;?></td>
	</tr>
	<tr>
		<td><b>Email:</b> <?php echo $participant->email;?></td>
	</tr>
	<tr class="subtitle">
		<td colspan="2">DIRECCION</td>
	</tr>
	<tr>
		<td><b>Calle:</b> <?php echo $participant->addressStreet;?></td>
		<td><b>Número:</b> <?php echo $participant->addressNumber; if($participant->addressInteriorNumber) echo ' <b>Int.</b> '.$participant->addressInteriorNumber;?></td>
	</tr>
	<tr>
		<td><b>Código Postal:</b> <?php echo $participant->addressZip;?></td>
		<td><b>Localidad:</b> <?php echo $participant->addressLocality;?></td>
	</tr>
	<tr>
		<td><b>Municipio:</b> <?php echo $participant->addressTown;?></td>
		<td><b>Estado:</b> <?php echo $participant->stateName;?></td>
	</tr>
	<tr class="subtitle">
		<td colspan="2">INFORMACIÓN ESCOLAR</td>
	</tr>
	<tr>
		<td><b>Matricula:</b> <?php echo $participant->schoolEnrollment;?></td>
		<td><b>Turno:</b> <?php echo ($participant->turn=='M') ? 'MATUTINO' : 'VESPERTINO';?></td>
	</tr>
	<tr>
		<td><b>Semestre:</b> <?php echo $participant->semester;?></td>
		<td><b>Estado:</b> <?php echo ($participant->schoolState=='R')? 'REGULAR' : 'IRREGULAR';?></td>
	</tr>
	<tr>
		<td><b>Group:</b> <?php echo $participant->groupParticipant;?></td>
		<td><b></b> </td>
	</tr>
	<tr class="subtitle">
		<td colspan="2">INFORMACIÓN DE EMERGENCIA</td>
	</tr>
	<tr>
		<td><b>Nombre:</b> <?php echo $participant->emergencyName;?></td>
	</tr>
	<tr>
		<td><b>Teléfono:</b> <?php echo $participant->emergencyPhone;?></td>
		<td><b>Tipo de Sangre:</b> <?php echo $participant->bloodType;?></td>
	</tr>
	<tr>
		<td><b>Alergias:</b> <?php echo $participant->allergies;?></td>
		<td><b>Enfermedades Crónicas:</b> <?php echo $participant->chronicDiseases;?></td>
	</tr>
	<tr class="subtitle">
		<td colspan="2">DOCUMENTACION</td>
	</tr>
	<tr>
		<td><b>Acta de Nacimiento:</b> <?php echo ($participant->fileBirthCertificate)? 'SI' : 'NO';?></td>
		<td><b>Constancia de Estudios:</b> <?php echo ($participant->fileSchoolCertificate)? 'SI' : 'NO';?></td>
	</tr>
	<tr>
		<td><b>CURP:</b> <?php echo ($participant->curpFile)? 'SI' : 'NO';?></td>
		<td><b>Historial Académico:</b> <?php echo ($participant->fileAcademicHistory)? 'SI' : 'NO';?></td>
	</tr>
	<tr>
		<td><b>Credencial de Estudiante (anverso):</b> <?php echo ($participant->fileStudentCardFront)? 'SI' : 'NO';?></td>
		<td><b>Credencial de Estudiante (reverso):</b> <?php echo ($participant->fileStudentCardBack)? 'SI' : 'NO';?></td>
	</tr>
</table>
<table id="footer">
	<tr>
		<td></td>
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