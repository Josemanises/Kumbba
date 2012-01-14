<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Autor: Jose Argudo Blanco <jose@joseargudo.com>
 */
class Home extends Kumbba_Controller
{

    public function __construct() 
    {
	parent::__construct();
	$this->load->model('homemodel');
    }
    
    /**
     * Página donde se muestran todas las marcas
     */
    public function index( $inicio = 0, $porPagina = 20 )
    {
	$data['mejores']       = $this->homemodel->obtenerMejores();	
	$data['totalCarrera']  = $this->homemodel->obtenerTotal('carrera');
	$data['totalNatacion'] = $this->homemodel->obtenerTotal('natacion');
	$data['totalCiclismo'] = $this->homemodel->obtenerTotal('ciclismo');	
	$data['marcas']	       = $this->homemodel->obtenerTodos( $inicio, $porPagina );
	
	$this->_paginate( '/home/index/', 3, $this->homemodel->totalMarcas(), $porPagina );
	
	$this->_render('home', $data);
    }
    
    /**
     * Insertamos una nueva marca
     */
    public function marcar()
    {           
        $this->homemodel->insertar($_POST);
	redirect('/home/index', 'refresh');        
    }
       
}