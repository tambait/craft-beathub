<?php
namespace App\Services;

use craft\elements\Entry;
use craft\elements\db\EntryQuery;
use tambait\craftshowcasebase\app\services\QueryService;

class MusicService extends QueryService
{

    /**
     * Define default eager loading for this project's sections
     */
    protected array $eagerLoading = [
        'artists' => ['featuredImage', 'albums', 'albums.coverImage'],
        'albums' => ['coverImage', 'artist', 'artist.featuredImage'],
        'songs' => ['artist', 'album', 'album.coverImage'],
    ];    


    public function getArtists(array $options = []): EntryQuery
    {
        return $this->getEntries('artists', $options);
    }

    public function getAlbums(array $options = []): EntryQuery
    {
        return $this->getEntries('albums', $options);
    }    


    /**
     * NOTE:
     * Nested fields inside Content Blocks (e.g. `albumInfo.artists`) do not appear
     * to be queryable directly on the owning entry (`Album`) by default.
     *
     * WORKAROUND:
     * To query `Album` entries by a nested field (e.g. `artists`), a hoisted field
     * was created using "Generated Fields" in the Craft admin for the `Album`
     * entry type.
     */

       
    public function getAlbumsByArtist(int|array $artistIds, array $options = []): EntryQuery
    {
        $ids = is_array($artistIds) ? $artistIds : [$artistIds];
        $options['artistIds'] = $ids;         
        
        return $this->getAlbums($options);

    }

    public function getEvents(array $options = []): EntryQuery
    {
        return $this->getEntries('events', $options);
    }

    public function getSongs(array $options = []): EntryQuery
    {
        return $this->getEntries('songs', $options);
    }

    public function getAlbumsBySimilarGenres(array $genreIds, int $excludeArtistId, array $options = [], int $limit = 6): EntryQuery|array
    {

        if (empty($genreIds)) {
            return [];
        }
        $similarArtists = $this->getArtists([
            'id' => 'not ' . $excludeArtistId,
            'relatedTo' => [
                'targetElement' => $genreIds,
                'field' => 'genres'
            ],
            'limit' => $limit,
        ])->ids();


        if (empty($similarArtists)) {
            return [];
        }


        $options['limit'] = $limit;
        
        return $this->getAlbumsByArtist($similarArtists, $options);
    }
}