<?php

namespace Lib;

use Lib\CommandActionHelper;

/**
 * This class is used as library to store methods to be used as callables for action calls
 */
class CommandActionsRepository extends CommandActionHelper
{

    /**
     * @param array $options - input array of sorted and parsed parameters
     * @return array
     */
    public static function substituteStringOutput(array $options): bool
    {
       if(empty($options) || 
         !isset($options['command']) ||
         !isset($options['arguments']) || 
         !isset($options['otherArguments']) ||
         count($options['otherArguments']) === 0) {
             throw new \InvalidArgumentException("The options passed to the substitute method are missing or invalid !");
        }
        
        $fileName = $options['otherArguments'][0];
        
        $fileContent = self::getFileContent($fileName);
        
        if(empty($fileContent) || !$fileContent) {
            print('Nothing to substitute');
            return true;
        }

        $arguments = array_values($options['arguments']);
        $searchWord = $arguments[0];
        $replaceWord = $arguments[1];
        $output = str_replace($searchWord, $replaceWord, $fileContent);

        if($fileContent === $output){
          print('The result is the same, nothing to change !');
          return true; 
        }

        printf(" \n Output: \n %s \n",$output);
        return true;
    }

    /**
     * @param array $options - input array of sorted and parsed parameters
     * @return array
     */
    public static function substituteStringWrite(array $options): bool
    {
       if(empty($options) || 
         !isset($options['command']) ||
         !isset($options['arguments']) || 
         !isset($options['otherArguments']) ||
         count($options['otherArguments']) === 0) {
            throw new \InvalidArgumentException("The options passed to the substitute method are missing or invalid !");
        }
        
        $fileName = $options['otherArguments'][0];

        var_dump($fileName);
        $fileContent = self::getFileContent($fileName);
        
        if(empty($fileContent) || !$fileContent) {
            print('Nothing to substitute');
            return true;
        }

        $arguments = array_values($options['arguments']);
        $searchWord = $arguments[0];
        $replaceWord = $arguments[1];
        $output = str_replace($searchWord, $replaceWord, $fileContent);

        if($fileContent === $output) {
            print("Nothing to alter !");
            return true;
        }

        printf(" \n Output: \n %s \n",$output);

        $successfullyUpdated = self::updateFileContent($fileName, $output);
        if(!$successfullyUpdated) {
            return false;
        }

        return true;
    }
}
