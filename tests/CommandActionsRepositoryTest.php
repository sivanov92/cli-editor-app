<?php  
namespace Tests;

use PHPUnit\Framework\TestCase;
use Lib\CommandActionsRepository;

final class CommandActionsRepositoryTest extends TestCase
{    
    protected $substituteStringMissingOptionsDataProvider = [
        'flag' => null,
        'command' => '',
        'arguments' => [],
        'otherArguments' => []
     ];

    protected $substituteStringBadFileDirDataProvider = [
        'flag' => null,
        'command' => 's',
        'arguments' => [
            'word1',
            'word2'
        ],
        'otherArguments' => [
           null
        ]
     ];
     

    /**
     * Tests the Exception with bad inputs
     */
    public function testSubstituteStringOutputMissingOptions()
    {
        $this->expectException(\InvalidArgumentException::class);

        $stringTest =  CommandActionsRepository::substituteStringOutput($this->substituteStringMissingOptionsDataProvider);
        $this->assertFalse($stringTest);
    }

    /**
     * Tests exception with good inputs but bad file dir
     */
    public function testSubstituteStringOutputBadFileDir()
    {
        $this->expectException(\Exception::class);

        $this->substituteStringBadFileDirDataProvider['otherArguments'] = [
             "testfilebad.txt"
        ];

        $stringTest =  CommandActionsRepository::substituteStringOutput($this->substituteStringBadFileDirDataProvider);
        $this->assertFalse($stringTest);
    }

    /**
     * Tests with proper inputs
     */
    public function testtestSubstituteStringOutputCorrect(){
       $correctData =  $this->substituteStringBadFileDirDataProvider;
       $correctData['otherArguments'] = [
           "testfile.txt"
       ];

       $stringTest =  CommandActionsRepository::substituteStringOutput($correctData);
       $this->assertTrue($stringTest);
    }
    
}
