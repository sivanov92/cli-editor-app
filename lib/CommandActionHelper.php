<?php

namespace Lib;

class CommandActionHelper
{
    /**
     * Methods that are used in the command actions as external
     */

     /**
      * @param string $fileName
      * @return null|string The file contents
      */
    protected static function getFileContent(string $fileName): ?string
    {
        if (!file_exists($fileName)) {
           throw new \Exception("File ".$fileName." does not exist!");
           return null;
        }
        
        return file_get_contents($fileName);
    }

    /**
     * @param string $fileName
     * @param string $newContent - the new content of the file, to be updated
     * @return bool
     */
    protected static function updateFileContent(string $fileName, string $newContent): bool
    {
        if (!file_exists($fileName)) {
            throw new \Exception("File ".$fileName." does not exist!");
            return null;
        }

        $fileUpdated = file_put_contents($fileName, $newContent);

        if (!$fileUpdated) {
            throw new \Exception("File ".$fileName." could not be updated due to error!");
            return false;
        }

        return true;
    }
}
