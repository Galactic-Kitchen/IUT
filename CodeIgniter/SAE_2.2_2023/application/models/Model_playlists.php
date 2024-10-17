 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_playlists extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}
	public function deletePlaylist($id)
	{
		$this->db->where('idPlaylist', $id);
        $this->db->delete('playlistTracks');
		$this->db->where('id', $id);
        $this->db->delete('playlist');

	}


	public function createPlaylist($name, $idUser) {
		$this->db->insert('playlist',["name"=>$name, "author"=>$idUser]);
		return $this->db->insert_id();
	}

	public function getPlaylist($id) {
		$sql = "SELECT id , name, author
		FROM playlist
		WHERE playlist.id = ?";
		$query = $this->db->query($sql, [$id]);
		return $query->result();
	}

	public function renamePlaylist($id, $name) {
		$sql = "UPDATE playlist SET name=? WHERE id = ?";
		$this->db->query($sql, [$name, $id]);
	}
 
	public function getSongsFromPlaylist($id) {
		$sql = "SELECT S.name as title, Art.name as artist, T.id as id
		FROM playlistTracks PT JOIN track T ON T.id = PT.idTrack JOIN song S ON T.songid = S.id 
		JOIN album A ON T.albumId = A.id JOIN artist Art ON A.artistId = Art.id
		WHERE PT.idPlaylist = ?";
		$query = $this->db->query($sql,[$id]);
		return $query->result();
	}

	public function addTrackToPlaylist($idTrack, $idPlaylist) {
		$sql = "INSERT INTO playlistTracks (idPlaylist, idTrack) VALUES (?, ?)";
		$this->db->query($sql, [$idPlaylist, $idTrack]);
	}
	
	
	public function addAlbumToPlaylist($idAlbum, $idPlaylist) {
		$sql = "INSERT INTO playlistTracks (idPlaylist, idTrack) select ?, track.id from track where track.albumId=?";
		$this->db->query($sql, [$idPlaylist, $idAlbum]);
	}

	public function addArtistToPlaylist($idArtist, $idPlaylist) {
		$sql = "INSERT INTO playlistTracks (idPlaylist, idTrack) select ?, track.id 
		from track join album on track.albumid = album.id
		where album.artistId=?";
		$this->db->query($sql, [$idPlaylist, $idArtist]);
	}
	
	public function deleteTrackFromPlaylist($idTrack, $idPlaylist) {
		$sql = "DELETE FROM playlistTracks WHERE idPlaylist = ? AND idTrack = ?";
		$this->db->query($sql, [$idPlaylist, $idTrack]);
	}

	public function duplicatePlaylist($idPlaylist, $nvNom) {
		$idUser = $this->getPlaylist($idPlaylist)[0]->author;
		$nvID = $this->createPlaylist($nvNom, $idUser);


		$sql = "SELECT idTrack FROM playlistTracks WHERE idPlaylist = ?";
		$query = $this->db->query($sql, [$idPlaylist]);

		foreach ($query->result() as $chanson) {
			$this->addTrackToPlaylist($chanson->idTrack, $nvID);
		}

	}

	public function getPlaylistsFromUser($idUser) {
		$sql = "SELECT name, id FROM playlist WHERE author = ?";
		$query = $this->db->query($sql, [$idUser]);
		return $query->result();
	}



	public function getSongAleatoire($idGenres, $limit){

        $this->db->select('track.id as trackId, song.id as songId');
        $this->db->from('song');
        $this->db->join('track', 'track.songid = song.id');
        $this->db->join('album', 'track.albumid = album.id');

        
        if (!empty($idGenres)) {
            $this->db->where_in('album.genreid', $idGenres);
        }

        $this->db->order_by('RAND()');
        $this->db->limit($limit);
        $query = $this->db->get();

        return $query->result();
    }

}