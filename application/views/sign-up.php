<script language="javascript">
  function validate_types(allowed_types,idfile,photo){
       var mierror = "";
       var file=$(idfile).val();
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
                    $(idfile).css('width','500px');
                    $(idfile).css('background','url(<?php echo base_url(); ?>images/ico-tick.png) no-repeat center right');
                 }

         return true;
      	}
   }
   //si estoy aqui es que no se ha podido submitir
   $(idfile).val("");
   alert (mierror);
      return false;
  }
</script>
<div id="main-content">
<script>
$(function(){

    $('.upper').keyup(function() {
        this.value = this.value.toUpperCase();
    });

    $('#file-photo').change(function(){
            allowed_types = new Array(".jpg", ".png",".jpeg");
            return validate_types(allowed_types,this,true);
        });

    $('#file-birth').change(function(){
            allowed_types = new Array(".pdf");
             return validate_types(allowed_types,this,false);
    });

    $('#file-Certificate').change(function(){
            allowed_types = new Array(".pdf");
            return validate_types(allowed_types,this,false);
        });

   $('#file-CURP').change(function(){
            allowed_types = new Array(".pdf");
           return validate_types(allowed_types,this,false);
      });
    $('#file-academicHistory').change(function(){
            allowed_types = new Array(".pdf");
           return validate_types(allowed_types,this,false);
    });
   $('#file-schoolCard-front').change(function(){
            allowed_types = new Array(".pdf");
           return validate_types(allowed_types,this,false);
     });
    $('#file-schoolCard-back').change(function(){
            allowed_types = new Array(".pdf");
          return  validate_types(allowed_types,this,false);
        });
/*
    $('#sign-up').click(function(){


        if(!$('#file-photo').val())
            {
                alert("Selecciona una fotografia");
                $('#file-photo').focus();
                return false;
            }
    });
*/
});
</script>
<?php

