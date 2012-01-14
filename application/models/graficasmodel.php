<?php

/**
 * Autor: Jose Argudo Blanco 
 */
class Graficasmodel extends CI_Model
{
    
    public function sieteUltimas( $disciplina, $usuario )
    {

	$query = $this->db->query('SELECT * 
				   FROM marcas
				   WHERE disciplina = "' . $disciplina . '" 
				   AND usuarioId = "' . $usuario . '"
				   ORDER BY fecha desc
				   LIMIT 0,7');

	$sieteUltimas = array();
	
	foreach ( $query->result() AS $row ) {

	    $sieteUltimas[] = $row;
	    
	}
	
	$sieteUltimas = array_reverse($sieteUltimas);
	
	return $sieteUltimas;
	
    }  

}