<script type="text/javascript" src="https://apis.google.com/js/plusone.js">{lang: 'es-419'}</script>	  
<div id="main-content">
	<h3 class="section-title round">TABLA GENERAL</h3>
	<div>
		<ul class="menu-sports round">
			<li><?php echo anchor('estadisticas/tabla_general/Futbol','Futbol','class="soccer"');?></li>
			<li><?php echo anchor('estadisticas/tabla_general/Basquetbol','Basquetbol','class="basket"');?></li>
			<li><?php echo anchor('estadisticas/tabla_general/Voleibol','Voleibol','class="volley"');?></li>			
			<li><?php echo anchor('estadisticas/tabla_general/Ajedrez','Ajedrez','class="other"');?></li>
			<div class="clear"></div>
		</ul>
		<table class="schedule" cellspacing="0">
                 				 
<?php 	if($events){
			$sportCategory='';
			$group='';
			$semifinals=array();
			$i=0;
			foreach($events as $event){
				if($sportCategory!=$event->sportCategoryName){ ?>
						<tr>
							<td colspan="9" class="subtitle"><?php echo $sportName.' '.$event->sportCategoryName; ?></td>
						</tr>
				<?php	$sportCategory=$event->sportCategoryName;
				}
				if($group!=$event->groupName){ 	?>
						<tr>
							<td colspan="9" class="subtitle-2">GRUPO <?php echo $event->groupName; ?></td>
						</tr>
						<tr>
							<th>Equipo</th><th>JJ</th><th>JG</th><th>JP</th><th>JE</th><th>AF</th><th>AC</th><th>DIF</th><th>PTS</th>
						</tr>
				<?php	$group=$event->groupName;
				} 
				?>
				<tr>
					<td><?php echo $event->stateName; ?></td>
					<td align="center"><?php echo $event->games; ?></td>
					<td align="center"><?php echo $event->wins; ?></td>
					<td align="center"><?php echo $event->fails; ?></td>
					<td align="center"><?php echo $event->games-($event->fails+$event->wins); ?></td>
					<td align="center"><?php echo $favor = $event->scoreVisit+$event->scoreLocal; ?></td>
					<td align="center"><?php echo $contra = $event->againstScoreVisit+$event->againstScoreLocal; ?></td>
					<td align="center"><?php echo $favor-$contra; ?></td>
					<td align="center"><?php echo $event->wins*3; ?></td>
				</tr>
<?php       } 
		}
?>
		</table>
		<div class="clear"></div>
		<p>
			<br /><b>JJ</b>: Juegos Jugados | <b>JG</b>: Juegos Ganados | <b>JP</b>: Juegos Perdidos | <b>JE</b>: Juegos Empatados<br /><b>AF</b>: Anotaciones a Favor | <b>AC</b>: Anotaciones en Contra | <b>DIF</b>: Diferencia de puntos | <b>PTS</b>: Total de Puntos
		</p>
	</div>
</div>