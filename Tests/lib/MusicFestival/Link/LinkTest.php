<?php

namespace MusicFestival\Link;

abstract class LinkTest extends \PHPUnit_Framework_TestCase {
  abstract function getTestedClassName();
  abstract function getValidLinkInstance();
  abstract function getMatchingUrl();
  abstract function getNonMatchingUrl();

  function testImplementsInterface() {
    $class = $this->getTestedClassName();
    $this->assertContains('MusicFestival\Link\Link', \class_implements($class));
    $this->assertInstanceOf('MusicFestival\Link\Link', $this->getValidLinkInstance());
  }

  function testIsMatchingUrl() {
    $class = $this->getTestedClassName();
    $this->assertTrue($class::isMatchingUrl($this->getMatchingUrl()));
    $this->assertFalse($class::isMatchingUrl($this->getNonMatchingUrl()));
  }

  function testGetName() {
    $this->assertNotNull($this->getValidLinkInstance()->getName());
  }

  function testGetIcon() {
    $this->assertNotNull($this->getValidLinkInstance()->getIcon());
  }

  function testGetUrl() {
    $this->assertNotNull($this->getValidLinkInstance()->getUrl());
  }

  function testGetTemplate() {
    $this->assertNotNull($this->getValidLinkInstance()->getTemplate());
  }
}