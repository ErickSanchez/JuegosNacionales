<script language="javascript">
 function validate_types(allowed_types,idfile,photo){
       var mierror = "";
       var file=$('#'+idfile).val();
       if (!file) {
            mierror = "No has seleccionado ningún archivo";
    }else{
      //recupero la extensión de este nombre de archivo
     var extension = (file.substring(file.lastIndexOf("."))).toLowerCase();
      //compruebo si la extensión está entre las permitidas
      var allowed = false;
      for (var i = 0; i < allowed_types .length; i++) {
         if (allowed_types [i] == extension) {
         allowed = true;
         break;
         }
      }
      if (!allowed) {
         mierror = "Comprueba la extensión de los archivos a subir. \nSólo se pueden subir archivos con extensiones: " + allowed_types.join();
      	}
        else{
            if(photo)
                    $('#file-photo-preview').children('img').attr('src','<?php echo base_url('images/upload.png' ); ?>');
            else
                {
                    $('#btn-'+idfile).hide();
                    $('#'+idfile).css('width','480px');
                    $('#'+idfile).attr('css','set');
                    $('#'+idfile).css('background','url(<?php echo base_url(); ?>images/ico-tick.png) no-repeat center right');
                 }

         return true;
      	}
   }
   //si estoy aqui es que no se ha podido submitir
   $('#'+idfile).val('');
   alert (mierror);
      return false;
  }
</script>
<script>
$(function(){

    $('.upper').keyup(function() {
        this.value = this.value.toUpperCase();
    });

    //$('img').attr("src","images/upload.png").hide();

     $('#file-photo').change(function(){
            allowed_types = new Array(".jpg", ".png",".jpeg");
            return validate_types(allowed_types,'file-photo',true);
        });

    $('#file-birth').change(function(){
            allowed_types = new Array(".pdf");
             return validate_types(allowed_types,'file-birth',false);
    });

    $('#file-Certificate').change(function(){
            allowed_types = new Array(".pdf");
            return validate_types(allowed_types,'file-Certificate',false);
        });

   $('#file-CURP').change(function(){
            allowed_types = new Array(".pdf");
           return validate_types(allowed_types,'file-CURP',false);
      });
    $('#file-academicHistory').change(function(){
            allowed_types = new Array(".pdf");
           return validate_types(allowed_types,'file-academicHistory',false);
    });
   $('#file-schoolCard-front').change(function(){
            allowed_types = new Array(".pdf");
           return validate_types(allowed_types,'file-schoolCard-front',false);
     });
    $('#file-schoolCard-back').change(function(){
            allowed_types = new Array(".pdf");
          return  validate_types(allowed_types,'file-schoolCard-back',false);
        });
	$("#frm_signUp").submit( function () {
		$('.set').css('background','url(<?php echo base_url(); ?>images/uploader.gif) no-repeat center right');
	} );

});
</script>
<div id="main-content">

<?php

