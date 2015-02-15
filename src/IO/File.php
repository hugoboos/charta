<?php

namespace BoosBoos\Charta\IO;

/**
 * Interface IFileReader
 * @package BoosBoos\Charta\IO
 */
class File implements IFile
{
  /**
   * The file type.
   * @var string
   */
  private $fileType;

  /**
   * The file name.
   * @var string
   */
  protected $fileName;

  /**
   * @var \BoosBoos\Charta\IO\Directory
   */
  protected $directory;

  /**
   * The parsed contents of the file.
   * @var mixed
   */
  protected $contents;

  /**
   * @param string $filePath
   * @param string $fileType
   */
  public function __construct($filePath, $fileType = FileType::UNKNOWN)
  {
    $this->fileName = $filePath;
    $this->fileType = $fileType;

    $this->directory = new Directory($filePath);
  }

  /**
   * @throws \UnexpectedValueException
   */
  public function read()
  {
    $this->ensureExists();

    $fileContents = file_get_contents($this->fileName);

    if ($fileContents === false) {
      throw new \UnexpectedValueException(
        "Error during reading file: '" . $this->fileName . "'."
      );
    }

    $this->contents = $fileContents;
  }

  /**
   * Writes the contents to disk.
   * @throws \UnexpectedValueException
   */
  public function write()
  {
    if ($this->directory->exists() === false) {
      $this->directory->create();
    }

    $written = file_put_contents($this->fileName, $this->contents);

    if ($written === false) {
      throw new \UnexpectedValueException(
        "Error during writing file: '" . $this->fileName . "'."
      );
    }
  }

  /**
   * Checks if the file exists.
   * @return bool
   */
  public function exists()
  {
    return file_exists($this->fileName);
  }

  /**
   * Gets the type of the file.
   * @return string
   */
  public function getFileType()
  {
    return $this->fileType;
  }

  /**
   * Gets the parsed contents of the file.
   * @return mixed
   */
  public function getContents()
  {
    return $this->contents;
  }

  /**
   * Sets the contents of the file.
   * @param string $contents
   */
  public function setContents($contents)
  {
    $this->contents = (string)$contents;
  }

  /**
   * @throws \UnexpectedValueException
   */
  private function ensureExists()
  {
    if (!$this->exists()) {
      throw new \UnexpectedValueException(
        "File doesn't exist file: '" . $this->fileName . "'."
      );
    }
  }
}
