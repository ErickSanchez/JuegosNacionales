<script>
$(function(){
	
        /////////////////////////////////////////////////
    $("#sport-edit").load('<?php echo base_url()?>eventos/get_sports');

    
	$("#sport-edit").change(function(event){
            var id = $("#sport-edit").find(':selected').val();
            $("#sport-category-edit").load('<?php echo base_url()?>stateadmin/get_sportcategory/'+id);
	});
    
	$("#sport-category-edit").change(function(event){
            var id = $("#sport-category-edit").find(':selected').val();
            $("#event").load('<?php echo base_url()?>eventos/get_events/'+id);
        
	});
	$("#event").change(function(event){
            var id = $("#sport-category-edit").find(':selected').val();
                       $("#team-one").load('<?php echo base_url()?>eventos/get_teams_by_group/'+id);
                       $("#team-two").load('<?php echo base_url()?>eventos/get_teams_by_group/'+id);
            
	});
        
        //////////////////////////////////////////////////////////////////////
	
    $("#update").click(function(event){
        if($("#team-one").find(':selected').val())
           if($("#team-one").find(':selected').val() == $("#team-two").find(':selected').val())
               {
                    alert('Los eqipos no pueden ser iguales');
                        return false;
               }
           
	});

});
</script>
<div id="main-content">
    
	<h3 class="section-title round">ELIGE UN EVENTO</h3>
	<div>
           
            <?php

$attributes = array('id' => 'frm_signUp','name' => 'frm_signUp');
echo  form_open('eventos/edit_up',$attributes);
?>
        
	<div  class="round">		
            
		<ul>
			<li>
				<label for="sport-edit" class="txt-small">Deporte</label>
				<select id="sport-edit" name="sport-edit">
                                        <option value="">SELECCIONE ..</option>
				</select>
                                
			</li>
			<li>
				<label for="sport-category-edit" class="">Categoria</label>
				<select id="sport-category-edit" name="sport-category-edit">
					<option value="">SELECCIONE ..</option>
				</select>
                                
			</li>
                        <br><br>
			<li>
				<label for="event" class="txt-small">Evento</label>
				<select id="event" name="event">
                                    	<option value="">SELECCIONE ..</option>
				</select>
                                <input class="round" id="delete" name="delete" type="submit" value="Eliminar"/>
                                <?php echo form_error('event'); ?>
			</li>
			
		</ul>
		<div class="clear"></div>
	</div>
           <h3 class="section-title round">DATOS DEL EVENTO (Solo seleccione los datos que desea actualizar)</h3> 
	<div  class="group clear round">		
            <h3 class="round">Lugar</h3>
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
				<label for="field" class="txt-small">Cancha</label>
				<input id="field" name="field" class="txt-small"/>
                                
			</li>
			<div class="clear"></div>
		</ul>
		<div class="clear"></div>
	</div>
            
            
	<div  class="group clear round">
         	<h3 class="round">Equipos</h3>
		<ul>
			<li>
				<label for="team-one" class="txt-small"></label>
				<select id="team-one" name="team-one">
                                    <option value="">--</option>
                                    <?php 	
                                foreach($groups as $value){
                                    echo '<option value="'.$value->nameGroup.'">'.$value->nameGroup.'</option>'; 
                                }
                                ?>
				</select>
                                
			</li>
			<li>
				<label for="team-two" class="txt-small">Vs.</label>
				<select id="team-two" name="team-two">
                                    <option value="">--</option>
					      <?php 	
                                foreach($groups as $value){
                                    echo '<option value="'.$value->nameGroup.'">'.$value->nameGroup.'</option>'; 
                                }
                                ?>
				</select>
                     
			
			</li>
			<div class="clear"></div>
		</ul>
            </div>
            
	<div  class="group clear round">
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
			<div class="clear"></div>
		</ul>
            </div>
            
	<div  class="group clear round">
         	<h3 class="round">Hora el evento</h3>
		<ul>
			<li>
				<label for="hour" class="txt-small">Hora</label>
				<select id="hour" name="hour">
					<option value="">--</option>
					<?php
						for($i=1; $i<=24; $i++)
							echo('<option value="'.$i.'">'.$i.'</option>');
					?>
				</select>
                               
			</li>
			<li>
					<label for="minute" class="txt-small">Minuto</label>
				<select id="minute" name="minute">
                                        <option value="">--</option>
					<?php
						for($i=0; $i<=59; $i+=5)
							echo('<option value="'.($i).'">'.($i).'</option>');
					?>
				</select>
			</li>
			<div class="clear"></div>
		</ul>
            </div>
            
	<p>
		<input id="update" name="update" class="btn" type="submit" value="Actualizar Evento"/>
	</p>
<?php echo form_close();?>
          
	</div>
</div>