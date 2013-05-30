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
	</div>
	<table class="schedule" cellspacing="0">
		<tr>
			<td class="subtitle"><?php echo $sportName; ?></td>
		</tr>
		<tr>
			<td class="notify">
				<?php ?>
			</td>
		</tr>
	</table>
</div>