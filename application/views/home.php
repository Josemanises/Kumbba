<?php
    $mensaje = $this->session->flashdata('mensaje');
    if ( !empty($mensaje) ) {
	?>
	   <p class="notification" ><strong style="color: brown;"><?php echo $mensaje; ?></strong></p>
	<?php
    }
?>

<div class="two-thirds column">
    <?php
	foreach ( $marcas as $marca ) {
	    ?>
		<p>
		    <?php
			switch ( $marca['disciplina'] ) {
			    case 'carrera':
				echo '<img src="' . base_url() . 'assets/images/icons/094_running.png" alt="carrera" title="carrera" width="33px" style="margin-bottom: -10px;"/> ';
				break;
			    
			    case 'ciclismo':
				echo '<img src="' . base_url() . 'assets/images/icons/047_disc.png" alt="ciclismo" title="ciclismo" width="33px" style="margin-bottom: -10px;"/> ';
				break;
			    
			    case 'natacion':
				echo '<img src="' . base_url() . 'assets/images/icons/095_swimming.png" alt="natación" title="natación" width="33px" style="margin-bottom: -10px;"/> ';
				break;
			}		    
			
		    ?>
		    <strong><?php echo $marca['nombre']; ?></strong>
		    hizo
		    <strong><u><?php echo $marca['marca']; ?>
		    <?php 
			switch ($marca['medida']) {
			    case 'm':
				if ( $marca['marca'] == 1 ) {
				    echo 'metro ';
				} else {
				    echo 'metros ';
				}
				break;
			    case 'km':
				if ( $marca['marca'] == 1 ) {
				    echo 'kilometro ';
				} else {
				    echo 'kilometros ';
				}								
				break;
			    default:
				echo 'repeticiones ';
			}		
			
			echo '</u></strong>';
			
			?>
			<a href="<?php echo base_url(); ?>graficas/ver/<?php echo $marca['usuarioId']; ?>"><img src="<?php echo base_url(); ?>assets/images/icons/058_graph.png" alt="Estadísticas" title="Estadísticas" width="33px" style="margin-bottom: -10px;"/></a>
			<?php
			    
			
			switch ( $marca['disciplina'] ) {
			    case 'carrera':
				echo 'corriendo';
				break;
			    
			    case 'ciclismo':
				echo 'en bicicleta';
				break;
			    
			    case 'natacion':
				echo 'nadando';
				break;
			}
		    ?>
		    en
		    <?php echo $marca['localizacion']; ?>
		    
		    <?php 
		    
			if ( !empty($marca['tiempo']) ) {
			    echo 'en <strong>';
			    echo $marca['tiempo'] . ' '; 
			    echo $marca['medidaTiempo']; 
			    echo '</strong>';
			}
			
			if ( $marca['mejorMarcaCarrera'] != '' ) {
			    
			    echo '<img src="' . base_url() . 'assets/images/icons/081_medal.png" alt="Record en  carrera: ' . $marca['mejorMarcaCarrera']->marca . ' kms" title="Record en carrera: ' . $marca['mejorMarcaCarrera']->marca . ' kms" width="33px" style="margin-bottom: -10px;"/> ';
			}
			
			if ( $marca['mejorMarcaNatacion'] != '' ) {
			    
			    echo '<img src="' . base_url() . 'assets/images/icons/081_medal.png" alt="Record en  natación: ' . $marca['mejorMarcaNatacion']->marca . ' metros" title="Record en natación: ' . $marca['mejorMarcaNatacion']->marca . ' metros" width="33px" style="margin-bottom: -10px;"/> ';
			}
			
			if ( $marca['mejorMarcaCiclismo'] != '' ) {
			    
			    echo '<img src="' . base_url() . 'assets/images/icons/081_medal.png" alt="Record en  ciclismo: ' . $marca['mejorMarcaCiclismo']->marca . ' kms" title="Record en ciclismo: ' . $marca['mejorMarcaCiclismo']->marca . ' kms" width="33px" style="margin-bottom: -10px;"/> ';
			}			
		    ?>	    
		    
		    <br/>
		    <span class="small">
			<?php echo $marca['fecha']; ?>
			
			<?php if(!empty($marca['comentario'])) { ?>
			    <img src="<?php echo base_url(); ?>assets/images/icons/015_chat.png" alt="<?php echo $marca['comentario']; ?>" title="<?php echo $marca['comentario']; ?>" width="22px" style="margin-bottom: -10px; cursor: pointer;"/>
			<?php } ?>
		    </span>
		    <hr width="550px"/>
		</p>
	    <?php
	}
	
	echo $this->pagination->create_links();
    ?>
	<br/><br/>
