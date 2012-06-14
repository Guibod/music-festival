<?php

namespace MusicFestival;

class Track extends \MusicFestival\Entity {

  const ATTR_TITLE = 'title';
  const ATTR_ARTIST = 'artist';
  const ATTR_ALBUM = 'album';
  const ATTR_COVER = 'cover';
  const ATTR_MEMO = 'memo';
  const ATTR_MBID = 'mbid';
  const ATTR_TAGS = 'tags';
  const ATTR_LINKS = 'links';

  protected $links = array();

  function __construct() {
    parent::__construct(array(
      self::ATTR_TITLE,
      self::ATTR_MBID,
      self::ATTR_ARTIST,
      self::ATTR_ALBUM,
      self::ATTR_MEMO,
      self::ATTR_COVER,
      self::ATTR_TAGS,
      self::ATTR_LINKS,
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
   * @return array
   */
  function getTags() {
    return $this->getAttribute(self::ATTR_TAGS);
  }

  /**
   * @return array<Link>
   */
  function getLinks() {
    $links = array();
    foreach($this->getAttribute(self::ATTR_LINKS) as $url) {
      $links[] = \MusicFestival\Link\Factory::fromUrl($url);
    }
    return $links;
  }

  /**
   * @param array $array
   * @return \MusicFestival\Track
   */
  static function fromArray(array $array, $expand = true) {
    $track = new Track();
    $track->setAttributes($array);
    if($expand) {
      $track->expandFromLastFm();
    }
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

      $this->setAttribute(self::ATTR_TITLE, $track['name'], true);
      $this->setAttribute(self::ATTR_ARTIST, $track['artist']['name'], true);

      if(isset($track['album']))
      {
        $this->setAttribute(self::ATTR_ALBUM, $track['album']['title'], true);
        $this->setAttribute(self::ATTR_COVER, $track['album']['image'][2]['#text'], true);
      }

      if(isset($track['toptags']['tag']))
      {
        $tags = $this->getAttribute(self::ATTR_TAGS);
        foreach($track['toptags']['tag'] as $tag)
        {
          $tags[$tag['name']] = $tag['url'];
        }

        $this->setAttribute(self::ATTR_TAGS, $tags);
      }

      $links = $this->getAttribute(self::ATTR_LINKS);
      $links[] = $track['url'];
      $links[]= "http://www.last.fm/affiliate/byid/9/{$track['id']}/6/trackpage/{$track['id']}";
      $links[] = "http://www.last.fm/affiliate/byid/9/{$track['id']}/1000168/trackpage/{$track['id']}";
      $links[] = "http://www.last.fm/affiliate/byid/9/{$track['id']}/4/trackpage/{$track['id']}";

      $this->setAttribute(self::ATTR_LINKS, $links);
    }
  }
}