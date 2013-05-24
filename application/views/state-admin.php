<script>
$(function(){

	$('.upper').keyup(function() {
        this.value = this.value.toUpperCase();
    });
	
    $("#state").load('<?php echo base_url()?>signup/get_states/'+<?php echo @$state->idstate;?>);

    $("#city").load('<?php echo base_url()?>signup/get_cities/'+<?php echo @$state->idstate;?>);

	$("#city").change(function(event){
            var id = $("#city").find(':selected').val();
            $("#campus").load('<?php echo base_url()?>stateadmin/get_campus/'+id);
	});

	$("#sport").change(function(event){
        var id = $("#sport").find(':selected').val();
        $("#sport-category").load('<?php echo base_url()?>stateadmin/get_sportcategory/'+id+'/'+<?php echo @$state->idstate;?>);
	});
});
</script>
<div id="main-content">
<?php if(isset($notification)){ ?><div id="notification" class="<?php echo $notification['type']; ?> round" title="Click para cerrar notificacion"><?php echo $notification['msg']; ?></div> <?php } ?>
  <?php 
		if((!@$coordinator->coordinatorName) || (!@$coordinator->userEmail) || (!@$coordinator->userPhone))
      { ?>
	<div id="coordinator_info">
		<h3 class="round section-title">Datos de Usuario</h3>
		<div class="notify-alert"><b>Bienvenido <?php echo @$coordinator->username; ?>, su información esta incompleta:</b></div>
		<?php echo form_open('stateadmin/set_coordinator_info',array('id'=>'frm_set-coordinator'));?>
		<div class="group round">
			<ul>
			<?php if(!@$coordinator->coordinatorName){ ?>
				<li>
					<label for="coordinator-name">Nombre</label>
					<input id="coordinator-name" name="coordinator-name" class="upper txt-big" type="text" value="<?php echo $coordinator->coordinatorName; ?>"/>
				</li>
			<?php }if(!@$coordinator->userEmail){ ?>
				<li>
					<label for="coordinator-email">Email</label>
					<input id="coordinator-email" name="coordinator-email" class="txt-big" type="text" value="<?php echo $coordinator->userEmail; ?>"/>
				</li>
			<?php }if(!@$coordinator->userPhone){ ?>
				<li>
					<label for="coordinator-phone">Teléfono</label>
					<input id="coordinator-phone" name="coordinator-phone" type="text" maxlength="10" value="<?php echo $coordinator->userPhone; ?>"/>
				</li>
			<?php } ?>
				<li>
					<center><input class="btn" type="submit" value="Actualizar información"></center>
				</li>
			</ul>
		</div>
		<div class="clear"></div>

  <?php echo form_close(); ?>
      </div>
  <?php } ?>

	<div id="teams-area">
		<h3 class="section-title round">Selecciones Registradas en <?php echo $state->stateName; ?></h3>
		<table id="teams" class="table-list" cellspacing="0">
			<tr>
				<th width="16"></th>
				<th width="100">Deporte</th>
				<th width="70">Categoría</th>
				<th>Plantel</th>
				<th>Ciudad</th>
				<th>Cupo</th>
				<th width="140">Acción</th>
			</tr>
			<?php $i=0;
		if(!count($teams))
			echo '<tr><td colspan="5"><center>Aun no hay equipos registrados</center></td></tr>';
		else
			foreach ($teams as $row){
				$status_img='';
				$status_lbl='';
				if($totals[$i]->total==0){
					$status_img='grey.png';
					$status_lbl='Equipo vacío (Ningún participante registrado)';
				}
				else{
					if($totals[$i]->total < $row->sportParticipantsMin){
						$status_img='yellow.png';
						$status_lbl='Equipo incompleto (No cumple el mínimo de participantes)';
					}
					else{
						$status_img='green.png';
						$status_lbl='Equipo válido (Cumple el mínimo de participantes requeridos)';
					}
				}
				echo '
			<tr>
				<td><img src="'.base_url().'images/circle_'.$status_img.'" title="'.$status_lbl.'" /></td>
				<td>'.$row->sportName.'</td>
				<td>'.$row->sportCategoryName.'</td>
				<td>'.$row->campusName.'</td>
				<td>'.$row->cityName.'</td>
				<td align="center">'.$totals[$i++]->total.'/'.$row->sportParticipantsLimit.'</td>
				<td class="action">';
                                 echo anchor('stateadmin/view_team/'.$row->idteam.'/'.$row->idsport, '<img src="'.base_url().'images/ico-group-edit.png" /> Editar', '');
                                 echo anchor('stateadmin/delete_team/'.$row->idteam, '<img src="'.base_url().'images/ico-cancel.png" /> Eliminar', 'onclick="return confirm(\'¿Desea eliminar el equipo '.$row->campusName.'?\n(Si elimina este equipo se eliminaran automaticamente todos sus participantes)\');"');
			
		echo '</td>
			</tr>';
			} ?>
		</table>
		<?php if(count($teams)<9){ //display teams
				echo '<div class="notify-info"><b>Faltan equipos en:</b>';
				$i=1;
				foreach ($sports as $row){
					if($i++>1)
						echo ',';
					echo ' '.$row->sportName;
				}
				echo '</div>';
		?>
	</div>

    <?php echo form_open('stateadmin/add_team',array('id'=>'frm_add-selection'));?>
		<h3 class="section-title round">Registrar Selección</h3>
		<label for="sport">Deporte <?php echo form_error('sport'); ?></label>
		<select id="sport" name="sport" >
			<option value="">SELECCIONE..</option>
		  <?php foreach ($sports as $row)
					echo '<option value="'.$row->idsport.'">'.$row->sportName.'</option>';
			?>
		</select>
		<label for="city">Ciudad <?php echo form_error('city'); ?></label>
		<select id="city" name="city" >
			<option value="">SELECCIONE..</option>
		</select>
		<div class="clear"></div>
		<label for="sport-category">Categoria <?php echo form_error('sport-category'); ?></label>
		<select id="sport-category" name="sport-category">
			<option value="">SELECCIONE DEPORTE..</option>
		</select>
		<label for="campus">Plantel <?php echo form_error('campus'); ?></label>
		<select id="campus" name="campus">
			<option value="">SELECCIONE CIUDAD..</option>
		</select>
		<div class="clear"></div>
		<div id="ccl-confirm">
			<label for="cct">Clave Centro de Trabajo <br /><span class="help">* CCT de 10 caracteres</span><?php echo form_error('cct'); ?></label>
			<input id="cct" name="cct" maxlength="10"/>
			<label for="cct-confirm">Confirmar CCT<?php echo form_error('cct-confirm'); ?></label>
			<input id="cct-confirm" name="cct-confirm"  maxlength="10"/>
		</div>
		<div class="clear"></div>
		<input class="btn" type="submit" value="Registrar Equipo">
	<?php echo form_close(); ?>
	<?php
		}
		else{
			echo '<h3 class="notify-ok round">Todas las selecciones estan registradas</h3>';
		}
	?>
</div><!-- end main content>-->