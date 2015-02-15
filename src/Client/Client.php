<?php

namespace BoosBoos\Charta\Client;

/**
 * @package BoosBoos\Charta\Client
 */
class Client implements \JsonSerializable
{
  /**
   * @var string
   */
  private $name;

  /**
   * @var Address
   */
  private $address;

  /**
   * @param string $name
   */
  public function __construct($name)
  {
    $this->name = $name;
    $this->address = null;
  }

  /**
   * {@inheritdoc}
   */
  public function jsonSerialize()
  {
    $object = new \stdClass();

    $object->Name = $this->name;
    $object->Address = $this->address;

    return $object;
  }

  /**
   * @param \BoosBoos\Charta\Client\Address $address
   */
  public function setAddress(Address $address)
  {
    $this->address = $address;
  }
}
