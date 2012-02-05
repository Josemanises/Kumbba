<?php

/**
 * Autor: Jose Argudo Blanco 
 */
class Graficasmodel extends CI_Model
{
    
    public function sieteUltimas( $disciplina, $usuario )
    {
	$this->db->select('*')
	     ->from('marcas')
	     ->where('disciplina', $disciplina)
	     ->where('usuarioId', $usuario)
	     ->order_by('fecha', 'desc')
	     ->limit(7, 0); // Note that this is written inversely as MySQL does
	
	$query = $this->db->get();

	$sieteUltimas = array();
		
	foreach ( $query->result() AS $row ) {
	    $sieteUltimas[] = $row;	    
	}
	
	$sieteUltimas = array_reverse($sieteUltimas);
	
	return $sieteUltimas;	
    }  

}