echo   form_open_multipart('participant/update',array('id' => 'frm_signUp','name' => 'frm_signUp'));
?>
	<h2><?php echo $title;?></h2>
	<h3 class="round">Información Personal</h3>
	<div id="file-photo-wp">
		<div id="file-photo-preview" class="round">
	<?php if($participant->filePhoto)
                    echo '<img id="img-photo-preview" src="'.base_url('Files/'.$participant->idparticipant.'/'.$participant->filePhoto).'" />';
            	else
                    echo '<img id="img-photo-preview" src="'.base_url().'images/nophoto.gif" />';
                
     //           echo '<img id="img-photo-upoad" src="'.base_url('images/upload.png').'" />';
	?>
                    <input class="round" type="file"  id="file-photo" name="file-photo"/>
		</div>
                <?php echo form_error('file-photo'); ?>
	</div>
	<div id="team-info">
            <input type="hidden" value="<?php  echo $participant->idteam;?>" name="team" hidden="hidden"/>
            <input type="hidden" value="<?php  echo $participant->usernameCoach;?>" name="coach" hidden="hidden"/>
            <input type="hidden" value="<?php  echo $participant->idparticipant;?>" name="participant" hidden="hidden"/>
		<p>
            <label for="sport">Deporte</label>
			<select id="sport" name="sport">
			  <?php echo '<option value="'.$participant->idsport.'">'.$participant->sportName.'</option>'; ?>
			</select>
        </p>
        <p>
			<label for="city">Ciudad</label>
			<select id="city" name="city" >
				<?php echo '<option value="'.$participant->idcity.'">'.$participant->cityName.'</option>'; ?>
			</select>
        </p>
        <p>
			<label for="sport-category">Categoria</label>
			<select id="sport-category" name="sport-category" >
				<?php echo '<option value="'.$participant->idsportCategory.'">'.$participant->sportCategoryName.'</option>'; ?>
			</select>
        </p>
        <p>
			<label for="campus">Plantel</label>
			<select id="campus" name="campus" >
				<?php echo '<option value="'.$participant->idcampus.'">'.$participant->campusName.'</option>'; ?>
			</select>
        </p>
        <p>
			<label for="cct">CCT</label>
			<select id="cct" name="cct" >
				<?php echo '<option value="'.$participant->cct.'">'.$participant->cct.'</option>'; ?>
			</select>
        </p>
		<?php if(!$participant->usernameCoach) { ?>
		<div id="jersey-number-area">
			<label for="jersey-number">N° de Camiseta</label>
                        <input type="text" id="jersey-number" name="jersey-number" value="<?php if(set_value('jersey-number')) echo set_value('jersey-number'); else echo @$participant->jerseyNumber;?>" />
                                  <?php echo form_error('jersey-number'); ?>
		</div>
		<?php } ?>
	</div>
	<div class="clear"></div>
	<div class="group clear round">
		<b>Nombre del Participante</b>
		<ul>
			<li>
				<label for="lastname">Apellido Paterno</label>
				<input id="lastname" name="lastname" class="upper txt-med" type="text" value="<?php if(set_value('surname')) echo set_value('surname'); else echo $participant->lastName;?>" onchange="toUpper();"/>
                                <?php echo form_error('lastname'); ?>
			</li>
			<li>
				<label for="surname">Apellido Materno</label>
				<input id="surname" name="surname" class="upper txt-med" type="text" value="<?php if(set_value('surname')) echo set_value('surname'); else echo $participant->sureName;?>" onchange="toUpper();" />
                                <?php echo form_error('surname'); ?>
			</li>
			<li>
				<label for="firstname">Nombre(s)</label>
				<input id="firstname" name="firstname" class="upper txt-med" type="text" value="<?php if(set_value('firstname')) echo set_value('firstname'); else echo $participant->firstName;?>" onchange="toUpper();" />
                                <?php echo form_error('firstname'); ?>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="group clear round">
		<b>CURP</b>
		<ul>
			<li>
				<input id="curp" name="curp" class="upper txt-med" type="text" value="<?php if(set_value('curp')) echo set_value('curp'); else echo $participant->curp;?>" maxlength="18"/>
			</li>
			<li>
				<a class="btn" href="http://consultas.curp.gob.mx/CurpSP/" target="_blank">Consultar</a>
			</li>
			<div class="clear"><?php echo form_error('curp'); ?></div>
		</ul>
		<div class="clear"></div>
	</div>
	<div id="birthdate" class="group clear round">
		<b>Fecha de Nacimiento</b>
		<ul>
			<?php
				$birthdate= array();
				if(isset($participant->birthdate)){
					$birthdate = explode('-',$participant->birthdate);
					$birthdateYear = $birthdate[0];
					$birthdateMonth = $birthdate[1];
					$birthdateDay = $birthdate[2];
				}
			?>
			<li>
				<label for="birthdate-day" class="txt-small">Dia</label>
				<select id="birthdate-day" name="birthdate-day">
					<?php
						if(!count($birthdate))
							echo '<option value="00">--</option>';
						else
							echo '<option value="'.$birthdate[2].'">'.$birthdate[2].'</option><option value="0"></option>';
						for($i=1; $i<32; $i++)
							echo('<option value="'.$i.'">'.$i.'</option>');
					?>
				</select>
			</li>
			<li>
				<label for="birthdate-month" class="txt-small">Mes</label>
				<select id="birthdate-month" name="birthdate-month">
					<?php
						$months = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
						if(!count($birthdate))
							echo '<option value="00">SELECCIONE..</option>';
						else
							echo '<option value="'.$birthdate[1].'">'.$months[$birthdate[1]-1].'</option><option value="0"></option>';

						for($i=0; $i<count($months); $i++)
							echo('<option value="'.($i+1).'">'.$months[$i].'</option>');
					?>
				</select>
			</li>
			<li>
				<label for="birthdate-year" class="txt-small">Año</label>
				<select id="birthdate-year" name="birthdate-year">
					<?php
						if(!count($birthdate) || $birthdate[0]=='0000')
							echo '<option value="0000">----</option>';
						else
                                                    if(set_value('birthdate-year'))
							echo '<option value="'.set_value('birthdate-year').'">'.set_value('birthdate-year').'</option><option value="0"></option>';
                                                    else
							echo '<option value="'.$birthdate[0].'">'.$birthdate[0].'</option><option value="0"></option>';
					?>
                                    <?php if(!$participant->usernameCoach){ ?>
                                        <option value="1993">1993</option>
                                        <option value="1994">1994</option>
                                        <option value="1995">1995</option>
                                        <option value="1996">1996</option>
                                    <?php }
					else{
						for($i=1993; $i>=1950; $i--)
							echo '<option value="'.$i.'">'.$i.'</option>';
					}
				?>
				</select>
                                <?php echo form_error('birthdate-year'); ?>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="group clear round">
		<b>Contacto</b>
		<ul>
			<li>
				<label for="cellphone">Celular</label>
				<input id="cellphone" name="cellphone" class="txt-med" type="text" value="<?php if(set_value('cellphone')) echo set_value('cellphone'); else echo $participant->cellphone;?>" maxlength="12"/>
						<?php echo form_error('cellphone'); ?>
			</li>
			<li>
				<input id="cellphone-none" name="cellhone-none" class="txt-small" type="checkbox" value="TRUE" <?php if(!$participant->cellphone) echo 'checked';?> />
				<label for="cellphone-none" class="txt-med">No tengo celular</label>
			</li>
			<div class="clear"></div>
			<li>
				<label for="phone">Teléfono Local</label>
                                <input id="phone" name="phone" class="txt-med" type="text" value="<?php if(set_value('phone')) echo set_value('phone'); else echo $participant->phone;?>" maxlength="12"/>
						<?php echo form_error('phone'); ?>

			</li>
			<li>
				<input id="phone-none" name="phone-none" class="txt-small" type="checkbox" value="TRUE" <?php if(!$participant->phone) echo 'checked';?>/>
				<label for="phone-none" class="txt-med">No tengo teléfono local</label>
			</li>
			<div class="clear"></div>
			<li>
				<label for="email">Email</label>
				<input id="email" name="email" class="txt-med" type="text" value="<?php if(set_value('email')) echo set_value('email'); else echo $participant->email;?>" />
						<?php echo form_error('email'); ?>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
        <?php if(!$participant->usernameCoach)
        {
            ?>

	<div class="group clear round">
		<h4>Dirección</h4>
		<ul>
			<li>
				<label for="address-street">Calle</label>
				<input id="address-street" name="address-street" class="txt-med" type="text" value="<?php echo $participant->addressStreet;?>"/>
                                <?php echo form_error('address-street'); ?>
			</li>
			<li>
				<label for="address-number">Número</label>
				<input id="address-number" name="address-number" class="txt-small" type="text" value="<?php if(set_value('cellphone')) echo set_value('cellphone'); else echo $participant->addressNumber;?>" />
                                <?php echo form_error('address-number'); ?>
			</li>
			<li>
				<label for="address-interior-number" class="txt-small">Interior</label>
				<input id="address-interior-number" name="address-interior-number" class="upper txt-small" type="text" value="<?php echo $participant->addressInteriorNumber; ?>"  maxlength="3"/>
                                <?php echo form_error('address-interior-number'); ?>
			</li>
			<div class="clear"></div>
			<li>
				<label for="address-colony">Colonia</label>
				<input id="address-colony" name="address-colony" class="txt-med" type="text"  value="<?php echo $participant->addressColony;?>"/>
                                <?php echo form_error('address-colony'); ?>
			</li>
			<li>
				<label for="address-zip">Código Postal</label>
				<input id="address-zip" name="address-zip" class="txt-small" type="text" value="<?php echo $participant->addressZip;?>" maxlength="5"/>
                                <?php echo form_error('address-zip'); ?>
			</li>
			<div class="clear"></div>
			<li>
				<label for="address-locality">Localidad</label>
				<input id="address-locality" name="address-locality" class="upper txt-med" type="text" value="<?php echo $participant->addressLocality; ?>" />
                                <?php echo form_error('address-locality'); ?>
			</li>
			<li>
				<label for="address-town">Municipio</label>
				<input id="address-town" name="address-town" class="upper txt-med" type="text" value="<?php echo $participant->addressTown;?>" />
                                <?php echo form_error('address-town'); ?>
			</li>
			<li>
				<label for="address-state">Estado</label>
				<select id="address-state" name="address-state">
					<?php
						if(!$participant->addressState)
							echo '<option value="0">SELECCIONE..</option>';
						else
							echo '<option value="'.$participant->idstate.'">'.$participant->stateName.'</option><option value="0"></option>';
						foreach($states as $row)
							if($row->stateName!='MICHOACAN (SEDE)')
								echo '<option value="'.$row->idstate.'">'.$row->stateName.'</option>';
					?>
				</select>
                    <?php echo form_error('address-state'); ?>
			</li>
			<div class="clear"></div>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="group clear round">
		<h3 class="round">Información Escolar</h3>
		<ul>
			<li>
				<label for="enrollment">Matrícula</label>
				<input id="enrollment" name="enrollment" class="txt-med" type="text" value="<?php echo $participant->schoolEnrollment;?>" maxlength="15"/>
                                <?php echo form_error('enrollment'); ?>
			</li>
			<li>
				<label for="turn">Turno</label>
				<select id="turn" name="turn">
					<?php
						if(!$participant->turn)
							echo '<option value="0">SELECCIONE..</option>';
						else{
							if($participant->turn=='M')
								echo '<option value="M">MATUTINO</option><option value="0"></option>';
							else
								echo '<option value="V">VESPERTINO</option><option value="0"></option>';
						}
					?>
					<option value="M">MATUTINO</option>
					<option value="V">VESPERTINO</option>
				</select>
			</li>
			<div class="clear"></div>
			<li>
				<label for="semester">Semestre</label>
				<select id="semester" name="semester">
					<?php
						switch($participant->semester){
							case 0: echo '<option value="0">SELECCIONE..</option>'; break;
							case 2: echo '<option value="2">SEGUNDO</option>'; break;
							case 4: echo '<option value="4">CUARTO</option>'; break;
							case 6: echo '<option value="6">SEXTO</option>'; break;
						}
						if($participant->semester)
							echo '<option value="0"></option>';
					?>
					<option value="2">SEGUNDO</option>
					<option value="4">CUARTO</option>
					<option value="6">SEXTO</option>
				</select>
					<?php echo form_error('semester'); ?>
			</li>
			<li>
				<label for="status">Estado Escolar</label>
				<select id="status" name="statu">
					<?php
						if(!$participant->schoolState)
							echo '<option value="0">SELECCIONE..</option>';
						else{
							if($participant->schoolState=='R')
								echo '<option value="R">REGULAR</option><option value=""></option>';
							else
								echo '<option value="I">IRREGULAR</option><option value=""></option>';
						}
					?>
					<option value="R">REGULAR</option>
					<option value="I">IRREGULAR</option>
				</select>
			</li>
			<div class="clear"></div>
			<li>
				<label for="groupParticipant">Grupo</label>
				<input id="groupParticipant" name="groupParticipant" class="txt-small" type="text" value="<?php echo $participant->groupParticipant;?>" maxlength="10"/>
                                <?php echo form_error('groupParticipant'); ?>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	<h3 class="round">Información de Emergencia</h3>
	<div class="group clear round">
		<b>Familiar o tutor</b>
		<ul>
			<li>
				<label for="emergency-name">Nombre</label>
				<input id="emergency-name" name="emergency-name" class="txt-big" type="text" value="<?php echo $participant->emergencyName;?>" />
						<?php echo form_error('emergency-name'); ?>
			</li>
			<div class="clear"></div>
			<li>
				<label for="emergency-phone">Teléfono</label>
				<input id="emergency-phone" name="emergency-phone" class="txt-med" type="text" value="<?php echo $participant->emergencyPhone;?>" maxlength="12"/>
						<?php echo form_error('emergency-phone');?>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="group clear round">
		<b>Información Adicional</b>
		<ul>
			<li>
				<label for="blood-type" class="txt-med">Tipo de sangre</label>
				<input id="blood-type" name="blood-type" class="upper txt-small" type="text" value="<?php echo $participant->bloodType;?>" maxlength="2"/>
						<?php echo form_error('blood-type'); ?>
			</li>
			<div class="clear"></div>
			<li>
				<label for="allergies" class="txt-med">Alergico a:</label>
				<input id="allergies" name="allergies" class="upper txt-big" type="text" value="<?php echo $participant->allergies;?>" />
						<?php echo form_error('blood-type'); ?>
			</li>
			<div class="clear"></div>
			<li>
				<label for="chronic-diseases" class="txt-med">Enfermedades Crónicas</label>
				<input id="chronic-diseases" name="chronic-diseases" class="upper txt-big" type="text" value="<?php echo $participant->chronicDiseases;?>" />
						<?php echo form_error('chronic-diseases'); ?>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
        <?php }?>
	<h3 class="round">Documentación</h3>
	<div id="docs" class="group round">
		<div class="notify-alert">Toda la documentación adjunta debe estar en formato .PDF</div>
		<ul>
                    <?php if(!$participant->usernameCoach) {?>
			<li class="clear">
				<label for="file-birth">Acta de Nacimiento </label>
				<input type="file" id="file-birth" name="file-birth"/>
				<?php if($participant->fileBirthCertificate) echo '<a class="btn" id="btn-file-birth" href="'.base_url().'Files/'.$participant->idparticipant.'/'.$participant->fileBirthCertificate.'" target="_blank">Ver</a>'; ?>
						<?php echo '<div class="clear">'.form_error('file-birth').'</div>'; ?>
			</li>
			<li class="clear">
				<label for="file-Certificate">Constancia de Estudios</label>
				<input type="file" id="file-Certificate" name="file-Certificate"   />
				<?php if($participant->fileSchoolCertificate) echo '<a class="btn" id="btn-file-Certificate" href="'.base_url().'Files/'.$participant->idparticipant.'/'.$participant->fileSchoolCertificate.'" target="_blank">Ver</a>'; ?>
						<?php echo '<div class="clear">'.form_error('file-Certificate').'</div>'; ?>
			</li>
			<li class="clear">
				<label for="file-CURP">CURP</label>
				<input type="file" id="file-CURP" name="file-CURP"  />
				<?php if($participant->curpFile) echo '<a class="btn" id="btn-file-CURP" href="'.base_url().'Files/'.$participant->idparticipant.'/'.$participant->curpFile.'" target="_blank">Ver</a>'; ?>
						<?php echo '<div class="clear">'.form_error('file-CURP').'</div>'; ?>
			</li>
			<li class="clear">
				<label for="file-academicHistory">Historial Académico</label>
				<input type="file" id="file-academicHistory" name="file-academicHistory"   />
				<?php if($participant->fileAcademicHistory) echo '<a class="btn" id="btn-file-academicHistory" href="'.base_url().'Files/'.$participant->idparticipant.'/'.$participant->fileAcademicHistory.'" target="_blank">Ver</a>'; ?>
						<?php echo '<div class="clear">'.form_error('file-academicHistory').'</div>'; ?>
			</li>
                        <?php 
                            $label='Credencial de Estudiante';
                            $idFront='fileStudentCardFront';
                              $idBack='fileStudentCardBack';
                        }
                        else
                        {
                            $label='Identificación';
                            $idFront='fileIdentificationFront';
                            $idBack='fileIdentificationBack';
                        }
                        ?>
              	<li class="clear">
				<label for="file-schoolCard-front"><?php echo $label;?> (anverso)</label>
				<input type="file" id="file-schoolCard-front" name="file-schoolCard-front"   />
				<?php if($participant->$idFront) echo '<a class="btn" id="btn-file-schoolCard-front" href="'.base_url().'Files/'.$participant->idparticipant.'/'.$participant->$idFront.'" target="_blank">Ver</a>'; ?>
						<?php echo '<div class="clear">'.form_error('file-schoolCard-front').'</div>'; ?>
			</li>
			<li class="clear">
				<label for="file-schoolCard-back"><?php echo $label;?> (reverso)</label>
				<input type="file" id="file-schoolCard-back" name="file-schoolCard-back"   />
				<?php if($participant->$idBack) echo '<a  class="btn" id="btn-file-schoolCard-back" href="'.base_url().'Files/'.$participant->idparticipant.'/'.$participant->$idBack.'" target="_blank">Ver</a>'; ?>
						<?php echo '<div class="clear">'.form_error('file-schoolCard-back').'</div>'; ?>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
        
	<p>
		<input id="sign-up" class="btn" type="submit" value="<?php echo $label_button;?>"/>
	</p>
<?php echo form_close();?>
</div><!-- end main content>-->