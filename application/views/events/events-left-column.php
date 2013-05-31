<div id="left-column">
    
   <?php if($this->session->userdata('userType') == COORDINATOR_NATIONAL)
    {?>
	<div class="menu round">
		<h3 class="section-title round">ADMINISTRADOR</h3>
		<ul><?php
				echo "<li>".anchor('eventos/assign', 'Asignar Grupos', 'title="Asignar Grupo"')."</li>";
				echo "<li>".anchor('eventos/register','Crear Evento', 'title="Crear evento"')."</li>";
                echo "<li>".anchor('eventos/add_score','Registrar Marcador', 'title="Registrar marcador"')."</li>";                        
                echo "<li>".anchor('eventos/edit','Editar Evento', 'title="Editar evento"')."</li>";                        
			?>
		</ul>
	</div>
   <?php   }?>
	<div class="menu round">
		<h3 class="section-title round">EVENTOS</h3>
		<ul>
			<?php 
				foreach($sports as $row)
					echo '<li>'.anchor('eventos/calendario/'.ucfirst(mb_strtolower($row->sportName)).'/',ucfirst(mb_strtolower($row->sportName, 'UTF-8')), 'title="'.ucfirst(mb_strtolower($row->sportName)).'"').'</li>';
			?>
		</ul>
	</div>
	<div class="menu round">
		<h3 class="section-title round">SEDES</h3>
		<ul>
		<?php
			foreach($sedes as $row)
				echo '<li><a href="'.base_url().'sedes/">'.$row->nameHeadquarters.'</a></li>';
		?>
		</ul>
	</div>
	<div class="section round">
		<h3 class="section-title round"><img src="<?php echo base_url()?>images/ico-map.png" /> Patrocinadores</h3>
		<?php echo anchor('#','<img src="'.base_url().'images/logo_HolidayInnExpress.jpg" width="150" />','target="_blank"'); ?>
	</div>
	<div class="clear"></div>
</div>