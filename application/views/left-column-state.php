<div id="left-column">
	<div class="menu round">
		<h3 class="section-title round">Panel de Administración</h3>
		<ul>
			<?php if(@$ed) echo "<li>".anchor('stateadmin/view_team/'.$participant->idteam.'/'.$participant->idsport, 'Equipo', 'title="Participantes"')."</li>";?>
			<li><?php echo anchor('stateadmin', 'Selecciones', 'title="Selecciones"');?></li>
			<li><?php echo anchor('login/logout', 'Salir', 'title="Salir"');?></li>
		</ul>
	</div>
	<div id="banner-manual" class="banner-area">
		<?php echo anchor('', '<img src="'.base_url().'images/banner-convocatoria.jpg" />', 'title="Ver Manual" target="_blank"');?>
	</div>
</div>