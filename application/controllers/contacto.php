<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Autor: Jose Argudo Blanco <jose@joseargudo.com>
 */
class Contacto extends Kumbba_Controller
{

    public function __construct() 
    {
	parent::__construct();
    }
    
    /**
     * Mostramos la pagina con la información de contacto
     */
    public function index()
    {
	$this->_render('contacto');
    }
    
}