<?php
/**
 * This file is part of Jclecas EventLog
 *
 * @author JC Lecas <jeanchristophe.lecas@gmail.com> <@jclecas>
 * @category Jclecas
 * @package Jclecas\EventLog\Console\Command
 * @license MIT
 * @copyright Copyright (c) 2018 JC Lecas (http://jclecas.com)
 */

namespace Jclecas\EventLog\Console\Command;

use Jclecas\EventLog\Model\Config as EventLogConfig;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Config\Model\ResourceModel\Config as ResourceConfig;
use Magento\Framework\Console\Cli;

class LogSwitchCommand extends Command
{
    /**
     * @var ResourceConfig
     */
    private $resourceConfig;

    /**
     * @var EventLogConfig
     */
    private $eventLogConfig;

    protected function configure()
    {
        $this
            ->setName('event:log:switch')
            ->setDescription('Event Log Switch');
        parent::configure();
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     * @return int|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $key = EventLogConfig::XML_PATH_JCLECAS_EVENTLOG_GENERAL_ACTIVE;
        $isActive = $this->eventLogConfig->isActive();
        $this->resourceConfig->saveConfig($key, ($isActive ? 0 : 1), 'default', 0);
        $action = ($isActive ? 'disabled' : 'enabled');
        $output->write("Module EventLog has been $action! Clean your cache with:\nbin/magento cache:clean config\n");
        return Cli::RETURN_SUCCESS;
    }

    public function __construct(ResourceConfig $resourceConfig, EventLogConfig $eventLogConfig)
    {
        parent::__construct();
        $this->resourceConfig = $resourceConfig;
        $this->eventLogConfig = $eventLogConfig;
    }
}
