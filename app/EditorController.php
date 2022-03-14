<?php

namespace App;

use Lib\Parser;
use Lib\CommandsRepository;

class EditorController
{
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new EditorController();
        }
   
        return self::$instance;
    }

    /**
     * @param int $argc
     * @param array $argv
     * @return void
     * 
     * "Routes" the inputted commands and flags to their callbacks
     */
    public function handleCommands(int $argc, array $argv): void
    {
        $parser = new Parser();
        $options = $parser->parse($argc, $argv);
        $commands = CommandsRepository::getCommands();

        if (!array_key_exists($options['command'], $commands)) {
            throw new Exception("Command ".$options['command']." not found ! ");
            return;
        }

        $commandData = $commands[$options['command']];
        $commandCallable = $commandData['callable'];
        
        $flag = $options['flag'];
        if (!empty($flag) &&
           array_key_exists($flag, $commandData['flags'])
        ) {
            $flagCallable = $commandData['flags'][$flag];
        }

        $callable = (isset($flagCallable)) ? $flagCallable : $commandCallable;
        call_user_func($callable, $options);
    }
}
