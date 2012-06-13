<?php

namespace MusicFestival;

class Track extends \MusicFestival\Entity {

  const ATTR_TITLE = 'title';
  const ATTR_ARTIST = 'artist';
  const ATTR_ALBUM = 'album';
  const ATTR_YEAR = 'year';
  const ATTR_COVER = 'cover';
  const ATTR_MEMO = 'memo';
  const ATTR_MBID = 'mbid';
  const ATTR_TAGS = 'tags';

  protected $links = array();

  function __construct() {
    parent::__construct(array(
      self::ATTR_TITLE,
      self::ATTR_MBID,
      self::ATTR_ARTIST,
      self::ATTR_ALBUM,
      self::ATTR_YEAR,
      self::ATTR_MEMO,
      self::ATTR_COVER,
      self::ATTR_TAGS,
    ));
  }

  /**
   * @return string
   */
  function getTitle() {
    return $this->getAttribute(self::ATTR_TITLE);
  }

  /**
   * @return string
   */
  function getMbid() {
    return $this->getAttribute(self::ATTR_MBID);
  }

  /**
   * @return string
   */
  function getArtist() {
    return $this->getAttribute(self::ATTR_ARTIST);
  }

  /**
   * @return string
   */
  function getMemo() {
    return $this->getAttribute(self::ATTR_MEMO);
  }

  /**
   * @return string
   */
  function getAlbum() {
    return $this->getAttribute(self::ATTR_ALBUM);
  }

  /**
   * @return string
   */
  function getCover() {
    return $this->getAttribute(self::ATTR_COVER);
  }

  /**
   * @return arary
   */
  function getTags() {
    return $this->getAttribute(self::ATTR_TAGS);
  }


  /**
   * @return array<Link>
   */
  function getLinks() {
    return $this->links;
  }

  /**
   * @param array $links
   */
  function setLinks(array $links) {
    $this->links = $links;
  }

  /**
   * @param array $array
   * @return \MusicFestival\Track
   */
  static function fromArray(array $array) {
    $track = new Track();
    $track->setAttributes($array);
    $track->expandFromLastFm();
    return $track;
  }

  public function expandFromLastFm()
  {
    if($this->getMbid())
    {
      try {
        $client = \MusicFestival\Config::getInstance()->getLastFmClient();
        $track = $client->getTrackService()->getInfo(array('mbid' => $this->getMbid()));
      } catch (\Exception $e) {
        return;
      }

      $this->setAttribute(self::ATTR_TITLE, $track['name']);
      $this->setAttribute(self::ATTR_ARTIST, $track['artist']['name']);
      $this->setAttribute(self::ATTR_ALBUM, $track['album']['title']);
      $this->setAttribute(self::ATTR_COVER, $track['album']['image'][2]['#text']);

      if(isset($track['toptags']['tag']))
      {
        $tags = $this->getAttribute(self::ATTR_TAGS);
        foreach($track['toptags']['tag'] as $tag)
        {
          $tags[$tag['name']] = $tag['url'];
        }

        $this->setAttribute(self::ATTR_TAGS, $tags);
      }


      $links = $this->getLinks();
      $links['lastfm'] = $track['url'];
      $links['spotify']= "http://www.lastfm.fr/affiliate/byid/9/{$track['id']}/6/trackpage/{$track['id']}";
      $links['deezer'] = "http://www.lastfm.fr/affiliate/byid/9/{$track['id']}/1000168/trackpage/{$track['id']}";
      $links['hypemachine'] = "http://www.lastfm.fr/affiliate/byid/9/{$track['id']}/4/trackpage/{$track['id']}";
      $this->setLinks($links);
    }
  }
}