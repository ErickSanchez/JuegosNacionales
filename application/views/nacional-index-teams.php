		<table id="states-index" class="table-list col2"  cellspacing="0">
			<tr>
				<th colspan="2">ESTADOS REGISTRADOS</th>
			</tr>
			<tr>
				<th>Estado</th>
				<th>Estado</th>
			</tr>
			<?php
				$i=0;
				$stateName='';
				$states = array();
				$statesId = array();
				foreach ($teams as $row)
					if($stateName!=$row->stateName){
						array_push($states,$row->stateName);
						array_push($statesId,$row->idstate);
						$stateName=$row->stateName;
					}
				for($i=0,$j=(count($states)/2)+1; $i<(count($states)/2); $i++,$j++){
					echo '
					<tr>
						<td><a href="'.base_url().'registeradmin/nacional/'.$statesId[$i].'"><img src="'.base_url().'images/ico-group-link.png" /> '.$states[$i].'</a></td>
						<td>';
					if($j<count($states))
						echo '<a href="'.base_url().'registeradmin/nacional/'.@$statesId[$j].'"><img src="'.base_url().'images/ico-group-link.png" /> '.@$states[$j].'</a>';
					echo '</td>
					</tr>';
				}
			?>
		</table>
		<table id="sport-resume" class="table-list col2"  cellspacing="0">
			<tr>
				<th>Deporte</th>
				<th>Categoría</th>
				<th>Equipos</th>
			</tr>
		<?php
		$sport='';
		foreach($sports_teams_resume as $row)
			echo '
			<tr>
				<td>'.$row->sportName.'</td>
				<td>'.$row->sportCategoryName.'</td>
				<td align="center">'.$row->total.'</td>
			</tr>
			';
		?>
		</table>