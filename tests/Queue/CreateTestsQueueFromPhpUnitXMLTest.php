<?php

namespace Liuggio\Fastest\Queue;

class CreateTestsQueueFromPhpUnitXMLTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     * @group failing
     */
    public function shouldCreateAnArrayOfTestSuitesFromXML()
    {
        $output = CreateTestsQueueFromPhpUnitXML::execute(__DIR__.'/Fixture/phpunit.xml.dist');

        $infrastructureDir = __DIR__ . '/Infrastructure/';
        $infrastructureFiles = [
            'InMemoryQueueFactoryTest.php',
            'InMemoryQueueTest.php',
        ];

        $processesDir = str_replace('/Queue', '', __DIR__) . '/Process/';
        $processesFiles = [
            'ProcessFactoryTest.php',
            'ProcessesManagerTest.php',
            'ProcessesTest.php',
            'ProcessorCounterTest.php',
        ];

        $queue = new TestsQueue();

        foreach ($infrastructureFiles as $file) {
            $queue->add($infrastructureDir . $file);
        }

        foreach ($processesFiles as $file) {
            $queue->add($processesDir . $file);
        }

        $this->assertEquals($queue, $output);
    }
}
