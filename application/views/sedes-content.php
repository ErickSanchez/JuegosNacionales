<div id="main-index-content">
	<div class="section round">
		<h3 class="section-title round"><img src="<?php echo base_url()?>images/ico-map.png" /> SEDES</h3>
		<ul id="sedes-list">
		<?php
			foreach($sedes as $row){
				echo '
			<li class="prev-sede">
				<ul class="prev-article-data">
					<li class="prev-article-title"><a name="'.$row->nameHeadquarters.'">'.$row->nameHeadquarters.'</a></li>
					<li class="prev-article-desc">'.$row->street; echo ($row->number) ? ' #'.$row->number : ' S/N'; echo ', '.$row->colony.', C.P. '.$row->zipCode.'</li>
				</ul>
			</li>';
			}
		?>
		<div class="clear"></div>
		</ul>
	</div>
</div>