</div>	    

<div class="one-third column">
 
    <ul class="tabs">
       <li><a class="active" href="#marca"><strong>Añadir marca</strong></a></li>
      <li><a href="#mejores"><strong>Mejores marcas</strong></a></li>
    </ul>

    <ul class="tabs-content">
      <li class="active" id="marcaTab">
	  <?php
		if ( !($this->session->userdata('usuario')) ){
		    echo form_open('unirse/login');
		    ?>
			<h4>¡Accede a tu cuenta!</h4>
			<p>Y podrás compartir tus marcas deportivas con tus amigos</p>
			
			<label>Nombre:</label>
			<input type="text" name="nombre" value="" size="10"/>
			
			<label>Clave:</label>
			<input type="password" name="pass" value="" size="10"/>
			
			<input type="submit" value="Enviar" name="enviar" />
			
		    <?php
		    echo form_close();
		} else {		
	    ?>	
		    <h4>¡Añade tu última marca!</h4>
		    <?php
			echo form_open('home/marcar');
		    ?>
			<label>Marca:</label>
			<select name="marca">
			    <?php
				for ( $i = 1; $i < 3501; $i++ ) {
			    ?>
				<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			    <?php
				}
			    ?>
			</select>			    

			<label>Medida:</label>
			<select name="medida">
			    <option value="km">kilometros</option>
			    <option value="m">metros</option>			
			</select>				

			<select name="disciplina">
			    <option value="carrera">Carrera</option>
			    <option value="ciclismo">Ciclismo</option>
			    <option value="natacion">Natación</option>
			</select>				

			<label>Lugar:</label>
			<input type="text" name="localizacion" value=""/>
			
			<label>Tiempo:</label>
			<input type="text" name="tiempo" value=""/>			
			
			<select name="medidaTiempo">
			    <option value="horas">horas</option>
			    <option value="minutos">minutos</option>			
			</select>
			
			<label>Comentario:</label>
			<textarea name="comentario"></textarea>

			<input type="submit" value="Enviar" name="enviar" />

		<?php
			echo form_close();
		    }
		?>	
			
		<a href="<?php echo base_url(); ?>unirse/logout">Cerrar la sesión</a>	
      </li>
      <li id="mejoresTab">
	  <h4>Desde que comenzamos:</h4>
	  
	  <ul>
	      <li>- Los usuarios han hecho <strong><?php $total = !empty($totalCarrera->total) ? $totalCarrera->total : '0'; echo $total; ?></strong> kms corriendo</li>
	      <li>- Han nadado <strong><?php $total = !empty($totalNatacion->total) ? $totalNatacion->total : '0'; echo $total; ?></strong> metros </li>
	      <li>- Y realizado <strong><?php $total = !empty($totalCiclismo->total) ? $totalCiclismo->total : '0'; echo $total; ?></strong> kms en bicicleta </li>
	  </ul>
	  
	  <h4>Mejores marcas:</h4>
	  
	  <ul>
	      <?php
	       foreach ( $mejores AS $disciplina => $mejor ) {
		   switch ( $disciplina ) {
		       case 'carrera':
			   ?>
			   <li>- <strong><?php echo $mejor['usuario']; ?></strong> tiene la mejor marca de <strong>kms corriendo: <?php echo $mejor['marca']; ?></strong></li>
			   <?php
			   break;
		       
		       case 'natacion':
			   ?>
			   <li>- <strong><?php echo $mejor['usuario']; ?></strong> tiene la mejor marca de <strong>metros nadando: <?php echo $mejor['marca']; ?></strong></li>
			   <?php			   
			   break;
		       
		       case 'ciclismo':
			   ?>
			    <li>- <strong><?php echo $mejor['usuario']; ?></strong> tiene la mejor marca <strong>kms en bicicleta: <?php echo $mejor['marca']; ?></strong></li>
			   <?php			   
			   break;
		   }
	       }
	      ?>
	  </ul>
      </li>
    </ul>    

</div>