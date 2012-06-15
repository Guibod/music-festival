<?php

namespace MusicFestival\Player;

interface Player {
  function __construct(\MusicFestival\Link\Link $link);
  function getLink();
  function getTemplate();
  function isValid();
  function __toString();
}