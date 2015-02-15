<?php

namespace BoosBoos\Charta\Client;

/**
 * @package BoosBoos\Charta\Client
 */
class GeoLocationResolver
{
  /**
   * @var \BoosBoos\Charta\Client\GeocodingService
   */
  private $geocodingService;

  /**
   * @var \ArrayObject
   */
  private $locations;

  /**
   * @param GeocodingService $geocodingService
   */
  public function __construct(GeocodingService $geocodingService)
  {
    $this->geocodingService = $geocodingService;

    $this->locations = new \ArrayObject();
  }

  /**
   * @param string $street
   * @param string $postalCode
   * @param string $city
   * @param float $latitude
   * @param float $longitude
   */
  public function mapLocation($street, $postalCode, $city, $latitude, $longitude)
  {
    $address = new Address($street, $postalCode, $city);
    $geo = new GeoCoordinates($latitude, $longitude);

    $this->addLocation($address, $geo);
  }

  /**
   * @param \BoosBoos\Charta\Client\Address $address
   * @return \BoosBoos\Charta\Client\GeoCoordinates|null
   */
  public function resolveLocation(Address $address)
  {
    $key = $this->generateKey($address);

    if ($this->locations->offsetExists($key)) {
      return $this->locations->offsetGet($key);
    }

    $geo = $this->lookupLocation($address);

    if (null !== $geo) {
      $this->addLocation($address, $geo);
    }

    return $geo;
  }

  /**
   * @param Address $address
   * @return GeoCoordinates
   */
  private function lookupLocation(Address $address)
  {
    $query = sprintf(
      "%s, %s, %s",
      $address->getStreet(),
      $address->getPostalCode(),
      $address->getCity()
    );

    return $this->geocodingService->lookup($query);
  }

  /**
   * @param Address $address
   * @param GeoCoordinates $geo
   */
  private function addLocation(Address $address, GeoCoordinates $geo)
  {
    $key = $this->generateKey($address);

    $this->locations->offsetSet($key, $geo);
  }

  /**
   * @param \BoosBoos\Charta\Client\Address $address
   * @return string
   */
  private function generateKey(Address $address)
  {
    return md5(
      $address->getStreet() . $address->getPostalCode() . $address->getCity()
    );
  }
}
