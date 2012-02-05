<?php

/**
 * Autor: Jose Argudo Blanco 
 */
class Unirsemodel extends CI_Model
{
        
    /**
     * Inserta un nuevo usuario, y devuelve su id
     * 
     * @param array $data
     * @return integer 
     */
    public function insertar( array $data = array() )
    {
    	unset( $data['enviar'] );
	
	$busquedaNombre = $this->buscarPorNombre( $data['nombre'] );
	
	if ( $busquedaNombre > 0 ) {
	    return 'nombreIncorrecto';
	}
	        
	$this->db->insert('usuarios', $data); 
		
	$ultimoId = $this->db->insert_id();
	    
	return (int) $ultimoId;
    }

    /**
     * Buscamos si el nombre ya existe
     * 
     * @param string $nombre
     * @return int 
     */
    public function buscarPorNombre( $nombre = '' ) 
    {	
	$query = $this->db->get_where('usuarios', array('nombre' => $nombre ));
	
	return (int) $query->num_rows();
    }
       
    /**
     * Intentamos logar el usuario
     * 
     * @param type $usuario
     * @param type $password
     * @return string 
     */
    public function validarUsuario( $nombre = '', $pass = '')
    {
    
        $this->db->where('nombre', $nombre)
	     ->where('pass', $pass);
	
        $query = $this->db->get('usuarios');
        
        if ($query->num_rows() > 0){	
        
            $row = $query->row();
                                    
            if ( $nombre == $row->nombre && $pass == $row->pass){
                
                $this->session->set_userdata('usuario', TRUE);
		$this->session->set_userdata('usuarioId', $row->id);
                                    
                redirect('/home/index', 'refresh');
                
            }else{
		$this->session->set_flashdata('mensaje', 'Usuario y contrase&ntilde;a incorrectos');
            } 	
            
        }else{        
            $this->session->set_flashdata('mensaje', 'Usuario y contrase&ntilde;a incorrectos');
        }

        return NULL;
    
    }  

}