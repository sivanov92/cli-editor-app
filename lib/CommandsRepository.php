<?php

namespace Lib;

class CommandsRepository
{
    /**
     * Data repository for the stored commands, hardcoded into the class
     */
    protected static $registeredCommands = [
        's' => [
            'callable' => 'Lib\CommandActionsRepository::substituteStringOutput',
            'flags' => [
                '-i' => 'Lib\CommandActionsRepository::substituteStringWrite'
            ]
        ]
    ];
    
    public static function getCommands(): array
    {
        return self::$registeredCommands;
    }
}
