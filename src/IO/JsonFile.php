<?php

namespace BoosBoos\Charta\IO;

/**
 * @package BoosBoos\Charta\IO
 */
class JsonFile extends File
{
  /**
   * @param string $fileName
   */
  public function __construct($fileName)
  {
    parent::__construct($fileName, FileType::JSON);
  }

  /**
   * Reads the file into memory.
   * @throws \UnexpectedValueException
   */
  public function read()
  {
    parent::read();

    $json = json_decode($this->contents);

    if ($json === null) {
      throw new \UnexpectedValueException(
        "Invalid JSON: '" . $this->fileName . "'."
      );
    }

    $this->contents = $json;
  }

  /**
   * @param mixed $contents
   */
  public function setContents($contents)
  {
    parent::setContents(json_encode($contents));
  }
}
