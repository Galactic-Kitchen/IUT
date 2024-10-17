<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilisateur extends CI_Controller {
	public $filter = 'all';
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
        $this->load->library('form_validation');

		$this->load->model('model_user');

	}

	public function index()
	{
		redirect('/Utilisateur/profile');
	}

	public function logout() {
        if (isset($_SESSION['id'])) {
            $this->session->sess_destroy();
        }
		$this->load->view('layout/header');
		$this->load->view('User/logout');
		$this->load->view('layout/footer');
	}

	public function login(){
        //form validation
        $this->form_validation->set_rules('username', 'Nom d\'utilisateur', array('required', 'min_length[5]', 'max_length[30]'));
        $this->form_validation->set_rules('password', 'Mot de passe', 'required');

        if ($this->form_validation->run()== TRUE) {
            $user = $this->input->post('username');
            $id_user = $this->model_user->getUserId($user);

            $SuccessLogin = $this->model_user->isLoginValid($id_user[0]->id, $this->input->post('password'));

            if($SuccessLogin==TRUE) {
                $this->session->set_userdata(['id'=>$id_user, 'user'=>$user]);
                redirect('/Utilisateur/profile');
            }
        } else {
            $SuccessLogin = FALSE;
        }
        $this->load->view('layout/header');
         if ($SuccessLogin === TRUE) {
            $this->load->view('User/login', [$error=>TRUE]);
        } else {
            $this->load->view('User/login');
        }
		$this->load->view('layout/footer');
	}
	
	public function signin() {

        $this->form_validation->set_rules('username', 'Nom d\'utilisateur', array('required', 'min_length[5]', 'max_length[30]'));
        $this->form_validation->set_rules('password', 'Mot de passe', array('required', 'min_length[5]'));
        $this->form_validation->set_rules('email','Adresse email',array('required','valid_email'));

        if ($this->form_validation->run()== TRUE) {
            $user = $this->input->post('username');
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            if ($this->model_user->isUsernameNotTaken($user)===true) { //verification si le login est pas deja pris
                $this->model_user->createUser($user, $email, $password);
                $this->load->view('layout/header');
            $this->load->view('layout/footer');
            }
        } else {
            $this->load->view('layout/header');
            $this->load->view('User/signup');
            $this->load->view('layout/footer');
        }
	}

    public function profile() {

        if (isset($_SESSION['id'])) {
            $this->load->view('layout/header');
            $this->load->view('User/profile', ['id'=>$this->session->id, 'username'=>$this->session->user]);
            $this->load->view('layout/footer');
        } else {
            redirect('/Utilisateur/login');
        }
    }
	
}
