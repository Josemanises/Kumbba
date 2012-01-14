<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Autor: Jose Argudo Blanco <jose@joseargudo.com>
 */
class Unirse extends Kumbba_Controller
{

    public function __construct() 
    {
	parent::__construct();
	$this->load->model('unirsemodel');
	$this->load->model('emailmodel');
    }
    
    /**
     * Mostramos el formulario de creación de la cuenta
     */
    public function index()
    {
	if ( !empty( $_POST['enviar']) ) {
	    
	    $this->_checkRequiredUserData($_POST);
		
	    if ( $this->unirsemodel->insertar($_POST) == 'nombreIncorrecto') {
		$this->session->set_flashdata('mensaje', 'El nombre ya está en uso, por favor selecciona otro.');
		redirect('/unirse/index', 'refresh'); 
	    } else {
		$this->session->set_flashdata('mensaje', '¡Tu cuenta se ha creado correctamente!');
		$this->emailmodel->enviarEmailAviso( $_POST['nombre']);
		redirect('/unirse/index', 'refresh'); 			
	    }
	}
	
	$this->_render('unirse');
    }
    
    /**
     * Método que comprueba si recibimos todos los datos necesarios para crear
     * la nueva cuenta
     * 
     * @param array $data Array containing user 'nombre' y 'pass'
     */
    private function _checkRequiredUserData( $data = array() )
    {
	if ( empty($data['nombre']) || empty($data['pass']) || $data['nombre'] == '' || $data['pass'] == '') {
	    $this->session->set_flashdata('mensaje', 'Debes insertar un nombre y una clave');
	    redirect('/unirse/index', 'refresh'); 		
	}	
    }
    
    /**
     * Validamos un usuario
     */
    public function login()
    {
	if ( !empty($_POST['nombre']) && !empty($_POST['pass']) ){
	    $data = $this->unirsemodel->validarUsuario( $_POST['nombre'], $_POST['pass'] );
	}

	redirect('/home/index', 'refresh');		
    }   
    
    /**
    * Cerramos la sesión actual
    */
    public function logout()
    {
	$this->session->set_userdata('usuario', FALSE);
	$this->session->set_userdata('usuarioId', 0);

	redirect('/home/index', 'refresh');		
    }   
    
}