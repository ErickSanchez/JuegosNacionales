<script>
$(function(){
	
    $("#sport").load('<?php echo base_url()?>eventos/get_sports');

    
	$("#sport").change(function(event){
            var id = $("#sport").find(':selected').val();
            $("#sport-category").load('<?php echo base_url()?>stateadmin/get_sportcategory/'+id);
	});
    
	$("#sport-category").change(function(event){
            //var id = $("#sport-category").find(':selected').val();
            $("#team-one").load('<?php echo base_url()?>eventos/get_teams_by_group/'+$("#sport-category").find(':selected').val());
            $("#team-two").load('<?php echo base_url()?>eventos/get_teams_by_group/'+$("#sport-category").find(':selected').val());
	});

});
</script>
<div id="main-content">
	<?php if(isset($notification)){ ?><div id="notification" class="<?php echo $notification['type']; ?> round" title="Click para cerrar notificacion"><?php echo $notification['msg']; ?></div> <?php } ?>
	<h3 class="section-title round">REGISTRO DE EVENTOS</h3>
	<div>
           
            <?php

$attributes = array('id' => 'frm_signUp','name' => 'frm_signUp');
echo  form_open_multipart('eventos/register_up',$attributes);
?>
	<div class="group clear round">		
		<ul>
			<li>
				<label for="sport" class="txt-small">Deporte</label>
				<select id="sport" name="sport">
		
				</select>
                                <?php echo form_error('sport'); ?>
			</li>
			<li>
				<label for="sport-category" >Categoria</label>
				<select id="sport-category" name="sport-category">
					<option value="">SELECCIONE ..</option>
				</select>
                                <?php echo form_error('sport-category'); ?>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<div  class="group clear round">		
            
		<ul>
			<li>
				<label for="sede" class="txt-small">Sede</label>
				<select id="sede" name="sede">
                                    <option value="">SELECCIONE ..</option>
				<?php 	
                                foreach($sedes as $value){
                                    echo '<option value="'.$value->idheadquarters.'">'.$value->nameHeadquarters.'</option>'; 
                                }
                                ?>
				</select>
                                <?php echo form_error('sede'); ?>
			</li>
			<li>
				<label for="field" class="txt-small">Cancha</label>
				<input id="field" name="field" class="txt-small"/>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
            
	<div  class="group clear round">
         	<h3 class="round">Equipos</h3>
		<ul>
			<li>
				<label for="team-one" class="txt-small">Equipo Local:</label>
				<select id="team-one" name="team-one">
                                   <option value="">--</option>
                		</select>
                                <?php echo form_error('team-one'); ?>
			</li>
			<li><b>VS.</b></li>
			<li>
				<label for="team-two" class="txt-small">Equipo Visitante:</label>
				<select id="team-two" name="team-two">
                           		<option value="">--</option>
				</select>
                                <?php echo form_error('team-two'); ?>
			</li>
		</ul>
            </div>
            
	<div id="birthdate" class="group clear round">
         	<h3 class="round">Fecha del evento</h3>
		<ul>
			<li>
				<label for="day" class="txt-small">Dia</label>
				<select id="day" name="day">
					<option value="">--</option>
					<?php
						for($i=2; $i<6; $i++)
							echo('<option value="'.$i.'">'.$i.'</option>');
					?>
				</select>
                                <?php echo form_error('day'); ?>
			</li>
			<li>
					<label for="month" class="txt-small">Mes</label>
				<select id="month" name="month">
					 <option value="05">Mayo</option>
					<?php
						//$months = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
						//for($i=0; $i<count($months); $i++)
						//	echo('<option value="'.($i+1).'">'.$months[$i].'</option>');
					?>
				</select>
			</li>
			<li>
				<label for="year" class="txt-small">Año</label>
				<select id="year" name="year">
                                    <option value="2012">2012</option>
				</select>
                                
			</li>
		</ul>
            </div>
            
	<div id="birthdate" class="group clear round">
         	<h3 class="round">Hora el evento</h3>
		<ul>
			<li>
				<label for="hour" class="txt-small">Hora</label>
				<select id="hour" name="hour">
					<option value="">--</option>
					<?php
						for($i=0; $i<24; $i++){
							if($i<10)
								echo('<option value="0'.$i.'">0'.$i.'</option>');
							else
								echo('<option value="'.$i.'">'.$i.'</option>');
						}
					?>
				</select>
                                <?php echo form_error('hour'); ?>
			</li>
			<li>
					<label for="minute" class="txt-small">Minuto</label>
				<select id="minute" name="minute">
                                        <option value="00">--</option>
					<?php
						for($i=0; $i<=59; $i+=5)
							if($i<9)
								echo('<option value="0'.$i.'">0'.$i.'</option>');
							else
								echo('<option value="'.$i.'">'.$i.'</option>');
					?>
				</select>
			</li>
		</ul>
            </div>
            
	<p>
		<input id="" class="btn" type="submit" value="Registrar evento"/>
	</p>
<?php echo form_close();?>
            
	</div>
</div>