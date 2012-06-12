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
  function getYear() {
    return $this->getAttribute(self::ATTR_YEAR);
  }

  /**
   * @return string
   */
  function getCover() {
    return $this->getAttribute(self::ATTR_COVER);
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
    return $track;
  }

}