<?php
    $mensaje = $this->session->flashdata('mensaje');
    if ( !empty($mensaje) ) {
	?>
	   <p style="padding: 4px; border: 1px solid crimson; background-color: #D893A1;"><strong style="color: brown;"><?php echo $mensaje; ?></strong></p>
	<?php
    }
?>

<div class="two-thirds column">
    <h4>¡Crea tu cuenta, es muy sencillo!</h4>
    <p>
	Solo debes elegir un <strong>nombre</strong>, que será el que aparezca en tus mensajes. 
	Y una <strong>clave</strong>, con la que podremos saber que eres tú. No necesitamos tu correo ni ningún dato personal, pero <strong>recuerda</strong>, no olvides la clave.
    </p>
    
    <?php	
	echo form_open('unirse/index');
	
	echo form_label('Nombre:', 'nombre');
	echo form_input('nombre', set_value('nombre'));
	echo form_error('nombre', '<div style="color: red; margin-bottom: 10px;">', '</div>'); 
	
	echo form_label('Clave ( No utilices contraseñas que utilices para otras cosas ):','pass');
	echo form_password('pass', set_value('pass'));
	echo form_error('pass', '<div style="color: red; margin-bottom: 10px;">', '</div>');
	
	echo form_submit('enviar','Enviar');
	
	echo form_close();
    ?>
</div>