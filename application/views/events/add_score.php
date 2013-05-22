<script>
$(function(){
	
        /////////////////////////////////////////////////
    $("#sport").load('<?php echo base_url()?>eventos/get_sports');

    
	$("#sport").change(function(event){
            var id = $("#sport").find(':selected').val();
            $("#sport-category").load('<?php echo base_url()?>stateadmin/get_sportcategory/'+id);
	});
    
	$("#sport-category").change(function(event){
            var id = $("#sport-category").find(':selected').val();
            $("#idevent").load('<?php echo base_url()?>eventos/get_events_no_record/'+id);
        
	});
	$("#idevent").change(function(event){
            var id = $("#idevent").find(':selected').val();
                       $("#team-one").load('<?php echo base_url()?>eventos/get_team_one/'+id);
                       $("#team-two").load('<?php echo base_url()?>eventos/get_team_two/'+id);
            
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
<?php if(isset($notification)){ ?><div id="notification" class="<?php echo $notification['type']; ?> round" title="Click para cerrar notificacion"><?php echo $notification['msg']; ?></div> <?php } ?>
    
	<h3 class="section-title round">ELIGE UN EVENTO</h3>
	<div>
           
            <?php

$attributes = array('id' => 'frm_signUp','name' => 'frm_signUp');
echo  form_open('eventos/register_score',$attributes);
?>
        
	<div  class="round">		
            
		<ul>
			<li>
				<label for="sport" class="txt-small">Deporte</label>
				<select id="sport" name="sport">
                                        <option value="">SELECCIONE ..</option>
				</select>
                                
			</li>
			<li>
				<label for="sport-category" class="">Categoria</label>
				<select id="sport-category" name="sport-category">
					<option value="">SELECCIONE ..</option>
				</select>
                                
			</li>
                        <br><br>
			<li>
				<label for="idevent" class="txt-small">Evento</label>
				<select id="idevent" name="idevent">
                                    	<option value="">SELECCIONE ..</option>
				</select>
			</li>
			
		</ul>
		<div class="clear"></div>
	</div>
    <h3 class="section-title round">RESULTADO DEL EVENTO</h3> 
		<h3 class="round">Marcador Final</h3>
		<ul>
			<li>
				<label for="team-one" class="txt-small">Equipo Local</label>
				<select id="team-one" name="team-one">
					<option value="">SELECCIONE ..</option>
				</select>
				<input id="scoreTeamOne" name="scoreTeamOne" class="txt-small"/>
			</li>
			<div class="clear"></div>
			<li>
				<label for="team-two" class="txt-small">Equipo Visitante</label>
				<select id="team-two" name="team-two">
					<option value="">SELECCIONE ..</option>
				</select>
				<input id="scoreTeamTwo" name="scoreTeamTwo" class="txt-small"/>
			</li>
			<li class="clear"><?php echo form_error('scoreTeamOne'); ?><?php echo form_error('scoreTeamTwo'); ?></li>
		</ul>
		<div class="clear"></div>
	</div>
	<p>
		<input id="update" name="update" class="btn" type="submit" value="Registrar Marcador"/>
	</p>
<?php echo form_close();?>
          
	</div>