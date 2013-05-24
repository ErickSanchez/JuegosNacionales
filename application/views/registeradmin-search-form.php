		<h3 class="section-title round">Buscar participante</h3>
		<?php echo form_open('registeradmin/search',array('id'=>'frm_search','class'=>'round'));?>
				<label for="p_lastName">Apellido Paterno:</label>
				<input id="p_lastName" name="p_lastName" class="txt-med"/>
				<label for="p_sureName">Apellido Materno:</label>
				<input id="p_sureName" name="p_sureName" class="txt-med"/>
				<div class="clear"></div>
				<label for="p_firstName" class="txt-small">Nombre:</label>
				<input id="p_firstName" name="p_firstName" class="txt-big"/>
				<div class="clear"></div>
				<label for="p_schoolEnrollment" class="txt-small">Matrícula:</label>
				<input id="p_schoolEnrollment" name="p_schoolEnrollment">
				<label for="p_curp">CURP:</label>
				<input id="p_curp" name="p_curp" />
				<div class="clear"></div>
				<input id="p_search" name="p_search" class="btn" type="submit" value="Buscar" />
				<div class="clear"></div>
		<?php echo form_close(); ?>