$attributes = array('id' => 'frm_signUp','name' => 'frm_signUp');
echo  form_open_multipart('signup/register',$attributes);
?>
	<h2><?php echo $title;?></h2>
	<h3 class="round">Información Personal</h3>
	<div id="file-photo-wp">
		<div id="file-photo-preview" class="round">
			<img src="<?php echo base_url(); ?>images/nophoto.gif" />
			<input class="round" type="file"  id="file-photo" name="file-photo" />
		</div>
			<?php echo form_error('file-photo'); ?>
	</div>

	<div id="team-info">
            <input type="hidden" value="<?php  echo $team->idteam;?>" name="team"/>
            <input type="hidden" value="<?php  echo $coach;?>" name="coach"/>
		<p>
			<label for="sport">Deporte</label>
			<select id="sport" name="sport">
			  <?php echo '<option value="'.$sport->idsport.'">'.$sport->sportName.'</option>'; ?>
			</select>
		</p>
		<p>
			<label for="city">Ciudad</label>
			<select id="city" name="city" >
			<?php echo '<option value="'.$team->idcity.'">'.$team->cityName.'</option>'; ?>
			</select>
		</p>
		<p>
			<label for="sport-category">Categoria</label>
			<select id="sport-category" name="sport-category" >
				<?php echo '<option value="'.$team->idsportCategory.'">'.$team->sportCategoryName.'</option>'; ?>
			</select>
		</p>
		<p>
			<label for="campus">Plantel</label>
			<select id="campus" name="campus" >
				<?php echo '<option value="'.$team->idcampus.'">'.$team->campusName.'</option>'; ?>
			</select>
		</p>
		<p>
			<label for="cct">CCT</label>
			<select id="cct" name="cct" >
				<?php echo '<option value="'.$team->cct.'">'.$team->cct.'</option>'; ?>
			</select>
		</p>
		<div id="jersey-number-area">
			<label for="jersey-number">Camiseta N°</label>
			<input id="jersey-number" name="jersey-number" type="text" maxlength="3" value="<?php echo set_value('jersey-number');?>"/>
		</div>
	</div>
	<div class="clear"></div>
	<div class="group clear round">
		<b>Nombre del Participante</b>
		<ul>
			<li>
				<label for="lastname">Apellido Paterno</label>
				<input id="lastname" name="lastname" class="upper txt-med" type="text" value="<?php echo set_value('lastname');?>" />
								<?php echo form_error('lastname'); ?>
			</li>
			<li>
				<label for="surname">Apellido Materno</label>
				<input id="surname" name="surname" class="upper txt-med" type="text" value="<?php echo set_value('surname');?>"  />
								<?php echo form_error('surname'); ?>
			</li>
			<li>
				<label for="firstname">Nombre(s)</label>
				<input id="firstname" name="firstname" class="upper txt-med" type="text" value="<?php echo set_value('firstname');?>" />
								<?php echo form_error('firstname'); ?>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="group clear round">
		<b>CURP</b>
		<ul>
			<li>
				<input id="curp" name="curp" class="upper txt-med" type="text" value="<?php echo set_value('curp');?>" maxlength="18"/>
								<?php echo form_error('curp'); ?>
			</li>
			<li>
				<a class="btn" href="http://consultas.curp.gob.mx/CurpSP/" target="_blank">Consultar</a>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<div id="birthdate" class="group clear round">
		<b>Fecha de Nacimiento</b>
		<ul>
			<li>
				<label for="birthdate-day" class="txt-small">Dia</label>
				<select id="birthdate-day" name="birthdate-day">
					<option value="00">--</option>
					<?php
						for($i=1; $i<32; $i++)
							echo('<option value="'.$i.'">'.$i.'</option>');
					?>
				</select>
			</li>
			<li>
				<label for="birthdate-month" class="txt-small">Mes</label>
				<select id="birthdate-month" name="birthdate-month">
					<option value="00">SELECCIONE..</option>
					<?php
						$months = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
						for($i=0; $i<count($months); $i++)
							echo('<option value="'.($i+1).'">'.$months[$i].'</option>');
					?>
				</select>
			</li>
			<li>
				<label for="birthdate-year" class="txt-small">Año</label>
				<select id="birthdate-year" name="birthdate-year">
                                    <?php if(set_value('birthdate-year')) 
                                                echo '<option value="'.set_value('birthdate-year').'">'.set_value('birthdate-year').'</option>';
                                            else
                                                echo '<option value="0000">----</option>';
                                        ?>
					
				<?php if(!$coach){ ?>
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
		<?php echo form_error('cellphone'); ?>
	</div>
	<div class="group clear round">
		<b>Contacto</b>
		<ul>
			<li>
				<label for="cellphone">Celular</label>
				<input id="cellphone" name="cellhone" class="txt-med" type="text" value="<?php echo set_value('cellphone');?>" maxlength="12"/>
						<?php echo form_error('cellphone'); ?>
			</li>
			<li>
				<input id="cellphone-none" name="cellhone-none" class="txt-small" type="checkbox" value="TRUE" <?php echo set_value('cellphone-none');?> />
				<label for="cellphone-none" class="txt-med">No tengo celular</label>
			</li>
			<div class="clear"></div>
			<li>
				<label for="phone">Teléfono Local</label>
				<input id="phone" name="phone" class="txt-med" type="text" value="<?php echo set_value('phone');?>" maxlength="12"/>
						<?php echo form_error('phone'); ?>
			</li>
			<li>
				<input id="phone-none" name="phone-none" class="txt-small" type="checkbox" value="<?php echo set_value('phone-none');?>"/>
				<label for="phone-none" class="txt-med">No tengo teléfono local</label>
			</li>
			<div class="clear"></div>
			<li>
				<label for="email">Email</label>
				<input id="email" name="email" class="txt-med" type="text" value="<?php echo set_value('email');?>" />
						<?php echo form_error('email'); ?>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<?php if(!$coach){ ?>
	<div class="group clear round">
		<b>Dirección Particular</b>
		<ul>
			<li>
				<label for="address-street">Calle</label>
				<input id="address-street" name="address-street" class="upper txt-med" type="text" value="<?php echo set_value('address-street');?>"/>
                                <?php echo form_error('address-street'); ?>
			</li>
			<li>
				<label for="address-number">Número</label>
				<input id="address-number" name="address-number" class="upper txt-small" type="text" value="<?php echo set_value('address-number');?>" maxlength="11" />
                                <?php echo form_error('address-number'); ?>
			</li>
			<li>
				<label for="address-interior-number" class="txt-small">Interior</label>
				<input id="address-interior-number" name="address-interior-number" class="upper txt-small" type="text" value="<?php echo set_value('address-interior-number');?>"  maxlength="3"/>
                                <?php echo form_error('address-number'); ?>
			</li>
			<div class="clear"></div>
			<li>
				<label for="address-colony">Colonia</label>
				<input id="address-colony" name="address-colony" class="upper txt-med" type="text"  value="<?php echo set_value('address-colony');?>"/>
                                <?php echo form_error('address-colony'); ?>
			</li>
			<li>
				<label for="address-zip">Código Postal</label>
				<input id="address-zip" name="address-zip" class="txt-small" type="text" value="<?php echo set_value('address-zip');?>" maxlength="5"/>
                                <?php echo form_error('address-zip'); ?>
			</li>
			<div class="clear"></div>
			<li>
				<label for="address-locality">Localidad</label>
				<input id="address-locality" name="address-locality" class="upper txt-med" type="text" value="<?php echo set_value('address-locality');?>" />
                                <?php echo form_error('address-locality'); ?>
			</li>
			<li>
				<label for="address-town">Municipio</label>
				<input id="address-town" name="address-town" class="upper txt-med" type="text" value="<?php echo set_value('address-city');?>" />
                                <?php echo form_error('address-town'); ?>
			</li>
			<li>
				<label for="address-state">Estado</label>
				<select id="address-state" name="address-state">
					<option value="0">SELECCIONE..</option>
					<?php
					foreach($states as $row)
						if($row->stateName!='MICHOACAN (SEDE)')
							echo '<option value="'.$row->idstate.'">'.$row->stateName.'</option>';
					?>
				</select>
                    <?php echo form_error('address-state'); ?>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<h3 class="round">Información Escolar</h3>
	<div class="group clear round">
		<b>Identificación Escolar</b>
		<ul>
			<li>
				<label for="enrollment">Matrícula</label>
				<input id="enrollment" name="enrollment" class="upper txt-med" type="text" value="<?php echo set_value('enrollment');?>" maxlength="15" />
								   <?php echo form_error('enrollment'); ?>
			</li>
			<li>
				<label for="turn">Turno</label>
				<select id="turn" name="turn">
					<?php echo set_value('turn');?>
					<option value="0">SELECCIONE..</option>
					<option value="M">MATUTINO</option>
					<option value="V">VESPERTINO</option>
				</select>
			</li>
			<div class="clear"></div>
			<li>
				<label for="semester">Semestre</label>
				<select id="semester" name="semester">
					<?php echo set_value('semester');?>
					<option value="0">SELECCIONE..</option>
					<option value="2">SEGUNDO</option>
					<option value="4">CUARTO</option>
					<option value="6">SEXTO</option>
				</select>
					<?php echo form_error('semester'); ?>
			</li>
			<li>
				<label for="status">Estado Escolar</label>
				<select id="status" name="statu">
					<?php echo set_value('status');?>
					<option value="0">SELECCIONE..</option>
					<option value="R">REGULAR</option>
					<option value="I">IRREGULAR</option>
				</select>
			</li>
			<div class="clear"></div>
			<li>
				<label for="group">Grupo</label>
				<input id="group" name="group" class="txt-small" type="text" value="<?php echo set_value('group');?>" maxlength="10"/>
								   <?php echo form_error('group'); ?>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<h3 class="round">Información de Emergencia</h3>
	<div class="group clear round">
		<b>Familiar o Tutor</b>
		<ul>
			<li>
				<label for="emergency-name">Nombre</label>
				<input id="emergency-name" name="emergency-name" class="upper txt-big" type="text" value="<?php echo set_value('emergency-name');?>" />
						<?php echo form_error('emergency-name'); ?>
			</li>
			<div class="clear"></div>
			<li>
				<label for="emergency-phone">Teléfono</label>
				<input id="emergency-phone" name="emergency-phone" class="txt-med" type="text" value="<?php echo set_value('emergency-phone');?>" maxlength="12"/>
						<?php echo form_error('emergency-phone'); ?>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<div class="group clear round">
		<b>Información Adicional</b>
		<ul>
			<li>
				<label for="blood-type" class="txt-med">Tipo de sangre</label>
				<input id="blood-type" name="blood-type" class="upper txt-small" type="text" value="<?php echo set_value('blood-type');?>" maxlength="2"/>
						<?php echo form_error('blood-type'); ?>
			</li>
			<div class="clear"></div>
			<li>
				<label for="allergies" class="txt-med">Alergico a:</label>
				<input id="allergies" name="allergies" class="upper txt-big" type="text" value="<?php echo set_value('allergies');?>" />
						<?php echo form_error('blood-type'); ?>
			</li>
			<div class="clear"></div>
			<li>
				<label for="chronic-diseases" class="txt-med">Enfermedades Crónicas</label>
				<input id="chronic-diseases" name="chronic-diseases" class="upper txt-big" type="text" value="<?php echo set_value('chronic-diseases');?>" />
						<?php echo form_error('chronic-diseases'); ?>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<h3 class="round">Documentación</h3>
	<div id="docs" class="group clear round">
		<div class="notify-alert">Toda la documentación adjunta debe estar en formato .PDF</div>
		<ul>
			<li class="clear">
				<label for="file-birth">Acta de Nacimiento</label>
				<input type="file" id="file-birth" name="file-birth"/>
						<?php echo '<div class="clear">'.form_error('file-birth').'</div>'; ?>
			</li>
			<li class="clear">
				<label for="file-Certificate">Constancia de Estudios</label>
				<input type="file" id="file-Certificate" name="file-Certificate"   />
						<?php echo '<div class="clear">'.form_error('file-Certificate').'</div>'; ?>
			</li>
			<li class="clear">
				<label for="file-CURP">CURP</label>
				<input type="file" id="file-CURP" name="file-CURP"  />
						<?php echo '<div class="clear">'.form_error('file-CURP').'</div>'; ?>
			</li>
			<li class="clear">
				<label for="file-academicHistory">Historial Académico</label>
				<input type="file" id="file-academicHistory" name="file-academicHistory"   />
						<?php echo '<div class="clear">'.form_error('file-academicHistory').'</div>'; ?>
			</li>
			<li class="clear">
				<label for="file-schoolCard-front">Credencial de Estudiante (anverso)</label>
				<input type="file" id="file-schoolCard-front" name="file-schoolCard-front"   />
						<?php echo '<div class="clear">'.form_error('file-schoolCard-front').'</div>'; ?>
			</li>
			<li class="clear">
				<label for="file-schoolCard-back">Credencial de Estudiante (reverso)</label>
				<input type="file" id="file-schoolCard-back" name="file-schoolCard-back"   />
						<?php echo '<div class="clear">'.form_error('file-schoolCard-back').'</div>'; ?>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<?php } ?>
	<p>
		<input id="sign-up" class="btn" type="submit" value="Registrar <?php echo ($coach)? 'Director Técnico' : 'Participante'; ?>"/>
	</p>
<?php echo form_close();?>
</div><!-- end main content>-->