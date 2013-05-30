<div id="main-content">
	<?php echo '<pre style="text-align: left">'; print_r($participants); echo '</pre>'; ?>
	<?php if(isset($notification)){ ?><div id="notification" class="<?php echo $notification['type']; ?> round" title="Click para cerrar notificacion"><?php echo $notification['msg']; ?></div> <?php } ?>

	<div id="participants-area">
		<h3 class="round"><?php echo $team->sportName.' '.$team->sportCategoryName.' <br /><span class="gray">('.$team->campusName.' de '.$team->cityName.', '.$team->stateName; ?>)</span></h3>
		<table id="participants" class="table-list" cellspacing="0">
			<?php
                        
		if(!count($participants))
			echo '<tr><td colspan="6"><center>No hay participantes registrados</center></td></tr>';
		else
			foreach ($participants as $row){
				echo '
			<tr>
				<td><img src="'.base_url().'images/circle_grey.png" title="" /></td>
				<td>'.$row->jerseyNumber.'</td>
				<td>'.$row->lastName.' '.$row->sureName.' '.$row->firstName.'</td>
				<td align="center">'.$row->semester.'</td>
				<td align="center">'.$row->group.'</td>
				<td align="center">'.$row->schoolEnrollment.'</td>
				<td class="action">';
                        
                                echo anchor('participant/edit/'.$row->idparticipant, '<img src="'.base_url().'images/ico-group-edit.png" /> Editar', '');
                                echo anchor('participant/delete/'.$row->idparticipant.'/'.$team->idteam.'/'.$sport, '<img src="'.base_url().'images/ico-cancel.png" /> Eliminar', ' onclick="return confirm(\':Desea eliminar al participante:\n - '.$row->lastName.' '.$row->sureName.' '.$row->firstName.' ?\');"');
                        
                 echo  '</td>
			</tr>';
			}
		if(isset($coach->idparticipant) && $coach->firstName)
                {
			echo '
			<tr class="coach">
				<td><img src="'.base_url().'images/circle_grey.png" title="" /></td>
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
		if($participants_total->total == $participants_limits->sportParticipantsLimit){
			echo '<h3 class="notify-ok round clear">Equipo completo</h3>';
		}
		else{
			if($participants_total->total < $participants_limits->sportParticipantsMin)
				echo '<div class="notify-alert clear">Ha registrado '.$participants_total->total.' participantes. Debe registrar '.$participants_limits->sportParticipantsMin.' participantes como mínimo.</div>';
			else
				echo '<div class="notify-alert clear">Puede registrar '.($participants_limits->sportParticipantsLimit-$participants_total->total).' participantes más.</div>';
			
                        echo anchor('signup/participant/'.$team->idteam.'/'.$sport, 'Registrar Participante', 'class="btn"');
                        
		}
	?>
	</div>
</div><!-- end main content>-->
