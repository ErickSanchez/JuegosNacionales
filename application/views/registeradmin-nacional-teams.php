<div id="main-content"><a name="top"></a>
		<?php if(isset($index))echo $index; ?>
		<table id="teams" class="table-list" cellspacing="0">
			<tr>
				<th width="16"></th>
				<th width="100">Deporte</th>
				<th width="70">Categoría</th>
				<th>Plantel</th>
				<th>Ciudad</th>
				<th>Cupo</th>
				<th width="130">Acción</th>
			</tr>
			<?php 
		
		$i=0;
		$states = array();
		$statesId = array();
		$stateName='';
		$count=0;
		if(!count($teams))
			echo '<tr><td colspan="5"><center>Aun no hay equipos registrados</center></td></tr>';
		else
			foreach ($teams as $row){
				if($stateName!=$row->stateName){
					echo '
			<tr>
				<th class="subtitle" colspan="7"><b><a name="'.$row->stateName.'"></a>'.$row->stateName.'</b><a class="help" href="#top"><img src="'.base_url().'images/ico-arrow-up.png" />Ir Arriba</a></th>
			</tr>';
					array_push($states,$row->stateName);
					array_push($statesId,$row->idstate);
					$stateName=$row->stateName;
				}
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
				$count += $row->sportParticipantsLimit;
				echo '
			<tr>
				<td><img src="'.base_url().'images/circle_'.$status_img.'" title="'.$status_lbl.'" /></td>
				<td>'.$row->sportName.'</td>
				<td>'.$row->sportCategoryName.'</td>
				<td>'.$row->campusName.'</td>
				<td>'.$row->cityName.'</td>
				<td align="center">'.$totals[$i++]->total.'/'.$row->sportParticipantsLimit.'</td>
				<td class="action">';
                                 echo anchor('stateadmin/view_team/'.$row->idteam.'/'.$row->idsport, '<img src="'.base_url().'images/ico-group-view.png" /> Ver', '');
                                 echo anchor('stateadmin/delete_team/'.$row->idteam, '<img src="'.base_url().'images/ico-cancel.png" /> Eliminar', 'onclick="return confirm(\'¿Desea eliminar el equipo '.$row->campusName.'?\n(Si elimina este equipo se eliminaran automaticamente todos sus participantes)\');"');
			
		echo '</td>
			</tr>';
			}?>
		</table>
<?php 	echo form_open('registeradmin/generate',array('id'=>'frm_formats','class'=>'round','target'=>'_blank')); ?>
			<h3 class="section-title round">Formatos</h3>
			<label for="docType">Formato</label>
			<select id="docType" name="docType">
				<option value="0">SELECCIONE..</option>
				<option value="1">CÉDULA</option>
				<option value="2">CREDENCIALES</option>
				<option value="3">ACTA DE NAC. E HIST. ACADEMICO</option>
			</select>
			<div class="clear"></div>
			<label for="state">Estado</label>
			<select id="state" name="state">
<?php			if(count($states)>1)
					echo '<option value="0">SELECCIONE..</option>';
				for($i=0; $i<count($states); $i++)
					echo '<option value="'.$statesId[$i].'">'.$states[$i].'</option>';
?>
			</select>
			<label for="team">Categoría</label>
			<select id="team" name="team">
				<option>SELECCIONE..</option>
			</select>
			<div class="clear"></div>
			<input class="btn" type="submit" value="Generar" />
			<div class="clear"></div>
<?php	echo form_close(); ?>
<script>
$(function(){
	
	<?php if(count($states)<2){?>
	$("#team").load('<?php echo base_url()?>registeradmin/get_sportcategory_by_state/'+$("#state").find(':selected').val());
	<?php } ?>
	$("#state").change(function(event){
            var id = $("#state").find(':selected').val();
            $("#team").load('<?php echo base_url()?>registeradmin/get_sportcategory_by_state/'+id);
	});
});
</script>
</div>