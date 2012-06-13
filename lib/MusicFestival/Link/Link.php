<?php

namespace MusicFestival\Link;

interface Link {
  function __construct($url);
  function getIcon();
  function getName();
  function getUrl();
  function getTemplate();

  static function isMatchingUrl($url);
}