<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_user extends CI_Model {
	public function __construct() {
		$this->load->database();
	}

	public function createUser($login, $email, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?);";
        $this->db->query($sql, [$login, $email, $hash]);
	}

	public function getUserId($login) {
        //should work
        $sql = "SELECT id FROM user WHERE username = ? ";
        $query = $this->db->query($sql, [$login]);
        return $query->result();
	}

	public function isLoginValid($id, $password) {
        $sql = "SELECT password FROM user WHERE id = ?;";
         $query = $this->db->query($sql, [$id]);
        return password_verify($password, $query->row_array()['password']);
	}

        public function isUsernameNotTaken($user) {
                $sql = "SELECT id FROM user WHERE username = ?";
                $query = $this->db->query($sql, [$user]);
                if ($query->num_rows()===0 ) {
                        return TRUE;
                } else {
                        return FALSE;
                }
        }

}

