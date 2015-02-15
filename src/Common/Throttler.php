<?php

namespace BoosBoos\Charta\Common;

/**
 * @package BoosBoos\Charta\Common
 */
class Throttler
{
  /**
   * @var int
   */
  private $perSecond;

  /**
   * @var int
   */
  private $counter;

  /**
   * @param int $perSecond
   */
  public function __construct($perSecond)
  {
    $this->perSecond = $perSecond;
    $this->counter = 0;
  }

  /**
   *
   */
  public function throttle()
  {
    if ($this->counter === $this->perSecond) {
      $this->counter = 0;
      sleep(1);
    }

    $this->counter++;
  }
}
