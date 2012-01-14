<?php

/**
 * Autor: Jose Argudo Blanco 
 */
class Emailmodel extends CI_Model
{
        
    /**
     * Enviamos email de aviso cuando se crea una nueva cuenta
     * 
     * @param string $nombre El nombre del usuario que ha creado la cuenta
     */
    public function enviarEmailAviso( $nombre = '')
    {
	$this->load->library('email');
	$this->email->from('jose@joseargudo.es', 'JAB');
	$this->email->to('josemanises@gmail.com'); 
	$this->email->subject('Se ha creado una cuenta en kumbba');
	$this->email->message('Se ha creado una cuenta para el usuario: ' . $nombre . '' );	
	$this->email->send();	    
    } 

}