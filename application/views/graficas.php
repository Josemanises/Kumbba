<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/enhance.js"></script>		
<script type="text/javascript">
	// Run capabilities test
	enhance({
		loadScripts: [
			'<?php echo base_url(); ?>assets/js/excanvas.js',
			'<?php echo base_url(); ?>assets/js/visualize.jQuery.js',
			'<?php echo base_url(); ?>assets/js/example.js'
		],
		loadStyles: [
			'<?php echo base_url(); ?>assets/css/estadisticas/visualize.css',
			'<?php echo base_url(); ?>assets/css/estadisticas/visualize-light.css'
		]	
	});   
</script>
    
<?php
    $mensaje = $this->session->flashdata('mensaje');
    if ( !empty($mensaje) ) {
	?>
	   <p class="notification" ><strong style="color: brown;"><?php echo $mensaje; ?></strong></p>
	<?php
    }
?>

<div class="two-thirds column">
        
<table >
	<caption>Ultimas marcas carrera</caption>
	<thead>
		<tr>
		    <td></td>
		    <?php
		      foreach ( $sieteUltimasCarrera AS $marca ) {
			  $fecha = explode(' ', $marca->fecha);
			  $fechaDividida = explode('-', $fecha[0]);
			  
			  echo '<th scope="col">' . $fechaDividida[2] . '/' . $fechaDividida[1] . '</th>';			  
		      }
		    ?>			
		</tr>
	</thead>
	<tbody>
		<tr>
			<th scope="row">Kilometros</th>
			<?php
			  foreach ( $sieteUltimasCarrera AS $marca ) {
			      echo '<td>' . $marca->marca . '</td>';			  
			  }
			?>				
		</tr>		
	</tbody>
</table>
    
<br/><br/>

<table >
	<caption>Ultimas marcas natacion</caption>
	<thead>
		<tr>
		    <td></td>
		    <?php
		      foreach ( $sieteUltimasNatacion AS $marca ) {
			  $fecha = explode(' ', $marca->fecha);
			  $fechaDividida = explode('-', $fecha[0]);
			  
			  echo '<th scope="col">' . $fechaDividida[2] . '/' . $fechaDividida[1] . '</th>';			  
		      }
		    ?>			
		</tr>
	</thead>
	<tbody>
		<tr>
			<th scope="row">Metros</th>
			<?php
			  foreach ( $sieteUltimasNatacion AS $marca ) {
			      echo '<td>' . $marca->marca . '</td>';			  
			  }
			?>				
		</tr>		
	</tbody>
</table>

<br/><br/>

<table >
	<caption>Ultimas marcas ciclismo</caption>
	<thead>
		<tr>
		    <td></td>
		    <?php
		      foreach ( $sieteUltimasCiclismo AS $marca ) {
			  $fecha = explode(' ', $marca->fecha);
			  $fechaDividida = explode('-', $fecha[0]);
			  
			  echo '<th scope="col">' . $fechaDividida[2] . '/' . $fechaDividida[1] . '</th>';			  
		      }
		    ?>			
		</tr>
	</thead>
	<tbody>
		<tr>
			<th scope="row">Kilometros</th>
			<?php
			  foreach ( $sieteUltimasCiclismo AS $marca ) {
			      echo '<td>' . $marca->marca . '</td>';			  
			  }
			?>				
		</tr>		
	</tbody>
</table>

</div>	    

<div class="one-third column">
    

</div>