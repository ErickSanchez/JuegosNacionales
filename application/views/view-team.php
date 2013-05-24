
<div id="main-content">
	<?php if(isset($notification)){ ?><div id="notification" class="<?php echo $notification['type']; ?> round" title="Click para cerrar notificacion"><?php echo $notification['msg']; ?></div> <?php } ?>
	<?php 
			$error_coach=false;
			if(!@$coach->firstName || !@$coach->lastName || !@$coach->sureName || !@$coach->birthdate || !@$coach->email || !@$coach->curp || !@$coach->filePhoto){ 
			$error_coach=true;
	?>
	<div id="dt_info" class="round">
		<h3 class="round section-title">NOTIFICACION</h3>
		<div class="notify-alert">
			<b> <?php if(!empty($team)) echo 'La información de su Director Técnico esta incompleta, ingrese toda la información requerida.'; else echo 'Todavia no sea registrado este equipo';?></b>
		</div>
		<?php if(!empty($team)) echo anchor('participant/edit/'.@$coach->idparticipant.'/1', 'Editar DT', 'class="btn"'); ?>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
	<?php } 

	if(!empty($team)){
	?>
	<div id="participants-area">
		<h3 class="round"><?php echo @$team->sportName.' '.@$team->sportCategoryName.' <br /><span class="gray">('.@$team->campusName.' de '.@$team->cityName.', '.@$team->stateName; ?>)</span></h3>
		<table id="participants" class="table-list" cellspacing="0">
			<tr>
				<th width="16"></th>
				<th width="30">N°</th>
				<th>Nombre</th>
				<th width="50">Semestre</th>
				<th width="50">Grupo</th>
				<th>Matricula</th>
				<th width="140">Acción</th>
			</tr>

			<?php
                        
		if( !count($participants))
			echo '<tr><td colspan="6"><center>No hay participantes registrados</center></td></tr>';
		else{
			$i=0;
			foreach ($participants as $row){
				$errors = count($participants_check[$i]['log']);
				echo '
			<tr>
				<td><img src="'.base_url().'images/circle_'; echo (!$errors) ? 'green.png' : 'yellow.png'; echo '" title="" /></td>
				<td>'.$row->jerseyNumber.'</td>
				<td>'.$row->lastName.' '.$row->sureName.' '.$row->firstName.'</td>
				<td align="center">'.$row->semester.'</td>
				<td align="center">'.$row->groupParticipant.'</td>
				<td align="center">'.$row->schoolEnrollment.'</td>
				<td class="action">';
                        
                                echo anchor('participant/edit/'.$row->idparticipant, '<img src="'.base_url().'images/ico-group-edit.png" /> Editar', '');
                                echo anchor('participant/delete/'.$row->idparticipant.'/'.$team->idteam.'/'.$sport, '<img src="'.base_url().'images/ico-cancel.png" /> Eliminar', ' onclick="return confirm(\':Desea eliminar al participante:\n - '.$row->lastName.' '.$row->sureName.' '.$row->firstName.' ?\');"');
                 echo  '</td>';
				if($errors){
					echo '
				<tr>
					<td></td>
					<td colspan="6" class="notify-alert">
						<b>Datos aún no registrados ('.$errors.'):</b> <i>';
							$j=1;
							foreach($participants_check[$i++]['log'] as $value){
								if($j++>1)
									echo ',';
								echo ' '.$value;
							}
						echo'</i>
					</td>
				</tr>';
				}
				else
					$i++;
			echo '
			</tr>';
			}
		}
		if(isset($coach->idparticipant) && $coach->firstName)
                {
			echo '
			<tr class="coach">
				<td><img src="'.base_url().'images/circle_'; 
				if(!$error_coach)
					echo 'grey.png';
				else
					echo 'yellow.png';
			echo '" title="" /></td>
				<td>D.T.</td>
				<td colspan="4">'.$coach->lastName.' '.$coach->sureName.' '.$coach->firstName.'</td>
				<td class="action">';
                        echo anchor('participant/edit/'.$coach->idparticipant.'/1', '<img src="'.base_url().'images/ico-group-edit.png" /> Editar');
                        	//<a href="'.base_url().'participant/delete/'.$coach->idparticipant.'/'.$team->idteam.'/'.$sport.'" onclick="return confirm(\'Desea eliminar al D.T. de este equipo?\');"><img src="'.base_url().'images/ico-cancel.png" /> Eliminar</a>
			echo '</td>';
			
                }
		else
                {
			echo '
			<tr class="coach not-set">
				<td><img src="'.base_url().'images/circle_grey.png" title="" /></td>
				<td>D.T.</td>
				<td colspan="4">NO REGISTRADO</td>
				<td class="action">';	
                             echo anchor('participant/edit/'.@$coach->idparticipant.'/1', '<img src="'.base_url().'images/ico-group-edit.png"/>Agregar DT', '');
                echo '</td>
			</tr>';
                }
		?>
		</table>
		<div class="clear"></div>
		<?php 
		if(@$participants_total->total == @$participants_limits->sportParticipantsLimit){
			echo '<h3 class="notify-ok round clear">Equipo completo</h3>';
		}
		else{
			if(@$participants_total->total < @$participants_limits->sportParticipantsMin)
				echo '<div class="notify-alert clear">Ha registrado '.$participants_total->total.' participantes. Debe registrar '.$participants_limits->sportParticipantsMin.' participantes como mínimo.</div>';
			else
				echo '<div class="notify-alert clear">Puede registrar '.(@$participants_limits->sportParticipantsLimit- @$participants_total->total).' participantes más.</div>';
			
                        echo anchor('signup/participant/'.$team->idteam.'/'.$sport, 'Registrar Participante', 'class="btn"');
                        
		}
	}
	?>
	</div>
</div><!-- end main content>-->
