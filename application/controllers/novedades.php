<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Autor: Jose Argudo Blanco <jose@joseargudo.com>
 */
class Novedades extends Kumbba_Controller
{

    public function __construct() 
    {
	parent::__construct();
    }
    
    /**
     * Página donde mostramos los cambios y novedades
     */
    public function index()
    {
	$this->_render('novedades');
    }     
    
}