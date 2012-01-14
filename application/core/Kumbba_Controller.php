<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Extends CI_Controller providing common methods for controllers
 *
 * @author Jose Argudo Blanco <jose@joseargudo.com>
 */
class Kumbba_Controller extends CI_Controller
{
    public function __construct() 
    {
	parent::__construct();
    }
    
    /**
     * Método encargado de cargar las vistas y pasarles las variables
     * 
     * @param string $view Indicamos la vista a utilizar
     * @param array $data Array que contiene las variables a enviar a la vista
     */
    protected function _render( $view = '', $data = array() )
    {
	$this->load->view('cabecera');
	$this->load->view($view, $data);
	$this->load->view('pie');	
    }
    
    /**
     * Método encargado de inicializar la paginación
     * 
     * @param string $url Url de los enlaces de la paginación
     * @param integer $segment En que segmento de la url añadir las paginas
     */
    protected function _paginate( $url = '', $segment = 3, $total = 0, $porPagina = 20 )
    {
	$this->load->library('pagination');
	
	$config['base_url'] = $this->config->item('base_url') . $url;
	$config['total_rows'] = $total;
	$config['uri_segment'] = $segment;
	$config['per_page'] = $porPagina; 
	$config['first_link'] = 'Inicio';
	$config['last_link'] = 'Último';

	$this->pagination->initialize($config); 	
    }
}