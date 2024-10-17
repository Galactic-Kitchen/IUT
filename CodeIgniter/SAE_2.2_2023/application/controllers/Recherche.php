<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recherche extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_recherche');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
	}
	public function index(){
		$this->load->view('layout/header');
		$this->load->view('recherche_list');
		$this->load->view('layout/footer');

		
	}
	public function resultat($id) {
		$recherche = filter_input(INPUT_GET, 'recherche');	
		if($recherche !== FILTER_NULL_ON_FAILURE) {
			$this->load->view('layout/header');
			if($id=='artiste') {
				$rech['artiste'] = $this->model_recherche->rechercheArtiste($recherche);
				 //var_dump($rech['artiste']);
				 
				$this->load->view('resultat_recherche',$rech);
				
			}

			if($id=='album') {
				$rech['album'] = $this->model_recherche->rechercheAlbum($recherche);
				 //var_dump($rech['artiste']);
				 
				$this->load->view('resultat_recherche_album',$rech);
			}

			if($id=='chanson') {
				$rech['chanson'] = $this->model_recherche->rechercheMusique($recherche);

				$this->load->view('resultat_recherche_chanson',$rech);
			}
			$this->load->view('layout/footer');
		}
	}
	
    public function view($id) {
        $this->load->view('layout/header');
        if ($id =='artiste') {
        		
        		$this->load->view('recherche_artiste');
        }

        if($id =='album'){
            $this->load->view('recherche_album');
        }

        if($id=='chanson'){
            $this->load->view('recherche_chanson');
        }

		$this->load->view('layout/footer');
	}
}
