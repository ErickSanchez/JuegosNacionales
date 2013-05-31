<div id="main-content"><a name="top"></a>
<?php if(isset($notification)){ ?><div id="notification" class="<?php echo $notification['type']; ?> round" title="Click para cerrar notificacion"><?php echo $notification['msg']; ?></div> <?php } ?>
  
	<div id="teams-area">
		<h3 class="section-title round">Selecciones Registradas :: SIAJ</h3>
		<!-- Index states -->
		<?php echo $index; ?>
		<!-- end Index -->
		<div class="clear"></div>
		<?php echo $searchForm; ?>
	</div>
</div><!-- end main content>-->