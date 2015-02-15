<?php

namespace BoosBoos\Charta\Client;

/**
 * @package BoosBoos\Charta\Client
 */
class Address implements \JsonSerializable
{
  /**
   * @var string
   */
  private $street;

  /**
   * @var string
   */
  private $postalCode;

  /**
   * @var string
   */
  private $city;

  /**
   * @var \BoosBoos\Charta\Client\GeoCoordinates
   */
  private $location;

  /**
   * @param string $street
   * @param string $postalCode
   * @param string $city
   */
  public function __construct($street, $postalCode, $city)
  {
    $this->street = $street;
    $this->postalCode = $postalCode;
    $this->city = $city;
    $this->location = null;
  }

  /**
   * {@inheritdoc}
   */
  public function jsonSerialize()
  {
    $object = new \stdClass();

    $object->Street = $this->street;
    $object->PostalCode = $this->postalCode;
    $object->City = $this->city;
    $object->Geo = $this->location;

    return $object;
  }

  /**
   * @return string
   */
  public function getStreet()
  {
    return $this->street;
  }

  /**
   * @return string
   */
  public function getPostalCode()
  {
    return $this->postalCode;
  }

  /**
   * @return string
   */
  public function getCity()
  {
    return $this->city;
  }

  /**
   * @param \BoosBoos\Charta\Client\GeoCoordinates $location
   */
  public function setLocation(GeoCoordinates $location)
  {
    $this->location = $location;
  }
}
