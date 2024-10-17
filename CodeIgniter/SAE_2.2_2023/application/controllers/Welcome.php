<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Todo extends CI_Controller {
	public $filter = 'all';
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');

		$this->load->model('model_todo');

		$this->filter = $this->input->get('filter') ?? 'all';
	}

	public function index()
	{
		$todos = $this->model_todo->getTodos($this->filter);
		$this->load->view('layout/header');
		$this->load->view('todos',['todos'=>$todos,'filter'=>$this->filter]);
		$this->load->view('layout/footer');
	}
	public function logout() {
		
	}

	public function login(){
		
	}
	
	public function signin() {
		
	}
	
}
