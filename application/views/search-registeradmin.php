<div id="main-content"><a name="top"></a>
<?php if(isset($notification)){ ?><div id="notification" class="<?php echo $notification['type']; ?> round" title="Click para cerrar notificacion"><?php echo $notification['msg']; ?></div> <?php } ?>
	<?php echo $searchForm; ?>
	<div id="result">
	<?php
		if(!isset($result))
			echo 'Ingrese una búsqueda';
		else{
			
			echo '
		<table id="participants" class="table-list" cellspacing="0">
			<tr>
				<th width="30">N°</th>
				<th>Nombre</th>
				<th width="50">Semestre</th>
				<th width="50">Grupo</th>
				<th>Matricula</th>
				<th width="140">Acción</th>
			</tr>
			';
			if(!count($result))
				echo '<tr><td colspan="6"><center>No hay participantes registrados</center></td></tr>';
			foreach($result as $row){
				echo '
					<tr>
						<td>'.@$row->jerseyNumber.'</td>
						<td align="left">'.$row->lastName.' '.$row->sureName.' '.$row->firstName.'</td>
						<td align="center">'.$row->semester.'</td>
						<td align="center">'.$row->groupParticipant.'</td>
						<td align="center">'.$row->schoolEnrollment.'</td>
						<td class="action">';
										echo anchor('participant/edit/'.$row->idparticipant, '<img src="'.base_url().'images/ico-group-edit.png" /> Editar', '');
										echo anchor('participant/delete/'.$row->idparticipant.'/'.$row->idteam.'/'.$row->idsport, '<img src="'.base_url().'images/ico-cancel.png" /> Eliminar', ' onclick="return confirm(\':Desea eliminar al participante:\n - '.$row->lastName.' '.$row->sureName.' '.$row->firstName.' ?\');"');
										echo anchor('registeradmin/expedient/'.$row->idparticipant.'/'.$row->idteam, '<img src="'.base_url().'images/ico-folder.png" />Generar Expediente');
						 echo  '</td>
					</tr>';
			}
			echo '
				</table>';
		}
		
	?>
	</div>
</div><!-- end main content>-->