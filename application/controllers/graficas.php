<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Autor: Jose Argudo Blanco <jose@joseargudo.com>
 */
class Graficas extends Kumbba_Controller
{

    public function __construct() 
    {
	parent::__construct();
	$this->load->model('graficasmodel');
    }
    
    /**
     * Mostramos las gráficas del usuario, con los últimos 7 días
     */    
    public function ver( $usuario = 0 )
    {	
	$data['sieteUltimasCarrera']  = $this->graficasmodel->sieteUltimas('carrera', $usuario);
	$data['sieteUltimasNatacion'] = $this->graficasmodel->sieteUltimas('natacion', $usuario);
	$data['sieteUltimasCiclismo'] = $this->graficasmodel->sieteUltimas('ciclismo', $usuario);
	
	$this->_render('graficas', $data);
    }   

}