<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Artistes extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_music');
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');

		$this->filter = $this->input->get('filter') ?? 'album';
	}
	public function index(){
		$tri = filter_input(INPUT_GET, 'choix');

		if( $tri !== FILTER_NULL_ON_FAILURE) {
        	switch ($tri) {
        	    case 'AZ':
        	        $orderBy = 'ASC';
        	        break;
        	    case 'ZA':
        	        $orderBy = 'DESC';
        	        break;
        	    default:
        	        $orderBy = 'ASC';
        	        break;
        	}
		}

		$artistes = $this->model_music->getArtiste($orderBy);
		$this->load->view('layout/header');
		$this->load->view('artiste_list', ['artistes' => $artistes]);
		$this->load->view('layout/footer');

	}

	public function view($id) {
		if ($this->filter=='album'){
			$albums = $this->model_music->getAlbumsFromArtist($id);
			$vue=1;
		}
		if($this->filter=='song'){
			$albums = $this->model_music->getSongsFromArtist($id);
			$vue=2;
		}
		
		$name = $this->model_music->getArtistName($id);
		$this->load->view('layout/header');
		if(isset($this->session->id)) {
			$this->load->view('album_list_artiste',['albums'=>$albums,'filter'=>$this->filter,'vue'=>$vue,'name'=>$name[0], 'loggedon' => TRUE]);
		} else {
			$this->load->view('album_list_artiste',['albums'=>$albums,'filter'=>$this->filter,'vue'=>$vue,'name'=>$name[0]]);
		}
		$this->load->view('layout/footer');
	}

}
