<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Playlist extends CI_Controller {
	public $filter = 'all';
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');
		$this->load->model('model_playlists');
        $this->load->model('model_music');
	}

    private function getUserId() {
        if (!isset($this->session->id)) {
            redirect('Utilisateur/login');
            die('Hello'); //Just in case
        } else {
            return $this->session->id[0]->id;
        }
    }

	public function index() {
        $data = $this->model_playlists->getPlaylistsFromUser($this->getUserId());
        $this->load->view('layout/header');
        $this->load->view('Playlist/ListesPlaylist', ["data"=>$data]);
        $this->load->view('layout/footer');
	}

    public function view($id) {
        $data= $this->model_playlists->getPlaylist($id);
        $songs = $this->model_playlists->getSongsFromPlaylist($id);
        if ($data[0]->author==$this->getUserId()) {
            $this->load->view('layout/header');
            $this->load->view('Playlist/PlaylistView', ["data" => $data[0], "songs"=>$songs]);
            $this->load->view('layout/footer');
        } else {
            $this->load->view('errors/html/error_general', ['heading'=>'403 Forbidden', 'message'=>'Une connexion est requise pour acc&eacute;der à cette ressource']);
        }
    }

    public function create() {
        $this->form_validation->set_rules('name', 'Nom de la playlist', array('required', 'min_length[2]','max_length[10]'));
        $localUserId =$this->getUserId();
        if ($this->form_validation->run()===TRUE) {
            $name = $this->input->post('name');
            $this->model_playlists->createPlaylist($name, $localUserId);
            redirect('Playlist');
        } else {
            $this->load->view('layout/header');
            $this->load->view('Playlist/creation');
            $this->load->view('layout/footer');
        }
    }

    public function delete($id) {
        $data = $this->model_playlists->getPlaylist($id)[0];
        if ($this->getUserId()==$data->author) {
            $this->model_playlists->deletePlaylist($id);
            redirect('/Playlist/index');
        } else {
            $this->load->view('errors/html/error_general', ['heading'=>'403 Forbidden', 'message'=>'Une connexion est requise pour acc&eacute;der à cette ressource']);
        }
    }

    public function duplicate($id) {
        $this->form_validation->set_rules('name', 'Nouveau nom', array('required', 'min_length[5]','max_length[10]'));
        $localUserId =$this->getUserId();
        if ($this->form_validation->run()===TRUE) {
            $name = $this->input->post('name');
            $this->model_playlists->duplicatePlaylist($id, $name);
            redirect('/playlist/view/'.$id);
        } else {
            $this->load->view('layout/header');
            $this->load->view('errors/html/error_general', ['heading'=>'500', 'message'=>'Respecte le formulaire stp']);
            $this->load->view('layout/footer');
        }
    }

    public function removeTrack($id) {
        $idTrack = $this->input->post('idTrack');
        $data = $this->model_playlists->getPlaylist($id)[0];
        if ($this->getUserId()==$data->author) {
            $this->model_playlists->deleteTrackFromPlaylist($idTrack, $id);
            redirect("/Playlist/view/$id");
        } else {
            $this->load->view('errors/html/error_general', ['heading'=>'403 Forbidden', 'message'=>'Une connexion est requise pour acc&eacute;der à cette ressource']);
        }
    }
    public function selectTrackToAdd($id) {
        $data = $this->model_playlists->getPlaylistsFromUser($this->getUserId());
        $this->load->view('layout/header');
        $this->load->view('Playlist/selectAdd', ["data"=>$data, "id"=>$id, "type"=>"track"]);
        $this->load->view('layout/footer');   
    }

    public function addAlbumToPlaylist($idAlbum, $idPlaylist) {
        $data = $this->model_playlists->getPlaylist($idPlaylist)[0];
        if ($this->getUserId()==$data->author) {
            $this->model_playlists->addAlbumToPlaylist($idAlbum, $idPlaylist);
            redirect("/Playlist/view/$idPlaylist");
        } else {
            $this->load->view('errors/html/error_general', ['heading'=>'403 Forbidden', 'message'=>'Une connexion est requise pour acc&eacute;der à cette ressource']);
        }
    }
    public function selectAlbumToAdd($id) {
        $data = $this->model_playlists->getPlaylistsFromUser($this->getUserId());
        $this->load->view('layout/header');
        $this->load->view('Playlist/selectAdd', ["data"=>$data, "id"=>$id, "type"=>"album"]);
        $this->load->view('layout/footer');   
    }

    public function addArtistToPlaylist($idArtist, $idPlaylist) {
        $data = $this->model_playlists->getPlaylist($idPlaylist)[0];
        if ($this->getUserId()==$data->author) {
            $this->model_playlists->addArtistToPlaylist($idArtist, $idPlaylist);
            redirect("/Playlist/view/$idPlaylist");
        } else {
            $this->load->view('errors/html/error_general', ['heading'=>'403 Forbidden', 'message'=>'Une connexion est requise pour acc&eacute;der à cette ressource']);
        }
    }
    public function selectArtistToAdd($id) {
        $data = $this->model_playlists->getPlaylistsFromUser($this->getUserId());
        $this->load->view('layout/header');
        $this->load->view('Playlist/selectAdd', ["data"=>$data, "id"=>$id, "type"=>"artist"]);
        $this->load->view('layout/footer');   
    }

    public function addTrackToPlaylist($idTrack, $idPlaylist) {
        $data = $this->model_playlists->getPlaylist($idPlaylist)[0];
        if ($this->getUserId()==$data->author) {
            $this->model_playlists->addTrackToPlaylist($idTrack, $idPlaylist);
            redirect("/Playlist/view/$idPlaylist");
        } else {
            $this->load->view('errors/html/error_general', ['heading'=>'403 Forbidden', 'message'=>'Une connexion est requise pour acc&eacute;der à cette ressource']);
        }
    }

    public function aleatoire() {

        $this->form_validation->set_rules('name', 'Nom de la playlist', array('required', 'min_length[2]','max_length[10]'));
        $localUserId =$this->getUserId();
        if ($this->form_validation->run()===TRUE) {
            $name = $this->input->post('name');
            $idGenre= $this->input->post('genres');
            $limit= $this->input->post('limit');
            $idPlaylist = $this->model_playlists->createPlaylist($name, $localUserId);
            $random=$this->model_playlists->getSongAleatoire($idGenre,$limit);
            foreach($random as $track){
                $this->model_playlists->addTrackToPlaylist($track->trackId, $idPlaylist);
            }
            redirect('/Playlist/index');
        
        } else {
            $this->load->view('layout/header');
            $genre=$this->model_music->getGenre('ASC');
            $this->load->view('Playlist/aleatoire',['genre'=>$genre]);
            $this->load->view('layout/footer');
        }
    }

    public function rename($id) {
        $data = $this->model_playlists->getPlaylist($id)[0];
        $this->form_validation->set_rules('name', 'Nom de la playlist', array('required', 'min_length[2]','max_length[10]'));
        if ($this->form_validation->run()===TRUE) {
            if ($this->getUserId()==$data->author) {
                $name = $this->input->post('name');
                $this->model_playlists->renamePlaylist($id, $name);
                redirect("/Playlist/view/$id");
            } else {
                $this->load->view('errors/html/error_general', ['heading'=>'403 Forbidden', 'message'=>'Une connexion est requise pour acc&eacute;der à cette ressource']);
            }
        } else {
            redirect("Playlist/view/$id");
        }
    }
}