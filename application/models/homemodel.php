<?php

/**
 * Autor: Jose Argudo Blanco 
 */
class Homemodel extends CI_Model
{
    
    /**
     * Obtenemos el nombre de usuario a través del password
     * 
     * @param int $id
     * @return string 
     */
    public function obtenerNombre( $id = '' ) 
    {
	$query = $this->db->get_where('usuarios', array('id' => $id ));
	$resultado = $query->row();
	
	if ( $query->num_rows() > 0 ) {
	    return (string) $resultado->nombre;
	} else {
	    return 'Nadie';
	}
    }
    
    public function totalMarcas()
    {
	$total = $this->db->get('marcas');	
	$total = $total->num_rows();	
	
	return $total;
    }
    
    /**
     * Obtiene todas las marcas ordenadas por id
     * 
     * @return array 
     */    
    public function obtenerTodos( $inicio = 0, $porPagina = 30 )
    {	
	$this->load->helper('date');
	
	$marcas = $this->db->order_by('id', 'desc')->get('marcas', $porPagina, $inicio );	
	$marcas = $marcas->result_array();
	
	$marcasAsociadas = array();
	
	foreach ( $marcas as $marca ) {
	    
	    $marca['nombre'] = $this->obtenerNombre( $marca['usuarioId'] );   
	    $marca['fecha'] = dateToText( $marca['fecha'] );
	    $marca['mejorMarcaCarrera'] = $this->getMejorCarrera( $marca['usuarioId'] );
	    $marca['mejorMarcaNatacion'] = $this->getMejorNatacion( $marca['usuarioId'] );;
	    $marca['mejorMarcaCiclismo'] = $this->getMejorCiclismo( $marca['usuarioId'] );;
	    
	    $marcasAsociadas[] = $marca;
	    
	}
	
	return $marcasAsociadas;
    }    
    
    /**
     * Inserta una nueva marca, y devuelve su id
     * 
     * @param array $data
     * @return integer 
     */
    public function insertar( array $data = array() )
    {
    	unset( $data['enviar'] );
        
	// Comprobamos si el usuario esta logueado
	if ( !($this->session->userdata('usuario')) ){
	    $this->session->set_flashdata('mensaje', 'Debes acceder a tu cuenta antes de insertar una marca');
	    return NULL;
	}
	
	$data['fecha'] = date('Y-m-d H:m:s');
	$data['usuarioId']  = $this->session->userdata('usuarioId');
	
	$this->db->insert('marcas', $data); 
	$this->insertarRecord( $data['usuarioId'], $data['marca'], $data['disciplina'] );
		
	$ultimoId = $this->db->insert_id();
	
	if ( $ultimoId > 0 ) {
	    $this->session->set_flashdata('mensaje', '¡Tu nueva marca se ha insertado!');
	}
    
	return (int) $ultimoId;
    }
       
    public function insertarRecord( $usuarioId, $marca, $disciplina )
    {
	$this->db->select_max('marca');
	$this->db->where('disciplina', $disciplina); 
	$query = $this->db->get('records');	
	$maxMarca = $query->row();
	
	if ( $marca > $maxMarca->marca ) {
	    
	    $record = array();
	    
	    $record['usuario_id'] = $usuarioId;
	    $record['marca'] = $marca;
	    $record['disciplina'] = $disciplina;
	    
	    $this->db->where('disciplina', $disciplina);
	    $this->db->update('records', $record); 	    
	    
	}

    }
    
    /**
     * Obtenemos el total de kilometros/metros por disciplina
     * 
     * @return rowObject 
     */
    public function obtenerTotal( $disciplina = '')
    {
	$this->db->select_sum('marca', 'total');
	$this->db->group_by('disciplina'); 
	$query = $this->db->get_where('marcas', array('disciplina' => $disciplina));
	
	return $query->row();
    }
    
    /**
     * Obtenemos el participante que más marcas ha acumulado en los últimos 7 días
     */
    public function obtenerMejores()
    {
	$disciplinas = array(
	    0 => 'carrera',
	    1 => 'natacion',
	    2 => 'ciclismo'
	);
	
	$max = array(
	    'carrera' => array('marca' => 0, 'usuario' => '', 'usuarioId' => ''),
	    'natacion' => array('marca' => 0, 'usuario' => '', 'usuarioId' => ''),
	    'ciclismo' => array('marca' => 0, 'usuario' => '', 'usuarioId' => '')
	);
	
	foreach ( $disciplinas AS $disciplina ) {
	    
	    $query = $this->db->query('SELECT usuario_id, marca 
				       FROM records
				       WHERE disciplina = "' . $disciplina . '"');
	    
	    foreach ( $query->result() AS $row ) {
		
		$max[$disciplina]['marca'] = $row->marca;
		$max[$disciplina]['usuario'] = $this->obtenerNombre($row->usuario_id);
		$max[$disciplina]['usuarioId'] = $row->usuario_id;
	
	    }
	    
	}

	return $max;
	
    }
       
    public function getMejorCarrera( $usuario = 0 )
    {
	$query = $this->db->query('SELECT * FROM records WHERE usuario_id = "' . $usuario . '" AND disciplina="carrera"');
	
	if ( $query->num_rows() > 0 ) {
	    $result = $query->row();
	    return $result;
	} else {
	    return '';
	}
	
    }
    
    public function getMejorNatacion( $usuario = 0 )
    {
	$query = $this->db->query('SELECT * FROM records WHERE usuario_id = "' . $usuario . '" AND disciplina="natacion"');
	
	if ( $query->num_rows() > 0 ) {
	    $result = $query->row();
	    return $result;
	} else {
	    return '';
	}
	
    }
    
    public function getMejorCiclismo( $usuario = 0 )
    {
	$query = $this->db->query('SELECT * FROM records WHERE usuario_id = "' . $usuario . '" AND disciplina="ciclismo"');
	
	if ( $query->num_rows() > 0 ) {
	    $result = $query->row();
	    return $result;
	} else {
	    return '';
	}
	
    }    

}