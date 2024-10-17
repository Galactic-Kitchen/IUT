 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_recherche extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	public function rechercheArtiste($recherche){
		$this->db->select('*');
		$query = $this->db->like('name',$recherche)->get('artist');
		return $query->result();
	}

	public function rechercheMusique($recherche){
		$query = $this->db->like('name',$recherche)->get('song');
		return $query->result();
	}
	
	public function rechercheAlbum($recherche) {
		$this->db->select('*');
		$query = $this->db->like('name',$recherche)->get('album');
		return $query->result();	
	}
}