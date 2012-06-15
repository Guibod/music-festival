<?php

namespace MusicFestival\Link;

interface Link {
  function __construct($url);
  function getIcon();
  function getName();
  function getUrl();
  function getTemplate();
  function isValid();
  function hasPlayer();
  function getPlayer();
  function __toString();

  static function isMatchingUrl($url);
}