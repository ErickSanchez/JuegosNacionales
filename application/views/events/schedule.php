<script type="text/javascript" src="https://apis.google.com/js/plusone.js">{lang: 'es-419'}</script>	  
<div id="main-content">
	<h3 class="section-title round">CALENDARIO DE EVENTOS</h3>
	<div>
		<ul class="menu-sports round">
			<li><?php echo anchor('eventos/calendario/Futbol','Futbol','class="soccer"');?></li>
			<li><?php echo anchor('eventos/calendario/Basquetbol','Basquetbol','class="basket"');?></li>
			<li><?php echo anchor('eventos/calendario/Voleibol','Voleibol','class="volley"');?></li>
			<li><?php echo anchor('eventos/calendario/Ajedrez','Ajedrez','class="other"');?></li>
			<div class="clear"></div>
		</ul>
		<table class="schedule" cellspacing="0">
                 				 
<?php 	if($events){
			$sportCategory='';
			$i=0;
			foreach($events as $event){
				if($event->groupName=='SF' || $event->groupName=='FN'){
						if($event->groupName=='SF')
							echo '
							<tr>
								<td colspan="6" class="subtitle-2">SEMIFINAL '.$event->sportName.' '.$event->sportCategoryName.'</td>
							</tr>';
						if($event->groupName=='FN')
							echo '
							<tr>
								<td colspan="6" class="subtitle-3">FINAL '.$event->sportName.' '.$event->sportCategoryName.'</td>
							</tr>';
				}
				if($sportCategory!=$event->sportCategoryName){ 
						echo '
							<tr>
								<td colspan="6" class="subtitle">'.$event->sportName.' '.$event->sportCategoryName.'</td>
							</tr>';
				?>
						<tr>
							<th>Equipos</th><th>Resultado</th><th>Hora</th><th>Fecha</th><th>Lugar</th><th align="right"></th>
						</tr>
				<?php	$sportCategory=$event->sportCategoryName;
				} 
				?>
				<tr>
					<td class="prev-event-teams"><?php echo ($event->teamOneName!='') ? $event->teamOneName : $event->teamOneAssignation; $i++;?> vs. <?php echo ($event->teamTwoName!='') ?$event->teamTwoName : $event->teamTwoAssignation; $i++?></td>
					<td align="center"><?php echo ($event->scoreTeamOne!='' && $event->scoreTeamTwo!='')? '<b>'.$event->scoreTeamOne.'</b> - <b>'.$event->scoreTeamTwo.'</b>' : '-'; ?></td>
					<td class="prev-event-time" align="center"><?php echo substr($event->dateTimeEvent,11,5);?> hrs.</td>
					<?php 	$months = array('01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');?>
					<td class="prev-event-datetime" align="center"><?php echo substr($event->dateTimeEvent,8,2).' de '.$months[substr($event->dateTimeEvent,5,2)].', '.substr($event->dateTimeEvent,0,4);?></td>
					<td class="prev-event-place" align="center"><?php echo $event->nameHeadquarters; if($event->field) echo ' (CANCHA #'.$event->field.')';?></td>
					<td><a href="<?php echo base_url().'sedes/'; ?>" class="round">Ver</a></td>
				</tr>
<?php       } 
		}
?>
		</table>
		<div class="clear"></div>
	</div>
</div>