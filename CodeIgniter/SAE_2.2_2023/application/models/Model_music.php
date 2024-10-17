 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_music extends CI_Model {
	public function __construct()
	{
		$this->load->database();
	}

	
	public function getArtiste($sort) {
		$sql = "SELECT artist.id as artistId, artist.name as artistName 
			FROM artist ORDER BY artistName $sort";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getGenre($sort) {
		$sql = "SELECT genre.id as genreId, genre.name as genreName
		FROM genre ORDER BY genreName $sort";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function getAlbums($sort){
		$sql="SELECT album.name as albumName, album.id as albumId, year, artist.name as artistName, artist.id as artistId, genre.name as genreName,jpeg 
			FROM album 
			JOIN artist ON album.artistid = artist.id
			JOIN genre ON genre.id = album.genreid
			JOIN cover ON cover.id = album.coverid
			ORDER BY  $sort";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getArtistName($id){
		$sql="SELECT name , id 
		FROM artist
		WHERE id = ?";
		$query=$this->db->query($sql,[$id]);
		return $query->result();
	}

	public function getAlbumsFromArtist($id) {
		$sql = "SELECT album.id as albumId, album.name as albumName, year, album.artistId as albumArtisteId, album.genreId as albumGenreId, album.coverId as albumCoverId ,jpeg
		FROM album 
		JOIN artist ON album.artistid = artist.id
			JOIN genre ON genre.id = album.genreid
			JOIN cover ON cover.id = album.coverid
		WHERE album.artistId = ?
		ORDER BY year ASC";
		$query = $this->db->query($sql, [$id]);
		return $query->result();
	}
	public function getSongsFromArtist($id) {
		$sql = "SELECT T.id as trackId, S.name as songName,T.albumId as trackAlbumId, T.songId as trackSongId, T.diskNumber as trackDiskNumber, T.number as trackNumber, T.duration as trackDuration, G.name as genre
		FROM song S
		JOIN track T ON S.id = T.songId
		JOIN album A ON T.albumId = A.id 
		JOIN genre G ON A.genreId = G.id
		WHERE A.artistId = ?
		ORDER BY T.duration";
		$query = $this->db->query($sql, [$id]);
		return $query->result();
	}

	public function getGenreName($id){
		$sql="SELECT name , id 
		FROM genre
		WHERE id = ?";
		$query=$this->db->query($sql,[$id]);
		return $query->result();
	}
	public function getAlbumsFromGenre($id) {
		$sql = "SELECT album.id as albumId, album.name as albumName, year, album.artistId as albumArtistId, artist.name as artistName, album.genreId as albumGenreId, album.coverId as albumCoverId, jpeg
		FROM artist
		JOIN album ON artist.id =album.artistId
		JOIN cover ON cover.id = album.coverid 
		WHERE genreId = ?
		ORDER BY year";
		$query = $this->db->query($sql, [$id]);
		return $query->result();
	}
	public function getSongsFromGenre($id) {
		$sql = "SELECT T.id as trackId, S.name as songName, T.albumId as trackAlbumId, T.songId as trackSongId, T.diskNumber as trackDiskNumber, T.number as trackNumber, T.duration as trackDuration
		FROM song S 
		JOIN track T ON S.id = T.songId 
		JOIN album A ON T.albumID = A.id 
		where A.genreid = ? 
		ORDER BY T.duration";
		$query = $this->db->query($sql, [$id]);
		return $query->result();
	}
	public function getAlbum($id) {
		$sql = "SELECT album.id as albumId, album.artistid as albumArtistId, album.name as albumName, year, album.artistId as albumArtistId, artist.name as artistName,album.genreId as albumGenreId, album.coverId as albumCoverId, jpeg , genre.name as genre
		FROM album
		JOIN artist ON album.artistid = artist.id
		JOIN genre ON genre.id = album.genreid
		JOIN cover ON cover.id = album.coverid
		WHERE album.id = ?";
		$query = $this->db->query($sql, [$id]);
		return $query->result();
	}

	
	

	public function getSongsFromAlbum($id) {
		$sql = "SELECT T.id as trackId, T.albumId as trackAlbumId, T.songId as trackSongId, T.diskNumber as trackDiskNumber, T.number as trackNumber, T.duration as trackDuration, S.name as songName 
		FROM song S 
		JOIN track T ON S.id = T.songId 
		JOIN album A ON T.albumId = A.id 
		WHERE A.id = ? ORDER BY T.diskNumber";
		$query = $this->db->query($sql, [$id]);
		return $query->result();
	}
	
	
	
	

	

	

}

