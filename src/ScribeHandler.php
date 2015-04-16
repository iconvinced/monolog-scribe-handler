<?php

namespace Iconvinced\MonologScribeHandler;

class ScribeHandler extends \Monolog\Handler\AbstractHandler
{
    private $scribe;

    /**
     * @param string $host the address of scribed
     * @param integer $port the port of scribed
     */
    public function __construct($host, $port)
    {
        $this->scribe = new \Horde_Scribe_Client();
        $this->scribe->connect($host, $port);
    }

    public function handle(array $record)
    {
        $formatted = $this->getFormatter()->format($record);
        $this->scribe->log($record['channel'], $formatted);
    }
}
