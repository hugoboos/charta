<?php

namespace BoosBoos\Charta\Application;

use BoosBoos\Charta\Client;
use BoosBoos\Charta\Common\NotSupportedException;
use BoosBoos\Charta\IO;

/**
 * @package BoosBoos\Charta
 */
class Converter
{
  /**
   * @var \BoosBoos\Charta\IO\IFile
   */
  private $inputFile;

  /**
   * @var \BoosBoos\Charta\IO\IFile
   */
  private $outputFile;

  /**
   * @var \BoosBoos\Charta\Client\GeoLocationResolver
   */
  private $locationResolver;

  /**
   * @param \BoosBoos\Charta\IO\IFile $inputFile
   * @param \BoosBoos\Charta\IO\IFile $outputFile
   * @param \BoosBoos\Charta\Client\GeoLocationResolver $locationResolver
   * @throws \BoosBoos\Charta\Common\NotSupportedException
   */
  public function __construct(
    IO\IFile $inputFile,
    IO\IFile $outputFile,
    Client\GeoLocationResolver $locationResolver
  ) {
    if ($inputFile->getFileType() !== IO\FileType::CSV) {
      throw new NotSupportedException("Only CSV files are supported as input files.");
    }

    if ($outputFile->getFileType() !== IO\FileType::JSON) {
      throw new NotSupportedException("Only JSON files are supported as output files.");
    }

    $this->inputFile = $inputFile;
    $this->outputFile = $outputFile;
    $this->locationResolver = $locationResolver;
  }

  /**
   * @return int
   */
  public function convert()
  {
    $this->loadAddresses();

    $this->inputFile->read();

    $clients = new \ArrayObject();

    foreach ($this->inputFile as $line) {
      $client = $this->createClient($line);

      $clients->append($client);
    }

    $this->outputFile->setContents($clients->getArrayCopy());
    $this->outputFile->write();

    return $clients->count();
  }

  /**
   * @param array $line
   * @return \BoosBoos\Charta\Client\Client
   */
  public function createClient($line)
  {
    $client = new Client\Client($line[0]);
    $address = new Client\Address($line[1], $line[2], $line[3]);

    $client->setAddress($address);

    $geo = $this->locationResolver->resolveLocation($address);

    if ($geo !== null) {
      $address->setLocation($geo);
    }

    return $client;
  }

  /**
   *
   */
  private function loadAddresses()
  {
    try {
      $this->outputFile->read();
    } catch (\UnexpectedValueException $exception) {
      // Output file is a new file, no addresses to load.
      return;
    }

    $clients = $this->outputFile->getContents();

    foreach ($clients as $client) {
      $address = $client->Address;

      if ($address->Geo === null ||
        $address->Geo->Lat === null || $address->Geo->Lng === null
      ) {
        continue;
      }

      $this->locationResolver->mapLocation(
        $address->Street,
        $address->PostalCode,
        $address->City,
        $address->Geo->Lat,
        $address->Geo->Lng
      );
    }
  }
}
