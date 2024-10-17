<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Albums extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('model_music');
		$this->load->helper(['url', 'html']);
		$this->load->helper('form');
	}
	public function index(){

		$tri = filter_input(INPUT_GET, 'choix');

		if( $tri !== FILTER_NULL_ON_FAILURE) {
        	switch ($tri) {
        	    case 'AZ':
        	        $orderBy = 'albumName ASC';
        	        break;
        	    case 'ZA':
        	        $orderBy = 'albumName DESC';
        	        break;
        	    case 'ancien':
        	        $orderBy = 'year ASC';
        	        break;
        	    case 'recent':
        	        $orderBy = 'year DESC';
        	        break;
        	    default:
        	        $orderBy = 'year ASC';
        	        break;
        	}
		$albums = $this->model_music->getAlbums($orderBy);
		$this->load->view('layout/header');
		$this->load->view('albums_list',['albums'=>$albums]);
		$this->load->view('layout/footer');

		}
	}

	public function view($id) {
		$song = $this->model_music->getSongsFromAlbum($id);
		$album = $this->model_music->getAlbum($id);
		$this->load->view('layout/header');
				
		if ($album!==null) {
			if(isset($this->session->id )) {
				$this->load->view('album_view', ['song'=>$song, 'album'=> $album[0], 'loggedon' => TRUE]);
			} else {
				$this->load->view('album_view', ['song'=>$song, 'album'=> $album[0]]);
			}
		} else {
			$this->load->view('errors/html/error_general', ['heading'=>'URL Error', 'message'=>'Donne quelque chose en url']);
		}
		$this->load->view('layout/footer');
	}

	
}

