<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Genres extends CI_Controller {

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
		$genres = $this->model_music->getGenre($orderBy);
		$this->load->view('layout/header');
		$this->load->view('genre_list', ['genres' => $genres]);
		$this->load->view('layout/footer');

		
	}

	public function view($id) {
		if ($this->filter=='album'){
			$albums = $this->model_music->getAlbumsFromGenre($id);
			$vue=1;
		}
		if($this->filter=='song'){
			$albums = $this->model_music->getSongsFromGenre($id);
			$vue=2;
		}
		
		$genre= $this->model_music->getGenreName($id);
		$this->load->view('layout/header');
		$this->load->view('album_list_genre',['albums'=>$albums,'filter'=>$this->filter,'vue'=>$vue,'genre'=>$genre[0]]);
		$this->load->view('layout/footer');
	}
	
	
}


