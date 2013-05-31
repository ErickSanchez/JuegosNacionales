			<!-- slider -->
			<div class="slider-wrapper theme-default">
				<div id="slider" class="nivoSlider">		
<?php 
	$slider = array(
					'<img src="'.base_url('images/slider/basketball.jpg').'" />',
					'<img src="'.base_url('images/slider/futbol.jpg').'" alt="" />',
					'<img src="'.base_url('images/slider/morelia.jpg').'" alt="" />');
	shuffle($slider);
	foreach($slider as $image)
		echo $image;
?>
				</div>
			</div>
			<!-- end slider -->