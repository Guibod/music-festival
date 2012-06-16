<?php

namespace MusicFestival;

class TagCloud {


  static function fromPersonList(array $persons, $ignoreRatio = .15) {
    $allTags = array();
    $cntTags = array();
    foreach($persons as $person) {
      foreach($person->getTracks() as $track) {
        foreach($track->getTags(25) as $tagName => $tagUrl) {
          if(!isset($allTags[$tagName])) {
            $allTags[$tagName] = array('url' => $tagUrl, 'name' => $tagName);
            $cntTags[$tagName] = 0;
          }
          $cntTags[$tagName] +=1;
        }
      }
    }

    $max = max($cntTags);

    foreach ($cntTags as $tagName => $count) {
      $decile = intval(ceil($count/$max*10));
      $allTags[$tagName]['decile'] = $decile;
      $allTags[$tagName]['count'] = $count;

      if($count < ($ignoreRatio*$max)) {
        unset($allTags[$tagName]);
      }
    }

    \shuffle($allTags);
    return $allTags;
  }

}
