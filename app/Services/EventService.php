<?php
namespace App\Services;

use craft\elements\Entry;
use craft\elements\db\EntryQuery;
use tambait\craftshowcasebase\app\services\QueryService;

class EventService extends QueryService
{

    protected array $eagerLoading = [
        'artists' => ['featuredImage', 'albums', 'albums.coverImage'],
        'albums' => ['coverImage', 'artist', 'artist.featuredImage'],
        'songs' => ['artist', 'album', 'album.coverImage'],
    ];    


    public function getEvents(array $options = []): EntryQuery
    {
        return $this->getEntries('events', $options);
    }

    public function getEventsByArtist(int $artistId, array $options = []): EntryQuery
    {
        return $this->getRelated('events', $artistId, $options);
    }

}