<div id="main-index-content">
	<div class="section round">
		<h3 class="section-title round"><img src="<?php echo base_url()?>images/ico-rss-16.png" /> CALENDARIO DE EVENTOS</h3>
		<ul class="menu-sports round">
			<li><a href="#" class="soccer">Futbol</a></li>
			<li><a href="#" class="basket">Basquetbol</a></li>
			<li><a href="#" class="volley">Voleybol</a></li>
			<div class="clear"></div>
		</ul>
		
		<table class="table-list">
			<tr>
				<th>Equipos</th>
				<th>Hora</th>
				<th>Fecha</th>
				<th>Lugar</th>
			</tr>
        <?php if($scheduleSoccer ) foreach($scheduleSoccer as $event)
            {
                ?>
             <tr>
		<td class="prev-event-teams">EQUIPO <?php echo $event->teamOneAssignation; ?> vs. EQUIPO <?php echo $event->teamTwoAssignation; ?></td>
                <td class="prev-event-time"><?php echo substr($event->dateTimeEvent,11,5);?> hrs.</td>
		<?php 	$months = array('01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');?>
				<td class="prev-event-datetime" align="center"><?php echo substr($event->dateTimeEvent,8,2).' de '.$months[substr($event->dateTimeEvent,5,2)].', '.substr($event->dateTimeEvent,0,4);?></td>
				
		<td class="prev-event-place"><?php echo $event->nameHeadquarters; ?><a href="<?php echo base_url().'eventos/sedes/'.$event->idheadquarters; ?>" class="btn">Ver</a></td>
            </tr>
         <?php
                       
        } ?>
		</table>
		<table class="table-list">
			<tr>
				<th>Equipos</th>
				<th>Hora</th>
				<th>Fecha</th>
				<th>Lugar</th>
			</tr>
        <?php if($scheduleBasket ) foreach($scheduleBasket as $event)
            {
                ?>
             <tr>
		<td class="prev-event-teams">EQUIPO <?php echo $event->teamOneAssignation; ?> vs. EQUIPO <?php echo $event->teamTwoAssignation; ?></td>
                <td class="prev-event-time"><?php echo substr($event->dateTimeEvent,11,5);?> hrs.</td>
		<?php 	$months = array('01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');?>
				<td class="prev-event-datetime" align="center"><?php echo substr($event->dateTimeEvent,8,2).' de '.$months[substr($event->dateTimeEvent,5,2)].', '.substr($event->dateTimeEvent,0,4);?></td>
				
		<td class="prev-event-place"><?php echo $event->nameHeadquarters; ?><a href="<?php echo base_url().'eventos/sedes/'.$event->idheadquarters; ?>" class="btn">Ver</a></td>
            </tr>
         <?php
                       
        } ?>
		</table>
		<table class="table-list">
			<tr>
				<th>Equipos</th>
				<th>Hora</th>
				<th>Fecha</th>
				<th>Lugar</th>
			</tr>
        <?php if($scheduleVolley ) foreach($scheduleVolley as $event)
            {
                ?>
             <tr>
		<td class="prev-event-teams">EQUIPO <?php echo $event->teamOneAssignation; ?> vs. EQUIPO <?php echo $event->teamTwoAssignation; ?></td>
                <td class="prev-event-time"><?php echo substr($event->dateTimeEvent,11,5);?> hrs.</td>
		<?php 	$months = array('01'=>'Enero','02'=>'Febrero','03'=>'Marzo','04'=>'Abril','05'=>'Mayo','06'=>'Junio','07'=>'Julio','08'=>'Agosto','09'=>'Septiembre','10'=>'Octubre','11'=>'Noviembre','12'=>'Diciembre');?>
				<td class="prev-event-datetime" align="center"><?php echo substr($event->dateTimeEvent,8,2).' de '.$months[substr($event->dateTimeEvent,5,2)].', '.substr($event->dateTimeEvent,0,4);?></td>
				
		<td class="prev-event-place"><?php echo $event->nameHeadquarters; ?><a href="<?php echo base_url().'eventos/sedes/'.$event->idheadquarters; ?>" class="btn">Ver</a></td>
            </tr>
         <?php
                       
        } ?>
		</table>
		
		<?php echo anchor('eventos/calendario','Ver calendario completo','class="btn"'); ?>
	</div>
	<div class="section round">
		<h3 class="section-title round"><img src="<?php echo base_url()?>images/ico-rss-16.png" /> TABLAS DE POSICIONES</h3>
		<ul>
			<li><a href="#" class="btn">Futbol</a></li>
			<li><a href="#" class="btn">Basquetbol</a></li>
			<li><a href="#" class="btn">Voleybol</a></li>
		</ul>
	</div>
</div>