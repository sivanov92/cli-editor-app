<?php

namespace Lib;

class Parser
{
    private static  $COMMAND_WRAPPER = "'";
    private static  $COMMAND_ARGUMENT_SEPARATOR = "/";

    /**
     * @param int $argc
     * @param array $argv
     * @return null|array 
     * 
     * Takes the script sli input and parses it into commands and parameters outputting them in a particular structure
     */
    public function parse(int $argc, array $argv): ?array
    {
        if ($argc <= 1) {
            throw new Exception("No arguments were passed to the editor ! Please input the options !");
            return null;
        }

        $flag = $argv[1];
        
        if (strpos($argv[1], "-") === false) {
            $flag = null;
        }

        $commandInput = $argv[1];
        $commandInputOffset = 1;
        if ($flag !== null) {
            $commandInput = $argv[2];
            $commandInputOffset = 2;
        }

        if (strpos($commandInput, self::$COMMAND_ARGUMENT_SEPARATOR) !== false && 
            strpos($commandInput, self::$COMMAND_WRAPPER) !== false) 
        {
            $commandInput = trim($commandInput, self::$COMMAND_WRAPPER);
            $arguments = explode(self::$COMMAND_ARGUMENT_SEPARATOR, $commandInput);

            $command = $arguments[0];

            unset($arguments[0]);
            $arguments = $this->filterEmptyValues($arguments);
            $otherArguments = array_splice($argv, $commandInputOffset+1, $argc);
        }

        
        return [
            'flag' => $flag,
            'command' => $command,
            'arguments' => $arguments,
            'otherArguments' => $otherArguments
        ];
    }

    /**
     * @param array $src - The exploded values of the command parameters
     * @return array - Array without the empty values from the stripping of the separators
     */
    protected function filterEmptyValues(array $src): array
    {
        return array_filter(
            $src,
            function ($value) {
                if (!empty($value)) {
                    return true;
                }
            }
        );
    }
}
