<script>
$(function(){
	
    $("#sport").load('<?php echo base_url()?>eventos/get_sports');

    
	$("#sport").change(function(event){
            var id = $("#sport").find(':selected').val();
            $("#sport-category").load('<?php echo base_url()?>stateadmin/get_sportcategory/'+id);
	});
    
	$("#sport-category").change(function(event){
            var id = $("#sport-category").find(':selected').val();
            $("#team").load('<?php echo base_url()?>eventos/get_campus/'+id);
            $("#groups").load('<?php echo base_url()?>eventos/get_groups/'+id);
	});
	
	$("#groups").change(function(event){
            var id = $("#groups").find(':selected').val();
            $("#vars").load('<?php echo base_url()?>eventos/get_vars_not_assigned/'+id);
	});


});
</script>

<div id="main-content">
	<?php if(isset($notification)){ ?><div id="notification" class="<?php echo $notification['type']; ?> round" title="Click para cerrar notificacion"><?php echo $notification['msg']; ?></div> <?php } ?>
	<h3 class="section-title round">ASIGNACIÓN DE GRUPO</h3>
	<div>
           
            <?php

$attributes = array('id' => 'frm_signUp','name' => 'frm_signUp');
echo  form_open_multipart('eventos/assign_up',$attributes);
?>
            <h3 class="round">Deporte</h3>
	<div  class="round">		
            
		<ul>
			<li>
				<label for="sport" class="txt-small">Deporte</label>
				<select id="sport" name="sport">
		
				</select>
                                <?php echo form_error('sport'); ?>
			</li>
			<li>
				<label for="sport-category" class="">Categoria</label>
				<select id="sport-category" name="sport-category">
					<option value="">SELECCIONE ..</option>
				</select>
                                <?php echo form_error('sport-category'); ?>
			</li>
		</ul>
		<div class="clear"></div>
	</div>
	<div  class="group clear round">
		<h3 class="round">Asignación de Grupo</h3>
		<ul>
			<li>
				<label for="team" class="txt-small">Plantel</label>
				<select id="team" name="team">
					<option value="">SELECCIONE ..</option>
				</select>
                                <?php echo form_error('team'); ?>
			</li>            
		</ul>
	</div>
	<div  class="group clear round">

		<ul>                        
			<li>
				<label for="groups" class="txt-small">Grupo</label>
				<select id="groups" name="groups">
					<option value="">SELECCIONE ..</option>
				</select>
					<?php echo form_error('groups'); ?>
			</li>                        
			<li>
				<label for="vars" class="txt-small">Clave de Grupo</label>
				<select id="vars" name="vars">
					<option value="">SELECCIONE ..</option>
				</select>
					<?php echo form_error('vars'); ?>
			</li>
		</ul>
            </div>
	<p>
		<input id="" class="btn" type="submit" value="Asignar a grupo"/>
	</p>
<?php echo form_close();?>
            
	</div>
</div>