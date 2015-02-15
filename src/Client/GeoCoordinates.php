<?php

namespace BoosBoos\Charta\Client;

/**
 * @package BoosBoos\Charta\Client
 */
class GeoCoordinates implements \JsonSerializable
{
  /**
   * @var float
   */
  private $latitude;

  /**
   * @var float
   */
  private $longitude;

  /**
   * @param float $latitude
   * @param float $longitude
   */
  public function __construct($latitude, $longitude)
  {
    $this->latitude = $latitude;
    $this->longitude = $longitude;
  }

  /**
   * {@inheritdoc}
   */
  public function jsonSerialize()
  {
    $object = new \stdClass();

    $object->Lat = $this->latitude;
    $object->Lng = $this->longitude;

    return $object;
  }
}
