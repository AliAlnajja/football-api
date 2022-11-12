<?php

class ArtistModel extends BaseModel {

    private $table_name = "artist";

    /**
     * A model class for the `artist` database table.
     * It exposes operations that can be performed on artists records.
     */
    function __construct() {
        // Call the parent class and initialize the database connection settings.
        parent::__construct();
    }

    /**
     * Retrieve all artists from the `artist` table.
     * @return array A list of artists. 
     */
    public function getAll() {
        $sql = "SELECT * FROM artist";
        $data = $this->rows($sql);
        return $data;
    }

    /**
     * Get a list of artists whose name matches or contains the provided value.       
     * @param string $artistName 
     * @return array An array containing the matches found.
     */
    public function getWhereLike($artistName) {
        $sql = "SELECT * FROM artist WHERE Name LIKE :name";
        $data = $this->run($sql, [":name" => $artistName . "%"])->fetchAll();
        return $data;
    }

    /**
     * Retrieve an artist by its id.
     * @param int $artist_id the id of the artist.
     * @return array an array containing information about a given artist.
     */
    public function getArtistById($artist_id) {
        $sql = "SELECT * FROM artist WHERE ArtistId = ?";
        $data = $this->run($sql, [$artist_id])->fetch();
        return $data;
    }

    /**
     * Retrieve all the albums by its specific artist id.
     * @param int $artist_id the id of the artist.
     * @return array an array containing information about a given album.
     */
    public function getAlbumsByArtists($artist_id) {
        $sql = "SELECT * FROM album WHERE ArtistId = ?";
        $data = $this->run($sql, [$artist_id])->fetchall();
        return $data;
    }

    /**
     * Retrieve an track by its artist and album ids.
     * @param int $artist_id the id of the artist.
     * @param int $album_id the id of the album.
     * @return array an array containing information about a given track.
     */
    public function getSpecificTracks($artist_id, $album_id){
        $sql = "SELECT * FROM album INNER JOIN track ON album.AlbumId = track.AlbumId WHERE album.ArtistId = ? && album.AlbumId = ?";
        $data = $this->run($sql, [$artist_id, $album_id])->fetchall();
        return $data;
    }

    /**
     * Get a list of artists whose name matches or contains the provided value.       
     * @param string $artistName 
     * @return array An array containing the matches found.
     */
    public function getByFirstName($customerFName) {
        $sql = "SELECT * FROM customer WHERE FirstName LIKE :FirstName";
        $data = $this->run($sql, [":FirstName" => $customerFName . "%"])->fetchAll();
        return $data;
    }

     /**
     * Get a list of artists whose name matches or contains the provided value.       
     * @param string $artistName 
     * @return array An array containing the matches found.
     */
    public function getByLastName($customerLName) {
        $sql = "SELECT * FROM customer WHERE LastName LIKE :LastName";
        $data = $this->run($sql, [":LastName" => $customerLName . "%"])->fetchAll();
        return $data;
    }
    
    /**
     * Create a new artist      
     * @param array $data an array that has the values of the new artist 
     * @return array An array containing the new artist.
     */
    public function createArtist($data) {
        $data = $this->insert("artist",$data);
        return $data;
    }
    
    /**
     * Update an existing artist.       
     * @param array $data an array that has the new values of the existing artist
     * @param array $where an array that holds the conditions about a specific artist 
     * @return array An array containing the returned data
     */
    public function updateArtist($data, $where) {
        //$sql = "UPDATE artist SET Name = :Name WHERE ArtistId = :ArtistId";
        $data = $this->update("artist",$data, $where);
        return $data;
    }
    
    /**
     * Delete a specifc artist.       
     * @param int $artist_id the id that specifies the artist that will be delete
     * @return array An array containing the returned data
     */
    public function deleteArtist($artist_id) {
        $sql = "DELETE FROM artist WHERE ArtistId = :ArtistId";
        $data = $this->run($sql, [":ArtistId" => $artist_id . "%"])->execute();
        return $data;
    }
    
    /**
     * Filter method to get a track that has a specific Genre Name
     * @param int $artist_id for a specific artist
     * @param int $artist_id for a specific artist
     * @param string
     * @param string GenreName for a specific Genre name
     * @return array of all the results
     */
    public function getTrackByGenre($artist_id, $album_id, $GenreName) {
        $sql = "SELECT * FROM artist, album, track, genre WHERE artist.
        ArtistID = album.ArtistId AND track.AlbumId = album.AlbumId AND
        genre.GenreId = track.GenreId AND album.ArtistId = ? AND
        track.AlbumId = ? AND genre.Name = ?";
        $data = $this->run($sql, [$artist_id, $album_id, $GenreName])->fetchAll();
        return $data;
    }
    
    /**
     * Filter method to get a track that has a specific media Type Name
     * @param int $artist_id for a specific artist
     * @param int $artist_id for a specific artist
     * @param string $mediaTypeName for a specific media type name
     * @return array of all the results
     */
    public function getTrackByMediaType($artist_id, $album_id, $mediaTypeName) {
        $sql = "SELECT * FROM artist, album, track, genre, mediatype WHERE artist.
        ArtistID = album.ArtistId AND track.AlbumId = album.AlbumId AND
        genre.GenreId = track.GenreId AND track.MediaTypeId = mediatype.MediaTypeId AND album.ArtistId = ? AND
        track.AlbumId = ? AND mediatype.Name = ?";
        $data = $this->run($sql, [$artist_id, $album_id, $mediaTypeName])->fetchAll();
        return $data;
    }
    
    /**
     * Filter method to get a track that has a specific genre name and media Type Name
     * @param int $artist_id for a specific artist
     * @param int $artist_id for a specific artist
     * @param string $GenreName for a specific Genre name
     * @param string $mediaTypeName for a specific media type name
     * @return array of all the results
     */
    public function getTrackByGenreAndMediaType($artist_id, $album_id, $genreName, $mediaTypeName) {
        $sql = "SELECT * FROM artist, album, track, genre, mediatype WHERE artist.
        ArtistID = album.ArtistId AND track.AlbumId = album.AlbumId AND
        genre.GenreId = track.GenreId AND track.MediaTypeId = mediatype.MediaTypeId AND album.ArtistId = ? AND
        track.AlbumId = ? AND genre.Name = ? AND mediatype.Name = ?";
        $data = $this->run($sql, [$artist_id, $album_id, $genreName, $mediaTypeName])->fetchAll();
        return $data;
    }
}
