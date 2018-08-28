<?php
/**
 * This file is part of Jclecas EventLog
 *
 * @author JC Lecas <jeanchristophe.lecas@gmail.com> <@jclecas>
 * @category Jclecas
 * @package Jclecas\EventLog\Plugin\Framework\Event
 * @license MIT
 * @copyright Copyright (c) 2018 JC Lecas (http://jclecas.com)
 */

namespace Jclecas\EventLog\Plugin\Framework\Event;

use Jclecas\EventLog\Model\Config as EventLogConfig;

class ManagerPlugin
{
    private $logFilename;

    /**
     * @var EventLogConfig
     */
    private $eventLogConfig;

    /**
     * Manager constructor.
     */
    public function __construct(EventLogConfig $config)
    {
        $this->eventLogConfig = $config;
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $dirList = $objectManager->get('\Magento\Framework\App\Filesystem\DirectoryList');
        $this->logFilename = $dirList->getPath('var') . '/log/events.log';
    }

    public function beforeDispatch($subject, $eventName, $data = [])
    {
        if ($this->eventLogConfig->isActive()) {
            $logFile = fopen($this->logFilename, 'a');
            fwrite($logFile, $eventName . ' => ' . implode(', ', array_keys($data)) . "\n");
            fclose($logFile);
        }
        return [$eventName, $data];
    }
}
