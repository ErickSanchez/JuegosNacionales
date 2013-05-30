<script>
$(function(){
    $('#frm_login #username').focus();
});
</script>
<div id="main-content">
    <?php if(isset($notification)){ ?><div id="notification" class="<?php echo $notification['type']; ?> round" title="Click para cerrar notificacion"><?php echo $notification['msg']; ?></div> <?php } ?>
<h3 class="round">Iniciar Sesión</h3>
<?php 
	$data_frm = array(
			'id' 	=> 'frm_login',
			'class'	=> 'form section round',
		);
	$data_user = array(	
			'id' 	=> 'username',
			'name'	=> 'username',
			'class'	=> 'txt_med'
		);
	$data_pass = array(	
			'id' 	=> 'password',
			'name'	=> 'password',
			'class'	=> 'txt_med'
		);
	$data_submit = array(	
			'id' 	=> 'submit',
			'name'	=> 'submit',
			'value'	=> 'Entrar',
			'class'	=> 'btn'
		);
	echo form_open('login/signIn',$data_frm);
	echo form_label('Usuario');
	echo form_input($data_user);
	echo form_label('Contraseña');
	echo form_password($data_pass);
	echo form_submit($data_submit);
	echo '<div class="clear"></div>';
	echo form_close();
?>
</div>