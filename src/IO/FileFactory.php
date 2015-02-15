<?php

namespace BoosBoos\Charta\IO;

use BoosBoos\Charta\Common\NotSupportedException;

/**
 * @package BoosBoos\Charta\IO
 */
class FileFactory
{
  /**
   * Creates a file based on the file name.
   * @param string $path
   * @return \BoosBoos\Charta\IO\IFile
   * @throws \BoosBoos\Charta\Common\NotSupportedException
   */
  public function createFile($path)
  {
    $extension = pathinfo($path, PATHINFO_EXTENSION);

    if ($extension === FileType::CSV) {
      return new CsvFile($path);
    } elseif ($extension === FileType::JSON) {
      return new JsonFile($path);
    }

    throw new NotSupportedException("Unsupported extension: '" . $extension . "'.");
  }
}
