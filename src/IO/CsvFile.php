<?php

namespace BoosBoos\Charta\IO;

/**
 * @package BoosBoos\Charta\IO
 */
class CsvFile extends File implements \IteratorAggregate
{
  /**
   * @var string
   */
  private $columnDelimiter;

  /**
   * @var array
   */
  private $lines;

  /**
   * @param string $fileName
   * @param string $columnDelimiter
   */
  public function __construct($fileName, $columnDelimiter = ";")
  {
    parent::__construct($fileName, FileType::CSV);

    $this->columnDelimiter = $columnDelimiter;
  }

  /**
   * {@inheritdoc}
   */
  public function read()
  {
    $this->lines = array_map([$this, "readLine"], file($this->fileName));
  }

  /**
   * {@inheritdoc}
   */
  public function getIterator()
  {
    return new \ArrayIterator($this->lines);
  }

  /**
   * @param string $line
   * @return array
   *
   * @SuppressWarnings(PHPMD.UnusedPrivateMethod) Being used in read method.
   */
  private function readLine($line)
  {
    return str_getcsv($line, $this->columnDelimiter);
  }
}
